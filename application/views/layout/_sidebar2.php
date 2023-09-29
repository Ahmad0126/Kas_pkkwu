<nav id="sidebar">
	<div class="sidebar_blog_1">
		<div class="sidebar-header">
			<div class="logo_section">
				<a href="<?= base_url() ?>"><img class="logo_icon img-responsive" src="<?= base_url('assets/pluto/') ?>images/logo/logo_icon.png"
						alt="#" /></a>
			</div>
		</div>
		<div class="sidebar_user_info">
			<div class="icon_setting"></div>
			<div class="user_profle_side">
				<div class="user_img"><img class="img-responsive" src="<?= base_url('assets/pluto/') ?>images/layout_img/user_img.jpg" alt="#" /></div>
				<div class="user_info">
					<h6><?= $this->session->userdata('nama') ?></h6>
					<p><span class="online_animation"></span> <?= $this->session->userdata('level') ?></p>
				</div>
			</div>
		</div>
	</div>
	<div class="sidebar_blog_2">
		<h4>General</h4>
		<ul class="list-unstyled components">
			<li class="active">
				<a href="<?= base_url() ?>"><i class="fa fa-home yellow_color"></i> <span>Dashboard</span></a>
			</li>
			<li>
				<a href="<?= base_url('transaksi') ?>"><i class="fa fa-money green_color"></i> <span>Transaksi</span></a>
			</li>
			<?php if($this->session->userdata('level') == 'Admin'){ ?>
			<li>
				<a href="<?= base_url('user') ?>"><i class="fa fa-user orange_color"></i> <span>User</span></a>
			</li>
			<?php } ?>
		</ul>
	</div>
</nav>
