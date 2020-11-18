<?php
include('../koneksi.php');
$id_beli = $_GET['id_beli'];
$result = mysqli_query($conn, "select * from tb_transaksi where id_beli='" . $id_beli . "'") or die('Error In Session');
$row = mysqli_fetch_array($result);
?>

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
												  AND tb_transaksi.id_beli='$id_beli'";
// Query untuk menampilkan semua data anggota
$query_tampil = mysqli_query($conn, $sql_tampil);
while ($data = mysqli_fetch_array($query_tampil)) {
?>

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
				<h4 class="modal-title" id="myModalLabel">Update Status Pengiriman</h4>


			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
					<div class="input-group">
						<input type="text" value="<?php echo $data['id_beli']; ?>" name="id_beli" id="id_beli" hidden>
					</div>
					<div class="form-group">
						<label for="inputnim" class="col-lg-2 control-label">Nama Pembeli</label>
						<div class="col-lg-10">
							<input class="form-control" id="tipe" readonly value="<?php echo $data['nm_user']; ?>" name="tipe" type="text" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputnim" class="col-lg-2 control-label">Alamat</label>
						<div class="col-lg-10">
							<textarea type="text" name="alamat" id="alamat" readonly><?php echo $data['alamat']; ?>, <?php echo $data['kota']; ?>; Kode Pos : <?php echo $data['kode_pos']; ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="inputnim" class="col-lg-2 control-label">Nomor Telepon</label>
						<div class="col-lg-10">
							<input class="form-control" id="tipe" readonly value="<?php echo $data['no_hp']; ?>" name="tipe" type="text" required>
						</div>
					</div>
					<div class="form-group">
						<label for="inputnim" class="col-lg-2 control-label">Status</label>
						<div class="col-lg-10">
							<select name="status" id="status" width="30px">
								<option value="dikirim">Dikirim</option>
								<option value="diterima">Diterima</option>
								<option value="return">Return</option>
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" id="updateStatus" name="updateStatus" class="btn btn-success fa fa-edit"> Update</button>
						<button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Keluar</button>
					</div>
				</form>
			<?php
		}
			?>
			</div>
		</div>
	</div>