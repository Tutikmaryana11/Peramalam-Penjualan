 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <div class="bg-shadow" style="background:rgba(0,0,0,0.3);z-index:99999;position:fixed;width:100%;height:6000px;"></div>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>HASIL PERAMALAN</h3>
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
						<table>
							<tr>
								<td><a  href="index.php?page=peramalan"><button id="tombol-simpan" class="btn btn-primary"><i class="fa fa-plus"></i> TAMBAH PERAMALAN</button></a></td>
							</tr>
						</table>
						<br/>
						<!-- view barang -->	
						<div class="modal-view">
							<table class="table table-bordered" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<td>No.</td>
										<td>Nama Barang</td>
										<td>Tanggal Awal</td>
										<td>Tanggal Akhir</td>
										<td>Pergerakan</td>
										<td>MSE</td>
										<td>MAD</td>
										<td>MAPE</td>
										<td>Hasil Peramalan</td>
										<td>Aksi</td>
									</tr>
								</thead>
								<tbody>
								<?php 
									$hasil = $lihat -> hasilperamalan();
									$no=1;
									foreach($hasil as $isi){
								?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi['nama_barang'];?></td>
										<td><?php echo $isi['tgl_awal'];?></td>
										<td><?php echo $isi['tgl_akhir'];?></td>
										<td><?php echo $isi['pergerakan'];?></td>
										<td><?php echo $isi['mse'];?></td>
										<td><?php echo $isi['mad'];?></td>
										<td> <?php echo $isi['mape'];?></td>
										<td> <?php echo $isi['hasil_peramalan'];?></td>
										
										<td>
											
											
											<a href="index.php?page=hasil_peramalan/details&id_peramalan=<?php echo $isi['id_peramalan']?>&tgl_awal=<?php echo $isi['tgl_awal']?>&tgl_akhir=<?php echo $isi['tgl_akhir'];?>"><button class="btn btn-primary">Details</button></a>
											
										</td>
									</tr>
								<?php $no++; }?>
								</tbody>
							</table>
							
					<!-- end view barang -->
					<!-- tambah barang MODALS-->
					
						<!-- end tambah barang -->
					</div>
				  </div>
              </div>
          </section>
      </section>
	
