<?php
  include("includes/db.php");
  include("functions/functions.php");
?>
<html>
<head>
  <title>JKTSERVER.COM</title>
  <link rel="stylesheet" href="styles/style.css" media="all" />
</head>
<body>
  <!--Main Container Starts-->

  <div class="main_wrapper">

    <!--Header Start -->
    <div class="header_wrapper">
      <h3>JKTSERVER.COM<h3>
    </div>
    <!--Header End-->

    <div id="navbar">
      <ul id="menu">
        <li><a href="www.jktserver.com">Home</a></li>
        <li><a href="client/my_account.php">My Account</a></li>
        <li><a href="cart.php">Keranjang</a></li>
        <li><a href="http://www.jktserver.com/kontak/">Contact</a></li>

      </ul>

      <div id="form">
        <form action="result.php" method="get" enctype="multipart/form-data">
          <input type="text" name="user_query" placeholder="Cari produk disni"/>
          <input type="submit" name="search" value="Cari">

        </form>
      </div>
    </div>

    <div class="content_wrapper">

      <div id="left_sidebar">
        <div id="sidebar_title">
          Layanan
        </div>
        <ul id="cats">
          <?php
            getCat();
          ?>
        </ul>
      </div>

      <div id="right_content">
        <div id="headline">
          <div id="headline_content">
            <b>
              <?php
					         if(isset($_SESSION['client_email'])){
                     echo "<b>Welcome: </b>" . $_SESSION['client_email'] . "<b style='color:yellow;'> |</b>" ;
                   }
                   else {
                     echo "<b>Welcome Guest:</b>";
                   }
                   ?>
            </b>
            <b style="color:yellow;">Orderan</b>
            <span>- Item: <?php items(); ?> - Harga: <?php total_harga(); ?> | <a href="cart.php" style="color:yellow;">Lihat Keranjang</a>
            &nbsp
            <?php
            if (!isset($_SESSION['client_email'])) {
              echo "<a href='checkout.php' style='color:#F93;'>Login</a>";
            }
            else {
                echo "<a href='client/logout.php' style='color:#F93;'>Logout</a>";
            }
            ?>
            </span>
          </div>
        </div>
        <div id="product_box">
          <?php
          if(isset($_GET['search'])){
            $keyword = $_GET['user_query'];
            $get_product = "select * from products where keyword like '%$keyword%'";
            $run_product = mysqli_query($con, $get_product);

            $count = mysqli_num_rows($run_product);
            if($count==0){
              echo "<br><h5>Layanan tidak ditemukan diketegori</h5>";
            }

            while ($row_product=mysqli_fetch_array($run_product)){
            $pro_id = $row_product['kdproduk'];
            $pro_title = $row_product['nmproduk'];
            $pro_cat = $row_product['kdkategori'];
            $pro_desc = $row_product['deskripsi'];
            $pro_price = $row_product['harga'];

            echo "
            <div id='single_product'>
              <h2><b>$pro_title</b></h2><br>
              <h3>Rp.$pro_price/bulan</h3><br>
              <h4>$pro_desc</h4>
              <br>
              <a href='details.php?pro_id=$pro_id' style='float:left;'>Detail</a>
              <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Pesan</button></a>
            </div>";
          }
        }
          ?>
        </div>

      </div>
    </div>


    <div class="footer">
      <h3 style="color:#000; padding-top:30px; text-align:center;">&copy 2017 JKTSERVER.COM</h3>
    </div>
  </div>
</body>
</html>
