@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Cek SPA di CRM 23.193</h1>
            <hr>

            <form action="/staging/insertData" method="post">
                @csrf
                <select name="jenis" id="jenis" class="form-select form-control-inline" required>
                    <option value="">-- Pilih Jenis Data --</option>
                    <option value="bandwidth">Bandwidth</option>
                    <option value="no_io">Nomor IO</option>
                    <option value="produk">Product</option>
                    <option value="no_pi">Nomor PI</option>
                </select>
                <input type="text" name="data" id="data" class="form-control form-control-inline" required>
                <button value="cari" id="cari" name="submit" class="btn btn-info form-control-inline">Insert
                    Data
                </button>
            </form>
            <br>

            <div class="alert alert-warning" role="alert">
                <h2>Note :</h2>
                <p>Untuk pilihan bandwith dan produk, isikan inputan dengan No SPA</p>
                <p>Untuk pilihan bandwith dan produk, isikan inputan dengan Id Pelanggan</p>
            </div>
            <table id="TabelSpa" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID PELANGGAN</th>
                        <th>NO SPA</th>
                        <th>BANDWIDTH</th>
                        <th>NO IO</th>
                        <th>PRODUCT</th>
                        <th>NO PI</th>

                    </tr>
                </thead>
                <tbody>
                    @if (isset($e))
                        @foreach ($e as $o)
                            <tr>
                                <td>{{ $o->new_IDPEL }}</td>
                                <td>{{ $o->no_pa }}</td>
                                <td>{{ $o->bandwidth }}</td>
                                <td>{{ $o->NOMOR_IO }}</td>
                                <td>{!! $o->Product !!}</td>
                                <td>{{ $o->no_pi }}</td>


                                {{-- @if ($loop->first != '')
                                        <b>-</b>
                                    @else
                                        <a href='/spa/update/{{ $o->new_IDPEL }}' class='btn btn-success'>NAIKAN PA</a>
                                    @endif --}}

                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <br>

        <script>
            $(document).ready(function() {
                $('#TabelSpa').DataTable({
                    processing: true,
                    lengthMenu: [
                        [5, 10, 25, 50, -1],
                        [5, 10, 25, 50, 'All']
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
