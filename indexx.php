<?php
  session_start();
  include("functions/functions.php")
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
        <li><a href="index.php">Home</a></li>
        <li><a href="client/my_account.php">My Account</a></li>
        <li><a href="cart.php">Keranjang</a></li>
        <li><a href="#">Kontak</a></li>

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
        <?php
          cart();
         ?>
        <div id="product_box">
          <?php
            getPro();
            getCatPro();
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
