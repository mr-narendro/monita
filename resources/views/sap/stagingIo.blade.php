@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">SAP - CEK IO STAGING</h1>
            <hr>


            <select name="type" id="type" class="form-select form-control-inline" required>
                <option value="">-- pilih --</option>
                <option value="swo_internorderid">No IO</option>
                <option value="swo_externalordernumber">SPA</option>
            </select>
            <input type="text" name="data" id="data" class="form-control form-control-inline" required>
            <button value="cari" id="cari" name="submit" class="btn btn-info form-control-inline">Cari
                Data
            </button>
            <br>
            <div class="container mt-5">
                <div class="mt-lg-5" id="buatCard" style="display: none;">
                    <div class="card-columns">
                        <div class="card">
                            <div class="card-header">
                                <span class="float-start">
                                    <h2 id="status"></h2>
                                </span>&nbsp;
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table border-bottom-1">
                                            <tr>
                                                <td class="border-primary">No IO</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="no_io" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_description</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_description" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_profitcenter</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_profitcenter" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_externalordernumber</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_externalordernumber" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_ptl</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_ptl" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_amount</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_amount" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">transactioncurrencyid</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="transactioncurrencyid" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_customerclassification</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_customerclassification"
                                                        id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">createdon</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="createdon" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_flagcreated</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_flagcreated" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_customerclassification</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_customerclassification"
                                                        id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_investmentprogram</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_investmentprogram" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">swo_customeralias</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="swo_customeralias" id="piutang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="border-primary">requeststatus</td>
                                                <td class="border-danger text-dark">
                                                    : <input type="text" name="requeststatus" id="piutang">
                                                </td>
                                            </tr>
                                            <hr>
                                            <tr>
                                                <td class="border-primary"></td>
                                                <td class="border-danger">
                                                    <button class="btn btn-warning" id="lempar">Lempar ke SAP</button>
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

        </div>
        <br>

        <script>
            $(document).ready(function() {

                $('#cari').click(function() {
                    let data = $('#data').val()
                    var type = $('#type').children("option:selected").val();
                    if (type == "" && data != "") {
                        alert('Isi dulu yg kosong boss')
                    } else if (type != "" && data == "") {
                        alert('Isi dulu yg kosong boss')
                    } else if (type == "" && data == "") {
                        alert('Isi dulu yg kosong yaa')
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "/sap/stagingIo/cek",
                            data: {
                                'data': data,
                                'type': type
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                var j = response
                                if (j != '') {
                                    $('#buatCard').css('display', 'block')
                                    $('input#piutang').css('border', '0px')
                                    $('#status').text('Status: Tersedia di staging')
                                    $('[name=no_io]').val(j[0].swo_internorderid)
                                    $('[name=swo_description]').val(j[0].swo_description)
                                    $('[name=swo_profitcenter]').val(j[0].swo_profitcenter)
                                    $('[name=swo_externalordernumber]').val(j[0]
                                        .swo_externalordernumber)
                                    $('[name=swo_ptl]').val(j[0].swo_ptl)
                                    $('[name=swo_amount]').val(j[0].swo_amount)
                                    $('[name=transactioncurrencyid]').val(j[0]
                                        .transactioncurrencyid)
                                    $('[name=swo_customerclassification]').val(j[0]
                                        .swo_customerclassification)
                                    $('[name=createdon]').val(j[0].createdon)
                                    $('[name=swo_flagcreated]').val(j[0].swo_flagcreated)
                                    $('[name=swo_customerclassification]').val(j[0]
                                        .swo_customerclassification)
                                    $('[name=swo_investmentprogram]').val(j[0]
                                        .swo_investmentprogram)
                                    $('[name=swo_customeralias]').val(j[0].swo_customeralias)
                                    $('[name=requeststatus]').val(j[0].requeststatus)
                                } else {
                                    $('#status').text('Tidak tersedia di staging')
                                }
                                // if(type=='swo_internorderid' && response != '[]'){
                                //     $('#status').text('Io tersedia di staging')
                                // }else if(type=='swo_externalordernumber' && response != '[]'){
                                //     $('#status').text('SPA tersedia di staging')
                                // }
                                // if (response.code == 200) {
                                //     $('#status').text('Io tersedia di staging')
                                // } else {
                                //     $('#status').text('Io tidak tersedia di staging')


                                // }
                            },
                            error: function(response) {
                                alert('gak tembus boss')
                            }
                        });
                    }

                });

                $('#lempar').click(function() {
                    var io = $('[name=no_io]').val()
                    var swo_description = $('[name=swo_description]').val()
                    var swo_profitcenter = $('[name=swo_profitcenter]').val()
                    var swo_externalordernumber = $('[name=swo_externalordernumber]').val()
                    var swo_ptl = $('[name=swo_ptl]').val()
                    var swo_amount = $('[name=swo_amount]').val()
                    var transactioncurrencyid = $('[name=transactioncurrencyid]').val()
                    var createdon = $('[name=createdon]').val()
                    var swo_flagcreated = $('[name=swo_flagcreated]').val()
                    var swo_customerclassification = $('[name=swo_customerclassification]').val()
                    var swo_investmentprogram = $('[name=swo_investmentprogram]').val()
                    var swo_customeralias = $('[name=swo_customeralias]').val()



                    $.ajax({
                        type: "POST",
                        url: "/sap/stagingIo/lemparSap",
                        data: {
                            'io': io,
                            'swo_description': swo_description,
                            'swo_profitcenter': swo_profitcenter,
                            'swo_externalordernumber': swo_externalordernumber,
                            'swo_ptl': swo_ptl,
                            'swo_amount': swo_amount,
                            'transactioncurrencyid': transactioncurrencyid,
                            'createdon': createdon,
                            'swo_flagcreated': swo_flagcreated,
                            'swo_customerclassification': swo_customerclassification,
                            'swo_investmentprogram': swo_investmentprogram,
                            'swo_customeralias': swo_customeralias,
                        },
                        dataType: "xml",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            var z = response
                            var h = $(z)
                            var a = h.find("MESSAGE").text()
                            var s = h.find("TYPE").text()
                            var p1 = a.match('already exists')
                            var p2 = a.match('Processing for order type')
                            var p3 = a.match('Budget change')
                            if (p1) {
                                alert('IO / SPA already exists')
                                $.ajax({
                                    type: 'GET',
                                    url: '/sap/stagingIo/updateRequest/' + io,
                                    dataType: "json",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        if(response.status == 200){
                                            alert('berhasil update request status')
                                        }
                                    },
                                    error: function(response){
                                        if(response.status != 200){
                                            alert('gagal update request status')
                                        }
                                    }
                                });
                            } else if (p2) {
                                alert('Processing for order type')
                                $.ajax({
                                    type: 'GET',
                                    url: '/sap/stagingIo/updateRequest/' + io,
                                    dataType: "json",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        if(response.status == 200){
                                            alert('berhasil update request status')
                                        }
                                    },
                                    error: function(response){
                                        if(response.status != 200){
                                            alert('gagal update request status')
                                        }
                                    }
                                });
                            }else if(p3){
                                alert('Budget change')
                                $.ajax({
                                    type: 'GET',
                                    url: '/sap/stagingIo/updateRequest/' + io,
                                    dataType: "json",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        if(response.status == 200){
                                            alert('berhasil update request status')
                                        }
                                    },
                                    error: function(response){
                                        if(response.status != 200){
                                            alert('gagal update request status')
                                        }
                                    }
                                });
                            }else if(s == "S"){
                                $.ajax({
                                    type: 'GET',
                                    url: '/sap/stagingIo/updateRequest/' + io,
                                    dataType: "json",
                                    headers: {
                                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                    },
                                    success: function(response) {
                                        if(response.status == 200){
                                            alert('berhasil update request status')
                                        }
                                    },
                                    error: function(response){
                                        if(response.status != 200){
                                            alert('gagal update request status')
                                        }
                                    }
                                });
                            }else{
                                alert('gagal update')
                            }


                            $('#data').val("")
                            $('#type').val("")
                            // window.location.reload()

                        },
                        error: function(response) {
                            alert('gagal lempar ke sap')
                            // window.location.reload()
                        }
                    });
                });
            });
        </script>
    </main>
@endsection
