<!DOCTYPE html>
<html>

<head>
    <title>Data Peserta</title>
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
                <p>Data Peserta</p>
            </div>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No Identitas</th>
                <th>Nama Lengkap</th>
                <th>Jenis Kelamin</th>
                <th>Asal Instansi</th>
                <th>Instansi Tujuan Magang</th>
                <th>Posisi Pekerjaan</th>
                <th>Tanggal Rencana</th>
                <th>Tanggal Disetujui</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documents as $document)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $document->user->document->no_identitas }}</td>
                    <td>{{ $document->user->nama_lengkap }}</td>
                    <td>{{ $document->user->jenis_kelamin }}</td>
                    <td>{{ $document->instansi_asal }}</td>
                    <td>{{ $document->office->nama_kantor }}</td>
                    <td>{{ $document->position->role }}</td>
                    <td>{{ convertDate($document->u_tgl_mulai) }} - {{ convertDate($document->u_tgl_selesai) }}</td>
                    @if ($document->e_tgl_mulai)
                        <td>{{ convertDate($document->e_tgl_mulai) }} - {{ convertDate($document->e_tgl_selesai) }}
                        </td>
                    @else
                        <td> - </td>
                    @endif
                    <td>{{ $document->status->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
