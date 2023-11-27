<?php
session_start();
include_once '../../config/class.php';
$db = new Database();
$user= new User();
$transaksi= new Transaksi();
$paket= new Paket();
$konsumen= new Konsumen();
// koneksi ke MySQL via method
$db->connectMySQL();
?>
<html>
<head>
<title> :: LAPORAN TRANSAKSI</title>
<style type="text/css">
body,td,td {
  font-family: Courier New, Courier, monospace;
}
body{
  
  font-size:12px;
  color:#333;
  background-position:top;
  background-color:#fff;
}
.table-list {
  clear: both;
  text-align: left;
  border-collapse: collapse;
  margin: 0px 0px 10px 0px;
  background:#fff;  
}
.table-list td {
  color: #333;
  font-size:11px;
  border-color: #fff;
  border-collapse: collapse;
  vertical-align: center;
  border:1px #CCCCCC solid;
}
-->
</style>
</head>
<body>
<center>
<h2> LAPORAN DATA TRANSAKSI LAUNDRI</h2>

<?php 
echo"<table class='table-list'>
              <thead>
                <tr>
                  <td style=\"color:#FFF; background-color:#DC143C;\" width='5%' align='center'>No</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">Tanggal Masuk</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">No Transaksi</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">Nama Konsumen</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">Paket</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">Berat</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">Harga /KG</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">Grand Total</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\">Tanggal Ambil</td>
                  <td style=\"color:#FFF; background-color:#DC143C;\" align='center'>Status</td>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               if($_POST['berdasar'] == "Semua Data"){
               $arr=$transaksi->tampil_data();
                } else {
               $arr=$transaksi->tampil_data_date($_POST['dari'],$_POST['ke']);   
               echo"$_POST[dari] s/d $_POST[ke]";
                }
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td><center>$no</center></td>
                  <td><center>$d[tanggal_masuk]</center></td>
                  <td><center>$d[id_transaksi]</center></td>
                  <td>"; ?> <?php echo $konsumen->GetNamaKonsumen($d['nama_konsumen']); ?> <?php echo"</td>
                  <td>"; ?> <?php echo $paket->GetNamaPaket($d['id_paket']); ?> <?php echo"</td>
                  <td><center>".$db->format_angka($d['berat'])."</center></td>
                  <td><center>".$db->format_angka($d['harga'])."</center></td>
                  <td><center>".$db->format_angka($d['total'])."</center></td>
                  <td><center>".($d['tanggal_ambil'] == '0000-00-00 00:00:00' ? "-" : "$d[tanggal_ambil]")."</center></td>
                  <td align='center'>$d[status]</td>
                </tr>";
                $no++;
               endforeach;
              
                
              echo"</tbody>
            </table>";
?>
</body>
</html>