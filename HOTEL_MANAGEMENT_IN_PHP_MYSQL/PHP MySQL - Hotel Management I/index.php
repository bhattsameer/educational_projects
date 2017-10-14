<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/css/master.css">
    <title>Hotel Management Program</title>
  </head>
  <body style="background-image:url('assets/media/bg.jpg');height: 100%;background-attachment: fixed;background-position: center;background-repeat: no-repeat;background-size: cover;">
    <?php
    session_start();
    if(isset($_SESSION['hlogin']))
    {
      echo "<script>window.location = 'dashboard/';</script>";
    }
    if(isset($_POST['login']))
    {
      $name = $_POST['login_user'];
      $pass = $_POST['login_pass'];
      $sql = "SELECT 1 FROM `hmanage_users` WHERE `username` = '$name' and `password` = '$pass'";
      include_once 'dbconn.php';
      if($connection)
      {
        $result = mysqli_fetch_assoc(mysqli_query($connection,$sql));
        if(isset($result[1]))
        {
          $_SESSION['hlogin'] = true;
          $_SESSION['user'] = $name;
          echo "<script>location.reload();</script>";
        }
        else
        {
          echo "<script>alert('Error : username / password is wrong');location.reload();</script>";
        }
        mysqli_close($connection);
      }
      else {
        echo "<script>alert('Error : can't connect to db');location.reload();</script>";
      }
    }
    elseif (isset($_POST['signup'])) {
      $name = $_POST['signup_user'];
      $pass = $_POST['signup_pass'];
      $sql = "INSERT INTO `hmanage_users`(`username`, `password`) VALUES ('$name','$pass')";
      include_once 'dbconn.php';
      if($connection)
      {
        if(mysqli_query($connection,$sql))
        {
          echo "<script>alert('Info : username $name has been added');</script>";
        }
        else
        {
          echo "<script>alert('Error : can't run the query');location.reload();</script>";
        }
        mysqli_close($connection);
      }
      else {
        echo "<script>alert('Error : can't connect to db');location.reload();</script>";
      }
    }
    ?>
    <div class="container">
      <header class="jumbotron black-white margin-top-10 margin-bottom-20">
        <h4 class="text-center header margin-top-m15">Project -> Hotel Management Application</h4>
        <h4 class="text-center header">Coded By -> Gurkirat Singh</h4>
        <h4 class="text-center header">Submitted To -> TEACHER :P</h4>
        <h4 class="text-center header margin-bottom-m15">University Name -> PTU</h4>
      </header>
      <section>
        <h5 class="text-center"><span id=portal>User Login / Sign up Portal</span></h5>
        <div class="row" id=f>
          <div class="col-md-6">
            <h2 style="color:white;" class="text-center">Login</h2>
            <form class="form-horizontal" action="" method="post">
              <div class="form-group">
                <center>
                  <input type="text" name="login_user" placeholder="username..." class="form-control" id="main">
                </center>
              </div>
              <div class="form-group">
                <center>
                  <input type="password" name="login_pass" placeholder="password..." class="form-control" id="main">
                </center>
              </div>
              <div class="form-group">
                <center>
                  <input type="submit" name="login" class="form-control btn btn-success login" value="Login">
                </center>
              </div>
            </form>
          </div>
          <div class="col-md-6">
            <h2 style="color:white;" class="text-center">Sign Up</h2>
            <form class="form-horizontal" action="" method="post">
              <div class="form-group">
                <center>
                  <input type="text" name="signup_user" placeholder="username..." class="form-control" id="main">
                </center>
              </div>
              <div class="form-group">
                <center>
                  <input type="password" name="signup_pass" placeholder="password..." class="form-control" id="main">
                </center>
              </div>
              <div class="form-group">
                <center>
                  <input type="submit" name="signup" class="form-control btn btn-info login" value="Sign Up">
                </center>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>
