<?php

require_once('../includes/init.php');
?>
<?php cek_login(); ?>
<!DOCTYPE html>
<html lang="en">
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
    function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
       }                         
</script>
<?php 
/* ---------------------------------------------
 * Set jumlah digit di belakang koma
 * ------------------------------------------- */
$digit = 6;
/* ---------------------------------------------
 * Fetch semua Centroid
 * ------------------------------------------- */
$query = $pdo->prepare('SELECT id_centroid, id_kelurahan, id_cluster, c1, c2 FROM centroid where id_centroid="C1"');
$query->execute();
$query->setFetchMode(PDO::FETCH_ASSOC);
$centroids = $query->fetchAll();

$queryc1 = $pdo->prepare('SELECT id_centroid, id_kelurahan, id_cluster, c1, c2 FROM centroid where id_centroid="C2"');
$queryc1->execute();
$queryc1->setFetchMode(PDO::FETCH_ASSOC);
$centroids1 = $queryc1->fetchAll();

$queryc2 = $pdo->prepare('SELECT id_centroid, id_kelurahan, id_cluster, c1, c2 FROM centroid where id_centroid="C3"');
$queryc2->execute();
$queryc2->setFetchMode(PDO::FETCH_ASSOC);
$centroids2 = $queryc2->fetchAll();

/* ---------------------------------------------
 * Fetch semua Cluster
 * ------------------------------------------- */
$query2 = $pdo->prepare('SELECT * FROM cluster');
$query2->execute();     
$query2->setFetchMode(PDO::FETCH_ASSOC);
$clusters = $query2->fetchAll();

/* ---------------------------------------------
 * Fetch semua Kelurahan
 * ------------------------------------------- */
$query3 = $pdo->prepare('SELECT id_kelurahan, nama_kelurahan, jumlah_penduduk, jumlah_penderita_dbd FROM data_kelurahan ORDER BY LPAD(lower(id_kelurahan),15,0) asc');
$query3->execute();     
$query3->setFetchMode(PDO::FETCH_ASSOC);
$kelurahans = $query3->fetchAll();

$no=0;
$no_b=0;
$no_c=0;
$no_d=0;

$clu1=array();
$clu2=array();
$clu3=array();

$clu1_b=array();
$clu2_b=array();
$clu3_b=array();

$clu1_c=array();
$clu2_c=array();
$clu3_c=array();

$clu1_d=array();
$clu2_d=array();
$clu3_d=array();

$clu1_temp = array();
$clu2_temp = array();

$clu1_temp_b = array();
$clu2_temp_b = array();
$clu1_temp_c = array();
$clu2_temp_c = array();

$clu1_temp_d = array();
$clu2_temp_d = array();
?>
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
    <link href="css/bar.css" rel="stylesheet">

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
          <div id="printableArea">
           <div class="table-responsive">
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
                $queryy = $pdo->prepare('SELECT * FROM data_kelurahan ORDER BY LPAD(lower(id_kelurahan),15,0) asc');     
                $queryy->execute();
                // menampilkan berupa nama field
                $queryy->setFetchMode(PDO::FETCH_ASSOC);
                
                if($queryy->rowCount() > 0):
                while($d = $queryy->fetch()):
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
                   <h3>Centroid</h3>
        <table class="table table-bordered" id="tampil_centroid" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Cluster</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                  </tr>
                </thead>
                <?php
                $queryyy = $pdo->prepare('SELECT centroid.id_centroid, data_kelurahan.nama_kelurahan, cluster.cluster,
                centroid.c1, centroid.c2 FROM centroid INNER JOIN data_kelurahan 
                ON centroid.id_kelurahan = data_kelurahan.id_kelurahan INNER JOIN cluster ON
                centroid.id_cluster = cluster.id_cluster');     
                $queryyy->execute();
                // menampilkan berupa nama field
                $queryyy->setFetchMode(PDO::FETCH_ASSOC);
                
                if($queryyy->rowCount() > 0):
                while($d = $queryyy->fetch()):
                ?>
                    <tbody>
                    <tr>
                <?php  ?>
                      <td><?php echo $d['cluster']; ?></td>
                      <td><?php echo $d['c1']; ?></td>
                      <td><?php echo $d['c2']; ?></td>
                    </tr>
                  </tbody>
                    <?php 
                  endwhile;
                endif;
                  ?>
              </table>
              <h3>Iterasi Ke-1</h3>
        <table class="table table-bordered" id="tampil_kelurahan" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th rowspan="2">Nama Kelurahan</th>
                    <th rowspan="2">Jumlah Penduduk</th>
                    <th rowspan="2">Jumlah Penderita DBD(Dalam Setahun)</th>
                    <th rowspan="2">Jarak Ke Centroid 1</th>
                    <th rowspan="2">Jarak Ke Centroid 2</th>
                    <th rowspan="2">Jarak Ke Centroid 3</th>
                    <th colspan="3"><center>Cluster</center></th>
                  </tr>
                  <tr>
                    <th>Sporadis</th>
                    <th>Potensial</th>
                    <th>Endemis</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($kelurahans as $kelurahan): ?>    
                    <tr>
                      <td><?php echo $kelurahan['nama_kelurahan']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penduduk']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penderita_dbd']; ?></td>
                      <?php 
                      foreach($centroids as $centroid):
                      $nama_kelurahan = $kelurahan['nama_kelurahan'];
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      $c1a = $centroid['c1'];
                      $c1b = $centroid['c2'];
                      
                      $pow = pow(($jumlah_penduduk-$c1a),2)+pow(($jumlah_penderita_dbd-$c1b),2);
                      $h1 = sqrt($pow);          
                      echo '<td>';
                      echo round($h1,$digit);
                      echo '</td>';
                      endforeach;
                      ?>
                      <?php 
                      foreach($centroids1 as $centroid1):
                      $nama_kelurahan = $kelurahan['nama_kelurahan'];
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      $c2a = $centroid1['c1'];
                      $c2b = $centroid1['c2'];
                      
                      $pow2 = pow(($jumlah_penduduk-$c2a),2)+pow(($jumlah_penderita_dbd-$c2b),2);
                      $h2 = sqrt($pow2);          
                      echo '<td>';
                      echo round($h2,$digit);
                      echo '</td>';
                      endforeach;
                      ?>
                      <?php 
                      foreach($centroids2 as $centroid2):
                      $nama_kelurahan = $kelurahan['nama_kelurahan'];
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      $c3a = $centroid2['c1'];
                      $c3b = $centroid2['c2'];
                      
                      $pow3 = pow(($jumlah_penduduk-$c3a),2)+pow(($jumlah_penderita_dbd-$c3b),2);
                      $h3 = sqrt($pow3);          
                      echo '<td>';
                      echo round($h3,$digit);
                      echo '</td>';
                      endforeach;
                      ?>
                      <?php
                     
                      
                      if($h1 <= $h2 && $h1 <= $h3){
                      $clu1[$no]= 1;
                      }else{
                      $clu1[$no]= "0";  
                      }
                      if($h2 <= $h1 && $h2 <= $h3){
                      $clu2[$no]= 1;
                      }else{
                      $clu2[$no]= "0";  
                      }
                      if($h3 <= $h1 && $h3 <= $h2){
                      $clu3[$no]= 1;
                      }else{
                      $clu3[$no]= "0";
                      }  

                      ?>
                      <td><?php echo $clu1[$no]; ?></td>
                      <td><?php echo $clu2[$no]; ?></td>
                      <td><?php echo $clu3[$no]; ?></td>
                      <?php
                      $clu1_temp[$no] = $kelurahan['jumlah_penduduk'];
                      $clu2_temp[$no] = $kelurahan['jumlah_penderita_dbd'];
                      $no++;
                      ?>
                    </tr>
                    <?php
                    
                    endforeach; ?>
                    <?php
                    //centroid baru c1a_b
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu1);$i++)
                    {
                      $arr[$i] = $clu1_temp[$i]*$clu1[$i];
                      if($clu1[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c1a_b = array_sum($arr)/$jum;
                    
                     //centroid baru c1b_b
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu1);$i++)
                    {
                      $arr[$i] = $clu2_temp[$i]*$clu1[$i];
                      if($clu1[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c1b_b = array_sum($arr)/$jum;
                    

                    //centroid baru c2a_b
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu2);$i++)
                    {
                      $arr[$i] = $clu1_temp[$i]*$clu2[$i];
                      if($clu2[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c2a_b = array_sum($arr)/$jum;
                    
                    
                     //centroid baru c2b_b
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu2);$i++)
                    {
                      $arr[$i] = $clu2_temp[$i]*$clu2[$i];
                      if($clu2[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c2b_b = array_sum($arr)/$jum;

                    //centroid baru c3a_b
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu3);$i++)
                    {
                      $arr[$i] = $clu1_temp[$i]*$clu3[$i];
                      if($clu3[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c3a_b = array_sum($arr)/$jum;
                    
                    
                     //centroid baru c2b_b
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu3);$i++)
                    {
                      $arr[$i] = $clu2_temp[$i]*$clu3[$i];
                      if($clu3[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c3b_b = array_sum($arr)/$jum;
                    
                    ?> 

                  </tbody>
              </table>
              <h3>Centroid Baru Untuk Interasi Ke-2</h3>
        <table class="table table-bordered" id="tampil_centroid" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Cluster</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                  </tr>
                </thead>
                    <tbody>
                      <td>Sporadis</td>
                      <td><?php echo round($c1a_b,$digit); ?></td>
                      <td><?php echo round($c1b_b,$digit); ?></td>
                    </tr>
                    <tr>
                      <td>Potensial</td>
                      <td><?php echo round($c2a_b,$digit); ?></td>
                      <td><?php echo round($c2b_b,$digit); ?></td>
                    </tr>
                    <tr>
                      <td>Endemis</td>
                      <td><?php echo round($c3a_b,$digit); ?></td>
                      <td><?php echo round($c3b_b,$digit); ?></td>
                    </tr>
                  </tbody>
                    
              </table>
               <h3>Iterasi Ke-2</h3>
        <table class="table table-bordered" id="tampil_kelurahan" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th rowspan="2">Nama Kelurahan</th>
                    <th rowspan="2">Jumlah Penduduk</th>
                    <th rowspan="2">Jumlah Penderita DBD(Dalam Setahun)</th>
                    <th rowspan="2">Jarak Ke Centroid 1</th>
                    <th rowspan="2">Jarak Ke Centroid 2</th>
                    <th rowspan="2">Jarak Ke Centroid 3</th>
                    <th colspan="3"><center>Cluster</center></th>
                  </tr>
                  <tr>
                    <th>Sporadis</th>
                    <th>Potensial</th>
                    <th>Endemis</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($kelurahans as $kelurahan): ?>    
                    <tr>
                      <td><?php echo $kelurahan['nama_kelurahan']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penduduk']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penderita_dbd']; ?></td>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow = pow(($jumlah_penduduk-$c1a_b),2)+pow(($jumlah_penderita_dbd-$c1b_b),2);
                      $h1_b = sqrt($pow);          
                      echo '<td>';
                      echo round($h1_b,$digit);
                      echo '</td>';
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow2 = pow(($jumlah_penduduk-$c2a_b),2)+pow(($jumlah_penderita_dbd-$c2b_b),2);
                      $h2_b = sqrt($pow2);          
                      echo '<td>';
                      echo round($h2_b,$digit);
                      echo '</td>';
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow3 = pow(($jumlah_penduduk-$c3a_b),2)+pow(($jumlah_penderita_dbd-$c3b_b),2);
                      $h3_b = sqrt($pow3);          
                      echo '<td>';
                      echo round($h3_b,$digit);
                      echo '</td>';
                     
                      ?>
                      <?php
                     
                      
                      if($h1_b <= $h2_b && $h1_b <= $h3_b){
                      $clu1_b[$no_b]= 1;
                      }else{
                      $clu1_b[$no_b]= "0";  
                      }
                      if($h2_b <= $h1_b && $h2_b <= $h3_b){
                      $clu2_b[$no_b]= 1;
                      }else{
                      $clu2_b[$no_b]= "0";  
                      }
                      if($h3_b <= $h1_b && $h3_b <= $h2_b){
                      $clu3_b[$no_b]= 1;
                      }else{
                      $clu3_b[$no_b]= "0";
                      }  

                      ?>
                      <td><?php echo $clu1_b[$no_b]; ?></td>
                      <td><?php echo $clu2_b[$no_b]; ?></td>
                      <td><?php echo $clu3_b[$no_b]; ?></td>
                      <?php
                      $clu1_temp_b[$no_b] = $kelurahan['jumlah_penduduk'];
                      $clu2_temp_b[$no_b] = $kelurahan['jumlah_penderita_dbd'];
                      $no_b++;
                      ?>
                    </tr>
                    <?php
                    
                    endforeach; ?>
                    <?php
                    //centroid baru c1a_c
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu1_b);$i++)
                    {
                      $arr[$i] = $clu1_temp_b[$i]*$clu1_b[$i];
                      if($clu1_b[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c1a_c = array_sum($arr)/$jum;
                    
                     //centroid baru c1b_c
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu1_b);$i++)
                    {
                      $arr[$i] = $clu2_temp_b[$i]*$clu1_b[$i];
                      if($clu1_b[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c1b_c = array_sum($arr)/$jum;
                    

                    //centroid baru c2a_c
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu2_b);$i++)
                    {
                      $arr[$i] = $clu1_temp_b[$i]*$clu2_b[$i];
                      if($clu2_b[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c2a_c = array_sum($arr)/$jum;
                    
                    
                     //centroid baru c2b_c
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu2_b);$i++)
                    {
                      $arr[$i] = $clu2_temp_b[$i]*$clu2_b[$i];
                      if($clu2_b[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c2b_c = array_sum($arr)/$jum;

                    //centroid baru c3a_c
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu3_b);$i++)
                    {
                      $arr[$i] = $clu1_temp_b[$i]*$clu3_b[$i];
                      if($clu3_b[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c3a_c = array_sum($arr)/$jum;
                    
                    
                     //centroid baru c2b_c
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu3_b);$i++)
                    {
                      $arr[$i] = $clu2_temp_b[$i]*$clu3_b[$i];
                      if($clu3_b[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c3b_c = array_sum($arr)/$jum;
                    
                    ?> 

                  </tbody>
              </table>
               <h3>Centroid Baru Untuk Iterasi Ke-3</h3>
        <table class="table table-bordered" id="tampil_centroid" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Cluster</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                  </tr>
                </thead>
                    <tbody>
                      <td>Sporadis</td>
                      <td><?php echo round($c1a_c,$digit); ?></td>
                      <td><?php echo round($c1b_c,$digit); ?></td>
                    </tr>
                    <tr>
                      <td>Potensial</td>
                      <td><?php echo round($c2a_c,$digit); ?></td>
                      <td><?php echo round($c2b_c,$digit); ?></td>
                    </tr>
                    <tr>
                      <td>Endemis</td>
                      <td><?php echo round($c3a_c,$digit); ?></td>
                      <td><?php echo round($c3b_c,$digit); ?></td>
                    </tr>
                  </tbody>
                    
              </table>
              <h3>Iterasi Ke-3</h3>
        <table class="table table-bordered" id="tampil_kelurahan" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th rowspan="2">Nama Kelurahan</th>
                    <th rowspan="2">Jumlah Penduduk</th>
                    <th rowspan="2">Jumlah Penderita DBD(Dalam Setahun)</th>
                    <th rowspan="2">Jarak Ke Centroid 1</th>
                    <th rowspan="2">Jarak Ke Centroid 2</th>
                    <th rowspan="2">Jarak Ke Centroid 3</th>
                    <th colspan="3"><center>Cluster</center></th>
                  </tr>
                  <tr>
                    <th>Sporadis</th>
                    <th>Potensial</th>
                    <th>Endemis</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($kelurahans as $kelurahan): ?>    
                    <tr>
                      <td><?php echo $kelurahan['nama_kelurahan']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penduduk']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penderita_dbd']; ?></td>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow = pow(($jumlah_penduduk-$c1a_c),2)+pow(($jumlah_penderita_dbd-$c1b_c),2);
                      $h1_c = sqrt($pow);          
                      echo '<td>';
                      echo round($h1_c,$digit);
                      echo '</td>';
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow2 = pow(($jumlah_penduduk-$c2a_c),2)+pow(($jumlah_penderita_dbd-$c2b_c),2);
                      $h2_c = sqrt($pow2);          
                      echo '<td>';
                      echo round($h2_c,$digit);
                      echo '</td>';
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow3 = pow(($jumlah_penduduk-$c3a_c),2)+pow(($jumlah_penderita_dbd-$c3b_c),2);
                      $h3_c = sqrt($pow3);          
                      echo '<td>';
                      echo round($h3_c,$digit);
                      echo '</td>';
                     
                      ?>
                      <?php
                     
                      if($h1_c <= $h2_c && $h1_c <= $h3_c){
                      $clu1_c[$no_c]= 1;
                      }else{
                      $clu1_c[$no_c]= "0";  
                      }
                      if($h2_c <= $h1_c && $h2_c <= $h3_c){
                      $clu2_c[$no_c]= 1;
                      }else{
                      $clu2_c[$no_c]= "0";  
                      }
                      if($h3_c <= $h1_c && $h3_c <= $h2_c){
                      $clu3_c[$no_c]= 1;
                      }else{
                      $clu3_c[$no_c]= "0";
                      }  

                      ?>
                      <td><?php echo $clu1_c[$no_c]; ?></td>
                      <td><?php echo $clu2_c[$no_c]; ?></td>
                      <td><?php echo $clu3_c[$no_c]; ?></td>
                      <?php
                      $clu1_temp_c[$no_c] = $kelurahan['jumlah_penduduk'];
                      $clu2_temp_c[$no_c] = $kelurahan['jumlah_penderita_dbd'];
                      $no_c++;
                      ?>
                    </tr>
                    <?php
                    
                    endforeach; ?>
                    <?php
                    //centroid baru c1a_d
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu1_c);$i++)
                    {
                      $arr[$i] = $clu1_temp_c[$i]*$clu1_c[$i];
                      if($clu1_c[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c1a_d = array_sum($arr)/$jum;
                    
                     //centroid baru c1b_d
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu1_c);$i++)
                    {
                      $arr[$i] = $clu2_temp_c[$i]*$clu1_c[$i];
                      if($clu1_c[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c1b_d = array_sum($arr)/$jum;
                    

                    //centroid baru c2a_d
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu2_c);$i++)
                    {
                      $arr[$i] = $clu1_temp_c[$i]*$clu2_c[$i];
                      if($clu2_c[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c2a_d = array_sum($arr)/$jum;
                    
                    
                     //centroid baru c2b_d
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu2_c);$i++)
                    {
                      $arr[$i] = $clu2_temp_c[$i]*$clu2_c[$i];
                      if($clu2_c[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c2b_d = array_sum($arr)/$jum;

                    //centroid baru c3a_d
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu3_c);$i++)
                    {
                      $arr[$i] = $clu1_temp_c[$i]*$clu3_c[$i];
                      if($clu3_c[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c3a_d = array_sum($arr)/$jum;
                    
                    
                     //centroid baru c3b_d
                    $jum = 0;
                    $arr = array();
                    
                    for($i=0;$i<count($clu3_c);$i++)
                    {
                      $arr[$i] = $clu2_temp_c[$i]*$clu3_c[$i];
                      if($clu3_c[$i]==1)
                      {
                        $jum++;
                      }
                    }
                    $c3b_d = array_sum($arr)/$jum;
                    
                    ?> 

                  </tbody>
              </table>
              <h3>Centroid Baru Untuk Iterasi Ke-4</h3>
        <table class="table table-bordered" id="tampil_centroid" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Cluster</th>
                    <th>Nilai 1</th>
                    <th>Nilai 2</th>
                  </tr>
                </thead>
                    <tbody>
                      <td>Sporadis</td>
                      <td><?php echo round($c1a_c,$digit); ?></td>
                      <td><?php echo round($c1b_c,$digit); ?></td>
                    </tr>
                    <tr>
                      <td>Potensial</td>
                      <td><?php echo round($c2a_c,$digit); ?></td>
                      <td><?php echo round($c2b_c,$digit); ?></td>
                    </tr>
                    <tr>
                      <td>Endemis</td>
                      <td><?php echo round($c3a_c,$digit); ?></td>
                      <td><?php echo round($c3b_c,$digit); ?></td>
                    </tr>
                  </tbody>
                    
              </table>
              <h3>Iterasi Ke-4 (Akhir)</h3>
              <table class="table table-bordered" id="tampil_kelurahan" width="100%" cellspacing="0">
              <thead>
                  <tr>
                    <th rowspan="2">Nama Kelurahan</th>
                    <th rowspan="2">Jumlah Penduduk</th>
                    <th rowspan="2">Jumlah Penderita DBD(Dalam Setahun)</th>
                    <th rowspan="2">Jarak Ke Centroid 1</th>
                    <th rowspan="2">Jarak Ke Centroid 2</th>
                    <th rowspan="2">Jarak Ke Centroid 3</th>
                    <th colspan="3"><center>Cluster</center></th>
                  </tr>
                  <tr>
                    <th>Sporadis</th>
                    <th>Potensial</th>
                    <th>Endemis</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($kelurahans as $kelurahan): ?>    
                    <tr>
                      <td><?php echo $kelurahan['nama_kelurahan']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penduduk']; ?></td>
                      <td><?php echo $kelurahan['jumlah_penderita_dbd']; ?></td>
                      <?php 
                      $id_kelurahan = $kelurahan['id_kelurahan'];
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow = pow(($jumlah_penduduk-$c1a_d),2)+pow(($jumlah_penderita_dbd-$c1b_d),2);
                      $h1_d = sqrt($pow);          
                      echo '<td>';
                      echo round($h1_d,$digit);
                      echo '</td>';
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow2 = pow(($jumlah_penduduk-$c2a_d),2)+pow(($jumlah_penderita_dbd-$c2b_d),2);
                      $h2_d = sqrt($pow2);          
                      echo '<td>';
                      echo round($h2_d,$digit);
                      echo '</td>';
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow3 = pow(($jumlah_penduduk-$c3a_d),2)+pow(($jumlah_penderita_dbd-$c3b_d),2);
                      $h3_d = sqrt($pow3);          
                      echo '<td>';
                      echo round($h3_d,$digit);
                      echo '</td>';

                      ?>
                      <?php
                     
                      if($h1_d <= $h2_d && $h1_d <= $h3_d){
                      $clu1_d[$no_d]= 1;
                      }else{
                      $clu1_d[$no_d]= "0";  
                      }
                      if($h2_d <= $h1_d && $h2_d <= $h3_d){
                      $clu2_d[$no_d]= 1;
                      }else{
                      $clu2_d[$no_d]= "0";  
                      }
                      if($h3_d <= $h1_d && $h3_d <= $h2_d){
                      $clu3_d[$no_d]= 1;
                      }else{
                      $clu3_d[$no_d]= "0";
                      }  

                      ?>
                      <td><?php echo $clu1_d[$no_d]; ?></td>
                      <td><?php echo $clu2_d[$no_d]; ?></td>
                      <td><?php echo $clu3_d[$no_d]; ?></td>
                    </tr>
                    <?php
                    
                    endforeach; ?>
                  </tbody>
                </table>
               <h3>Grafik Hasil Clustering</h3>
        <table class="highchart table-bordered" 
        data-graph-container-before="1" data-graph-type="column" id="tampil_kelurahan" width="100%" cellspacing="0"
        style="visibility: hidden;" >
                <thead>
                  <tr>
                    <th rowspan="2">Nama Kelurahan</th>
                    <th rowspan="2">Sporadis</th>
                    <th rowspan="2">Potensial</th>
                    <th rowspan="2">Endemis</th>
                   
                  </tr>
                 
                </thead>
                <tbody>
                  <?php foreach($kelurahans as $kelurahan): ?>    
                    <tr>
                      <td><?php echo $kelurahan['nama_kelurahan']; ?></td>
                      <?php 
                      $id_kelurahan = $kelurahan['id_kelurahan'];
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow = pow(($jumlah_penduduk-$c1a_d),2)+pow(($jumlah_penderita_dbd-$c1b_d),2);
                      $h1_d = sqrt($pow);          
                      
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow2 = pow(($jumlah_penduduk-$c2a_d),2)+pow(($jumlah_penderita_dbd-$c2b_d),2);
                      $h2_d = sqrt($pow2);          
                      
                      
                      ?>
                      <?php 
                      $jumlah_penduduk = $kelurahan['jumlah_penduduk'];
                      $jumlah_penderita_dbd = $kelurahan['jumlah_penderita_dbd'];
                      
                      $pow3 = pow(($jumlah_penduduk-$c3a_d),2)+pow(($jumlah_penderita_dbd-$c3b_d),2);
                      $h3_d = sqrt($pow3);          
                      

                      if($h1_d <= $h2_d && $h1_d <= $h3_d){
                      echo '<td>';
                      echo round($h1_d,$digit);
                      echo '</td>';
                      echo '<td>';
                      echo ($h2_d=0);
                      echo '</td>';
                      echo '<td>';
                      echo ($h3_d=0);
                      echo '</td>';
                      }
                      else if($h2_d <= $h1_d && $h2_d <= $h3_d){
                      echo '<td>';
                      echo ($h1_d=0);
                      echo '</td>'; 
                      echo '<td>';
                      echo round($h2_d,$digit);
                      echo '</td>';
                      echo '<td>';
                      echo ($h3_d=0);
                      echo '</td>';
                      }
                      else if($h3_d <= $h1_d && $h3_d <= $h2_d){
                      echo '<td>';
                      echo round($h1_d=0);
                      echo '</td>'; 
                      echo '<td>';
                      echo ($h2_d=0);
                      echo '</td>';
                      echo '<td>';
                      echo round($h3_d,$digit);
                      echo '</td>';
                      }else{
                      //echo '<td></td>';  
                      }
                      ?>
                    </tr>
                    <?php
                    
                    endforeach; ?>
                  </tbody>
                </table>
                </div> </div> 
        <a href="tampil_clustering.php" onClick="printDiv('printableArea')">
          <center><button>CETAK LAPORAN</button></center>
        </a>
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
  <script src="js/highcharts.js"></script>
  <script src="js/jquery.highchartTable-min.js"></script>

  <!-- Demo scripts for this page-->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="js/demo/chart-area-demo.js"></script>
  <script>
    $('table.highchart').highchartTable();

  </script>
</body>

</html>
