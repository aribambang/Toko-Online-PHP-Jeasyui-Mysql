<?php
  include("includes/db.php");
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
        <li><a href="#">My Account</a></li>
        <li><a href="#">Shopping Cart</a></li>
        <li><a href="#">Contact</a></li>

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
            <b>Welcome Guest!</b>
            <b style="color:yellow;">Shopping cart</b>
            <span>- Item - Price:</span>
          </div>
        </div>
        <div id="product_box">
          <?php
          if(isset($_GET['pro_id'])){
            $product_id = $_GET['pro_id'];
            $get_product = "select * from products where kdproduk='$product_id'";
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
            $pro_fas = $row_product['fasilitas'];
            $pro_price = $row_product['harga'];


            echo "
            <div id='single_product'>
              <table border='1' width='600px'>
              <tr>
              <td>

              <h2><b>$pro_title</b></h2><br>
              <h3>Rp.".number_format($pro_price,0,".",".")."/bulan</h3><br>
              <h4>$pro_desc</h4>
              <br>
              <a href='index.php' style='float:left;'>Go Back</a>
              <a href='config.php?pro_id=$pro_id'><button style='float:right;'>Pesan</button></a>

              </td>
              <td>
              <h2><b>Fasilitas:</b></h2><br>
              <h4>$pro_fas</h4>
              </td>
              </tr>
              </table>
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
