@extends('layouts.main')

@section('container')
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <hr>

                @if ( session('name') == "Kiki")
                    <img src="{!! asset('img/kiki.jpg') !!}" width="80%" height="10%" >
                @endif

        </div>
    </main>
@endsection
