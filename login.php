<?php
  session_start();
  include("includes/db.php");
 ?>

<div>

  <center><h2>Login or Register<h2></center><br>
  <form action="" method="post">
  <table align="center" border="1" width="720" style="background-color:#66CCCC;">
    <tr>
      <td><br></td>
      <td><br></td>
    </tr>
    <tr>
      <td align="right">Email:</td>
      <td><input type="text" name="c_email" placeholder="Email"></td>
    </tr>
    <tr>
      <td align="right">Password:</td>
      <td><input type="password" name="c_pass" placeholder="Password"></td>
    </tr>
    <tr>
      <td><br></td>
      <td><br></td>
    </tr>
    <tr>
      <td><br></td>
      <td><input type="submit" name="login" value="Login"></td>
      <td></td>
    </tr>
  </table>
  </form>
  <h2 style="float:right;padding:20px;"><a href="registrasi.php">Register disni</a></h2>


<?php
  if (isset($_POST['login'])) {
      $client_email = $_POST['c_email'];
      $client_pass = $_POST['c_pass'];

      $sql_login = "select * from client where client_email='$client_email' and client_password='$client_pass'";
      $run_sql_login = mysqli_query($con, $sql_login);
      $check_client = mysqli_num_rows($run_sql_login);

      if ($check_client==0) {
          echo "<script>alert('Email atau password salah')</script>";
          exit();
      }


      $get_ip = getIPAddr();
      $sql_cart = "select * from cart where ip_add='$get_ip'";
      $run_sql_cart = mysqli_query($con, $sql_cart);
      $check_cart = mysqli_num_rows($run_sql_cart);



      if ($check_client>0 and $check_cart==0) {
          $update_ip = "update client set ip_add='$get_ip',lastlogin=NOW() where client_email='$client_email'";
          $run_update = mysqli_query($con, $update_ip);
          $_SESSION['client_email']=$client_email;

          echo "<script>window.open('client/my_account.php','_self')</script>";
      } else {
          $update_ip = "update client set ip_add='$get_ip',lastlogin=NOW() where client_email='$client_email'";
          $run_update = mysqli_query($con, $update_ip);
          $_SESSION['client_email']=$client_email;

          echo "<script>alert('Anda berhasil login, sekarang anda dapat order!')</script>";

          echo "<script>window.open('checkout.php','_self')</script>";
      }
  }
 ?>
</div>
