<?php
include('../koneksi.php');
$id_kategori = $_GET['id_kategori'];
$result=mysqli_query($conn, "select * from tb_kategori where id_kategori='".$id_kategori."'")or die('Error In Session');
$row=mysqli_fetch_array($result);
?>

<?php

   $sql_tampil = "Select * from tb_kategori where id_kategori='".$row['id_kategori']."'";
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
											  <label for="inputnim" class="col-lg-2 control-label">Kode Kategori</label>
											  <div class="col-lg-10">
												<input class="form-control" readonly id="id_kategori" value="<?php echo $data['id_kategori']; ?>" name="id_kategori" type="text">
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Type Kategori</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nm_kategori" value="<?php echo $data['nm_kategori']; ?>" name="nm_kategori" type="text">
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Keterangan</label>
											  <div class="col-lg-10">
												<textarea class="form-control" id="ket" name="ket" type="text"><?php echo $data['ket']; ?></textarea>
											  </div>
											</div>
                            <div class="modal-footer">
                                <button type="submit" id="updateKategori" name="updateKategori" class="btn btn-success fa fa-edit" > Update</button>
                                <button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Keluar</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>

