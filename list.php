<?php
include("functions/functions.php");
$get_cats = "select * from kategori";
$run_cats = mysqli_query($db, $get_cats);
while ($row_cats=mysqli_fetch_array($run_cats)){
  $cat_id = $row_cats['kdkategori'];
  $cat_title = $row_cats['nmkategori'];
  $cat_url = $row_cats['url'];

  echo "<li><a href='$cat_url'>$cat_title</a></li>";

}
?>

$ip_add = getIPAddr();
$sql= "select * from cart where ip_add='$ip_add'";
$run_sql = mysqli_query($db,$sql);
$random = mt_rand();
$invoice =  "INV$random";
$status = "Pending";

while ($record=mysqli_fetch_array($run_sql) {
  $pro_id = $record['kdproduk'];
  $products_prices =  $record['htotal'];
}



$insert_order = "insert into client_orders (kd_client, amount, invoice, order_status, order_date ) values ('$kd_client','$products_prices','$invoice', '$status', NOW())";
$run_order = mysqli_query($db, $insert_order);
if ($run_order) {
  echo "<script>alert('Order Successfully submitted, Thank you!')</script>";
  echo "<script>window.open('client/my_account.php','_self')</script>";
  $sel_order = "select * from client_order where kd_client='$kd_client'";
  $run_sel_order = mysqli_query($db,$sel_order);
  while ($record1=mysqli_fetch_array($run_sel_order)) {
    $order_id = $record1['order_id'];
  }

  $sql1= "select * from cart where ip_add='$ip_add'";
  $run_sql1 = mysqli_query($db,$sql1);
  while ($record2=mysqli_fetch_array($run_sql1) {
    $pro_id1 = $record2['kdproduk'];
    $kontrak = $record2['kontrak'];
    $keterangan = $record2['keterangan'];
    $htotal = $record2['htotal'];

    $insert_detail = "insert into detail_orders (order_id,kdproduk,kontrak,keterangan,htotal) values ('$order_id','$pro_id1','$kontrak','$htotal')";
    $run_detail = mysqli_query($db,$insert_detail);

  }
  $empty_cart = "delete from cart where ip_add='$ip_add'";
  $run_empty = mysqli_query($db,$empty_cart);
}
