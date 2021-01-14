<?php 
    include("config.php");
    include("view/header.php");
    include("view/header_admin.php");
    include("view/sidebar_admin.php");
    include("view/rightbar_admin.php");
?>
    <title>Buku</title>
</head>
<!--
<body>
    <header>
        <h3>Buku yang terdaftar</h3>
    </header>

    <nav>
        <a href="#">[+] Tambah Buku Baru</a>
    </nav>

    <p>
            Cari Judul Buku : <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Judul Buku">
    </p>
    <table border="1" id="tabel">
    <thead>
        <tr>
            <th>id</th>
            <th>Penerbit</th>
            <th>Kategori</th>
            <th>Judul</th>
            <th>ISBN</th>
            <th>Jumlah</th>
            <th>Tindakan</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    </table>-->

     <!-- Responsive tables Start -->
     <div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
        <div class="pd-20 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">Daftar Buku</h4>
                        </div>
                        <br/>
                    </div>
                    <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <a href="tambah_buku.php">[+] Tambah Buku Baru</a>
                    </div>
                        <div class="col-sm-12 col-md-6 text-right">
                            <div id="DataTables_Table_0_filter" class="dataTables_filter">
                                <label>
                                    <input type="text" id="myInput" onkeyup="myFunction()" class="form-control form-control-sm" placeholder="Cari Judul Buku" aria-controls="DataTables_Table_0">
                                </label>
                            </div>
                        </div>
                    </div>
					<div class="table-responsive">
						<table class="table table-striped" id="tabel">
							<thead>
								<tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Judul</th>
                                    <th scope="col">Penerbit</th>
                                    <th scope="col">Kategori</th>
                                    <th scope="col">ISBN</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Tindakan</th>
								</tr>
							</thead>
							<tbody>
                            <?php
                                $sql = "SELECT buku.id_buku, publisher.nama_publisher, kategori_buku.deskripsi_kategori, buku.judul_buku, buku.isbn, buku.jumlah_buku FROM buku INNER JOIN publisher INNER JOIN kategori_buku WHERE buku.id_publisher=publisher.id_publisher AND buku.kode_kategori=kategori_buku.kode_kategori ORDER BY buku.id_buku";
                                $query = mysqli_query($conn, $sql);

                                while($buku = mysqli_fetch_array($query)){
                                    echo "<tr>";

                                    echo "<td scope='row'><input type='hidden' name='id_buku' value='".$buku['id_buku']."'>".$buku['id_buku']."</td>";
                                    echo "<td>".$buku['judul_buku']."</td>";
                                    echo "<td>".$buku['nama_publisher']."</td>";
                                    echo "<td>".$buku['deskripsi_kategori']."</td>";
                                    echo "<td>".$buku['isbn']."</td>";
                                    echo "<td>".$buku['jumlah_buku']."</td>";

                                    echo "<td>";
                                    echo "<a href='edit_buku.php?id=".$buku['id_buku']."'>Edit</a> | ";
                                    echo "<a href='hapus_buku.php?id=".$buku['id_buku']."'>Hapus</a>";
                                    echo "</td>";

                                    echo "</tr>";
                                }
                            ?>
							</tbody>
                        </table>
					</div>
				</div>
                <!-- Responsive tables End -->
                </div>
					</div>
                </div>

    <script>
            function myFunction() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("tabel");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
        if (td) {
        txtValue = td.textContent || td.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
        }
    }
    }
    </script>

<?php 
    include ('view/footer.php');
?>