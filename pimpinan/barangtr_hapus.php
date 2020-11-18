 		<?php
include('../koneksi.php');
include('../session.php');

$kode_furniture = $_GET['kode_furniture'];
$hapus_beli=mysqli_query($conn, "select * from rinci_beli where kode_furniture='$kode_furniture'");
$hapus=mysqli_fetch_array($hapus_beli);

$result=mysqli_query($conn, "select * from user where username_u='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$id_user = $row['id_user'];
$transaksi=mysqli_query($conn, "select * from pembelian order by id_beli desc limit 1");
$aksi=mysqli_fetch_array($transaksi);
$id_beli2 = $aksi['id_beli'];
$transaksi2=mysqli_query($conn, "select sum(ttl_hrg) as hrg_bayar from rinci_beli where id_beli='$id_beli2'");
$aksi2=mysqli_fetch_array($transaksi2);
?>
 
 <!-- EditMember Modal-->
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Hapus Barang Beli?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
		<form action="query_sql.php" enctype="multipart/form-data" method="POST">
		<fieldset>
					<label>ID BARANG</label>
					<div class="input-group">
						<input type="text" value="<?php echo $hapus['kode_furniture']; ?>" name="kode_furniture" id="kode_furniture" readonly> 
					</div>
					<div class="input-group">
						<input type="text" id="id_beli" value="<?php echo $aksi['id_beli']; ?>" name="id_beli" readonly hidden>
					</div>
					<label>Jumlah</label>
					<div class="input-group">
						<input type="text" id="jml_beli" value="<?php echo $hapus['jml_beli']; ?>" name="jml_beli" readonly>
					</div>
					<label>Harga Total</label>
					<div class="input-group">
						<input type="text" id="hrg_ttl" name="hrg_ttl"  value="<?php echo $hapus['ttl_hrg']; ?>" readonly>
					</div>
					<div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <button type="submit" name="hapus_tr_br" id="hapus_tr_br" class="btn btn-success">Hapus Barang</button>
      </div>
					</fieldset>
        </form>
		
		
		
		
		</div>
        <div class="modal-footer">
		
          
        </div>
      </div>
    </div>
	
	
	
