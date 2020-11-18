<?php
include('../../koneksi.php');
include('../../session.php'); 

$id_kategori = $_POST['id_kategori']; // Menerima NPM dari JQuery Ajax dari form

$cari=mysqli_query($conn, "select max(id_brg) as id_brg from tb_barang where id_kategori='$id_kategori'");
$hasil_cari=mysqli_fetch_array($cari);
$kode = substr($hasil_cari['id_brg'],3,3);
$kode_brg=$kode+1;
$masukan=$id_kategori.str_pad($kode_brg, 3, "0", STR_PAD_LEFT);

echo json_encode($masukan);
                            ?>

							