<?php
include('../koneksi.php');
$id_beli = $_GET['id_beli'];
$result1 = mysqli_query($conn, "select * from tb_transaksi where id_beli='$id_beli'");
$row1 = mysqli_fetch_array($result1);
$id_user = $row1['id_user'];
$result2 = mysqli_query($conn, "select * from tb_user where id_user='$id_user'");
$row2 = mysqli_fetch_array($result2);
$result3 = mysqli_query($conn, "select sum(hrg_ttl) as harga_total from rinci_beli where id_user='$id_user' and id_beli='$id_beli'");
$row3 = mysqli_fetch_array($result3);
$ht = $row3['harga_total'];
?>

<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
			<h4 class="modal-title" id="myModalLabel">Detail Beli</h4>
		</div>
		<div class="modal-body">
			<form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
				<fieldset>
					<div class="panel-body">
						<table id="example1" class="table table-hover">
							<thead>
								<tr>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Jumlah</th>
									<th>Harga</th>
									<th>Total Harga</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$sql_tampil = "select rinci_beli.id_brg as id_brg,
													  rinci_beli.id_beli as id_beli,
													  tb_barang.nm_brg as nm_brg,
													  rinci_beli.jml as jml,
													  rinci_beli.harga as harga,
													  rinci_beli.hrg_ttl as hrg_ttl
												from  rinci_beli, tb_barang, tb_transaksi
												where rinci_beli.id_beli=tb_transaksi.id_beli
												and	  rinci_beli.id_brg=tb_barang.id_brg
												and   rinci_beli.id_beli='$id_beli'";
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);

								while ($data = mysqli_fetch_assoc($query_tampil)) {
								?>
									<tr>
										<td><?php echo $data['id_brg'] ?></td>
										<td><?php echo $data['nm_brg'] ?></td>
										<td align="center"><?php echo $data['jml'] ?></td>
										<td><?php echo $data['harga'] ?></td>
										<td><?php echo $data['hrg_ttl'] ?></td>
									</tr>
								<?php

								}
								?>
							</tbody>
						</table>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
	<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="myModalLabel">Harga Total : <?php echo $row1['ttl_hrg'] ?>,-</h5>
			<h5 class="modal-title" id="myModalLabel">Harga Kirim : <?php echo $row1['ongkir'] ?>,-</h5>
			<h5 class="modal-title" id="myModalLabel">Total Bayar : <?php echo $row1['ttl_bayar'] ?>,-</h5>
		</div>

	</div>