<!DOCTYPE html>
<html>

<head>
    <title>Data Penerbitan Sertifikat</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        .heading {
            display: flex;
            width: 100%;
            justify-content: center;
        }

        .heading .gambar {
            display: flex;
            width: 100%;
            justify-content: center;
            text-align: center;
            font-size: 24px;
            line-height: 0%;
            color: black;
            font-weight: bold;
        }

        .heading .gambar img {
            width: 190px;
            height: 50px;
        }
    </style>
</head>

<body>
    <div class="heading">
        <div class="gambar">
            <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/img/logo-sigmaLight.png'))) }}"
                alt="Logo Sigma" width="80" height="50">
            <div class="heading-teks">
                <p>Sistem Informasi Kegiatan Magang (SIGMA)</p>
                <p>Data Penerbitan Sertifikat</p>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No Identitas</th>
                <th>Nama Lengkap</th>
                <th>Asal Instansi</th>
                <th>Posisi Pekerjaan</th>
                <th>Tanggal Magang</th>
                <th>No. Sertifikat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $document->no_identitas }}</td>
                    <td>{{ $document->user->nama_lengkap }}</td>
                    <td>{{ $document->instansi_asal }}</td>
                    <td>{{ $document->position->role }}</td>
                    <td>{{ convertDate($document->e_tgl_mulai) }} - {{ convertDate($document->e_tgl_selesai) }}</td>
                    <td>{{ $document->status->certificate->no_sertifikat ?? 'Sertifikat belum terbit' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
