<div class="container-fluid">
	<div class="row column_title">
		<div class="col-md-12">
			<div class="page_title">
				<h2>Data User</h2>
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
					<i class="fa fa-plus text-dark fw-bold">
						Tambah User
					</i>
				</a>
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-md">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title fw-bold" id="exampleModalLabel">Tambah User</h5>
							</div>
							<form action="<?= base_url('user/simpan') ?>" method="post">
								<div class="modal-body mx-3">
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label fw-bold text-dark">Nama</label>
										<input type="text" class="form-control" placeholder="Nama" name="nama" Required>
									</div>
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label fw-bold text-dark">Username</label>
										<input type="text" class="form-control" placeholder="Username" name="username"
											Required>
									</div>
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label fw-bold text-dark">Password</label>
										<input type="password" class="form-control" placeholder="Password"
											name="password" Required>
									</div>
									<div class="row mb-3">
										<label class="col-sm-2 col-form-label fw-bold text-dark">Level</label>
										<select name="level" class="form-control">
											<option value="Admin">Admin</option>
											<option value="User">User</option>
										</select>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" class="btn btn-primary">Simpan</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="table_section padding_infor_info">
					<div class="table-responsive-sm">
						<table class="table">
							<thead>
								<tr>
									<th>No</th>
									<th>Username</th>
									<th>Nama</th>
									<th>Level</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; foreach ($user as $key) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $key->username ?></td>
									<td><?= $key->nama ?></td>
									<td><?= $key->level ?></td>
									<td>
										<a href="<?php echo site_url('user/delete_data/'.$key->id_user); ?>"
											onclick="return confirm('Apakah anda yakin menghapus data ini?')"
											class="btn btn-sm btn-danger m-2"><i class="fa fa-trash"></i>
										</a>
										<a class="btn btn-sm btn-warning m-2" data-toggle="modal"
											data-target="#edit<?= $key->id_user?>">
											<i class="fa fa-pencil-square-o"></i>
										</a>
										<div class="modal fade" id="edit<?= $key->id_user?>" tabindex="-1"
											aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-md">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title fw-bold" id="exampleModalLabel">Perbarui
															Nama User</h5>
													</div>
													<form action="<?= base_url('user/update') ?>" method="post">
														<input type="hidden" name="id_user" value="<?= $key->id_user?>">
														<div class="modal-body mx-3">
															<div class="row mb-3">
																<label
																	class="col-sm-2 col-form-label fw-bold">Nama</label>
																<input type="text" class="form-control"
																	value="<?= $key->nama?>" name="nama">
															</div>
															<div class="row mb-3">
																<label
																	class="col-sm-2 col-form-label fw-bold">Username</label>
																<input type="text" class="form-control"
																	value="<?= $key->username ?>" name="username"
																	readonly>
															</div>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-secondary"
																data-dismiss="modal">Close</button>
															<button type="submit"
																class="btn btn-primary">Simpan</button>
														</div>
													</form>
												</div>
											</div>
										</div>
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
