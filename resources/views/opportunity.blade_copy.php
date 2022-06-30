@extends('layouts.main')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
@endsection
@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Opportunity</h1>
            <hr>

            <select name="type" id="type" class="form-select form-control-inline" required>
                <option value="ID_PELANGGAN">PLN ID</option>
                <option value="CRMID">CRM ID</option>
            </select>
            <input type="text" name="idpel" id="idpel" class="form-control form-control-inline" required>
            <button value="cari" id="cari" name="submit" class="btn btn-info form-control-inline">Cari
                Data
            </button>



            {{-- <p>
                @if (isset($e))
                    {{ $e }}
                @endif
            </p> --}}

        </div>
        <br>

        <div class="container px-4">
            <table id="TabelOpor" class="mt-50 table table-striped table-hover ">
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
                {{-- <tbody>
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
                </tbody> --}}
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

    </main>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"> --}}

    <script>
        $(document).ready(function() {
            $('#TabelOpor').DataTable({
                processing: true,

            });

            $('#cari').click(function() {
                searchIdPel($('#idpel').val(), $('#type').children("option:selected").val());
            })

            function searchIdPel(cariVal, typeVal) {
                let fd = new FormData();

                $('#TabelOpor').DataTable().clear().destroy();
                $('#TabelOpor').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '/opportunity/setData/' + cariVal,
                        method: 'POST',
                        data: {
                            type: typeVal
                        },
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    },
                    columns: [{
                            data: 'NAMA_PELANGGAN',
                            name: 'NAMA_PELANGGAN'
                        },
                        {
                            data: 'ORDERID',
                            name: ''
                        },
                        {
                            data: 'ID_PELANGGAN',
                            name: 'ID_PELANGGAN'
                        },
                        {
                            data: 'CRMID',
                            name: 'CRMID'
                        },
                        {
                            data: 'STATUS',
                            name: 'STATUS'
                        },
                        {
                            data: 'TGL_LUNAS',
                            name: 'TGL_LUNAS'
                        },
                        {
                            data: 'KODE_VA',
                            name: 'KODE_VA'
                        },
                        {
                            data: 'BATAL',
                            name: 'BATAL'
                        },
                        {
                            data: 'TGL_BATAL',
                            name: 'TGL_BATAL'
                        },
                    ]
                });
            }
        });
    </script>
@endpush
