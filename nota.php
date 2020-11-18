<?php
if (isset($_POST['transaksiBaru'])) {
	include "koneksi.php";
	$tgl_beli = $_POST['tgl_beli'];
	$id_user = $_POST['id_user'];
	$ongkir = $_POST['ongkir'];
	$ttl_hrg = $_POST['ttl_hrg'];
	$hg_total = $_POST['hg_total'];

	// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database
	$query2 = "INSERT INTO `tb_transaksi`  VALUES
									   (NULL,
									   '" . $tgl_beli . "', 
									   '" . $id_user . "',
									   '" . $ongkir . "',
									   '" . $ttl_hrg . "',
									   '" . $hg_total . "',
									   'belum',
									   'belum',
									   'ada');";
	$sql2 = mysqli_query($conn, $query2);

	if ($sql2) {

		// $token = "1375107927:AAFxbZFuhJIUpLkM3dTF3YnSvYmxkegvX8o";

		// $pesan = "Konfirmasi Pembayaran\n\nID Pemesanan " . $id_beli . "\nID Pelanggan " . $id_user . "\nNominal Pembayaran Rp " . $ttl_hrg . "\n\nPada Tanggal " . $tgl_beli;

		// $data = [
		// 	'text' => $pesan,
		// 	'chat_id' => '1336390281'
		// ];

		// file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data));


		$result = mysqli_query($conn, "select * from tb_transaksi where id_user='$id_user' and status_bayar='belum' and status_kirim='belum' order by id_beli desc limit 1");
		$row = mysqli_fetch_array($result);
		$id_beli = $row['id_beli'];
		$queryedit = "UPDATE `rinci_beli` SET 
					`id_beli`='" . $id_beli . "'
			WHERE id_user='" . $id_user . "' and status='rencana_beli'";
		$sqledit = mysqli_query($conn, $queryedit);
		if ($sqledit) {
			$queryedit2 = "UPDATE `rinci_beli` SET 
								`status`='terbeli'
								WHERE id_user='" . $id_user . "' and id_beli='" . $id_beli . "'";
			$sqledit2 = mysqli_query($conn, $queryedit2);
		} else {
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data transaksi1 ke database.";
			echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
		}
	} else {
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data transaksi2 ke database.";
		echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
	}
}
?>

<?php
include('koneksi.php');
include('session.php');

$tgl_beli = $_POST['tgl_beli'];
$ttl_hrg = $_POST['ttl_hrg'];
$ongkir = $_POST['ongkir'];
$hg_total = $_POST['hg_total'];
$id_user = $_POST['id_user'];
$result = mysqli_query($conn, "select * from tb_transaksi where id_user='$id_user' and status_bayar='belum' and status_kirim='belum' order by id_beli desc limit 1");
$row = mysqli_fetch_array($result);
$id_beli = $row['id_beli'];
$identitas = mysqli_query($conn, "select * from tb_user where id_user='$id_user'");
$profil = mysqli_fetch_array($identitas);


?>
<script language=javascript>
	function printWindow() {
		bV = parseInt(navigator.appVersion);
		if (bV >= 4) window.print();
	}
	printWindow();
</script>
<table>
	<thead>
		<tr>
			<td>
				<a style="font-family: arial; font-size: 15px;">UD. SANTI JAYA</a><br>
				<a style="font-family: arial; font-size: 8px;">Jl. Kudus - Pati, KM. 12, Kec. Jekulo, Kab. Kudus-JawaTengah</a><br>
				<a style="font-family: arial; font-size: 8px;">Telp : 0291-4251983|| 08122838576</a><br>
				<a style="font-family: arial; font-size: 8px;">Website : www.ud-santijaya.com</a><br>
			</td>
			<td>
				<a style="font-family: arial; font-size: 10px;">Kudus, <?php echo date('l, d-M-Y'); ?></a><br>
				<a style="font-family: arial; font-size: 8px;">Kepada Yth.</a><br>
				<a style="font-family: arial; font-size: 8px;">Customers, <?php echo $profil['nm_user']; ?></a><br>
				<a style="font-family: arial; font-size: 8px;">Pembayaran, <?php echo $row['status_bayar']; ?></a><br>
			</td>
		</tr>
	</thead>
</table>
<td colspan="2">
	<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="2">==================================================</a>
</td>
</tr>
</thead>
<tbody>
	<table width="500">
		<tr>
			<th style="font-family: arial; text-align: left;  font-size: 12px;">Kode Barang</th>
			<th style="font-family: arial; text-align: left;  font-size: 12px;">Nama Barang</th>
			<th style="font-family: arial; text-align: left;  font-size: 12px;">Jumlah</th>
			<th style="font-family: arial; text-align: left;  font-size: 12px;">Harga</th>
			<th style="font-family: arial; text-align: left;  font-size: 12px;">Total Harga</th>
		</tr>
		<?php
		$id_beli = $row['id_beli'];
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
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['id_brg'] ?></a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['nm_brg'] ?></a></td>
				<td><a style="font-family: arial; text-align: center;  font-size: 10px;"><?php echo $data['jml'] ?></a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['harga'] ?></a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['hrg_ttl'] ?></a></td>
			</tr>

		<?php

		}
		?>
	</table>
	<tr>
		<td colspan="2">
			<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="2">==================================================</a>
		</td>
	</tr>
	<table>
		<td>
			<tr>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;">TOTAL HARGA</a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?= $ttl_hrg ?></a></td>
			</tr>
			<tr>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;">HARGA KIRIM</a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?= $ongkir ?></a></td>
			</tr>
			<tr>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;">TOTAL BAYAR</a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
				<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?= $hg_total ?></a></td>
			</tr>
			</tr>
		</td>
	</table>
	<table>
		<thead>
			<tr>
				<td colspan="2">
					<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="2">==================================================</a>
				</td>
			</tr>
			<tr>
				<td>
					<a style="font-family: arial; font-size: 10px;">Kirim,</a><br>
					<a style="font-family: arial; font-size: 10px;">Kepada <?php echo $profil['nm_user']; ?>; Nomer Telepon : <?php echo $profil['no_hp']; ?></a><br>
					<a style="font-family: arial; font-size: 10px;">Alamat, <?php echo $profil['alamat']; ?></a><br>
					<a style="font-family: arial; font-size: 10px;">Kota, <?php echo $profil['kota']; ?></a><br>
					<a style="font-family: arial; font-size: 10px;">Kode Pos : <?php echo $profil['kode_pos']; ?></a><br>

				</td>
			</tr>
		</thead>
	</table>