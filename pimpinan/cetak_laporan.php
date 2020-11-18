<?php
include('../koneksi.php');
include('../session.php');

$tawal	= $_POST['tawal'];
$takhir	= $_POST['takhir'];

?>

<script language=javascript>
	function printWindow() {
		bV = parseInt(navigator.appVersion);
		if (bV >= 4) window.print();
	}
	printWindow();
</script>
<table align="center">
	<thead>
		<tr>
			<th><a style="font-family: arial; font-size: 26px; padding-top: 10px; padding-bottom: 10px" colspan="2">LAPORAN BULANAN</a><br>
				<a style="font-family: arial; font-size: 26px; padding-top: 10px; padding-bottom: 10px" colspan="2">UD. SANTI JAYA</a><br>
				<a style="font-family: arial; font-size: 10px; padding-top: 10px; padding-bottom: 10px" colspan="2">Jl. Kudus Pati Km. 10, Kudus</a>
			</th>
		</tr>
		<tr>
			<td colspan="2">
				<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="2">=============================================================================</a><br>
			</td>
		</tr>
	</thead>
	<tbody>
		<table align="center" width="730">
			<tr>
				<th><i class="fa fa-truck"></i> KODE BELI</th>
				<th><i class="fa fa-tags"></i> NAMA PELANGGAN</th>
				<th><i class="fa fa-bookmark"></i> TOTAL HARGA</th>
				<th><i class=" fa fa-archive"></i> ONGKOS KIRIM</th>
				<th><i class=" fa fa-edit"></i> STATUS</th>
				<th></th>
			</tr>
			<?php

			$sql_tampil = "select tb_transaksi.id_beli as id_beli, tb_transaksi.status_kirim as status_kirim, tb_transaksi.ttl_hrg as total_harga, tb_transaksi.ongkir as tarif, DATE_FORMAT(tb_transaksi.tgl_beli, '%d %M %Y') as tgl_beli, tb_user.nm_user as nama from tb_transaksi, tb_user
			where tb_transaksi.id_user=tb_user.id_user and tb_transaksi.status_kirim='diterima' and tb_transaksi.tgl_beli BETWEEN '$tawal' and '$takhir'
			order by id_beli desc ";

			// Query untuk menampilkan semua data buku  
			$query_tampil = mysqli_query($conn, $sql_tampil);
			while ($data = mysqli_fetch_assoc($query_tampil)) {
			?>
				<tr>
					<td align="center"><?php echo $data['id_beli'] ?></td>
					<td align="center"><?php echo $data['nama'] ?></td>
					<td align="center"><?php echo $data['total_harga'] ?></td>
					<td align="center"><?php echo $data['tarif'] ?></td>
					<td align="center"><?php echo $data['status_kirim'] ?></td>
				</tr>
			<?php

			}
			?>
			</tr>
		</table>
		<table align="center">
			<thead>
				<table align="center">
					<thead>
						<tr>
							<td colspan="2">
								<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="2">=============================================================================</a>
							</td>
						</tr>
				</table>
		</table>