<?php
if (isset($_POST['login']))
		{ 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($conn,"select * from tb_user where username='$username' and password='$password' and status='ada'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['level']=="pemilik"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pemilik";
		// alihkan ke halaman dashboard admin
		header("location:pimpinan/index.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['level']=="kasir"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "kasir";
		// alihkan ke halaman dashboard pegawai
		header("location:admin/index.php");
 
	// cek jika user login sebagai pengurus
	}else if($data['level']=="gudang"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "gudang";
		// alihkan ke halaman dashboard pengurus
		header("location:gudang/index.php");
 
	}else if($data['level']=="pelanggan"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pelanggan";
		// alihkan ke halaman dashboard pengurus
		header("location:member.php");
		
	}else{
 
		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}
		}
?>