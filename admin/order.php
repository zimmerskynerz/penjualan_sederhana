<?php
include('../koneksi.php');
include('../session.php');

$result = mysqli_query($conn, "select * from tb_user where username='$session_id'") or die('Error In Session');
$row = mysqli_fetch_array($result);
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

<?php
function acak($panjang)
{
	$karakter = '123456789';
	$string = '';
	for ($i = 0; $i < $panjang; $i++) {
		$pos = rand(0, strlen($karakter) - 1);
		$string .= $karakter{
			$pos};
	}
	return $string;
}
//cara memanggilnya
$hasil_1 = acak(5);
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
						<li><a href="furniture.php" class=""><i class="fa fa-book"></i> <span>Daftar Furniture</span></a></li>
						<li><a href="transaksi.php" class=""><i class="fa fa-book"></i> <span>Daftar Transaksi</span></a></li>
						<li><a href="order.php" class="active"><i class="fa fa-book"></i> <span>Daftar Order</span></a></li>
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

							<?php echo "<td align='left'>" . $row['nm_user'] . "</td>"; ?>

						</tr>
					</h1>

				</div>
			</nav>
			<!-- END NAVBAR -->

			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">TRANSAKSI</h3>
					<div class="row">

						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-title">
									<div class="container">
										<!-- Button trigger modal -->
										<br>



										<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Tambah Transaksi</h4>
													</div>
													<div class="modal-body">
														<!--FORM MODAL-->
														<form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
															<fieldset>
																<div class="form-group">
																	<label for="inputnim" class="col-lg-2 control-label">Nama</label>
																	<div class="col-lg-10">
																		<input class="form-control" id="nm_user" name="nm_user" type="text" required>
																	</div>
																</div>
																<div class="form-group">
																	<label for="inputnim" class="col-lg-2 control-label">Alamat</label>
																	<div class="col-lg-10">
																		<textarea type="text" name="alamat" id="alamat" required></textarea>
																	</div>
																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Kota</label>
																	<div class="col-lg-5">
																		<select class="form-control" id="id_ongkir" name="id_ongkir" width="30px">
																			<option>---- Pilih Kota ----</option>
																			<?php
																			$userr = mysqli_query($conn, "Select * from tb_ongkir where status='ada'");
																			// Query untuk menampilkan semua data anggota
																			if (mysqli_num_rows($userr) == 0) {
																				echo "<option>Tidak ada Kota </option>";
																			} else {
																				while ($row = mysqli_fetch_assoc($userr)) {
																					echo "
									<option value=" . $row['id_ongkir'] . ">" . $row['kota_tujuan'] . "</option>";
																				}
																			}
																			?>
																		</select>
																	</div>
																</div>


																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Kode Pos</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="kode_pos" id="kode_pos" type="text" required>
																	</div>
																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Telepon</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="no_hp" id="no_hp" type="text" required>
																	</div>
																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Email</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="email" id="email" type="email">
																	</div>
																</div>
																<div class="input-group">
																	<input type="text" value="<?php echo date('Y-m-d'); ?>" name="tgl_beli" hidden>
																</div>
																<div class="input-group">
																	<input type="text" value="belum" id="status_bayar" name="status_bayar" hidden>
																</div>
																<div class="input-group">
																	<input type="text" value="belum" id="status_kirim" name="status_kirim" hidden>
																</div>
																<div class="form-group">
																	<div class="col-lg-10 col-lg-offset-2">
																		<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
																		<button type="submit" class="btn btn-primary" id="transaksiBaru" name="transaksiBaru">Buat Transaksi</button>
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
												<th>Kode Transaksi</th>
												<th>Tanggal Beli</th>
												<th>Penerima</th>
												<th>Alamat</th>
												<th>Telepon</th>
												<th>Status Bayar</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql_tampil = "select tb_transaksi.id_beli as id_beli,
													  DATE_FORMAT(tb_transaksi.tgl_beli, '%d %M %Y') as tgl_beli,
													  tb_user.nm_user as nm_user,
													  tb_user.alamat as alamat,
													  tb_user.kota as kota,
													  tb_user.kode_pos as kode_pos,
													  tb_user.no_hp as no_hp,
													  tb_transaksi.ttl_hrg as ttl_hrg,
													  tb_transaksi.ttl_bayar as ttl_bayar,
													  tb_transaksi.status_bayar as status_bayar,
													  tb_transaksi.status_kirim as status_kirim
												 FROM tb_transaksi, tb_user
												WHERE tb_transaksi.id_user=tb_user.id_user
												  AND tb_transaksi.status_bayar='order'";
											// Query untuk menampilkan semua data buku  
											$query_tampil = mysqli_query($conn, $sql_tampil);

											while ($data = mysqli_fetch_assoc($query_tampil)) {
											?>
												<tr>
													<td align="center"><?php echo $data['id_beli'] ?></td>
													<td><?php echo $data['tgl_beli'] ?></td>
													<td><?php echo $data['nm_user'] ?></td>
													<td><?php echo $data['alamat'] ?>, <?php echo $data['kota'] ?> ; Kode POS : <?php echo $data['kode_pos'] ?></td>
													<td><?php echo $data['no_hp'] ?></td>
													<td><?php echo $data['status_bayar'] ?></td>
													<td>
														<a href="#" class='btn btn-warning open_modal' id='<?php echo $data['id_beli']; ?>'><span class="lnr lnr-pencil"> Detail</span></a>
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
		$(function() {
			$('#example1').dataTable();
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$(".open_modal").click(function(e) {
				var m = $(this).attr("id");
				$.ajax({
					url: "detail_tr.php",
					type: "GET",
					data: {
						id_beli: m,
					},
					success: function(ajaxData) {
						$("#ModalEdit").html(ajaxData);
						$("#ModalEdit").modal('show', {
							backdrop: 'true'
						});
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