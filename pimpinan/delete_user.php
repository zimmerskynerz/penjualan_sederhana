<?php
include('../koneksi.php');
$id_user = $_GET['id_user'];
$result=mysqli_query($conn, "select * from tb_user where id_user='".$id_user."'")or die('Error In Session');
$row=mysqli_fetch_array($result);
?>

<?php

   $sql_tampil = "select * from tb_user where id_user='".$id_user."'";
								// Query untuk menampilkan semua data anggota
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_array($query_tampil)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Delete User</h4>
			

</div>
        <div class="modal-body">
            <form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
											<div class="input-group">
											<input type="text" value="<?php echo $data['id_user']; ?>"  name="id_user" id="id_user" hidden> 
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Username</label>
											  <div class="col-lg-10">
												<input class="form-control" id="username" readonly value="<?php echo $data['username']; ?>" name="username" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Password</label>
											  <div class="col-lg-10">
												<input class="form-control" id="password_u" readonly value="<?php echo $data['password']; ?>" name="password_u" type="password" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nama User</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nama_user" readonly value="<?php echo $data['nm_user']; ?>" name="nama_user" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Jabatan</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nama_user" readonly value="<?php echo $data['level']; ?>" name="nama_user" type="text" required>
											  </div>
											</div>
                            <div class="modal-footer">
                                <button type="submit" id="deleteUser" name="deleteUser" class="btn btn-success fa fa-edit" > Hapus</button>
                                <button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Keluar</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>

