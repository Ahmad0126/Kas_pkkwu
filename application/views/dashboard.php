<div class="container-fluid">
	<div class="row column_title">
		<div class="col-md-12">
			<div class="page_title d-flex justify-content-between align-items-center">
				<h2>Dashboard</h2>
				<button class="btn btn-primary" data-toggle="modal" type="button" data-target="#tambahModal">Buat laporan</button>
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
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Buat Laporan</h5>
				<button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"><i class="settings-close ti-close"></i></button>
			</div>
			<form action="<?= base_url('home/laporan')?>" method="post">
				<div class="modal-body">
                    <div class="form-floating mb-3">
                        <label for="pp">Yang dilaporkan</label>
                        <select name="pp" id="pp" class="form-control">
                            <option value="pm">Pemasukan</option>
                            <option value="pn">Pengeluaran</option>
                            <option value="pp">Pemasukan dan Pengeluaran</option>
                        </select>
					</div>
                    <div class="form-floating mb-3">
						<label for="floatingPassword">Tanggal Awal</label>
                        <input type="date" name="tanggal1" class="form-control" placeholder="Tanggal Awal" id="floatingPassword">
					</div>
					<div class="form-floating mb-3">
						<label for="floatingSelect">Tanggal Akhir</label>
						<input type="date" name="tanggal2" class="form-control" placeholder="Tanggal Akhir" id="floatingSelect">
					</div>
                    <div class="form-floating mb-3">
                        <label for="floatingInput">Username</label>
                        <select name="user" class="form-control" id="">
                            <option value="semua">Semua User</option>
                            <?php foreach($user as $fer){ ?>
                                <option value="<?= $fer->username ?>"><?= $fer->nama ?></option>
                            <?php } ?>
                        </select>
                    </div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary m-2">Buat</button>
				</div>
			</form>
		</div>
	</div>
</div>
