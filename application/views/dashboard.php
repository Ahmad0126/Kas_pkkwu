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
		<div class="col-md-6 col-lg-3">
			<div class="full counter_section margin_bottom_30">
				<div class="couter_icon">
					<div>
						<i class="fa fa-user yellow_color"></i>
					</div>
				</div>
				<div class="counter_no">
					<div>
						<p class="total_no">2500</p>
						<p class="head_couter">Welcome</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="full counter_section margin_bottom_30">
				<div class="couter_icon">
					<div>
						<i class="fa fa-clock-o blue1_color"></i>
					</div>
				</div>
				<div class="counter_no">
					<div>
						<p class="total_no">123.50</p>
						<p class="head_couter">Average Time</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="full counter_section margin_bottom_30">
				<div class="couter_icon">
					<div>
						<i class="fa fa-cloud-download green_color"></i>
					</div>
				</div>
				<div class="counter_no">
					<div>
						<p class="total_no">1,805</p>
						<p class="head_couter">Collections</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="full counter_section margin_bottom_30">
				<div class="couter_icon">
					<div>
						<i class="fa fa-comments-o red_color"></i>
					</div>
				</div>
				<div class="counter_no">
					<div>
						<p class="total_no">54</p>
						<p class="head_couter">Comments</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row column1 social_media_section">
		<div class="col-md-6 col-lg-3">
			<div class="full socile_icons fb margin_bottom_30">
				<div class="social_icon">
					<i class="fa fa-facebook"></i>
				</div>
				<div class="social_cont">
					<ul>
						<li>
							<span><strong>35k</strong></span>
							<span>Friends</span>
						</li>
						<li>
							<span><strong>128</strong></span>
							<span>Feeds</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="full socile_icons tw margin_bottom_30">
				<div class="social_icon">
					<i class="fa fa-twitter"></i>
				</div>
				<div class="social_cont">
					<ul>
						<li>
							<span><strong>584k</strong></span>
							<span>Followers</span>
						</li>
						<li>
							<span><strong>978</strong></span>
							<span>Tweets</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="full socile_icons linked margin_bottom_30">
				<div class="social_icon">
					<i class="fa fa-linkedin"></i>
				</div>
				<div class="social_cont">
					<ul>
						<li>
							<span><strong>758+</strong></span>
							<span>Contacts</span>
						</li>
						<li>
							<span><strong>365</strong></span>
							<span>Feeds</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-md-6 col-lg-3">
			<div class="full socile_icons google_p margin_bottom_30">
				<div class="social_icon">
					<i class="fa fa-google-plus"></i>
				</div>
				<div class="social_cont">
					<ul>
						<li>
							<span><strong>450</strong></span>
							<span>Followers</span>
						</li>
						<li>
							<span><strong>57</strong></span>
							<span>Circles</span>
						</li>
					</ul>
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
