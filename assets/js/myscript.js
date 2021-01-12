const flashData = $(".flash-data").data("flashdata");
const errorData = $(".error-data").data("error");

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
		title: "Data Berhasil " + flashData,
	});
} else if (errorData) {
	Toast.fire({
		icon: "error",
		title: errorData,
	});
}

$(".tombol-hapus").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Are you sure?",
		text: "You won't be able to revert this!",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, delete it!",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(".tombol-logout").on("click", function (e) {
	e.preventDefault();
	const href = $(this).attr("href");

	Swal.fire({
		title: "Are you sure?",
		text: "",
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: "Yes, Logout!",
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	});
});

$(document).ready(function () {
	// membatasi jumlah inputan
	var maxGroup = $("#jml").val();
	var batas = maxGroup - 1;
	var x = 1;

	//melakukan proses multiple input
	$("#tambahfield").click(function () {
		// if($('body').find('#fieldtambah').length < maxGroup){
		if (x < maxGroup) {
			x++;
			var fieldHTML =
				'<div class="form-group" id="fieldawal">' +
				$("#fieldtambah").html() +
				"</div>";
			$("body").find("#fieldawal:last").after(fieldHTML);
		} else {
			// alert('Hanya Boleh '+batas+' kali menambahkan.');
			$.toast({
				heading: "Warning",
				text: "Hanya Boleh " + batas + " kali menambahkan.",
				showHideTransition: "plain",
				icon: "warning",
				hideAfter: 3000,
				position: "bottom-right",
				bgColor: "#FFC017",
			});
		}
	});

	//remove fields group
	$("body").on("click", "#hapusfield", function () {
		x--;
		$(this).parents("#fieldawal").remove();
	});
});

$(document).ready(function () {
	// membatasi jumlah inputan
	var maxGroupbarang = $("#jmlbarang").val();
	var jenis = $("#jenis").val();

	var base_url = baseurl();

	$("#tambahjurusan").click(function () {
		var looping = parseInt($("#jmlbarang1").val()) + 1;
		var record = $("#jumrecord").val();

		if (looping <= maxGroupbarang && record != maxGroupbarang) {
			$("#jmlbarang1").val(looping);
			$("#jumrecord").val(parseInt(record) + 1);

			var indexPlus = parseInt($("#jmlbarangplus").val());
			var indexMinus = parseInt($("#jmlbarangminus").val());

			for (let i = looping; i <= looping; i++) {
				if (i != looping) continue;
				indexMinus = i;
				$("#jmlbarangminus").val(indexMinus);
				i = ++indexPlus;
				$("#jmlbarangplus").val(i);

				var copy =
					'<div class="row" id="copybarang1"><div class="form-group col-md-11 col-xs-11 col-11"><input type="text" name="nm_jurusan[]" class="form-control" id="nm_jurusan' + i + '" placeholder="Masukkan Nama Jurusan" required></div><div class="col-md-1 col-xs-1 col-1"><button type="button" id="hapusjurusan' + i + '" class="btn btn-danger"><i class="fa fa-minus"></i> </button></div></div>';
				$("#sectionadd").append(copy);

				$("#hapusjurusan" + i).click(function () {
					var subTotal = $("#sub_total" + i).val();
					var totHarga = $("#total_harga").val();
					if (totHarga != undefined) {
						var totalHarga = totHarga.replace("Rp. ", "");

						if (subTotal == "" || subTotal == undefined) {
							subTotal = 0;
						}

						var selisih = parseInt(totalHarga) - parseInt(subTotal);
						$("#total_harga").val("Rp. " + selisih.toString());
					} else {
						$("#jumrecord").val(parseInt($("#jumrecord").val()) - 1);
					}

					$("#jmlbarang1").val(parseInt($("#jmlbarang1").val()) - 1);
					$("#jmlbarangminus").val(parseInt($("#jmlbarangminus").val()) - 1);
					$(this).parents("#copybarang1").remove();
				});

				// i = indexMinus;
			}
		} else {
			// alert('Hanya Boleh '+batasbarang+' kali menambahkan.');
			Toast.fire({
				icon: "error",
				title: "Tidak Bisa Menambah Lagi.",
			});
		}
	});

	$("#tambahtranskrip").click(function () {
		var looping = parseInt($("#jmlbarang1").val()) + 1;
		var record = $("#jumrecord").val();

		if (looping <= maxGroupbarang && record != maxGroupbarang) {
			$("#jmlbarang1").val(looping);
			$("#jumrecord").val(parseInt(record) + 1);

			var indexPlus = parseInt($("#jmlbarangplus").val());
			var indexMinus = parseInt($("#jmlbarangminus").val());

			for (let i = looping; i <= looping; i++) {
				if (i != looping) continue;
				indexMinus = i;
				$("#jmlbarangminus").val(indexMinus);
				i = ++indexPlus;
				$("#jmlbarangplus").val(i);

				var copy =
					'<div class="row" id="copybarang1"><div class="form-group col-xl-4 col-xs-6 col-6"><select name="nomor_mahasiswa[]" id="nomor_mahasiswa' + i + '" class="form-control select2mahasiswa' + i + '" required></select></div><div class="form-group col-xl-4 col-xs-6 col-6"><select name="kd_matakuliah[]" id="kd_matakuliah' + i + '" class="form-control select2matakuliah' + i + '" required></select></div><div class="form-group col-xl-2 col-xs-10 col-10"><select name="mutu_matakuliah[]" class="form-control select2semester' + i + '" id="mutu_matakuliah' + i + '" required><option value="">Mutu Mata Kuliah</option><option value="A">A</option><option value="B">B</option><option value="C">C</option><option value="D">D</option><option value="E">E</option></select></div><div class="col-xl-2 col-xs-2 col-2"><button type="button" id="hapustranskrip' + i + '" class="btn btn-danger"><i class="fa fa-minus"></i> </button></div></div>';
				$("#sectionadd").append(copy);

				$('.select2semester' + i).select2();

				$(".select2mahasiswa" + i).select2({
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

				$(".select2mahasiswa" + i).on("select2:select", function (e) {
					var id = e.params.data.id;
					$("#kd_matakuliah" + i).val("").trigger('change');
				});

				$(".select2matakuliah" + i).select2({
					placeholder: "Masukkan Matakuliah",
					ajax: {
						url: base_url + "/matakuliah/get_matakuliah",
						type: "post",
						dataType: "json",
						delay: 100,
						data: function (params) {
							return {
								searchTerm: params.term, // search term
								nomor_mahasiswa: $('#nomor_mahasiswa' + i).val()
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

				$("#hapustranskrip" + i).click(function () {
					var subTotal = $("#sub_total" + i).val();
					var totHarga = $("#total_harga").val();
					if (totHarga != undefined) {
						var totalHarga = totHarga.replace("Rp. ", "");

						if (subTotal == "" || subTotal == undefined) {
							subTotal = 0;
						}

						var selisih = parseInt(totalHarga) - parseInt(subTotal);
						$("#total_harga").val("Rp. " + selisih.toString());
					} else {
						$("#jumrecord").val(parseInt($("#jumrecord").val()) - 1);
					}

					$("#jmlbarang1").val(parseInt($("#jmlbarang1").val()) - 1);
					$("#jmlbarangminus").val(parseInt($("#jmlbarangminus").val()) - 1);
					$(this).parents("#copybarang1").remove();
				});


			}
		} else {
			// alert('Hanya Boleh '+batasbarang+' kali menambahkan.');
			Toast.fire({
				icon: "error",
				title: "Tidak Bisa Menambah Lagi.",
			});
		}
	});

});
