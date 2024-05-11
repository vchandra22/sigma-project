<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            height: 100%;
            width: 100%;
            background-image: url('storage/img/background-certificate.png');
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            background-position: center;
        }

        .logo {
            margin-top: 80px;
        }

        .logo img {
            width: 210px;
            height: 70px;
        }

        .title {
            font-size: 48px;
            font-weight: bold;
            padding-top: 20px;
            color: #000000;
        }

        .recipient {
            font-size: 20px;
            color: #000000;
            padding-top: 10px;
        }

        .name {
            font-size: 36px;
            font-weight: bold;
            color: #000000;
        }

        .id {
            font-size: 24px;
            color: #000000;
        }

        .certificate_id {
            font-size: 12px;
            font-weight: bold;
            color: #000000;
        }

        .content {
            text-align: center;
            color: white;
        }

        .detail {
            text-size: 20px;
            color: #000000;
            padding-left: 180px;
            padding-right: 180px;
            padding-top: 20px;
        }

        .date {
            text-size: 20px;
            color: #000000;
            font-weight: bold;
            padding-left: 180px;
            padding-right: 180px;
            padding-top: 4px;
        }

        .ttd {
            text-size: 20px;
            color: #000000;
            margin-bottom: 90px;
            padding-left: 250px;
            padding-right: 250px;
            color: #000000;
            padding-top: 10px;
        }

        .kepala {
            text-size: 20px;
            color: #000000;
            font-weight: bold;
        }

        .nip {
            text-size: 20px;
            color: #000000;
        }

        .score-title {
            padding-top: 90px;
            font-size: 48px;
            font-weight: bold;
            color: #000000;
        }

        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            padding-left: 180px;
            padding-right: 180px;
            color: #000000;
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            background-color: #ffffff;
        }

        /* CSS for alternate row colors */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <div>
                <div class="logo">
                    <img src="{{ public_path('storage/img/logo-sigmaLight.png') }}" alt="Logo Sigma" width="80"
                        height="50">
                </div>
                @foreach ($userData as $data)
                    <div>
                        <div class="title">Certificate of Achievement</div>
                        <div class="certificate_id">Nomor Sertifikat: No. 0001/SIGMA/2024</div>
                        <div class="recipient">Diberikan Kepada:</div>
                        <div class="name">{{ $data->user->nama_lengkap }}</div>
                        <div class="id">{{ $data->no_identitas }}</div>
                        <div class="detail">telah melaksanakan Praktek Kerja Lapangan (On Job Training) di
                            {{ $data->office->nama_kantor }} sebagai {{ $data->position->role }}</div>
                        <div class="date">Terhitung mulai dari tanggal, <br> {{ $data->e_tgl_mulai }} -
                            {{ $data->e_tgl_selesai }}</div>
                        <div class="ttd">Blitar, 14 Mei 2024 <br> Kepala {{ $data->office->nama_kantor }}</div>
                        <div class="kepala">{{ $data->office->nama_kepala }}</div>
                        <div class="nip">NIP. {{ $data->office->nip_kepala }}</div>
                    </div>
                @endforeach
                <div class="score-title">Competency Result</div>
                <div>
                    <table>
                        <thead>
                            <tr>
                                <th class="judul-kompetensi">Uraian Kompetensi</th>
                                <th class="nilai-uji">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($scoreData as $item)
                                <tr>
                                    <td class="judul-kompetensi">{{ $item->judul_kompetensi }}</td>
                                    <td class="nilai-uji">{{ $item->nilai_uji }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <!-- Add more content here -->
</body>

</html>
