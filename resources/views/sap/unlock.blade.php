@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">SAP - UNCLOCK USER</h1>
            <hr>


            <input type="text" name="username" id="username" placeholder="Masukan username SAP"
                class="form-control form-control-inline" required>
            <button type="submit" name="submit" id="cari" class="btn btn-info form-control-inline">
                Unlock
            </button>


            <br>
            <div class="container mt-5">
                <h1 id="status"></h1>
                <h3 id="message"></h3>
            </div>

        </div>
        <br>

        <script>
            $(document).ready(function() {
                $("#cari").click(function() {
                    var user = $("#username").val();
                    console.log("username :" + user)
                    var username = "integrasi"
                    var password = "1nts4p"
                    var res = confirm("Apakah anda yakin ingin unlock???")
                    if (res) {
                        $.ajax({
                            type: "POST",
                            contentType: "application/json",
                            url: "/sap/unlock/unlockUser",
                            data: {
                                'username': user,
                                'sap-client': 800
                            },
                            dataType: "json",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                alert('berhasil')
                            },
                            error: function(response) {
                                alert('gagal cok...!!!')
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
