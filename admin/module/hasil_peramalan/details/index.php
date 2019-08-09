 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
<?php 
	$id = $_GET['id_peramalan'];
	$tgl_awal = $_GET['tgl_awal'];
	$tgl_akhir = $_GET['tgl_akhir'];


	$hasil = $lihat -> ramalandetail($id);
?>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
					  	<a href="index.php?page=hasil_peramalan"><button class="btn btn-primary"><i class="fa fa-angle-left"></i> Balik </button></a>
						<h3>Hasil Peramalan</h3>
						<?php if(isset($_GET['success-stok'])){?>
						<div class="alert alert-success">
							<p>Tambah Stok Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Tambah Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						<table class="table table-bordered" style="width:30%;">
							<thead>
									<tr style="background:#DFF0D8;color:#333;width:20%;">
										<td>Tanggal Awal</td>
										<td>:</td>
										<td><? echo $tgl_awal; ?></td>
										
									</tr>
									<tr style="background:#DFF0D8;color:#333;width:20%;">
										<td>Tanggal Akhir </td>
										<td>:</td>
										<td><? echo $tgl_akhir; ?></td>
										
									</tr>
								</thead>
						</table>
						
						<table class="table table-bordered" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<td>No.</td>
										<td>Nama Barang</td>
										<td>Bulan</td>
										<td>Tahun</td>
										<td>Penjualan</td>
										<td>Prediksi Penjualan</td>
										<td>Eror</td>
										<td>Eror positif</td>
										<td>Eror Pangkat</td>
										<td>Eror Persen</td>
									</tr>
								</thead>
								<tbody>
								<?php 
									// $hasil = $lihat -> hasilperamalan();
									$no=1;
									foreach($hasil as $isi){
								?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['bulan'];?></td>
										<td><?php echo $isi['tahun'];?></td>
										<td><?php echo $isi['penjualan'];?></td>
										<td><?php echo $isi['prediksi_penjualan'];?></td>
										<td><?php echo $isi['eror'];?></td>
										<td> <?php echo $isi['erorpositif'];?></td>
										<td> <?php echo $isi['erorpangkat'];?></td>
										<td> <?php echo $isi['erorpersen'];?></td>
										
									
									</tr>
								<?php $no++; }?>
								</tbody>
							</table>
						<div class="clearfix" style="padding-top:16%;"></div>
				  </div>
              </div>
          </section>
      </section>
	
