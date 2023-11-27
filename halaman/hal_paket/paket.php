<?php
$db= new database();
$paket= new Paket();
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil paket
  default:
    
    echo"<div class='row-fluid'>
      <div class='span12'>
      <a href='tambah-paket' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-camera-retro'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table'>
              <thead>
                <tr>
                  <th width='5%'>No</th>
                  <th>Kode Paket</th>
                  <th>Nama Paket</th>
                  <th>Harga Paket</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$paket->tampil_data();
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td><center>$no</center></td>
                  <td><center>$d[id_paket]</center></td>
                  <td>$d[nama_paket]</td>
                  <td><center>".$db->format_angka($d['harga_paket'])."</center></td>
                  <td><center><a class='tip' href='edit-paket-$d[id_paket]' title='Edit Task'><i class='icon-pencil'></i></a> 
                                     <a class='tip' href='hapus-paket-$d[id_paket]' title='Delete'><i class='icon-remove'></i></a></center></td>
                </tr>";
                $no++;
               endforeach;
              
                
              echo"</tbody>
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
          <div class='widget-title'> <span class='icon'> <i class='icon-camera-retro'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-paket/' name='add_paket_validate' id='add_paket_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>Kode Paket</label>
                <div class='controls'>
                  <input type='text' name='id_paket' id='id_paket' class='span5' maxlength='5' value='".$db->get_kode_oto('id_paket','paket','P')."' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama Paket</label>
                <div class='controls'>
                  <input type='text' name='nama_paket' id='nama_paket' class='span5' maxlength='20'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Harga Paket</label>
                <div class='controls'>
                  <input type='number' name='harga_paket' id='harga_paket' class='span5'>
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
   foreach($paket->edit_paket($_GET['id']) as $d){
    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-camera-retro'></i> </span>
            <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='update-paket/' name='add_paket_validate' id='add_paket_validate' novalidate='novalidate'>
                  <div class='control-group'>
                <label class='control-label'>id_paket</label>
                <div class='controls'>
                  <input type='text' name='id_paket' id='id_paket' class='span5' maxlength='5' value='$d[id_paket]' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama Paket</label>
                <div class='controls'>
                  <input type='text' name='nama_paket' id='nama_paket' value='$d[nama_paket]' class='span5' maxlength='20'>
                </div>
              </div>
              <div class='control-group'>
                <label class='control-label'>Harga Paket</label>
                <div class='controls'>
                  <input type='number' name='harga_paket' id='harga_paket' value='$d[harga_paket]' class='span5' maxlength='5'>
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
