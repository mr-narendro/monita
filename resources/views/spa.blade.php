@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Cek No SPA</h1>
            <hr>

            <b>Masukan ID Pelanggan / CRM ID</b>
            <form method="POST" action="/spa" id="search-form" class="form-inline" role="form">
                @csrf
                <input type="text" name="idpel" id="" class="form-control form-control-inline">
                <button type="submit" value="cari" name="submit" class="btn btn-info form-control-inline">Cari
                    Data</button>
            </form>

            <br>
            {{-- <p>
                @if (isset($e))
                    {{ $e }}
                @endif
            </p> --}}
            <table id="TabelAntri" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID PELANGGAN</th>
                        <th>NO SPA</th>
                        <th>BANDWIDTH</th>
                        <th>CREATED ON</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($e))
                        @foreach ($e as $o)
                            <tr>
                                <td>{{ $o->new_IDPEL }}</td>
                                <td>{{ $o->no_pa }}</td>
                                <td>{{ $o->bandwidth }}</td>
                                <td>{{ $o->CreatedOn }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th>ID PELANGGAN</th>
                        <th>NO PA</th>
                        <th>BANDWIDTH</th>
                        <th>CREATED ON</th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
        <br>

        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
                $('#TabelAntri').DataTable({
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
