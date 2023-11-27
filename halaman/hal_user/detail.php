<?php
session_start();
include_once '../../config/class.php';

$db = new Database();
$user= new User();
// mengambil class untuk Generate QR code 
$QRCODE = new QRGenerator($_GET['id'],100,'ISO-8859-1'); 
// koneksi ke MySQL via method
$db->connectMySQL();

?>
<style type="text/css">
body {
      background-color: #d7d6d3;
      font-family:'verdana';
    }
    .id-card-holder {
      width: 225px;
        padding: 4px;
        margin: 0 auto;
        background-color: #1f1f1f;
        border-radius: 5px;
        position: relative;
    }
    .id-card-holder:after {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        border-radius: 0 5px 5px 0;
    }
    .id-card-holder:before {
        content: '';
        width: 7px;
        display: block;
        background-color: #0a0a0a;
        height: 100px;
        position: absolute;
        top: 105px;
        left: 222px;
        border-radius: 5px 0 0 5px;
    }
    .id-card {
      
      background-color: #fff;
      padding: 10px;
      border-radius: 10px;
      text-align: center;
      box-shadow: 0 0 1.5px 0px #b9b9b9;
    }
    .id-card img {
      margin: 0 auto;
    }
    .header img {
      width: 100px;
        margin-top: 15px;
    }
    .photo img {
      width: 100px;
        margin-top: 15px;
    }
    h2 {
      font-size: 15px;
      margin: 5px 0;
    }
    h3 {
      font-size: 12px;
      margin: 2.5px 0;
      font-weight: 300;
    }
    .qr-code img {
      width: 50px;
    }
    p {
      font-size: 5px;
      margin: 2px;
    }
    .id-card-hook {
      background-color: #000;
        width: 70px;
        margin: 0 auto;
        height: 15px;
        border-radius: 5px 5px 0 0;
    }
    .id-card-hook:after {
      content: '';
        background-color: #d7d6d3;
        width: 47px;
        height: 6px;
        display: block;
        margin: 0px auto;
        position: relative;
        top: 6px;
        border-radius: 4px;
    }
    .id-card-tag-strip {
      width: 45px;
        height: 40px;
        background-color: #0950ef;
        margin: 0 auto;
        border-radius: 5px;
        position: relative;
        top: 9px;
        z-index: 1;
        border: 1px solid #0041ad;
    }
    .id-card-tag-strip:after {
      content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #c1c1c1;
        position: relative;
        top: 10px;
    }
    .id-card-tag {
      width: 0;
      height: 0;
      border-left: 100px solid transparent;
      border-right: 100px solid transparent;
      border-top: 100px solid #0958db;
      margin: -10px auto -30px auto;
    }
    .id-card-tag:after {
      content: '';
        display: block;
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-top: 100px solid #d7d6d3;
        margin: -10px auto -30px auto;
        position: relative;
        top: -130px;
        left: -50px;
    }
</style>




<div class="id-card-tag"></div>
  <div class="id-card-tag-strip"></div>
  <div class="id-card-hook"></div>
  <div class="id-card-holder">
    <div class="id-card">
      <div class="header">
        <img src="halaman/hal_user/LOGO NEW.png">
      </div>
      <div class="photo">
        <img src="halaman/hal_user/XXX.png">
      </div>
      <h2><?php echo $user->CekNama($_GET['id']); ?></h2>
      <div class="qr-code">
        <?php echo "<img src=".$QRCODE->generate().">"; ?>
      </div>
      <h3><?php echo"$_GET[id]"; ?></h3>
      <hr>
      <p><strong>"Sixghakreasi.com"</strong>Madigondo 26/10 Sidoharjo <p>
      <p>Samigaluh, Kulon Progo, DI Yogyakarta <strong>55673</strong></p>
      <p>Hp: 0818956973 | E-mail: webmaster@sixghakreasi.com</p>

    </div>
  </div>