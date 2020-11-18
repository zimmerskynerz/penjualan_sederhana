<?php
include('../koneksi.php');
include('../session.php'); 

$result=mysqli_query($conn, "select * from tb_user where username='$session_id'")or die('Error In Session');
$row=mysqli_fetch_array($result);
$result1=mysqli_query($conn, "select * from tb_transaksi order by id_beli desc limit 1");
$row1=mysqli_fetch_array($result1);
$id_user = $row1['id_user'];
$id_beli = $row1['id_beli'];
$id_ongkir = $row1['id_ongkir'];
$result2=mysqli_query($conn, "select * from tb_user where id_user='$id_user'");
$row2=mysqli_fetch_array($result2);
$result3=mysqli_query($conn, "select sum(hrg_ttl) as harga_total from rinci_beli where id_user='$id_user' and id_beli='$id_beli'");
$row3=mysqli_fetch_array($result3);
$ht = $row3['harga_total'];
$result4=mysqli_query($conn, "select * from tb_ongkir where id_ongkir='$id_ongkir'");
$row4=mysqli_fetch_array($result4);
$tarif = $row4['tarif'];
?> 

<?php
function acak($panjang)
{
    $karakter= '123456789';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
  $pos = rand(0, strlen($karakter)-1);
  $string .= $karakter{$pos};
    }
    return $string;
}
//cara memanggilnya
$hasil_1= acak(5);
?>

<!DOCTYPE html>
<html lang="en">
  <head>


    <title>MENU ADMIN</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="assets/css/main.css">
   <link rel="stylesheet" href="assets/css/dataTables.bootstrap.css">		
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->

  </head>
	<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- SIDEBAR -->
		<div class="sidebar">
			<div class="brand"><a href="index.php"><img src="assets/img/header2.png" class="img-responsive logo"></a></div>
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
                         <br><br>
						 <li><a href="kategori.php" class=""><i class="fa fa-book"></i> <span>Daftar Kategori</span></a></li>
						<li><a href="furniture.php" class=""><i class="fa fa-book"></i> <span>Daftar Furniture</span></a></li>
						<li><a href="transaksi.php" class="active"><i class="fa fa-book"></i> <span>Daftar Transaksi</span></a></li>
						<li><a href="status.php" class=""><i class="fa fa-book"></i> <span>Status Pengiriman</span></a></li>
						<li><a href="logout.php" class=""><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                      
				  </ul>
				</nav>
			</div>
			
	  </div>
		<div class="main">
        <?php
		$Date = Date("Y-m-d");
		?>
        <!-- NAVBAR -->
			<nav class="navbar navbar-default">
				<div class="container-fluid">
						<legend> W E L C O M E </legend>
						<h1>
						<tr>
						
						<?php echo "<td align='left'>".$row2['nm_user']."</td>"; ?>
						
						</tr>
						</h1>
					
				</div>
			</nav>
			<!-- END NAVBAR -->
        
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">TRANSAKSI</h3>
					<div class="row">
                    	
                    	<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
                            <div class="panel-title">
								<div class="container">
								<!-- Button trigger modal -->
                                <br>
                                <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus-square"></i>
                                  Tambah Furniture
                                </button>
								<button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModal2"><i class="fa fa-print"></i>
                                  Simpan & Cetak
                                </button>
								
                                
                                <!-- Modal -->
                                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Tambah Furniture</h4>
                                      </div>
                                      <div class="modal-body">
                                        <!--FORM MODAL-->
										<form class="form-horizontal" method="post" action="query_sql.php" enctype="multipart/form-data">
											<fieldset>
											<div class="form-group">
											  <div class="col-lg-10">
												<input type="text" value="<?php echo $row1['id_beli']; ?>" id="id_beli" name="id_beli" hidden>
											  </div>
											</div>
											<div class="form-group">
											  <div class="col-lg-10">
												<input type="text" value="<?php echo $row1['id_user']; ?>" id="id_user" name="id_user" hidden>
											  </div>
											</div>
											<div class="form-group">
											  <label for="judul" class="col-lg-2 control-label">Kode Barang</label>
											  <div class="col-lg-10">
												<input class="form-control" name="id_brg" id="id_brg" type="text" required>
											  </div>
											</div>
											<div class="form-group">
											  <label for="judul" class="col-lg-2 control-label">Jumlah</label>
											  <div class="col-lg-10">
												<input class="form-control" name="jml_beli" id="jml_beli" type="text" required>
											  </div>
											</div>
											<div class="input-group">
											<input type="text" value="<?php echo date('Y-m-d'); ?>"  name="tgl_beli" hidden> 
											</div>
											<div class="input-group">
											<input type="text" value="belum" id="status_bayar"  name="status_bayar" hidden> 
											</div>
											<div class="input-group">
											<input type="text" value="belum" id="status_kirim" name="status_kirim" hidden> 
											</div>
											<div class="form-group">
											  <div class="col-lg-10 col-lg-offset-2">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary" id="barangbeli" name="barangbeli">Tambah Furniture</button>
											  </div>
											</div>
											</fieldset>
										</form>

<!--END FORM MODAL-->
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                <!--end modal-->
								
								<!-- Modal -->
                                <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel">Simpan & Cetak Transaksi</h4>
                                      </div>
                                      <div class="modal-body">
                                        <!--FORM MODAL-->
										<form class="form-horizontal" method="post" action="nota.php" enctype="multipart/form-data">
											<fieldset>
											<div class="form-group">
											  <div class="col-lg-10">
												<input type="text" value="<?php echo $row1['id_beli']; ?>" id="id_beli" name="id_beli" hidden>
											  </div>
											</div>
											<div class="form-group">
											  <div class="col-lg-10">
												<input type="text" value="<?php echo $row1['id_user']; ?>" id="id_user" name="id_user" hidden>
											  </div>
											</div>
											<label for="judul" class="col-lg-3 control-label">Total Harga</label>
											<div class="form-group">
												<input name="ttl_hrg" id="ttl_hrg" value="<?php echo $row3['harga_total']; ?>" type="text" readonly>
											</div>
											<label for="judul" class="col-lg-3 control-label">Kota Tujuan</label>
											<div class="form-group">
												<input name="tujuan" id="tujuan" type="text" value="<?php echo $row4['kota_tujuan']; ?>" readonly>
											</div>
											<label for="judul" class="col-lg-3 control-label">Ongkos Kirim</label>
											<div class="form-group">
												<input name="ongkir" id="ongkir" type="text" value="<?php echo $row4['tarif']; ?>" readonly>
											</div>
											<label for="judul" class="col-lg-3 control-label">Total Bayar</label>
											<div class="form-group">
												<input name="ttl_bayar" id="ttl_bayar" type="text" value="<?php echo ($ht + $tarif) ?>" readonly>
											</div>
											<label for="judul" class="col-lg-3 control-label">Bayar</label>
											<div class="form-group">
												<input name="bayar" id="bayar" type="text" onkeyup="sum();" required>
											</div>
											<label for="judul" class="col-lg-3 control-label">Kembalian</label>
											<div class="form-group">
												<input name="kembalian" id="kembalian" type="text" readonly>
											</div>
											<script>
function sum() {
      var txtFirstNumberValue = document.getElementById('ttl_bayar').value;
      var txtSecondNumberValue = document.getElementById('bayar').value;
      var result = parseInt(txtSecondNumberValue) - parseInt(txtFirstNumberValue);
      if (!isNaN(result)) {
         document.getElementById('kembalian').value = result;
      }
}
</script>
											<label for="judul" class="col-lg-3 control-label">Status Bayar</label>
											  <div class="input-group">
											<select id="status_bayar" name="status_bayar" width = "30px">
												<option>---- Status Bayar ----</option>
												<option value="lunas">----    LUNAS     ----</option>
												<option value="tranfer">----   TRANFER    ----</option>
												<option value="order">----    ORDER     ----</option>
												</select>
											</div>
											<div class="input-group">
											<input type="text" value="<?php echo date('Y-m-d'); ?>"  name="tgl_beli" hidden> 
											</div>
											<div class="input-group">
											<input type="text" value="belum" id="status_kirim" name="status_kirim" hidden> 
											</div>
											<div class="form-group">
											  <div class="col-lg-10 col-lg-offset-2">
												<button type="reset" class="btn btn-default" data-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-primary" id="cetak_tr" name="cetak_tr">Simpan & Cetak</button>
											  </div>
											</div>
											</fieldset>
										</form>

<!--END FORM MODAL-->
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                <!--end modal-->
<!--        untuk edit-->
        <div id="ModalEdit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        </div>	
                                </div>    
								</div>
								<div class="panel-body">
									<table id="example1" class="table table-hover">
										<thead>
											<tr>
												<th>Kode Barang</th>
												<th>Nama Barang</th>
												<th>Jumlah</th>
												<th>Harga</th>
												<th>Total Harga</th>
												<th>Aksi</th>
											</tr>
										</thead>
										<tbody>
											<?php
                                $sql_tampil = "select rinci_beli.id_brg as id_brg,
													  rinci_beli.id_beli as id_beli,
													  tb_barang.nm_brg as nm_brg,
													  rinci_beli.jml as jml,
													  rinci_beli.harga as harga,
													  rinci_beli.hrg_ttl as hrg_ttl
												from  rinci_beli, tb_barang, tb_transaksi
												where rinci_beli.id_beli=tb_transaksi.id_beli
												and	  rinci_beli.id_brg=tb_barang.id_brg
												and   rinci_beli.id_beli='$id_beli'";
								// Query untuk menampilkan semua data buku  
								$query_tampil = mysqli_query($conn, $sql_tampil);
								
								while($data = mysqli_fetch_assoc($query_tampil)){
                            ?>
                            <tr>
                                <td align="center"><?php echo $data['id_brg'] ?></td>
                                <td><?php echo $data['nm_brg'] ?></td>
								<td><?php echo $data['jml'] ?></td>
                                <td><?php echo $data['harga'] ?></td>
                                <td><?php echo $data['hrg_ttl'] ?></td>
								<td>
                                    <a href="#" class='btn btn-warning open_modal' id='<?php echo $data['id_brg']; ?>'><span class="lnr lnr-pencil"> Detail</span></a>
                                </td>
                            </tr>
                            <?php
                               
                                }
                            ?>
										</tbody>
									</table>
								</div>
								</div>
							</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="assets/js/jquery/jquery-2.1.0.min.js"></script>
	<script src="assets/js/bootstrap/bootstrap.min.js"></script>
	<script src="assets/js/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/js/plugins/jquery-easypiechart/jquery.easypiechart.min.js"></script>
	<script src="assets/js/plugins/chartist/chartist.min.js"></script>
	<script src="assets/js/klorofil.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>	
    <script type="text/javascript">	
	  <script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
    </script>

    <script type="text/javascript">
            $(document).ready(function (){
                $(".open_modal").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "rinci_beli.php",
                        type: "GET",
                        data : {id_brg: m,},
                        success: function (ajaxData){
                            $("#ModalEdit").html(ajaxData);
                            $("#ModalEdit").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
        
        <script type="text/javascript">
            $(document).ready(function (){
                $(".open_delete").click(function (e){
                    var m = $(this).attr("id");
                    $.ajax({
                        url: "tr_edit.php",
                        type: "GET",
                        data : {id_beli: m,},
                        success: function (ajaxData){
                            $("#ModalDelete").html(ajaxData);
                            $("#ModalDelete").modal('show',{backdrop: 'true'});
                        }
                    });
                });
            });
        </script>
				<script src="assets/js/jquery.dataTables.min.js"></script>
        <script src="assets/js/dataTables.bootstrap.js"></script>	
        <script type="text/javascript">
            $(function() {
                $('#example1').dataTable();
            });
        </script>
	</body>
</html>