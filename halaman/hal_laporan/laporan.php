<?php
$db= new database();
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil absensi
  default:
    
    echo"<div class='row-fluid'>
      <div class='span6'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-copy'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
          <!-- FORM TAMBAH ABASEN -->
         <form class='form-horizontal' method='post' action='tampil-laporan/' name='add_data_validate' id='add_data_validate' novalidate='novalidate' target='_blank'>
             <table class='table table-bordered table-striped'>
              <tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Semua Data' checked=''/>Semua Data</label></td>
                <td>Semua Data</td>
              </tr>
              <tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Tanggal'>Range Tanggal</label></td>
                <td>

                <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$tgl_sekarang' class='datepicker span11'  name='dari'>
                <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$tgl_sekarang' class='datepicker span11'  name='ke'>
                <span class='help-block'>Date with Formate of  (yyyy-mm-dd)</span> 
                  </td>
              </tr>
              
            </table>
                
             
              <div class='form-actions'>
                <input type='submit' value='Tampilkan' class='btn btn-success'>
              </div>
            </form>
         <!-- FORM TAMBAH ABASEN -->



            
          </div>
        </div>
      </div>
      </div>";

  break;  

   
   } 
 ?>   
    
      </div>   
  </div>
