<?php
include('koneksi.php');
include('session.php'); 

$result=mysqli_query($conn, "select * from tb_user where username='$session_id'")or die('Error In Session');
$data=mysqli_fetch_array($result);
$id_user = $data['id_user'];

$result1=mysqli_query($conn, "select count(*) as keranjang from rinci_beli where id_user='$id_user' and status='rencana_beli' ");
$row1=mysqli_fetch_array($result1);

//Membuat batasan waktu sesion untuk user di PHP 
?>

<!DOCTYPE html>
<html lang="en">
  <head>


    <title>Menu Admin</title>

    <!-- Bootstrap -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">

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
	<link rel="stylesheet" href="admin/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="admin/assets/css/main.css">
    <link rel="stylesheet" href="admin/assets/css/dataTables.bootstrap.css">	
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->

  </head>
	<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<div class="sidebar">
			<div class="brand"><a href="member.php"><img src="admin/assets/img/header2.png" class="img-responsive logo"></a></div>
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
                         <br><br>
						<li><a href="product.php" class=""><i class="fa fa-book"></i> <span>Daftar Furniture</span></a></li>
						<li><a href="cart.php" class=""><i class="fa fa-shopping-cart"></i> <span>Keranjang (<?php echo $row1['keranjang']; ?>)</span></a></li>
						<li><a href="status.php" class=""><i class="fa fa-refresh"></i> <span>Status Transaksi</span></a></li>
						<li><a href="logout.php" class=""><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                      
				  </ul>
				</nav>
			</div>
			
	  </div>
		<div class="main">
        
        <!-- NAVBAR -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
						<legend> W E L C O M E </legend>
						<h1>
						<tr>
						
						<?php echo "<td align='left'>".$data['nm_user']."</td>"; ?>
						
						</tr>
						</h1>
						
					
				</div>
			</nav>
			<!-- END NAVBAR -->
        
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Data Diri</h3>
					<div class="row">
                    			
								
<!--        untuk edit-->
        <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        </div>

        		
                                </div>    
								</div>
								<div class="panel-body">
									<form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
											<div class="input-group">
											<input type="text" value="<?php echo $data['id_user']; ?>"  name="id_user" id="id_user" hidden> 
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Username</label>
											  <div class="col-lg-10">
												<input class="form-control" id="username" value="<?php echo $data['username']; ?>" name="username" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Password</label>
											  <div class="col-lg-10">
												<input class="form-control" id="password" value="<?php echo $data['password']; ?>" name="password" type="password" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nama User</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nm_user" value="<?php echo $data['nm_user']; ?>" name="nm_user" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Alamat</label>
											  <div class="col-lg-10">
												<textarea class="form-control" id="alamat" name="alamat" required><?php echo $data['alamat']; ?></textarea>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kota</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kota" value="<?php echo $data['kota']; ?>" name="kota" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kode Pos</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kode_pos" value="<?php echo $data['kode_pos']; ?>" name="kode_pos" type="text" max="5" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nomor HP</label>
											  <div class="col-lg-10">
												<input class="form-control" id="no_hp" value="<?php echo $data['no_hp']; ?>" name="no_hp" type="text" max="13" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Email</label>
											  <div class="col-lg-10">
												<input class="form-control" id="email" value="<?php echo $data['email']; ?>" name="email" type="email" required>
											  </div>
											</div>
                            <div class="modal-footer">
                                <button type="submit" id="updateUser" name="updateUser" class="btn btn-success fa fa-save" > Simpan</button>
                            </div>
            </form>
								</div>
								</div>
							</div>
							
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
                                        <h4 class="modal-title" id="myModalLabel">Edit Data Diri!</h4>
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
												<input class="form-control" id="username_u" name="username" type="text" value="<?php echo $row['username_u']; ?>">
											  </div>
											  <label for="inputnim" class="col-lg-2 control-label">Password</label>
											  <div class="col-lg-10">
												<input class="form-control" id="password_u" name="password_u" type="password" value="<?php echo $row['password_u']; ?>">
											  </div>
											  <label for="inputnim" class="col-lg-2 control-label">Nama</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nama_user" name="nama_user" value="<?php echo $row['nama_user']; ?>" type="text">
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
		
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="admin/js/bootstrap.min.js"></script>
	<!-- Javascript -->
	<script src="admin/assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="admin/assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="admin/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="admin/assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
	<script src="admin/assets/js/plugins/chartist/chartist.min.js"></script>
	<script src="admin/assets/js/klorofil.min.js"></script>
    <script src="admin/js/jquery.dataTables.min.js"></script>
    <script src="admin/js/dataTables.bootstrap.js"></script>	
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
                        url: "editanggota.php",
                        type: "GET",
                        data : {username: m,},
                        success: function (ajaxData){
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
		<script src="admin/js/jquery-1.11.1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_delete").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "hapusanggota.php",
                        type: "GET",
                        data : {username: m,},
                        success: function (ajaxData){
                            $("#ModalDelete").html(ajaxData);
                            $("#ModalDelete").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
		<script src="admin/assets/js/jquery.dataTables.min.js"></script>
        <script src="admin/assets/js/dataTables.bootstrap.js"></script>	
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
        </script>
	</body>
</html>