<br>
<table width="740" align="center" bgcolor="black">


	<tr bgcolor="skyblue" align="center">
		<td colspan="7"><h2>Your Orders:</h2></td>
	</tr>

	<tr align="center" bgcolor="skyblue">
		<th>No</th>
    <th>Order id</th>
		<th>No Invoice</th>
    <th>Total</th>
		<th>Order Date</th>
		<th>Status</th>
    <th>Detail</th>
	</tr>
	<?php
	include("includes/db.php");

	$get_order = "select * from client_orders where kd_client='$c_id'";

	$run_order = mysqli_query($con, $get_order);

	$i = 0;

	while ($row_order=mysqli_fetch_array($run_order)){

		$order_id = $row_order['order_id'];
		$invoice = $row_order['invoice'];
    $amount = $row_order['amount'];
		$order_date = $row_order['order_date'];
		$status = $row_order['order_status'];
		$i++;
		$phpdate = strtotime( $order_date );
		$mysqldate = date( 'd-m-Y H:i:s', $phpdate );

	?>
	<tr align="center" bgcolor="#FFF">
		<td><?php echo $i;?></td>
		<td><?php echo $order_id;?></td>
		<td><?php echo $invoice;?></td>
    <td>Rp.<?php echo number_format($amount,0,".",".") ?></td>
		<td><?php echo $mysqldate;?></td>
		<td><?php echo $status;?></td>
    <td><?php echo "<a href='my_account.php?detail_order&order_id=$order_id'>detail</a>"?></td>

	</tr>
	<?php } ?>
</table>
<br>
<a href="my_account.php"><button type="button" name="button" style="float:left;">Back</button></a>
<br>
<br>
<br>
