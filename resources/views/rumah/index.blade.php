<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>
<body>
    <div class="container py-4">
        <h2 class="text-center fw-bold mb-4">PENDATAAN RUMAH TIDAK LAYAK HUNI</h2>

        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Alamat</th>
                    <th scope="col">Kelurahan</th>
                    <th scope="col">Kecamatan</th>
                    <th scope="col">Kondisi</th>
                    <th scope="col">Tahun Pendataan</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rumah as $item)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $item->alamat }}</td>
                        <td>{{ $item->kelurahan?->nama_kelurahan ?? '-' }}</td>
                        <td>{{ $item->kelurahan?->kecamatan?->nama_kecamatan ?? '-' }}</td>
                        <td>{{ $item->kondisi }}</td>
                        <td>{{ $item->tahun_pendataan }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data rumah</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>