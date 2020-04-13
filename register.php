<!DOCTYPE html>
<html lang="en">
<?php
require_once('includes/init.php');
$errors = array();
$sukses = false;
$username = (isset($_POST['username'])) ? trim($_POST['username']) : '';
$password = (isset($_POST['password'])) ? trim($_POST['password']) : '';
$password2 = (isset($_POST['password2'])) ? trim($_POST['password2']) : '';
$nama_lengkap = (isset($_POST['nama_lengkap'])) ? trim($_POST['nama_lengkap']) : '';
$level = 'user';



if(isset($_POST['submit'])):  
  // Validasi Username
  if(!$username) {
    $errors[] = 'Username tidak boleh kosong';
  }
  // Validasi Password
  if(!$password) {
    $errors[] = 'Password tidak boleh kosong';
  }
  // Validasi Konfirmasi Password
  if($password2 != $password) {
    $errors[] = 'Password tidak cocok';
  } 
   // Validasi Nama
  if(!$nama_lengkap) {
    $errors[] = 'Nama tidak boleh kosong';
  }     
  // Cek Username
  if($username) {
    $query = $pdo->prepare('SELECT username FROM user WHERE user.username = :username');
    $query->execute(array('username' => $username));
    $result = $query->fetch();
    if(!empty($result)) {
      $errors[] = 'Username sudah digunakan';
    }
  }
  
  // Jika lolos validasi lakukan hal di bawah ini
  if(empty($errors)):
    
    $handle = $pdo->prepare('INSERT INTO user (username, password, nama_lengkap, level) VALUES (:username, :password, :nama_lengkap, :level)');
    $handle->execute( array(
      'username' => $username,
      'password' => sha1($password),
      'nama_lengkap' => $nama_lengkap,
      'level' => $level
    ) );
    //$username = $pdo->lastInsertId();
    
    
    redirect_to('index.php?status=sukses-baru');    
  
  endif;

endif;
?>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Sistem Prediksi Daerah Rawan Demam Berdarah</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
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

    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Buat Akun Baru</div>
      <div class="card-body">
        <form action="register.php" method="post">
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input name=nama_lengkap type="text" id="firstName" class="form-control" placeholder="Nama Lengkap" required="required" autofocus="autofocus">
                  <label for="firstName">Nama Lengkap</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input name=username type="text" id="lastName" class="form-control" placeholder="Username" required="required">
                  <label for="lastName">Username</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input name=password type="password" id="inputPassword" class="form-control" placeholder="Password" required="required">
                  <label for="inputPassword">Password</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input name=password2 type="password" id="confirmPassword" class="form-control" placeholder="Confirm password" required="required">
                  <label for="confirmPassword">Konfirmasi password</label>
                </div>
              </div>
            </div>
          </div>
          <center><button type="submit" name="submit" value="submit" class="button">DAFTAR</button></center>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login.html">Login Page</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
