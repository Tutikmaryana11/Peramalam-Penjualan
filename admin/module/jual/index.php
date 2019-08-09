 <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <?php 
		  $id = $_SESSION['admin']['id_member'];
		  $hasil = $lihat -> member_edit($id);
      ?>
  
      <section id="main-content">
          <section class="wrapper">
              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Keranjang Penjualan</h3>
						<?php if(isset($_GET['success'])){?>
						<div class="alert alert-success">
							<p>Edit Data Berhasil !</p>
						</div>
						<?php }?>
						<?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
						<?php }?>
						

						
						<div class="col-sm-5">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h4><i class="fa fa-search"></i> Cari Barang</h4>
								</div>

								<div class="panel-body">
									<form method="POST">
										<input type="text" class="form-control" name="cari" placeholder="Masukan Nama Barang / Kode Barang">
									</form>
								</div>
							</div>

						</div>
						<div class="col-sm-6">
							<div class="panel panel-info">
								<div class="panel-heading">
									<h4><i class="fa fa-list"></i> Hasil Pencarian</h4>
								</div>
								<div class="panel-body">
									<?php $cari = $_POST['cari']; 
									$hasil = $lihat -> barang_cari($cari);
									$a = $lihat -> id_penjualan();  ?>
									<table class="table table-stripped">
										<tr>
											<td><h4><?php echo $hasil['id_barang'];?></h4></td>
											<td><h4><?php echo $hasil['nama_barang'];?></h4></td>
											<td><h4><?php echo $hasil['harga_jual'];?></h4></td>
											<form method="POST" action="fungsi/tambah/tambah.php?detail_jual=detail_jual">
												<input type="hidden" value="<?php echo $a['id_penjualan']+1;?>" name="no_nota">
												<input type="hidden" value="<?php echo $hasil['id_barang'];?>" name="id">
												<input type="hidden" value="<?php echo $_SESSION['admin']['id_member'];?>" name="kasir">
												<input type="hidden" value="<?php echo date("j F Y, G:i");?>" name="tgl">
												<td><button class="btn btn-success">Taruh</button></td>
											</form>
										</tr>
									</table>
								</div>
							</div>
						</div>

						<div class="col-sm-12">
							<div class="panel panel-primary">
								<div class="panel-heading">
									<h4><i class="fa fa-shopping-cart"></i> Kasir
									
									</h4>
								</div>

								<div class="panel-body">
									<div id="keranjang">
										<table class="table table-bordered">
											<tr>
												<td><b>Tanggal</b></td>
												<td><input type="text" readonly="readonly" class="form-control" value="<?php echo date("j F Y, G:i");?>" name="tgl"></td>
											</tr>
											
										</table>
										<table class="table table-bordered" id="example1">
											<thead>
												<tr>
													<td> No</td>
													<td> No Nota</td>
													<td> No Detail</td>

													<td> Nama Barang</td>
													<td style="width:10%;"> Jumlah</td>
													<td style="width:20%;"> Total</td>
													<td> Kasir</td>
													<td> Aksi</td>
												</tr>
											</thead>
											<tbody>
												<?php $no=1; $hasil = $lihat -> detail_penjualan();?>
												<?php foreach($hasil as $isi){;?>
												<tr>
													<td><?php echo $no;?></td>
													<td><input type="text" name="no_nota" value="<?php echo $isi['no_nota'];?>"></td>
													<td><input type="text" name="id_detail" value="<?php echo $isi['id_detail'];?>"></td>
													<td><?php echo $isi['nama_barang'];?></td>
													<td>
														<form method="POST" action="fungsi/edit/edit.php?detail_jual=detail_jual">

															<input type="number" name="jumlah" value="<?php echo $isi['jumlah'];?>" class="form-control">
															<input type="hidden" name="id" value="<?php echo $isi['id_detail'];?>" class="form-control">
															<input type="hidden" name="id_barang" value="<?php echo $isi['id_barang'];?>" class="form-control">
													</td>
													<td>Rp.<?php echo number_format($isi['total']);?>,-</td>
													<td><?php echo $isi['nm_member'];?></td>
													<td>
															<button class="btn btn-warning">Update</button>
														</form>
														<a href="fungsi/hapus/hapus.php?detail_jual=detail_jual&id=<?php echo $isi['id_detail'];?>&brg=<?php echo $isi['id_barang'];?>
														&jml=<?php echo $isi['jumlah']; ?>">
															<button class="btn btn-danger">x</button>
														</a>
													</td>
												</tr>
												<?php $no++; }?>
											</tbody>
									</table>
									<br/>
									<?php $hasil = $lihat -> jumlah(); ?>
									<div id="kasirnya">
										<table class="table table-stripped">
											<?php
												$total = $_POST['total'];
												$bayar = $_POST['bayar'];
												
												$hitung = $bayar - $total;
												$no_nota=$a['id_penjualan']
											?>
											<form method="POST" action="index.php?page=jual#kasirnya">
												<tr>
													<td>Total Semua  </td>
													<td><input type="text" class="form-control" name="total" value="<?php echo $hasil['bayar'];?>"></td>
												
													<td>Bayar  </td>
													<td><input type="number" class="form-control" name="bayar" value="<?php echo $bayar;?>"></td>
													<td><button class="btn btn-success"><i class="fa fa-shopping-cart"></i> Bayar</button></td>
												</tr>
											</form>
											<tr>
												<td>Kembali</td>
												<td><?php 
													if($hitung<0){
														echo "<script>alert('Mohon Maaf Jumlah Bayar Kurang');history.go(-1);</script>";
													}
													else{


												?>
													<input type="text" class="form-control" value="<?php echo $hitung;?>"></td>
												<?php } ?>
												<td></td>
												<td>
													<a href="print.php?nm_member=<?php echo $_SESSION['admin']['nm_member'];?>
													&bayar=<?php echo $bayar;?>&kembali=<?php echo $hitung;?>" target="_blank">
													<!-- <button class="btn btn-default">
														<i class="fa fa-print"></i> Print Untuk Bukti Pembayaran
													</button></a> -->

												</td>

											</tr>
										</table>
										<form method="POST" action="print.php">

<input type="hidden" class="form-control" name="total" value="<?php echo $hasil['bayar'];?>">
              <input type="hidden" class="form-control" name="bayar" value="<?php echo $bayar;?>">
              <input type="hidden" class="form-control" name="kembali" value="<?php echo $hitung;?>">

               <i class="fa fa-print"></i> <input type="submit" name="submit" value="Print Pembayaran" class="btn btn-default">
										<br/>
										<br/>
									</div>
								</div>

							</div>

						</div>

				  </div>
              </div>
             
          </section>
         
      </section>

      </form>
	

