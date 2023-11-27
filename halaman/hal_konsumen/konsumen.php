<?php
$db= new database();
$konsumen= new Konsumen();
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil konsumen
  default:
    
    echo"<div class='row-fluid'>
      <div class='span12'>
      <a href='tambah-konsumen' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-group'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table'>
              <thead>
                <tr>
                  <th width='5%'>No</th>
                  <th>Kode konsumen</th>
                  <th>Nama konsumen</th>
                   <th>Alamat</th>
                  <th>HP</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$konsumen->tampil_data();
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td><center>$no</center></td>
                  <td><center>$d[id_konsumen]</center></td>
                  <td>$d[nama_konsumen]</td>
                  <td>$d[alamat_konsumen]</td>
                  <td><center>$d[hp]</center></td>
                  <td><center><a class='tip' href='edit-konsumen-$d[id_konsumen]' title='Edit Task'><i class='icon-pencil'></i></a> 
                                     <a class='tip' href='hapus-konsumen-$d[id_konsumen]' title='Delete'><i class='icon-remove'></i></a></center></td>
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
          <div class='widget-title'> <span class='icon'> <i class='icon-group'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-konsumen/' name='add_konsumen_validate' id='add_konsumen_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>Kode konsumen</label>
                <div class='controls'>
                  <input type='text' name='id_konsumen' id='id_konsumen' class='span5' maxlength='5' value='".$db->get_kode_oto('id_konsumen','konsumen','K')."' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama konsumen</label>
                <div class='controls'>
                  <input type='text' name='nama_konsumen' id='nama_konsumen' class='span5' maxlength='20'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Alamat konsumen</label>
                <div class='controls'>
                  <textarea class='span5' name='alamat_konsumen' id='alamat_konsumen'></textarea>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>HP</label>
                <div class='controls'>
                  <input type='number' name='hp' id='hp' class='span5'>
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
   foreach($konsumen->edit_konsumen($_GET['id']) as $d){
    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-group'></i> </span>
            <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='update-konsumen/' name='add_konsumen_validate' id='add_konsumen_validate' novalidate='novalidate'>
                  <div class='control-group'>
                <label class='control-label'>id_konsumen</label>
                <div class='controls'>
                  <input type='text' name='id_konsumen' id='id_konsumen' class='span5' maxlength='5' value='$d[id_konsumen]' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama konsumen</label>
                <div class='controls'>
                  <input type='text' name='nama_konsumen' id='nama_konsumen' value='$d[nama_konsumen]' class='span5' maxlength='20'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Alamat konsumen</label>
                <div class='controls'>
                <textarea class='span5' name='alamat_konsumen' id='alamat_konsumen'>$d[alamat_konsumen]</textarea>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>HP</label>
                <div class='controls'>
                  <input type='number' name='hp' id='hp' value='$d[hp]' class='span5' maxlength='5'>
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
