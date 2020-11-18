<?php
include('koneksi.php');
include('session.php'); 

$id_brg = $_GET['id_brg'];
$result=mysqli_query($conn, "select * from tb_barang where id_brg='".$id_brg."'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$id_kategori = $row['id_kategori'];
$result1=mysqli_query($conn, "select * from tb_kategori where id_kategori='".$id_kategori."'");
$row1=mysqli_fetch_array($result1);

$result2=mysqli_query($conn, "select * from tb_user where username='$session_id'")or die('Error In Session');
$row2=mysqli_fetch_array($result2);
?>

<?php

   $sql_tampil = "Select * from tb_barang where id_brg='".$row['id_brg']."'";
								// Query untuk menampilkan semua data anggota
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_array($query_tampil)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Tambahkan ke Keranjang</h4>
			

</div>
        <div class="modal-body">
            <form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">

							<table id="example1" class="table table-hover">
										<thead>
											<tr>
												<th width="200">Product</th>
												<th>Keterangan</th>
											</tr>
											<?php
                                $sql_tampil = "select tb_barang.foto as foto,
													  tb_barang.id_brg as id_brg,
													  tb_barang.nm_brg as nm_brg,
													  tb_barang.stok as stok,
													  tb_barang.h_beli as h_beli,
													  tb_barang.h_jual as h_jual,
													  tb_kategori.nm_kategori as type
													  from tb_barang, tb_kategori
													  where tb_barang.id_brg='$id_brg' and 
													  tb_barang.id_kategori=tb_kategori.id_kategori and tb_barang.status='ada'";
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td><?php echo "<img src='admin/furniture/".$data['foto']."' width='200' height='210'>" ?><br>
								<?php echo $data['id_brg'] ?> - <?php echo $data['nm_brg'] ?>
								</td>
											<td>
												<input hidden readonly id="id_brg" value="<?php echo $data['id_brg']; ?>" name="id_brg" type="text" required>
												<input hidden readonly id="id_user" value="<?php echo $row2['id_user']; ?>" name="id_user" type="text" required>
												<input hidden readonly id="status" value="rencana_beli" name="status" type="text" required>
							<label class="col-lg-6">Stok</label>
											<div class="form-group">
											  <div class="col-lg-10">
												<input class="form-control" readonly id="stok" value="<?php echo $data['stok']; ?>" name="stok" type="text" required>
											  </div>
											</div>
							<label class="col-lg-6">Harga</label>
											<div class="form-group">
											  <div class="col-lg-10">
												<input class="form-control" readonly id="harga_jual" value="<?php echo $data['h_jual']; ?>" name="harga_jual" type="text" required>
											  </div>
											</div>
							<label class="col-lg-6">Jumlah Dibeli</label>
											<div class="form-group">
											  <div class="col-lg-10">
												<input class="form-control" id="jml_beli" name="jml_beli" type="text" required>
											  </div>
											</div>
											</td>
                            </tr>
                            <?php
                               
                                }
                            ?>
									</table>				

											
                            <div class="modal-footer">
                                <button type="submit" id="barangbeli" name="barangbeli" class="btn btn-success fa fa-edit" > Beli</button>
                                <button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Batal</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>

