<?php if (isset($_POST['updateUser']))
		{ 
include "../koneksi.php";
$id_user	= $_POST['id_user'];
$username	= $_POST['username'];
$password	= $_POST['password'];
$nm_user	= $_POST['nm_user'];
$alamat		= $_POST['alamat'];
$kota		= $_POST['kota'];
$kode_pos	= $_POST['kode_pos'];
$no_hp		= $_POST['no_hp'];
$email		= $_POST['email'];

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_user` SET
`username`='".$username."',
`password`='".$password."',
`nm_user`='".$nm_user."',
`alamat`='".$alamat."',
`kota`='".$kota."',
`kode_pos`='".$kode_pos."',
`no_hp`='".$no_hp."',
`email`='".$email."'
 WHERE `id_user`='".$id_user."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
	header("location: index.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='index.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['simpanFurniture']))
		{ 
include "../koneksi.php";
$kode_furniture	= $_POST['kode_furniture'];
$tipe			= $_POST['tipe'];
$stok			= $_POST['stok'];
$harga			= $_POST['harga'];
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$foto;
// Set path folder tempat menyimpan fotonya
$path = "furniture/".$fotobaru;

if(move_uploaded_file($tmp, $path)){ 
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$query = "INSERT INTO furniture VALUES('".$kode_furniture."',
'".$tipe."',
'".$stok."',
'".$harga."',
'".$fotobaru."')";
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: furniture.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='furniture.php'>Kembali Ke Form</a>";
	}
	}else{  
	// Jika gambar gagal diupload, Lakukan :  
	echo "Maaf, Gambar gagal untuk diupload.";  
	echo "<br><a href='furniture.php'>Kembali Ke Form</a>";}
		}
?>

<?php if (isset($_POST['updateStatus']))
		{ 
include "../koneksi.php";
$id_beli		= $_POST['id_beli'];
$status			= $_POST['status'];

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_transaksi` SET 
`status_kirim`='".$status."'
WHERE `id_beli`='".$id_beli."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
	header("location: index.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='index.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['updateReturn']))
		{ 
include "../koneksi.php";
$id_beli		= $_POST['id_beli'];
$status			= $_POST['status'];

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_transaksi` SET 
`status_kirim`='".$status."'
WHERE `id_beli`='".$id_beli."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
	header("location: return.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='return.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['updateDiterima']))
		{ 
include "../koneksi.php";
$id_beli		= $_POST['id_beli'];
$status			= $_POST['status'];

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_transaksi` SET 
`status_kirim`='".$status."'
WHERE `id_beli`='".$id_beli."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
	header("location: status.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='status.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['updateUsr']))
		{ 
include "../koneksi.php";
$id_user			= $_POST['id_user'];
$username			= $_POST['username'];
$password_u			= $_POST['password_u'];
$nama_user			= $_POST['nama_user'];

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `user` SET `nama_user`='".$nama_user."',`username_u`='".$username."',`password_u`='".$password_u."' WHERE `id_user`='".$id_user."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
	header("location: ../index.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='index.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['fotoFurniture']))
		{ 
include "../koneksi.php";
$kode_furniture	= $_POST['kode_furniture'];
// foto1
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// foto1
$fotobaru = date('dmYHis').$foto;

// Set path folder tempat menyimpan fotonya
$path = "furniture/".$fotobaru;


// Proses upload
	if(move_uploaded_file($tmp, $path)){ 
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$query = "update furniture set foto ='".$fotobaru."' where kode_furniture = '".$kode_furniture."'";
$sql = mysqli_query($conn, $query);
 // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: furniture.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='furniture.php'>Kembali Ke Form</a>";
	}
	}else{  
	// Jika gambar gagal diupload, Lakukan :  
	echo "Maaf, Gambar gagal untuk diupload.";  
	echo "<br><a href='furniture.php'>Kembali Ke Form</a>";}
		}
?>

<?php if (isset($_POST['transaksiBaru']))
		{ 
include "../koneksi.php";
$id_pelanggan		= $_POST['id_pelanggan'];
$nama				= $_POST['nama'];
$alamat				= $_POST['alamat'];
$kota				= $_POST['kota'];
$tgl_beli			= $_POST['tgl_beli'];
$telp				= $_POST['telp'];
$email				= $_POST['email'];
$status				= $_POST['status'];
$status_kirim		= $_POST['status_kirim'];
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$query = "INSERT INTO pelanggan VALUES(
'".$id_pelanggan."',
'".$nama."',
'".$alamat."',
'".$kota."',
'".$telp."',
'".$email."')";
$sql = mysqli_query($conn, $query);

	 // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	$query2 = "INSERT INTO `pembelian`
	VALUES (NULL,
	'".$tgl_beli."',
	'".$id_pelanggan."',
	NULL, NULL, NULL, NULL,
	'order',
	'belum dikirim')";
	$sql2 = mysqli_query($conn, $query2);
	if($sql2){
		header("location: transaksi_aksi.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
	}
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['barangbeli']))
{
include "../koneksi.php";
$id_beli = $_POST['id_beli'];
$kode_furniture = $_POST['kode_furniture'];
$jml_beli = $_POST['jml_beli'];

$cekdata=mysqli_query($conn, "select * from furniture where kode_furniture='$kode_furniture'");
$masih=mysqli_fetch_array($cekdata);
	 // Eksekusi/ Jalankan query dari variabel $query
if($masih > 0){
	$harga = $masih['harga'];
	$cekdata2=mysqli_query($conn, "select * from rinci_beli where kode_furniture='$kode_furniture' and id_beli='$id_beli'");
	$masih2=mysqli_fetch_array($cekdata2);
	
	if($masih2 > 0)
		{
			$queryedit = "UPDATE `rinci_beli` SET 
			`jml_beli`=jml_beli + '".$jml_beli."',
			`ttl_hrg`=((jml_beli) * '".$harga."')
			WHERE `kode_furniture`='".$kode_furniture."'";
			$sqledit = mysqli_query($conn, $queryedit);
			$queryedit2 = "UPDATE `furniture` SET 
			`stok`=stok - '".$jml_beli."'
			WHERE `kode_furniture`='".$kode_furniture."'";
			$sqledit2 = mysqli_query($conn, $queryedit2);
			header("location: transaksi_aksi.php");
		}else{
				$kode_furniture = $masih['kode_furniture'];
				$jml = mysqli_query($conn, "select sum(harga * '$jml_beli') as jml_beli2 from furniture where kode_furniture='$kode_furniture'");
				$masih_k=mysqli_fetch_array($jml);
				$ttl_hrg = $masih_k['jml_beli2'];
				$query2 = "INSERT INTO `rinci_beli`
				VALUES ('".$id_beli."',
				'".$kode_furniture."',
				'".$harga."',
				'".$jml_beli."', '".$ttl_hrg."')";
				$sql2 = mysqli_query($conn, $query2);
				$queryedit2 = "UPDATE `furniture` SET 
			`stok`=stok - '".$jml_beli."'
			WHERE `kode_furniture`='".$kode_furniture."'";
			$sqledit2 = mysqli_query($conn, $queryedit2);
				if($sql2){
					header("location: transaksi_aksi.php");
				}else{
					echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
					echo "<br><a href='transaksi_aksi.php'>Kembali Ke Form</a>";
					}
		
		}
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='transaksi_aksi.php'>Kembali Ke Form</a>";
	}
}
?>

<?php if (isset($_POST['hapus_tr_br']))
		{ 
include "../koneksi.php";
$kode_furniture = $_POST['kode_furniture'];
$jml_beli = $_POST['jml_beli'];
$id_beli = $_POST['id_beli'];

$queryupdate = "update furniture set stok =stok+'".$jml_beli."' where kode_furniture = '".$kode_furniture."'";
$update = mysqli_query($conn, $queryupdate);
$sqlhapus = "delete from rinci_beli where kode_furniture = '".$kode_furniture."' and id_beli = '".$id_beli."'";
$sql = mysqli_query($conn, $sqlhapus);

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

 // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: transaksi_aksi.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='transaksi_aksi.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['batal_tr']))
		{ 
include "../koneksi.php";
$id_tr = $_POST['id_tr'];

$sqlhapus = "delete from pembelian where id_beli = '".$id_tr."'";
$sql = mysqli_query($conn, $sqlhapus);

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

 // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: transaksi.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='transaksi_aksi.php'>Kembali Ke Form</a>";
	}
		}
?>