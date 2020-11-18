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

<?php if (isset($_POST['simpanUser']))
		{ 
include "../koneksi.php";
$username	= $_POST['username'];
$password	= $_POST['password'];
$nm_user	= $_POST['nm_user'];
$alamat		= $_POST['alamat'];
$kota		= $_POST['kota'];
$kode_pos	= $_POST['kode_pos'];
$no_hp		= $_POST['no_hp'];
$email		= $_POST['email'];
$level		= $_POST['level'];
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$query = "INSERT INTO tb_user VALUES('',
'".$username."',
'".$password."',
'".$nm_user."',
'".$alamat."',
'".$kota."',
'".$kode_pos."',
'".$no_hp."',
'".$email."',
'".$level."',
'ada')";
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: index.php");
	}else{  
	// Jika gambar gagal diupload, Lakukan :   
	echo "<br><a href='index.php'>Kembali Ke Form</a>";}
		}
?>

<?php if (isset($_POST['updateStatus']))
		{ 
include "../koneksi.php";
$id_beli		= $_POST['id_beli'];
$status			= $_POST['status'];

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `pembelian` SET 
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
$level		= $_POST['level'];
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_user` SET
`username`='".$username."',
`password`='".$password."',
`nm_user`='".$nm_user."',
`alamat`='".$alamat."',
`kota`='".$kota."',
`kode_pos`='".$kode_pos."',
`no_hp`='".$no_hp."',
`email`='".$email."',
`level`='".$level."'
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

<?php if (isset($_POST['updateUsr']))
		{ 
include "../koneksi.php";
$id_user		= $_POST['id_user'];
$username		= $_POST['username'];
$password		= $_POST['password'];
$nm_user		= $_POST['nm_user'];
$alamat			= $_POST['alamat'];
$kota			= $_POST['kota'];
$kode_pos		= $_POST['kode_pos'];
$no_hp			= $_POST['no_hp'];
$email			= $_POST['email'];


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
	header("location: ../index.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='index.php'>Kembali Ke Form</a>";
	}
		}
?>


<?php if (isset($_POST['deleteUser']))
		{ 
include "../koneksi.php";
$id_user = $_POST['id_user'];

$sqlhapus = "update tb_user set status='tidak' where id_user = '".$id_user."'";
$sql = mysqli_query($conn, $sqlhapus);

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

 // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: index.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='index.php'>Kembali Ke Form</a>";
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