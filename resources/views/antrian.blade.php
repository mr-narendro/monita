@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Cek Antrian Pelanggan</h1>
            <hr>

            <b>Masukan ID Pelanggan / CRM ID</b>
            <form method="POST" action="/antrian" id="search-form" class="form-inline" role="form">
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
                        <th>NAMA PELANGGAN</th>
                        <th>CRM ID / ID PELANGGAN</th>
                        <th>EMAIL PELANGGAN</th>
                        <th>KODE PRODUK</th>
                        <th>BANDWIDTH</th>
                        <th>KODE VA</th>
                        <th>TGL LUNAS</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($e))
                        @foreach ($e as $o)
                            <tr>
                                <td>{{ $o->NAMA_PELANGGAN }}</td>
                                <td>{{ $o->ID_PELANGGAN }}</td>
                                <td>{{ $o->EMAIL }}</td>
                                <td>{{ $o->KODE_PRODUK_INTERNET }}</td>
                                <td>{{ $o->BANDWIDTH }}</td>
                                <td>{{ $o->KODE_VA }}</td>
                                <td>{{ $o->TGL_LUNAS }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th>NAMA PELANGGAN</th>
                        <th>CRM ID / ID PELANGGAN</th>
                        <th>EMAIL</th>
                        <th>KODE PRODUK</th>
                        <th>BANDWITH</th>
                        <th>KODE VA</th>
                        <th>TGL_LUNAS</th>
                    </tr>
                </tfoot>
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
