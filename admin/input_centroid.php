<?php

require_once('../includes/init.php');
?>
<?php cek_login(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
$errors = array();
$sukses = false;
$id_centroid = (isset($_POST['id_centroid'])) ? trim($_POST['id_centroid']) : '';
$id_kelurahan = (isset($_POST['id_kelurahan'])) ? trim($_POST['id_kelurahan']) : '';
$id_cluster = (isset($_POST['id_cluster'])) ? trim($_POST['id_cluster']) : '';
$c1 = (isset($_POST['c1'])) ? trim($_POST['c1']) : '';
$c2 = (isset($_POST['c2'])) ? trim($_POST['c2']) : '';


if(isset($_POST['submit'])):  
  // Validasi ID centroid
  if(!$id_centroid) {
    $errors[] = 'ID centroid tidak boleh kosong';
  }
  if($id_centroid != 'C1' || $id_centroid != 'C2' || $id_centroid != 'C3' ) {
    $errors[] = 'ID centroid tidak cocok';
  }
  // Validasi ID Kelurahan
  if(!$id_kelurahan) {
    $errors[] = 'Nama Kelurahan tidak boleh kosong';
  }   
  // Validasi Cluster
  if(!$id_cluster) {
    $errors[] = 'Nama Cluster tidak boleh kosong';
  }
  // Validasi Nilai 1 Centroid
  if(!$c1) {
    $errors[] = 'Nilai 1 centroid tidak boleh kosong';
  } 
  if(!$c2) {
    $errors[] = 'Nilai 2 centroid tidak boleh kosong';
  } 
    // Cek id cluster
  if($id_cluster) {
    $queryyy = $pdo->prepare('SELECT id_cluster FROM centroid WHERE centroid.id_cluster = :id_cluster');
    $queryyy->execute(array('id_cluster' => $id_cluster));
    $resultyy = $queryyy->fetch();
    if(!empty($resultyy)) {
      $errors[] = 'Cluster sudah digunakan';
    }
  }
   // Cek id kelurahan
  if($id_kelurahan) {
    $queryy = $pdo->prepare('SELECT id_kelurahan FROM centroid WHERE centroid.id_kelurahan = :id_kelurahan');
    $queryy->execute(array('id_kelurahan' => $id_kelurahan));
    $resulty = $queryy->fetch();
    if(!empty($resulty)) {
      $errors[] = 'Kelurahan sudah digunakan';
    }
  }
  
  // Jika lolos validasi lakukan hal di bawah ini
  if(empty($errors)):
    
    $handle = $pdo->prepare('INSERT INTO centroid (id_centroid, id_kelurahan, id_cluster, c1, c2) VALUES (:id_centroid, :id_kelurahan, :id_cluster, :c1, :c2)');
    $handle->execute( array(
      'id_centroid' => $id_centroid,
      'id_kelurahan' => $id_kelurahan,
      'id_cluster' => $id_cluster,
      'c1' => $c1,
      'c2' => $c2
    ) );
    $id_centroid = $pdo->lastInsertId();
    
    
    redirect_to('tampil_centroid.php?status=sukses-baru');    
  
  endif;

endif;
?>

<head>
<script>
    function hapus() {
    var confirm_hapus = confirm("Yakin Ingin Menghapus?");
    if(confirm_hapus == true){
      alert("Data berhasil dihapus")
    }
    return confirm_hapus;
                     }
    function edit() {
    var confirm_edit = confirm("Yakin Ingin Mengedit?");
    if(confirm_edit == true){
      
    }
    return confirm_edit;
                     } 
     function cari() {
      // Declare variables 
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("cari");
      filter = input.value.toUpperCase();
      table = document.getElementById("tampil_wo");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        } 
      }
    }                     
</script>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Prediksi Daerah Rawan Demam Berdarah</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="dashboard.php">Sistem Prediksi Daerah Rawan Demam Berdarah</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
          
          <div class="input-group-append">
           
          </div>
        </div>
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Kelurahan</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="tampil_kelurahan.php">Data Kelurahan</a>
            <a class="dropdown-item" href="input_kelurahan.php">Input Data Kelurahan</a>
          </div>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Cluster</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="tampil_cluster.php">Data Cluster</a>
            <a class="dropdown-item" href="input_cluster.php">Input Data Cluster</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Centroid</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="tampil_centroid.php">Data Centroid</a>
            <a class="dropdown-item" href="input_centroid.php">Input Data Centroid</a>
          </div>
        </li>
         <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Proses Clustering</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="tampil_clustering.php">Hasil Clustering</a>
            
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>User</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <a class="dropdown-item" href="tampil_user.php">Data User</a>
            <a class="dropdown-item" href="tambah_user.php">Tambah User</a>
          </div>
        </li>
      </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Home</li>
        </ol>

        
        <div class="card-body">
        <div class="table-responsive">
            <div class="col-sm-12 col-md-6">
            </div>
            <h3>Data Kelurahan</h3>
              <table class="table table-bordered" id="tampil_kelurahan" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID Kelurahan</th>
                    <th>Nama Kelurahan</th>
                    <th>Jumlah Penduduk</th>
                    <th>Jumlah Penderita DBD(Dalam Setahun)</th>
                  </tr>
                </thead>
                <?php
                $query = $pdo->prepare('SELECT * FROM data_kelurahan ORDER BY LPAD(lower(id_kelurahan),15,0) asc');     
                $query->execute();
                // menampilkan berupa nama field
                $query->setFetchMode(PDO::FETCH_ASSOC);
                
                if($query->rowCount() > 0):
                while($d = $query->fetch()):
                ?>
                    <tbody>
                    <tr>
                <?php  ?>
                      <td><?php echo $d['id_kelurahan']; ?></td>
                      <td><?php echo $d['nama_kelurahan']; ?></td>
                      <td><?php echo $d['jumlah_penduduk']; ?></td>
                      <td><?php echo $d['jumlah_penderita_dbd']; ?></td>
                    </tr>
                  </tbody>
                    <?php 
                  endwhile;
                endif;
                  ?>
              </table>
        </div>  
        <div class="">
                       <?php if(!empty($errors)): ?>
                       
                        <div class="msg-box warning-box">
                          <p><strong>Error:</strong></p>
                          <ul>
                            <?php foreach($errors as $error): ?>
                              <li><?php echo $error; ?></li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                        
                       <?php endif; ?>   
                
                  <h3>Input Centroid</h3>
                <form action="input_centroid.php" method="post" >
                  <div style="overflow-x:auto;">
                  <div class="table-responsive">  
                  <table>
                    <tr hidden="">
                      <td><label>ID Centroid</label></td>
                      <?php
                      
                      $tampil = $pdo->prepare('SELECT max(id_centroid) as id_centroid FROM centroid');
                      $tampil->execute();
                      $hasil = $tampil->fetch();    
                      $kode = $hasil;
                      if($kode){
                      $nilaikode = substr($kode[0],1);
                      $hkode = (int) $nilaikode;
                      $hkode = $hkode + 1;
                      $hasilkode = "C".str_pad($hkode,0,"0",STR_PAD_LEFT);
                      }else{
                      $hasilkode = "C1";
                       }
                      ?>
                      <td><input type="text" name="id_centroid" value="<?php echo $hasilkode; ?>"></td>
                    </tr>
                    <tr>
                      <td><label>Cluster</label></td>
                      <td>
                        <select name="id_cluster">
                          <option value="0">-- Pilih Cluster --</option>
                          <?php
                          $query4 = $pdo->prepare('SELECT * FROM cluster');     
                          $query4->execute(array(
                            'id_cluster' => $cluster['id_cluster']
                          ));
                          // menampilkan berupa nama field
                          $query4->setFetchMode(PDO::FETCH_ASSOC);
                          if($query4->rowCount() > 0): while($hassl = $query4->fetch()):
                          ?>
                            <option value="<?php echo $hassl['id_cluster']; ?>"><?php echo $hassl['cluster']; ?></option>
                          <?php
                          endwhile; endif;
                          ?>
                        </select>
                      </td>
                    </tr>
                     <tr>
                      <td><label>Kelurahan</label></td>
                      <td>
                        <select name="id_kelurahan" id="id_kelurahan" onchange='changeValue(this.value)'>
                          <option value="0">-- Pilih Kelurahan --</option>
                          <?php
                          $query3 = $pdo->prepare('SELECT * FROM data_kelurahan');     
                          $query3->execute(array(
                            'id_kelurahan' => $kelurahan['id_kelurahan']
                          ));
                          // menampilkan berupa nama field
                          
                          $query3->setFetchMode(PDO::FETCH_ASSOC);
                          $jsArray = "var nilai = new Array();";
                          if($query3->rowCount() > 0): while($hasl = $query3->fetch()):
                          ?>
                            <option value="<?php echo $hasl['id_kelurahan']; ?>"><?php echo $hasl['nama_kelurahan']; ?></option>
                          <?php
                          $jsArray .= "nilai['" . $hasl['id_kelurahan'] . "'] = {jumlah_penduduk:'" . addslashes($hasl['jumlah_penduduk']) . "',jumlah_penderita_dbd:'".addslashes($hasl['jumlah_penderita_dbd'])."'};";
                          endwhile; endif;
                          ?>
                        </select>
                      </td>
                    </tr>
                     <tr>
                      <td><label>Nilai 1 Centroid</label></td>
                      <td><input type="text" name="c1" id="jumlah_penduduk" value="<?php echo $c1; ?>" readonly></td>
                    </tr>
                     <tr>
                      <td><label>Nilai 2 Centroid</label></td>
                      <td><input type="text" name="c2" id="jumlah_penderita_dbd" value="<?php echo $c2; ?>" readonly></td>
                    </tr>
                    <tr>
                      <td colspan="2"><center><button type="submit" name="submit" value="submit" class="button">
                      SIMPAN
                    </button></center></td>
                    </tr>
                    </table>
                    </div>
                    </div>
                  </form>
              

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © NTR <?php echo date("Y"); ?></span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik Logout Jika Anda Yakin Ingin Keluar</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Page level plugin JavaScript-->
  <script src="vendor/chart.js/Chart.min.js"></script>
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin.min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>

</body>

</html>
<script type="text/javascript"> 
<?php echo $jsArray; ?>
function changeValue(id){
    document.getElementById('jumlah_penduduk').value = nilai[id].jumlah_penduduk;
    document.getElementById('jumlah_penderita_dbd').value = nilai[id].jumlah_penderita_dbd;
    
};
</script>