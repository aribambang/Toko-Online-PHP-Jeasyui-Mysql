<?php
  session_start();
  include("functions/functions.php");
?>
<html>
<head>
  <title>JKTSERVER.COM</title>
  <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5.2/themes/metro/easyui.css">
  <link rel="stylesheet" type="text/css" href="jquery-easyui-1.5.2/themes/icon.css">
  <script type="text/javascript" src="jquery-easyui-1.5.2/jquery.min.js"></script>
  <script type="text/javascript" src="jquery-easyui-1.5.2/jquery.easyui.min.js"></script>
  <link rel="stylesheet" href="styles/style.css" media="all" />

  <script type="text/javascript">



  function clearForm(){
      $('#ff').form('clear');
  }

  function submitForm(){
      $('#ff').form('submit');
      url:'php/registrasi.php';
  }


    $.extend($.fn.validatebox.defaults.rules, {
        confirmPass: {
            validator: function(value, param){
                var pass = $(param[0]).passwordbox('getValue');
                return value == pass;
            },
            message: 'Password does not match confirmation.'
        }
    })

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
        <li><a href="http://www.jktserver.com">Home</a></li>
        <li><a href="client/my_account.php">My Account</a></li>
        <li><a href="cart.php">Keranjang</a></li>
        <li><a href="http://www.jktserver.com/kontak/">Contact</a></li>

      </ul>

      <ul id="menua">
        <li><a href="http://www.jktserver.com/"><?php
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
            <b>Welcome Guest!</b>
            <b style="color:yellow;">Pesanan</b>
            <span>- Item: <?php items(); ?> - Price: <?php total_harga(); ?> | <a href="cart.php" style="color:yellow;">Lihat Keranjang</a>
            </span>
          </div>
        </div>
        <?php
          cart();
         ?>
        <div id="product_boxx">
          <form id="ff" action="registrasi.php" method="post" enctype="multipart/form-data">

            <table align="center" width="750">
              <tr>
                <td colspan="6"><br></td>
              </tr>
              <tr align="center">
                <td colspan="6"><h2>Create an Account</h2></td>
              </tr>
              <tr>
                <td colspan="6"><br></td>
              </tr>
              <tr>
                <td align="right">Name Depan : </td>
                <td><input class="easyui-textbox" type="text" name="c_namadepan" required/></td>
              </tr>

              <tr>
                <td align="right">Name Belakang : </td>
                <td><input class="easyui-textbox" type="text" name="c_namabelakang" required/></td>
              </tr>

              <tr>
                <td align="right">Email : </td>
                <td><input class="easyui-textbox" type="text" name="c_email" data-options="required:true,validType:'email'" /></td>
              </tr>

              <tr>
                <td align="right">Password : </td>
                <td><input id="pass" class="easyui-passwordbox" name="c_pass" required/></td>
              </tr>

              <tr>
                <td align="right">Confirm Password : </td>
                <td><input class="easyui-passwordbox" name="c_pass1" validType="confirmPass['#pass']" required/></td>
              </tr>

              <tr>
                <td align="right">Nama Perusahaan : </td>
                <td><input class="easyui-textbox" type="text" name="c_perusahaan" required/></td>
              </tr>

              <tr>
                <td align="right">Alamat 1 : </td>
                <td><input class="easyui-textbox" type="text" name="c_address1" required/></td>
              </tr>

              <tr>
                <td align="right">Alamat 2 : </td>
                <td><input class="easyui-textbox" type="text" name="c_address2" required/></td>
              </tr>

              <tr>
                <td align="right">Kota : </td>
                <td><input class="easyui-textbox" type="text" name="c_kota" required/></td>
              </tr>
              <tr>
                <td align="right">Provinsi : </td>
                <td><input class="easyui-textbox" type="text" name="c_provinsi" required/></td>
              </tr>

              <tr>
                <td align="right">Kode Pos : </td>
                <td><input class="easyui-textbox" type="text" name="c_kodepos" required/></td>
              </tr>

              <tr>
                <td align="right">Negera : </td>
                <td>
                <select class="easyui-combobox" style="width:180px;" name="c_negara">
                  <option>Select a Country</option>
                  <option>Indonesia</option>
                </select>

                </td>
              </tr>

              <tr>
                <td align="right">Nomor Telepon : </td>
                <td><input class="easyui-textbox" type="text" name="c_telp" value="+62" required/></td>
              </tr>
              <tr>
                <td align="right">Fax : </td>
                <td><input class="easyui-textbox" type="text" name="c_fax" /></td>
              </tr>

              <tr>
                <td align="right">Handphone : </td>
                <td><input class="easyui-textbox" type="text" name="c_hp" value="+62" required/></td>
              </tr>

              <tr>
                <td colspan="6"><br></td>
              </tr>
            <tr align="center">
              <td colspan="6">
                <input type="hidden" name="register" value="">
                <a href="javascript:void(0)" class="easyui-linkbutton" data-options="iconCls:'icon-ok'" onclick="$('#ff').submit();" name="submit" style="width:100px">Submit</a>
                <a href="index.php" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'" name="cancel" style="width:100px">Cancel</a>
              </td>
            </tr>



            </table>

          </form>
          <br>
          <?php
              if (isset($_POST['register'])) {
                  $ip = getIPAddr();
                  $c_namadepan = $_POST['c_namadepan'];
                  $c_namabelakang = $_POST['c_namabelakang'];
                  $c_email = $_POST['c_email'];
                  $c_pass = $_POST['c_pass'];
                  $c_perusahaan = $_POST['c_perusahaan'];
                  $c_address1 = $_POST['c_address1'];
                  $c_address2 = $_POST['c_address2'];
                  $c_kota = $_POST['c_kota'];
                  $c_provinsi = $_POST['c_provinsi'];
                  $c_kodepos = $_POST['c_kodepos'];
                  $c_negara = $_POST['c_negara'];
                  $c_telp = $_POST['c_telp'];
                  $c_fax = $_POST['c_fax'];
                  $c_hp = $_POST['c_hp'];


                  $check_acc = "select client_email from client where client_email='$c_email'";
                  $run_cek_email = mysqli_query($db, $check_acc);
                  $cek=mysqli_num_rows($run_cek_email);
                  if ($cek==1) {
                      echo "<script>alert('Email anda sudah terdaftar, coba lagi')</script>";
                      exit();
                  }


                  $insert_c = "insert into client (client_email, client_password, namadepan, namabelakang, perusahaan, address1, address2, kota, provinsi, kodepos, negara, telp, fax, hp, ip_add, tglgabung) values ('$c_email','$c_pass','$c_namadepan','$c_namabelakang','$c_perusahaan','$c_address1','$c_address2','$c_kota','$c_provinsi','$c_kodepos','$c_negara','$c_telp','$c_fax','$c_hp','$ip', NOW())";

                  $run_c = mysqli_query($db, $insert_c);

                  $sel_cart = "select * from cart where ip_add='$ip'";

                  $run_cart = mysqli_query($db, $sel_cart);

                  $check_cart = mysqli_num_rows($run_cart);

                  if ($check_cart==0) {
                      $_SESSION['client_email']=$c_email;

                      echo "<script>alert('Akun anda berhasil terdaftar')</script>";
                      echo "<script>window.open('client/my_account.php','_self')</script>";
                  } else {
                      $_SESSION['customer_email']=$c_email;

                      echo "<script>alert('Akun anda berhasil terdaftar')</script>";

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
