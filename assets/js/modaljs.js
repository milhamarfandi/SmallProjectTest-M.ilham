$(document).ready(function () {
	function convertToRupiah(angka) {
		var rupiah = '';
		var angkarev = angka.toString().split('').reverse().join('');
		for (var i = 0; i < angkarev.length; i++)
			if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
		return 'Rp. ' + rupiah.split('', rupiah.length - 1).reverse().join('');
	}
	var pathparts = location.pathname.split("/");
	// if (location.host == '188.166.212.76') {
	if (location.host == "localhost") {
		var base_url = location.origin + "/" + pathparts[1].trim("/"); // http://localhost/myproject/
	} else {
		var base_url = location.origin; //http://localhost/
	}

	// Untuk sunting
	$("#modal-edit").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var tabel = div.data("tabel");

		$.ajax({
			url: base_url + "/admin/barang/getBarangById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				tabel: tabel,
			},
			success: function (result) {
				console.log(result);

				modal.find("#id").attr("value", result[0].kd_barang);
				if (tabel == "primary") {
					$("#serial_primary_edit").val(result[0].serial_number);
					$("#nama_primary").val(result[0].nm_barang);
					// $("#supplier_primary").val(result.kd_supplier);
					$("#supplier_primary")
						.select2()
						.val(result[0].kd_supplier)
						.trigger("change");
					$("#harga_modal_primary").val(result[0].harga_modal);
					$("#harga_jual_primary").val(result[0].harga_jual);
					$("#harga_sewa_jam_primary").val(result[0].harga_sewa_jam);
					$("#harga_primary").val(result[0].harga_sewa_bulan);
					$("#stok_primary").val(result[0].stok);
				} else if (tabel == "secondary") {
					$("#serial_secondary_edit").val(result[0].serial_number);
					$("#nama_secondary").val(result[0].nm_barang);
					// $("#supplier_secondary").val(result.kd_supplier);
					$("#supplier_secondary")
						.select2()
						.val(result[0].kd_supplier)
						.trigger("change");
					$("#harga_modal_secondary").val(result[0].harga_modal);
					$("#harga_jual_secondary").val(result[0].harga_jual);
					$("#harga_sewa_jam_secondary").val(result[0].harga_sewa_jam);
					$("#harga_secondary").val(result[0].harga_sewa_bulan);
					$("#stok_secondary").val(result[0].stok_secondary);
				}
			},
		});
	});

	$("#modal-editsec").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var tabel = div.data("tabel");

		$.ajax({
			url: base_url + "/admin/barang/getBarangSecById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				tabel: tabel,
			},
			success: function (result) {
				console.log(result);

				modal.find("#id").attr("value", result[0].kd_barang);
				$("#serial_secondary_edit").val(result[0].serial_number);
				$("#nama_secondary").val(result[0].nm_barang);
				// $("#supplier_secondary").val(result.kd_supplier);
				// $("#supplier_secondary")
				// 	.select2()
				// 	.val(result[0].kd_supplier)
				// 	.trigger("change");
				$("#harga_modal_secondary").val(result[0].harga);
				// $("#harga_jual_secondary").val(result[0].harga_jual);
				// $("#harga_sewa_jam_secondary").val(result[0].harga_sewa_jam);
				// $("#harga_secondary").val(result[0].harga_sewa_bulan);
				$("#stok_secondary").val(result[0].stok_secondary);
			},
		});
	});

	$("#modal-lihat-barang").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var tabel = div.data("tabel");

		$.ajax({
			url: base_url + "/admin/barang/getBarangById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				tabel: tabel,
			},
			success: function (result) {
				console.log(result);

				modal.find("#id").attr("value", result[0].kd_barang);
				if (tabel == "primary") {
					$("#serial_primary_lihat").val(result[0].serial_number);
					$("#nama_primary_lihat").val(result[0].nm_barang);
					// $("#supplier_primary_lihat").val(result.kd_supplier);
					// $("#supplier_primary_lihat").select2().val(result[0].kd_supplier).trigger("change");
					$("#supplier_primary_lihat").val(result[0].kd_supplier);
					$("#harga_modal_primary_lihat").val(convertToRupiah(result[0].harga_modal));
					$("#harga_jual_primary_lihat").val(convertToRupiah(result[0].harga_jual));
					$("#harga_sewa_jam_primary_lihat").val(convertToRupiah(result[0].harga_sewa_jam));
					$("#harga_primary_lihat").val(convertToRupiah(result[0].harga_sewa_bulan));
					$("#stok_primary_lihat").val(result[0].stok);
				} else if (tabel == "secondary") {
					$("#serial_secondary_lihat").val(result[0].serial_number);
					$("#nama_secondary_lihat").val(result[0].nm_barang);
					// $("#supplier_secondary_lihat").val(result.kd_supplier);
					// $("#supplier_secondary_lihat").select2().val(result[0].kd_supplier).trigger("change");
					$("#supplier_secondary_lihat").val(result[0].kd_supplier);
					$("#harga_modal_secondary_lihat").val(convertToRupiah(result[0].harga_modal));
					$("#harga_jual_secondary_lihat").val(result[0].harga_jual);
					$("#harga_sewa_jam_secondary_lihat").val(result[0].harga_sewa_jam);
					$("#harga_secondary_lihat").val(result[0].harga_sewa_bulan);
					$("#stok_secondary_lihat").val(result[0].stok);
				}
			},
		});
	});

	$("#modal-lihat-barangsec").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var tabel = div.data("tabel");
		var text = "";
		var text1 = "";
		var text2 = "";

		$.ajax({
			url: base_url + "/admin/barang/getDetailBarangById1",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				tabel: tabel,
			},
			success: function (result2) {
				console.log(result2);

				if (result2.length > 0) {
					for (let i = 0; i < result2.length; i++) {
						text2 +=
							"<tr>" +
							"<td>" +
							result2[i].nm_barang +
							"</td>" +
							"<td>" +
							result2[i].nm_supplier +
							"</td>" +
							"<td>" +
							convertToRupiah(result2[i].harga) +
							"</td>" +
							"<td>" +
							result2[i].stok_secondary +
							"</td>" +
							"<td>" +
							'Ditambahkan' +
							"</td>" +
							"</tr>";
					}
				} else {
					text2 =
						"<tr>" +
						"<td colspan=6><center>Tidak Ada Apapun </center></td>" +
						"</tr>";
				}
				$("#demo1").html(text2);
			},
		});

		$.ajax({
			url: base_url + "/admin/barang/getDetailBarangById2",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				tabel: tabel,
			},
			success: function (result1) {
				console.log(result1);

				if (result1.length > 0) {
					for (let i = 0; i < result1.length; i++) {
						text1 +=
							"<tr>" +
							"<td>" +
							result1[i].nm_barang +
							"</td>" +
							"<td>" +
							result1[i].nm_supplier +
							"</td>" +
							"<td>" +
							'-' + result1[i].stok_secondary +
							"</td>" +
							"<td>" +
							'Dimaintenance' +
							"</td>" +
							"</tr>";
					}
				} else {
					text1 =
						"<tr>" +
						"<td colspan=6><center>Tidak Ada Apapun </center></td>" +
						"</tr>";
				}
				$("#demo2").html(text1);
			},
		});

		$.ajax({
			url: base_url + "/admin/barang/getDetailBarangById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
				tabel: tabel,
			},
			success: function (result) {
				console.log(result);

				if (result.length > 0) {
					for (let i = 0; i < result.length; i++) {
						text +=
							"<tr>" +
							"<td>" +
							result[i].nm_barang +
							"</td>" +
							"<td>" +
							result[i].nm_supplier +
							"</td>" +
							"<td>" +
							convertToRupiah(result[i].harga) +
							"</td>" +
							"<td>" +
							result[i].stok_secondary +
							"</td>" +
							"<td>" +
							'Dibeli' +
							"</td>" +
							"</tr>";
					}
				} else {
					text =
						"<tr>" +
						"<td colspan=6><center>Tidak Ada Apapun </center></td>" +
						"</tr>";
				}
				$("#demo").html(text);
			},
		});
	});

	$("#modal-lihat-pembelian").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var text = "";

		$.ajax({
			url: base_url + "/admin/pembelian/lihat/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				modal.find("#kd_pembelian").html(result[0].kd_pembelian);
				$("#no_invoice").html(result[0].no_invoice);
				$("#nama_supplier").html(result[0].nm_supplier);
				$("#tgl_pembelian").html(result[0].tgl_pembelian);
				$("#total_harga").html(convertToRupiah(result[0].total_harga));
			},
		});

		$.ajax({
			url: base_url + "/admin/pembelian/lihat_detail/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				for (let i = 0; i < result.length; i++) {
					text +=
						"<tr>" +
						"<td>" +
						result[i].kd_barang +
						"</td>" +
						"<td>" +
						result[i].nm_barang +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].harga) +
						"</td>" +
						"<td>" +
						result[i].qty +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].sub_total) +
						"</td>" +
						"</tr>";
				}
				$("#demo").html(text);
			},
		});
	});

	$("#modal-lihat-penyewaan").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var text = "";

		$.ajax({
			url: base_url + "/admin/penyewaan/lihat/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				modal.find("#kd_pembelian").html(result[0].kd_penyewaan);
				$("#nama_supplier").html(result[0].nm_customer);
				$("#tgl_pembelian").html(result[0].tgl_penyewaan);
				$("#total_harga").html(convertToRupiah(result[0].total_harga));
				if (result[0].status == 1) {
					$("#status_penyewaan").html("SUBMITTED");
				} else if (result[0].status == 0) {
					$("#status_penyewaan").html("CANCELLED");
				} else if (result[0].status == "") {
					$("#status_penyewaan").html("");
				}
				$("#status_penyewaan").css("font-weight", "bold");
				$("#keterangan1").html(result[0].keterangan);
			},
		});

		$.ajax({
			url: base_url + "/admin/penyewaan/lihat_detail/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				for (let i = 0; i < result.length; i++) {
					text +=
						"<tr>" +
						"<td>" +
						result[i].kd_barang +
						"</td>" +
						"<td>" +
						result[i].nm_barang +
						"</td>" +
						"<td>" +
						result[i].lama_sewa + ' ' + result[i].jenis_sewa +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].harga) +
						"</td>" +
						"<td>" +
						result[i].qty +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].diskon) +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].biaya_angkut) +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].sub_total) +
						"</td>" +
						"</tr>";
				}
				$("#demo").html(text);
			},
		});
	});

	$("#modal-lihat-maintenance").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var total = div.data("total");
		var total1 = div.data("total1");
		var text = "";
		var text1 = "";

		$.ajax({
			url: base_url + "/admin/alokasi/lihat/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				modal.find("#kd_alokasi").html(result[0].kd_alokasi);
				$("#nama_barang").html(result[0].nm_barang);
				$("#tgl_maintenance").html(result[0].tgl_maintenance);
				$("#total_harga").html(convertToRupiah(total));
				$("#total_harga1").html(convertToRupiah(total1));
			},
		});

		$.ajax({
			url: base_url + "/admin/alokasi/lihat_detail/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				for (let i = 0; i < result.length; i++) {
					text +=
						"<tr>" +
						"<td>" +
						result[i].jenis_maintenance +
						"</td>" +
						"<td>" +
						result[i].nm_barang +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].harga) +
						"</td>" +
						"<td>" +
						result[i].qty +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].sub_total) +
						"</td>" +
						"</tr>";
				}
				$("#demo").html(text);
			},
		});

		$.ajax({
			url: base_url + "/admin/alokasi/lihat_detail_1/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				for (let i = 0; i < result.length; i++) {
					text1 +=
						"<tr>" +
						"<td>" +
						result[i].jenis_maintenance +
						"</td>" +
						"<td>" +
						result[i].service +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].harga) +
						"</td>" +
						"<td>" +
						result[i].qty +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].sub_total) +
						"</td>" +
						"</tr>";
				}
				$("#data-service").html(text1);
			},
		});
	});

	$("#modal-lihat-penjualan").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var text = "";

		$.ajax({
			url: base_url + "/admin/penjualan/lihat/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				modal.find("#kd_penjualan").html(result[0].kd_penjualan);
				$("#nama_customer").html(result[0].kd_customer);
				$("#tgl_penjualan").html(result[0].tgl_penjualan);
				$("#total_harga").html(convertToRupiah(result[0].total_harga));
			},
		});

		$.ajax({
			url: base_url + "/admin/penjualan/lihat_detail/",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);
				for (let i = 0; i < result.length; i++) {
					text +=
						"<tr>" +
						"<td>" +
						result[i].kd_barang +
						"</td>" +
						"<td>" +
						result[i].nm_barang +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].harga) +
						"</td>" +
						"<td>" +
						result[i].qty +
						"</td>" +
						"<td>" +
						convertToRupiah(result[i].sub_total) +
						"</td>" +
						"</tr>";
				}
				$("#demo").html(text);
			},
		});
	});

	$("#modal-edit-supplier").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		cariDataSupplier(id, "edit");
	});

	$("#modal-lihat-supplier").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		cariDataSupplier(id, "view");
	});

	function cariDataSupplier(id, jenis) {
		$.ajax({
			url: base_url + "/admin/supplier/getBarangById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);

				if (jenis == "edit") {
					$("#kd_supplier").val(result[0].kd_supplier);
					$("#nama_supplier").val(result[0].nm_supplier);
					$("#cp_supplier").val(result[0].contact_person);
					$("#telp_supplier").val(result[0].no_telp);
					$("#email_supplier").val(result[0].email);
					$("#alamat_supplier").val(result[0].alamat);
				} else if (jenis == "view") {
					$("#kd_supplier_view").html(result[0].kd_supplier);
					$("#nama_supplier_view").html(result[0].nm_supplier);
					$("#cp_supplier_view").html(result[0].contact_person);
					$("#telp_supplier_view").html(result[0].no_telp);
					$("#email_supplier_view").html(result[0].email);
					$("#alamat_supplier_view").html(result[0].alamat);
				}
			},
		});
	}

	$("#modal-edit-customer").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		cariDataCustomer(id, "edit");
	});

	$("#modal-lihat-customer").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		cariDataCustomer(id, "view");
	});

	function cariDataCustomer(id, jenis) {
		$.ajax({
			url: base_url + "/admin/customer/getBarangById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);

				if (jenis == "edit") {
					$("#kd_customer").val(result[0].kd_customer);
					$("#nama_customer").val(result[0].nm_customer);
					$("#cp_customer").val(result[0].contact_person);
					$("#telp_customer").val(result[0].no_telp1);
					$("#email_customer").val(result[0].email);
					$("#alamat_customer").val(result[0].alamat1);
				} else if (jenis == "view") {
					$("#kd_customer_view").html(result[0].kd_customer);
					$("#nama_customer_view").html(result[0].nm_customer);
					$("#cp_customer_view").html(result[0].contact_person);
					$("#telp_customer_view").html(result[0].no_telp1);
					$("#email_customer_view").html(result[0].email);
					$("#alamat_customer_view").html(result[0].alamat1);
				}
			},
		});
	}

	$("#btn-cek-lokasi").click(function (e) {
		e.preventDefault();
		var text = "";

		var id = $("#kdbarang").val();
		$.ajax({
			url: base_url + "/admin/lokasibarang/getlokasi/" + id,
			success: function (data) {
				$("#modal-cek-lokasi").modal({
					backdrop: "static",
					show: true,
				});
				if (data) {
					var obj = JSON.parse(data);
					for (let i = 0; i < obj.length; i++) {
						var nmlokasi = obj[i].nm_lokasi;
						if (nmlokasi == null) {
							var namalokasi = obj[i].kd_lokasi;
						} else {
							var namalokasi = obj[i].nm_lokasi;
						}
						text +=
							"<tr>" +
							"<td>" +
							obj[i].kd_barang +
							"</td>" +
							"<td>" +
							obj[i].nm_barang +
							"</td>" +
							"<td>" +
							obj[i].stok_barang +
							"</td>" +
							"<td>" +
							namalokasi +
							"</td>" +
							"</tr>";
					}
				} else {
					text =
						"<tr>" +
						"<td colspan=4><center>Barang Tidak Ada DiLokasi Manapun </center></td>" +
						"</tr>";
				}
				console.log(text);
				$("#demo").html(text);
			},
			error: function () {
				Toast.fire({
					icon: "error",
					title: "Pilih Barang Terlebih Dahulu",
				});
			},
		});
	});

	$("#modal-edit-lokasi").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		$.ajax({
			url: base_url + "/admin/lokasi/getLokasiById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				modal.find("#id").attr("value", result.lokasi[0].kd_lokasi);

				$("#nama_lokasi").val(result.lokasi[0].nm_lokasi);
			},
		});
	});

	$("#modal-edit-biaya").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		$.ajax({
			url: base_url + "/admin/biaya/getBiayaById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);
				modal.find("#id").attr("value", result.biaya[0].kd_biaya);
				$("#typebiaya1").select2().val(result.biaya[0].type).trigger("change");
				$("#nama_biaya").val(result.biaya[0].nm_biaya);
			},
		});
	});

	$("#modal-edit-biayalain").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		$.ajax({
			url: base_url + "/admin/pembelian/getBiayaById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);
				modal.find("#id").attr("value", result.biayalain[0].kd_transaksi_lain);
				$("#datepickercoba").val(result.biayalain[0].tgl_tl);
				$("#typebiaya1").select2().val(result.biayalain[0].kd_biaya).trigger("change");
				$("#total").val(result.biayalain[0].total);
			},
		});
	});

	$("#modal-edit-pendapatan").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		$.ajax({
			url: base_url + "/admin/penjualan/getPendapatanById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);
				modal.find("#id").attr("value", result.biayalain[0].kd_transaksi_lain);
				$("#datepickercoba").val(result.biayalain[0].tgl_tl);
				$("#typebiaya1").select2().val(result.biayalain[0].kd_biaya).trigger("change");
				$("#total").val(result.biayalain[0].total);
			},
		});
	});

	$("#modal-edit-lokasibarang").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");
		var nama = div.data("nama");

		$.ajax({
			url: base_url + "/admin/lokasibarang/getLokasibarangById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				modal.find("#id").attr("value", result[0].kd_lokasi_barang);
				$("#barangedit").select2().val(result[0].kd_barang).trigger("change");
				var kd_barang = result[0].kd_barang;
				var res = kd_barang.slice(0, 3);
				if (res == "BPR") {
					$('#forprimaryedit').show();
					$("#kdlokasiedit").select2().val(null).trigger("change");
					$("#kdlokasiedit").attr('disabled', true);
					$("#inputlokasiedit").attr('disabled', false);
					$("#inputlokasiedit").val(result[0].kd_lokasi);
					$('#forsecondaryedit').hide();
					var tabel = "primary";
				} else {
					$('#forprimaryedit').hide();
					$('#inputlokasiedit').val(null);
					$("#inputlokasiedit").attr('disabled', true);
					$("#kdlokasiedit").attr('disabled', false);
					$('#forsecondaryedit').show();
					var tabel = "secondary";
				}
				$("#kdlokasiedit").select2().val(result[0].kd_lokasi).trigger("change");

				$("#stok_baranglama").val(result[0].stok_barang);
				$("#kd_baranglama").val(result[0].kd_barang);

				if (result[0].stok_barang <= 0) {
					$("#inputstokedit").attr("readonly", true);
					$("#inputstokedit").val(null);
				} else {
					$("#inputstokedit").attr("readonly", false);
					$("#inputstokedit").val(result[0].stok_barang);
				}

				$.ajax({
					url: base_url + "/admin/barang/getBarangById",
					type: "post",
					dataType: "json",
					data: {
						id: result[0].kd_barang,
						tabel: tabel,
					},
					success: function (results) {
						console.log(results);
						var stok = results[0].stok;
						$.ajax({
							url: base_url + "/admin/lokasibarang/get_json_stok",
							type: "post",
							dataType: "json",
							data: {
								id: result[0].kd_barang,
							},
							success: function (results) {
								var stok_barang = results[0].stok_barang;
								$("#stok_barangedit").val(stok_barang);
								var stokeditlama = parseInt($("#stok_baranglama").val());
								$("#stokbrgedit").html(stok - stok_barang + stokeditlama);
								$("#textstokbarang").html(
									" (" +
									(stok - stok_barang) +
									" Stok Barang Tersisa" +
									" + " +
									stokeditlama +
									" Stok Saat ini )"
								);
							},
						});
					},
				});
			},
		});
	});

	$("#modal-edit-pembayaran").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		$.ajax({
			url: base_url + "/admin/penyewaan/getpembayaranById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);

				modal.find("#id").attr("value", result.lokasi[0].kd_pembayaran);

				if (result.lokasi[0].status_pembayaran == 1) {
					$("#pemb4yaran_edit").show();
					$("#checkboxpemedit").prop("checked", true);
				} else if (result.lokasi[0].status_pembayaran == 2) {
					$("#checkboxpemedit").prop("checked", false);
					$("#pemb4yaran_edit").hide();
				}
				$("#statuslama").val(result.lokasi[0].status_pembayaran);
				$("#imgViewEdit").attr(
					"src",
					base_url + "/assets/images/bukti_pembayaran/" + result.lokasi[0].bukti
				);
				$("#imgViewEdit").hide();
				$("#imgViewEdit").fadeIn(500);
			},
		});
	});

	$("#modal-edit-pengiriman").on("show.bs.modal", function (event) {
		var div = $(event.relatedTarget); // Tombol dimana modal di tampilkan
		var modal = $(this);
		var id = div.data("id");

		$.ajax({
			url: base_url + "/admin/penyewaan/getpengirimanById",
			type: "post",
			dataType: "json",
			data: {
				id: id,
			},
			success: function (result) {
				console.log(result);

				modal.find("#id").attr("value", result.lokasi[0].kd_penyewaan);
				$("#kd_pengiriman").val(result.lokasi[0].kd_pengiriman);
				$("#pengirimanedit").text(result.lokasi[0].status);
			},
		});
	});
});
