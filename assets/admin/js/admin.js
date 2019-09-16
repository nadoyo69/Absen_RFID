$(document).ready(function () {
	var link = 'http://192.168.100.6/absen/'
	show_product();
	Pusher.logToConsole = true;
	var pusher = new Pusher('daa8c8cd19c2dc18dbb2', {
		cluster: 'ap1',
		forceTLS: true
	});
	var channel = pusher.subscribe('my-channel');
	channel.bind('my-event', function (data) {
		if (data.message === 'success') {
			show_product();
		}
	});

	function show_product() {
		$.ajax({
			url: link + 'notifikasiizin',
			type: 'GET',
			async: true,
			dataType: 'json',
			success: function (data) {
				var html = '';
				var i;
				for (i = 0; i < data.length; i++) {
					html +=
						'<div class="d-flex no-block align-items-center p-10">' +
						'<span class="btn btn-success btn-circle"><i class="ti-user"></i></span>' +
						'<div class="m-l-10">' +
						'<h5>' + data[i].nama_pegawai + '</h5>' +
						'<h6> Jenis Surat "' + data[i].jenis + '"</h6>' +
						'<span>' + data[i].DTM + '</span>' +
						'</div>' +
						'</div>';
				}
				$('.notifikasi').html(html);
			}
		});

		$.ajax({
			type: 'get',
			url: link + 'totalnotif',
			dataType: 'json',
			success: function (html) {
				$('#totalnotif').html(html);
			}

		});

		$.ajax({
			type: 'get',
			url: link + 'Admin/get_totalabsen',
			dataType: 'json',
			success: function (html) {
				$('#totalabsen').html(html);
			}

		});

		$.ajax({
			type: 'get',
			url: link + 'Admin/get_GrafikAbsensi',
			dataType: 'json',
			success: function (data) {
				var tanggalmasuk = [];
				var totalmasuk = [];
				$(data).each(function (i) {
					tanggalmasuk.push(data[i].tanggal_masuk);
					totalmasuk.push(data[i].total);
				});

				var ctx = document.getElementById("mychart").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: tanggalmasuk,
						datasets: [{
							data: totalmasuk,
							label: "Data Login",
							borderColor: "#3e95cd",
							fill: false
						}],
					}
				});
			}
		});

		$.ajax({
			type: 'get',
			url: link + 'Admin/get_GrafikLogin',
			dataType: 'json',
			success: function (data) {
				var tanggallogin = [];
				var totallogin = [];
				$(data).each(function (i) {
					tanggallogin.push(data[i].tanggal_masuk);
					totallogin.push(data[i].totallogin);
				});

				var ctx = document.getElementById("mychartlogin").getContext('2d');
				var myChart = new Chart(ctx, {
					type: 'line',
					data: {
						labels: tanggallogin,
						datasets: [{
							data: totallogin,
							label: "Data Login",
							borderColor: "#3e95cd",
							fill: false
						}],
					}
				});
			}
		});
	}
});
