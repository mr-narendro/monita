@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">ADD PA Staging Manual</h1>
            <hr>

            <b>Nomor SPA</b>
            <input type="text" name="noSPA" id="noSPA" class="form-control form-control-inline form-control-sm">
            <button name="btnSubmit" id="btnSubmit" class="btn btn-info form-control-inline btn-sm">Cari Data</button>
            <button name="btnAddSPA" id="btnAddSPA" class="btn btn-success btn-sm">Add Staging</button>

            <br>
            <br>
            <table id="tableSPA" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>NO SPA</th>
                        <th>CRM ID</th>
                        <th>PRODUK</th>
                        <th>IO</th>
                        <th>PI</th>
                        <th>Sync Staging</th>
                        <th>PTL</th>
                        <th>Created On</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <br>

        <script>
            $(document).ready(function() {
                $('#btnSubmit').click(function(e) {
                    if ($('#noSPA').val() != null && $('#noSPA').val() != '') {
                        var spa = $('#noSPA').val().replaceAll("/", "_");
                        table.ajax.url("{{ url('staging/add-manual/dt') }}" + '/' + spa).load();
                    } else {
                        alert('No SPA tidak boleh kosong')
                    }

                });

                $('#btnAddSPA').click(function(e) {
                    var spa = $('#noSPA').val().replaceAll("/", "_");
                    $.ajax({
                        url: "{{ url('staging/add-manual/insert') }}" + '/' + spa,
                        type: 'GET',
                        success: function(response) {
                            alert('berhasil save')
                        },
                        error: function(response) {
                            alert('gagal save')
                        }
                    });

                });

                var table = $('#tableSPA').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('staging/add-manual/dt') }}" + '/SPA_ACT',
                    columns: [{
                            data: 'swo_ProjectActivatID',
                            name: 'swo_ProjectActivatID'
                        },
                        {
                            data: 'new_IDPEL',
                            name: 'new_IDPEL'
                        },
                        {
                            data: 'product',
                            name: 'product'
                        },
                        {
                            data: 'swo_InternOrderID',
                            name: 'swo_InternOrderID'
                        },
                        {
                            data: 'ProjectInitiation',
                            name: 'ProjectInitiation'
                        },
                        {
                            data: 'Sync_Staging',
                            name: 'Sync_Staging'
                        },
                        {
                            data: 'ptl',
                            name: 'ptl'
                        },
                        {
                            data: 'CreatedOn_SPA',
                            name: 'CreatedOn_SPA'
                        },

                    ]
                });

            });
        </script>
    </main>
@endsection
