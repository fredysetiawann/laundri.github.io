<?php
$db= new database();
$user= new User();
$trans= new Transaksi();
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> </div>
  </div>
  <div class="container-fluid">
  
  <!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
      <?php if ($_SESSION['level'] =='admin'){ ?>
        <li class="bg_lb span2"> <a href="home"> <i class="icon-home"></i> Home </a> </li>
        <li class="bg_lg span3"> <a href="transaksi"> <i class="icon-dashboard"></i> <span class="label label-info"><?php echo $trans->total_open(); ?></span>Total Transaksi Open</a> </li>
        <li class="bg_lo span2"> <a href="users"> <i class="icon-group"></i><span class="label label-warning"><?php echo $user->total_users(); ?></span> Total User </a> </li>
        
        <li class="bg_ls span3"> <a href="laporan"> <i class="icon-copy"></i> Laporan</a> </li>
         <?php } else {?>
          <li class="bg_lb span2"> <a href="home"> <i class="icon-home"></i> My Home </a> </li>
          <li class="bg_lg span3"> <a href="transaksi"> <i class="icon-dashboard"></i> <span class="label label-info"><?php echo $trans->total_open(); ?></span>Total Transaksi Open</a> </li>
           <?php }?>
      </ul>
    </div>
<!--End-Action boxes-->    
 <div class="widget-box collapsible">
          <div class="widget-title"> <a data-toggle="collapse" href="#collapseOne"> <span class="icon"><i class="icon-arrow-right"></i></span>
            <h5>APAKAH APLIKASI LAUNDRY ONLINE ?</h5>
            </a> </div>
          <div id="collapseOne" class="collapse">
            <div class="widget-content"> APLIKASI LAUNDRY ONLINE adalah softwere aplikasi laundry berbasis website admin (untuk admin pengelola), dengan tujuan agar memudahkan pengusaha laundry dalam mengelola order dan melihat pendapatan mereka per bulan.  </div>
          </div>
          <div class="widget-title"> <a data-toggle="collapse" href="#collapseTwo"> <span class="icon"><i class="icon-arrow-right"></i></span>
            <h5>APAKAH FITUR APLIKASI LAUNDRY ONLINE DAPAT DI KUSTOMISASI ?</h5>
            </a> </div>
          <div id="collapseTwo" class="collapse">
            <div class="widget-content"> Laundri Online sangat fleksibel dan fiturnya dapat di kustomisasi, jika perusahaan membutuhan produk laundri yang dikustomasi silahkan hubungi kami melalui <a href='webmaster@sixghakreasi.com' target="_blank">webmaster@sixghakreasi.com</a></div>
          </div>
          <div class="widget-title"> <a data-toggle="collapse" href="#collapseThree"> <span class="icon"><i class="icon-arrow-right"></i></span>
            <h5>APA SAJA MANFAAT MENGGUNAKAN APLIKASI LAUNDRY ONLINE ?</h5>
            </a> </div>
          <div id="collapseThree" class="collapse">
            <div class="widget-content"> Beberapa keuntungan yang Perusahaan dapatkan dari menggunakan Laundry Online antara lain :<br/>

1. Meningkatkan pelayanan dengan cepat dan efisien.<br/>
2. Mempermudah pengontrolan data.<br/>
3. Mempermudah proses pengumpulan data dan langsung menjadi laporan yang akurat.<br/>
4. Menyediakan laporan tepat pada waktunya.<br/>
5. Mempercepat proses pengambilan keputusan.<br/>
6. Menghemat tenaga kerja dan waktu.<br/>
7. Meningkatkan pelayanan perusahaan yang lebih professional.<br/>
8. Meningkatkan produktivitas yang lebih tinggi untuk keperluan usaha Laundry Anda.<br/>

 </div>
          </div>
        </div>
    
      </div>   
  </div>

   </div>
