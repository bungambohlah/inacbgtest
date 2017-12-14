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
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
		<div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Integrasi dengan Aplikasi E-Klaim (for test only)</h1>
                    <h5>Developed by Afif Abdillah Jusuf</h5>
                </div>
            </div>
			<div class="formBox">
				<form>
						<div class="row">
							<div class="col-sm-12">
								<h1>Tambah Pasien Beserta Klaim Baru</h1>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox ">
									<div class="inputText">Nomor Peserta</div>
									<input type="text" name="" class="input">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Nomor SEP</div>
									<input type="text" name="" class="input">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Nomor Rekam Medis</div>
									<input type="text" name="" class="input">
								</div>
							</div>

							<div class="col-sm-6">
								<div class="inputBox">
									<div class="inputText">Nama Pasien</div>
									<input type="text" name="" class="input">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox">
									<div class="inputText">Tanggal Lahir</div>
                                    <div id="datetimepicker" class="input-append date">
                                        <input name="" data-format="yyyy-mm-dd hh:mm:ss" type="text"></input>
                                        <span class="add-on">
                                            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                                            </i>
                                        </span>
                                    </div>
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
            format: 'yyyy-mm-dd hh:mm:ss',
            language: 'id'
        });
    </script>
</body>
</html>