<?php session_start();
    error_reporting(0);
    include("../common/config.php");
    if(strlen($_SESSION['login'])==0){ 
        header('location:index.php');
    }else {
        $query=mysqli_query($con,"select * from anggota where email='".$_SESSION['login']."'");
        $row=mysqli_fetch_array($query);
        if(!empty($_GET['message'])) {
            $msg = $_GET['message'];
            unset($_GET['messsage']);
        }
        if(isset($_POST['submit'])){
            $email = $_POST['email'];
            $username = $_POST['username'];
            $nama = $_POST['nama'];
            $gender = $_POST['gender'];
            $alamat = $_POST['Alamat'];
            $nomor = $_POST['nomor'];
            // $query1 = mysqli_query($con, "UPDATE anggota set email='$email', username='$username', nama_member='$nama', gender='$gender', alamat_member='$alamat', nomor_telepon_member='$nomor' WHERE email='".$_SESSION['login']."' ");
            $query1=mysqli_query($con,"update anggota set email='$email',username='$username', nama_member='$nama', gender='$gender', alamat_member='$alamat', nomor_telepon_member='$nomor' where email='".$_SESSION['login']."'");
            if($query1){
                $msg = "Anda telah berhasil melakukan update data diri, tetap pastikan data diri anda selalu diupdate dengan benar"; 
        	    header("location:profile.php?message=$msg");
            }
        }
        if(isset($_POST['ganti'])){
            $old = md5($_POST['password']);
            $query2 = mysqli_query($con, "select * from anggota where password='$old'");
            $rowpassword = mysqli_fetch_array($query2);
            if($rowpassword>0){
                $new = md5($_POST['newpassword']);
                $query3= mysqli_query($con, "update anggota set password='$new' where email='".$_SESSION['login']."'");
                if($query3){
                    $msg = "Password Anda telah berhasil diganti.";
                    header("location:profile.php?message=$msg");
                }
            }else{
                $error = "password yang anda masukkan tidak benar";
            }
        }
    ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Perpustkaan</title>
	<link rel="apple-touch-icon" sizes="180x180" href="../vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="../vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="../vendors/images/favicon-16x16.png">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="../vendors/styles/style.css">
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
    <script>
        function valid(){
            if(document.getElementById("newpassword").value != document.getElementById("confirmpassword").value){
                alert("Password yang anda masukkan tidak sama  !!");
                document.getElementById("confirmpassword").focus();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
	<?php include("common/header.php") ?>
	<?php include("common/sidebar.php") ?>
	<div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profile</li>
                            </ol>
                            <?php if($msg){ ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Selamat </strong><?php echo htmlentities($msg)?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                            <?php if($error){ ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Maaf </strong><?php echo htmlentities($error)?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">

                        <h5 class="text-center h5 mb-0"><?php echo htmlentities($row['nama_member']) ?></h5>
                        <p class="text-center text-muted font-14">Lorem ipsum dolor sit amet</p>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                            <ul>
                                <li>
                                    <span>Username:</span>
                                    <?php echo htmlentities($row['username']) ?>
                                </li>
                                <li>
                                    <span>Email Address:</span>
                                    <?php echo htmlentities($row['email']) ?>
                                </li>
                                <li>
                                    <span>Phone Number:</span>
                                    0<?php echo htmlentities($row['nomor_telepon_member']) ?>
                                </li>
                                <li>
                                    <span>Address:</span>
                                    <?php echo htmlentities($row['alamat_member']) ?>
                                </li>
                            </ul>
                        </div>
                        <div class="profile-social">
                            <h5 class="mb-20 h5 text-blue">Social Links</h5>
                            <ul class="clearfix">
                                <li><a href="#" class="btn" data-bgcolor="#3b5998" data-color="#ffffff"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#1da1f2" data-color="#ffffff"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#007bb5" data-color="#ffffff"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#f46f30" data-color="#ffffff"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#c32361" data-color="#ffffff"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#3d464d" data-color="#ffffff"><i class="fa fa-dropbox"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#db4437" data-color="#ffffff"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#bd081c" data-color="#ffffff"><i class="fa fa-pinterest-p"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#00aff0" data-color="#ffffff"><i class="fa fa-skype"></i></a></li>
                                <li><a href="#" class="btn" data-bgcolor="#00b489" data-color="#ffffff"><i class="fa fa-vine"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">


                                <div class="pd-20 card-box mb-30">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <h2 class="h2">Setting</h2>
                                            <form name="dataDiri" method="post">
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <h3 class="text-blue h5 mb-20">Update Data Diri Anda</h3>
                                                        <div class="form-group">
                                                            <label>Email</label>
                                                            <input class="form-control form-control-lg" name="email" type="email">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Username</label>
                                                            <input class="form-control form-control-lg" name="username" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nama Lengkap</label>
                                                            <input class="form-control form-control-lg" name="nama" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Gender</label>
                                                            <div class="d-flex">
                                                                <div class="custom-control custom-radio mb-5 mr-20">
                                                                    <input type="radio" id="customRadio4" name="gender" class="custom-control-input" value="pria">
                                                                    <label class="custom-control-label weight-400" for="customRadio4">Pria</label>
                                                                </div>
                                                                <div class="custom-control custom-radio mb-5">
                                                                    <input type="radio" id="customRadio5" name="gender" class="custom-control-input" value="wanita">
                                                                    <label class="custom-control-label weight-400" for="customRadio5">Wanita</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Alamat</label>
                                                            <input class="form-control form-control-lg" name="Alamat" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Nomor Telepon</label>
                                                            <input class="form-control form-control-lg" name="nomor" type="text">
                                                        </div>
                                                        <!-- <div class="form-group">
                                                            <label>Phone Number</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Address</label>
                                                            <textarea class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Visa Card Number</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Paypal ID</label>
                                                            <input class="form-control form-control-lg" type="text">
                                                        </div> -->
                                                        <div class="form-group">
                                                            <div class="custom-control custom-checkbox mb-5">
                                                                <input type="checkbox" class="custom-control-input" id="customCheck1-1">
                                                                <label class="custom-control-label weight-400" for="customCheck1-1">I agree to receive notification emails</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary" name="submit" value="Update Information">
                                                        </div>
                                                    </li>
                                                    <li class="weight-500 col-md-6">
                                                        <h4 class="text-blue h5 mb-20">Change Password</h4>
                                                        <div class="form-group">
                                                            <label>Password Lama</label>
                                                            <input class="form-control form-control-lg" type="password" name="password" placeholder="Paste your link here">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Password Baru</label>
                                                            <input class="form-control form-control-lg" type="password" name="newpassword" id="newpassword" placeholder="Paste your link here">
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Konfimrasi Password Baru</label>
                                                            <input class="form-control form-control-lg" type="password" name="confirmpassword" id="confirmpassword" placeholder="Paste your link here">
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <input type="submit" class="btn btn-primary" name="ganti" value="Save & Update" onclick="return valid()">
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form> 
                                        </div>
                                    </div>
                                    <!-- Setting Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-wrap pd-20 mb-20 card-box">
            DeskApp - Bootstrap 4 Admin Template By <a href="https://github.com/dropways" target="_blank">Ankit Hingarajiya</a>
        </div>
    </div>
</div>
	<!-- js -->
	<script src="../vendors/scripts/core.js"></script>
	<script src="../vendors/scripts/script.min.js"></script>
	<script src="../vendors/scripts/process.js"></script>
	<script src="../vendors/scripts/layout-settings.js"></script>
	<script src="../src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="../src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="../src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="../src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="../vendors/scripts/dashboard.js"></script>
</body>
</html>
<?php } ?>