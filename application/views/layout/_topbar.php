<div class="topbar">
	<nav class="navbar navbar-expand-lg navbar-light">
		<div class="full">
			<button type="button" id="sidebarCollapse" class="sidebar_toggle "><i class="fa fa-bars"></i></button>
			<marquee style="margin-top: 20px; color: light; font-family: sans-serif;" class="logo_section d-none d-md-inline-block">
              <b class="text-light b">Selamat Datang <?= $this->session->userdata('nama');?> di Aplikasi Simple Kas dapatkan pengalaman Cepat Mudah Praktis dan efisien </b>
             </marquee>
			<div class="right_topbar">
				<div class="icon_info">
					<ul class="user_profile_dd">
						<li>
							<a class="dropdown-toggle" data-toggle="dropdown"><img class="img-responsive rounded-circle" src="<?= base_url('assets/pluto/') ?>images/layout_img/user_img.jpg" alt="#" />
								<span class="name_user"><?= $this->session->userdata('nama') ?></span>
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?= base_url('home/profil') ?>">My Profile</a>
								<a class="dropdown-item" href="<?= base_url('auth/logout') ?>">
									<span>Log Out</span> <i class="fa fa-sign-out"></i>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</nav>
</div>
