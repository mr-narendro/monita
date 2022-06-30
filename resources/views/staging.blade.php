@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Cek SPA di staging</h1>
            <hr>

            <b>Masukan No SPA</b>
            <form method="POST" action="/staging/cari" id="search-form" class="form-inline" role="form">
                @csrf
                <input type="text" name="spa" id="" class="form-control form-control-inline">
                <button type="submit" value="cari" name="submit" class="btn btn-info form-control-inline">Cari
                    Data</button>
            </form>

            <br>
            {{-- <p>
                @if (isset($e))
                    {{ $e }}
                @endif
            </p> --}}
            <table id="TabelStaging" style="font-size: 10px;" class="table text-center table-bordered table-responsive-lg table-striped table-hover">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>NO_PA</th>
                        <th>NAMA_PELANGGAN</th>
                        <th>LAYANAN</th>
                        <th>SID</th>
                        <th>NO_PA_NODE</th>
                        <th>ADDRESS</th>
                        <th>REGION</th>
                        <th>SATUAN</th>
                        <th>LAT_LONG</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($e))
                        @php $no = 1; @endphp
                        @foreach ($e as $o)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{!! $o->NO_PA !!}</td>
                                <td>{{ $o->NAMA_PELANGGAN }}</td>
                                <td>{{ $o->LAYANAN }}</td>
                                <td>{{ $o->SID }}</td>
                                <td>{{ $o->NO_PA_NODE }}</td>
                                <td>{{ $o->ADDRESS }}</td>
                                <td>{{ $o->REGION }}</td>
                                <td>{{ $o->SATUAN }}</td>
                                <td>{{ $o->LAT_LONG }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
                {{-- <tfoot>
                    <tr>
                        <th>NAMA PELANGGAN</th>
                        <th>CRM ID / ID PELANGGAN</th>
                        <th>EMAIL</th>
                        <th>KODE PRODUK</th>
                        <th>BANDWITH</th>
                        <th>KODE VA</th>
                        <th>TGL_LUNAS</th>
                    </tr>
                </tfoot> --}}
            </table>
        </div>
        <br>

        <script>
            $(document).ready(function() {
                $('[data-toggle="tooltip"]').tooltip();
                $('#TabelStaging').DataTable({
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
