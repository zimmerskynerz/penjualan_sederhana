<?php
include('../koneksi.php');
$id_beli = $_GET['id_beli'];
$result=mysqli_query($conn, "select * from tb_transaksi where id_beli='".$id_beli."'");
$row=mysqli_fetch_array($result);
?>

<?php

   $sql_tampil = "Select * from tb_tranfer where id_beli='".$row['id_beli']."'";
								// Query untuk menampilkan semua data anggota
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_array($query_tampil)){
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Detail Bukti Pembayaran</h4>
			

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
                                $sql_tampil = "Select * from tb_tranfer where id_beli='$id_beli'";
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td><?php echo "<img src='tranfer/".$data['foto']."' width='200' height='210'>" ?><br>
								<?php echo $data['id_beli'] ?>
								</td>
											<td>
												<input hidden readonly id="id_beli" value="<?php echo $data['id_beli']; ?>" name="id_beli" type="text" required>
												<input hidden readonly id="status_bayar" value="tranfer" name="status_bayar" type="text" required>
												<input hidden readonly id="status_kirim" value="proses" name="status_kirim" type="text" required>
							<label class="col-lg-6">Atas Nama</label>
											<div class="form-group">
											  <div class="col-lg-10">
												<input class="form-control" readonly id="stok" value="<?php echo $data['an']; ?>" name="stok" type="text" required>
											  </div>
											</div>
							<label class="col-lg-6">No Rekening</label>
											<div class="form-group">
											  <div class="col-lg-10">
												<input class="form-control" readonly id="harga_jual" value="<?php echo $data['no_rek']; ?>" name="harga_jual" type="text" required>
											  </div>
											</div>
							<label class="col-lg-6">Nominal</label>
											<div class="form-group">
											  <div class="col-lg-10">
												<input class="form-control" readonly id="jml_beli" name="jml_beli" value="<?php echo $data['nominal']; ?>" type="text" required>
											  </div>
											</div>
											</td>
                            </tr>
                            <?php
                               
                                }
                            ?>
									</table>				

											
                            <div class="modal-footer">
                                <button type="submit" id="terimaBukti" name="terimaBukti" class="btn btn-success fa fa-edit" > Terima</button>
                                <button class="btn btn-default fa fa-cancel" data-dismiss="modal" aria-hidden="true"> Batal</button>
                            </div>
            </form>
            <?php
    }
            ?>
        </div>
    </div>
</div>

