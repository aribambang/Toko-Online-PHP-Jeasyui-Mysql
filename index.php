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
        <li><a href="http://www.jktserver.com/">Home</a><b style='color:yellow;'> |</b></li>
        <li><a href="client/my_account.php">My Account</a><b style='color:yellow;'> |</b></li>
        <li><a href="cart.php">Keranjang</a><b style='color:yellow;'> |</b></li>
        <li><a href="http://www.jktserver.com/kontak">Kontak</a></li>
      </ul>

      <ul id="menua">
        <li>
        <?php
             if (isset($_SESSION['client_email'])) {
                 echo "<b>Welcome: </b>" . $_SESSION['client_email'] . "<b style='color:yellow;'> |</b>" ;
             } else {
                 echo "<b>Welcome Guest<b style='color:yellow;'> |</b></b>";
             }
             ?>
        </li>
        <li><?php
        if (!isset($_SESSION['client_email'])) {
            echo "<a href='checkout.php'>Login</a>";
        } else {
            echo "<a href='client/logout.php' >Logout</a>";
        }
        ?>
      </a></li>
      </ul>

<!--
      <div id="form">
        <form action="result.php" method="get" enctype="multipart/form-data">
          <input type="text" name="user_query" placeholder="Cari produk disni"/>
          <input type="submit" name="search" value="Cari">

        </form>
      </div>

    -->
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

          </div>
        </div>
        <?php
          cart();
         ?>
        <div id="product_boxx">
          <?php
          if (!isset($_SESSION['client_email'])) {
              include("login.php");
          } else {
              echo "<script>window.open('client/my_account.php','_self')</script>";
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
