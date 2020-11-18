<?php
include('koneksi.php');
include('session.php'); 
$result=mysqli_query($conn, "select * from tb_user where username='$session_id'")or die('Error In Session');
$data=mysqli_fetch_array($result);
$id_user = $data['id_user'];
$id_brg = $_GET['id_brg'];
$result2=mysqli_query($conn, "select * from rinci_beli where id_brg='$id_brg' and id_user='$id_user' and status='rencana_beli'");
$row2=mysqli_fetch_array($result2);
?>

<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
            <h4 class="modal-title" id="myModalLabel">Detail Pembelian Barang</h4>
	</div>
        <div class="modal-body">
            <form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
											<fieldset>
												<input type="text" value="<?php echo $data['id_user']; ?>" id="id_user" name="id_user" hidden>
												<input type="text" value="<?php echo $row2['jml']; ?>" id="jml_awal" name="jml_awal" hidden>
												<input type="text" value="<?php echo $row2['harga']; ?>" id="harga" name="harga" hidden>
												<input type="text" value="rencana_beli" id="status" name="status" hidden>
											<label for="judul" class="col-lg-3 control-label">Kode Barang</label>
											<div class="form-group">
												<input name="id_brg" id="id_brg" value="<?php echo $row2['id_brg']; ?>" type="text" readonly>
											</div>
											<label for="judul" class="col-lg-3 control-label">Harga Barang</label>
											<div class="form-group">
												<input type="text" value="<?php echo $row2['harga']; ?>" id="harga" name="harga" readonly>
											</div>
											<label for="judul" class="col-lg-3 control-label">Jumlah Beli</label>
											<div class="form-group">
												<input name="jml" id="jml" type="text" onkeyup="sum();">
											</div>
											<label for="judul" class="col-lg-3 control-label">Total Harga</label>
											<div class="form-group">
												<input name="hrg_ttl" id="hrg_ttl" type="text" readonly>
											</div>
											<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('jml').value;
      var txtSecondNumberValue = document.getElementById('harga').value;
      var result = parseInt(txtSecondNumberValue) * parseInt(txtFirstNumberValue);
      if (!isNaN(result)) {
         document.getElementById('hrg_ttl').value = result;
      }
}
</script>
											<div class="input-group">
											<input type="text" value="<?php echo date('Y-m-d'); ?>"  name="tgl_beli" hidden> 
											</div>
											<div class="form-group">
											  <div class="col-lg-10 col-lg-offset-2">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary" id="editBeli" name="editBeli">Edit</button>
												<button type="submit" class="btn btn-danger" id="hapusBeli" name="hapusBeli">Hapus</button>
											  </div>
											</div>
											</fieldset>
										</form>
        </div>
    </div>

