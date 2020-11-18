<?php
include('../koneksi.php');
$id_brg = $_GET['id_brg'];
$result=mysqli_query($conn, "select * from tb_barang where id_brg='".$id_brg."'")or die('Error In Session');
$row=mysqli_fetch_array($result);
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
            <h4 class="modal-title" id="myModalLabel">Update Foto Furniture</h4>
			

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
											  <label for="inputnim" class="col-lg-2 control-label">Foto Furniture</label>
											  <div class="col-lg-10">
												<input class="form-control" id="foto" placeholder="foto" name="foto" type="file" required>
											  </div>
											</div>
                            <div class="modal-footer">
                                <button type="submit" id="fotoFurniture" name="fotoFurniture" class="btn btn-success fa fa-upload" > Upload</button>
                                <button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Keluar</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>

