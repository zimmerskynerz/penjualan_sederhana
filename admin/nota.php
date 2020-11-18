<?php
if (isset($_POST['cetak_tr']))
		{ 
include "../koneksi.php";
$id_beli = $_POST['id_beli'];
$id_user = $_POST['id_user'];
$ttl_hrg = $_POST['ttl_hrg'];
$ttl_bayar = $_POST['ttl_bayar'];
$bayar = $_POST['bayar'];
$kembalian = $_POST['kembalian'];
$status_bayar = $_POST['status_bayar'];




// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$query = "update tb_transaksi set
 ttl_hrg='".$ttl_hrg."',
 ttl_bayar='".$ttl_bayar."',
 bayar='".$bayar."',
 status_bayar='".$status_bayar."',
 status_kirim='proses',
 kembali='".$kembalian."'
	where id_beli='".$id_beli."' and id_user='".$id_user."'";
$sql = mysqli_query($conn, $query);
		}
?>

<?php
include('../koneksi.php');
include('../session.php'); 

$result=mysqli_query($conn, "select * from tb_user where username='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$result6=mysqli_query($conn, "select * from tb_user where level='pemilik'");
$row6=mysqli_fetch_array($result6);
$result1=mysqli_query($conn, "select * from tb_transaksi order by id_beli desc limit 1");
$row1=mysqli_fetch_array($result1);
$id_user = $row1['id_user'];
$id_beli = $row1['id_beli'];
$id_ongkir = $row1['id_ongkir'];
$result2=mysqli_query($conn, "select * from tb_user where id_user='$id_user'");
$row2=mysqli_fetch_array($result2);
$result3=mysqli_query($conn, "select sum(hrg_ttl) as harga_total from rinci_beli where id_user='$id_user' and id_beli='$id_beli'");
$row3=mysqli_fetch_array($result3);
$ht = $row3['harga_total'];
$result4=mysqli_query($conn, "select * from tb_ongkir where id_ongkir='$id_ongkir'");
$row4=mysqli_fetch_array($result4);
$tarif = $row4['tarif'];
$ttl_bayar = $_POST['ttl_bayar'];
$bayar = $_POST['bayar'];
$kembalian = $_POST['kembalian'];
$status_bayar = $_POST['status_bayar'];
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
	<a style="font-family: arial; font-size: 15px;">UD. SANTI JAYA</a><br>
	<a style="font-family: arial; font-size: 8px;">Jl. Kudus - Pati, KM. 12, Kec. Jekulo, Kab. Kudus-JawaTengah</a><br>
	<a style="font-family: arial; font-size: 8px;">Telp : 0291-4251983|| 08122838576</a><br>
	<a style="font-family: arial; font-size: 8px;">Website : www.ud-santijaya.com</a><br>
</td>
<td>
	<a style="font-family: arial; font-size: 10px;">Kudus, <?php echo date('l, d-M-Y');?></a><br>
	<a style="font-family: arial; font-size: 8px;">Kepada Yth.</a><br>
	<a style="font-family: arial; font-size: 8px;">Customers, <?php echo $row2['nm_user'];?></a><br>
	<a style="font-family: arial; font-size: 8px;">Pembayaran, <?php echo $status_bayar?></a><br>
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
								$id_beli = $row1['id_beli'];
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
								while($data = mysqli_fetch_assoc($query_tampil)){
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
<tr >
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">TOTAL HARGA</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $row3['harga_total']; ?></a></td>
</tr>
<tr >
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">HARGA KIRIM</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $row4['tarif']; ?></a></td>
</tr>
<tr>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">TOTAL BAYAR</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $ttl_bayar ?></a></td>
</tr>
<tr>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">BAYAR</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $bayar ?></a></td>
</tr>
<tr>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">KEMBALI</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;">:</a></td>
	<td><a style="font-family: arial; text-align: left;  font-size: 10px;"><?php echo $kembalian ?></a></td>
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
	<a style="font-family: arial; font-size: 10px;">Kepada <?php echo $row2['nm_user'];?>; Nomer Telepon : <?php echo $row2['no_hp'];?></a><br>
	<a style="font-family: arial; font-size: 10px;">Alamat, <?php echo $row2['alamat'];?></a><br>
	<a style="font-family: arial; font-size: 10px;">Kota, <?php echo $row2['kota'];?></a><br>
	<a style="font-family: arial; font-size: 10px;">Kode Pos : <?php echo $row2['kode_pos'];?></a><br>
	
</td>
</tr>
</thead>
</table>
<table>
<thead>
<tr>
<td colspan="2">
	<a style="font-family: arial;  padding-top: 10px; padding-bottom: 10px" colspan="2">==================================================</a>
</td>
</tr>
<tr>
<td style="font-family: arial; text-align: left;  font-size: 12px;" align="center"><?php echo date('l, d-M-Y');?></td>
<td style="font-family: arial; text-align: left;  font-size: 12px;" align="center">Telah Terkonfirmasi</td>
</tr>
<tr>
<td style="font-family: arial; text-align: left;  font-size: 12px;" align="center">Kasir,</td>
<td style="font-family: arial; text-align: left;  font-size: 12px;" align="center">HRD / Pemilik Usaha,</td>
</tr>
<tr>
<td align="center"></td>
<td align="center"><br></td>
</tr>
<tr colspan="3">
<td align="center"></td>
<td align="center"><br></td>
</tr>
<tr>
<td style="font-family: arial; text-align: left;  font-size: 12px;" align="center"><?php echo $row['nm_user'];?></td>
<td style="font-family: arial; text-align: left;  font-size: 12px;" align="center"><?php echo $row6['nm_user'];?></td>
</tr>
</thead>
</table>