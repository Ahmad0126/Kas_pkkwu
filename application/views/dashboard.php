<div class="container-fluid">
	<div class="row column_title">
		<div class="col-md-12">
			<div class="page_title">
				<h2>Dashboard</h2>
			</div>
		</div>
	</div>
	<div class="row column1">
		<div class="col-md-4 col-lg-4">
			<div class="full counter_section margin_bottom_30 background-masuk">
				<div class="counter_no">
					<div>
						<p class="total_no text-light">Rp. <?= number_format($this->transaksi_model->pemasukan_hari_ini());?></p>
						<p class="head_couter text-light">Pemasukan Hari Ini</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="full counter_section margin_bottom_30 background-masuk">
				<div class="counter_no">
					<div>
						<p class="total_no text-light">Rp. <?= number_format($this->transaksi_model->pemasukan_bulan_ini());?></p>
						<p class="head_couter text-light">Pemasukan Bulan Ini</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="full counter_section margin_bottom_30 background-masuk">
				<div class="counter_no">
					<div>
						<p class="total_no text-light"><?php 
							$pemasukan = "SELECT sum(nominal) as pemasukan FROM transaksi WHERE jenis_transaksi = 'Pemasukan' ORDER BY sum(nominal)";				
							$tmasuk = $this->db->query($pemasukan)->row_array(); 
						?>
						Rp. <?= number_format($tmasuk['pemasukan'],2); ?></p>
						<p class="head_couter text-light">Total Pemasukan</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row column1">
		<div class="col-md-4 col-lg-4">
			<div class="full counter_section margin_bottom_30 background-keluar">
				<div class="counter_no">
					<div>
						<p class="total_no text-light">Rp. <?= number_format($this->transaksi_model->pengeluaran_hari_ini());?></p>
						<p class="head_couter text-light">Pengeluaran Hari Ini</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="full counter_section margin_bottom_30 background-keluar">
				<div class="counter_no">
					<div>
						<p class="total_no text-light">Rp. <?= number_format($this->transaksi_model->pengeluaran_bulan_ini());?></p>
						<p class="head_couter text-light">Pengeluaran Bulan Ini</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-4 col-lg-4">
			<div class="full counter_section margin_bottom_30 background-keluar">
				<div class="counter_no">
					<div>
						<p class="total_no text-light"><?php 
							$pengeluaran = "SELECT sum(nominal) as pengeluaran FROM transaksi WHERE jenis_transaksi = 'Pengeluaran' ORDER BY sum(nominal)";
							$tkeluar = $this->db->query($pengeluaran)->row_array(); 
						?>
						Rp. <?= number_format($tkeluar['pengeluaran'],2); ?></p>
						<p class="head_couter text-light"><strong>Total Pengeluaran</strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row column1 social_media_section">
		<div class="col-md-4 col-lg-4 mx-auto">
			<div class="full counter_section margin_bottom_30 background-total">
				<div class="counter_no">
					<div>
						<p class="total_no text-dark fw-bold">
						<?php
						$pemasukan = $tmasuk['pemasukan'];
						$pengeluaran = $tkeluar['pengeluaran']; ?>
							Rp. <?= number_format($sisa = $pemasukan - $pengeluaran, 2); ?>
						</p>
						<p class="head_couter text-dark fw-bold"><strong>Total Saldo</strong></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row column3">
	</div>
</div>
