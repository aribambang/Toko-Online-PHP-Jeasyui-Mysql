<html><body><head><title>Metode Pembayaran</title></head>
<?php
    session_start();
    include("includes/db.php");

    $email = $_SESSION['client_email'];
    $sql = "select * from client where client_email='$email'";
    $run_sql = mysqli_query($con,$sql);
    $show = mysqli_fetch_array($run_sql);
    $kd_client = $show['kd_client'];

    echo "<h2>Pilih metode pembayaran: </h2><br>

    <a href='order.php?c_id=$kd_client'>Transfer Bank</a>

    ";

  ?>
</body></html>
