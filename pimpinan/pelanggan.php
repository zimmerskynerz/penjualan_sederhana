<?php
include('../koneksi.php');
include('../session.php'); 

$result=mysqli_query($conn, "select * from tb_user where username='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$id_user = $row['id_user'];



//Membuat batasan waktu sesion untuk user di PHP 
$timeout = 5; // Set timeout menit
$logout_redirect_url = "../index.php"; // Set logout URL
 
$timeout = $timeout * 50; // Ubah menit ke detik
if (isset($_SESSION['start_time'])) {
    $elapsed_time = time() - $_SESSION['start_time'];
    if ($elapsed_time >= $timeout) {
        session_destroy();
        echo "<script>alert('Waktu Anda Telah Habis Broo!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?> 

<!DOCTYPE html>
<html lang="en">
  <head>


    <title>MENU PIMPINAN</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="assets/css/main.css">
   <link rel="stylesheet" href="assets/css/dataTables.bootstrap.css">		
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->

  </head>
	<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<div class="sidebar">
			<div class="brand"><a href="index.php"><img src="assets/img/header2.png" class="img-responsive logo"></a></div>
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
                         <br><br>
						<li><a href="pegawai.php" class=""><i class="fa fa-book"></i> <span>Daftar Pegawai</span></a></li>
						<li><a href="pelanggan.php" class="active"><i class="fa fa-book"></i> <span>Daftar Pelanggan</span></a></li>
						<li><a href="transaksi.php" class=""><i class="fa fa-book"></i> <span>Daftar Transaksi</span></a></li>
						<li><a href="logout.php" class=""><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                      
				  </ul>
				</nav>
			</div>
			
	  </div>
		<div class="main">
        <?php
		$Date = Date("Y-m-d");
		?>
        <!-- NAVBAR -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
						<legend> W E L C O M E </legend>
						<h1>
						<tr>
						
						<?php echo "<td align='left'>".$row['nm_user']."</td>"; ?>
						
						</tr>
						</h1>
					
				</div>
			</nav>
			<!-- END NAVBAR -->
        
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Data Pelanggan</h3>
					<div class="row">
                    	
                    	<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                            <div class="panel-title">
								<div class="container">
								<!-- Button trigger modal -->
                                <br>							
                                
								<div class="modal fade" id="editProfil" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Edit Data Diri</h4>
                                      </div>
                                      <div class="modal-body">
                                        <!--FORM MODAL-->
										<form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
											<fieldset>
											<div class="input-group">
											<input type="text" value="<?php echo $row['id_user']; ?>"  name="id_user" id="id_user" hidden> 
											</div>
											
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Username</label>
											  <div class="col-lg-10">
												<input class="form-control" id="username_u" name="username" type="text" value="<?php echo $row['username']; ?>">
											  </div>
											</div>
											
											<div class="form-group">											
											  <label for="inputnim" class="col-lg-2 control-label">Password</label>
											  <div class="col-lg-10">
												<input class="form-control" id="password" name="password" type="password" value="<?php echo $row['password']; ?>">
											  </div>
											</div>

											<div class="form-group">											
											  <label for="inputnim" class="col-lg-2 control-label">Nama</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nm_user" name="nm_user" value="<?php echo $row['nm_user']; ?>" type="text">
											  </div>
											</div>
											
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Alamat</label>
											  <div class="col-lg-10">
												<textarea class="form-control" id="alamat" name="alamat"><?php echo $row['alamat']; ?></textarea>
											  </div>
											</div>  
											
											
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kota</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kota" name="kota" value="<?php echo $row['kota']; ?>" type="text">
											  </div>
											</div>
											
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kode POS</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kode_pos" name="kode_pos" value="<?php echo $row['kode_pos']; ?>" type="text">
											  </div>
											</div>
											
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">No HP</label>
											  <div class="col-lg-10">
												<input class="form-control" id="no_hp" name="no_hp" value="<?php echo $row['no_hp']; ?>" type="text" max="13">
											  </div>
											</div>
											
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Email</label>
											  <div class="col-lg-10">
												<input class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>" type="email">
											  </div>
											</div>
											
											<div class="form-group">
											  <div class="col-lg-10 col-lg-offset-2">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" id="updateUsr" name="updateUsr" class="btn btn-primary">Simpan</button>
											  </div>
											</div>
											</fieldset>
										</form>

<!--END FORM MODAL-->
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
								
								
								
								<div class="modal fade" id="cetak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Cetak Laporan</h4>
                                      </div>
                                      <div class="modal-body">
                                        <!--FORM MODAL-->
										<form class="form-horizontal" method="post" action="cetak_laporan.php" enctype="multipart/form-data">
											<fieldset>
											<div class="input-group">
											<input type="text" value="<?php echo $row['id_user']; ?>"  name="id_user" id="id_user" hidden> 
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Tanggal Awal</label>
											  <div class="col-lg-10">
												<input class="form-control" id="tawal" placeholder="Password" name="tawal" type="date" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Tanggal Akhir</label>
											  <div class="col-lg-10">
												<input class="form-control" id="takhir" placeholder="Password" name="takhir" type="date" required>
											  </div>
											</div>
											<div class="form-group">
											  <div class="col-lg-10 col-lg-offset-2">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" id="cetak" name="cetak" class="btn btn-primary">Cetak</button>
											  </div>
											</div>
											</fieldset>
										</form>

<!--END FORM MODAL-->
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                                      </div>
                                      <div class="modal-body">
                                        <!--FORM MODAL-->
										<form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
											<fieldset>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Username</label>
											  <div class="col-lg-10">
												<input class="form-control" id="username" placeholder="Username" name="username" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Password</label>
											  <div class="col-lg-10">
												<input class="form-control" id="password" placeholder="Password" name="password" type="password" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nama User</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nm_user" placeholder="Nama User" name="nm_user" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Alamat</label>
											  <div class="col-lg-10">
												<textarea class="form-control" id="alamat" placeholder="Alamat Lengkap" name="alamat" required></textarea>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kota</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kota" placeholder="Kota/Kabupaten" name="kota" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kode Pos</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kode_pos" placeholder="Kode Pos" name="kode_pos" type="text" max="5" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nomor HP</label>
											  <div class="col-lg-10">
												<input class="form-control" id="no_hp" placeholder="Nomor Telepon" name="no_hp" type="text" max="13" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Email</label>
											  <div class="col-lg-10">
												<input class="form-control" id="email" placeholder="Alamat Email User" name="email" type="email" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Jabatan</label>
											  <div class="col-lg-10">
												<select name="level" id="level" width = "30px">
												<option value="kasir">Kasur</option>
												<option value="gudang">Gudang</option>
												<option value="pelanggan">Pelanggan</option>
												</select>
											  </div>
											</div>
											<div class="form-group">
											  <div class="col-lg-10 col-lg-offset-2">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary" id="simpanUser" name="simpanUser">Simpan</button>
											  </div>
											</div>
											</fieldset>
										</form>

<!--END FORM MODAL-->
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                <!--end modal-->
<!--        untuk edit-->
        <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        </div>

        <div id="ModalDelete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        </div>		
                                </div>    
								</div>
								<div class="panel-body">
									<table id="example1" class="table table-hover">
										<thead>
											<tr>
												<th>Username</th>
												<th>Nama</th>
                                                <th>Jabatan</th>		
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                $sql_tampil = "select * from tb_user where level='pelanggan'";
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td><?php echo $data['username'] ?></td>
                                <td><?php echo $data['nm_user'] ?></td>																								
								<td><?php echo $data['level'] ?></td>
                                 <td>
                                    <a href="#" class='btn btn-warning open_modal' id='<?php echo $data['id_user']; ?>'><span class="lnr lnr-pencil"></span></a>
                                    <a href="#" class='btn btn-danger open_delete' id='<?php echo $data['id_user']; ?>'><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                            <?php
                               
                                }
                            ?>
										</tbody>
									</table>
								</div>
								</div>
							</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
	<script src="assets/js/plugins/chartist/chartist.min.js"></script>
	<script src="assets/js/klorofil.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>	
    <script type="text/javascript">	
	  <script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
    </script>

    <script type="text/javascript">
            $(document).ready(function (){
                $(".open_modal").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "update_user.php",
                        type: "GET",
                        data : {id_user: m,},
                        success: function (ajaxData){
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_delete").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "delete_user.php",
                        type: "GET",
                        data : {id_user: m,},
                        success: function (ajaxData){
                            $("#ModalDelete").html(ajaxData);
                            $("#ModalDelete").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
				<script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap.js"></script>	
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
        </script>
	</body>
</html>