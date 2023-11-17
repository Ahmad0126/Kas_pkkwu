<!-- jQuery -->
<script src="<?= base_url('assets/pluto/') ?>js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url('assets/pluto/') ?>js/popper.min.js"></script>
<script src="<?= base_url('assets/pluto/') ?>js/bootstrap.min.js"></script>

<!-- wow animation -->
<script src="<?= base_url('assets/pluto/') ?>js/animate.js"></script>
<!-- select country -->
<script src="<?= base_url('assets/pluto/') ?>js/bootstrap-select.js"></script>
<!-- owl carousel -->
<script src="<?= base_url('assets/pluto/') ?>js/owl.carousel.js"></script>
<!-- chart js -->
<script src="<?= base_url('assets/pluto/') ?>js/Chart.min.js"></script>
<script src="<?= base_url('assets/pluto/') ?>js/Chart.bundle.min.js"></script>
<script src="<?= base_url('assets/pluto/') ?>js/utils.js"></script>
<script src="<?= base_url('assets/pluto/') ?>js/analyser.js"></script>
<!-- nice scrollbar -->
<script src="<?= base_url('assets/pluto/') ?>js/perfect-scrollbar.min.js"></script>
<script>
	var ps = new PerfectScrollbar('#sidebar');
	$('#menghilang').delay('slow').slideDown('slow').delay(4000).slideUp(600);
	<?php if($this->session->flashdata('alert') != null){ ?>
    $('#alertmodal').modal("show");
	<?php } ?>
</script>

<!-- custom js -->
<script src="<?= base_url('assets/pluto/') ?>js/custom.js"></script>
<script src="<?= base_url('assets/pluto/') ?>js/chart_custom_style1.js"></script>
