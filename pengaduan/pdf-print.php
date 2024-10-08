<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../classes/classPengaduan.php';  

// Create an instance of your class
$hasil = new Produk\Pengaduan;
$pengaduan = $hasil->readPengaduan();

// Start building the HTML string for rendering the report
$render = '
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <table class="table table-bordered" id="pengaduanTable">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Bagian</th>
                <th class="text-center">Jabatan</th>
                <th class="text-center">Barang</th>
                <th class="text-center">Deskripsi</th>
                <th class="text-center">Tanggal Pengajuan</th>
                <th class="text-center">Status</th>
        </thead>
        <tbody>';

$i = 1;
foreach($pengaduan as $row) {
    // Handle the status
    $status = (!isset($row['status']) || $row['status'] == 'Belum Dikonfirmasi') ? 'Belum Dikonfirmasi' : 'Dikonfirmasi';

    $render .= '<tr>
        <td>' . $i++ . '</td>
        <td>' . htmlspecialchars($row['nama_pelapor']) . '</td>
        <td>' . htmlspecialchars($row['bagian_pelapor']) . '</td>
        <td>' . htmlspecialchars($row['jabatan_pelapor']) . '</td>
        <td>' . htmlspecialchars($row['barang_pengaduan']) . '</td>
        <td>' . htmlspecialchars($row['deskripsi_pengaduan']) . '</td>
        <td>' . htmlspecialchars($row['tanggal_pengaduan']) . '</td>
        <td>' . $status . '</td>
        ';

    $render .= '</td></tr>';
}

$render .= '
        </tbody>
    </table>';

// Initialize MPDF and write the HTML to PDF
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML('<h1>Laporan Pengaduan</h1>'); // Add a title
$mpdf->WriteHTML($render); // Pass the generated HTML with borders to mpdf
$mpdf->Output('pengaduan-report.pdf', \Mpdf\Output\Destination::INLINE); // Output the PDF directly
