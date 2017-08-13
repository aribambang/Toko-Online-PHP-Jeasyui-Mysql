<!DOCTYPE>
<?php
session_start();
include("functions/functions.php");

if (!isset($_SESSION['client_email'])) {
  echo "<script>window.open('../index.php','_self')</script>";
}
else {
  echo "";
}

?>



<html>
	<head>
		<title>JKTSERVER.COM</title>


	<link rel="stylesheet" href="styles/styles.css" media="all" />
	</head>

<body>

	<!--Main Container starts here-->
	<div class="main_wrapper">

		<!--Header starts here-->
		<div class="header_wrapper">
		<h3>JKTSERVER.COM<h3>
		</div>
		<!--Header ends here-->

		<!--Navigation Bar starts-->
		<div class="menubar">

			<ul id="menu">
				<li><a href="ecommerce/index.php">Home</a></li>
				<li><a href="../cart.php">Shopping Cart</a></li>
				<li><a href="#">Contact Us</a></li>

			</ul>
<!--
			<div id="form">
				<form method="get" action="results.php" enctype="multipart/form-data">
					<input type="text" name="user_query" placeholder="Search a Product"/ >
					<input type="submit" name="search" value="Search" />
				</form>

			</div>
-->
		</div>
		<!--Navigation Bar ends-->

		<!--Content wrapper starts-->
		<div class="content_wrapper">

			<div id="sidebar">

				<div id="sidebar_title">My Account:</div>

				<ul id="cats">
				<?php
				$user = $_SESSION['client_email'];

				$get_img = "select * from client where client_email='$user'";

				$run_img = mysqli_query($db, $get_img);

				$row_img = mysqli_fetch_array($run_img);


				$c_name = $row_img['namadepan'];
        $c_lastlogin = $row_img['lastlogin'];

        $phpdate = strtotime( $c_lastlogin );
        $mysqldate = date( 'd-m-Y H:i:s', $phpdate );
				echo "<br><p style='text-align:center;color:#FFF'>Nama: <b>$c_name</b><br>Last Login:<br> $mysqldate </p>";


				?>
        <br>
				<li><a href="my_account.php?my_orders">My Orders</a></li>
				<li><a href="my_account.php?edit_account">Edit Account</a></li>
				<li><a href="my_account.php?change_pass">Change Password</a></li>
				<li><a href="logout.php">Logout</a></li>

				<ul>

				</div>


			<div id="content_area">

			<?php cart(); ?>


				<div id="products_box">


          <?php $c = $_SESSION['client_email'];
          $get_c = "select * from client where client_email='$c'";
          $run_c = mysqli_query($db,$get_c);
          $row_c = mysqli_fetch_array($run_c);
          $c_id = $row_c['kd_client']; ?>
				<?php
				if(!isset($_GET['my_orders'])){
					if(!isset($_GET['edit_account'])){
						if(!isset($_GET['change_pass'])){
              if(!isset($_GET['detail_order'])){

				echo "
				<h2 style='padding:20px;'>Welcome:  $c_name </h2>
				<b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";

        }
				}
				}
        }

        if(isset($_GET['my_orders'])){
				include("my_orders.php");
				}
				if(isset($_GET['edit_account'])){
				include("edit_account.php");
				}
				if(isset($_GET['change_pass'])){
				include("change_pass.php");
				}
        if(isset($_GET['detail_order'])){
				include("detail_order.php");
				}

				?>

				</div>

			</div>
		</div>
		<!--Content wrapper ends-->



		<div id="footer">

		<h4 style="text-align:center; padding-top:30px;">&copy; 2017 by jktserver.com</h4>

		</div>






	</div>
<!--Main Container ends here-->


</body>
</html>
