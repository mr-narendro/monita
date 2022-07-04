@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Pm2 Send PA CRM </h1>
            <br>
            <div class="row">
                <div class="col col-3">
                    <div class="row">
                        @foreach ($status as $s)
                        <h6>Status : <span class="badge bg-danger">{{ $s->isRunning }}</span></h6>
                        <input type="text" name="id" value="{{ $s->id }}" id="id">
                        @endforeach
                        <button class="button btn-sm btn-success" name="reset" id="btn-reset">Reset</button>
                    </div>

                </div>




            </div>
        </div>
        <br>
        <script>
            $(document).ready(function() {
                $("#btn-reset").click(function(e) {
                    var id = $('#id').val()
                    e.preventDefault();
                    $.ajax({
                        type: "GET",
                        url: "/pm2/send-pa-crm/updateStatus/"+id,
                        success: function(response) {
                            alert('success');
                        },
                        error: function(response) {
                            alert('gagal cok...!!!');
                        }
                    });
                });
            });
        </script>
    </main>
@endsection
