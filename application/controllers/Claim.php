<?php
class Claim extends CI_Controller
{
    protected $API = "";
    private $key = "";

    // Encryption Function
    function mc_encrypt($data, $key) { 
        /// make binary representasion of $key
        $key = hex2bin($key);

        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) { 
            throw new Exception("Needs a 256-bit key!"); 
        } 
        /// create initialization vector
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        $iv = openssl_random_pseudo_bytes($iv_size); // dengan catatan dibawah
        /// encrypt
        $encrypted = openssl_encrypt($data, "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv );
        /// create signature, against padding oracle attacks
        $signature = mb_substr(hash_hmac("sha256", $encrypted, $key, true),0,10,"8bit");
        /// combine all, encode, and format
        $encoded = chunk_split(base64_encode($signature.$iv.$encrypted));
        return $encoded;
    }

    // Decryption Function
    function mc_decrypt($str, $strkey){
        /// make binary representation of $key
        $key = hex2bin($strkey);

        /// check key length, must be 256 bit or 32 bytes
        if (mb_strlen($key, "8bit") !== 32) { 
            throw new Exception("Needs a 256-bit key!");
        }
        
        /// calculate iv size
        $iv_size = openssl_cipher_iv_length("aes-256-cbc");
        
        /// breakdown parts
        $decoded = base64_decode($str); $signature = mb_substr($decoded,0,10,"8bit");
        $iv = mb_substr($decoded,10,$iv_size,"8bit");
        $encrypted = mb_substr($decoded,$iv_size+10,NULL,"8bit");
        
        /// check signature, against padding oracle attack
        $calc_signature = mb_substr(hash_hmac("sha256", $encrypted, $key, true),0,10,"8bit");
        if(!$this->mc_compare($signature,$calc_signature)) { 
            return "SIGNATURE_NOT_MATCH"; /// signature doesn't match
        }
        $decrypted = openssl_decrypt($encrypted, "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv);
        return $decrypted;
    }

    /// Compare Function
    function mc_compare($a, $b) {
        /// compare individually to prevent timing attacks

        /// compare length
        if (strlen($a) !== strlen($b)) return false;

        /// compare individual
        $result = 0;
        for($i = 0; $i < strlen($a); $i ++) {
            $result |= ord($a[$i]) ^ ord($b[$i]);
        }

        return $result == 0;
    }

    function __construct() {
        parent::__construct();
        $this->API="http://localhost/E-Klaim/ws.php";
        $this->key="6e10de75792e6aa48a8ff57212fc923c3eaced66b21a5e2b4fd54ec75f2d848f";
        $this->load->library('session');
        $this->load->library('curl');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    function index() {
        $this->load->view('claim/new');
    }

    // insert klaim baru (dengan registrasi pasien)
    function create() {
        // var_dump('masuk');exit;
        if(isset($_POST['submit'])){
            // json query
            $request = <<<EOT
            { 
                "metadata": { 
                    "method": "new_claim" 
                }, "data": { 
                    "nomor_kartu": "0000668870002",
                    "nomor_sep": "1710R01011160000250",
                    "nomor_rm": "214-45-78",
                    "nama_pasien": "NIKMAH",
                    "tgl_lahir": "1940-01-01 02:00:00",
                    "gender": "2"
                }
            }
EOT;
            // data yang akan dikirimkan dengan method POST adalah encrypted
            $payload = $this->mc_encrypt(null, $this->key);

            // tentukan Content-Type pada http header
            $header = array("Content-Type: application/x-www-form-urlencoded");

            $insert =  $this->curl->simple_post($this->API, null, array(
                CURLOPT_HEADER => 0,
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_HTTPHEADER => $header,
                CURLOPT_POSTFIELDS => $payload
            ));

            // terlebih dahulu hilangkan "----BEGIN ENCRYPTED DATA----\r\n"// dan hilangkan "----END ENCRYPTED DATA----\r\n" dari response
            $first = strpos($insert, "\n")+1;
            $last = strrpos($insert, "\n")-1;
            $response = substr($insert, $first, strlen($insert) - $first - $last);
            
            // decrypt dengan fungsi mc_decrypt
            $response = $this->mc_decrypt($response, $this->key);

            // hasil decrypt adalah format json, ditranslate kedalam array
            $msg = json_decode($response,true);

            if($msg['metadata']['code'] === 200)
            {
                $this->session->set_flashdata('hasil','Insert Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Insert Data Gagal');
            }
            redirect('/');
        }else{
            $this->load->view('claim/new');
        }
    }
}
