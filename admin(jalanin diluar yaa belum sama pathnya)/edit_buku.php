<?php
    include('view/header.php');
    include('config.php');
?>
    <title>Edit Buku</title>
    </head>
    <body>
    <?php
        if( !isset($_GET['id']) ){
            header('Location: buku.php');
        }
        include('view/header_admin.php');
        include('view/sidebar_admin.php');
        include('view/rightbar_admin.php');
        $id = $_GET['id'];
        $sql = "SELECT * FROM buku WHERE id_buku=$id";
        $query = mysqli_query($conn, $sql);
        $buku = mysqli_fetch_assoc($query);
        if(mysqli_num_rows($query) < 1 ){
            die("data tidak ditemukan...");
        }        
        $publisher = $buku['id_publisher'];

    ?>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<!-- Default Basic Forms Start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Form Edit Buku</h4>
						</div>
                    </div>
                    <br/>
					<form action="tmbh_back.php" method="POST">
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Judul Buku </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="judul" placeholder="Judul Buku" value="<?php echo $buku['judul_buku'] ?>"/>
							</div>
                        </div>
                        <?php
                            include ('config.php');
                            $sql = "SELECT * FROM publisher";
                            $query = mysqli_query($conn, $sql);
                        ?>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Penerbit</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="penerbit" id="penerbit">
                                <option>Pilih Penerbit...</option>
                                <?php 
                                  while($penerbit = mysqli_fetch_array($query)){
                                      echo "<option value='".$penerbit['id_publisher']."'".($agama == 'Islam') ? "selected": "".">".$penerbit['nama_publisher']."</option>";
                                  }
                                ?>
								</select>
							</div>
                        </div>
                        <?php
                            $sql2 = "SELECT * FROM kategori_buku";
                            $query2 = mysqli_query($conn, $sql2);
                        ?>
						<div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Kategori</label>
							<div class="col-sm-12 col-md-10">
								<select class="custom-select col-12" name="kategori" id="kategori">
                                <option>Pilih Kategori...</option>
                                <?php 
                                  while($kategori = mysqli_fetch_array($query2)){
                                      echo "<option value='".$kategori['kode_kategori']."'>".$kategori['deskripsi_kategori']."</option>";
                                  }
                                ?>
								</select>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">ISBN </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="isbn" placeholder="ISBN" value="<?php echo $buku['isbn'] ?>"/>
							</div>
                        </div>
                        <div class="form-group row">
							<label class="col-sm-12 col-md-2 col-form-label">Jumlah </label>
							<div class="col-sm-12 col-md-10">
                                <input class="form-control" type="text" name="jumlah" placeholder="Jumlah" value="<?php echo $buku['jumlah_buku'] ?>"/>
							</div>
                        </div>
                        <div class="form-group row">
                            <input class="btn-sm btn-primary" type="submit" value="Tambah" name="daftar" style="margin-left:12px"/>
                        </div>
					</form>
				</div>
				<!-- Default Basic Forms End -->
<?php
    include('view/footer.php');
?>