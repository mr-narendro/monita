@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Cek Sync SPA Staging</h1>
            <hr>

            <b>Masuka No SPA</b>
            <form method="POST" action="/spa/spaSync/cekStaging" id="search-form" class="form-inline" role="form">
                @csrf
                <input type="text" name="spa" id="" class="form-control form-control-inline" required>
                <button type="submit" value="cari" name="submit" class="btn btn-info form-control-inline">Cari
                    Data</button>
            </form>

            <br>
            {{-- <p>
                @if (isset($e))
                    {{ $e }}
                @endif
            </p> --}}
            <table id="TabelOpor" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Project Activat ID</th>
                        <th>ID PEL</th>
                        <th>PRODUCT</th>
                        <th>Intern Order ID</th>
                        <th>Created On</th>
                        <th>Project Initiation</th>
                        <th>Sync Staging</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($e))
                        @foreach ($e as $o)
                            <tr>
                                <td>{{ $o->swo_ProjectActivatID }}</td>
                                <td>{{ $o->new_IDPEL }}</td>
                                <td>{{ $o->product }}</td>
                                <td>{{ $o->swo_InternOrderID }}</td>
                                <td>{{ $o->CreatedOn }}</td>
                                <td>{{ $o->ProjectInitiation }}</td>
                                <td>{{ $o->Sync_Staging }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th>NAMA PELANGGAN</th>
                        <th>ORDER ID</th>
                        <th>ID PELANGGAN</th>
                        <th>CRM ID</th>
                        <th>STATUS</th>
                        <th>TGL LUNAS</th>
                        <th>KODE VA</th>
                        <th>BATAL</th>
                        <th>TGL BATAL</th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
        <br>

        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
                $('#TabelOpor').DataTable({
                    processing: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, 'All']
                    ]
                    // columns: [{
                    //         data: 'NAMA_PELANGGAN'
                    //     },
                    //     {
                    //         data: 'ORDERID'
                    //     },
                    //     {
                    //         data: 'CRMID'
                    //     },
                    //     {
                    //         data: 'ID_PELANGGAN'
                    //     },
                    //     {
                    //         data: 'STATUS'
                    //     },
                    //     {
                    //         data: 'TGL_LUNAS'
                    //     },
                    //     {
                    //         data: 'KODE_VA'
                    //     },
                    //     {
                    //         data: 'BATAL'
                    //     },
                    //     {
                    //         data: 'TGL_BATAL'
                    //     },
                    // ]
                });
            });
        </script>
    </main>
@endsection
