<?php
include('koneksi.php');
$id_beli = $_GET['id_beli'];
$result=mysqli_query($conn, "select * from tb_transaksi where id_beli='".$id_beli."' and status='ada'");
$row=mysqli_fetch_array($result);
$result2=mysqli_query($conn, "select * from tb_tranfer where id_beli='".$id_beli."'");
$row2=mysqli_fetch_array($result2);
?>

<?php

   $sql_tampil = "Select * from tb_transaksi where id_beli='".$row['id_beli']."'";
								// Query untuk menampilkan semua data anggota
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_array($query_tampil)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Upload Tanda Bukti Tranfer</h4>
			

</div>
        <div class="modal-body">
            <form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kode Transaksi</label>
											  <div class="col-lg-10">
												<input class="form-control" readonly id="id_beli" value="<?php echo $data['id_beli']; ?>" name="id_beli" type="id_beli" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Bukti Tranfer</label>
											  <div class="col-lg-10">
												<input class="form-control" id="foto" placeholder="foto" name="foto" type="file" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="judul" class="col-lg-2 control-label">No Rekening</label>
											  <div class="col-lg-10">
												<input class="form-control" value="<?php echo $row2['no_rek']; ?>" name="no_rek" id="no_rek" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="judul" class="col-lg-2 control-label">Atas Nama</label>
											  <div class="col-lg-10">
												<input class="form-control" value="<?php echo $row2['an']; ?>" name="an" id="an" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="judul" class="col-lg-2 control-label">Nominal</label>
											  <div class="col-lg-10">
												<input class="form-control" readonly value="<?php echo $data['ttl_bayar']; ?>" name="nominal" id="nominal" type="text" required>
											  </div>
											</div>
											<div class="input-group">
											<input type="text" value="<?php echo date('Y-m-d'); ?>"  name="tgl_upload" id="tgl_upload" hidden> 
											</div>
											<div class="input-group">
											<input type="text" value="order" id="status_bayar"  name="status_bayar" hidden> 
											</div>
                            <div class="modal-footer">
                                <button type="submit" id="fotoTF" name="fotoTF" class="btn btn-success fa fa-upload" > Upload</button>
                                <button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Keluar</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>