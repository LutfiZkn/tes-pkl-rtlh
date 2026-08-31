<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Rumah</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 5px;
            border: 1px solid #000;
        }

        th {
            text-align: center;
            background-color: #ffffff;
        }
    </style>

</head>
<body>
    <h2>LAPORAN DATA RUMAH TIDAK LAYAK HUNI</h2>

    <table>
        <thead>
            <tr>
                <th>Nama Pemilik</th>
                <th>NIK</th>
                <th>Alamat</th>
                <th>Kelurahan</th>
                <th>Kecamatan</th>
                <th>Kondisi</th>
                <th>Tahun</th>
                <th>Status Verifikasi</th>
                <th>Keterangan</th>
            </tr>
        </thead>

        <tbody>
            @foreach($rumah as $item)
                <tr>
                    <td>{{ $item->nama_pemilik }}</td>
                    <td>{{ $item->nik }}</td>
                    <td>{{ $item->alamat }}</td>
                    <td>{{ $item->kelurahan?->nama_kelurahan ?? '-' }}</td>
                    <td>{{ $item->kelurahan?->kecamatan?->nama_kecamatan ?? '-' }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->tahun_pendataan }}</td>
                    <td>{{ $item->status_verifikasi }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>