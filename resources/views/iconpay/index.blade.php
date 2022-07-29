@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">IconPay - Add Piutang</h1>
            <hr>

            <select name="progress" id="progress" class="bg-white form-control form-control-inline" required>
                <option value="">--Pilih--</option>
                <option value="CRMID">CRM ID</option>
                <option value="ID_PELANGGAN">ID PELANGGAN</option>
                <option value="KODE_INVOICE">NO INVOICE</option>
            </select>
            <input type="text" name="idPel" id="idPel" class="form-control form-control-inline" required>
            <button type="submit" name="submit" id="cari" class="btn btn-info form-control-inline">Cari</button>
            <br>
            <div class="mt-lg-5" id="buatCard" style="display: none;">
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
                                        <td>
                                            <button type="submit" name="add" id="add" class="btn btn-primary"
                                                style="display: none;">Add Piutang</button>
                                            {{-- <button type="submit" name="edit" id="edit"
                                                    class="btn btn-success" style="display: none;">Edit Piutang</button> --}}
                                        </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- <div class="mt-lg-5" id="batalCard" style="display: none;">
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
                                                : <input type="text" name="alasanBatal" id="piutang"
                                                    value="Batal Piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="border-danger text-dark border-0">
                                                <button type="submit" name="bill" id="bill"
                                                    class="btn btn-danger" style="display: none;">Generate
                                                    Billing</button>
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
            </div> --}}


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
                                $('[name=KODE_INVOICE]').val(j[0].KODE_INVOICE)
                                $('[name=ID_PELANGGAN]').val(j[0].CRMID)
                                $('[name=PRODUK_NAME]').val(j[0].PRODUK_NAME)
                                $('[name=BANDWIDTH]').val(j[0].BANDWIDTH)
                                $('[name=ADDON]').val(j[0].ADDON)
                                $('[name=PERIODE_INVOICE]').val(j[0].PERIODE_INVOICE)
                                $('[name=BIAYA_LAYANAN]').val(j[0].BIAYA_LAYANAN)
                                $('[name=BIAYA_ADDON]').val(j[0].BIAYA_ADDON)
                                $('[name=BIAYA_PPN]').val(j[0].BIAYA_PPN)
                                $('[name=BIAYA_MATERAI]').val(j[0].BIAYA_MATERAI)
                                $('[name=BIAYA_PENYESUAIAN]').val(j[0].BIAYA_PENYESUAIAN)
                                $('[name=BIAYA_RESTITUSI]').val(j[0].BIAYA_RESTITUSI)
                                $('[name=BIAYA_ADMIN]').val(j[0].BIAYA_ADMIN)
                                $('[name=PAYMENTCODE]').val(j[0].PAYMENTCODE)
                                $('[name=EMAIL]').val(j[0].EMAIL)
                                $('[name=TOTAL_HARGA_NORMAL]').val(j[0].TOTAL_HARGA_NORMAL)
                                $('[name=CATATAN]').val(j[0].CATATAN)
                                $('[name=STATUS]').val(j[0].STATUS)

                                $('#buatCard').css('display', 'block')
                                $('#judul').text('Add Piutang')
                                $('#add').css('display', 'block')



                                // if (progress == 'addPiutang') {
                                //     $('#buatCard').css('display', 'block')
                                //     $('#judul').text('Add Piutang')
                                //     // $('#bill').css('display', 'block')
                                //     $('#add').css('display', 'none')
                                //     $('#edit').css('display', 'none')
                                // } else if (progress == 'editPiutang') {
                                //     $('#buatCard').css('display', 'block')
                                //     $('#judul').text('Update Billing CRM')
                                //     $('#bill').css('display', 'block')
                                //     $('#edit').css('display', 'none')

                                //     $('#bill').off('click').click(function() {
                                //         var KODE_INVOICE = $('[name=KODE_INVOICE]').val()
                                //         var PRODUK_NAME = $('[name=PRODUK_NAME]').val()
                                //         var BANDWIDTH = $('[name=BANDWIDTH]').val()
                                //         var ADDON = $('[name=ADDON]').val()
                                //         var PERIODE_INVOICE = $('[name=PERIODE_INVOICE]').val()
                                //         var BIAYA_LAYANAN = $('[name=BIAYA_LAYANAN]').val()
                                //         var BIAYA_ADDON = $('[name=BIAYA_ADDON]').val()
                                //         var BIAYA_PPN = $('[name=BIAYA_PPN]').val()
                                //         var BIAYA_MATERAI = $('[name=BIAYA_MATERAI]').val()
                                //         var BIAYA_PENYESUAIAN = $('[name=BIAYA_PENYESUAIAN]').val()
                                //         var BIAYA_RESTITUSI = $('[name=BIAYA_RESTITUSI]').val()
                                //         var BIAYA_ADMIN = $('[name=BIAYA_ADMIN]').val()
                                //         var PAYMENTCODE = $('[name=PAYMENTCODE]').val()
                                //         var EMAIL = $('[name=EMAIL]').val()
                                //         var TOTAL_HARGA_NORMAL = $('[name=TOTAL_HARGA_NORMAL]').val()
                                //         var CATATAN = $('[name=CATATAN]').val()

                                //         let res = confirm(
                                //             "Apakah anda yakin ingin generate billing ???"
                                //             )
                                //         if (res) {
                                //             $.ajax({
                                //                 type: "POST",
                                //                 url: "/iconpay/updateBillingCRM",
                                //                 data: {
                                //                     'KODE_INVOICE' : KODE_INVOICE,
                                //                     'PRODUK_NAME' : PRODUK_NAME,
                                //                     'BANDWIDTH' : BANDWIDTH,
                                //                     'ADDON' : ADDON,
                                //                     'PERIODE_INVOICE' : PERIODE_INVOICE,
                                //                     'BIAYA_LAYANAN' : BIAYA_LAYANAN,
                                //                     'BIAYA_ADDON' : BIAYA_ADDON,
                                //                     'BIAYA_PPN' : BIAYA_PPN,
                                //                     'BIAYA_MATERAI' : BIAYA_MATERAI,
                                //                     'BIAYA_PENYESUAIAN' : BIAYA_PENYESUAIAN,
                                //                     'BIAYA_RESTITUSI' : BIAYA_RESTITUSI,
                                //                     'BIAYA_ADMIN' : BIAYA_ADMIN,
                                //                     'PAYMENTCODE' : PAYMENTCODE,
                                //                     'EMAIL' : EMAIL,
                                //                     'TOTAL_HARGA_NORMAL' : TOTAL_HARGA_NORMAL,
                                //                     'CATATAN' : CATATAN

                                //                 },
                                //                 dataType: "json",
                                //                 headers: {
                                //                     "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                //                 },
                                //                 success: function(response) {
                                //                     alert('berhasil generate billing')
                                //                     $('#bill').prop('disabled', true);
                                //                     $('#edit').css('display', 'block')
                                //                 }
                                //             });
                                //             // alert('berhasil generate billing')
                                //             //         $('#bill').prop('disabled', true);
                                //             //         $('#edit').css('display', 'block')
                                //         } else {
                                //             alert('gagal')
                                //         }

                                //     });

                                // } else if (progress == 'batalPiutang') {
                                //     $('#buatCard').css('display', 'none')
                                //     $('#batalCard').css('display', 'block')
                                //     // $('#bill').css('display', 'block')
                                //     $('#batal').css('display', 'none')
                                // } else {
                                //     alert('silahkan pilih progressnya !!!')
                                //     return false
                                // }
                            },
                            error: function(response) {
                                alert('tagihan terakhir belum digenerate')
                                window.location.reload();
                            }
                        });
                    }

                });


                //lakukan progress

                //add piutang
                $('#add').click(function() {
                    var idpel = $('[name=ID_PELANGGAN]').val()
                    var noinvoice = $('[name=KODE_INVOICE]').val()
                    var con = confirm("Apakah yakin melakukan add piutang ???")
                    if (con) {
                        $.ajax({
                            type: "POST",
                            url: "/iconpay/addPiutang",
                            data: {
                                'noinvoice': noinvoice,
                                'idpel': idpel
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                var r = response
                                alert(r.keterangan)
                                $('#idPel').val("")
                                $('#progress').val("")
                                var j = response;
                                var controller = "Monita/SendInvoiceToIconpay"
                                var jenistransaksi = "addPiutang"
                                var koderc = j.kode
                                var keterangan = j.keterangan
                                var pt = $('[name=PERIODE_INVOICE]').val()
                                var periodetagihan = pt.substr(0, 7).replace('-', '')
                                var kdinvoice = noinvoice
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

                                    },
                                });

                                window.location.reload()

                            },
                            error: function(response) {
                                console.log(response)
                                alert('gagal add piutang')
                                window.location.reload()
                            }
                        });
                    } else {
                        return false;
                    }

                });

                //edit piutang
                // $('#edit').click(function() {
                //     var idpel = $('[name=ID_PELANGGAN]').val()
                //     $.ajax({
                //         type: "POST",
                //         url: "/iconpay/editPiutang",
                //         dataType: "json",
                //         data: {
                //             'idpel' : idpel
                //         },
                //         headers: {
                //             "X-CSRF-TOKEN": "{{ csrf_token() }}"
                //         },
                //         success: function(response) {
                //             console.log(response);
                //             alert('Berhasil edit piutang')
                //             $('#idPel').val("")
                //             $('#progress').val("")
                //             // window.location.reload()

                //         },
                //         error: function(response) {
                //             console.log(response);
                //             alert('gak tembus boss')
                //             // window.location.reload()
                //         }
                //     });
                // });

                // //batal piutang
                // $('#batal').click(function() {
                //     var nova = $('[name=nova]').val()
                //     var idpel = $('[name=idpel]').val()
                //     var thbltagihan = $('[name=thbltagihan]').val()
                //     var alasanBatal = $('[name=alasanBatal]').val()

                //     $.ajax({
                //         type: "POST",
                //         url: "/iconpay/batalPiutang",
                //         data: {
                //             'nova': nova,
                //             'idpel': idpel,
                //             'thbltagihan': thbltagihan,
                //             'alasanBatal': alasanBatal
                //         },
                //         dataType: "json",
                //         headers: {
                //             "X-CSRF-TOKEN": "{{ csrf_token() }}"
                //         },
                //         success: function(response) {
                //             console.log(response);
                //             alert('Berhasil batal piutang')
                //             $('#idPel').val("")
                //             $('#progress').val("")
                //             // window.location.reload()

                //         },
                //         error: function(response) {
                //             console.log(response);
                //             alert('gak tembus boss')
                //             // window.location.reload()
                //         }
                //     });
                // });

            });
        </script>
    </main>
@endsection
