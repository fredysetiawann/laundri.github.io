<?php
date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
$hari = date("w");
$hari_ini = $seminggu[$hari];

$tgl_sekarang = date("Y-m-d");
$tgl_skrg     = date("d");
$bln_sekarang = date("m");
$thn_sekarang = date("Y");
$jam_sekarang = date("H:i:s");
$datetimes_format = date('Y-m-d H:i:s');
$nama_bln=array(1=> "Januari", "Februari", "Maret", "April", "Mei", 
                    "Juni", "Juli", "Agustus", "September", 
                    "Oktober", "November", "Desember");

class Database {
	// properti
	private $dbHost="localhost";
	private $dbUser="root";
	private $dbPass="";
	private $dbName="oop_laundri";
	
	// method koneksi mysql
	function connectMySQL() {
		mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		mysql_select_db($this->dbName) or die ("Database Tidak Ditemukan di Server"); 
	}
	// method today
	function tanggal_sekarang(){
		$tgl_sekarang = date("Ymd");
		return $tgl_sekarang;
	}



	function ymd_to_dmy($str) {
    if(str_replace(array("-", "/"), "", $str) == "")
        return "";
    return substr($str, 8, 2)."-".substr($str, 5, 2)."-".substr($str, 0, 4);
}

function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = $this->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
}	

function format_angka($angka) {
	$hasil = number_format($angka,0, ",",".");
	//$hasil = isset($hasil) ? $hasil : ''; 
	return $hasil;
}

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}

		//Buat kode otomatis
	 function buatkode($nomor_terakhir, $kunci, $jumlah_karakter = 0){
    $nomor_baru = intval(substr($nomor_terakhir, strlen($kunci))) + 1;
    $nomor_baru_plus_nol = str_pad($nomor_baru, $jumlah_karakter, "0", STR_PAD_LEFT);
    $kode = $kunci . $nomor_baru_plus_nol;
    return $kode;}

    function get_kode_oto($field,$table,$kode) {
    //GET Kode Otomastis.........
      $query = "select max($field) as maksi from $table";
      $hasil = mysql_query($query);
      $data_oto  = mysql_fetch_array($hasil);
      $kode_suplier= $this->buatkode($data_oto['maksi'], $kode, 4);
      return $kode_suplier;
  }

  	//Fungsi terbilang
 	function kekata($x) {
    $x = abs($x);
    $angka = array("", "satu", "dua", "tiga", "empat", "lima",
    "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($x <12) {
        $temp = " ". $angka[$x];
    } else if ($x <20) {
        $temp = $this->kekata($x - 10). " belas";
    } else if ($x <100) {
        $temp = $this->kekata($x/10)." puluh". $this->kekata($x % 10);
    } else if ($x <200) {
        $temp = " seratus" . $this->kekata($x - 100);
    } else if ($x <1000) {
        $temp = $this->kekata($x/100) . " ratus" . $this->kekata($x % 100);
    } else if ($x <2000) {
        $temp = " seribu" . $this->kekata($x - 1000);
    } else if ($x <1000000) {
        $temp = $this->kekata($x/1000) . " ribu" . $this->kekata($x % 1000);
    } else if ($x <1000000000) {
        $temp = $this->kekata($x/1000000) . " juta" . $this->kekata($x % 1000000);
    } else if ($x <1000000000000) {
        $temp = $this->kekata($x/1000000000) . " milyar" . $this->kekata(fmod($x,1000000000));
    } else if ($x <1000000000000000) {
        $temp = $this->kekata($x/1000000000000) . " trilyun" . $this->kekata(fmod($x,1000000000000));
    }     
        return $temp;
}
 
function terbilang($x, $style=4) {
    if($x<0) {
        $hasil = "minus ". trim($this->kekata($x));
    } else {
        $hasil = trim($this->kekata($x));
    }     
    switch ($style) {
        case 1:
            $hasil = strtoupper($hasil);
            break;
        case 2:
            $hasil = strtolower($hasil);
            break;
        case 3:
            $hasil = ucwords($hasil);
            break;
        default:
            $hasil = ucfirst($hasil);
            break;
    }     
    return $hasil;
}

//End Fungsi terbilang

}

class User {
// Proses Login
	function cek_login($username, $password) {
		$password = md5($password);
		$result = mysql_query("SELECT * FROM users WHERE username='$username' AND password='$password'");
		$user_data = mysql_fetch_array($result);
		$no_rows = mysql_num_rows($result);
		if ($no_rows == 1) {
			$_SESSION['login'] = TRUE;
			$_SESSION['id']    = $user_data['id_users'];
			$_SESSION['level'] = $user_data['level'];
			$_SESSION['nik']   = $user_data['nik'];
			return TRUE;
		}
		else {
		  return FALSE;
		}
	}

	
	 
	// Ambil Sesi 
	function get_sesi() {
		$session = isset($_SESSION['login']) ? $_SESSION['login'] : ''; 
		return $session;
	}


	// Logout 
	function user_logout() {
		$_SESSION['login'] = FALSE;
		session_destroy();
	}

	// ambil nama
	function ambilNama($id)
	{
		$query = mysql_query("SELECT * FROM users WHERE id_users='$id'");
		$row = mysql_fetch_array($query);
		echo $row['nama_users'];
	}

	// cek Nik
	function cekNik($nik)
	{
	// Cek NIK
		
		$result=mysql_query("SELECT nik FROM users WHERE nik='$nik'");
		$found=mysql_num_rows($result);
		return $found;
	
	}

		// cek nama
	function CekNama($kode){
		$result=mysql_query("SELECT * FROM users where nik ='$kode'");
		$found=mysql_num_rows($result);
	if($found>0){
    $row=mysql_fetch_array($result);{
	echo $row['nama_users'];
	}
 	}else{echo "";}
	}

	// tampilkan data dari tabel users 
	function tampil_data(){
		$data=mysql_query("SELECT * FROM users");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}


	// tampilkan data dari tabel users tertentu
	function tampil_data_based_on_nik($nik){
		$data=mysql_query("SELECT * FROM users WHERE nik='$nik'");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	// proses input data user
	function input_user($nik,$nama_users,$username,$pwd,$level){
		mysql_query("INSERT INTO users (nik,nama_users,username,password,level) VALUES ('$nik','$nama_users','$username','$pwd','$level')");
	}

	// tampilkan data dari tabel users yang akan di edit 
	function edit_user($id){
		$data=mysql_query("SELECT * FROM users WHERE id_users='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// proses update data user
	function update_user($id,$nik,$nama_users,$username,$pwd,$level){
		mysql_query("UPDATE users SET nik='$nik',nama_users='$nama_users',username='$username',password='$pwd',level='$level' WHERE id_users='$id'");
	}

	// proses delete data user
	function hapus_user($id){
		mysql_query("DELETE FROM users where id_users='$id'");
	}

	//cek jumlah karyawan
	function total_users() {
		$result = mysql_query("SELECT * FROM users");
		$no_rows = mysql_num_rows($result);
		return $no_rows;
	}

}

//Public Class Paket
class Paket{
// tampilkan data dari tabel paket 
	function tampil_data(){
		$data=mysql_query("SELECT * FROM paket");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}
// proses input data paket
	function input_paket($id_paket,$nama_paket,$harga_paket){
		mysql_query("INSERT INTO paket (id_paket,nama_paket,harga_paket) VALUES ('$id_paket','$nama_paket','$harga_paket')");
	}

	// tampilkan data dari tabel paket yang akan di edit 
	function edit_paket($id){
		$data=mysql_query("SELECT * FROM paket WHERE id_paket='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// Combo data paket
	function comboPaket(){
		$data=mysql_query("SELECT * FROM paket ORDER BY nama_paket");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}


	// proses update data paket
	function update_paket($id,$nama_paket,$harga_paket){
		mysql_query("UPDATE paket SET nama_paket='$nama_paket',harga_paket='$harga_paket' WHERE id_paket='$id'");
	}

	// proses delete data paket
	function hapus_paket($id){
		mysql_query("DELETE FROM paket where id_paket='$id'");
	}

	// cek nama
	function GetNamaPaket($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM paket where id_paket ='$id'"));
	echo $row['nama_paket'];
	}

}

//Public Class konsumen
class konsumen{
// tampilkan data dari tabel konsumen 
	function tampil_data(){
		$data=mysql_query("SELECT * FROM konsumen");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}
// proses input data konsumen
	function input_konsumen($id_konsumen,$nama_konsumen,$alamat_konsumen,$hp){
		mysql_query("INSERT INTO konsumen (id_konsumen,nama_konsumen,alamat_konsumen,hp) VALUES ('$id_konsumen','$nama_konsumen','$alamat_konsumen','$hp')");
	}

	// tampilkan data dari tabel konsumen yang akan di edit 
	function edit_konsumen($id){
		$data=mysql_query("SELECT * FROM konsumen WHERE id_konsumen='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// Combo data konsumen
	function comboKonsumen(){
		$data=mysql_query("SELECT * FROM konsumen ORDER BY nama_konsumen");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}


	// proses update data konsumen
	function update_konsumen($id,$nama_konsumen,$alamat_konsumen,$hp){
		mysql_query("UPDATE konsumen SET nama_konsumen='$nama_konsumen',alamat_konsumen='$alamat_konsumen',hp='$hp' WHERE id_konsumen='$id'");
	}

	// proses delete data konsumen
	function hapus_konsumen($id){
		mysql_query("DELETE FROM konsumen where id_konsumen='$id'");
	}

	// cek nama
	function GetNamaKonsumen($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM konsumen where id_konsumen ='$id'"));
	echo $row['nama_konsumen'];
	}

		// cek Alamat
	function GetAlamatKonsumen($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM konsumen where id_konsumen ='$id'"));
	echo $row['alamat_konsumen'];
	}

		// cek Alamat
	function GetHpKonsumen($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM konsumen where id_konsumen ='$id'"));
	echo $row['hp'];
	}

}


//Public Class transaksi
class Transaksi{
// tampilkan data dari tabel transaksi 
	function tampil_data(){
		$data=mysql_query("SELECT * FROM transaksi");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

	function tampil_data_date($dari,$ke){
		$data=mysql_query("SELECT * FROM transaksi WHERE LEFT(tanggal_masuk, 10) >= '$dari' AND LEFT(tanggal_masuk, 10) <= '$ke'");
		while($d=mysql_fetch_array($data)){
			$result[]=$d;
		}
		$result = isset($result) ? $result : ''; 
		return $result;
	}

// proses input data transaksi
	function input_transaksi($id_transaksi,$id_paket,$nama_konsumen,$berat,$harga,$total,$tanggal_masuk){
		mysql_query("INSERT INTO transaksi (id_transaksi,id_paket,nama_konsumen,berat,harga,total,tanggal_masuk) VALUES ('$id_transaksi','$id_paket','$nama_konsumen','$berat','$harga','$total','$tanggal_masuk')");
	}

	// tampilkan data dari tabel transaksi yang akan di edit 
	function edit_transaksi($id){
		$data=mysql_query("SELECT * FROM transaksi WHERE id_transaksi='$id'");
		while($x=mysql_fetch_array($data)){
			$hasil[]=$x;
		}
		return $hasil;
	}

	// proses update data transaksi
	function update_transaksi($id_transaksi,$id_paket,$nama_konsumen,$berat,$harga,$total,$tanggal_masuk){
		mysql_query("UPDATE transaksi SET id_paket='$id_paket',nama_konsumen='$nama_konsumen',berat='$berat',harga='$harga',total='$total' WHERE id_transaksi='$id_transaksi'");
	}

	// proses delete data transaksi
	function hapus_transaksi($id){
		mysql_query("DELETE FROM transaksi where id_transaksi='$id'");
	}

		// proses update data transaksi
	function update_status($id_transaksi,$status){
		mysql_query("UPDATE transaksi SET status='$status' WHERE id_transaksi='$id_transaksi'");
	}

		// proses update data transaksi jika status closed
	function update_status_if_closed($id_transaksi,$datetimes_format,$status){
	mysql_query("UPDATE transaksi SET tanggal_ambil='$datetimes_format',status='$status' WHERE id_transaksi='$id_transaksi'");
		}

		// cek nama
	function GetNamaKonsumen($id){
    $row=mysql_fetch_array(mysql_query("SELECT * FROM transaksi where id_transaksi ='$id'"));
	echo $row['nama_konsumen'];
	}

	//cek jumlah Transaksi Open
	function total_open() {
		$result = mysql_query("SELECT * FROM transaksi WHERE status='Open'");
		$no_rows = mysql_num_rows($result);
		return $no_rows;
	}
}


class QRGenerator { 

    protected $size; 
    protected $data; 
    protected $encoding; 
    protected $errorCorrectionLevel; 
    protected $marginInRows; 
    protected $debug; 

    public function __construct($data='http://www.phpgang.com',$size='300',$encoding='UTF-8',$errorCorrectionLevel='L',$marginInRows=4,$debug=false) { 

        $this->data=urlencode($data); 
        $this->size=($size>100 && $size<800)? $size : 100; 
        $this->encoding=($encoding == 'Shift_JIS' || $encoding == 'ISO-8859-1' || $encoding == 'UTF-8') ? $encoding : 'UTF-8'; 
        $this->errorCorrectionLevel=($errorCorrectionLevel == 'L' || $errorCorrectionLevel == 'M' || $errorCorrectionLevel == 'Q' || $errorCorrectionLevel == 'H') ?  $errorCorrectionLevel : 'L';
        $this->marginInRows=($marginInRows>0 && $marginInRows<10) ? $marginInRows:4; 
        $this->debug = ($debug==true)? true:false;     
    }
public function generate(){ 

        $QRLink = "https://chart.googleapis.com/chart?cht=qr&chs=".$this->size."x".$this->size.                            "&chl=" . $this->data .  
                   "&choe=" . $this->encoding . 
                   "&chld=" . $this->errorCorrectionLevel . "|" . $this->marginInRows; 
        if ($this->debug) echo   $QRLink;          
        return $QRLink; 
    }

  }
