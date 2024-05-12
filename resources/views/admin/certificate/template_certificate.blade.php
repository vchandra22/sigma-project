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
            background-image: url('data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/img/background-certificate.png'))) }}');
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
                    {{-- <a href="https://ibb.co/zPnK9H8"><img src="https://i.ibb.co/JrBX6Fx/logo-sigma-Light.png" alt="logo-sigma-Light" border="0"></a> --}}
                    <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('storage/img/logo-sigmaLight.png'))) }}" alt="Logo Sigma" width="80"
                    height="50">
                </div>
                @foreach ($userData as $data)
                    <div>
                        <div class="title">Certificate of Achievement</div>
                        <div class="certificate_id">Nomor Sertifikat:
                            {{ $data->status->certificate->no_sertifikat ?? 'No Certificate' }}</div>
                        <div class="recipient">Diberikan Kepada:</div>
                        <div class="name">{{ $data->user->nama_lengkap }}</div>
                        <div class="id">{{ $data->no_identitas }}</div>
                        <div class="detail">telah melaksanakan Praktek Kerja Lapangan (On Job Training) sebagai
                            {{ $data->position->role }} di
                            {{ $data->office->nama_kantor }}</div>
                        <div class="date">Terhitung mulai dari tanggal, <br> {{ convertDate($data->e_tgl_mulai) }} -
                            {{ convertDate($data->e_tgl_selesai) }}</div>
                        <div class="ttd">Blitar,
                            {{ Carbon\Carbon::now()->locale('id_ID')->isoFormat('D MMMM YYYY') }} <br> Kepala
                            {{ $data->office->nama_kantor }}</div>
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
