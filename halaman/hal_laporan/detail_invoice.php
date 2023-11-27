<?php
include_once '../../config/class.php';
$db= new Database();
$transaksi= new Transaksi();
$paket= new Paket();
$konsumen= new Konsumen();
// koneksi ke MySQL via method
$db->connectMySQL();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Invoice / Nota Laundri</title>
    <link rel="stylesheet" href="halaman/hal_laporan/style.css" media="all" />
  </head>
  <body onload='print()'>
    <header class="clearfix">
      <div id="logo">
        <img src="halaman/hal_laporan/logo.png">
      </div>
      <h1>INVOICE - <?php echo $_GET['id'];?></h1>
      <div id="company" class="clearfix">
        <div>Laundry Online</div>
        <div>Jl Kemerdekaan No.1945, Kav.2<br /> Yogyakarta</div>
        <div>0818956973</div>
        <div><a href="mailto:webmaster@sixghakreasi.com">webmaster@sixghakreasi.com</a></div>
      </div>
     <?php
      foreach($transaksi->edit_transaksi($_GET['id']) as $d){
     echo" <div id='project'>
        <div><span>Nama</span>";?> <?php echo $konsumen->GetNamaKonsumen($d['nama_konsumen']); ?> <?php echo"</div>
        <div><span>No. Telp</span>";?> <?php echo $konsumen->GetHpKonsumen($d['nama_konsumen']); ?> <?php echo"</div>
        <div><span>Alamat</span>";?> <?php echo $konsumen->GetAlamatKonsumen($d['nama_konsumen']); ?> <?php echo"</div>
        <div><span>Tgl Masuk</span> $d[tanggal_masuk]</div>
        <div><span>Tgl Selesai</span>".($d['tanggal_ambil'] == '0000-00-00 00:00:00' ? "-" : "$d[tanggal_ambil]")."</div>
      </div>";
    }
     ?>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">No</th>
            <th class="desc">JENIS LAYANAN</th>
            <th class='unit'>HARGA/KG</th>
            <th class='qty'>QTY/KG</th>
            <th class='total'>JUMLAH</th>
          </tr>
        </thead>
        <tbody>
        <?php
           $no=1;
           $arr=$transaksi->edit_transaksi($_GET['id']);
           foreach($arr ? $arr : [] as $d):
           echo"<tr>
            <td class='service'>#1</td>
            <td class='desc'>"; ?> <?php echo $paket->GetNamaPaket($d['id_paket']); ?> <?php echo"</td>
            <td class='unit'><center>".$db->format_angka($d['harga'])."</center></td>
            <td class='qty'><center>".$db->format_angka($d['berat'])."</center></td>
            <td class='total'><center>Rp. ".$db->format_angka($d['total'])."</center></td>
          </tr>";
           $no++;
          endforeach;
          ?>

          <tr>
            <td class='service'>#2</td>
            <td class='desc'></td>
            <td class='unit'></td>
            <td class='qty'></td>
            <td class='total'>-</td>
          </tr>
           <tr>
            <td class='service'>#3</td>
            <td class='desc'></td>
            <td class='unit'></td>
            <td class='qty'></td>
            <td class='total'>-</td>
          </tr>
      
          <tr>
            <td colspan="3" class="joss total"><i><?php echo strtoupper($db->terbilang($d['total'], $style=4)); ?> RUPIAH</i></td>
            <td class="grand total">GRAND TOTAL</td>
            <td class="grand total"><center>Rp. <?php echo $db->format_angka($d['total']); ?></center></td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div>KETERANGAN:</div>
        <div class="notice">1. Pengambilan cucian harus membawa nota</div>
        <div class="notice">2. Cucian Luntur bukan tanggung jawab kami</div>
        <div class="notice">3. Hitung dan periksa sebelum pergi</div>
        <div class="notice">4. klaim kekurangan/kehilangan cucian setelah meninggalkan laundri tidak dilayani</div>
        <div class="notice">5. Cucian yang rusak/mengkerut karena sifat kain tidak dapat kami ganti</div>
        <div class="notice">6. Cucian yang tidak diambil lebih dari 1 bulan bukan tanggung jawab kami</div>
        <div class="notice">7. Maximal penggantian 10x dari total invoice dan barang menjadi milik kami</div>
      </div>
    </main>
    <footer>
      <i>Terima kasih atas kepercayaan dan kunjungan anda.</i>
    </footer>
  </body>
</html>