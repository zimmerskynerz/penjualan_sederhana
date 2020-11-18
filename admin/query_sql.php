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

<?php if (isset($_POST['simpanKategori']))
		{ 
include "../koneksi.php";
$id_kategori	= $_POST['id_kategori'];
$nm_kategori	= $_POST['nm_kategori'];
$ket			= $_POST['ket'];

$query = "INSERT INTO tb_kategori VALUES('".$id_kategori."',
'".$nm_kategori."',
'".$ket."',
'ada')";
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: kategori.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='kategori.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['updateKategori']))
		{ 
include "../koneksi.php";
$id_kategori	= $_POST['id_kategori'];
$nm_kategori	= $_POST['nm_kategori'];
$ket			= $_POST['ket'];

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_kategori` SET 
`nm_kategori`='".$nm_kategori."',
`ket`='".$ket."'
WHERE `id_kategori`='".$id_kategori."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
	header("location: kategori.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='kategori.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['simpanFurniture']))
		{ 
include "../koneksi.php";
$id_kategori	= $_POST['id_kategori'];
$nm_brg			= $_POST['nm_brg'];
$stok			= $_POST['stok'];
$harga_beli		= $_POST['harga_beli'];
$harga_jual		= $_POST['harga_jual'];
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database
$foto = $_FILES['foto']['name'];
$tmp = $_FILES['foto']['tmp_name'];

// Rename nama fotonya dengan menambahkan tanggal dan jam upload
$fotobaru = date('dmYHis').$foto;
// Set path folder tempat menyimpan fotonya
$path = "furniture/".$fotobaru;

if(move_uploaded_file($tmp, $path)){ 
// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$cari=mysqli_query($conn, "select max(id_brg) as id_brg from tb_barang where id_kategori='$id_kategori'");
$hasil_cari=mysqli_fetch_array($cari);
$kode = substr($hasil_cari['id_brg'],3,3);
$kode_brg=$kode+1;
$masukan=$id_kategori.str_pad($kode_brg, 3, "0", STR_PAD_LEFT);

$query = "INSERT INTO tb_barang VALUES('".$masukan."',
'".$id_kategori."',
'".$nm_brg."',
'".$stok."',
'".$harga_beli."',
'".$harga_jual."',
'".$fotobaru."',
'ada')";
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
if($sql){
       ?>
    <script>
        alert("Produk Berhasil Ditambah!");
        window.location.href = 'furniture.php';
    </script>
<?php
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

<?php if (isset($_POST['updateBarang']))
		{ 
include "../koneksi.php";
$id_brg			= $_POST['id_brg'];
$nm_brg			= $_POST['nm_brg'];
$stok			= $_POST['stok'];
$harga_beli		= $_POST['harga_beli'];
$harga_jual		= $_POST['harga_jual'];



// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_barang` SET
`nm_brg`='".$nm_brg."',
`stok`='".$stok."',
`h_beli`='".$harga_beli."',
`h_jual`='".$harga_jual."'
 WHERE `id_brg`='".$id_brg."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
       ?>
    <script>
        alert("Produk Berhasil Diubah!");
        window.location.href = 'furniture.php';
    </script>
<?php
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='furniture.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['deleteBarang']))
		{ 
include "../koneksi.php";
$id_brg			= $_POST['id_brg'];


// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

$queryedit = "UPDATE `tb_barang` SET `status`='tidak'
 WHERE `id_brg`='".$id_brg."'";
$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
if($sqledit){
	header("location: furniture.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='furniture.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['fotoFurniture']))
		{ 
include "../koneksi.php";
$id_brg	= $_POST['id_brg'];
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

$query = "update tb_barang set foto ='".$fotobaru."' where id_brg = '".$id_brg."'";
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
$nm_user			= $_POST['nm_user'];
$alamat				= $_POST['alamat'];
$kode_pos			= $_POST['kode_pos'];
$no_hp				= $_POST['no_hp'];
$email				= $_POST['email'];
$tgl_beli			= $_POST['tgl_beli'];
$status_bayar		= $_POST['status_bayar'];
$status_kirim		= $_POST['status_kirim'];
$id_ongkir			= $_POST['id_ongkir'];

	$cekongkir = mysqli_query($conn,"select * from tb_ongkir where id_ongkir='".$id_ongkir."' and status='ada'");
	$ongkir=mysqli_fetch_array($cekongkir);
	
$kota				= $ongkir['kota_tujuan'];

$query = "INSERT INTO tb_user (`id_user`, `nm_user`, `alamat`, `kota`, `kode_pos`, `no_hp`, `email`, `level`, `status`)
 VALUES(
'',
'".$nm_user."',
'".$alamat."',
'".$kota."',
'".$kode_pos."',
'".$no_hp."',
'".$email."',
'pelanggan',
'ada')";
$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

if($sql){
	$cekdata = mysqli_query($conn,"select * from tb_user where nm_user='".$nm_user."' and no_hp='".$no_hp."'");
	$data=mysqli_fetch_array($cekdata);
		if($data > 0){
			$id_user = $data['id_user'];
			$querytransaksi = "INSERT INTO `tb_transaksi` 
			(`id_beli`, 
			 `tgl_beli`, 
			  `id_user`, 
			  `ttl_hrg`, 
			  `id_ongkir`, 
			  `ttl_bayar`, 
			  `bayar`, 
			  `kembali`, 
			  `status_bayar`, 
			  `status_kirim`, 
			  `status`) VALUES 
			('',
			 '".$tgl_beli."', 
			 '".$id_user."', 
			 '', 
			 '".$id_ongkir."', 
			 '', 
			 '', 
			 '', 
			 'belum', 
			 'belum', 
			 'ada')";
			$transaksi = mysqli_query($conn, $querytransaksi);
			if($transaksi){
					header("location: rinci_transaksi.php");
			}else{
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data transaksi ke database.";    
				echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
			}
		}else{
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data user ke database.";    
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
$id_brg = $_POST['id_brg'];
$id_user = $_POST['id_user'];
$jml_beli = $_POST['jml_beli'];

$cekdata=mysqli_query($conn, "select * from tb_barang where id_brg='$id_brg' and status='ada'");
$masih=mysqli_fetch_array($cekdata);
	 // Eksekusi/ Jalankan query dari variabel $query
if($masih > 0){
	$harga = $masih['h_jual'];
	$cekdata2=mysqli_query($conn, "select * from rinci_beli where id_brg='$id_brg' and id_beli='$id_beli'");
	$masih2=mysqli_fetch_array($cekdata2);
	
	if($masih2 > 0)
		{
			$queryedit1 = "UPDATE `rinci_beli` SET 
			`jml`=jml + '".$jml_beli."', `hrg_ttl`=(jml * '$harga'), `harga`='$harga' 
			WHERE id_beli='".$id_beli."' and id_brg='".$id_brg."'";
			$sqledit1 = mysqli_query($conn, $queryedit1);
			if($sqledit1){
			$queryedit2 = "UPDATE `tb_barang` SET 
			`stok`=stok - '".$jml_beli."'
			WHERE `id_brg`='".$id_brg."'";
			$sqledit2 = mysqli_query($conn, $queryedit2);
			header("location: rinci_transaksi.php");	
			}else{
				echo "Error";    
				echo "<br><a href='rinci_transaksi.php'>Kembali Ke Form</a>";
			}
			
		}else{
				$jml = mysqli_query($conn, "select sum(h_jual * '$jml_beli') as jml_beli2 from tb_barang where id_brg='$id_brg'");
				$masih_k=mysqli_fetch_array($jml);
				$ttl_hrg = $masih_k['jml_beli2'];
				$query2 = "INSERT INTO `rinci_beli`
				VALUES ('".$id_beli."',
				'".$id_user."',
				'".$id_brg."',
				'".$jml_beli."',
				'".$harga."',
				'".$ttl_hrg."',
				'terbeli')";
				$sql2 = mysqli_query($conn, $query2);
				$queryedit2 = "UPDATE `tb_barang` SET 
			`stok`=stok - '".$jml_beli."'
			WHERE `id_brg`='".$id_brg."'";
			$sqledit2 = mysqli_query($conn, $queryedit2);
				if($sql2){
					header("location: rinci_transaksi.php");
				}else{
					echo "Error2";    
					echo "<br><a href='rinci_transaksi.php'>Kembali Ke Form</a>";
					}
		
		}
	}else{
		    echo "Error3";    
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


<?php if (isset($_POST['ongkirTambah']))
		{ 
include "../koneksi.php";
$id_ongkir = $_POST['id_ongkir'];
$kota = $_POST['kota'];
$tarif = $_POST['tarif'];

$sqlhapus = "insert into ongkir values('".$id_ongkir."','".$kota."','".$tarif."')";
$sql = mysqli_query($conn, $sqlhapus);

// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database

 // Eksekusi/ Jalankan query dari variabel $query
if($sql){
	header("location: status.php");
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";    
			echo "<br><a href='status.php'>Kembali Ke Form</a>";
	}
		}
?>

<?php if (isset($_POST['editBeli']))
		{ 
include "../koneksi.php";
$id_beli = $_POST['id_beli'];
$id_brg = $_POST['id_brg'];
$id_user = $_POST['id_user'];
$jml_awal = $_POST['jml_awal'];
$jml = $_POST['jml'];
$hrg_ttl = $_POST['hrg_ttl'];

$queryedit = "UPDATE `rinci_beli` SET
 jml='".$jml."',
 hrg_ttl = '".$hrg_ttl."'
 where id_beli = '".$id_beli."' and id_brg = '".$id_brg."' and id_user = '".$id_user."'";
$editbrgbeli = mysqli_query($conn, $queryedit);
if($editbrgbeli){
	$queryeditbrg = "UPDATE `tb_barang` SET `stok`=((stok + '".$jml_awal."') - '".$jml."') where id_brg='".$id_brg."'";
	$querybarang = mysqli_query($conn, $queryeditbrg);
	if ($querybarang){
		header("location: rinci_transaksi.php");
	}else{
			echo "Maaf, Terjadi kesalahan saat mencoba untuk mengedit data ke database.";    
			echo "<br><a href='rinci_transaksi.php'>Kembali Ke Form</a>";
	}
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk mengahapus data ke database.";    
			echo "<br><a href='rinci_transaksi.php'>Kembali Ke Form</a>";
	}
		}
?>


<?php if (isset($_POST['hapusBeli']))
		{ 
include "../koneksi.php";
$id_beli = $_POST['id_beli'];
$id_brg = $_POST['id_brg'];
$id_user = $_POST['id_user'];
$jml_awal = $_POST['jml_awal'];

$queryhapus = "DELETE FROM `rinci_beli` where id_beli = '".$id_beli."' and id_brg = '".$id_brg."' and id_user = '".$id_user."'";
$hapus = mysqli_query($conn, $queryhapus);
if($hapus){
	$sqlupdate = "UPDATE `tb_barang` SET `stok`=stok + '".$jml_awal."' where id_brg='".$id_brg."'";
	$sql = mysqli_query($conn, $sqlupdate);
	if ($sql){
		header("location: rinci_transaksi.php");
	}else{
			echo "Maaf, Terjadi kesalahan saat mencoba untuk mengedit data ke database.";    
			echo "<br><a href='rinci_transaksi.php'>Kembali Ke Form</a>";
	}
	}else{
		    echo "Maaf, Terjadi kesalahan saat mencoba untuk mengahapus data ke database.";    
			echo "<br><a href='rinci_transaksi.php'>Kembali Ke Form</a>";
	}
		}
?>
<?php if (isset($_POST['terimaBukti']))
		{ 
include "../koneksi.php";
$id_beli = $_POST['id_beli'];
$status_bayar = $_POST['status_bayar'];
$status_kirim = $_POST['status_kirim'];

$queryupdate = "UPDATE `tb_transaksi` SET `status_bayar`='".$status_bayar."', status_kirim='".$status_kirim."' where id_beli='".$id_beli."'";
$update = mysqli_query($conn, $queryupdate);
if($update){
	header("location: order.php");
	}else{
			echo "Maaf, Terjadi kesalahan saat mencoba untuk mengedit data ke database.";    
			echo "<br><a href='cart.php'>Kembali Ke Form</a>";
	}
		}
?>