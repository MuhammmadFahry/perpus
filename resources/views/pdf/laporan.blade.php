<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Buku</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h3>History Buku yang Sedang Dipinjam</h3>
    <table>
        <thead>
            <tr>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historysemuanya as $history)
                <tr>
                    <td>{{ $history->book?->title ?? 'Data tidak tersedia' }}</td>
                    <td>{{ $history->user?->name ?? 'Data tidak tersedia' }}</td>
                    <td>{{ $history->tanggal_dipinjam ?? 'Data tidak tersedia' }}</td>
                    <td>{{ $history->created_at?->format('d M Y') ?? 'Data tidak tersedia' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
