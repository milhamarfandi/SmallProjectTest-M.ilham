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

	$("#bulan").hide();
	$("#jam").hide();
	$("#perbulan").hide();
	$("#pertahun").hide();

	var pathparts = location.pathname.split("/");
	// if (location.host == "188.166.212.76") {
	if (location.host == "localhost") {
		var base_url = location.origin + "/" + pathparts[1].trim("/"); // http://localhost/myproject/
	} else {
		var base_url = location.origin; //http://localhost/
	}

	//melakukan proses multiple input
	$("#tambahfieldbarang").click(function () {
		var looping = parseInt($("#jmlbarang1").val()) + 1;
		var record = $("#jumrecord").val();

		if (looping <= maxGroupbarang && record != maxGroupbarang) {
			$("#jmlbarang1").val(looping);
			$("#jumrecord").val(parseInt(record) + 1);

			var indexPlus = parseInt($("#jmlbarangplus").val());
			var indexMinus = parseInt($("#jmlbarangminus").val());
			var jenistransaksi = $('#jenistransaksi').val();
			console.log(jenistransaksi);

			for (let i = looping; i <= looping; i++) {
				if (i != looping) continue;
				indexMinus = i;
				$("#jmlbarangminus").val(indexMinus);
				console.log(i);
				i = ++indexPlus;
				$("#jmlbarangplus").val(i);

				var copy =
					'<div class="row mt-2" id="copybarang1"><div class="col-md-5"><select class="form-control select2barpembelian' +
					i +
					'" name="barang[]" id="barang1' +
					i +
					'" style="width: 100%;"><option selected="selected">Pilih Barang</option></select></div><div class="col-md-2"><input type="text" name="harga[]" id="harga' +
					i +
					'" class="form-control" placeholder="Harga" readonly></div><div class="col-md-1"><input type="text" onkeypress="return hanyaAngka(event)" min="0" max="100" name="qty[]" id="qty' +
					i +
					'" class="form-control cek-qty' +
					i +
					'" placeholder="Qty" readonly></div><div class="col-md-3"><input type="text" name="sub_total[]" id="sub_total' +
					i +
					'" class="form-control" placeholder="Sub Total" readonly></div><div class="col-md-1"><a href="javascript:void(0)" class="btn btn-danger" id="hapusfieldbarang' +
					i +
					'"> <i class="fa fa-minus"></i> </a></div></div>';
				$("#fieldawalbarang").append(copy);

				if (jenistransaksi == "penjualan") {
					$(".select2barpembelian" + i).select2({
						ajax: {
							url: base_url + "/admin/barang/get_json_pri",
							type: "post",
							dataType: "json",
							delay: 100,
							data: function (params) {
								console.log(params);
								return {
									searchTerm: params.term, // search term
									pilihan: $("#supplier1").val(),
									click: $("#barang").val(),
								};
							},
							processResults: function (response) {
								console.log(response);
								return {
									results: response,
								};
							},
							cache: true,
						},
					});
				} else {
					$(".select2barpembelian" + i).select2({
						ajax: {
							url: base_url + "/admin/barang/get_jsonpembelian",
							type: "post",
							dataType: "json",
							delay: 100,
							data: function (params) {
								console.log(params);
								return {
									searchTerm: params.term, // search term
									pilihan: $("#supplier1").val(),
									click: $("#barang").val(),
								};
							},
							processResults: function (response) {
								console.log(response);
								return {
									results: response,
								};
							},
							cache: true,
						},
					});
				}


				$(".select2barpembelian" + i).on("select2:select", function (e) {
					var hargaModal = e.params.data.harga_modal;
					var hargaJual = e.params.data.harga_jual;

					var id = e.params.data.id;

					var kdBarang = id.substr(0, 3);

					var stok = e.params.data.stok;
					var indexPlus = parseInt($("#jmlbarangplus").val());
					var record = $("#jumrecord").val();
					var ceklokasi = $("#ceklokasi").val();
					if (ceklokasi == null) {
						if (stok == 0) {
							Toast.fire({
								icon: "error",
								title: "Stok Barang Kosong",
							});

							$("#qty" + i).val(null);
							$("#qty" + i).attr("readonly", true);
							$("#harga" + i).val(null);
							$("#sub_total" + i).val(null);
						} else {
							if (kdBarang == "BPR") {
								$("#qty" + i).val(1);
								$("#qty" + i).attr("readonly", false);
								$('#harga' + i).attr('readonly', true);

								$("#harga" + i).val(hargaModal);
								$("#sub_total" + i).val(hargaModal);
							} else if (kdBarang == "BSC") {
								$('#qty' + i).val(1);
								$('#qty' + i).attr('readonly', false);
								$('#harga' + i).attr('readonly', false);

								$('#harga' + i).val("");
								$('#sub_total' + i).val(0);
							}
						}
					} else {
						if (kdBarang == "BPR") {
							$("#qty" + i).val(1);
							$("#qty" + i).attr("readonly", false);
							$('#harga' + i).attr('readonly', true);

							$("#harga" + i).val(hargaModal);
							$("#sub_total" + i).val(hargaModal);
						} else if (kdBarang == "BSC") {
							$('#qty' + i).val(1);
							$('#qty' + i).attr('readonly', false);
							$('#harga' + i).attr('readonly', false);

							$('#harga' + i).val("");
							$('#sub_total' + i).val(0);
						}

					}
					var subTotal = $("#sub_total").val();
					var data = [];
					var data1 = [];

					for (let j = 2; j <= indexPlus; j++) {
						var obj = {};
						obj = $("#sub_total" + j).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;
					for (var j = 0, len = data.length; j < len; j++) {
						myTotal += parseInt(data[j]);
					}
					for (var j = 0, len = data1.length; j < len; j++) {
						myTotal1 += parseInt(data1[j]);
					}

					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga = parseInt(myTotal) + parseInt(myTotal1);
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$(".select2barn" + i).select2({
					ajax: {
						url: base_url + "/admin/barang/get_json",
						type: "post",
						dataType: "json",
						delay: 100,
						data: function (params) {
							console.log(params);
							return {
								searchTerm: params.term, // search term
								pilihan: $("#supplier1").val(),
								click: $("#barang").val(),
							};
						},
						processResults: function (response) {
							console.log(response);
							return {
								results: response,
							};
						},
						cache: true,
					},
				});

				$(".select2barn" + i).on("select2:select", function (e) {
					var hargaModal = e.params.data.harga_modal;
					var hargaJual = e.params.data.harga_jual;
					var stok = e.params.data.stok;
					var indexPlus = parseInt($("#jmlbarangplus").val());
					var record = $("#jumrecord").val();
					var ceklokasi = $("#ceklokasi").val();
					if (ceklokasi == null) {
						if (stok == 0) {
							Toast.fire({
								icon: "error",
								title: "Stok Barang Kosong",
							});

							$("#qty" + i).val(null);
							$("#qty" + i).attr("readonly", true);
							$("#harga" + i).val(null);
							$("#sub_total" + i).val(null);
						} else {
							$("#qty" + i).val(1);
							$("#qty" + i).attr("readonly", false);
							if (jenis == "modal") {
								$("#harga" + i).val(hargaModal);
								$("#sub_total" + i).val(hargaModal);
							} else if (jenis == "jual") {
								$("#harga" + i).val(hargaJual);
								$("#sub_total" + i).val(hargaJual);
							}
						}
					} else {
						$("#qty" + i).val(1);
						$("#qty" + i).attr("readonly", false);
						if (jenis == "modal") {
							$("#harga" + i).val(hargaModal);
							$("#sub_total" + i).val(hargaModal);
						} else if (jenis == "jual") {
							$("#harga" + i).val(hargaJual);
							$("#sub_total" + i).val(hargaJual);
						}
					}
					var subTotal = $("#sub_total").val();
					var data = [];
					var data1 = [];

					for (let j = 2; j <= indexPlus; j++) {
						var obj = {};
						obj = $("#sub_total" + j).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;
					for (var j = 0, len = data.length; j < len; j++) {
						myTotal += parseInt(data[j]);
					}
					for (var j = 0, len = data1.length; j < len; j++) {
						myTotal1 += parseInt(data1[j]);
					}

					if (subTotal == "") {
						subTotal = 0;
					}

					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga = parseInt(myTotal) + parseInt(myTotal1);
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$(".cek-qty" + i).on("change", function () {
					var cek = $("#barang" + i).val();
					var cek1 = $("#barang1" + i).val();
					var aksi = $("#aksi").val();
					var ceklokasi = $("#ceklokasi").val();
					if (ceklokasi == null) {
						if (aksi == "penjualan") {
							if (cek1 != null) {
								var barang = $("#barang1" + i).val();
							} else {
								var barang = $("#barang" + i).val();
							}
							var qty = $("#qty" + i).val();
							if (cek != null || cek1 != null) {
								$.ajax({
									url: base_url + "/admin/barang/getBarangById",
									type: "post",
									dataType: "json",
									data: {
										id: barang,
										qty: qty,
										tabel: "primary",
									},
									success: function (result) {
										console.log(result);
										if (result.no == 0) {
											Toast.fire({
												icon: "error",
												title: "Stok Hanya Tersisa " + result.qty,
											});
											$("#qty" + i).val(null);
										}
									},
								});
							}
						} else {
							if (cek1 != null) {
								var barang = $("#barang1" + i).val();
							} else {
								var barang = $("#barang" + i).val();
							}
							var qty = $("#qty" + i).val();
							if (cek != null || cek1 != null) {
								$.ajax({
									url: base_url + "/admin/barang/getBarangById",
									type: "post",
									dataType: "json",
									data: {
										id: barang,
										qty: qty,
										tabel: "primary",
									},
									success: function (result) {
										console.log(result);
										if (result.no == 0) {
											Toast.fire({
												icon: "error",
												title: "Stok Hanya Tersisa " + result.qty,
											});
											$("#qty" + i).val(null);
											$("#sub_total" + i).val(null);
										}
									},
								});
							}
						}
					}
				});

				$("#harga" + i).keyup(function () {
					var harga = parseInt($("#harga" + i).val());
					var qty = $("#qty" + i).val();
					var total = harga * parseInt(qty);
					var indexPlus = parseInt($("#jmlbarangplus").val());
					var record = $("#jumrecord").val();
					if (!isNaN(total)) {
						$("#sub_total" + i).val(total);
					}

					var subTotal = $("#sub_total").val();

					var data = [];
					var data1 = [];

					if (qty == "") {
						$("#sub_total" + i).val(parseInt(0));
					}

					if ($("#harga" + i).val() == "") {
						$("#sub_total" + i).val(0)
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					var myTotal = 0;
					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;

					for (var a = 0, len = data.length; a < len; a++) {
						myTotal += parseInt(data[a]);
					}
					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());

					for (var a = 0, len = data1.length; a < len; a++) {
						myTotal1 += parseInt(data1[a]);
					}
					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga = parseInt(myTotal) + parseInt(myTotal1);
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$("#qty" + i).keyup(function () {
					var harga = parseInt($("#harga" + i).val());
					var qty = $("#qty" + i).val();
					var total = harga * parseInt(qty);
					var indexPlus = parseInt($("#jmlbarangplus").val());
					var record = $("#jumrecord").val();
					if (!isNaN(total)) {
						$("#sub_total" + i).val(total);
					}

					var subTotal = $("#sub_total").val();

					var data = [];
					var data1 = [];

					if (qty == "") {
						$("#sub_total" + i).val(parseInt(0));
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					var myTotal = 0;
					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;

					for (var a = 0, len = data.length; a < len; a++) {
						myTotal += parseInt(data[a]);
					}
					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());

					for (var a = 0, len = data1.length; a < len; a++) {
						myTotal1 += parseInt(data1[a]);
					}

					if (subTotal == "") {
						subTotal = 0;
					}

					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga = parseInt(myTotal) + parseInt(myTotal1);
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$("#hapusfieldbarang" + i).click(function () {
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

	$("body").on("click", "#deletefieldbarang", function () {
		x--;
		$(this).parents("#form-repeat").remove();
	});

	// membatasi jumlah inputan
	var maxGroupbarang = $("#jmlbarang").val();
	var jenis = $("#jenis").val();

	//melakukan proses multiple input
	$("#tambahfieldpenyewaan").click(function () {
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
				console.log(i);
				i = ++indexPlus;
				$("#jmlbarangplus").val(i);

				var d = new Date();
				var tahun = d.getFullYear();

				$("#bagianpenyewaan").append(
					'<div id="bagianpenyewaanhapus"><hr><div class="form-group"><label for="">Jenis Penyewaan</label><select name="jenis_penyewaan[]" id="jenis_penyewaan' +
					i +
					'" class="form-control"><option value="">Pilih Jenis Penyewaan</option><option value="jam">Jam</option><option value="bulan">Bulan</option></select></div><div class="form-group d-none" id="jam' +
					i +
					'"><label for="">Lama Penyewaan</label><input type="text" name="jam[]" id="jam1' +
					i +
					'" class="form-control" placeholder="Jam" onkeypress="return hanyaAngka(event)"></div><div class="form-group d-none" id="bulan' +
					i +
					'"><label for="">Lama Penyewaan</label><input type="text" name="bulan[]" id="blan1' +
					i +
					'" class="form-control" placeholder="Bulan" onkeypress="return hanyaAngka(event)"></div><div class="form-group"><label for="kd_supplier">Barang</label><div class="row" id="form-repeat"><div class="col-md-3"><select class="form-control select2barnpri' +
					i +
					'" name="barang[]" id="barang' +
					i +
					'" style="width: 100%;"><option selected="selected">Pilih Barang</option></select></div><div class="col-md-4"><input type="hidden" name="jenis" id="jenis" value="sewa"><input type="text" name="harga[]" class="form-control" id="harga' +
					i +
					'" placeholder="Harga" readonly></div><div class="col-md-1">' +
					'<input type="text" min="0" max="100" name="qty[]" class="form-control cek-qty' +
					i +
					'" id="qty' +
					i +
					'" placeholder="Qty" onkeypress="return hanyaAngka(event)" required></div><div class="col-md-4"><input type="text" name="sub_total[]" class="form-control" id="sub_total' +
					i +
					'" placeholder="Sub Total" readonly></div></div><div class="row mt-2"><div class="col-md-5"><label for="kd_supplier">Diskon</label><input type="text" name="diskon[]" class="form-control" id="diskon' + i + '" placeholder="Diskon" onkeypress="return hanyaAngka(event)"></div><div class="col-md-5"><label for="kd_supplier">Biaya Angkut</label><input type="text" name="biaya_angkut[]" class="form-control" id="biaya_angkut' + i + '" placeholder="Biaya Angkut" onkeypress="return hanyaAngka(event)"></div><div class="col-md-2"><label for="kd_supplier"></label><br><a href="javascript:void(0)" class="btn btn-danger mt-2" id="hapusfieldpenyewaan' +
					i +
					'"> <i class="fa fa-minus"></i> Hapus Barang</a></div></div></div>'
				);

				$(".cek-qty" + i).on("change", function () {
					var cek = $("#barang" + i).val();
					var cek1 = $("#barang1" + i).val();
					if (cek1 != null) {
						var barang = $("#barang1" + i).val();
					} else {
						var barang = $("#barang" + i).val();
					}
					var qty = $("#qty" + i).val();
					if (cek != null || cek1 != null) {
						$.ajax({
							url: base_url + "/admin/barang/getBarangById",
							type: "post",
							dataType: "json",
							data: {
								id: barang,
								qty: qty,
								tabel: "primary",
							},
							success: function (result) {
								console.log(result);
								if (result.no == 0) {
									Toast.fire({
										icon: "error",
										title: "Stok Hanya Tersisa " + result.qty,
									});
									$("#qty" + i).val(null);
								}
							},
						});
					}
				});

				$("#jenis_penyewaan" + i).change(function () {
					var jenisPenyewaan = $("#jenis_penyewaan" + i).val();
					if (jenisPenyewaan == "jam") {
						$("#jam" + i).removeClass("d-none");
						$("#bulan" + i).addClass("d-none");
					} else if (jenisPenyewaan == "bulan") {
						$("#jam" + i).addClass("d-none");
						$("#bulan" + i).removeClass("d-none");
					}
				});

				$(".select2barnpri" + i).select2({
					ajax: {
						url: base_url + "/admin/barang/get_json_pri",
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

				$(".select2barnpri" + i).on("select2:select", function (e) {
					var hargaSewaJam = e.params.data.harga_sewa_jam;
					var hargaSewaBulan = e.params.data.harga_sewa_bulan;
					var indexPlus = parseInt($("#jmlbarangplus").val());
					var id = e.params.data.id;
					var jenisPenyewaan = $("#jenis_penyewaan" + i).val();
					var jam = $("#jam1" + i).val();
					var bulan = $("#blan1" + i).val();

					var subTotall = $("#sub_total").val();
					var diskonn = $("#diskon").val();
					var biayaAngkut = $("#biaya_angkut").val();

					if (diskonn == "") {
						diskonn = 0;
					}

					if (biayaAngkut == "") {
						biayaAngkut = 0;
					}

					if (jenisPenyewaan == "jam") {
						$("#qty" + i).val(1);
						$("#qty" + i).attr("readonly", false);

						$("#harga" + i).val(hargaSewaJam);

						if (jam == "") {
							$("#sub_total" + i).val(hargaSewaJam);
						} else {
							$("#sub_total" + i).val(jam * hargaSewaJam);
						}
					} else if (jenisPenyewaan == "bulan") {
						$("#qty" + i).val(1);
						$("#qty" + i).attr("readonly", false);

						$("#harga" + i).val(hargaSewaBulan);

						if (bulan == "") {
							$("#sub_total" + i).val(hargaSewaBulan);
						} else {
							$("#sub_total" + i).val(bulan * hargaSewaBulan);
						}
					} else if (jenisPenyewaan == "") {
						Toast.fire({
							icon: "error",
							title: "Pilih Jenis Penyewaan Terlebih Dahulu !",
						});
						$("#barang").val(id);
					}

					var dataSubTotal = [];
					var dataDiskon = [];
					var dataBiayaAngkut = [];

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataSubTotal.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#diskon" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataDiskon.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#biaya_angkut" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataBiayaAngkut.push(obj);
					}

					var mySubTotal = 0;
					var myDiskon = 0;
					var myBiayaAngkut = 0;

					for (let i = 0; i < dataSubTotal.length; i++) {
						mySubTotal += parseInt(dataSubTotal[i]);
					}

					for (let i = 0; i < dataDiskon.length; i++) {
						myDiskon += parseInt(dataDiskon[i]);
					}

					for (let i = 0; i < dataBiayaAngkut.length; i++) {
						myBiayaAngkut += parseInt(dataBiayaAngkut[i]);
					}

					if (subTotall == "") {
						subTotall = 0;
					}

					var totalHarga =
						parseInt((mySubTotal) -
							parseInt(myDiskon) + parseInt(myBiayaAngkut)) +
						(parseInt(subTotall) - parseInt(diskonn) + parseInt(biayaAngkut));
					$("#total_harga").val("Rp. " + totalHarga.toString());

					$("#kdbarang").val(id);
				});

				$(".select2barn" + i).select2({
					ajax: {
						url: base_url + "/admin/barang/get_json",
						type: "post",
						dataType: "json",
						delay: 100,
						data: function (params) {
							console.log(params);
							return {
								searchTerm: params.term, // search term
								pilihan: $("#supplier1").val(),
								click: $("#barang").val(),
							};
						},
						processResults: function (response) {
							console.log(response);
							return {
								results: response,
							};
						},
						cache: true,
					},
				});

				$(".select2barn" + i).on("select2:select", function (e) {
					var hargaModal = e.params.data.harga_modal;
					var hargaJual = e.params.data.harga_jual;
					var maxGroupbarang = $("#jmlbarang").val();
					var record = $("#jumrecord").val();

					$("#qty" + i).val(1);
					$("#qty" + i).attr("readonly", false);
					if (jenis == "modal") {
						$("#harga" + i).val(hargaModal);
						$("#sub_total" + i).val(hargaModal);
					} else if (jenis == "jual") {
						$("#harga" + i).val(hargaJual);
						$("#sub_total" + i).val(hargaJual);
					}

					var subTotal = $("#sub_total").val();
					var data = [];
					var data1 = [];

					for (let j = 2; j <= maxGroupbarang; j++) {
						var obj = {};
						obj = $("#sub_total" + j).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;
					for (var j = 0, len = data.length; j < len; j++) {
						myTotal += parseInt(data[j]);
					}
					for (var j = 0, len = data1.length; j < len; j++) {
						myTotal1 += parseInt(data1[j]);
					}

					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga = parseInt(myTotal) + parseInt(myTotal1);
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$("#jenis_penyewaan" + i).change(function () {
					var jenis_penyewaan = $("#jenis_penyewaan" + i).val();
					var barang = $("#barang" + i).val();
					if (barang != "Pilih Barang") {
						$.ajax({
							url: base_url + "/admin/barang/getBarangById",
							type: "post",
							dataType: "json",
							data: {
								id: barang,
								tabel: "primary",
							},
							success: function (result) {
								if (jenis_penyewaan == "jam") {
									$("#jam1" + i).val("");
									var harga = result[0].harga_sewa_jam;

									$("#harga" + i).val(harga);
									$("#qty" + i).val("1");
									$("#sub_total" + i).val(
										$("#harga" + i).val() *
										$("#qty" + i).val() *
										$("#jam1" + i).val()
									);
								} else if (jenis_penyewaan == "bulan") {
									$("#blan1" + i).val("");
									var harga = result[0].harga_sewa_bulan;

									$("#harga" + i).val(harga);
									$("#qty" + i).val("1");
									$("#sub_total" + i).val(
										$("#harga" + i).val() *
										$("#qty" + i).val() *
										$("#blan1" + i).val()
									);
								}
							},
						});
					}
				});

				$("#jam1" + i).keyup(function () {
					var harga = parseInt($("#harga" + i).val());
					var jenis_penyewaan = $("#jenis_penyewaan" + i).val();
					var jam = $("#jam1" + i).val();
					var qty = $("#qty" + i).val();

					if (jenis_penyewaan == "jam") {
						var jam = $("#jam1" + i).val();
						var total = jam * harga * parseInt(qty);
					} else if (jenis_penyewaan == "bulan") {} else {
						var total = harga * parseInt(qty);
					}

					var record = $("#jumrecord").val();
					if (!isNaN(total)) {
						$("#sub_total" + i).val(total);
					}

					if ($("#sub_total" + i).val() == 0) {
						$("#diskon" + i).val("");
					}

					var diskon = $("#diskon").val();
					var biayaAngkut = $("#biaya_angkut").val();
					if (diskon == "" || diskon == undefined || diskon == null) {
						diskon = 0;
					}

					if (biayaAngkut == "" || biayaAngkut == undefined || biayaAngkut == null) {
						biayaAngkut = 0;
					}

					var subTotal = $("#sub_total").val();

					var data = [];
					var data1 = [];
					var dataDiskon = [];
					var dataBiayaAngkut = [];

					if (qty == "") {
						$("#sub_total" + i).val(parseInt(0));
					}

					if (qty != "" && harga != "") {
						subTotalBaru = jam * qty * harga - diskon;
						console.log(subTotalBaru);
						$("#sub_total" + i).val(subTotalBaru);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#diskon" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataDiskon.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#biaya_angkut" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataBiayaAngkut.push(obj);
					}

					var myTotal = 0;
					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;
					var myDiskon = 0;
					var myBiayaAngkut = 0;

					for (var a = 0, len = data.length; a < len; a++) {
						myTotal += parseInt(data[a]);
					}
					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());

					for (var a = 0, len = data1.length; a < len; a++) {
						myTotal1 += parseInt(data1[a]);
					}

					for (var a = 0, len = dataDiskon.length; a < len; a++) {
						myDiskon += parseInt(dataDiskon[a]);
					}

					for (var a = 0, len = dataBiayaAngkut.length; a < len; a++) {
						myBiayaAngkut += parseInt(dataBiayaAngkut[a]);
					}

					if (subTotal == "") {
						subTotal = 0;
					}

					var totalHarga =
						parseInt(myTotal) +
						parseInt(subTotal) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga =
						parseInt(myTotal) +
						parseInt(myTotal1) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$("#blan1" + i).keyup(function () {
					var harga = parseInt($("#harga" + i).val());
					var jenis_penyewaan = $("#jenis_penyewaan" + i).val();
					var bulan = $("#blan1" + i).val();
					var qty = $("#qty" + i).val();

					if (bulan == "") {
						bulan = 0;
					}

					if (jenis_penyewaan == "bulan") {
						var bulan = $("#blan1" + i).val();
						var total = bulan * harga * parseInt(qty);
					} else if (jenis_penyewaan == "bulan") {} else {
						var total = harga * parseInt(qty);
					}

					var record = $("#jumrecord").val();
					if (!isNaN(total)) {
						$("#sub_total" + i).val(total);
					}

					if ($("#sub_total" + i).val() == 0) {
						$("#diskon" + i).val("");
					}

					var diskon = $("#diskon").val();
					var biayaAngkut = $("#biaya_angkut").val();
					if (diskon == "" || diskon == undefined || diskon == null) {
						diskon = 0;
					}

					if (biayaAngkut == "" || biayaAngkut == undefined || biayaAngkut == null) {
						biayaAngkut = 0;
					}

					var subTotal = $("#sub_total").val();

					var data = [];
					var data1 = [];
					var dataDiskon = [];
					var dataBiayaAngkut = [];

					if (qty == "") {
						$("#sub_total" + i).val(parseInt(0));
					}

					if (qty != "" && harga != "") {
						subTotalBaru = bulan * qty * harga - diskon;
						console.log(subTotalBaru);
						$("#sub_total" + i).val(subTotalBaru);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#diskon" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataDiskon.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#biaya_angkut" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataBiayaAngkut.push(obj);
					}

					var myTotal = 0;
					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;
					var myDiskon = 0;
					var myBiayaAngkut = 0;

					for (var a = 0, len = data.length; a < len; a++) {
						myTotal += parseInt(data[a]);
					}
					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());

					for (var a = 0, len = data1.length; a < len; a++) {
						myTotal1 += parseInt(data1[a]);
					}

					for (var a = 0, len = dataDiskon.length; a < len; a++) {
						myDiskon += parseInt(dataDiskon[a]);
					}

					for (var a = 0, len = dataBiayaAngkut.length; a < len; a++) {
						myBiayaAngkut += parseInt(dataBiayaAngkut[a]);
					}

					if (subTotal == "") {
						subTotal = 0;
					}

					var totalHarga =
						parseInt(myTotal) +
						parseInt(subTotal) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga =
						parseInt(myTotal) +
						parseInt(myTotal1) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$("#qty" + i).keyup(function () {
					var harga = parseInt($("#harga" + i).val());
					var jenis_penyewaan = $("#jenis_penyewaan" + i).val();
					var qty = $("#qty" + i).val();
					var indexPlus = parseInt($("#jmlbarangplus").val());

					if (jenis_penyewaan == "jam") {
						var jam = $("#jam1" + i).val();
						var total = jam * harga * parseInt(qty);
					} else if (jenis_penyewaan == "bulan") {
						var bulan = $("#blan1" + i).val();
						var total = bulan * harga * parseInt(qty);
					} else {
						var total = harga * parseInt(qty);
					}

					var record = $("#jumrecord").val();
					if (!isNaN(total)) {
						$("#sub_total" + i).val(total);
					}

					var diskon = $("#diskon").val();
					var biayaAngkut = $("#biaya_angkut").val();
					if (diskon == "" || diskon == undefined || diskon == null) {
						diskon = 0;
					}

					if (biayaAngkut == "" || biayaAngkut == undefined || biayaAngkut == null) {
						biayaAngkut = 0;
					}

					var subTotal = $("#sub_total").val();

					var data = [];
					var data1 = [];
					var dataDiskon = [];
					var dataBiayaAngkut = [];

					if (qty == "") {
						$("#sub_total" + i).val(parseInt(0));
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#diskon" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataDiskon.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#biaya_angkut" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataBiayaAngkut.push(obj);
					}

					var myTotal = 0;
					for (let i = 1; i <= record; i++) {
						var obj = {};
						obj = $("#esub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data1.push(obj);
					}

					var myTotal = 0;
					var myTotal1 = 0;
					var myDiskon = 0;
					var myBiayaAngkut = 0;

					for (var a = 0, len = data.length; a < len; a++) {
						myTotal += parseInt(data[a]);
					}
					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());

					for (var a = 0, len = data1.length; a < len; a++) {
						myTotal1 += parseInt(data1[a]);
					}

					for (var a = 0, len = dataDiskon.length; a < len; a++) {
						myDiskon += parseInt(dataDiskon[a]);
					}

					for (var a = 0, len = dataBiayaAngkut.length; a < len; a++) {
						myBiayaAngkut += parseInt(dataBiayaAngkut[a]);
					}

					if (subTotal == "") {
						subTotal = 0;
					}

					var totalHarga =
						parseInt(myTotal) +
						parseInt(subTotal) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#total_harga").val("Rp. " + totalHarga.toString());
					var totalHarga =
						parseInt(myTotal) +
						parseInt(myTotal1) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#etotal_harga").val("Rp. " + totalHarga.toString());
				});

				$("#diskon" + i).keyup(function () {
					var subTotal = $("#sub_total").val();
					var indexPlus = parseInt($("#jmlbarangplus").val());
					var diskon = $("#diskon").val();
					var biayaAngkut = $("#biaya_angkut").val();

					if (parseInt(diskon) > parseInt(subTotal)) {
						Toast.fire({
							icon: "error",
							title: "Diskon Tidak Boleh Melebihi Sub Total",
						});
					}

					if (diskon == "" || diskon == undefined) {
						diskon = 0;
					}

					if (biayaAngkut == "" || biayaAngkut == undefined) {
						biayaAngkut = 0;
					}

					var dataSubTotal = [];
					var dataDiskon = [];
					var dataBiayaAngkut = [];

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataSubTotal.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#diskon" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataDiskon.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#biaya_angkut" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataBiayaAngkut.push(obj);
					}

					var mySubTotal = 0;
					var myDiskon = 0;
					var myBiayaAngkut = 0;

					for (var a = 0, len = dataSubTotal.length; a < len; a++) {
						mySubTotal += parseInt(dataSubTotal[a]);
					}

					for (var a = 0, len = dataDiskon.length; a < len; a++) {
						myDiskon += parseInt(dataDiskon[a]);
					}

					for (var a = 0, len = dataBiayaAngkut.length; a < len; a++) {
						myBiayaAngkut += parseInt(dataBiayaAngkut[a]);
					}

					if (subTotal == "") {
						subTotal = 0;
					}

					var hargaSetelahDiskon =
						parseInt(subTotal) +
						parseInt(mySubTotal) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#total_harga").val("Rp. " + hargaSetelahDiskon.toString());
				});

				$("#biaya_angkut" + i).keyup(function () {
					var subTotal = $("#sub_total").val();
					var indexPlus = parseInt($("#jmlbarangplus").val());
					var diskon = $("#diskon").val();
					var biayaAngkut = $("#biaya_angkut").val();

					if (parseInt(diskon) > parseInt(subTotal)) {
						Toast.fire({
							icon: "error",
							title: "Diskon Tidak Boleh Melebihi Sub Total",
						});
					}

					if (diskon == "" || diskon == undefined) {
						diskon = 0;
					}

					if (biayaAngkut == "" || biayaAngkut == undefined) {
						biayaAngkut = 0;
					}

					var dataSubTotal = [];
					var dataDiskon = [];
					var dataBiayaAngkut = [];

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataSubTotal.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#diskon" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataDiskon.push(obj);
					}

					for (let i = 2; i <= indexPlus; i++) {
						var obj = {};
						obj = $("#biaya_angkut" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						dataBiayaAngkut.push(obj);
					}

					var mySubTotal = 0;
					var myDiskon = 0;
					var myBiayaAngkut = 0;

					for (var a = 0, len = dataSubTotal.length; a < len; a++) {
						mySubTotal += parseInt(dataSubTotal[a]);
					}

					for (var a = 0, len = dataDiskon.length; a < len; a++) {
						myDiskon += parseInt(dataDiskon[a]);
					}

					for (var a = 0, len = dataBiayaAngkut.length; a < len; a++) {
						myBiayaAngkut += parseInt(dataBiayaAngkut[a]);
					}

					if (subTotal == "") {
						subTotal = 0;
					}

					var hargaSetelahDiskon =
						parseInt(subTotal) +
						parseInt(mySubTotal) -
						(parseInt(myDiskon) + parseInt(diskon)) + (parseInt(myBiayaAngkut) + parseInt(biayaAngkut));
					$("#total_harga").val("Rp. " + hargaSetelahDiskon.toString());
				});

				$("body").on("click", "#hapusfieldpenyewaan" + i, function () {
					var subTotal = $("#sub_total" + i).val();
					var totHarga = $("#total_harga").val();
					var totalHarga = totHarga.replace("Rp. ", "");

					if (subTotal == "" || subTotal == undefined) {
						subTotal = 0;
					}

					var selisih = parseInt(totalHarga) - parseInt(subTotal);
					console.log(selisih);
					$("#total_harga").val("Rp. " + selisih.toString());
					$("#jmlbarang1").val(parseInt($("#jmlbarang1").val()) - 1);
					// $(this).parents("#copybarang").remove();
					$(this).parents("#bagianpenyewaanhapus").remove();
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

	//remove fields group

	$("body").on("click", "#deletefieldbarang", function () {
		x--;
		$(this).parents("#form-repeat").remove();
	});

	// membatasi jumlah inputan
	var maxGroupbarang = $("#jmlbarang").val();
	var maxGroupservice = $("#jmlservice").val();
	var batasbarang = maxGroupbarang - 1;

	var x = 1;

	//melakukan proses multiple input
	$("#tambahfieldbarangsec").click(function () {
		var looping = parseInt($("#jmlbarang1").val()) + 1;
		var record = $("#jumrecord").val();

		if (looping <= maxGroupbarang && record != maxGroupbarang) {
			$("#jmlbarang1").val(looping);
			$("#jumrecord").val(parseInt(record) + 1);

			for (let i = looping; i <= looping; i++) {
				if (i != looping) continue;

				var copy =
					'<div id="maintenance" class="mt-2"><div class="row mb-2"><div class="col-md-12"><select name="jenis_maintenance[]" id="jenis_maintenance' +
					i +
					'" class="form-control" required><option value="">Pilih Jenis Maintenance</option><option value="secondary">Secondary</option><option value="service">Service</option><option value="lain-lain">Lain-lain</option></select></div></div><div class="row mb-2 d-none" id="section_service' +
					i +
					'"><div class="col-md-4" id="sectionbar' +
					i +
					'"><select class="form-control select2barsecondary' +
					i +
					'" id="barangsec' +
					i +
					'" name="barang_sec[]" style="width: 100%;"><option value="" selected="selected">Pilih Barang Secondary</option></select></div><div class="col-md-4 d-none" id="sectionser' +
					i +
					'"><input type="text" min="0" max="100" name="service[]" id="service' +
					i +
					'" class="form-control" placeholder="Service"></div><div class="col-md-3"><input type="text" min="0" max="100" name="harga[]" id="harga' +
					i +
					'" class="form-control" placeholder="Harga" onkeypress="return hanyaAngka(event)" required readonly></div><div class="col-md-2"><input type="text" min="0" max="100" name="qty[]" id="qty' +
					i +
					'" class="form-control qty-maintenance' + i + '" placeholder="Qty" readonly onkeypress="return hanyaAngka(event)" required></div><div class="col-md-3"><input type="text" min="0" max="100" name="sub_total[]" id="sub_total' +
					i +
					'" class="form-control" placeholder="Sub Total" readonly></div></div><div class="row"><div class="col-md-11"><input type="text" min="0" max="100" name="keterangan[]" id="keterangan' +
					i +
					'" class="form-control" placeholder="Keterangan"></div><div class="col-md-1"><a href="javascript:void(0)" class="btn btn-danger" id="hapusfieldbarangsec"> <i class="fa fa-minus"></i> </a></div></div></div>';
				$("#fieldawalbarangsec").append(copy);
				$(".select2barsecondary" + i).select2({
					placeholder: "Pilih Barang Secondary",
					ajax: {
						url: base_url + "/admin/barang/get_json_secondary",
						type: "post",
						dataType: "json",
						delay: 100,
						data: function (params) {
							console.log(params);
							return {
								searchTerm: params.term, // search term
							};
						},
						processResults: function (response) {
							console.log(response);
							return {
								results: response,
							};
						},
						cache: true,
					},
				});

				$(".select2barsecondary" + i).on("select2:select", function (e) {
					var barlam = $("#barangsec_a").val();
					var bar = $("#barangsec" + i).val();
					if (barlam == bar) {
						Toast.fire({
							icon: "error",
							title: "Barang Tidak Boleh Sama !",
						});
						$("#harga" + i).val(null);
						$("#qty" + i).val(null);
						$("#qty" + i).attr("readonly", true);
						$("#qty" + i).attr("required", true);
						$("#sub_total" + i).val(null);
					} else {
						var hargaModal = e.params.data.harga_modal;
						var hargaJual = e.params.data.harga_jual;
						var stok = e.params.data.stok;
						var maxGroupbarang = $("#jmlbarang").val();
						var record = $("#jumrecord").val();
						if (stok == 0) {
							Toast.fire({
								icon: "error",
								title: "Stok Barang Kosong",
							});
							$("#qty" + i).val(null);
							$("#qty" + i).attr("readonly", true);
							$("#harga" + i).val(null);
							$("#sub_total" + i).val(null);
						} else {
							$("#qty" + i).val(1);
							$("#qty" + i).attr("readonly", false);
							$("#harga" + i).val(hargaModal);
							$("#sub_total" + i).val(hargaModal);
						}
					}
					var subTotal = $("#sub_total").val();
					var data = [];

					for (let j = 2; j <= maxGroupbarang; j++) {
						var obj = {};
						obj = $("#sub_total" + j).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					var myTotal = 0;
					for (var j = 0, len = data.length; j < len; j++) {
						myTotal += parseInt(data[j]);
					}

					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());
				});

				$("#qty" + i).on("change", function () {
					var barang = $("#barangsec" + i).val();

					var qty = $("#qty" + i).val();
					$.ajax({
						url: base_url + "/admin/barang/getQtyBarangSec",
						type: "post",
						dataType: "json",
						data: {
							id: barang,
							qty: qty,
							tabel: "secondary",
						},
						success: function (result) {
							if (result.no == 0) {
								Toast.fire({
									icon: "error",
									title: "Stok Hanya Tersisa " + result.qty,
								});
								$("#qty" + i).val(null);
								var hargaModal = $("#harga" + i).val();
								$("#sub_total" + i).val(0);
							}
						},
					});
				});

				$("#qty" + i).keyup(function () {
					var harga = parseInt($("#harga" + i).val());
					var qty = $("#qty" + i).val();
					var total = harga * parseInt(qty);
					var record = $("#jumrecord").val();
					if (!isNaN(total)) {
						$("#sub_total" + i).val(total);
					}

					var subTotal = $("#sub_total").val();

					var data = [];

					if (qty == "") {
						$("#sub_total" + i).val(parseInt(0));
					}

					for (let i = 2; i <= maxGroupbarang; i++) {
						var obj = {};
						obj = $("#sub_total" + i).val();
						if (obj == undefined || obj == "") {
							obj = 0;
						}
						data.push(obj);
					}

					var myTotal = 0;

					for (var a = 0, len = data.length; a < len; a++) {
						myTotal += parseInt(data[a]);
					}
					var totalHarga = parseInt(myTotal) + parseInt(subTotal);
					$("#total_harga").val("Rp. " + totalHarga.toString());
				});

				$("#jenis_maintenance" + i).change(function () {
					var selected_option = $("#jenis_maintenance" + i).val();
					if (selected_option == "secondary") {
						$("#section_service" + i).removeClass("d-none");
						$("#sectionbar" + i).removeClass("d-none");
						$("#sectionser" + i).addClass("d-none");
						$("#barangsec" + i)
							.val(null)
							.trigger("change");
						$("#service" + i).val("");
						$("#harga" + i).attr("readonly", true);
						$("#harga" + i).val("");
						$("#qty" + i).val("");
						$("#sub_total" + i).val("");
					} else if (selected_option == "service") {
						$("#section_service" + i).removeClass("d-none");
						$("#sectionbar" + i).addClass("d-none");
						$("#sectionser" + i).removeClass("d-none");
						$("#barangsec" + i)
							.val(null)
							.trigger("change");
						$("#service" + i).val("");
						$("#harga" + i).val("");
						$("#qty" + i).val("");
						$("#sub_total" + i).val("");
					} else if (selected_option == "lain-lain") {
						$("#section_service" + i).removeClass("d-none");
						$("#sectionbar" + i).addClass("d-none");
						$("#sectionser" + i).removeClass("d-none");
						$("#barangsec" + i)
							.val(null)
							.trigger("change");
						$("#service" + i).val("");
						$("#harga" + i).val("");
						$("#qty" + i).val("");
						$("#sub_total" + i).val("");
					} else {
						$("#section_service" + i).addClass("d-none");
						$("#sectionbar" + i).addClass("d-none");
						$("#sectionser" + i).addClass("d-none");
						$("#barangsec" + i)
							.val(null)
							.trigger("change");
						$("#service" + i).val("");
						$("#harga" + i).val("");
						$("#qty" + i).val("");
						$("#sub_total" + i).val("");
					}
				});

				$("#service" + i).keyup(function () {
					$("#qty" + i).val(1);
					$("#harga" + i).attr("readonly", false);
					$("#qty" + i).attr("readonly", true);
				});
				$("#harga" + i).keyup(function () {
					var validasiAngka = /^[0-9]+$/;
					var qty = $("#qty" + i).val();
					var harga = $("#harga" + i).val();
					var total = qty * harga;
					if (harga.match(validasiAngka)) {
						$("#sub_total" + i).val(total);
					} else {
						$("#sub_total" + i).val(0);
					}
				});

				$("#keterangan" + i).keyup(function () {
					var validasiAngka = /^[0-9]+$/;
					var harga = $("#harga" + i).val();
					if (!harga.match(validasiAngka)) {
						$("#harga" + i).val("Harus Berupa Angka");
					}
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

	//remove fields group
	$("body").on("click", "#hapusfieldbarangsec", function () {
		$("#jmlbarang1").val(parseInt($("#jmlbarang1").val()) - 1);
		$(this).parents("#maintenance").remove();
	});
	$("body").on("click", "#deletefieldbarang", function () {
		$(this).parents("#form-repeat").remove();
	});
	$("body").on("click", "#deletefieldbarangsec", function () {
		$(this).parents("#maintenance").remove();
	});
});

$(document).ready(function () {
	var record = $("#jumrecord").val();
	for (let i = 1; i <= record; i++) {
		$("#ebarang" + i).on("select2:select", function (e) {
			var harga = e.params.data.harga;
			var maxGroupbarang = $("#jmlbarang").val();
			$("#eqty" + i).val(1);
			$("#eqty" + i).attr("readonly", false);
			$("#eharga" + i).val(harga);
			$("#esub_total" + i).val(harga);

			var subTotal = $("#sub_total").val();
			var data = [];
			var data1 = [];

			for (let j = 1; j <= record; j++) {
				var obj = {};
				obj = $("#esub_total" + j).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data.push(obj);
			}
			for (let i = 2; i <= maxGroupbarang; i++) {
				var obj = {};
				obj = $("#sub_total" + i).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data1.push(obj);
			}

			var myTotal = 0;
			var myTotal1 = 0;
			for (var j = 0, len = data.length; j < len; j++) {
				myTotal += parseInt(data[j]);
			}
			for (var j = 0, len = data1.length; j < len; j++) {
				myTotal1 += parseInt(data1[j]);
			}
			if (!isNaN(myTotal1)) {
				var totalHarga = parseInt(myTotal);
				$("#etotal_harga").val("Rp. " + totalHarga.toString());
			}
			var totalHarga = parseInt(myTotal + myTotal1);
			console.log(totalHarga);
			$("#etotal_harga").val("Rp. " + totalHarga.toString());
			// var totalHarga = parseInt(myTotal) + parseInt(subTotal);
		});

		$("#eqty" + i).keyup(function () {
			var harga = parseInt($("#eharga" + i).val());
			var qty = $("#eqty" + i).val();
			var total = harga * parseInt(qty);
			var maxGroupbarang = $("#jmlbarang").val();
			if (!isNaN(total)) {
				$("#esub_total" + i).val(total);
			}

			var subTotal = $("#sub_total").val();

			var data = [];
			var data1 = [];

			if (qty == "") {
				$("#esub_total" + i).val(parseInt(0));
			}
			if (qty == "") {
				$("#sub_total" + i).val(parseInt(0));
			}

			for (let i = 1; i <= record; i++) {
				var obj = {};
				obj = $("#esub_total" + i).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data.push(obj);
			}

			for (let i = 2; i <= maxGroupbarang; i++) {
				var obj = {};
				obj = $("#sub_total" + i).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data1.push(obj);
			}

			var myTotal = 0;
			var myTotal1 = 0;

			for (var a = 0, len = data.length; a < len; a++) {
				myTotal += parseInt(data[a]);
			}
			for (var a = 0, len = data1.length; a < len; a++) {
				myTotal1 += parseInt(data1[a]);
			}
			if (!isNaN(myTotal1)) {
				var totalHarga = parseInt(myTotal);
				$("#etotal_harga").val("Rp. " + totalHarga.toString());
			}
			var totalHarga = parseInt(myTotal + myTotal1);
			console.log(totalHarga);
			$("#etotal_harga").val("Rp. " + totalHarga.toString());
		});
	}
});
$(document).ready(function () {
	var pathparts = location.pathname.split("/");
	// if (location.host == "188.166.212.76") {
	if (location.host == "localhost") {
		var base_url = location.origin + "/" + pathparts[1].trim("/"); // http://localhost/myproject/
	} else {
		var base_url = location.origin; //http://localhost/
	}

	var record = $("#jumrecord").val();
	for (let i = 1; i <= record; i++) {
		$("#ebarangsec" + i).on("select2:select", function (e) {
			var harga = e.params.data.harga_modal;
			var stok = e.params.data.stok;
			var maxGroupbarang = $("#jmlbarang").val();
			if (stok == 0) {
				Toast.fire({
					icon: "error",
					title: "Stok Barang Kosong",
				});
				$("#eqty" + i).val(null);
				$("#eqty" + i).attr("readonly", true);
				$("#eharga" + i).val(null);
				$("#esub_total" + i).val(null);
			} else {
				$("#eqty" + i).val(1);
				$("#eqty" + i).attr("readonly", false);
				$("#eharga" + i).val(harga);
				$("#esub_total" + i).val(harga);
			}

			var subTotal = $("#sub_total").val();
			var data = [];
			var data1 = [];

			for (let j = 1; j <= record; j++) {
				var obj = {};
				obj = $("#esub_total" + j).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data.push(obj);
			}
			for (let i = 2; i <= maxGroupbarang; i++) {
				var obj = {};
				obj = $("#sub_total" + i).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data1.push(obj);
			}

			var myTotal = 0;
			var myTotal1 = 0;
			for (var j = 0, len = data.length; j < len; j++) {
				myTotal += parseInt(data[j]);
			}
			for (var j = 0, len = data1.length; j < len; j++) {
				myTotal1 += parseInt(data1[j]);
			}
			if (!isNaN(myTotal1)) {
				var totalHarga = parseInt(myTotal);
				$("#etotal_harga").val("Rp. " + totalHarga.toString());
			}
			var totalHarga = parseInt(myTotal + myTotal1);
			// console.log(totalHarga);
			$("#etotal_harga").val("Rp. " + totalHarga.toString());
			// var totalHarga = parseInt(myTotal) + parseInt(subTotal);
		});

		$("#eqty" + i).on("change", function () {
			var barang = $("#ebarangsec" + i).val();
			alert(barang);
			var qtylama = $("#eqtylama" + i).val();
			var qty1 = $("#eqty" + i).val();
			var baranglama = $("#ekdbaranglama" + i).val();
			var ceklokasi = $("#ceklokasi").val();
			if (ceklokasi == null) {
				if (barang == baranglama) {
					var qty = parseInt(qty1) - parseInt(qtylama);
				} else {
					var qty = parseInt(qty1);
				}
				$.ajax({
					url: base_url + "/admin/barang/getQtyBarangSec",
					type: "post",
					dataType: "json",
					data: {
						id: barang,
						qty: qty,
						tabel: "secondary",
					},
					success: function (result) {
						if (barang == baranglama) {
							var hasil = parseInt(result.qty) + parseInt(qtylama);
						} else {
							var hasil = result.qty;
						}
						if (result.no == 0) {
							Toast.fire({
								icon: "error",
								title: "Stok Hanya Tersisa " + hasil,
							});
							$("#eqty" + i).val(null);
							var hargaModal = $("#harga_a").val();
							$("#esub_total" + i).val(0);
						}
					},
				});
			}
		});

		$("#eqty" + i).keyup(function () {
			var harga = parseInt($("#eharga" + i).val());
			var qty = $("#eqty" + i).val();
			var total = harga * parseInt(qty);
			var maxGroupbarang = $("#jmlbarang").val();
			if (!isNaN(total)) {
				$("#esub_total" + i).val(total);
			}

			var subTotal = $("#sub_total").val();

			var data = [];
			var data1 = [];

			if (qty == "") {
				$("#esub_total" + i).val(parseInt(0));
			}
			if (qty == "") {
				$("#sub_total" + i).val(parseInt(0));
			}

			for (let i = 1; i <= record; i++) {
				var obj = {};
				obj = $("#esub_total" + i).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data.push(obj);
			}

			for (let i = 2; i <= maxGroupbarang; i++) {
				var obj = {};
				obj = $("#sub_total" + i).val();
				if (obj == undefined || obj == "") {
					obj = 0;
				}
				data1.push(obj);
			}

			var myTotal = 0;
			var myTotal1 = 0;

			for (var a = 0, len = data.length; a < len; a++) {
				myTotal += parseInt(data[a]);
			}
			for (var a = 0, len = data1.length; a < len; a++) {
				myTotal1 += parseInt(data1[a]);
			}
			if (!isNaN(myTotal1)) {
				var totalHarga = parseInt(myTotal);
				$("#etotal_harga").val("Rp. " + totalHarga.toString());
			}
			var totalHarga = parseInt(myTotal + myTotal1);
			// console.log(totalHarga);
			$("#etotal_harga").val("Rp. " + totalHarga.toString());
		});
		$("#ejenis_maintenance" + i).change(function () {
			var selected_option = $("#ejenis_maintenance" + i).val();
			if (selected_option == "secondary") {
				$("#esection_service" + i).removeClass("d-none");
				$("#esectionbar" + i).removeClass("d-none");
				$("#esectionser" + i).addClass("d-none");
				$("#ebarangsec" + i)
					.val(null)
					.trigger("change");
				$("#eservice" + i).val("");
				$("#eharga" + i).attr("readonly", true);
				$("#eharga" + i).val("");
				$("#eqty" + i).val("");
				$("#esub_total" + i).val("");
			} else if (selected_option == "service") {
				$("#esection_service" + i).removeClass("d-none");
				$("#esectionbar" + i).addClass("d-none");
				$("#esectionser" + i).removeClass("d-none");
				$("#ebarangsec" + i)
					.val(null)
					.trigger("change");
				$("#eservice" + i).val("");
				$("#eharga" + i).val("");
				$("#eqty" + i).val("");
				$("#esub_total" + i).val("");
			} else if (selected_option == "lain-lain") {
				$("#esection_service" + i).removeClass("d-none");
				$("#esectionbar" + i).addClass("d-none");
				$("#esectionser" + i).removeClass("d-none");
				$("#ebarangsec" + i)
					.val(null)
					.trigger("change");
				$("#eservice" + i).val("");
				$("#eharga" + i).val("");
				$("#eqty" + i).val("");
				$("#esub_total" + i).val("");
			} else {
				$("#esection_service" + i).addClass("d-none");
				$("#esectionbar" + i).addClass("d-none");
				$("#esectionser" + i).addClass("d-none");
				$("#ebarangsec" + i)
					.val(null)
					.trigger("change");
				$("#eservice" + i).val("");
				$("#eharga" + i).val("");
				$("#eqty" + i).val("");
				$("#esub_total" + i).val("");
			}
		});

		$("#eservice" + i).keyup(function () {
			$("#eqty" + i).val(1);
			$("#eharga" + i).attr("readonly", false);
			$("#eqty" + i).attr("readonly", true);
		});
		$("#eharga" + i).keyup(function () {
			var validasiAngka = /^[0-9]+$/;
			var qty = $("#eqty" + i).val();
			var harga = $("#eharga" + i).val();
			var total = qty * harga;
			if (harga.match(validasiAngka)) {
				$("#esub_total" + i).val(total);
			} else {
				$("#esub_total" + i).val(0);
			}
		});

		$("#eketerangan" + i).keyup(function () {
			var validasiAngka = /^[0-9]+$/;
			var harga = $("#eharga" + i).val();
			if (!harga.match(validasiAngka)) {
				$("#eharga" + i).val("Harus Berupa Angka");
			}
		});
	}
});

$("#jenis_penyewaan").change(function () {
	var selected_option = $("#jenis_penyewaan").val();
	if (selected_option == "jam") {
		$("#jam").show();
		$("#jam1").attr("required", true);
		$("#blan1").attr("required", false);
		$("#bulan").hide();
	} else if (selected_option == "bulan") {
		$("#jam").hide();
		$("#blan1").attr("required", true);
		$("#jam1").attr("required", false);
		$("#bulan").show();
	} else {
		$("#jam").hide();
		$("#bulan").hide();
		$("#blan1").attr("required", false);
		$("#jam1").attr("required", false);
	}
});

$("#jenis_maintenance_a").change(function () {
	var selected_option = $("#jenis_maintenance_a").val();
	if (selected_option == "secondary") {
		$("#section_service").removeClass("d-none");
		$("#sectionbar").removeClass("d-none");
		$("#sectionser").addClass("d-none");
		$("#barangsec_a").val(null).trigger("change");
		$("#barangsec_a").attr("required", true);
		$("#service_a").attr("required", false);
		$("#service_a").val("");
		$("#harga_a").attr("readonly", true);
		$("#harga_a").val("");
		$("#qty_a").val("");
		$("#sub_total_a").val("");
	} else if (selected_option == "service") {
		$("#section_service").removeClass("d-none");
		$("#sectionbar").addClass("d-none");
		$("#sectionser").removeClass("d-none");
		$("#barangsec_a").val(null).trigger("change");
		$("#barangsec_a").attr("required", false);
		$("#service_a").attr("required", true);
		$("#service_a").val("");
		$("#harga_a").val("");
		$("#qty_a").val("");
		$("#sub_total_a").val("");
	} else if (selected_option == "lain-lain") {
		$("#section_service").removeClass("d-none");
		$("#sectionbar").addClass("d-none");
		$("#sectionser").removeClass("d-none");
		$("#barangsec_a").val(null).trigger("change");
		$("#barangsec_a").attr("required", false);
		$("#service_a").attr("required", true);
		$("#service_a").val("");
		$("#harga_a").val("");
		$("#qty_a").val("");
		$("#sub_total_a").val("");
	} else {
		$("#section_service").addClass("d-none");
		$("#sectionbar").addClass("d-none");
		$("#sectionser").addClass("d-none");
		$("#barangsec_a").val(null).trigger("change");
		$("#barangsec_a").attr("required", false);
		$("#service_a").attr("required", false);
		$("#service_a").val("");
		$("#harga_a").val("");
		$("#qty_a").val("");
		$("#sub_total_a").val("");
	}
});

$("#jenis_report").change(function () {
	var selected_option = $("#jenis_report").val();
	if (selected_option == "bulan") {
		$("#perbulan").show();
		$("#perbulan").removeClass("d-none");
		$("#pertahun").hide();
		$("#pertahun").addClass("d-none");
	} else if (selected_option == "tahun") {
		$("#perbulan").hide();
		$("#perbulan").addClass("d-none");
		$("#pertahun").show();
		$("#pertahun").removeClass("d-none");
	} else {
		$("#perbulan").addClass("d-none");
		$("#perbulan").hide();
		$("#pertahun").addClass("d-none");
		$("#pertahun").hide();
	}
});

function hanyaAngka(evt) {
	var charCode = evt.which ? evt.which : event.keyCode;
	if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		return false;
	}
	return true;
}
