<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="FaberNainggolan">
    <title>CodeIgniter dengan Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap-datetimepicker.min.css">
	<!-- fontsawesome -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
		<div class="container">
		<?php if($this->session->flashdata('hasil_sukses')) { ?>
			<div class="alert alert-success alert-dismissable fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Sukses!</strong> Data berhasil dimasukkan ke aplikasi E-Klaim.
			</div>
		<?php } ?>
		<?php if($this->session->flashdata('hasil_error')) { ?>
			<div class="alert alert-danger alert-dismissable fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Error!</strong> Data tidak berhasil dimasukkan ke aplikasi E-Klaim.
			</div>
		<?php } ?>
            <div class="row">
                <div class="col-sm-12">
                    <h1>Integrasi dengan Aplikasi E-Klaim (for test only)</h1>
                    <h5>Developed by Afif Abdillah Jusuf</h5>
                </div>
            </div>
			<div class="formBox">
				<form method="post" action="<?php echo base_url('claim/create'); ?>">
						<div class="row">
							<div class="col-sm-12">
								<h1>Tambah Pasien Beserta Klaim Baru</h1>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox ">
									<div class="inputText">Nomor Peserta</div>
									<input type="text" name="nomor_peserta" class="input">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Nomor SEP</div>
									<input type="text" name="nomor_sep" class="input">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Nomor Rekam Medis</div>
									<input type="text" name="nomor_rm" class="input">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Nama Pasien</div>
									<input type="text" name="nama_pasien" class="input">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox focus">
									<div class="inputText">Tanggal Lahir</div>
                                    <div id="datetimepicker" class="input-append date">
                                        <input name="tgl_lahir" class="input" data-format="yyyy-MM-dd hh:mm:ss" type="text"></input>
                                        <span class="add-on">
											<i class="fa fa-calendar-plus-o" aria-hidden="true"></i>										
                                        </span>
                                    </div>
								</div>
							</div>
							<div class="col-sm-12">
								<h3>Jenis Kelamin</h3>
								<div class="reg">
									<bdo>
										<input type="radio" value="1" name="gender">
										<span></span>
										<abbr> Laki-laki </abbr>
									</bdo>
								</div>
								<div class="reg">
									<bdo>
										<input type="radio" value="2" name="gender">
										<span></span>
										<abbr> Perempuan </abbr>
									</bdo>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<input type="submit" name="submit" class="button" value="Kirim Data">
							</div>
						</div>
				</form>
			</div>
		</div>
	</div>
    <!-- Bootstrap core and JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap-datetimepicker.id.js"></script>
    <script type="text/javascript">
        $(".input").focus(function() {
            $(this).parent().addClass("focus");
        });

        $('#datetimepicker').datetimepicker({
            format: 'yyyy-MM-dd hh:mm:ss',
            language: 'id'
        });
    </script>
</body>
</html>