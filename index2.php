<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Map</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fb;
        }

        /* Styling untuk peta */
        #kanvaspeta {
            margin: 0px auto;
            width: 100%;
            height: 400px;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        /* Styling untuk form input dan tabel */
        #form_lokasi {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: bold;
        }

        /* Styling untuk tombol */
        #simpanpeta,
        .btn-koordinat {
            font-weight: bold;
        }

        .btn-koordinat {
            margin-top: 10px;
        }

        .container {
            margin-top: 40px;
        }
    </style>
</head>

<body onLoad="peta_awal()">

<body>
    <div class="container">
        <div class="row">
            <!-- Peta -->
            <div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peta Lokasi</h5>
                        <div id="kanvaspeta"></div>
                    </div>
                </div>
            </div>

            <!-- Form Lokasi -->
            <div class="col-lg-4">
                <div class="card" id="form_lokasi">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Lokasi</h5>
                        <form id="form" action="#">
                            <div class="mb-3">
                                <label for="country" class="form-label">Masukkan Nama Tempat:</label>
                                <input type="text" class="form-control" id="country" placeholder="Nama Tempat"
                                    onkeyup="suggest(this.value);" onblur="fill();">
                            </div>

                            <!-- Ganti Jenis Peta -->
                            <div class="mb-3">
                                <label for="cmb" class="form-label">Ganti Jenis Peta:</label>
                                <select id="cmb" class="form-select" onchange="gantipeta()">
                                    <option value="1">Peta Roadmap</option>
                                    <option value="2">Peta Terrain</option>
                                    <option value="3">Peta Satelite</option>
                                    <option value="4">Peta Hybrid</option>
                                </select>
                            </div>

                            <!-- Koordinat X -->
                            <div class="mb-3">
                                <label for="koorX" class="form-label">Koordinat X:</label>
                                <input type="text" class="form-control" id="koorX" readonly>
                            </div>

                            <!-- Koordinat Y -->
                            <div class="mb-3">
                                <label for="koorY" class="form-label">Koordinat Y:</label>
                                <input type="text" class="form-control" id="koorY" readonly>
                            </div>

                            <!-- Nama Lokasi -->
                            <div class="mb-3">
                                <label for="namaTempat" class="form-label">Nama Lokasi:</label>
                                <input type="text" class="form-control" id="namaTempat">
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="d-grid gap-2">
                                <button type="button" id="simpanpeta" class="btn btn-primary">Simpan</button>
                                <button type="button" onclick="javascript:carikordinat(koorAwal);" class="btn btn-outline-secondary btn-koordinat">Koordinat Awal</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-5 text-center">
            <p>&copy; 2025 Lokasi Map | All Rights Reserved</p>
        </footer>
    </div>

    <!-- Bootstrap JS & Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
    <script src="jquery.js"></script>

    <!-- Google Maps API -->
    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBH3qFUd58QR6j--Z8V1Palp80gTVWcTKI"></script>

    <script type="text/javascript">
        var map;

        // Koordinat awal peta
        var koorAwal = {lat: -7.329579339811421, lng: 108.2196256616021};

        // Inisialisasi peta
        function initMap() {
            map = new google.maps.Map(document.getElementById("kanvaspeta"), {
                center: koorAwal,
                zoom: 15,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        }

        // Panggil fungsi inisialisasi peta saat halaman dimuat
        window.onload = initMap;

        // Fungsi untuk menandai lokasi di peta
        function tandai(lokasi) {
            var marker = new google.maps.Marker({
                position: lokasi,
                map: map
            });

            $("#koorX").val(lokasi.lat());
            $("#koorY").val(lokasi.lng());
        }

        // Fungsi ganti jenis peta
        function gantipeta() {
            var mapType = document.getElementById("cmb").value;
            var mapTypeId;

            switch (mapType) {
                case '1':
                    mapTypeId = google.maps.MapTypeId.ROADMAP;
                    break;
                case '2':
                    mapTypeId = google.maps.MapTypeId.TERRAIN;
                    break;
                case '3':
                    mapTypeId = google.maps.MapTypeId.SATELLITE;
                    break;
                case '4':
                    mapTypeId = google.maps.MapTypeId.HYBRID;
                    break;
            }

            map.setMapTypeId(mapTypeId);
        }
    </script>
</body>

</html>
