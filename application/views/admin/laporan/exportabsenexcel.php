<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
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
    header("Content-Disposition: attachment; filename=" . $title . ".xls");
    ?>

    <center>
        <h1><?= $title ?></h1>
    </center>

    <table border="1">
        <tr>
            <th>Nomor</th>
            <th>Nama</th>
            <th>Nomor Pegawai</th>
            <th>Tanggal Masuk</th>
            <th>Jam Masuk</th>
            <th>Jam Pulang</th>
        </tr>
        <?php $no = 1;
        foreach ($data as $data) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $data['nama_pegawai'] ?></td>
                <td><?= $data['nomor_pegawai'] ?></td>
                <td><?= $data['tanggal_masuk'] ?></td>
                <td><?= $data['jam_masuk'] ?></td>
                <td><?= $data['jam_keluar'] ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>