<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?> - <?= $siswa->nama; ?></title>
    <style>
        @page {
            size: A4;
            margin: 10mm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.2;
            margin: 0;
            padding: 0;
            color: #000;
            font-size: 11pt;
        }
        #konten-surat {
            padding: 5mm;
            background: white;
        }
        .kop-surat {
            border-bottom: 3px double #000;
            padding-bottom: 5px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .kop-surat img {
            width: 70px;
            margin-right: 15px;
        }
        .kop-text {
            text-align: center;
            flex-grow: 1;
        }
        .kop-text h2, .kop-text h3, .kop-text p {
            margin: 0;
        }
        .kop-text h2 {
            text-transform: uppercase;
            font-size: 1.3rem;
        }
        .nomor-surat {
            margin-bottom: 10px;
        }
        .identitas-siswa {
            margin: 10px 0;
            padding-left: 20px;
        }
        .identitas-siswa table td {
            padding: 2px 0;
        }
        .tabel-riwayat {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .tabel-riwayat th, .tabel-riwayat td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            font-size: 10pt;
        }
        .tabel-riwayat th {
            background-color: #f2f2f2;
        }
        .footer-surat {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .ttd {
            text-align: center;
            width: 250px;
        }
        @media print {
            .no-print {
                display: none;
            }
            body { padding: 0; background: none; }
            #konten-surat { padding: 0; }
        }
        .btn-print {
            padding: 10px 20px;
            background: #fd7e14;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="no-print" style="background: #f8f9fa; padding: 15px; border-bottom: 1px solid #ddd; margin-bottom: 20px;">
        <button onclick="window.print()" class="btn-print" style="background: #6c757d;">Cetak Surat</button>
        <button id="download-pdf" class="btn-print" style="background: #fd7e14; margin-left: 5px;">Unduh PDF</button>
        <a href="<?= base_url('siswa'); ?>" style="text-decoration:none; color:#666; margin-left:15px; font-weight:bold;">Kembali</a>
    </div>

    <div id="konten-surat">
        <div class="kop-surat">
            <img src="https://ui-avatars.com/api/?name=SMA&background=000&color=fff" alt="Logo Sekolah">
            <div class="kop-text">
                <h2>SMA NEGERI 1 PRESTASI</h2>
                <p>Alamat: Jl. Pendidikan No. 123, Kota Pendidikan, 57362</p>
                <p>Email: info@sman1prestasi.sch.id | Website: www.sman1prestasi.sch.id</p>
            </div>
        </div>

        <div class="nomor-surat">
            <p>Nomor : 421.3 / <?= date('Y'); ?> / <?= rand(100, 999); ?> / SP-AKUMULASI</p>
            <p>Lampiran : 1 (Satu) Lembar Riwayat Pelanggaran</p>
            <p>Hal : <b>Pemanggilan Orang Tua Siswa (Akumulasi Poin)</b></p>
        </div>

        <p>Kepada Yth.<br>Orang Tua / Wali Murid dari <b><?= $siswa->nama; ?></b><br>di Tempat</p>

        <p>Assalamu’alaikum Wr. Wb.</p>

        <p>Melalui surat ini, kami memberitahukan bahwa putra/putri Bapak/Ibu telah mencapai ambang batas poin pelanggaran tata tertib sekolah. Berdasarkan catatan kami, berikut adalah rincian akumulasi poin yang bersangkutan:</p>

        <div class="identitas-siswa">
            <table>
                <tr>
                    <td width="150">Nama Siswa</td>
                    <td>: <b><?= $siswa->nama; ?></b></td>
                </tr>
                <tr>
                    <td>NISN</td>
                    <td>: <?= $siswa->nisn; ?></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: <?= $siswa->kelas; ?></td>
                </tr>
                <tr>
                    <td>Total Akumulasi Poin</td>
                    <td>: <b style="color:red; font-size: 14pt;"><?= $siswa->total_poin; ?> Poin</b></td>
                </tr>
            </table>
        </div>

        <p><b>Riwayat Pelanggaran Terakhir:</b></p>
        <table class="tabel-riwayat">
            <thead>
                <tr>
                    <th width="30">No</th>
                    <th width="80">Tanggal</th>
                    <th>Jenis Pelanggaran</th>
                    <th width="50">Poin</th>
                </tr>
            </thead>
            <tbody>
                <?php $no=1; foreach($riwayat as $r): ?>
                <tr>
                    <td style="text-align:center;"><?= $no++; ?></td>
                    <td><?= date('d/m/Y', strtotime($r->tanggal)); ?></td>
                    <td><?= $r->nama_pelanggaran; ?></td>
                    <td style="text-align:center;"><?= $r->poin; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p>Sehubungan dengan hal tersebut, kami mengharap kehadiran Bapak/Ibu di Sekolah untuk melakukan koordinasi dan pembinaan terhadap putra/putri Bapak/Ibu agar tidak terjadi pelanggaran lebih lanjut yang dapat merugikan siswa.</p>

        <p>Demikian surat ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</p>

        <p>Wassalamu’alaikum Wr. Wb.</p>

        <div class="footer-surat">
            <div class="ttd">
                <p>Boyolali, <?= date('d F Y'); ?></p>
                <p><?= ($this->session->userdata('role') == 'walikelas') ? 'Wali Kelas,' : (($this->session->userdata('role') == 'guru_bk') ? 'Guru BK,' : 'Administrator,'); ?></p>
                <br><br><br>
                <p><b><u><?= $this->session->userdata('nama_lengkap'); ?></u></b><br>NIP. ...........................</p>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            const element = document.getElementById('konten-surat');
            const options = {
                margin:       [10, 10, 10, 10],
                filename:     'Surat_Akumulasi_<?= str_replace(' ', '_', $siswa->nama); ?>.pdf',
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: 'avoid-all' }
            };
            html2pdf().set(options).from(element).save();
        });
    </script>
</body>
</html>
