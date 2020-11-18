<?php
if (isset($_POST['cetak_tr']))
		{ 
include "../koneksi.php";
$id_beli = $_POST['id_beli'];
$status = $_POST['hrg_bayar'];
$hrg_bayar = $_POST['hrg_bayar'];
$bayar = $_POST['bayar'];
$kmbl = $_POST['kmbl'];
$id_ongkir = $_POST['id_ongkir'];


// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database
$query2 = "INSERT INTO `registrasi` (`id_registrasi`, `id_beli`, `id_ongkir`) VALUES (NULL, '".$id_beli."', '".$id_ongkir."');";
$sql2 = mysqli_query($conn, $query2);


if($sql2){
	$query = "update pembelian set total_harga='".$hrg_bayar."',bayar='".$bayar."',kembalian='".$kmbl."',status='".$status."' where id_beli='".$id_beli."' ";
	$sql = mysqli_query($conn, $query);
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='transaksi_aksi.php'>Kembali Ke Form</a>";
	}
	}
?>

<?php
include('../koneksi.php');
$id_beli = $_POST['id_beli'];
$status = $_POST['hrg_bayar'];
$hrg_bayar = $_POST['hrg_bayar'];
$bayar = $_POST['bayar'];
$kmbl = $_POST['kmbl'];
$id_ongkir = $_POST['id_ongkir'];

$result=mysqli_query($conn, "select * from pembelian where id_beli='".$id_beli."'");
$row=mysqli_fetch_array($result);
$pelanggan = $row['id_pelanggan'];
$result1=mysqli_query($conn, "select * from pelanggan where id_pelanggan='".$pelanggan."'");
$row1=mysqli_fetch_array($result1);
$result2=mysqli_query($conn, "select * from registrasi where id_beli='".$id_beli."'");
$row2=mysqli_fetch_array($result2);
$id_ongkir= $row2['id_ongkir'];
$result3=mysqli_query($conn, "select * from ongkir where id_ongkir='".$id_ongkir."'");
$row3=mysqli_fetch_array($result3);

?>
<script language = javascript>
function printWindow(){
	bV = parseInt(navigator.appVersion);
	if (bV >= 4) window.print();
}
printWindow();
</script>
<table>
<thead>
<tr>
<td>
	<a style="font-family: arial; text-align: center; font-size: 10px;" colspan="2"><b>NOTA TRANSAKSI UD. Santi Jaya</b></a><br>
	<a style="font-family: arial;" colspan="2">===========================</a><br>
	<a style="font-family: arial; text-align: center; font-size: 10px;" colspan="2"><b>NO BON : <?php echo $row['id_beli']; ?></b></a><br>
	<a style="font-family: arial; text-align: center; font-size: 10px;" colspan="2"><b>ALAMAT : <?php echo $row1['alamat']; ?>, <?php echo $row1['kota']; ?> </b></a><br>
	<a style="font-family: arial; text-align: center; font-size: 10px;" colspan="2"><b>Telepon<?php echo $row1['telp']; ?>, Ongkir <?php echo $row2['id_ongkir']; ?> </b></a><br>
	<a style="font-family: arial;" colspan="2">===========================</a><br>
</td>
</tr>
</thead>
<tr>
<td>
<table>
 <?php
								$id_beli= $row['id_beli'];
                                $sql_tampil = "select * from rinci_beli where id_beli='$id_beli'";
								
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['kode_furniture'] ?></a></td>
								<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['jml_beli'] ?></a></td>								
								<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['harga'] ?></a></td>
								<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $data['ttl_hrg'] ?></a></td>
                            </tr>
						
                            <?php
                               
                                }
                            ?>
					

</table>
</td>
<tr>
<td>
<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="1">===========================<br>
</a>
</td>
</tr>
</tr>
</thead>
<tbody>
<tr>
<td>
<table>
<tr >
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">TOTAL HARGA</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $row['total_harga']; ?></a></td>
</tr>
<tr>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">BAYAR</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $row['bayar']; ?></a></td>
</tr>
<tr>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">KEMBALI</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $row['kembalian']; ?></a></td>
</tr>
<tr>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">Ongkos Kirim</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $row3['tarif']; ?></a></td>
</tr>
</tr>
</table>
</td>
</tr>
<thead>
<tr>
<td>
<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="1">===========================<br>
</a>
</a>
</td>
</tr>
</thead>
<tr>
<td colspan="2" style="font-family: arial; text-align: left;  font-size: 10px;">*) Barang yang sudah dibeli tidak dapat dikembalikan,</td><br>
</tr>
<tr>
<td colspan="2" style="font-family: arial; text-align: left;  font-size: 10px;">*) kecuali ada perjanjian.</td><br>
</tr>
</tbody>
<thead>
<tr>
<td>
<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="1">===========================<br>
</a>
</a>
</td>
</tr>
</thead>
</tbody>
<thead>
<tr>
<td>
	<a style="font-family: arial;  font-size: 6px; padding-top: 10px; padding-bottom: 10px" colspan="2">TANGGAL TRANSAKSI : <?php echo $row['tgl_beli']; ?></a>
<a style="font-family: arial;  font-size: 7px; padding-top: 10px; padding-bottom: 10px" colspan="2">version : 1.000.9</a>
</td>
<tr>
<td>
<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="2">===========================</a>
</td>
</tr>
</table>