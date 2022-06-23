@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Edit Status</h1>
            <hr>

            <form method="post" action="update" id="search-form" class="form-inline" role="form">
                @csrf
            @if (isset($data))
                @foreach ($data as $d)
                    <label for="idpel"><b>ID PELANGGAN</b></label>
                    <input type="text" name="idpel" id="idpel" value="{{ $d->CRMID }}" class="form-control form-control-inline" readonly>
                    <label for="status"><b>STATUS</b></label>
                    <input type="text" name="status" id="status" value="{{ $d->STATUS }}" class="form-control form-control-inline">
                @endforeach
            @endif
            <button type="submit" name="submit" onclick="confirm('Apakah anda yakin ???')" class="btn btn-success form-control-inline">UPDATE STATUS</button>
            </form>
            <hr>
        </div>
    </main>
@endsection
