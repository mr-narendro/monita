@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Edit IO & PTL Staging Manual</h1>
            <hr>

            <select name="type" id="type" class="form-select form-control-inline" required>
                <option value="">-- pilih --</option>
                <option value="swo_internorderid">No IO</option>
                <option value="swo_externalordernumber">PTL</option>
            </select>
            <input type="text" name="data" id="data" class="form-control form-control-inline" required>
            <button value="cari" id="cari" name="submit" class="btn btn-info form-control-inline">Update
                Data
            </button>
            <br>
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
