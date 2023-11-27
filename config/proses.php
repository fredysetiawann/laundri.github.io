<?php
session_start();
include_once 'class.php';

// instance objek db dan user
$user = new User();
$db = new Database();
// instance objek paket
$paket = new Paket();
// instance objek Transaksi
$transaksi = new Transaksi();
// instance objek konsumen
$konsumen = new Konsumen();
// koneksi ke MySQL via method
$db->connectMySQL();



$page = $_GET['page'];
// ############################################ MODULE USER ############################################################
// ## USER-LOGIN
if($page == "login"){

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $login=$user->cek_login($_POST['username'], $_POST['password']);
  if($login) {
    // login sukses, arahkan ke file master.php
    header("location:../home");
  }
  else {
  // login gagal, beri peringatan dan kembali ke file index.php
header("location:../login_error.php"); 
  }
}
}

// ## USER-INPUT
elseif($page == "input-user"){
$nik = trim(htmlspecialchars($_POST['nik']));
$nama_users = trim(htmlspecialchars($_POST['nama_users']));
$username   = trim(htmlspecialchars($_POST['username']));
$level      = trim(htmlspecialchars($_POST['level']));
$password   = md5($_POST['pwd']);
$user->input_user($nik,$nama_users,$username,$password,$level );
header("location:../users");
}

// ## USER-UPDATE
elseif($page == "update-user"){
$id_users 	= trim(htmlspecialchars($_POST['id_users']));
$nik 		= trim(htmlspecialchars($_POST['nik']));
$nama_users = trim(htmlspecialchars($_POST['nama_users']));
$username   = trim(htmlspecialchars($_POST['username']));
$level      = trim(htmlspecialchars($_POST['level']));
$password   = md5($_POST['pwd']);
$user->update_user($id_users,$nik,$nama_users,$username,$password,$level);
header("location:../users");
}

// ## USER-DELETE
elseif($page == "hapus-user"){
$user->hapus_user($_GET['id']);
 	header("location:../users");
}
// ############################################ END MODULE USER ############################################################
// ############################################ MODULE PAKET ############################################################
// ## PAKET-INPUT
elseif($page == "input-paket"){
$id_paket 	 = trim(htmlspecialchars($_POST['id_paket']));
$nama_paket  = trim(htmlspecialchars($_POST['nama_paket']));
$harga_paket = trim(htmlspecialchars($_POST['harga_paket']));
$paket->input_paket($id_paket,$nama_paket,$harga_paket);
header("location:../paket");
}

// ## PAKET-UPDATE
elseif($page == "update-paket"){
$id_paket 	 = trim(htmlspecialchars($_POST['id_paket']));
$nama_paket  = trim(htmlspecialchars($_POST['nama_paket']));
$harga_paket = trim(htmlspecialchars($_POST['harga_paket']));
$paket->update_paket($id_paket,$nama_paket,$harga_paket);
header("location:../paket");
}

// ## PAKET-DELETE
elseif($page == "hapus-paket"){
$paket->hapus_paket($_GET['id']);
header("location:paket");
}
// ############################################ END MODULE PAKET ############################################################

// ############################################ MODULE KONSUMEN ############################################################
// ## konsumen-INPUT
elseif($page == "input-konsumen"){
$id_konsumen   = trim(htmlspecialchars($_POST['id_konsumen']));
$nama_konsumen  = trim(htmlspecialchars($_POST['nama_konsumen']));
$alamat_konsumen  = trim(htmlspecialchars($_POST['alamat_konsumen']));
$hp = trim(htmlspecialchars($_POST['hp']));
$konsumen->input_konsumen($id_konsumen,$nama_konsumen,$alamat_konsumen,$hp);
header("location:../konsumen");
}

// ## konsumen-UPDATE
elseif($page == "update-konsumen"){
$id_konsumen   = trim(htmlspecialchars($_POST['id_konsumen']));
$nama_konsumen  = trim(htmlspecialchars($_POST['nama_konsumen']));
$alamat_konsumen  = trim(htmlspecialchars($_POST['alamat_konsumen']));
$hp = trim(htmlspecialchars($_POST['hp']));
$konsumen->update_konsumen($id_konsumen,$nama_konsumen,$alamat_konsumen,$hp);
header("location:../konsumen");
}

// ## konsumen-DELETE
elseif($page == "hapus-konsumen"){
$konsumen->hapus_konsumen($_GET['id']);
header("location:konsumen");
}
// ############################################ END MODULE KONSUMEN ############################################################

// ############################################ MODULE TRANSAKSI ############################################################
// ## TRANSAKSI-INPUT
elseif($page == "input-transaksi"){
$id_transaksi 	= trim(htmlspecialchars($_POST['id_transaksi']));
$id_paket  		= trim(htmlspecialchars($_POST['id_paket']));
$nama_konsumen  = trim(htmlspecialchars($_POST['nama_konsumen']));
$berat 			= trim(htmlspecialchars($_POST['berat']));
$harga 			= trim(htmlspecialchars($_POST['harga']));
$total 			= trim(htmlspecialchars($_POST['subtotaltxt']));
$transaksi->input_transaksi($id_transaksi,$id_paket,$nama_konsumen,$berat,$harga,$total,$datetimes_format);
header("location:../transaksi");
}

// ## TRANSAKSI-UPDATE
elseif($page == "update-transaksi"){
$id_transaksi 	= trim(htmlspecialchars($_POST['id_transaksi']));
$id_paket  		= trim(htmlspecialchars($_POST['id_paket']));
$nama_konsumen  = trim(htmlspecialchars($_POST['nama_konsumen']));
$berat 			= trim(htmlspecialchars($_POST['berat']));
$harga 			= trim(htmlspecialchars($_POST['harga']));
$total 			= trim(htmlspecialchars($_POST['subtotaltxt']));
$transaksi->update_transaksi($id_transaksi,$id_paket,$nama_konsumen,$berat,$harga,$total);
header("location:../transaksi");
}

// ## TRANSAKSI-DELETE
elseif($page == "hapus-transaksi"){
$transaksi->hapus_transaksi($_GET['id']);
header("location:transaksi");
}

// ## TRANSAKSI-UPDATE
elseif($page == "update-status"){
if($_GET['s']=='Closed'){
	$transaksi->update_status_if_closed($_GET['id'],$datetimes_format,$_GET['s']);
} else {
	$transaksi->update_status($_GET['id'],$_GET['s']);
}

header("location:transaksi");	
}
// ############################################ END MODULE TRANSAKSI ############################################################id_transaksi

?>