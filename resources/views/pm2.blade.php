@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Pm2 Send PA CRM </h1>
            <br>
            <div class="row">
                <div class="col col-3">
                    <div class="row">
                        <h6>Status : <span class="badge bg-info">{{ $status }}</span></h6>
                        <button class="button btn-sm btn-success" id="btn-reset">Reset</button>
                    </div>

                </div>




            </div>
        </div>
        <br>
        <script>
            $(document).ready(function() {
                $("#btn-reset").click(function(e) {
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "/pm2/update/",
                        data: {
                            id: $(this).val(), // < note use of 'this' here
                            access_token: $("#access_token").val()
                        },
                        success: function(result) {
                            alert('ok');
                        },
                        error: function(result) {
                            alert('error');
                        }
                    });
                });
            });
        </script>
    </main>
@endsection
