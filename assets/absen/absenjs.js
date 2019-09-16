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
			var x = document.getElementsByClassName("alertabsen");
			x[0].innerHTML = "Presensi Berhasil";
		} else if (data.message === 'errorsatu') {
			var x = document.getElementsByClassName("alertabsen");
			x[0].innerHTML = "Anda Sudah Absensi";
		} else if (data.message === 'errordua') {
			var x = document.getElementsByClassName("alertabsen");
			x[0].innerHTML = "Anda Belum Melakukan Absensi Datang";
		} else if (data.message === 'errortiga') {
			var x = document.getElementsByClassName("alertabsen");
			x[0].innerHTML = "Jam Absen Sudah Lewat";
		} else {
			var x = document.getElementsByClassName("alertabsen");
			x[0].innerHTML = "Data Anda Belum Terdaftar";
		}
	});

	function show_product() {
		$.ajax({
			url: link + 'Absen/get_product',
			type: 'GET',
			async: true,
			dataType: 'json',
			success: function (data) {
				var html = '';
				var count = 1;
				var i;
				for (i = 0; i < data.length; i++) {
					html += '<tr>' +
						'<td>' + count++ + '</td>' +
						'<td>' + data[i].nama_pegawai + '</td>' +
						'<td>' + data[i].tanggal_masuk + '</td>' +
						'<td>' + data[i].jam_masuk + '</td>' +
						'<td>' + data[i].jam_keluar + '</td>' +
						'</tr>';
				}
				$('.show_product').html(html);
			}
		});

		$.ajax({
			type: 'get',
			url: link + 'Absen/get_total',
			dataType: 'json',
			success: function (html) {
				$('#totalabsen').html(html);
			}

		});

		$.ajax({
			type: 'get',
			url: link + 'Absen/get_absen',
			dataType: 'json',
			success: function (html) {
				$('#absen').html(html);
			}

		});
	}
});

window.setTimeout("waktu()", 1000);

function waktu() {
	var waktu = new Date();
	setTimeout("waktu()", 1000);
	document.getElementById("jam").innerHTML = waktu.getHours();
	document.getElementById("menit").innerHTML = waktu.getMinutes();
	document.getElementById("detik").innerHTML = waktu.getSeconds();
}
