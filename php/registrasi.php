<?php
  if(isset($_POST['register'])){


    $ip = getIPAddr();
    $c_namadepan = $_POST['c_namadepan'];
    $c_namabelakang = $_POST['c_namabelakang'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_perusahaan = $_POST['c_perusahaan'];
    $c_address1 = $_POST['c_address1'];
    $c_address2 = $_POST['c_address2'];
    $c_kota = $_POST['c_kota'];
    $c_provinsi = $_POST['c_provinsi'];
    $c_kodepos = $_POST['c_kodepos'];
    $c_negara = $_POST['c_negara'];
    $c_telp = $_POST['c_telp'];
    $c_fax = $_POST['c_fax'];
    $c_hp = $_POST['c_hp'];


     $insert_c = "insert into client (client_email, client_password, namadepan, namabelakang, perusahaan, address1, address2, kota, provinsi, kodepos, negara, telp, fax, hp, ip_add) values ('$c_email','$c_pass','$c_namadepan','$c_namabelakang','$c_perusahaan','$c_address1','$c_address2','$c_kota','$c_provinsi','$c_kodepos','$c_negara','$c_telp','$c_fax','$c_hp','$ip')";

    $run_c = mysqli_query($db, $insert_c);

    $sel_cart = "select * from cart where ip_add='$ip'";

    $run_cart = mysqli_query($db, $sel_cart);

    $check_cart = mysqli_num_rows($run_cart);

    if($check_cart==0){

    $_SESSION['client_email']=$c_email;

    echo "<script>alert($insert_c)</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";

    }
    else {

    $_SESSION['customer_email']=$c_email;

    echo "<script>alert('Account has been created successfully, Thanks!')</script>";

    echo "<script>window.open('checkout.php','_self')</script>";


    }
  }





?>
