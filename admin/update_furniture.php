<?php
include('../koneksi.php');
$id_brg = $_GET['id_brg'];
$result=mysqli_query($conn, "select * from tb_barang where id_brg='".$id_brg."'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$id_kategori = $row['id_kategori'];
$result1=mysqli_query($conn, "select * from tb_kategori where id_kategori='".$id_kategori."'");
$row1=mysqli_fetch_array($result1);
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
            <h4 class="modal-title" id="myModalLabel">Update Furniture</h4>
			

</div>
        <div class="modal-body">
            <form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kode Furniture</label>
											  <div class="col-lg-10">
												<input class="form-control" readonly id="id_brg" value="<?php echo $data['id_brg']; ?>" name="id_brg" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nama Furniture</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nm_brg" value="<?php echo $data['nm_brg']; ?>" name="nm_brg" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Stok</label>
											  <div class="col-lg-10">
												<input class="form-control" id="stok" value="<?php echo $data['stok']; ?>" name="stok" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Harga Beli</label>
											  <div class="col-lg-10">
												<input class="form-control" id="harga_beli" value="<?php echo $data['h_beli']; ?>" name="harga_beli" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Harga Jual</label>
											  <div class="col-lg-10">
												<input class="form-control" id="harga_jual" value="<?php echo $data['h_jual']; ?>" name="harga_jual" type="text" required>
											  </div>
											</div>												
                            <div class="modal-footer">
                                <button type="submit" id="updateBarang" name="updateBarang" class="btn btn-success fa fa-edit" > Update</button>
                                <button type="submit" id="deleteBarang" name="deleteBarang" class="btn btn-warning fa fa-trash" > Delete</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>

