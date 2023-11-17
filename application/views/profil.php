<div class="modal fade" id="alertmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<?= $this->session->flashdata('alert'); ?>
	</div>
</div>
<div class="container-fluid">
	<div class="row column_title">
		<div class="col-md-12">
			<div class="page_title">
				<h2>Profile</h2>
			</div>
		</div>
	</div>
	<!-- row -->
	<div class="row column1">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="white_shd full margin_bottom_30">
				<div class="full graph_head">
					<div class="heading1 margin_0">
						<h2>User profile</h2>
					</div>
				</div>
				<div class="full price_table padding_infor_info">
					<div class="row">
						<!-- user profile section -->
						<!-- profile image -->
						<div class="col-lg-12">
							<div class="full dis_flex center_text">
								<div class="profile_img"><img width="180" class="rounded-circle"
										src="<?= base_url('assets/pluto/') ?>images/layout_img/user_img.jpg" alt="#" /></div>
								<div class="profile_contant">
									<div class="contact_inner">
										<h3><?= $user['nama'] ?> <button class="btn btn-primary" data-toggle="modal" type="button" data-target="#nama"><i class="fa fa-pencil"></i></button></h3>
										<p><strong>About: </strong><?= $user['level'] ?></p>
                                        <a data-toggle="modal" type="button" data-target="#password">Ganti Password <i class="fa fa-pencil"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
		<!-- end row -->
	</div>
</div>
<div class="modal fade" id="nama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Edit Nama</h5>
				<button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"><i class="settings-close ti-close"></i></button>
			</div>
			<form action="<?= base_url('home/edit/nama')?>" method="post">
				<div class="modal-body">
					<div class="form-floating mb-3">
						<label for="floatingSelect">Nama</label>
						<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?= $user['nama'] ?>">
						<input type="hidden" name="id_user" class="form-control" placeholder="Nama" value="<?= $user['id_user'] ?>">
					</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary m-2">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal fade" id="password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ganti Password</h5>
				<button class="btn-close" type="button" data-dismiss="modal" aria-label="Close"><i class="settings-close ti-close"></i></button>
			</div>
			<form action="<?= base_url('home/edit/password')?>" method="post">
				<div class="modal-body">
				<div class="form-floating mb-3">
					<label for="floatingInput">Password Lama</label>
					<input required type="password" name="pl" class="form-control <?= $this->session->flashdata('password') != null?'is-invalid':'' ?>" value="<?= $this->session->flashdata('pl_val') != null? $this->session->flashdata('pl_val') : '' ?>" placeholder="Masukkan Password Lama" id="floatingInput">
					<div class="invalid-feedback"><?= $this->session->flashdata('password') ?></div>
				</div>
				<div class="form-floating mb-3">
					<label for="f2">Password Baru</label>
					<input required type="password" name="password" class="form-control" value="<?= $this->session->flashdata('pp_val') != null? $this->session->flashdata('pp_val') : '' ?>" placeholder="Masukkan Password Baru" id="f2">
				</div>
				<div class="form-floating mb-3">
					<label for="floatingPassword">Konfirmasi Password Baru</label>
					<input required type="password" name="pk" class="form-control <?= $this->session->flashdata('konf') != null?'is-invalid':'' ?>" value="<?= $this->session->flashdata('pk_val') != null? $this->session->flashdata('pk_val') : '' ?>" placeholder="Masukkan Kembali Password Baru" id="floatingPassword">
					<div class="invalid-feedback"><?= $this->session->flashdata('konf') ?></div>
				</div>
				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary m-2">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>