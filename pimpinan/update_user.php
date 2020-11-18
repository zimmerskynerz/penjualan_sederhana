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
            <h4 class="modal-title" id="myModalLabel">Update User</h4>
			

</div>
        <div class="modal-body">
            <form class="form-horizontal" action="query_sql.php" name="modal-popup" enctype="multipart/form-data" method="POST" id="form-edit">
											<div class="input-group">
											<input type="text" value="<?php echo $data['id_user']; ?>"  name="id_user" id="id_user" hidden> 
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Username</label>
											  <div class="col-lg-10">
												<input class="form-control" id="username" value="<?php echo $data['username']; ?>" name="username" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Password</label>
											  <div class="col-lg-10">
												<input class="form-control" id="password" value="<?php echo $data['password']; ?>" name="password" type="password" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nama User</label>
											  <div class="col-lg-10">
												<input class="form-control" id="nm_user" value="<?php echo $data['nm_user']; ?>" name="nm_user" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Alamat</label>
											  <div class="col-lg-10">
												<textarea class="form-control" id="alamat" name="alamat" required><?php echo $data['alamat']; ?></textarea>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kota</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kota" value="<?php echo $data['kota']; ?>" name="kota" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Kode Pos</label>
											  <div class="col-lg-10">
												<input class="form-control" id="kode_pos" value="<?php echo $data['kode_pos']; ?>" name="kode_pos" type="text" max="5" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Nomor HP</label>
											  <div class="col-lg-10">
												<input class="form-control" id="no_hp" value="<?php echo $data['no_hp']; ?>" name="no_hp" type="text" max="13" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Email</label>
											  <div class="col-lg-10">
												<input class="form-control" id="email" value="<?php echo $data['email']; ?>" name="email" type="email" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="inputnim" class="col-lg-2 control-label">Jabatan</label>
											  <div class="col-lg-10">
												<select name="level" id="level" width = "30px">
												<option value="<?php echo $data['level']; ?>"><?php echo $data['level']; ?></option>
												<option value="kasir">Kasir</option>
												<option value="gudang">Gudang</option>
												<option value="pelanggan">Pelanggan</option>
												</select>
											  </div>
											</div>
                            <div class="modal-footer">
                                <button type="submit" id="updateUser" name="updateUser" class="btn btn-success fa fa-edit" > Update</button>
                                <button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Keluar</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>

