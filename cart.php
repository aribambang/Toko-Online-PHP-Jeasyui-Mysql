<?php
  session_start();
  include("includes/db.php");
  include("functions/functions.php")
?>
<html>
<head>

  <title>JKTSERVER.COM</title>
  <link rel="stylesheet" href="styles/style.css" media="all" />
  <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5.2/themes/metro/easyui.css">
  <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5.2/themes/icon.css">
  <script type="text/javascript" src="jquery-easyui-1.5.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery-easyui-1.5.2/jquery.easyui.min.js"></script>


  <script>
  function refreshHarga(value,name,id){
    //window.alert(id*value);
    var $tot = (id*value);

    document.getElementById(name).innerHTML= ($tot);
  }
  </script>
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
        <li><a href="http://www.jktserver.com">Home</a><b style='color:yellow;'> |</b></li>
        <li><a href="client/my_account.php">My Account</a><b style='color:yellow;'> |</b></li>
        <li><a href="cart.php">Keranjang</a><b style='color:yellow;'> |</b></li>
        <li><a href="http://www.jktserver.com/kontak/">Contact</a><b style='color:yellow;'> |</b></li>

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
          echo "<a href='checkout.php'>Login</a>";
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
        <div id="product_box"><br>
          <form action="cart.php" method="post" enctype="multipart/form-data">
            <br><br>
          <table width="600px" border="1" style="bordercolor:#7095d1;" bgcolor="#7095d1">
            <tr height="10px" align="center" style="background-color:yellow;">

              <td><b>Layanan</b></td>
              <td><b>Lama Kontrak</b></td>
              <td><b>Harga (Rp)</b></td>
            </tr>
            <?php
              global $db;
              $ip_add = getIPAddr();
              $total = 0;
              $sql_harga = "select * from cart where ip_add ='$ip_add'";
              $run_sql_harga = mysqli_query($db,$sql_harga);

              while ($record=mysqli_fetch_array($run_sql_harga)) {
                $pro_id = $record['kdproduk'];
                $pro_kontrak = $record['kontrak'];
                $htotal = $record['htotal'];

                $htotal1 = array($record['htotal']);
                $value = array_sum($htotal1);
                $total += $value;
                $pro_price = "select * from products where kdproduk='$pro_id'";
                $run_pro_price = mysqli_query($db,$pro_price);

                while ($p_harga=mysqli_fetch_array($run_pro_price)) {


                  $products_prices = array($p_harga['harga']);
                  $only_prices = $p_harga['harga'];
                  $products_title = $p_harga['nmproduk'];
                  $products_desc = $p_harga['deskripsi'];




             ?>
             <br>
             <tr align="center" style="background-color:white;">

               <td>
                 <input type="hidden" name="remove[]" value="<?php echo $pro_id ?>">
                 <b><?php echo $products_title ?></b><br><br><?php echo $products_desc ?></td>
               <td>
                 <?php echo $pro_kontrak ?> Bulan
               </td>
               <td><?php echo number_format($htotal,0,".",".") ?></td>
             </tr>

             <?php }} ?>
             <tr style="background-color:white;align:right;">
               <td colspan="2" align="right">Subtotal : </td>
               <td> Rp. <?php echo number_format($total,0,".",".") ?></td>
             </tr>
             </table>
             <br>
             <table width="600px" border="0" style="bordercolor:#7095d1;" bgcolor="#FFF">
             <tr>
               <td colspan="2"><input type="submit" name="update" value="Batalkan"/></td>
              <!-- <td><input type="submit" name="continue" value="Add Item"/></td> -->
               <td><input type="submit" name="checkout" value="Check Out"/></td>
             </tr>
             </table>


          </form>
          <?php
            if(isset($_POST['update'])) {
              if ($_POST['remove'] == '') {
                echo "<script>window.open('http://www.jktserver.com','_self')</script>";
              }else {


              foreach($_POST['remove'] as $remove_id) {
                $delete_products = "delete from cart where kdproduk='$remove_id'";
                $run_delete = mysqli_query($db, $delete_products);
                echo "<script>window.open('http://www.jktserver.com','_self')</script>";
                }
              }
            }
              elseif (isset($_POST['continue'])) {
                echo "<script>window.open('http://www.jktserver.com','_self')</script>";
              }
              elseif (isset($_POST['checkout'])) {
                if ($total == '0') {
                echo "<script>alert('Tidak ada item yang dipesan')</script>";
                echo "<script>window.open('http://www.jktserver.com','_self')</script>";
              }else {
                echo "<script>window.open('checkout.php','_self')</script>";
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
