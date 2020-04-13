<?php require_once('includes/init.php');
cek_login_index();
 ?>

<?php
$errors = array();
$username = isset($_POST['username']) ? trim($_POST['username']) : '';
$password = isset($_POST['username']) ? trim($_POST['password']) : '';
$hashed_password = sha1($password);
if(isset($_POST['submit'])):
  
  // Validasi
  if(!$username) {
    $errors[] = 'Username tidak boleh kosong';
  }
  if(!$password) {
    $errors[] = 'Password tidak boleh kosong';
  }
  
  if(empty($errors)):
    
    $query = $pdo->prepare('SELECT * FROM user WHERE username = :username AND password = :password');
    $query->execute( array(
      'username' => $username,
      'password' => $hashed_password
    ) );
    $query->setFetchMode(PDO::FETCH_ASSOC);
    $user = $query->fetch();
    
    if($user) {
      if($user['level'] == "admin") {
        $_SESSION["username"] = $user["username"];
        $_SESSION["level"] = 'admin';
        redirect_to("admin/dashboard.php?status=sukses-login");
      } elseif($user['level'] == "pimpinan"){
        $_SESSION["username"] = $user["username"];
         $_SESSION["level"] = 'pimpinan';
        redirect_to("pimpinan/dashboard.php?status=sukses-login");
      } elseif($user['level'] == "user"){
        $_SESSION["username"] = $user["username"];
         $_SESSION["level"] = 'user';
        redirect_to("user/dashboard.php?status=sukses-login");
      } else {
        $errors[] = 'Maaf, anda salah memasukkan username / password';
      }
    } else {
      $errors[] = 'Maaf, anda salah memasukkan username / password';
    }
    
  endif;

endif;  
?>
<!DOCTYPE html>
<html lang="en">

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
    <div class="card card-login mx-auto mt-5">
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
      <div class="card-header">Login</div>
      <div class="card-body">
        <form class="login" action="index.php" method="post">
          <div class="form-group">
            <div class="form-label-group">
              <input type="text" id="inputEmail" class="form-control" placeholder="Username" required="required" autofocus="autofocus" name="username" value="<?php echo htmlentities($username); ?>">
              <label for="inputEmail">Username</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="password" id="inputPassword" class="form-control" placeholder="Password" required="required" name="password">
              <label for="inputPassword">Password</label>
            </div>
          </div>
         
          <button class="btn btn-primary btn-block" name="submit">Login</button>
        </form>
       <div class="text-center">
          <a class="d-block small mt-3" href="register.php">Belum punya akun? Buat akun di sini!</a>
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
