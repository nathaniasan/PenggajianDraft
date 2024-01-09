<!-- Footer -->
<footer class="sticky-footer">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Abid Taufiqur Rohman | Penggajian 2022</span>
		</div>
	</div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->

<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/Chart.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/demo/datatables-demo.js"></script>
<link href="<?php echo base_url(); ?>assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- get honor value -->
<!-- <script type="text/javascript">
	$(document).ready(function () {
		$('#tanggal_masuk').on('blur', async function () {
			var tanggal_masuk = $(this).val();

			$.ajax({
				url: '<?php echo base_url('admin/data_pegawai/getHonor') ?>',
				type: 'POST',
				data: { 'tanggal_masuk': tanggal_masuk },
				dataType: 'json',
				success: function (response) {
					console.log(response); // Check AJAX response in the console
					$('#honor').val(response.honor);
				},
				error: function (xhr, status, error) {
					console.error(xhr.responseText); // Log any AJAX errors
				}
			});
		});
	});
</script> -->
<script type="text/javascript">
	document.getElementById('tanggal_masuk').addEventListener('change', async function () {
		let tanggalMasuk = new Date(this.value);
		let currentDate = new Date();

		let differenceInYears = currentDate.getFullYear() - tanggalMasuk.getFullYear();
		if (currentDate.getMonth() < tanggalMasuk.getMonth() ||
			(currentDate.getMonth() === tanggalMasuk.getMonth() && currentDate.getDate() < tanggalMasuk.getDate())) {
			differenceInYears--;
		}

		let honorField = document.getElementById('honor');
		if (differenceInYears > 5) {
			honorField.value = '10000';
		} else {
			honorField.value = '5777'; // Reset the value if not more than 5 years
		}
	});
</script>
<script type="text/javascript">
	// Pie Chart Example
	var ctx = document.getElementById("myPieChart");
	var myPieChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ["Karyawan Tetap", "Karyawan Tidak Tetap"],
			datasets: [{
				data: [<?php echo $this->db->query("select status from data_pegawai where status='Karyawan Tetap'")->num_rows(); ?>,
					<?php echo $this->db->query("select status from data_pegawai where status='Karyawan Tidak Tetap'")->num_rows(); ?>,
				],
				backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#dddfeb'],
				hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dddfeb'],
				hoverBorderColor: "rgba(234, 236, 244, 1)",
			}],
		},
		options: {
			maintainAspectRatio: false,
			tooltips: {
				backgroundColor: "rgb(255,255,255)",
				bodyFontColor: "#858796",
				borderColor: '#dddfeb',
				borderWidth: 1,
				xPadding: 15,
				yPadding: 15,
				displayColors: false,
				caretPadding: 10,
			},
			legend: {
				display: false
			},
			cutoutPercentage: 80,
		},
	});
</script>

<script type="text/javascript">
	// Area Chart Example
	var ctx = document.getElementById("myBarChart");
	var myBarChart = new Chart(ctx, {
		type: 'bar',
		data: {
			labels: ["Laki - Laki", "Perempuan"],
			datasets: [{
				label: "Berdasarkan Jenis Kelamin",
				backgroundColor: 'rgb(23, 125, 255)',
				borderColor: 'rgb(23, 125, 255)',
				data: [<?php echo $this->db->query("select jenis_kelamin from data_pegawai where jenis_kelamin='Laki-laki'")->num_rows(); ?>,
					<?php echo $this->db->query("select jenis_kelamin from data_pegawai where jenis_kelamin='Perempuan'")->num_rows(); ?>,
				],
			}],
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			scales: {
				yAxes: [{
					ticks: {
						beginAtZero: true
					}
				}]
			},
		}
	});
</script>

</body>

</html>