<?php
session_start();
if ($_SESSION['status']!='login'){
	header("Location:admin.php");
}
?>
<?php
    include('view/header.php');
    include('config.php');
?>
    <title>Form Iuran Offline</title>
    </head>
    <body>
    <?php
        include('view/header_admin.php');
        include('view/sidebar_admin.php');
        include('view/rightbar_admin.php');
    ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Form Iuran Offline</h4>
						</div>
                    </div>
                    <br/>
                    <form action="iuran_offline_back.php" method="POST">
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Id Anggota </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="ang" placeholder="Id Anggota"/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label"></label>
							<div class="col-sm-12 col-md-10">
                                <a href="daftar_anggota.php" style="margin-left:5px">Lihat daftar anggota</a>
							</div>
						</div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Jumlah Pembayaran</label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="jml" placeholder="Jumlah Pembayaran"/>
							</div>
                        </div>
                        <div class="form-group row">
                            <input class="btn-sm btn-primary" type="submit" value="Konfirmasi" name="konfirmasi" style="margin-left:12px"/>
                        </div>
					</form>
				</div>
				<!-- Default Basic Forms End -->
<?php
    include('view/footer.php');
?>