<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?> - <?= $p->nama; ?></title>
    <style>
        @page {
            size: A4;
            margin: 15mm;
        }
        body {
            font-family: 'Times New Roman', Times, serif;
            line-height: 1.3; /* Lebih rapat */
            margin: 0;
            padding: 0;
            color: #000;
            font-size: 12pt;
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
            width: 70px; /* Sedikit lebih kecil */
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
        .footer-surat {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }
        .ttd {
            text-align: center;
            width: 250px;
        }
        .ttd br {
            content: "";
            margin: 5px 0;
            display: block;
        }
        @media print {
            .no-print {
                display: none;
            }
            body {
                padding: 0;
                background: none;
            }
            #konten-surat {
                padding: 0;
            }
        }
        .btn-print {
            padding: 10px 20px;
            background: #fd7e14;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="no-print" style="background: #f8f9fa; padding: 15px; border-bottom: 1px solid #ddd; margin-bottom: 30px;">
        <button onclick="window.print()" class="btn-print" style="background: #6c757d;">Cetak Surat Sekarang</button>
        <button id="download-pdf" class="btn-print" style="background: #fd7e14; margin-left: 5px;">Unduh PDF (Simpan)</button>
        <a href="<?= base_url('pelanggaran'); ?>" style="text-decoration:none; color:#666; margin-left:15px; font-weight:bold;">Kembali</a>
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
        <p>Nomor : 421.3 / <?= date('Y'); ?> / <?= rand(100, 999); ?> / SP</p>
        <p>Lampiran : -</p>
        <p>Hal : <b>Pemanggilan Orang Tua Siswa</b></p>
    </div>

    <p>Kepada Yth.<br>Orang Tua / Wali Murid dari <b><?= $p->nama; ?></b><br>di Tempat</p>

    <p>Assalamu’alaikum Wr. Wb.</p>

    <p>Dengan hormat, sehubungan dengan adanya tindakan pelanggaran tata tertib sekolah yang dilakukan oleh putra/putri Bapak/Ibu, maka kami mengharap kehadiran Bapak/Ibu pada:</p>

    <div class="identitas-siswa">
        <table>
            <tr>
                <td width="150">Nama Siswa</td>
                <td>: <b><?= $p->nama; ?></b></td>
            </tr>
            <tr>
                <td>NISN</td>
                <td>: <?= $p->nisn; ?></td>
            </tr>
            <tr>
                <td>Kelas</td>
                <td>: <?= $p->kelas; ?></td>
            </tr>
            <tr>
                <td>Pelanggaran Terakhir</td>
                <td>: <i><?= $p->nama_pelanggaran; ?></i></td>
            </tr>
            <tr>
                <td>Akumulasi Poin</td>
                <td>: <b style="color:red;"><?= $p->total_poin; ?> Poin</b></td>
            </tr>
        </table>
    </div>

    <?php 
        $pesan = "";
        if ($p->poin >= 25) {
            $pesan = "Pemanggilan ini bersifat mendesak dikarenakan siswa melakukan <b>Pelanggaran Berat</b> yang memerlukan pembinaan khusus segera.";
        } else if ($p->total_poin >= 100) {
            $pesan = "Pemanggilan ini merupakan <b>Peringatan Ketiga (SP3)</b> dikarenakan akumulasi poin pelanggaran telah mencapai ambang batas maksimal (100 poin).";
        } else if ($p->total_poin >= 75) {
            $pesan = "Pemanggilan ini merupakan <b>Peringatan Kedua (SP2)</b> dikarenakan akumulasi poin pelanggaran telah mencapai 75 poin.";
        } else {
            $pesan = "Pemanggilan ini merupakan <b>Peringatan Pertama (SP1)</b> dikarenakan akumulasi poin pelanggaran telah mencapai 50 poin.";
        }
    ?>

    <p><?= $pesan; ?></p>

    <p>Demikian surat pemanggilan ini kami sampaikan, atas perhatian dan kerjasama Bapak/Ibu kami ucapkan terima kasih.</p>

    <p>Wassalamu’alaikum Wr. Wb.</p>

    <div class="footer-surat">
        <div class="ttd">
            <p>Boyolali, <?= date('d F Y'); ?></p>
            <p><?= ($this->session->userdata('role') == 'walikelas') ? 'Wali Kelas,' : (($this->session->userdata('role') == 'guru_bk') ? 'Guru BK,' : 'Administrator,'); ?></p>
            <br><br><br>
            <p><b><u><?= $this->session->userdata('nama_lengkap'); ?></u></b><br>NIP. ...........................</p>
        </div>
    </div>

    <!-- Script PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('download-pdf').addEventListener('click', function() {
            const element = document.getElementById('konten-surat');
            const options = {
                margin:       10,
                filename:     'Surat_Pemanggilan_<?= str_replace(' ', '_', $p->nama); ?>.pdf',
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 3, letterRendering: true, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
            };

            // Menjalankan konversi PDF
            html2pdf().set(options).from(element).save();
        });
    </script>
</body>
</html>
