<?php
include('../koneksi.php');
include('../session.php'); 

$result=mysqli_query($conn, "select * from user where username_u='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$id_user = $row['id_user'];
$transaksi=mysqli_query($conn, "select * from pembelian order by id_beli desc limit 1");
$aksi=mysqli_fetch_array($transaksi);
$id_beli2 = $aksi['id_beli'];
$transaksi2=mysqli_query($conn, "select sum(ttl_hrg) as hrg_bayar from rinci_beli where id_beli='$id_beli2'");
$aksi2=mysqli_fetch_array($transaksi2);
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>TRANSAKSI</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body id="page-top">
			<div class="card-body">
				<div class="table-responsive">
		<form action="query_sql.php" enctype="multipart/form-data" method="POST">
		<fieldset>
					<div class="input-group">
						<input type="text" value="<?php echo $aksi['id_beli']; ?>" name="id_beli" readonly hidden> 
					</div>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<tr>
					<td><a>Kode Barang <input type="text" placeholder="Kode Barang" name="kode_furniture" > </a></td>
					<td><a>Jumlah Beli <input type="text" placeholder="Jumlah Beli" name="jml_beli" > <?php
if(isset($_GET['pesan'])){
		if($_GET['pesan']=="gagal"){
			echo "<div class='alert'>Stok Kurang Dari Jumlah Pembelian Atau Kode Barang tidak terdeteksi</div>";
		}
	}
?>	
<?php
if(isset($_GET['pesan1'])){
		if($_GET['pesan1']=="gagal"){
			echo "<div class='alert'>Kadang Ada beberapa yang masih eror!</div>";
		}
	}
?> </a></td>
					<td><button type="submit" name="barangbeli" id="barangbeli" class="btn btn-success">Tambah Barang</button> </td>
					
					</tr>
					
                </table>
				</fieldset>
        </form>
              </div>
			  </div>
            <div id="BarangTrhapus" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			</div>
<div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				  <thead>
					<tr>
                      <th>Kode Barang</th>
                      <th>Harga</th>
                      <th>Jumlah</th>
                      <th>Total Harga</th>
                      <th>Aksi</th>
                    </tr>
					
                  </thead>
                  <tbody>
                    <?php
								
								$id_tr= $aksi['id_beli'];
                                $sql_tampil = "select * from rinci_beli where id_beli='$id_tr'";
								
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td align="center"><?php echo $data['kode_furniture'] ?></td>																								
								<td align="center"><?php echo $data['harga'] ?></td>									
                                <td align="center"><?php echo $data['jml_beli'] ?></td>
								<td align="center"><?php echo $data['ttl_hrg'] ?></td>
								 <td>
									<a href="#" class='btn btn-sm btn-danger shadow-sm hapus_modal' id='<?php echo $data['kode_furniture']; ?>'>Hapus</a>
                                </td>
                            </tr>
                            <?php
                               
                                }
                            ?>
                  </tbody>
                </table>
              </div>
            </div>
			
			
			<div class="card-body">
              <div class="table-responsive">
			  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
			  <tr>
			  <form target="_blank" action="print_nota.php" enctype="multipart/form-data" method="POST">
			<fieldset>
					<td>
					<label>Kode Transaksi</label>
					<div class="input-group">
						<input type="text" value="<?php echo $aksi['id_beli'];?>" id="id_beli" name="id_beli" readonly>
					</div>
					<div class="input-group">
						<input type="text" value="lunas" id="status" name="status" readonly hidden>
					</div>
					<div class="input-group">
						<input type="text" value="dikirim" id="status_kirim" name="status_kirim" readonly hidden>
					</div>
                    <label>Harga Total</label>
					<div class="input-group">
						<input type="text" value="<?php echo $aksi2['hrg_bayar'];?>" id="hrg_bayar" name="hrg_bayar" readonly>
					</div>
					<label>Bayar?</label>
					<div class="input-group">
						<input type="text" id="bayar" onkeyup="sum1();" name="bayar" required="tolong pembayaran diisi ya!">
					</div>
					<label>Kembalian</label>
					<div class="input-group">
						<input type="text" id="kmbl" name="kmbl" onchange="tryNumberFormat(this.form.thirdBox);" readonly>
					</div>
					<label>Pengiriman</label>
					<div class="input-group">
						<select name="id_ongkir" id="id_ongkir" width = "30px">
												<option>---- Pilih Kota ----</option>
													<?php
													$userr = mysqli_query($conn, "Select * from ongkir");
								// Query untuk menampilkan semua data anggota
								if(mysqli_num_rows($userr) == 0){
									echo "<option>Tidak ada Tujuan </option>";
								}else{
								while($row = mysqli_fetch_assoc($userr)){
									echo "
									<option value=".$row['id_ongkir'].">".$row['kota']." - ".$row['tarif']."</option>";
								}
								}
								?>
												</select>
					</div>
					<script>
					function sum1() {
					var txtFirstNumberValue = document.getElementById('hrg_bayar').value;
					var txtSecondNumberValue = document.getElementById('bayar').value;
					var result1 = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);
					if (!isNaN(result1)) {
					document.getElementById('kmbl').value = result1;
					}
						}
					</script>
					<br>
					<button type="submit" name="cetak_tr" id="cetak_tr" onclick="window.location.href='transaksi.php'" class="btn btn-success">Cetak</button>
					

				</fieldset>
        </form>
		<br>
		<form action="query_sql.php" enctype="multipart/form-data" method="POST">
			<fieldset>
			<div class="input-group">
						<input type="text" value="<?php echo $aksi['id_beli'];?>" id="id_tr" name="id_tr" readonly hidden>
					</div>
					<button type="submit" name="batal_tr" id="batal_tr" class="btn btn-danger">Batal Transaksi</button>
					</fieldset>
        </form>
		</tr>
		</table>
              </div>
            </div>
          </div>
		  
    <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

		<script type="text/javascript">
            $(document).ready(function (){
                $(".hapus_modal").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "barangtr_hapus.php",
                        type: "GET",
                        data : {kode_furniture: m,},
                        success: function (ajaxData){
                            $("#BarangTrhapus").html(ajaxData);
                            $("#BarangTrhapus").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
		
		
</body>

</html>