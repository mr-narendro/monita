@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Opportunity</h1>
            <hr>

            <form method="POST" action="/opportunity" id="search-form" class="form-inline" role="form">
                @csrf
                <select name="id" class="form-select form-control-inline" required>
                    <option value="idpln">PLN ID</option>
                    <option value="crmid">CRM ID</option>
                </select>
                <input type="text" name="idpel" id="" class="form-control form-control-inline" required>
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
                </thead>
                <tbody>
                    @if (isset($e))
                        @foreach ($e as $o)
                            <tr>
                                <td>
                                    {{ $o->NAMA_PELANGGAN }}
                                </td>
                                <td>
                                    {{ $o->ORDERID }}
                                </td>
                                <td>
                                    {{ $o->ID_PELANGGAN }}
                                </td>
                                @php
                                    $status = $o->STATUS;
                                @endphp
                                @if ($status == 0)
                                    <td>
                                        <a href="/antrian/{{ $o->CRMID }}">{{ $o->CRMID }}</a>
                                    </td>
                                    <td data-toggle='tooltip' title='Silahkan cek antrian'>
                                        <b>{{ $status }}</b>
                                    </td>
                                @elseif ($status == 1)
                                    <td>
                                        <a href="/spa/getData/{{ $o->CRMID }}">{{ $o->CRMID }}</a>
                                    </td>
                                    <td data-toggle='tooltip' title='Silahkan cek di crm'>
                                        <b>{{ $status }}</b>
                                    </td>

                                @elseif ($status == 2)
                                    <td>
                                       {!! $o->CRMID !!}
                                    </td>
                                    <td data-toggle='tooltip' title='Pelanggan belum membayar'>
                                        <b>{{ $status }}</b>
                                    </td>
                                @else
                                    <td>{{ $o->CRMID }}</td>
                                    <td>{{ $status }}</td>
                                @endif

                                <td>
                                    {{ $o->TGL_LUNAS }}
                                </td>
                                <td>
                                    {{ $o->KODE_VA }}
                                </td>
                                <td>
                                    {{ $o->BATAL }}
                                </td>
                                <td>
                                    {{ $o->TGL_BATAL }}
                                </td>
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
