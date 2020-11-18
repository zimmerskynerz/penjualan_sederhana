<?php
include('koneksi.php');
include('session.php');
// include('raja_ongkir.php');

$result = mysqli_query($conn, "select * from tb_user where username='$session_id'") or die('Error In Session');
$row = mysqli_fetch_array($result);
$id_user = $row['id_user'];
$result122 = mysqli_query($conn, "select tb_ongkir.id_ongkir as id_kota,tb_user.kota as kota from tb_user,tb_ongkir where tb_ongkir.kota_tujuan=tb_user.kota and tb_user.id_user='$id_user'");
$row122 = mysqli_fetch_array($result122);

$result1 = mysqli_query($conn, "select count(*) as keranjang from rinci_beli where id_user='$id_user' and status='rencana_beli' ");
$row1 = mysqli_fetch_array($result1);
$result12 = mysqli_query($conn, "select sum(hrg_ttl) as hrg_ttl from rinci_beli where id_user='$id_user' and status='rencana_beli' ");
$row12 = mysqli_fetch_array($result12);
//Membuat batasan waktu sesion untuk user di PHP 
?>

<!DOCTYPE html>
<html lang="en">

<head>


	<title>MENU ADMIN</title>

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
						<li><a href="cart.php" class="active"><i class="fa fa-shopping-cart"></i> <span>Keranjang (<?php echo $row1['keranjang']; ?>)</span></a></li>
						<li><a href="status.php" class=""><i class="fa fa-refresh"></i> <span>Status Transaksi</span></a></li>
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
					<h3 class="page-title">Data Furniture</h3>
					<div class="row">

						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
								<div class="panel-title">
									<div class="container">
										<!-- Button trigger modal -->
										<br>
										<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-shopping-cart"></i>
											Bayar Sekarang
										</button>

										<!-- Modal -->
										<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
														<h4 class="modal-title" id="myModalLabel">Keranjang Belanja</h4>
														<h5 class="modal-title" id="myModalLabel">Harga Total : Rp <?php echo $row12['hrg_ttl'] ?>,-</h5>
													</div>
													<div class="modal-body">
														<!--FORM MODAL-->
														<form class="form-horizontal" method="post" action="nota.php" enctype="multipart/form-data">
															<fieldset>
																<div class="form-group">
																	<label for="inputnim" class="col-lg-2 control-label">Nama</label>
																	<div class="col-lg-10">
																		<input class="form-control" id="nm_user" name="nm_user" value="<?php echo $row['nm_user']; ?>" type="text" readonly>
																	</div>
																</div>
																<div class="form-group">
																	<label for="inputnim" class="col-lg-2 control-label">Alamat</label>
																	<div class="col-lg-10">
																		<textarea type="text" name="alamat" id="alamat"><?php echo $row['alamat']; ?></textarea><br>
																		<a>* Untuk merubah alamat pengirim</a><br>
																		<a>* Silahkan masuk ke profil dan update alamat</a>
																	</div>
																</div>
																<?php
																//Get Data Provinsi
																$curl = curl_init();

																curl_setopt_array($curl, array(
																	CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
																	CURLOPT_RETURNTRANSFER => true,
																	CURLOPT_ENCODING => "",
																	CURLOPT_MAXREDIRS => 10,
																	CURLOPT_TIMEOUT => 30,
																	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
																	CURLOPT_CUSTOMREQUEST => "GET",
																	CURLOPT_HTTPHEADER => array(
																		"key: fddeab3d6d3e203bb4c1f16f74c6e6c0"
																	),
																));

																$response = curl_exec($curl);
																$err = curl_error($curl);
																echo
																	"<div class= \"form-group\">
																	<label for=\"judul\" class=\"col-lg-2 control-label\">Provinsi Tujuan</label>
																	<div class=\"col-lg-5\">
																	<select class=\"form-control\" id=\"provinsi\" name=\"provinsi\" readonly width=\"30px\">";
																$data = json_decode($response, true);
																for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
																	echo "<option value='" . $data['rajaongkir']['results'][$i]['province_id'] . "'>" . $data['rajaongkir']['results'][$i]['province'] . "</option>";
																}
																echo "</select>
																	</div>
																</div>
																"
																?>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Kota</label>
																	<div class="col-lg-5">
																		<select class="form-control" id="kabupaten" name="kabupaten" width="30px">
																			<option>Pilih Kota Tujuan</option>
																		</select>
																	</div>
																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Kurir</label>
																	<div class="col-lg-5">
																		<select class="form-control" id="kurir" name="kurir">
																			<option value="0">Pilih Layanan Kurir</option>
																			<option value="jne">JNE</option>
																			<option value="tiki">TIKI</option>
																		</select>
																	</div>
																</div>

																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Ongkir</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="harga" id="harga" value="<?php echo $row12['hrg_ttl'] ?>" type="text" readonly>
																	</div>
																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Ongkir</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="ongkir" id="ongkir" type="text" readonly>
																	</div>
																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Total</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="hg_total" id="hg_total" type="text" readonly>
																		<a>* Transfer Sesuai Total</a><br>
																		<a>* No Rek : 583501021038535 (BRI)</a><br>
																		<a>* Atas Nama : Dewi Maya Sari</a>
																	</div>

																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Telepon</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="no_hp" id="no_hp" type="text" value="<?php echo $row['no_hp']; ?>" readonly>
																	</div>
																</div>
																<div class="form-group">
																	<label for="judul" class="col-lg-2 control-label">Email</label>
																	<div class="col-lg-10">
																		<input class="form-control" name="email" id="email" type="email" value="<?php echo $row['email']; ?>" readonly>
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
																<div class="input-group">
																	<input type="text" value="<?php echo $row12['hrg_ttl'] ?>" id="ttl_hrg" name="ttl_hrg" hidden>
																</div>
																<div class="input-group">
																	<input type="text" value="<?php echo $row['id_user'] ?>" id="id_user" name="id_user" hidden>
																</div>
																<div class="form-group">
																	<div class="col-lg-10 col-lg-offset-2">
																		<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
																		<button type="submit" class="btn btn-primary" id="transaksiBaru" name="transaksiBaru">Selesai Belanja</button>
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
												<th>Foto</th>
												<th>Kode Furniture</th>
												<th>Nama Furniture</th>
												<th>Jumlah Beli</th>
												<th>Harga</th>
												<th>Harga Total</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql_tampil = "select tb_barang.foto as foto,
													  rinci_beli.id_brg as id_brg,
													  tb_barang.nm_brg as nm_brg,
													  rinci_beli.jml as jml_beli,
													  rinci_beli.harga as h_jual,
													  rinci_beli.hrg_ttl as hrg_ttl
								from tb_barang, rinci_beli where tb_barang.id_brg=rinci_beli.id_brg and rinci_beli.id_user='$id_user' and rinci_beli.status='rencana_beli'";
											// Query untuk menampilkan semua data buku  
											$query_tampil = mysqli_query($conn, $sql_tampil);
											while ($data = mysqli_fetch_assoc($query_tampil)) {
											?>
												<tr>
													<td><?php echo "<img src='admin/furniture/" . $data['foto'] . "' width='50' height='60'>" ?></td>
													<td><?php echo $data['id_brg'] ?></td>
													<td><?php echo $data['nm_brg'] ?></td>
													<td><?php echo $data['jml_beli'] ?></td>
													<td><?php echo $data['h_jual'] ?></td>
													<td><?php echo $data['hrg_ttl'] ?></td>
													<td>
														<a href="#" class='btn btn-primary open_modal' id='<?php echo $data['id_brg']; ?>'><span class="fa fa-cart-plus"> Detail</span></a>
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
	<script src="admin/assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="admin/assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="admin/assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="admin/assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
	<script src="admin/assets/js/plugins/chartist/chartist.min.js"></script>
	<script src="admin/assets/js/klorofil.min.js"></script>
	<script src="admin/js/jquery.dataTables.min.js"></script>
	<script src="admin/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#example1').dataTable();
		});
	</script>
	<!-- <script type="text/javascript">
		< script type = "text/javascript" >
			$(function() {
				$('#example1').dataTable();
			});
	</script> -->

	<script type="text/javascript">
		$(document).ready(function() {
			$(".open_modal").click(function(e) {
				var m = $(this).attr("id");
				$.ajax({
					url: "rinci_beli.php",
					type: "GET",
					data: {
						id_brg: m,
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

	<script type="text/javascript">
		$(document).ready(function() {
			$(".open_delete").click(function(e) {
				var m = $(this).attr("id");
				$.ajax({
					url: "foto_furniture.php",
					type: "GET",
					data: {
						id_brg: m,
					},
					success: function(ajaxData) {
						$("#ModalDelete").html(ajaxData);
						$("#ModalDelete").modal('show', {
							backdrop: 'true'
						});
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function() {

			$('#id_kategori').change(function() { // KETIKA ISI DARI FIEL 'NPM' BERUBAH MAKA ......
				var npmfromfield = $('#id_kategori').val(); // AMBIL isi dari fiel NPM masukkan variabel 'npmfromfield'
				$.ajax({ // Memulai ajax
						method: "POST",
						dataType: "json",
						url: "oto/cb2.php", // file PHP yang akan merespon ajax
						data: {
							id_kategori: npmfromfield
						} // data POST yang akan dikirim
					})
					.done(function(hasilajax) { // KETIKA PROSES Ajax Request Selesai

						$('#masukan').val(hasilajax['masukan']); // Isikan hasil dari ajak ke field 'nama' 
						// Isikan hasil dari ajak ke field 'nama' 
					});
			})
		});
	</script>

	<script src="admin/assets/js/jquery.dataTables.min.js"></script>
	<script src="admin/assets/js/dataTables.bootstrap.js"></script>
	<script type="text/javascript">
		$(function() {
			$('#example1').dataTable();
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#provinsi').change(function() {

				//Mengambil value dari option select provinsi kemudian parameternya dikirim menggunakan ajax
				var prov = $('#provinsi').val();

				$.ajax({
					type: 'GET',
					url: 'cek_kabupaten.php',
					data: 'prov_id=' + prov,
					success: function(data) {

						//jika data berhasil didapatkan, tampilkan ke dalam option select kabupaten
						$("#kabupaten").html(data);
					}
				});
			});
			$('#kurir').change(function() {
				//Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
				var asal = $('#asal').val();
				var kab = $('#kabupaten').val();
				var kurir = $('#kurir').val();
				$.ajax({
					type: 'POST',
					url: 'cek_ongkir.php',
					data: {
						'kab_id': kab,
						'kurir': kurir,
						'asal': asal
					},
					success: function(data) {
						// console.log(data);
						//jika data berconsole.log(data);hasil didapatkan, tampilkan ke dalam element div ongkir
						$("#hg_total").val(data);
					}
				});
			});
			$('#kurir').change(function() {
				//Mengambil value dari option select provinsi asal, kabupaten, kurir, berat kemudian parameternya dikirim menggunakan ajax
				var asal = $('#asal').val();
				var kab = $('#kabupaten').val();
				var kurir = $('#kurir').val();
				$.ajax({
					type: 'POST',
					url: 'cek_ongkir2.php',
					data: {
						'kab_id': kab,
						'kurir': kurir,
						'asal': asal
					},
					success: function(data) {
						// console.log(data);
						//jika data berconsole.log(data);hasil didapatkan, tampilkan ke dalam element div ongkir
						$("#ongkir").val(data);
					}
				});
			});
		});
	</script>
</body>

</html>