<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $pageTitle }}</title>
</head>
<style>
    table,
    th,
    td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
    }

    ;
</style>

<body style="font-family: Tahoma;">
    <div class="img" style="position: absolute; align-items: center; margin-left: 20px; margin-top: 38px; width: 100%">
        <img src="{{ URL::asset('frontend/assets/img/logo-sigma.png') }}" alt="Logo Sigma" width="176" height="71"
            title="Logo">
    </div>
    <div style="margin-top: 20px;">
        <div style="font-size: 18px; text-align: center; align-items: center;">
            <h2 style="padding-top: 18px; font-family: Tahoma; width: 380px; text-align: center; margin: auto;">
                Sistem Informasi Kegiatan Magang (SIGMA)
            </h2>
            <p style="font-size: 12px; font-weight: bold; width: 380px; text-align: center; margin: auto;">
                {{ $aboutData->alamat }}
            </p>
            <p style="font-size: 12px; font-weight: bold; width: 380px; text-align: center; margin: auto;">
                {{ $aboutData->no_telp }}
            </p>
            <p style="font-size: 12px; margin-top: -2px;">Website : <a
                    href="{{ Config::get('app.url') }}">{{ Config::get('app.url') }}</a>
            </p>
        </div>
    </div>
    <br>
    <hr style="border: 1px solid black;">
    <h3 style="text-align: center; margin-bottom: -4px;">Logbook Magang</h3>
    <div style="text-align: justify; text-align-last: center; font-size: 12px; margin-bottom: 22px;">
        <p style="margin-bottom: -4px;">Nama : {{ $userData->nama_lengkap ?? 'Tidak ada data' }}</p>
        <p style="margin-bottom: -4px;">Instansi Asal : {{ $userData->instansi_asal ?? 'Tidak ada data' }}</p>
        <p style="margin-bottom: -4px;">NIM/NISN : {{ $userData->no_identitas ?? 'Tidak ada data' }}</p>
        <p style="margin-bottom: -4px;">Jurusan/Bidang Keahlian : {{ $userData->jurusan ?? 'Tidak ada data' }}</p>
        <p>Tempat Magang : {{ $userData->office_id ?? 'Tidak ada data' }}</p>
    </div>
    <table>
        <thead style="background-color: gainsboro;">
            <tr>
                <th scope="col">
                    No.
                </th>
                <th scope="col">
                    Tanggal / Waktu
                </th>
                <th scope="col">
                    Rincian Kegiatan
                </th>
                <th scope="col">
                    Durasi
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalDiffTime = 0;
            @endphp
            @foreach ($logbookData as $row)
                <tr style="font-size: 12px">
                    <td>
                        {{ $loop->iteration }}
                    </td>
                    <td>
                        <p style="text-align: center;"> {{ convertDate($row->tgl_magang) ?? 'Tidak ada data' }} </p>
                        <p style="text-align: center;">
                            ({{ $row->jam_mulai }} - {{ $row->jam_selesai ?? 'Tidak ada data' }})
                        </p>
                    </td>
                    <td>
                        <p style="font-weight: bold; margin-bottom: -8px;"> Instansi:
                            {{ $row->office_id ?? 'Tidak ada data' }}
                        </p>
                        <p>
                            {{ strip_tags($row->topik_diskusi ?? 'Tidak ada data') }}
                        </p>
                        <p style="font-weight: bold; margin-bottom: -8px;"> Arahan pembimbing lapang </p>
                        <p>
                            {{ strip_tags($row->arahan_pembimbing ?? 'Tidak ada data') }}
                        </p>
                        <p style="font-weight: bold; margin-bottom: -8px;"> Bukti dukung (link) </p>
                        <a href="{{ $row->bukti ?? 'Tidak ada data' }}">
                            <p>
                                {{ strip_tags($row->bukti ?? 'Tidak ada data') }}
                            </p>
                        </a>
                    </td>
                    <td>
                        @php
                            $start_time = strtotime($row->jam_mulai);
                            $end_time = strtotime($row->jam_selesai);

                            $diff_seconds = $end_time - $start_time;
                            $diff_time = round($diff_seconds / 60);
                            $totalDiffTime += $diff_time;

                            echo $diff_time . ' menit';
                        @endphp
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: end; font-weight: bold; font-size: 12px">Total</td>
                <td style="text-align: start; font-weight: bold; font-size: 12px">
                    <b>
                        @php
                            $hours = floor($totalDiffTime / 60);
                            $minutes = $totalDiffTime % 60;

                            echo $hours . ' jam ' . $minutes . ' menit';
                        @endphp
                        ({{ $totalDiffTime }} menit)
                    </b>
                </td>
            </tr>
        </tfoot>
    </table>
    <br>
    <br>
    <br>
    <div style="position: absolute; float: left;">
        <p style="font-size: 12px; margin: 14px; text-align: center; margin-bottom: 80px;">Dosen/Guru Pembimbing
        </p>
        <p style="font-size: 12px; margin: 14px; text-align: center; font-weight: 700;">(____________________________)
        </p>
    </div>
    <div style="position: relative; float: right;">
        <p style="font-size: 12px; margin: 14px; text-align: center; margin-bottom: 80px;">Pembimbing Utama
        </p>
        <p style="font-size: 12px; margin: 14px; text-align: center; font-weight: 700;">(____________________________)
        </p>
    </div>
    <div style="clear: both;"></div>
    <div style="text-align: center; margin-top: 50px;">
        <p style="font-size: 12px; font-weight: 700;">Blitar,
            <span id='date-time'></span>
        </p>
        <p style="margin-top: -8px; margin-bottom: -2px;">Mengetahui,</p>
        <p style="margin-bottom: 80px; max-width: 250px; word-wrap: break-word; text-align: center; margin: auto;">
            Pimpinan {{ $aboutData->heading ?? ' ' }}</p>
        <p style="margin-top: 80px; margin-bottom: -4px;">{{ $aboutData->id ?? 'Tidak ada data' }}</p>
        <hr style="max-width: 240px; margin-bottom: 1px;">
        <p style="margin-top: 0px;">NIK/NIP: {{ $aboutData->id ?? 'Tidak ada data' }}</p>
    </div>
</body>
<script>
    arrbulan = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober",
        "November", "Desember"
    ];
    date = new Date();
    hari = date.getDay();
    tanggal = date.getDate();
    bulan = date.getMonth();
    tahun = date.getFullYear();
    document.getElementById('date-time').innerHTML += (tanggal + " " + arrbulan[bulan] + " " + tahun);
</script>

</html>
