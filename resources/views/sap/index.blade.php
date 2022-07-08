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
            // function klik() {
            //     var io = document.getElementById("io").value;
            //     var username = 'integrasi';
            //     var password = '1nts4p';
            //     fetch("http://icndbpi1.iconpln.co.id:8000/sap/bc/zapi_check_io?sap-client=100&internal_order=" + io, {
            //             header: {
            //                 "Content-Type":"application/json; charset=utf-8",
            //                 "Authorization": "Basic " + btoa(username + ":" + password)
            //             }
            //         })
            //         .then((response) => response.json())
            //         .then((json) => console.log(json))
            // }

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
