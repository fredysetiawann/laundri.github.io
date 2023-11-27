<?php
// Bagian home
if ($_GET['page']=='home'){
  include "halaman/hal_home/home.php";
}

// Bagian users
elseif ($_GET['page']=='users'){
  include "halaman/hal_user/users.php";
}


// Bagian paket
elseif ($_GET['page']=='paket'){
  include "halaman/hal_paket/paket.php";
}

// Bagian konsumen
elseif ($_GET['page']=='konsumen'){
  include "halaman/hal_konsumen/konsumen.php";
}

// Bagian transaksi
elseif ($_GET['page']=='transaksi'){
  include "halaman/hal_transaksi/transaksi.php";
}


// Bagian laporan
elseif ($_GET['page']=='laporan'){
  include "halaman/hal_laporan/laporan.php";
}

// Bagian laporan
elseif ($_GET['page']=='detail-invoice'){
  include "halaman/hal_laporan/detail_invoice.php";
}

// Bagian laporan
elseif ($_GET['page']=='detail'){
  include "halaman/hal_user/detail.php";
}

?>
