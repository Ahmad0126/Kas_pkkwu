<div class="container-fluid">
	<div class="row column_title">
		<div class="col-md-12">
			<div class="page_title">
				<h2>Data Transaksi</h2>
			</div>
		</div>
	</div>
	<div id="menghilang">
		<?= $this->session->flashdata('alert') ?>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="white_shd full margin_bottom_30">
				<a class="btn btn-outline-primary m-2" data-toggle="modal" data-target="#exampleModal">
					<i class="fa fa-plus text-dark fw-bold fs-sans">
						Tambah Transaksi
					</i>
				</a>
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title fw-bold" id="exampleModalLabel">Tambah Transaksi</h5>
							</div>
							<form action="<?= base_url("transaksi/simpan"); ?>" method="post">
                            <div class="modal-body mx-3">
								<div class="row mb-3">
									<label class="col-sm-2 col-form-label">Keterangan</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="keterangan" required>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-sm-2 col-form-label">Nominal</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" name="nominal" required>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-sm-2 col-form-label">Tanggal</label>
									<div class="col-sm-10">
										<input type="Date" class="form-control" name="tanggal" required>
									</div>
								</div>
								<div class="row mb-3">
									<label class="col-sm-2 col-form-label">Jenis Transaksi</label>
									<div class="col-sm-10">
										<select name="jenis_transaksi" class="form-select mb-3 form-control"
											aria-label="Default select example">
											<option value="pemasukan">Pemasukan</option>
											<option value="pengeluaran">Pengeluaran</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
                            </div>
							</form>
						</div>
					</div>
				</div>
				<div class="table_section padding_infor_info">
					<div class="table-responsive-sm">
						<table class="table table-striped table-bordered" id="example" style="width:100%">
							<thead>
								<tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Pemasukan</th>
                                    <th scope="col">Pengeluaran</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no=1; foreach($transaksi as $tp) { ?>
								<tr>
									<th scope="row"><?= $no++; ?></th>
									<td><?= $tp['keterangan']; ?></td>
									<td aligh="right">Rp.
										<?php
                                    if($tp['jenis_transaksi'] == 'pemasukan'){
                                    echo number_format($tp['nominal'],2);
                                    }else{
                                    echo '-';
                                        }
                                    ?>
									</td>
									<td aligh="right">Rp.<?php 
                                        if ($tp['jenis_transaksi'] == 'pengeluaran'){
                                            echo number_format($tp['nominal'],2);
                                        }else{
                                            echo '-';
                                        }
                                    ?></td>
									<td><?= $tp['username']; ?></td>
									<td><?= $tp['tanggal']; ?></td>
									<td>
										<a href="<?= base_url('transaksi/hapus/'.$tp['id_transaksi']) ?>"
											class="btn btn-square btn-danger m-2">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
