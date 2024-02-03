<!-- Footer -->
<footer class="sticky-footer">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Kelompok PKL YP | Penggajian 2022</span>
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



<script type="text/javascript">
	document.getElementById('tanggal_masuk').addEventListener('change', async function () {
		updateHonor();
	});

	document.getElementById('status').addEventListener('change', async function () {
		updateHonor();
	});

	async function updateHonor() {
		let tanggalMasuk = new Date(document.getElementById('tanggal_masuk').value);
		let currentDate = new Date();

		let differenceInYears = currentDate.getFullYear() - tanggalMasuk.getFullYear();
		if (currentDate.getMonth() < tanggalMasuk.getMonth() ||
			(currentDate.getMonth() === tanggalMasuk.getMonth() && currentDate.getDate() < tanggalMasuk.getDate())) {
			differenceInYears--;
		}
		let honor = document.getElementById('honor');
		let status = document.getElementById('status').value;

		if (differenceInYears >= 5 && status === 'Guru') {
			honor.value = 100000;
		}
		else if (differenceInYears == 4 && status === 'Guru') {
			honor.value = 90000;
		}
		else if (differenceInYears == 3 && status === 'Guru') {
			honor.value = 85000;
		}
		else if (differenceInYears == 2 && status === 'Guru') {
			honor.value = 80000;
		}
		else if (differenceInYears <= 1 && status === 'Guru') {
			honor.value = 75000;
		} else {
			honor.value = 6000;
		}
	}
</script>


<!-- <script type="text/javascript">
	document.getElementById('tanggal_masuk').addEventListener('change', async function () {
		let tanggalMasuk = new Date(this.value);
		let currentDate = new Date();

		let differenceInYears = currentDate.getFullYear() - tanggalMasuk.getFullYear();
		if (currentDate.getMonth() < tanggalMasuk.getMonth() ||
			(currentDate.getMonth() === tanggalMasuk.getMonth() && currentDate.getDate() < tanggalMasuk.getDate())) {
			differenceInYears--;
		}

		let honor = document.getElementById('honor');
		if (differenceInYears > 5) {
			honor.value = '10000';
		} else {
			honor.value = '5777'; // Reset the value if not more than 5 years
		}
	});
</script> -->



<script type="text/javascript">
	// Pie Chart Example
	var ctx = document.getElementById("myPieChart");
	var myPieChart = new Chart(ctx, {
		type: 'doughnut',
		data: {
			labels: ["Guru", "Staff"],
			datasets: [{
				data: [<?php echo $this->db->query("select status from data_pegawai where status='Guru';")->num_rows(); ?>,
					<?php echo $this->db->query("select status from data_pegawai where status='Staff'")->num_rows(); ?>,
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