<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap');
        
        body, table, td, h1, h2, p, a, span {
            font-family: 'Manrope', sans-serif !important;
        }
    </style>
</head>
<body style="margin:0;padding:0;background-color:#F5F5F5;font-family:'Manrope', sans-serif;">
    
    <table width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center" style="padding:40px 0;">
                
                <table width="600" cellpadding="0" cellspacing="0" style="background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.05);border: 1px solid #E5E5E5;">
                    <tr>
                        <td style="background:#8C1007;padding:30px;text-align:center;">
                            <h1 style="margin:0;color:#ffffff;font-size:24px;font-weight:600;letter-spacing:1px;">
                                GK - Santo Yusup Bintaran
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:40px;color:#333333;">
                            <h2 style="margin-top:0;margin-bottom:20px;color:#3E0703;font-size:20px;border-bottom: 2px solid #F5F5F5;padding-bottom:15px;">
                                {{ $title }}
                            </h2>

                            <table width="100%" cellpadding="0" cellspacing="0" style="font-size:15px;line-height:1.6;">
                                <tr>
                                    <td width="35%" style="padding:8px 0;color:#666;font-weight:600;">Nama Lengkap</td>
                                    <td style="padding:8px 0;color:#333;">: {{ $doa['nama'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#666;font-weight:600;">Nomor Telepon</td>
                                    <td style="padding:8px 0;color:#333;">: {{ $doa['nomor_telepon'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#666;font-weight:600;">Asal Paroki</td>
                                    <td style="padding:8px 0;color:#333;">: {{ $doa['asal_paroki'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#666;font-weight:600;">Asal Lingkungan</td>
                                    <td style="padding:8px 0;color:#333;">: {{ $doa['asal_lingkungan'] }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#666;font-weight:600;">Jenis Permohonan</td>
                                    <td style="padding:8px 0;color:#333;">: <span style="background-color:#FFF8F8;color:#8C1007;padding:2px 8px;border-radius:12px;font-size:12px;font-weight:600;text-transform:uppercase;">{{ $doa['jenis_permohonan'] }}</span></td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#666;font-weight:600;">Jadwal Misa</td>
                                    <td style="padding:8px 0;color:#333;">: {{ ucwords($doa['jadwal_misa']) }}</td>
                                </tr>
                                <tr>
                                    <td style="padding:8px 0;color:#666;font-weight:600;">Tanggal Intensi</td>
                                    <td style="padding:8px 0;color:#333;">: {{ \Carbon\Carbon::parse($doa['tanggal_intensi'])->translatedFormat('d F Y') }}</td>
                                </tr>
                            </table>

                            <div style="margin-top:25px;background-color:#FFF8F8;border-left: 4px solid #8C1007;padding:20px;border-radius:4px;">
                                <p style="margin:0 0 10px 0;font-weight:bold;color:#8C1007;font-size:14px;text-transform:uppercase;">Isi Doa / Intensi:</p>
                                <p style="margin:0;color:#444;font-style:italic;line-height:1.6;">
                                    "{{ $doa['isi_doa'] }}"
                                </p>
                            </div>

                            <div style="margin-top:40px;text-align:center;">
                                <a href="{{ url('/admin-doa') }}"
                                   style="display:inline-block;padding:14px 35px;
                                   background:#3E0703;color:#ffffff;
                                   text-decoration:none;border-radius:50px;
                                   font-weight:600;font-size:14px;transition:all 0.3s ease;">
                                    Lihat Permohonan di Admin Panel
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="background:#F9FAFB;padding:20px;text-align:center;font-size:12px;color:#9CA3AF;border-top:1px solid #E5E7EB;">
                            <p style="margin:0;">&copy; {{ date('Y') }} Gereja Katolik Santo Yusup Bintaran. All rights reserved.</p>
                        </td>
                    </tr>

                </table>

            </td>
        </tr>
    </table>

</body>
</html>
