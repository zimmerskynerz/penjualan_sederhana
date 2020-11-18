<?php if (isset($_POST['daftarMember'])) {
	include "koneksi.php";
	$username			= $_POST['username'];
	$nk_pass			= $_POST['nk_pass'];
	$nm_user			= $_POST['nm_user'];
	$alamat				= $_POST['alamat'];
	$kota			    = $_POST['kota'];
	$kd_pos				= $_POST['kd_pos'];
	$no_hp				= $_POST['no_hp'];
	$email				= $_POST['email'];

	$query = "INSERT INTO tb_user (`id_user`,
 `username`, 
 `password`,
 `nm_user`, 
 `alamat`, 
 `kota`, 
 `kode_pos`, 
 `no_hp`, 
 `email`, 
 `level`, 
 `status`)
 VALUES(
'',
'" . $username . "',
'" . $nk_pass . "',
'" . $nm_user . "',
'" . $alamat . "',
'" . $kota . "',
'" . $kd_pos . "',
'" . $no_hp . "',
'" . $email . "',
'pelanggan',
'ada')";
	$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

	if ($sql) {
		header("location: index.php");
	} else {
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data transaksi ke database.";
		echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
	}
}
?>

<?php if (isset($_POST['updateUser'])) {
	include "koneksi.php";
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
`username`='" . $username . "',
`password`='" . $password . "',
`nm_user`='" . $nm_user . "',
`alamat`='" . $alamat . "',
`kota`='" . $kota . "',
`kode_pos`='" . $kode_pos . "',
`no_hp`='" . $no_hp . "',
`email`='" . $email . "'
 WHERE `id_user`='" . $id_user . "'";
	$sqledit = mysqli_query($conn, $queryedit); // Eksekusi/ Jalankan query dari variabel $query
	if ($sqledit) {
		header("location: member.php");
	} else {
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		echo "<br><a href='member.php'>Kembali Ke Form</a>";
	}
}
?>

<?php if (isset($_POST['barangbeli'])) {
	include "koneksi.php";
	$id_brg = $_POST['id_brg'];
	$id_user = $_POST['id_user'];
	$status = $_POST['status'];
	$harga_jual = $_POST['harga_jual'];
	$stok = $_POST['stok'];
	$jml_beli = $_POST['jml_beli'];


	$cekdata = mysqli_query($conn, "select * from tb_barang where id_brg='$id_brg' and status='ada'");
	$masih = mysqli_fetch_array($cekdata);
	// Eksekusi/ Jalankan query dari variabel $query
	if ($masih > 0) {
		$cekdata2 = mysqli_query($conn, "select * from rinci_beli where id_brg='$id_brg' and id_user='$id_user' and status='rencana_beli'");
		$masih2 = mysqli_fetch_array($cekdata2);

		if ($masih2 > 0) {
			$queryedit1 = "UPDATE `rinci_beli` SET 
			`jml`=jml + '" . $jml_beli . "', `hrg_ttl`=(jml * '$harga_jual'), `harga`='$harga_jual' 
			WHERE id_user='" . $id_user . "' and id_brg='" . $id_brg . "'";
			$sqledit1 = mysqli_query($conn, $queryedit1);
			if ($sqledit1) {
				$queryedit2 = "UPDATE `tb_barang` SET 
			`stok`=stok - '" . $jml_beli . "'
			WHERE `id_brg`='" . $id_brg . "'";
				$sqledit2 = mysqli_query($conn, $queryedit2);
				header("location: product.php");
			} else {
				echo "Maaf, Terjadi kesalahan saat mencoba untuk rinci_beli 1 data ke database.";
				echo "<br><a href='product.php'>Kembali Ke Form</a>";
			}
		} else {
			$jml = mysqli_query($conn, "select sum(h_jual * '$jml_beli') as jml_beli2 from tb_barang where id_brg='$id_brg'");
			$masih_k = mysqli_fetch_array($jml);
			$ttl_hrg = $masih_k['jml_beli2'];
			$query2 = "INSERT INTO `rinci_beli` (`id_user`, `id_brg`, `jml`, `harga`, `hrg_ttl`, `status`)
				VALUES ('" . $id_user . "',
				'" . $id_brg . "',
				'" . $jml_beli . "',
				'" . $harga_jual . "',
				'" . $ttl_hrg . "',
				'" . $status . "')";
			$sql2 = mysqli_query($conn, $query2);
			$queryedit2 = "UPDATE `tb_barang` SET 
			`stok`=stok - '" . $jml_beli . "'
			WHERE `id_brg`='" . $id_brg . "'";
			$sqledit2 = mysqli_query($conn, $queryedit2);
			if ($sql2) {
				header("location: product.php");
			} else {
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
				echo "<br><a href='product.php'>Kembali Ke Form</a>";
			}
		}
	} else {
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan3 data ke database.";
		echo "<br><a href='product.php'>Kembali Ke Form</a>";
	}
}
?>


<?php if (isset($_POST['editBeli'])) {
	include "koneksi.php";
	$id_brg = $_POST['id_brg'];
	$id_user = $_POST['id_user'];
	$jml_awal = $_POST['jml_awal'];
	$jml = $_POST['jml'];
	$hrg_ttl = $_POST['hrg_ttl'];
	$status = $_POST['status'];

	$queryedit = "UPDATE `rinci_beli` SET
 jml='" . $jml . "',
 hrg_ttl = '" . $hrg_ttl . "'
 where status = '" . $status . "' and id_brg = '" . $id_brg . "' and id_user = '" . $id_user . "'";
	$editbrgbeli = mysqli_query($conn, $queryedit);
	if ($editbrgbeli) {
		$queryeditbrg = "UPDATE `tb_barang` SET `stok`=((stok + '" . $jml_awal . "') - '" . $jml . "') where id_brg='" . $id_brg . "'";
		$querybarang = mysqli_query($conn, $queryeditbrg);
		if ($querybarang) {
			header("location: cart.php");
		} else {
			echo "Maaf, Terjadi kesalahan saat mencoba untuk mengedit data ke database.";
			echo "<br><a href='cart.php'>Kembali Ke Form</a>";
		}
	} else {
		echo "Maaf, Terjadi kesalahan saat mencoba untuk mengahapus data ke database.";
		echo "<br><a href='cart.php'>Kembali Ke Form</a>";
	}
}
?>

<?php if (isset($_POST['hapusBeli'])) {
	include "koneksi.php";
	$id_brg = $_POST['id_brg'];
	$id_user = $_POST['id_user'];
	$jml_awal = $_POST['jml_awal'];

	$queryhapus = "DELETE FROM `rinci_beli` where status = 'rencana_beli' and id_brg = '" . $id_brg . "' and id_user = '" . $id_user . "'";
	$hapus = mysqli_query($conn, $queryhapus);
	if ($hapus) {
		$sqlupdate = "UPDATE `tb_barang` SET `stok`=stok + '" . $jml_awal . "' where id_brg='" . $id_brg . "'";
		$sql = mysqli_query($conn, $sqlupdate);
		if ($sql) {
			header("location: cart.php");
		} else {
			echo "Maaf, Terjadi kesalahan saat mencoba untuk mengedit data ke database.";
			echo "<br><a href='cart.php'>Kembali Ke Form</a>";
		}
	} else {
		echo "Maaf, Terjadi kesalahan saat mencoba untuk mengahapus data ke database.";
		echo "<br><a href='cart.php'>Kembali Ke Form</a>";
	}
}
?>

<?php if (isset($_POST['transaksiBaru'])) {
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

	$cekongkir = mysqli_query($conn, "select * from tb_ongkir where id_ongkir='" . $id_ongkir . "' and status='ada'");
	$ongkir = mysqli_fetch_array($cekongkir);

	$kota				= $ongkir['kota_tujuan'];

	$query = "INSERT INTO tb_user (`id_user`, `nm_user`, `alamat`, `kota`, `kode_pos`, `no_hp`, `email`, `level`, `status`)
 VALUES(
'',
'" . $nm_user . "',
'" . $alamat . "',
'" . $kota . "',
'" . $kode_pos . "',
'" . $no_hp . "',
'" . $email . "',
'pelanggan',
'ada')";
	$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query

	if ($sql) {
		$cekdata = mysqli_query($conn, "select * from tb_user where nm_user='" . $nm_user . "' and no_hp='" . $no_hp . "'");
		$data = mysqli_fetch_array($cekdata);
		if ($data > 0) {
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
			 '" . $tgl_beli . "', 
			 '" . $id_user . "', 
			 '', 
			 '" . $id_ongkir . "', 
			 '', 
			 '', 
			 '', 
			 'belum', 
			 'belum', 
			 'ada')";
			$transaksi = mysqli_query($conn, $querytransaksi);
			if ($transaksi) {
				header("location: rinci_transaksi.php");
			} else {
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data transaksi ke database.";
				echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
			}
		} else {
			echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data user ke database.";
			echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
		}
	} else {
		echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		echo "<br><a href='transaksi.php'>Kembali Ke Form</a>";
	}
}
?>

<?php if (isset($_POST['fotoTF'])) {
	include "koneksi.php";
	$id_beli		= $_POST['id_beli'];
	$no_rek			= $_POST['no_rek'];
	$an				= $_POST['an'];
	$nominal		= $_POST['nominal'];
	$tgl_upload		= $_POST['tgl_upload'];
	$status_bayar	= $_POST['status_bayar'];
	// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database
	$foto = $_FILES['foto']['name'];
	$tmp = $_FILES['foto']['tmp_name'];

	// Rename nama fotonya dengan menambahkan tanggal dan jam upload
	$fotobaru = date('dmYHis') . $foto;
	// Set path folder tempat menyimpan fotonya
	$path = "admin/tranfer/" . $fotobaru;

	$tf = mysqli_query($conn, "select * from tb_tranfer where id_beli='" . $id_beli . "'");
	$adatf = mysqli_fetch_array($tf);
	if ($adatf < 1) {
		if (move_uploaded_file($tmp, $path)) {
			// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database
			$query = "INSERT INTO tb_tranfer VALUES('" . $id_beli . "',
'" . $tgl_upload . "',
'" . $fotobaru . "',
'" . $no_rek . "',
'" . $an . "',
'" . $nominal . "')";
			$sql = mysqli_query($conn, $query); // Eksekusi/ Jalankan query dari variabel $query
			if ($sql) {
				$sqlupdate = "UPDATE `tb_transaksi` SET `status_bayar`='" . $status_bayar . "' where id_beli='" . $id_beli . "'";
				$sql = mysqli_query($conn, $sqlupdate);
				header("location: status.php");
			} else {
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
				echo "<br><a href='status.php'>Kembali Ke Form</a>";
			}
		} else {
			// Jika gambar gagal diupload, Lakukan :  
			echo "Maaf, Gambar gagal untuk diupload.";
			echo "<br><a href='status.php'>Kembali Ke Form</a>";
		}
	} else {
		if (move_uploaded_file($tmp, $path)) {
			// Cek apakah gambar berhasil diupload atau tidak  // Proses simpan ke Database
			$query2 = "UPDATE tb_tranfer SET tgl_upload= '" . $tgl_upload . "', foto='" . $fotobaru . "', no_rek= '" . $no_rek . "', an ='" . $an . "', nominal='" . $nominal . "' where id_beli='" . $id_beli . "'";
			$sql2 = mysqli_query($conn, $query2);
			if ($sql2) {
				header("location: status.php");
			} else {
				echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan2 data ke database.";
				echo "<br><a href='status.php'>Kembali Ke Form</a>";
			}
		}
	}
}
?>