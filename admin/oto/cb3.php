<?php
include('../../koneksi.php');
include('../../session.php'); 

$id_brg = $_POST['id_brg']; // Menerima NPM dari JQuery Ajax dari form

$result12=mysqli_query($conn, "select * from tb_barang where id_brg='$id_brg'");
$row12=mysqli_fetch_array($result12);
$harga_jual = $row12['harga_jual'];
echo json_encode($harga_jual);
                            ?>

							