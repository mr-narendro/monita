@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Edit SPA Staging</h1>
            <hr>

            <form method="POST" action="/staging/update" id="search-form" class="form-inline" role="form">
                @csrf
                @if (isset($e))
                    @foreach ($e as $d)
                        <label for="no_pa"><b>No PA</b></label>
                        <input style="width:20%;" type="text" name="NO_PA" id="no_pa" value="{{ $d->NO_PA }}"
                            class="form-control form-control-inline mb-2" readonly>
                        <button type="submit" name="submit" onclick="confirm('Apakah anda yakin ???')"
                            class="btn btn-success form-control-inline">UPDATE</button><br>
                        <label for="address"><b>ADDRESS</b></label>
                        <input style="width:80%;" type="text" name="ADDRESS" id="address" value="{{ $d->ADDRESS }}"
                            class="form-control mb-2">
                        <label for="satuan"><b>SATUAN</b></label>
                        <input style="width:80%;" type="text" name="SATUAN" id="satuan" value="{{ $d->SATUAN }}"
                            class="form-control mb-2">
                        <label for="lat_long"><b>LAT LONG</b></label>
                        <input style="width:80%;" type="text" name="LAT_LONG" id="lat_long" value="{{ $d->LAT_LONG }}"
                            class="form-control mb-2">
                        <label for="layanan"><b>PRODUK</b></label>
                        <input style="width:80%;" type="text" name="LAYANAN" id="layanan" value="{{ $d->LAYANAN }}"
                            class="form-control mb-2">
                    @endforeach
                @endif
            </form>
            <hr>
        </div>
    </main>
@endsection
