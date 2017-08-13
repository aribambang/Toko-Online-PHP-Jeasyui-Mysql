<?php
  session_start();
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
        <li><a href="http://www.jktserver.com/">Home</a><b style='color:yellow;'> |</b></li>
        <li><a href="client/my_account.php">My Account</a><b style='color:yellow;'> |</b></li>
        <li><a href="cart.php">Keranjang</a><b style='color:yellow;'> |</b></li>
        <li><a href="http://www.jktserver.com/kontak">Kontak</a></li>
      </ul>

      <ul id="menua">
        <li>
        <?php
             if(isset($_SESSION['client_email'])){
               echo "<b>Welcome: </b>" . $_SESSION['client_email'] . "<b style='color:yellow;'> |</b>" ;
             }
             else {
               echo "<b>Welcome Guest<b style='color:yellow;'> |</b></b>";
             }
             ?>
        </li>
        <li><?php
        if (!isset($_SESSION['client_email'])) {
          echo "<a href='index.php'>Login</a>";
        }
        else {
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
          Layanan:
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

            $pro_title = $row_product['nmproduk'];
            $pro_cat = $row_product['kdkategori'];
            $pro_desc = $row_product['deskripsi'];
            $pro_fas = $row_product['fasilitas'];
            $pro_price = $row_product['harga'];
            $tahun = $pro_price * 10;
          }}

            ?>
            <div id='single_product'>
            <form action='config.php?pro_id=<?php echo $product_id ?>' method='post' enctype='multipart/form-data'>
              <table border='1' width='600px'>
              <tr>
              <td>
              <input type='text' name='kd' value='<?php echo $product_id ?>' style='display:none;'>
              <h2><b><?php echo $pro_title ?></b></h2><br>
              <h3>Rp.<?php echo number_format($pro_price,0,".",".") ?>/bulan</h3><br>
              <h4><?php echo $pro_desc ?></h4>

              </td>
              <td>
              <h2><b>Fasilitas:</b></h2><br>
              <h4><?php echo $pro_fas ?></h4>
              </td>
              </tr>
              <tr><td><br><hr></><td><br><hr></td></tr>
              <tr>
              <td>Lama Kontrak: <br>
              <input type='radio' name='kontrak' value='1'> Bulanan (Rp.<?php echo number_format($pro_price,0,".",".") ?>) <br>
              <input type='radio' name='kontrak' value='12'> Tahunan (Rp.<?php echo number_format($tahun,0,".",".") ?>)
              </td>
              <td>Keterangan:<br>
              <textarea name='keterangan' cols='30' rows='5' value='-' placeholder='contoh: os, maintenance, etc.'></textarea>
              </td>
              </tr>
              <tr>
              <td><br>
              <input type='submit' name='goback' value='Go Back'/>
              <input type='submit' name='simpan' value='Simpan'/>
              </td>
              <td></td>
              </tr>
              </table>
              </form>
              </div>


          <?php
          if(isset($_POST['simpan'])) {

            global $db;
            $kontrak = $_POST['kontrak'];
            $keterangan = $_POST['keterangan'];
            $ip_add = getIPAddr();
            if ($product_id=='') {
              echo "<script>alert('Tidak ada item')</script>";
              exit();
            }
            elseif ($kontrak=='') {
              echo "<script>alert('Masukkan lama kontrak')</script>";
              exit();
            }
            elseif ($kontrak=='1') {
              $htotal=$pro_price;
            }
            else {
                $htotal = (10 * $pro_price);
            }

            $check_pro = "select * from cart where ip_add='$ip_add' and kdproduk='$product_id'";
            $run_check = mysqli_query($db, $check_pro);

              if (mysqli_num_rows($run_check)>0) {
              //echo "$run_check";
                echo "<script>alert('Sudah terdaftar dalam keranjang')</script>";
                echo "<script>window.open('cart.php','_self')</script>";
              }else {
              $sql1 = "insert into cart (kdproduk,ip_add,kontrak,keterangan,htotal) values ('$product_id','$ip_add','$kontrak','$keterangan','$htotal')";
              $run_sql = mysqli_query($db, $sql1);
              echo "<script>alert('Berhasil disimpan dalam keranjang')</script>";
              echo "<script>window.open('cart.php','_self')</script>";
            }
          }
            if (isset($_POST['goback'])) {
              echo "<script>window.open('http://www.jktserver.com','_self')</script>";
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
