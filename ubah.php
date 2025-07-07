<?php
session_start();
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'];

include('koneksi.php');
$id = $_GET['nomor'];

if ($is_logged_in) {
    $lokasi = mysqli_query($conn, "SELECT * FROM kordinat_gis WHERE nomor=$id");
} else {
    // Handle jika user tidak logged in
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fb;
            margin: 0;
            padding: 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th {
            background-color: #f2f2f2;
            padding: 10px;
            font-size: 16px;
            text-align: center;
        }
        td {
            padding: 10px;
            text-align: left;
        }
        .form-control {
            background-color: rgb(172, 99, 9);
            border: 1px solid #FFFFFF;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"].btn-primary {
            background-color: #ff7f50;
            color: #fff;
            border-radius: 30px;
            padding: 10px 20px;
            cursor: pointer;
            border: none;
        }
        input[type="submit"].btn-primary:hover {
            background-color: #ff6347;
        }
        .form-label {
            font-weight: bold;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <form method="POST" action="">
        <table border="1">
            <tbody>
                <tr>
                    <th colspan="2">UBAH DATA</th>
                </tr>
                <?php while ($koor = mysqli_fetch_array($lokasi)) { ?>
                    <tr>
                        <td><label for="nama_tempat" class="form-label">Nama Tempat</label></td>
                        <td>: <input type="text" id="nama_tempat" name="nama_tempat" class="form-control" value="<?php echo $koor['nama_tempat']; ?>"></td>
                    </tr>
                    <tr>
                        <td><label for="status" class="form-label">Status</label></td>
                        <td>: 
                            <input type="radio" id="status" name="status" value="1" <?php if ($koor['status'] == 1) echo 'checked'; ?>> Tampil
                            <input type="radio" id="status" name="status" value="0" <?php if ($koor['status'] == 0) echo 'checked'; ?>> Tidak Tampil 
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="2"><input type="submit" value="OK" name="ubah" class="btn-primary"></th>
                </tr>
            </tbody>
        </table>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ubah'])) {
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $nama_tempat = mysqli_real_escape_string($conn, $_POST['nama_tempat']);

        // Eksekusi query update
        $ubah = mysqli_query($conn, "UPDATE kordinat_gis SET status='$status', nama_tempat='$nama_tempat' WHERE nomor='$id'");

        if ($ubah) {
            echo "<script>alert('Data berhasil diubah.'); window.close();</script>";
        } else {
            echo "<p>Gagal mengubah data: " . mysqli_error($conn) . "</p>";
        }
    }
    ?>

</body>
</html>
