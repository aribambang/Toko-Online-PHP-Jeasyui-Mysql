<?php
  $db =  mysqli_connect("localhost","root","1234567890","jktserver_client");

  function getIPAddr() {

    if(!empty($_SERVER['HTTP_CLIENT_IP'])){
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    }elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }else {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;

  }



  function cart() {

    if(isset($_GET['add_cart'])){
      global $db;
      $p_id = $_GET['add_cart'];
      $ip_add = getIPAddr();
      $check_pro = "select * from cart where ip_add='$ip_add' and kdproduk='$p_id'";
      $run_check = mysqli_query($db, $check_pro);

      if (mysqli_num_rows($run_check)>0) {
        //echo "$run_check";
        echo "<script>alert('Sudah terdaftar dalam keranjang')</script>";
        echo "<script>window.open('index.php','_self')</script>";
      }

      else {
        $sql = "insert into cart (kdproduk,ip_add) values ('$p_id','$ip_add')";
        $run_sql = mysqli_query($db, $sql);
        echo "<script>window.open('index.php','_self')</script>";
      }

    }

  }

  function items() {
    if (isset($_GET['add_cart'])) {
      global $db;
      $ip_add = getIPAddr();
      $get_items = "select * from cart where ip_add='$ip_add'";
      $run_items = mysqli_query($db,$get_items);
      $count_items = mysqli_num_rows($run_items);
    }
    else {
      global $db;
      $ip_add = getIPAddr();
      $get_items = "select * from cart where ip_add='$ip_add'";
      $run_items = mysqli_query($db,$get_items);
      $count_items = mysqli_num_rows($run_items);
      echo $count_items;
    }
  }

  function total_harga() {
    global $db;
    $ip_add = getIPAddr();
    $total = 0;
    $sql_harga = "select * from cart where ip_add ='$ip_add'";
    $run_sql_harga = mysqli_query($db,$sql_harga);
    while ($record=mysqli_fetch_array($run_sql_harga)) {
      $pro_id = $record['kdproduk'];
      $pro_price = "select * from products where kdproduk='$pro_id'";
      $run_pro_price = mysqli_query($db,$pro_price);
      $products_prices = array($record['htotal']);
      $value = array_sum($products_prices);
      $total += $value;

    }
    echo "Rp.".number_format($total,0,".",".")."";
  }

  function getPro() {
    global $db;

    if(!isset($_GET['cat'])){

    $get_products = "select * from products order by kdproduk";
    $run_products = mysqli_query($db, $get_products);
    while ($row_products=mysqli_fetch_array($run_products)){
      $pro_id = $row_products['kdproduk'];
      $pro_title = $row_products['nmproduk'];
      $pro_cat = $row_products['kdkategori'];
      $pro_desc = $row_products['deskripsi'];
      $pro_price = $row_products['harga'];

      echo "
      <div id='single_product'>
      <table border='0' style='bordercolor:black;width:270px;' bgcolor='black'>
      <tr style='background-color:#FCC;'>
      <td style='margin-left:10px;'>
        <h2><b><center>$pro_title</b></center></h2><br>
        <h3>Rp.".number_format($pro_price,0,".",".")."/bulan</h3><br>
        <h2><b>Spesifikasi:</b></h2><br>
        <h4>$pro_desc</h4>
        <br>
        <a href='config.php?pro_id=$pro_id' style='float:right;'><button>Pesan</button></a>
        <a href='details.php?pro_id=$pro_id' style='float:right;'><button>Detail</button></a>
      </td></tr>
      </table>
      </div>";
    }

  }
}
  function getCatPro() {
    global $db;

    if(isset($_GET['cat'])){
      $cat_id = $_GET['cat'];
      $get_cat_pro = "select * from products where kdkategori='$cat_id'";
      $run_cat_pro = mysqli_query($db, $get_cat_pro);

      if($cat_id==1){
        echo "<br><h5>Daftar Paket Dedicated Server</h5>";
      }
      elseif ($cat_id==2) {
        echo "<br><h5>Daftar Paket Colocation Server</h5>";
      }
      elseif ($cat_id==3) {
        echo "<br><h5>Daftar Paket Virtual Private Server</h5>";
      }
      $count = mysqli_num_rows($run_cat_pro);
      if($count==0){
        echo "<br><h5>Layanan tidak ditemukan diketegori</h5>";
      }

      while ($row_cat_pro=mysqli_fetch_array($run_cat_pro)){
      $pro_id = $row_cat_pro['kdproduk'];
      $pro_title = $row_cat_pro['nmproduk'];
      $pro_cat = $row_cat_pro['kdkategori'];
      $pro_desc = $row_cat_pro['deskripsi'];
      $pro_price = $row_cat_pro['harga'];

      echo "
      <div id='single_product'>
      <table border='1'>
      <tr>
      <td>
        <h2><b>$pro_title</b></h2><br>
        <h3>Rp.".number_format($pro_price,0,".",".")."/bulan</h3><br>
        <h4>$pro_desc</h4>
        <br>
        <a href='details.php?pro_id=$pro_id' style='float:left;'>Detail</a>
        <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Pesan</button></a>
      </td></tr></table>
      </div>";
    }
  }

  }

  function getCat(){
    global $db;
    $get_cats = "select * from kategori";
    $run_cats = mysqli_query($db, $get_cats);
    while ($row_cats=mysqli_fetch_array($run_cats)){
      $cat_id = $row_cats['kdkategori'];
      $cat_title = $row_cats['nmkategori'];

      echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";

    }

  }

  function getDefault(){
    global $db;
    $c = $_SESSION['client_email'];
    $get_c = "select * from client where client_email='$c'";
    $run_c = mysqli_query($db,$get_c);
    $row_c = mysqli_fetch_array($run_c);
    $c_id = $row_c['kd_client'];

  }

 ?>
