@extends("layouts.main")

@section("container")
    <main>
        <div class="container px-4">
            <h1 class="mt-4">SAP - CEK IO</h1>
            <hr>


            <input type="text" name="io" id="io" placeholder="Masukan no io"
                class="form-control form-control-inline" required>
            <button type="submit" name="submit" id="cari" class="btn btn-info form-control-inline">Cek
                IO</button>


            <br>
            <div class="container mt-5">
                <h1 id="status"></h1>
                <h3 id="spa"></h3>
            </div>

        </div>
        <br>

        <script>
            $(document).ready(function(){
                $("#cari").click(function() {
                var io = $("#io").val();
                console.log("io :" + io)
                var username = "integrasi"
                var password = "1nts4p"

                  $.ajax({
                    type: "GET",
                    contentType: "application/json",
                    url: "sap/cek/"+io,
                    data:{
                        'sap-client':'100',
                        'internal-order': io
                    },
                    dataType: "json",
                    headers: {
                        "Authorization": "Basic " + btoa(username + ":" + password),
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if(response.code == 200){
                            var h = response.message.slice(56)
                            console.log(h);
                            $('#status').text('IO Tersedia')
                            $('#spa').text('SPA : '+h).css('color','salmon')
                        }else{
                            $('#status').text('IO Tidak Tersedia')
                            $('#spa').text('SPA : Gak ada nih boss !!!').css('color','magenta')


                        }
                    }
                });
                // if(200){
                //     alert('oke');
                // }else{
                //     alert('jancok');
                // }
            });
            });
        </script>
    </main>
@endsection
