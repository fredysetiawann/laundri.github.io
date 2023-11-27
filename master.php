<?php
//error_reporting(0);
session_start();
include_once 'config/class.php';

$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

$user = new User();
$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
if ($_GET['page'] == 'logout')
{
$user->user_logout();
header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>::Sixghakreasi Admin</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/uniform.css" />
<link rel="stylesheet" href="css/select2.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

<link rel="stylesheet" href="css/datepicker.css" />
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Sixghakreasi Admin</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome <?php echo $user->ambilNama($iduser); ?></span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="detail-user-<?php echo $_SESSION['nik'];?>" target="_blank"><i class="icon-qrcode"></i> ID Card</a></li>
        <li><a href="logout"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    
  </ul>
</div>



<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i>Forms</a>
  <ul>
<?php
/*if the session is admin.*/ 
if ($_SESSION['level'] =='admin'){
//===========home===========//
if ($_GET['page'] == 'home'){
  echo"<li class='active'><a href='home'><i class='icon icon-home'></i> <span>Home</span></a> </li>";
}
else {
  echo"<li><a href='home'><i class='icon icon-home'></i> <span>Home</span></a> </li>";
}
//===========user===========//
if ($_GET['page'] == 'users'){
  echo"<li class='active'><a href='users'><i class='icon icon-user'></i> <span>Users</span></a> </li>";
}
else{
  echo"<li><a href='users'><i class='icon icon-user'></i> <span>Users</span></a> </li>";
}

//===========Paket===========//
if ($_GET['page'] == 'paket'){
  echo"<li class='active'><a href='paket'><i class='icon icon-camera-retro'></i> <span>Paket</span></a> </li>";
}
else{
  echo"<li><a href='paket'><i class='icon icon-camera-retro'></i> <span>Paket</span></a> </li>";
}

//===========konsumen===========//
if ($_GET['page'] == 'konsumen'){
  echo"<li class='active'><a href='konsumen'><i class='icon icon-group'></i> <span>Konsumen</span></a> </li>";
}
else{
  echo"<li><a href='konsumen'><i class='icon icon-group'></i> <span>Konsumen</span></a> </li>";
}

//===========transaksi===========//
if ($_GET['page'] == 'transaksi'){
  echo"<li class='active'><a href='transaksi'><i class='icon icon-money'></i> <span>Transaksi</span></a> </li>";
}
else{
  echo"<li><a href='transaksi'><i class='icon icon-money'></i> <span>Transaksi</span></a> </li>";
}


//===========laporan===========//
if ($_GET['page'] == 'laporan'){
  echo"<li class='active'><a href='laporan'><i class='icon icon-copy'></i> <span>Laporan</span></a> </li>";
}
else{
  echo"<li><a href='laporan'><i class='icon icon-copy'></i> <span>Laporan</span></a> </li>";
}

}

/*if the session is user.*/ 
else {

//===========home===========//
if ($_GET['page'] == 'home'){
  echo"<li class='active'><a href='home'><i class='icon icon-home'></i> <span>Home</span></a> </li>";
}
else {
  echo"<li><a href='home'><i class='icon icon-home'></i> <span>Home</span></a> </li>";
}

//===========transaksi===========//
if ($_GET['page'] == 'transaksi'){
  echo"<li class='active'><a href='transaksi'><i class='icon icon-money'></i> <span>Transaksi</span></a> </li>";
}
else{
  echo"<li><a href='transaksi'><i class='icon icon-money'></i> <span>Transaksi</span></a> </li>";
}
} /*end the session is user.*/ 
?>

  </ul>
</div>
<?php include "isi.php";?>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12"> 2017 &copy; <a href="http://sixghakreasi.com">www.sixghakreasi.com</a> </div>
</div>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script>
<script src="js/matrix.tables.js"></script>


<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script>
<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 
<script src="js/matrix.form_common.js"></script> 







</body>
</html>
