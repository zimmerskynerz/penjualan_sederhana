<!DOCTYPE html>
<?php
include('koneksi.php');
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Dashboard">
  <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
  <title>Maya Antique - Menu Login</title>

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Bootstrap core CSS -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--external css-->
  <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

  <!-- =======================================================
    Template Name: Dashio
    Template URL: https://templatemag.com/dashio-bootstrap-admin-template/
    Author: TemplateMag.com
    License: https://templatemag.com/license/
  ======================================================= -->
</head>

<body>
  <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
  <div id="login-page">
    <div class="container">
      <form class="form-login" action="cek_login.php" enctype="multipart/form-data" method="post">
        <h2 class="form-login-heading">log in now</h2>
        <div class="login-wrap">
          <input type="text" class="form-control" id="username" name="username" placeholder="User ID" autofocus>
          <br>
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <button class="btn btn-theme btn-block" name="login" value="login" id="login" type="submit"><i class="fa fa-lock"></i> LOG IN</button>
          <hr>
          <a data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i> REGISTER MEMBER</a>
        </div>
      </form>

    </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">REGISTRASI MEMBER</h4>
        </div>
        <div class="modal-body">
          <!--FORM MODAL-->
          <form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
            <fieldset>
              <label>USERNAME</label>
              <div class="input-group">
                <input class="form-control" type="text" name="username" id="username" placeholder="USERNAME">
              </div>
              <label>PASSWORD</label>
              <div class="input-group">
                <input class="form-control" type="password" name="nk_pass" id="nk_pass" placeholder="PASSWORD" min="6">
              </div>
              <label>NAMA MEMBER</label>
              <div class="input-group">
                <input class="form-control" type="text" name="nm_user" id="nm_user" placeholder="Nama Lengkap">
              </div>
              <label>ALAMAT</label>
              <div class="input-group">
                <textarea class="form-control" type="text" name="alamat" id="alamat" placeholder="Alamat Lengkap"></textarea>
              </div>
              <label>KOTA</label>
              <div class="input-group">
                <input class="form-control" type="text" name="kota" id="kota" placeholder="Nama Lengkap">
              </div>
              <label>KODE POS</label>
              <div class="input-group">
                <input class="form-control" type="text" name="kd_pos" id="kd_pos" placeholder="Kode Pos" max="5">
              </div>
              <label>Nomor Telepon</label>
              <div class="input-group">
                <input class="form-control" type="text" name="no_hp" id="no_hp" placeholder="Nomor Telepon" max="13">
              </div>
              <label>Email</label>
              <div class="input-group">
                <input class="form-control" type="email" name="email" id="email" placeholder="Alamat Email">
              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">BATAL</button>
                <button type="submit" name="daftarMember" id="daftarMember" class="btn btn-success">DAFTAR</button>
              </div>
            </fieldset>
          </form>

          <!--END FORM MODAL-->
        </div>

      </div>
    </div>
  </div>
  <!--end modal-->
  <!-- js placed at the end of the document so the pages load faster -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <!--BACKSTRETCH-->
  <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
  <script type="text/javascript" src="lib/jquery.backstretch.min.js"></script>
  <script>
    $.backstretch("img/bg_login2.jpg", {
      speed: 500
    });
  </script>
</body>

</html>