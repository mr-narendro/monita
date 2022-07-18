@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">IconPay - Progress Piutang</h1>
            <hr>

            <select name="progress" id="progress" class="bg-white form-control form-control-inline" required>
                <option value="">--Pilih Progress--</option>
                <option value="addPiutang">Add Piutang</option>
                <option value="editPiutang">Edit Piutang</option>
                <option value="batalPiutang">Batal Piutang</option>
            </select>
            <input type="text" name="idPel" id="idPel" placeholder="Masukan Id Pelanggan"
                class="form-control form-control-inline" required>
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
                                            <td class="border-primary">No Invoice</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="noinvoice" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">No VA</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="nova" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">ID Pelanggan</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="idpel" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">Produk</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="produk" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">Add on</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="addon" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">thbltagihan</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="thbltagihan" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">nama</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="nama" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">rptag</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="rptag" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">rpdenda</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="rpdenda" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">rpmaterai</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="rpmaterai" id="piutang">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-6">
                                    <table class="table border-bottom-1">
                                        <tr>
                                            <td class="border-primary">rpadmin</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="rpadmin" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">rpadminpartner</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="rpadminpartner" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">rpadminicon</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="rpadminicon" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">tglexpired</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="tglexpired" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">paymentCode</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="paymentCode" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">alfaCode</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="alfaCode" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">indomartCode</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="indomartCode" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">email</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="email" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-primary">type</td>
                                            <td class="border-danger text-dark">
                                                : <input type="text" name="type" id="piutang">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" name="bill" id="bill"
                                                    class="btn btn-danger" style="display: none;">Generate Billing</button>
                                                <button type="submit" name="add" id="add"
                                                    class="btn btn-primary" style="display: none;">Add Piutang</button>
                                                <button type="submit" name="edit" id="edit"
                                                    class="btn btn-success" style="display: none;">Edit Piutang</button>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-lg-5" id="batalCard" style="display: none;">
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
                                                    class="btn btn-danger" style="display: none;">Generate Billing</button>
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
                                'idPel': idPel
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                alert('Berhasil dapat data')
                                $('#idPel').val("")
                                $('#progress').val("")
                                var j = response;
                                $('[name=nova]').val(j[0].nova)
                                $('[name=noinvoice]').val(j[0].noinvoice)
                                $('[name=idpel]').val(j[0].idpel)
                                $('[name=produk]').val(j[0].produk)
                                $('[name=addon]').val(j[0].addon)
                                $('[name=thbltagihan]').val(j[0].thbltagihan)
                                $('[name=nama]').val(j[0].nama)
                                $('[name=rptag]').val(j[0].rptag)
                                $('[name=rpdenda]').val(j[0].rpdenda)
                                $('[name=rpmaterai]').val(j[0].rpmaterai)
                                $('[name=rpadmin]').val(j[0].rpadmin)
                                $('[name=rpadminpartner]').val(j[0].rpadminpartner)
                                $('[name=rpadminicon]').val(j[0].rpadminicon)
                                $('[name=tglexpired]').val(j[0].tglexpired)
                                $('[name=paymentCode]').val(j[0].paymentCode)
                                $('[name=alfaCode]').val(j[0].alfaCode)
                                $('[name=indomartCode]').val(j[0].indomartCode)
                                $('[name=email]').val(j[0].email)
                                $('[name=type]').val(j[0].type)



                                if (progress == 'addPiutang') {
                                    $('#buatCard').css('display', 'block')
                                    $('#judul').text('Add Piutang')
                                    // $('#bill').css('display', 'block')
                                    $('#add').css('display', 'none')
                                    $('#edit').css('display', 'none')
                                } else if (progress == 'editPiutang') {
                                    $('#buatCard').css('display', 'block')
                                    $('#judul').text('Edit Piutang')
                                    $('#bill').css('display', 'block')

                                    $('#bill').click(function(){
                                        var res = confirm("Apakah anda yakin ingin generate billing ???")
                                        if(res){
                                            alert('berhasil generate billing')
                                            $('#bill').css('display', 'none')
                                            $('#edit').css('display', 'block')
                                        }else{
                                            alert('gagal')
                                        }

                                    });

                                } else if (progress == 'batalPiutang') {
                                    $('#buatCard').css('display', 'none')
                                    $('#batalCard').css('display', 'block')
                                    // $('#bill').css('display', 'block')
                                    $('#batal').css('display', 'none')
                                } else {
                                    alert('silahkan pilih progressnya !!!')
                                    return false
                                }
                            },
                            error: function(response) {
                                alert('gak tembus boss')
                            }
                        });
                    }

                });


                //lakukan progress

                //add piutang
                $('#add').click(function() {
                    var nova = $('[name=nova]').val()
                    var noinvoice = $('[name=noinvoice]').val()
                    var idpel = $('[name=idpel]').val()
                    var produk = $('[name=produk]').val()
                    var addon = $('[name=addon]').val()
                    var thbltagihan = $('[name=thbltagihan]').val()
                    var nama = $('[name=nama]').val()
                    var rptag = $('[name=rptag]').val()
                    var rpdenda = $('[name=rpdenda]').val()
                    var rpmaterai = $('[name=rpmaterai]').val()
                    var rpadmin = $('[name=rpadmin]').val()
                    var rpadminpartner = $('[name=rpadminpartner]').val()
                    var rpadminicon = $('[name=rpadminicon]').val()
                    var tglexpired = $('[name=tglexpired]').val()
                    var paymentCode = $('[name=paymentCode]').val()
                    var alfaCode = $('[name=alfaCode]').val()
                    var indomartCode = $('[name=indomartCode]').val()
                    var email = $('[name=email]').val()
                    var type = $('[name=type]').val()

                    $.ajax({
                        type: "POST",
                        url: "/iconpay/addPiutang",
                        data: {
                            'nova' : nova,
                            'noinvoice' : noinvoice,
                            'idpel' : idpel,
                            'produk' : produk,
                            'addon' : addon,
                            'thbltagihan' : thbltagihan,
                            'nama' : nama,
                            'rptag' : rptag,
                            'rpdenda' : rpdenda,
                            'rpmaterai' : rpmaterai,
                            'rpadmin' : rpadmin,
                            'rpadminpartner' : rpadminpartner,
                            'rpadminicon' : rpadminicon,
                            'tglexpired' : tglexpired,
                            'paymentCode' : paymentCode,
                            'alfaCode' : alfaCode,
                            'indomartCode' : indomartCode,
                            'email' : email,
                            'type' : type
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            alert('Berhasil add piutang')
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

                //edit piutang
                $('#edit').click(function() {
                    var nova = $('[name=nova]').val()
                    var noinvoice = $('[name=noinvoice]').val()
                    var idpel = $('[name=idpel]').val()
                    var produk = $('[name=produk]').val()
                    var addon = $('[name=addon]').val()
                    var thbltagihan = $('[name=thbltagihan]').val()
                    var nama = $('[name=nama]').val()
                    var rptag = $('[name=rptag]').val()
                    var rpdenda = $('[name=rpdenda]').val()
                    var rpmaterai = $('[name=rpmaterai]').val()
                    var rpadmin = $('[name=rpadmin]').val()
                    var rpadminpartner = $('[name=rpadminpartner]').val()
                    var rpadminicon = $('[name=rpadminicon]').val()
                    var tglexpired = $('[name=tglexpired]').val()
                    var paymentCode = $('[name=paymentCode]').val()
                    var alfaCode = $('[name=alfaCode]').val()
                    var indomartCode = $('[name=indomartCode]').val()
                    var email = $('[name=email]').val()
                    var type = $('[name=type]').val()

                    $.ajax({
                        type: "POST",
                        url: "/iconpay/editPiutang",
                        data: {
                            'nova' : nova,
                            'noinvoice' : noinvoice,
                            'idpel' : idpel,
                            'produk' : produk,
                            'addon' : addon,
                            'thbltagihan' : thbltagihan,
                            'nama' : nama,
                            'rptag' : rptag,
                            'rpdenda' : rpdenda,
                            'rpmaterai' : rpmaterai,
                            'rpadmin' : rpadmin,
                            'rpadminpartner' : rpadminpartner,
                            'rpadminicon' : rpadminicon,
                            'tglexpired' : tglexpired,
                            'paymentCode' : paymentCode,
                            'alfaCode' : alfaCode,
                            'indomartCode' : indomartCode,
                            'email' : email,
                            'type' : type
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            alert('Berhasil edit piutang')
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

                //batal piutang
                $('#batal').click(function() {
                     var nova = $('[name=nova]').val()
                    var idpel = $('[name=idpel]').val()
                    var thbltagihan = $('[name=thbltagihan]').val()
                    var alasanBatal = $('[name=alasanBatal]').val()

                    $.ajax({
                        type: "POST",
                        url: "/iconpay/batalPiutang",
                        data: {
                            'nova' : nova,
                            'idpel' : idpel,
                            'thbltagihan' : thbltagihan,
                            'alasanBatal' : alasanBatal
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            alert('Berhasil batal piutang')
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
        </script>
    </main>
@endsection
