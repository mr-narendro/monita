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
                    let user = $("[name=username]").val();
                    const formData = new FormData()
                    formData.append('user', user);
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
                                if(response.code == 200){
                                    alert('berhasil '+response.code)
                                }
                                let r = JSON.parse(response)


                                $('#status').text('Status : '+r.status)
                                $('#message').text('Message : '+r.message).css('color','blue')
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
