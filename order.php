<?php
include("functions/functions.php");

if (isset($_GET['c_id'])) {
  $kd_client = $_GET['c_id'];

}


$ip_add = getIPAddr();
$sql= "select * from cart where ip_add='$ip_add'";
$run_sql = mysqli_query($db,$sql);
$random = mt_rand();
$invoice =  "INV$random";
$status = "Pending";
$count_row = mysqli_num_rows($run_sql);
if ($count_row=='1') {
  $record=mysqli_fetch_array($run_sql);
    $pro_id = $record['kdproduk'];
    $products_prices =  $record['htotal'];
    $kontrak = $record['kontrak'];
    $keterangan = $record['keterangan'];


    $insert_order = "insert into client_orders (kd_client, amount, invoice, order_status, order_date ) values ('$kd_client','$products_prices','$invoice', '$status', NOW())";
    $run_order = mysqli_query($db, $insert_order);
    if ($run_order) {
      $sel_order = "select * from client_orders where invoice='$invoice'";
      $run_sel_order = mysqli_query($db,$sel_order);
      $record1=mysqli_fetch_array($run_sel_order);
      $order_id = $record1['order_id'];

      $insert_detail = "insert into detail_orders (order_id,kdproduk,kontrak,keterangan,htotal) values ('$order_id','$pro_id','$kontrak','$keterangan','$products_prices')";
      $run_detail = mysqli_query($db,$insert_detail);

      $empty_cart = "delete from cart where ip_add='$ip_add'";
      $run_empty = mysqli_query($db,$empty_cart);
      echo "<script>alert('Order Successfully submitted, Thank you!')</script>";
      echo "<script>window.open('client/my_account.php','_self')</script>";

    }


}


 ?>
