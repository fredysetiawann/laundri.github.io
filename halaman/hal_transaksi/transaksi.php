<?php
$db= new database();
$transaksi= new Transaksi();
$paket= new Paket();
$konsumen= new Konsumen();
?>

<script language=Javascript>
function subtotal(qty){
var hitung = (document.getElementById('harga').value * document.getElementById('qty').value);
  document.forms.add_transaksi_validate.subtotaltxt.value = hitung;
}

function subtotal(joss){
var hitung = (document.getElementById('harga').value * document.getElementById('qty').value);
  document.forms.add_transaksi_validate.subtotaltxt.value = hitung;
}

</script> 

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil transaksi
  default:
    
    echo"<div class='row-fluid'>
      <div class='span12'>
      <a href='tambah-transaksi' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table'>
              <thead>
                <tr>
                  <th width='5%'>No</th>
                  <th>Tanggal Masuk</th>
                   <th>No Transaksi</th>
                  <th>Nama Konsumen</th>
                  <th>Paket</th>
                  <th>Berat</th>
                  <th>Harga /KG</th>
                  <th>Grand Total</th>
                   <th>Tanggal Ambil</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$transaksi->tampil_data();
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td><center>$no</center></td>
                  <td><center>$d[tanggal_masuk]</center></td>
                  <td><center><a href='detail-invoice-$d[id_transaksi]' target='_blank'>$d[id_transaksi]</a></center></td>
                  <td>"; ?> <?php echo $konsumen->GetNamaKonsumen($d['nama_konsumen']); ?> <?php echo"</td>
                  <td>"; ?> <?php echo $paket->GetNamaPaket($d['id_paket']); ?> <?php echo"</td>
                  <td><center>".$db->format_angka($d['berat'])."</center></td>
                  <td><center>".$db->format_angka($d['harga'])."</center></td>
                  <td><center>".$db->format_angka($d['total'])."</center></td>
                  <td><center>".($d['tanggal_ambil'] == '0000-00-00 00:00:00' ? "-" : "$d[tanggal_ambil]")."</center></td>
                  <td><center>";
              if($d['status']=='Open'){
              echo"<div class='btn-group'>
              <button data-toggle='dropdown' class='btn btn-mini btn-danger dropdown-toggle'>Open <span class='caret'></span></button>
              <ul class='dropdown-menu'>
                <li><a href='update-status-$d[id_transaksi]-On Proses'>On Proses</a></li>
              </ul>
            </div>";
              }

               elseif($d['status']=='On Proses'){
              echo"<div class='btn-group'>
              <button data-toggle='dropdown' class='btn btn-mini btn-warning dropdown-toggle'>On Proses <span class='caret'></span></button>
              <ul class='dropdown-menu'>
                <li><a href='update-status-$d[id_transaksi]-Open'>Open</a></li>
                <li><a href='update-status-$d[id_transaksi]-Closed'>Sudah Diambil</a></li>
              
              </ul>
            </div>";
              }

               elseif($d['status']=='Closed'){
              echo"<div class='btn-group'>
              <button data-toggle='dropdown' class='btn btn-mini btn-success dropdown-toggle'>Closed <span class='caret'></span></button>
            </div>";
              }
              

                  echo"</center></td>

                  <td><center>";
                  if($d['status'] <>'Closed'){
                  echo"<a class='tip' href='edit-transaksi-$d[id_transaksi]' title='Edit Task'><i class='icon-pencil'></i></a> 
                                     <a class='tip' href='hapus-transaksi-$d[id_transaksi]' title='Delete'><i class='icon-remove'></i></a>"; }
                  echo"</center></td>
                </tr>";
                $no++;
               endforeach;
              
                
              echo"</tbody>
            </table>
            <br/>
            <p>&nbsp;&nbsp;&nbsp;NB : </p>
            <table class='table table-bordered table-striped'>
              <thead>
                <tr>
                  <th>Labels Status</th>
                  <th>Keterangan</th>
                </tr>
              </thead>
              <tbody>
               <tr>
                  <td><span class='label label-important'>Open</span></td>
                  <td><code>Barang/cucian belum diproses</code></td>
                  </tr>

                  <tr>
                  <td><span class='label label-warning'>On Proses</span></td>
                  <td><code>Barang/cucian dalam proses</code></td>
                </tr>
                <tr>
                  <td><span class='label label-success'>Closed</span></td>
                  <td><code>Barang/cucian sdh diambil oleh konsumen/kustomer</code></td>
                </tr>
                

              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>";

  break;  

  
   case "tambah":

    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-transaksi/' name='add_transaksi_validate' id='add_transaksi_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>No Transaksi</label>
                <div class='controls'>
                  <input type='text' name='id_transaksi' id='id_transaksi' class='span5' maxlength='5' value='".$db->get_kode_oto('id_transaksi','transaksi','T')."' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama Konsumen</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="nama_konsumen" id="nama_konsumen" class="span5">'; 
                echo"<option value=0>Pilih Konsumen</option>";
      //Tampilkan combo 
      $ddd=$konsumen->comboKonsumen();
      foreach($ddd as $f){ 
      echo '<option value="' . $f['id_konsumen'] . '">' .$f['nama_konsumen'].'</option>'; }    
                echo"</select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Jenis Paket</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="id_paket" id="joss" class="span5" onchange="document.getElementById(\'harga\').value = prdName[this.value],subtotal(this.value,getElementById(\'joss\').value);">'; 
                echo"<option value=0>Pilih Paket</option>";
      //Tampilkan combo
      $xcd=$paket->comboPaket();
      foreach($xcd as $y){ 
      echo '<option value="' . $y['id_paket'] . '">' .$y['nama_paket'].'</option>'; 
      $jsArray .= "prdName['" . $y['id_paket'] . "'] = '" . addslashes($y['harga_paket']) . "';\n"; 

    }    
                echo"</select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Harga</label>
                <div class='controls'>
                  <input name=\"harga\" type=\"text\" id=\"harga\" class='span2' readonly='yes'/>
                  <script type='text/javascript'>$jsArray</script></div>
              </div>


              <div class='control-group'>
                <label class='control-label'>Berat</label>
                <div class='controls'>
                  <input type='number' name='berat' id='qty' class='span2' maxlength='5' onchange=\"subtotal(this.value,getElementById('qty').value);\"> /KG
                </div>
              </div>

               <div class='control-group'>
                <label class='control-label'>Total</label>
                <div class='controls'>
                  <input type='number' name='subtotaltxt' id='subtotaltxt' class='span2' readonly='yes'>
                </div>
              </div>
              
              <div class='form-actions'>
                <input type='submit' value='Validate' class='btn btn-success'>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>";
   break;

    case "edit":
   foreach($transaksi->edit_transaksi($_GET['id']) as $d){
    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
            <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='update-transaksi/' name='add_transaksi_validate' id='add_transaksi_validate' novalidate='novalidate'>
                  <div class='control-group'>
                <label class='control-label'>No Transaksi</label>
                <div class='controls'>
                  <input type='text' name='id_transaksi' id='id_transaksi' class='span5' maxlength='5' value='$d[id_transaksi]' readonly='yes'>
                </div>
              </div>

               <div class='control-group'>
                <label class='control-label'>Nama Konsumen</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="nama_konsumen" id="nama_konsumen" class="span5">';
                if ($d[nama_konsumen]==''){echo"<option value=0>Pilih Konsumen</option>"; } 
      //Tampilkan combo 
      $ddd=$konsumen->comboKonsumen();
      foreach($ddd as $f){ 
       if ($d[nama_konsumen]==$f[id_konsumen]){
      echo '<option value="' . $f['id_konsumen'] . '" selected>' .$f['nama_konsumen'].'</option>'; }
      else {
      echo '<option value="' . $f['id_konsumen'] . '">' .$f['nama_konsumen'].'</option>'; 
      } 
    }
                echo"</select>
                </div>
              </div>

             

              <div class='control-group'>
                <label class='control-label'>Jenis Paket</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="id_paket" id="joss" class="span5" onchange="document.getElementById(\'harga\').value = prdName[this.value],subtotal(this.value,getElementById(\'joss\').value);">'; 
                 if ($d[id_paket]==''){echo"<option value=0>Pilih Paket</option>"; } 
      //Tampilkan combo
      $xcd=$paket->comboPaket();
      foreach($xcd as $y){ 
         if ($d[id_paket]==$y[id_paket]){
      echo '<option value="' . $y['id_paket'] . '" selected>' .$y['nama_paket'].'</option>'; 
      $jsArray .= "prdName['" . $y['id_paket'] . "'] = '" . addslashes($y['harga_paket']) . "';\n"; 
      } else{
                  echo '<option value="' . $y['id_paket'] . '">' .$y['nama_paket'].'</option>'; 
      $jsArray .= "prdName['" . $y['id_paket'] . "'] = '" . addslashes($y['harga_paket']) . "';\n"; }
               }    

        
                echo"</select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Harga</label>
                <div class='controls'>
                  <input name=\"harga\" type=\"text\" id=\"harga\" class='span2' readonly='yes' value='$d[harga]'/>
                  <script type='text/javascript'>$jsArray</script></div>
              </div>



              <div class='control-group'>
                <label class='control-label'>Berat</label>
                <div class='controls'>
                  <input type='number' name='berat' id='qty' value='$d[berat]' class='span2' maxlength='5' onchange=\"subtotal(this.value,getElementById('qty').value);\"> /KG
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Total</label>
                <div class='controls'>
                  <input type='number' name='subtotaltxt' value='$d[total]' id='subtotaltxt' class='span2' readonly='yes'>
                </div>
              </div>
              
              <div class='form-actions'>
                <input type='submit' value='Validate' class='btn btn-success'>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>";
    }

   break; 
   } 
 ?>   
    
      </div>   
  </div>
