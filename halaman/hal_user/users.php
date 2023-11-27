<?php
$db= new database();
$user= new User();
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
 $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil User
  default:
    
    echo"<div class='row-fluid'>
      <div class='span12'>
      <a href='tambah-user' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-user'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table'>
              <thead>
                <tr>
                  <th width='5%'>No</th>
                  <th>NIK</th>
                  <th>Nama Users</th>
                  <th>Username</th>
                  <th>Level</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$user->tampil_data();
               foreach($arr ? $arr : [] as $d){
                echo"<tr class='odd gradeA'>
                  <td><center>$no</center></td>
                  <td><a href='detail-user-$d[nik]'>$d[nik]</a></td>
                  <td>$d[nama_users]</td>
                  <td>$d[username]</td>
                  <td><center>$d[level]</center></td>
                  <td><center><a class='tip' href='edit-user-$d[id_users]' title='Edit Task'><i class='icon-pencil'></i></a> 
                                     <a class='tip' href='hapus-user-$d[id_users]/' title='Delete'><i class='icon-remove'></i></a></center></td>
                </tr>";
                $no++;
               }
              
                
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
          <div class='widget-title'> <span class='icon'> <i class='icon-user'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-user/' name='add_users_validate' id='add_users_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>NIK</label>
                <div class='controls'>
                  <input type='text' name='nik' id='nik' class='span5' maxlength='5' value='".$db->get_kode_oto('nik','users','P')."' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Your Name</label>
                <div class='controls'>
                  <input type='text' name='nama_users' id='nama_users' class='span5' maxlength='20'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Your username</label>
                <div class='controls'>
                  <input type='text' name='username' id='username' class='span5' maxlength='10'>
                </div>
              </div>
              <div class='control-group'>
                <label class='control-label'>level</label>
                <div class='controls'>
                  <select name='level' id='level' class='span5'>
                  <option>admin</option>
                  <option>user</option>
                </select>
                </div>
              </div>
              <div class='control-group'>
                  <label class='control-label'>Password</label>
                  <div class='controls'>
                    <input type='password' name='pwd' id='pwd' class='span5' maxlength='7'/>
                  </div>
                </div>
                <div class='control-group'>
                  <label class='control-label'>Confirm password</label>
                  <div class='controls'>
                    <input type='password' name='pwd2' id='pwd2' class='span5' maxlength='7'/>
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
   foreach($user->edit_user($_GET['id']) as $d){
    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-user'></i> </span>
            <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='update-user/' name='add_users_validate' id='add_users_validate' novalidate='novalidate'>
            <input type='hidden' name='id_users' id='id_users' value='$d[id_users]'>
                  <div class='control-group'>
                <label class='control-label'>NIK</label>
                <div class='controls'>
                  <input type='text' name='nik' id='nik' class='span5' maxlength='5' value='$d[nik]' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Your Name</label>
                <div class='controls'>
                  <input type='text' name='nama_users' id='nama_users' value='$d[nama_users]' class='span5' maxlength='20'>
                </div>
              </div>
              <div class='control-group'>
                <label class='control-label'>Your username</label>
                <div class='controls'>
                  <input type='text' name='username' id='username' value='$d[username]' class='span5' maxlength='10'>
                </div>
              </div>
              <div class='control-group'>
                <label class='control-label'>level</label>
                <div class='controls'>
                  <select name='level' id='level' class='span5'>
                  <option>admin</option>
                  <option>user</option>
                </select>
                </div>
              </div>
              <div class='control-group'>
                  <label class='control-label'>Password</label>
                  <div class='controls'>
                    <input type='password' name='pwd' id='pwd' class='span5' maxlength='7'/>
                  </div>
                </div>
                <div class='control-group'>
                  <label class='control-label'>Confirm password</label>
                  <div class='controls'>
                    <input type='password' name='pwd2' id='pwd2' class='span5' maxlength='7'/>
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
