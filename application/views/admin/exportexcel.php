<!DOCTYPE html>
<html>

<head>
    <title>Export Data Ke Excel Dengan PHP</title>
</head>

<body>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        table {
            margin: 20px auto;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #3c3c3c;
            padding: 3px 8px;

        }

        a {
            background: blue;
            color: #fff;
            padding: 8px 10px;
            text-decoration: none;
            border-radius: 2px;
        }
    </style>

    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=Data Pegawai.xls");
    ?>

    <center>
        <h1>Data Pegawai</h1>
    </center>

    <table border="1">
        <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Tanggal Lahir</th>
            <th>Tempat Lahir</th>
            <th>Agama</th>
            <th>Jenis Kelamin</th>
            <th>Nomor Pegawai</th>
            <th>Kontak</th>
            <th>Email</th>
            <th>Alamat</th>
        </tr>
        <?php $no = 1;
        foreach ($pegawai as $data) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['nama_pegawai'] ?></td>
                <td><?= $data['tanggal_lahir_pegawai'] ?></td>
                <td><?= $data['tempat_lahir_pegawai'] ?></td>
                <td><?= $data['agama'] ?></td>
                <td><?= $data['jeniskelamin'] ?></td>
                <td><?= $data['nomor_pegawai'] ?></td>
                <td><?= $data['nomor_hp_pegawai'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['alamat'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>