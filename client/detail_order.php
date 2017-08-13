<br>
<table width="740" align="center" bgcolor="black">


	<tr bgcolor="skyblue" align="center">
		<td colspan="7"><h2>Your Orders details:</h2></td>
	</tr>

	<tr align="center" bgcolor="skyblue">

    <th>Order id</th>
		<th>Nama Layanan</th>
    <th>Lama Kontrak</th>
    <th>Keterangan</th>
	</tr>
	<?php
  if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
  }
    $get_detail = "select * from detail_orders where order_id='$order_id'";
  	$run_detail = mysqli_query($db, $get_detail);
    $row_detail= mysqli_fetch_array($run_detail);
    $kdproduk = $row_detail['kdproduk'];
    $kontrak = $row_detail['kontrak'];
    $keterangan = $row_detail['keterangan'];

    $get_pro = "select * from products where kdproduk='$kdproduk'";
  	$run_pro = mysqli_query($db, $get_pro);
    $row_pro= mysqli_fetch_array($run_pro);
    $nmproduk = $row_pro['nmproduk'];
  ?>
	<tr align="center" bgcolor="#FFF">
		<td><?php echo $order_id;?></td>
		<td><?php echo $nmproduk;?></td>
    <td><?php echo $kontrak;?> bulan</td>
		<td><?php echo $keterangan;?></td>


	</tr>
</table>
<br>
<a href="my_account.php?my_orders"><button type="button" name="button" style="float:left;">Back</button></a>
<br>
<br>
<br>
