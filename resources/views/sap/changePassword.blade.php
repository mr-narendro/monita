@extends('layouts.main')

@section('container')
    <main>
        <div class="container px-4">
            <h1 class="mt-4">SAP - CHANGE PASSWORD USER</h1>
            <hr>


            <input type="text" name="username" id="username" placeholder="Masukan username SAP"
                class="form-control form-control-inline" required>
            <input type="text" name="password" id="password" placeholder="Masukan Password Baru"
                class="form-control form-control-inline" required>
            <button type="submit" name="submit" id="cari" class="btn btn-info form-control-inline">
                Change
            </button>


            <br>
            <div class="container mt-5">
                <h3 id="status"></h3>
                <h3 id="message"></h3>
            </div>

        </div>
        <br>

        <script>
            $(document).ready(function() {
                $("#cari").click(function() {
                    let user = $("[name=username]").val();
                    let pass = $("[name=password]").val();
                    const formData = new FormData()
                    formData.append('user', user);
                    formData.append('pass', pass);
                    console.log("username :" + user)
                    var username = "integrasi"
                    var password = "1nts4p"
                    var res = confirm("Apakah anda yakin ingin unlock???")
                    if (res) {
                        $.ajax({
                            type: "POST",
                            url: "/sap/unlock/unlockUser",
                            data: formData,
                            processData: false,
                            contentType: false,
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $('#status').text('Status : '+response.status)
                                $('#message').text('Message : '+response.message)
                            },
                            error: function(response) {
                                alert('gagal')
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
