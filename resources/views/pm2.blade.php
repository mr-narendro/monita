@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">Pm2 Send PA CRM </h1>
            <hr>
            <br>
            <div class="row">
                <div class="col col-3">
                    <div class="row">
                        @csrf
                        @foreach ($status as $s)
                            <h6>{!! $s->isRunning !!}</h6>
                        @endforeach
                        <button class="button btn-sm btn-outline-success" name="reset" id="btn-reset">Reset</button>
                    </div>

                </div>




            </div>
        </div>
        <br>
        <script>
            $(document).ready(function() {
                $("#btn-reset").click(function() {
                    var res = confirm("Apakah anda yakin ingin reset???")
                    if (res) {
                        $.ajax({
                            type: "PUT",
                            url: "/pm2/send-pa-crm/updateStatus/",
                            headers:{
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                alert('Berhasil Reset');
                            },
                            error: function(response) {
                                alert('gagal cok...!!!');
                            }
                        });
                    } else {
                        return false;
                    }

                });
            });
        </script>
    </main>
@endsection
