<?php

require_once('../includes/init.php');
?>
<?php cek_login(); ?>
<!DOCTYPE html>
<html lang="en">
<?php
 $status = isset($_GET['status']) ? $_GET['status'] : '';
 $msg = '';
 switch($status):
   case 'sukses-baru':
     $msg = 'Data Kelurahan baru berhasil ditambahkan';
     break;
   case 'sukses-hapus':
     $msg = 'Data Kelurahan behasil dihapus';
     break;
   case 'sukses-edit':
     $msg = 'Data Kelurahan behasil diedit';
     break;
 endswitch;
 
 if($msg):
   echo '<div class="msg-box msg-box-full">';
   echo '<p><span class="fa fa-bullhorn"></span> &nbsp; '.$msg.'</p>';
   echo '</div>';
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
      table = document.getElementById("tampil_cluster");
      tr = table.getElementsByTagName("tr");

      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1];
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
            <a class="dropdown-item" href="input_user.php">Tambah User</a>
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
              <h3>Data Cluster</h3>
              <div id="dataTable_filter" class="dataTables_filter">
                <label>
                  <input type="text" id="cari" onkeyup="cari()" placeholder="Cari Cluster" >
                </label>
              </div>
            </div>
              <table class="table table-bordered" id="tampil_cluster" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>ID Cluster</th>
                    <th>Nama Cluster</th>
                    <th>Edit</th>
                    <th>Hapus</th>
                  </tr>
                </thead>
                <?php
                $query = $pdo->prepare('SELECT * FROM cluster');     
                $query->execute();
                // menampilkan berupa nama field
                $query->setFetchMode(PDO::FETCH_ASSOC);
                
                if($query->rowCount() > 0):
                while($d = $query->fetch()):
                ?>
                    <tbody>
                    <tr>
                <?php  ?>
                      <td><?php echo $d['id_cluster']; ?></td>
                      <td><?php echo $d['cluster']; ?></td>
                      <td>
                        <a href="edit_cluster.php?id_cluster=<?php echo $d['id_cluster']; ?>" onclick=" return edit()">
                         <center><img src="pictures/edit.png" width="20px" height="20px"></center>
                        </a>
                      </td>
                      <td>
                        <a href="hapus_cluster.php?id_cluster=<?php echo $d['id_cluster']; ?>" onclick=" return hapus()">
                         <center><img src="pictures/hapus.png" width="20px" height="20px"></center>
                        </a>
                      </td>
                    </tr>
                  </tbody>
                    <?php 
                  endwhile;
                endif;
                  ?>
              </table>
        </div>

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
