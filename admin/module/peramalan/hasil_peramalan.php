
      <div class="bg-shadow" style="background:rgba(0,0,0,0.3);z-index:99999;position:fixed;width:100%;height:6000px;"></div>
      <section id="main-content">
          <section class="wrapper">

              <div class="row">
                  <div class="col-lg-12 main-chart">
						<h3>Data Peramalan</h3>
						
							
							<div class="modal-view">
							<table class="table table-bordered" id="example1">
								<thead>
									<tr style="background:#DFF0D8;color:#333;">
										<td>No.</td>
										<td>Bulan</td>
										<td>Tahun</td>
										<td>Penjualan</td>
										<td>Peramalan</td>
										<td>Eror</td>
										<td>|Error|</td>
										<td>|Error|^</td>
										<td>% Eror</td>
									</tr>
								</thead>
								<tbody>
								<?php 
   									$link = mysqli_connect("localhost", "root", "","db_toko");
								
									$result =  "SELECT month(tanggal_input) as bulan , year(tanggal_input) as tahun , sum(total) as total from nota GROUP by bulan, tahun";
									$a=mysqli_query($link,$result);
									// tampilkan query
								$no=1;

									// echo $result;
									while ($isi=mysqli_fetch_row($a))
									{
									  
								?>
									<tr>
										<td><?php echo $no;?></td>
										<td><?php echo $isi[0];?></td>
										<td><?php echo $isi[1];?></td>
										<td>Rp.<?php echo number_format($isi[2]);?>,-</td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>

									</tr>
								<?php $no++; }?>
								</tbody>
							</table>
							<?php 
							$c = $lihat -> jml();
							?>
							<!-- <h3> Pengeluaran Uang ( Modal ) : Rp.<?php echo number_format($c['byr']);?>,-</h3> -->
							<div class="clearfix" style="padding-top:27%;"></div>
						</div>
					
					</div>
				  </div>
              </div>
          </section>
      </section>
	
