@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Edit IO & PTL Staging Manual</h1>
            <hr>

            <select name="type" id="type" class="form-select form-control-inline" required>
                <option value="">-- pilih --</option>
                <option value="nomor_io">IO</option>
                <option value="NAMA_PTL">PTL</option>
            </select>
            <input type="text" placeholder="Masukan No SPA" name="spa" id="spa" class="form-control form-control-inline" required>
            <button value="cari" id="cari" name="submit" class="btn btn-default form-control-inline" style="background-color:greenyellow;">Cari
                Data
            </button>
            <br><br>

            <table id="tblEdit" class="table table-bordered">
                <tr>
                    <thead>
                        <th>No PA</th>
                        <th>Nama PTL</th>
                        <th>Nomor IO</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        <td><input type="text" name="pa" id="fsoStaging" style="border: 0px;"></td>
                        <td><input type="text" name="ptl" id="fsoStaging" style="border: 0px;"></td>
                        <td><input type="text" name="io" id="fsoStaging" style="border: 0px;"></td>
                        <td>
                            <button id="btnIO" type="submit" class="btn btn-warning" style="display: none;">Edit IO</button>
                            <button id="btnPTL" type="submit" class="btn btn-success" style="display: none;">Edit PTL</button>
                        </td>
                    </tbody>
                </tr>
            </table>
        </div>
        <br>

        <script>
            $(document).ready(function() {
                $('#tblEdit').css('display','none');


$('#cari').click(function(){
                    let data = $('#spa').val()
                    var type = $('#type').children("option:selected").val();
                    if (type == "" && data != "") {
                        alert('Pilih dulu progressnya boss')
                    } else if (type != "" && data == "") {
                        alert('Isi dulu nomor SPA nya boss')
                    } else if (type == "" && data == "") {
                        alert('Isi dulu yg kosong yaa')
                    }else{
                        alert('oke udah mantap...')
                        $.ajax({
                            type: "POST",
                            url: "/staging/update-io-manual/cari",
                            data: {
                                'data': data,
                                'type': type
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                var r = response;
                                $('#tblEdit').css('display','block');
                                $('[name=spa]').val(r[0].NO_PA)
                                $('[name=ptl]').val(r[0].NAMA_PTL)
                                $('[name=io]').val(r[0].nomor_io)
                                if(type == 'nomor_io')
                                {
                                    $('#btnIO').css('display','block');
                                    $('#btnPTL').css('display','none');
                                }
                                else if(type == 'NAMA_PTL')
                                {
                                    $('#btnPTL').css('display','block');
                                    $('#btnIO').css('display','none');
                                }

                            },
                            error: function(response) {
                                alert('Pantek Kalera')
                            }
                        });
                    }
                });

                $('#btnPTL').click(function() {
                    var ptl = $('[name="ptl"]').val()
                    var pa = $('[name="pa"]').val()
                    $.ajax({
                        type: "POST",
                        url: "/staging/update-io-manual/updatePTL",
                        data: {
                            'ptl': ptl,
                            'pa': pa
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert('sukses update PTL')
                        },
                        error: function(response) {
                            alert('gagal update PTL')
                        }
                    });
                });

                $('#btnIO').click(function() {
                    let nomor_io = $('[name="io"]').val()
                    var pa = $('[name="pa"]').val()
                    $.ajax({
                        type: "POST",
                        url: "/staging/update-io-manual/updateIO",
                        data: {
                            'nomor_io': nomor_io,
                            'pa': pa
                        },
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            alert('sukses update IO')
                        },
                        error: function(response) {
                            alert('gagal update IO')
                        }
                    });
                });

            });
        </script>
    </main>
@endsection
