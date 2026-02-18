<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kode Verifikasi Admin GKSYB</title>
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
                        <td style="padding:40px;color:#333333;text-align:center;">
                            <h2 style="margin-top:0;margin-bottom:20px;color:#3E0703;font-size:22px;">
                                Kode Verifikasi Anda
                            </h2>

                            <p style="font-size:15px;line-height:1.6;color:#666;margin-bottom:30px;">
                                Gunakan kode di bawah ini untuk memverifikasi perubahan data akun Anda. Jangan berikan kode ini kepada siapapun.
                            </p>

                            <div style="background-color:#FFF8F8;border: 2px dashed #8C1007;padding:20px 40px;border-radius:12px;display:inline-block;margin-bottom:30px;">
                                <span style="font-size:32px;font-weight:700;color:#8C1007;letter-spacing:5px;user-select:all;-webkit-user-select:all;cursor:pointer;">
                                    {{ $code }}
                                </span>
                            </div>

                            <p style="font-size:13px;color:#999;margin-top:10px;">
                                Kode ini akan kadaluarsa dalam 15 menit.
                            </p>

                             <p style="font-size:14px;color:#333;margin-top:30px;padding-top:20px;border-top:1px solid #eee;">
                                Jika Anda tidak merasa melakukan permintaan ini, segera hubungi Admin Paroki atau abaikan pesan ini.
                            </p>
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
