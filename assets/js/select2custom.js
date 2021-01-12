$(document).ready(function () {
	function convertToRupiah(angka) {
		var rupiah = "";
		var angkarev = angka.toString().split("").reverse().join("");
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
		return (
			"Rp. " +
			rupiah
			.split("", rupiah.length - 1)
			.reverse()
			.join("")
		);
	}

	function toast() {
		const flashData = $(".flash-data1").html();
		const errorData = $(".error-data1").html();

		const Toast = Swal.mixin({
			toast: true,
			position: "top-end",
			showConfirmButton: false,
			timer: 5000,
		});

		if (flashData == "Login" || flashData == "Logout") {
			Toast.fire({
				icon: "success",
				title: "Anda Berhasil " + flashData,
			});
		} else if (flashData) {
			Toast.fire({
				icon: "success",
				title: flashData,
			});
		} else if (errorData) {
			Toast.fire({
				icon: "error",
				title: errorData,
			});
		}
	}

	var base_url = baseurl();

	$(".select2jurusan").select2({
		placeholder: "Masukkan Jurusan",
		ajax: {
			url: base_url + "/jurusan/get_jurusan",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});

	$(".select2mahasiswa").select2({
		placeholder: "Masukkan Mahasiswa",
		ajax: {
			url: base_url + "/mahasiswa/get_mahasiswa",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});

	$(".select2mahasiswa").on("select2:select", function (e) {
		var id = e.params.data.id;
		$("#kd_matakuliah").val("").trigger('change');
	});

	$(".select2mahasiswas").select2({
		placeholder: "Masukkan Mahasiswa",
		ajax: {
			url: base_url + "/mahasiswa/get_mahasiswa_semester",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
					semester: $('#semester').val()
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});


	$(".select2matakuliah").select2({
		placeholder: "Masukkan Matakuliah",
		ajax: {
			url: base_url + "/matakuliah/get_matakuliah",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
					nomor_mahasiswa: $('#nomor_mahasiswa').val(),
				};
			},
			processResults: function (response) {
				if (response.length == 0) {
					$(".error-data1").html("Tidak Ada data Mata Kuliah Yang Cocok.");
					$(".flash-data1").html("");
					toast();
				} else {
					return {
						results: response,
					};
				}
			},
			cache: true,
		},
	});

	$(".select2matakuliahedit").select2({
		placeholder: "Masukkan Matakuliah",
		ajax: {
			url: base_url + "/matakuliah/get_matakuliah_edit",
			type: "post",
			dataType: "json",
			delay: 100,
			data: function (params) {
				return {
					searchTerm: params.term, // search term
					nomor_mahasiswa_edit: $('#nomor_mahasiswa_edit').val()
				};
			},
			processResults: function (response) {
				return {
					results: response,
				};
			},
			cache: true,
		},
	});
});
