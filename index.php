<?php
session_start();
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi Maps_11210110</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styling untuk form input dan tabel */
        #form_lokasi {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            /* Menambahkan spasi bawah pada form */
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

        /* Styling untuk kontainer utama */
        .container {
            margin-top: 40px;
            padding-bottom: 50px;
            /* Menambahkan padding di bawah container untuk spasi lebih */
        }

        /* Menambahkan margin di footer */
        footer {
            margin-top: 30px;
            /* Memberi jarak atas antara form dan footer */
            padding: 20px 0;
            background-color: #f8f9fa;
        }

        /* Styling untuk tabel */
        .styled-table {
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(231, 9, 9, 0.1);
            background-color: #fff;
        }

        .table thead {
            background: linear-gradient(135deg, #ff7f50, #ff6347);
            color: white;
        }

        .table tbody tr:hover {
            background-color: #f4f4f4;
            cursor: pointer;
        }

        /* Styling untuk tombol umum */
        button {
            background-color: #ff7f50;
            color: #fff;
            border-radius: 30px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #ff6347;
        }

        a {
            text-decoration: none;
            color: #FF0000;
            font-weight: bold;
        }

        a:hover {
            color: #FF9900;
        }

        ul {
            margin: 0px auto;
            padding: 0px 15px 0px 15px;
            list-style: square;
        }

        li {
            padding-left: 15px;
            padding: 0px 15px 0px 5px;
        }

        input,
        select {
            padding: 5px;
            border: 1px solid #FFFFFF;
            background-color: rgb(172, 99, 9);
        }

        input,
        button {
            border-radius: 7px;
            padding: 5px;
            border: 1px solid rgb(200, 224, 15);
            background-color: #DEB887;
        }

        button:hover {
            padding: 5px;
            border: 1px solid #FFFFFF;
            background-color: #A52A2A;
            cursor: pointer;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fb;
        }
    </style>


    <script type="text/javascript" src="https://maps.google.com/maps/api/js?key=AIzaSyBH3qFUd58QR6j--Z8V1Palp80gTVWcTKI"></script>
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript">
        var peta;
        var koorAwal = new google.maps.LatLng(-7.329579339811421, 108.2196256616021);

        function peta_awal() {
            loadDataLokasiTersimpan();
            var settingpeta = {
                zoom: 15,
                center: koorAwal,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
            peta = new google.maps.Map(document.getElementById("kanvaspeta"), settingpeta);
            google.maps.event.addListener(peta, 'click', function(event) {
                tandai(event.latLng);
            });
        }

        function tandai(lokasi) {
            $("#koorX").val(lokasi.lat());
            $("#koorY").val(lokasi.lng());
            tanda = new google.maps.Marker({
                position: lokasi,
                map: peta
            });
        }

        $(document).ready(function() {
            $("#simpanpeta").click(function() {
                var koordinat_x = $("#koorX").val();
                var koordinat_y = $("#koorY").val();
                var nama_tempat = $("#namaTempat").val();
                var status = $("#status").val();
                $.ajax({
                    url: "simpan_lokasi_baru.php",
                    data: "koordinat_x=" + koordinat_x + "&koordinat_y=" + koordinat_y + "&nama_tempat=" + nama_tempat + "&status=" + status,
                    success: function(msg) {
                        $("#namaTempat").val(null);
                    }
                });
            });
        });

        function loadDataLokasiTersimpan() {
            $('#kordinattersimpan').load('tampilkan_lokasi_tersimpan.php');
        }
        setInterval(loadDataLokasiTersimpan, 3000);

        function carikordinat(lokasi) {
            var settingpeta = {
                zoom: 15,
                center: lokasi,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };
            peta = new google.maps.Map(document.getElementById("kanvaspeta"), settingpeta);
            tanda = new google.maps.Marker({
                position: lokasi,
                map: peta
            });
            google.maps.event.addListener(tanda, 'click', function() {
                infowindow.open(peta, tanda);
            });
            google.maps.event.addListener(peta, 'click', function(event) {
                tandai(event.latLng);
            });
        }

        function gantipeta() {
            loadDataLokasiTersimpan();
            var isi = document.getElementById('cmb').value;
            var settingpeta = {
                zoom: 15,
                center: koorAwal,
                mapTypeId: google.maps.MapTypeId.HYBRID
            };

            if (isi == '2') settingpeta.mapTypeId = google.maps.MapTypeId.TERRAIN;
            if (isi == '3') settingpeta.mapTypeId = google.maps.MapTypeId.SATELLITE;
            if (isi == '4') settingpeta.mapTypeId = google.maps.MapTypeId.HYBRID;

            peta = new google.maps.Map(document.getElementById("kanvaspeta"), settingpeta);
            google.maps.event.addListener(peta, 'click', function(event) {
                tandai(event.latLng);
            });
        }

        // Perbaikan fungsi suggest (menghilangkan duplikasi)
        function suggest(inputString) {
            if (inputString.length == 0) {
                $('#suggestions').fadeOut();
            } else {
                $('#country').addClass('load');
                $.post("autosuggest.php", {
                    queryString: inputString
                }, function(data) {
                    if (data.length > 0) {
                        $('#suggestions').fadeIn();
                        $('#suggestionsList').html(data);
                        $('#country').removeClass('load');
                    }
                });
            }
        }

        function fill(thisValue) {
            $('#country').val(thisValue);
            setTimeout(function() {
                $('#suggestions').fadeOut();
            }, 600);
        }
    </script>
</head>

<body onLoad="peta_awal()">
    <div class="container">
        <div class="row">

<!-- Peta -->
<div class="col-lg-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Peta Lokasi</h5>

                        <div id="kanvaspeta" style="margin:0px auto; width:100%; height:630px; float:right; padding:10px;"></div>
                    </div>
                </div>
            </div>
            <!-- Form Lokasi -->
            <div class="col-lg-4">
                <div class="col-lg-12">
                    <div class="card" id="form_lokasi">
                        <div class="card-body">

                            <form id="form" action="#">
                                <div class="mb-3">
                                    <label for="country" class="form-label">Masukkan Nama Tempat:</label>
                                    <input type="text" class="form-control" id="country" placeholder="Nama Tempat"
                                        onkeyup="suggest(this.value);" onblur="fill(this.value);" />
                                    <!-- Div untuk menampilkan hasil pencarian -->
                                    <div class="suggestionsBox" id="suggestions" style="display: none;">
                                        <img src="arrow.png" style="position: relative; top: -12px; left: 30px;" alt="upArrow" />
                                        <div class="suggestionList" id="suggestionsList"> &nbsp; </div>
                                    </div>
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
                                    <button type="button" onclick="carikordinat(koorAwal);" class="btn btn-outline-secondary btn-koordinat">Koordinat Awal</button>
                                </div>
                            </form>
                        </div>
                        <div id=kordinattersimpan></div>
<!-- logout-->
<div class="container">
                <?php if ($is_logged_in) : ?>
                    <form align="center" method="POST" action="logout.php">
                        <input style="cursor: pointer; font-weight: bold" type="submit" class="btn btn-primary" name="logout" value="LOGOUT">
                    </form>
            </div>

                    </div>
                </div>
            </div>
            
            
        </div>
    </div>

    </div>
    </div>

<?php else : ?>
    <table width='80%' border='0'>
        <form method='POST' action='login.php'>
            <tr>
                <th colspan='2' align='center'>Login</th>
            </tr>
            <tr>
                <td><label for="user" class="form-label">Username</label></td>
                <td><input type="text" name="user" id="user" class="form-control" placeholder="Username"></td>
            </tr>
            <tr>
                <td><label for="pass" class="form-label">Password</label></td>
                <td><input type="password" name="pass" id="pass" class="form-control" placeholder="Password"></td>
            </tr>
            <tr>
                <th colspan='2' align='center'>
                    <input type='submit' class="btn btn-primary" name='tombol' value='OK'>
                </th>
            </tr>
            <?php if (isset($_SESSION['error_message'])) : ?>
                <tr>
                    <td colspan='2' align='center' style='color:blue'>
                        <?php echo $_SESSION['error_message'];
                        unset($_SESSION['error_message']); ?>
                    </td>
                </tr>
            <?php endif; ?>
        </form>
        
    </table>

<?php endif; ?>

</body>

</div> <!-- tutup div container -->
</div> <!-- tutup div row -->



</html>