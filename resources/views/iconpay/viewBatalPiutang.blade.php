@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">IconPay - Batal Piutang</h1>
            <hr>

            {{-- <select name="progress" id="progress" class="bg-white form-control form-control-inline" required>
                <option value="">--Pilih--</option>
                <option value="CRMID">CRM ID</option>
                <option value="ID_PELANGGAN">ID PELANGGAN</option>
                <option value="KODE_INVOICE">NO INVOICE</option>
            </select>
            <input type="text" name="idPel" id="idPel" class="form-control form-control-inline" required>
            <button type="submit" name="submit" id="cari" class="btn btn-info form-control-inline">Cari</button> --}}
            <br>

            {{-- <div class="mt-lg-5" id="buatCard" style="display: none;">
                <div class="card-columns">
                    <div class="card">
                        <div class="card-header">
                            <span class="float-start">
                                <h2 id="judul"></h2>
                            </span>&nbsp;
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6" style="border-right: 5px solid black">
                                    <table class="table border-bottom-1">
                                        <tr>
                                            <td class="border-primary">KODE_INVOICE</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="KODE_INVOICE" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">ID_PELANGGAN</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="ID_PELANGGAN" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">PRODUK_NAME</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="PRODUK_NAME" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">BANDWIDTH</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BANDWIDTH" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">ADDON</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="ADDON" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">PERIODE_INVOICE</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="PERIODE_INVOICE" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">BIAYA_LAYANAN</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BIAYA_LAYANAN" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">BIAYA_ADDON</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BIAYA_ADDON" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">BIAYA_PPN</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BIAYA_PPN" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">BIAYA_MATERAI</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BIAYA_MATERAI" id="piutang">
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table border-bottom-1">
                                        <tr>
                                            <td class="border-primary">BIAYA_PENYESUAIAN</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BIAYA_PENYESUAIAN" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">BIAYA_RESTITUSI</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BIAYA_RESTITUSI" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">BIAYA_ADMIN</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="BIAYA_ADMIN" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">PAYMENTCODE</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="PAYMENTCODE" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">EMAIL</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="EMAIL" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">TOTAL_HARGA_NORMAL</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="TOTAL_HARGA_NORMAL" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">CATATAN</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="CATATAN" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">STATUS</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="STATUS" id="piutang">
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td align="right">
                                                <button type="submit" name="bill" id="bill"
                                                    class="btn btn-primary" style="display: none;">Update CRM
                                                    Billing</button>
                                            </td> --}}
            {{-- <td>
                                            <button type="submit" name="add" id="add" class="btn btn-primary"
                                                style="display: none;">Add Piutang</button>
                                            <button type="submit" name="edit" id="edit"
                                                    class="btn btn-success" style="display: none;">Edit Piutang</button>
                                        </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="mt-lg-5" id="batalCard" style="display: block;">
                <div class="card-columns">
                    <div class="card">
                        <div class="card-header">
                            <span class="float-start">
                                <h2>Batal Piutang</h2>
                            </span>&nbsp;
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="id_billing" />
                                    <table class="table table-bordered">
                                        <tr>
                                            <td class="border-primary">No VA</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="nova" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">CRM ID Pelanggan</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="idpel" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">thbltagihan</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="thbltagihan" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">Alasan Batal</td>
                                            <td class="border-danger text-dark">
                                                : <select name="alasanBatal" id="piutang">
                                                    <option value="">-- Pilih Alasan --</option>
                                                    <option value="Double Tagihan">Double Tagihan</option>
                                                    <option value="Koreksi Billing">Koreksi Billing</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="border-danger text-dark border-0">

                                                <button type="submit" name="batal" id="batal"
                                                    class="btn btn-warning">Batal Piutang</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <br>

        <script>
            $(document).ready(function() {
                $('input#piutang').css('border', '0')


                //cari idpel
                $('#cari').click(function() {
                    let idPel = $('#idPel').val()
                    var progress = $('#progress').children("option:selected").val();
                    if (progress == "" && idPel != "") {
                        alert('Isi dulu yg kosong boss')
                    } else if (progress != "" && idPel == "") {
                        alert('Isi dulu yg kosong boss')
                    } else if (progress == "" && idPel == "") {
                        alert('Isi dulu yg kosong yaa')
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/iconpay/cariIdPel",
                            data: {
                                'idPel': idPel,
                                'progress': progress
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $('#idPel').val("")
                                $('#progress').val("")
                                var j = response;
                                $('[name=id_billing]').val(j[0].ID)
                                $('[name=nova]').val(j[0].KODE_VA)
                                $('[name=idpel]').val(j[0].CRMID)
                                $('[name=thbltagihan]').val(j[0].THBLTAGIHAN)

                                $('#batalCard').css('display', 'block')
                                $('#judul').text('Add Piutang')
                                $('#batal').css('display', 'block')

                            },
                            error: function(response) {
                                alert('tagihan terakhir belum digenerate')
                                window.location.reload();
                            }
                        });
                    }

                });


                // //batal piutang
                $('#batal').click(function() {
                    var nova = $('[name=nova]').val()
                    var idpel = $('[name=idpel]').val()
                    var thbltagihan = $('[name=thbltagihan]').val()
                    var alasanBatal = $('[name=alasanBatal]').val()

                    $.ajax({
                        type: "POST",
                        url: "/iconpay/batalPiutang",
                        data: {
                            'nova': nova,
                            'idpel': idpel,
                            'thbltagihan': thbltagihan,
                            'alasanBatal': alasanBatal
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            // console.log(response.kode);
                            // alert('Berhasil batal piutang')
                            if (response.kode == "00") {
                                updateBatalPiutang();
                            } else {
                                alert(response.keterangan)
                            }



                            $('#idPel').val("")
                            $('#progress').val("")
                            // window.location.reload()

                        },
                        error: function(response) {
                            console.log(response);
                            alert('gak tembus boss')
                            // window.location.reload()
                        }
                    });
                });

            });

            function updateBatalPiutang() {
                var idBilling = $('[name=id_billing]').val()
                var nova = $('[name=nova]').val()
                var idpel = $('[name=idpel]').val()
                var thbltagihan = $('[name=thbltagihan]').val()
                var alasanBatal = $('[name=alasanBatal]').val()
                $.ajax({
                    type: "POST",
                    url: "/iconpay/updateBatalPiutang",
                    data: {
                        'idbilling': idBilling,
                        'nova': nova,
                        'idpel': idpel,
                        'thbltagihan': thbltagihan,
                        'alasanBatal': alasanBatal
                    },
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        alert('update batal piutang berhasil')

                        var j = response;
                                var controller = "Monita/SendInvoiceToIconpay"
                                var jenistransaksi = "batalPiutang"
                                var koderc = j.kode
                                var keterangan = j.keterangan
                                var pt = $('[name=PERIODE_INVOICE]').val()
                                var periodetagihan = pt.substr(0, 7).replace('-', '')
                                var kdinvoice = nova
                                var data = JSON.stringify(response)

                                $.ajax({
                                    type: "POST",
                                    url: "/iconpay/saveLogIconPay",
                                    data: {
                                        'controller': controller,
                                        'jenisTransaksi': jenistransaksi,
                                        'kodeRc': koderc,
                                        'keterangan': keterangan,
                                        'idpel': idpel,
                                        'periodeTagihan': periodetagihan,
                                        'kodeInvoice': kdinvoice,
                                        'data': data
                                    },
                                    dataType: "json",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        alert('save log sukses')
                                        window.location.reload()
                                    }
                                });
                    },
                    error: function(response) {
                        alert('update batal piutang gagal')
                    }
                });
            }
        </script>
    </main>
@endsection
