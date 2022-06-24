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
            <div class="alert alert-warning" role="alert">
               <b>NOTE :</b>
               <span>
                Apabila salah satu ID PELANGGAN sudah ada <b>NO SPA</b>,
                tidak perlu klik tombol naikan PA.
               </span>
            </div>
            <table id="TabelAntri" class="table table-striped table-hover" data-toggle="tooltip"
            title="Jangan klik tombol 'NAIKAN PA' apabila salah satu ID Pelanggan sudah ada NO SPA">
                <thead>
                    <tr>
                        <th>ID PELANGGAN</th>
                        <th>NO SPA</th>
                        <th>BANDWIDTH</th>
                        <th>CREATED ON</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($e))
                        @foreach ($e as $o)
                            <tr>
                                <td>{!! $o->new_IDPEL !!}</td>
                                <td>{{ $o->no_pa }}</td>
                                <td>{{ $o->bandwidth }}</td>
                                <td>{{ $o->CreatedOn }}</td>
                                <td>
                                    @if ($o->no_pa == "")
                                        <a href='/spa/update/{{ $o->new_IDPEL }}' class='btn btn-success'>NAIKAN PA</a>"
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
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
