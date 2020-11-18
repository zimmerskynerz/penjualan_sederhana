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
						<li><a href="kategori.php" class=""><i class="fa fa-book"></i> <span>Daftar Kategori</span></a></li>
						<li><a href="furniture.php" class="active"><i class="fa fa-book"></i> <span>Daftar Furniture</span></a></li>
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
					<h3 class="page-title">Data Furniture</h3>
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
                                        <h4 class="modal-title" id="myModalLabel">Tambah Data</h4>
                                      </div>
                                      <div class="modal-body">
                                        <!--FORM MODAL-->
										<form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
											<fieldset>
					<label>Kategori Barang</label>
					<div class="input-group">
						<select name="id_kategori" id="id_kategori" onchange="cek_data()" width = "30px">
												<option>---- Pilih Kategori ----</option>
													<?php
													$userr = mysqli_query($conn, "Select * from tb_kategori where status='ada'");
								// Query untuk menampilkan semua data anggota
								if(mysqli_num_rows($userr) == 0){
									echo "<option>Tidak ada Kategori </option>";
								}else{
								while($row = mysqli_fetch_assoc($userr)){
									echo "
									<option value=".$row['id_kategori'].">".$row['nm_kategori']."</option>";
								}
								}
								?>
												</select>
					</div>
					<label>Nama Barang</label>
					<div class="input-group">
					<input type="text" name="nm_brg" id="nm_brg" placeholder="Nama Barang">
					</div>
					<label>Stok</label>
					<div class="input-group">
					<input type="text" name="stok" id="stok">
					</div>
					<label>Harga Beli</label>
					<div class="input-group">
					<input type="text" name="harga_beli" id="harga_beli">
					</div>
					<label>Harga Jual</label>
					<div class="input-group">
					<input type="text" name="harga_jual" id="harga_jual">
					</div>
					<label>Foto Barang</label>
					<div class="input-group">
					<input type="file" name="foto" id="foto">
					</div>
					<div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" name="simpanFurniture" id="simpanFurniture" class="btn btn-success">Simpan</button>
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
												<th>Foto</th>
												<th>Kode Furniture</th>
												<th>Nama Furniture</th>
                                                <th>Type Furniture</th>		
												<th>Stok</th>
												<th>Harga Beli</th>												
												<th>Harga Jual</th>												
                                                <th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                $sql_tampil = "select tb_barang.foto as foto,
													  tb_barang.id_brg as id_brg,
													  tb_barang.nm_brg as nm_brg,
													  tb_barang.stok as stok,
													  tb_barang.h_beli as h_beli,
													  tb_barang.h_jual as h_jual,
													  tb_kategori.nm_kategori as type
													  from tb_barang, tb_kategori
													  where tb_barang.id_kategori=tb_kategori.id_kategori and 
													  tb_barang.stok>0 and
													  tb_barang.status='ada' order by tb_barang.id_brg asc";
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td><?php echo "<img src='furniture/".$data['foto']."' width='50' height='60'>" ?></td>
                                <td><?php echo $data['id_brg'] ?></td>
								<td><?php echo $data['nm_brg'] ?></td>
                                <td><?php echo $data['type'] ?></td>																								
								<td><?php echo $data['stok'] ?></td>
								<td><?php echo $data['h_beli'] ?></td>
								<td><?php echo $data['h_jual'] ?></td>
                                 <td>
                                    <a href="#" class='btn btn-warning open_modal' id='<?php echo $data['id_brg']; ?>'><span class="lnr lnr-pencil"></span></a>
                                    <a href="#" class='btn btn-danger open_delete' id='<?php echo $data['id_brg']; ?>'><span class="fa fa-edit"></span></a>
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
                        url: "update_furniture.php",
                        type: "GET",
                        data : {id_brg: m,},
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
                        data : {id_brg: m,},
                        success: function (ajaxData){
                            $("#ModalDelete").html(ajaxData);
                            $("#ModalDelete").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
		
		<script type="text/javascript">
$(document).ready(function(){

 $('#id_kategori').change(function(){    // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
  var npmfromfield = $('#id_kategori').val();  // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
  $.ajax({        // Memulai ajax
    method: "POST",     
	dataType: "json",
    url: "oto/cb2.php",    // file PHP yang akan merespon ajax
    data: { id_kategori: npmfromfield}   // data POST yang akan dikirim
  })
    .done(function( hasilajax ) { 		// KETIKA PROSES Ajax Request Selesai
	
        $('#masukan').val(hasilajax['masukan']);  // Isikan hasil dari ajak ke field 'nama' 
		// Isikan hasil dari ajak ke field 'nama' 
    });
 })
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