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
        echo "<script>alert('Waktu Anda Telah Habis!'); window.location = '$logout_redirect_url'</script>";
    }
}
$_SESSION['start_time'] = time();
?> 

<!DOCTYPE html>
<html lang="en">
  <head>


    <title>MENU ADMIN</title>

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
						<li><a href="kategori.php" class="active"><i class="fa fa-book"></i> <span>Daftar Kategori</span></a></li>
						<li><a href="furniture.php" class=""><i class="fa fa-book"></i> <span>Daftar Furniture</span></a></li>
						<li><a href="transaksi.php" class=""><i class="fa fa-book"></i> <span>Daftar Transaksi</span></a></li>
						<li><a href="order.php" class=""><i class="fa fa-book"></i> <span>Daftar Order</span></a></li>
						<li><a href="status.php" class=""><i class="fa fa-book"></i> <span>Status Pengiriman</span></a></li>
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
					<h3 class="page-title">Data Kategori Furniture</h3>
					<div class="row">
                    	
                    	<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                            <div class="panel-title">
								<div class="container">
								<!-- Button trigger modal -->
                                <br>
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i>
                                  Tambah Data
                                </button>							
                                
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Tambah Data Kategori</h4>
                                      </div>
                                      <div class="modal-body">
                                        <!--FORM MODAL-->
										<form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
											<fieldset>
											
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kode Kategori</label>
											  <div class="col-lg-10">
												<input class="form-control" id="id_kategori" placeholder="Kode Kategori; Maks 3 Karakter" name="id_kategori" type="text" max="3" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nama Kategori</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nm_kategori" placeholder="Nama Kategori" name="nm_kategori" type="text">
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Keterangan Kategori</label>
											  <div class="col-lg-10">
												<textarea class="form-control" id="ket" placeholder="Keterangan Kategori" name="ket" type="text" required></textarea>
											  </div>
											</div>

											<div class="form-group">
											  <div class="col-lg-10 col-lg-offset-2">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary" id="simpanKategori" name="simpanKategori">Simpan</button>
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
												<th>Kode Kategori</th>
												<th>Nama Kategori</th>
                                                <th>Keterangan</th>	
                                                <th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                $sql_tampil = "select * from tb_kategori where status='ada'";
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td><?php echo $data['id_kategori'] ?></td>
                                <td><?php echo $data['nm_kategori'] ?></td>		
								<td><?php echo $data['ket'] ?></td>
                                 <td>
                                    <a href="#" class='btn btn-warning open_modal' id='<?php echo $data['id_kategori']; ?>'><span class="lnr lnr-pencil"></span></a>
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
                        url: "update_kategori.php",
                        type: "GET",
                        data : {id_kategori: m,},
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
                        url: "foto_furniture.php",
                        type: "GET",
                        data : {kode_furniture: m,},
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