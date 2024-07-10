<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cetak</title>
    <style>
        @media print {
            body {
                font-size: 12;
                margin: 0;
                font-family: Arial, sans-serif;
            }

            .header {
                display: flex;
                align-items: center;
                padding: 10px 20px;
                border-bottom: 1px solid #ddd;
            }

            .logo {
                height: 80px;
                margin-right: 20px;
                margin-left: 0;
            }

            .text-container {
                display: flex;
                flex-direction: column;
            }

            .title {
                font-size: 18px;
                color: #333;
                margin: 2px 0;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th {
                border: 1px solid #ddd;
                text-align: center;
                padding: 10px;
                background-color: #f0f0f0;
            }

            td {
                border: 1px solid #ddd;
                padding: 5px;
            }

            .ttd {
                text-align: right;
            }

            .ttd p {
                margin: 0;
            }

            #footer {
                position: fixed;
                bottom: 0;
                left: 0;
                width: 100%;
                background-color: #fff;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <img src="<?php echo base_url('public/assets/images/logo.png'); ?>" alt="Logo" class="logo">
        <div class="title-container">
            <h1 class="title">LAPORAN KEUANGAN</h1>
            <h1 class="title">YAYASAN MIFTAHUL IHSAN</h1>
            <h1 class="title">ERRABU BLUTO SUMENEP JAWA TIMUR</h1>
            <h1 class="title">
                TAHUN AJARAN <?php echo date("Y") . "/" . (date("Y") + 1); ?>
            </h1>
        </div>
    </header>
    <h4 align="center"></h4>


    <div class="table-responsive">
        <table>
            <thead align="center">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Uraian</th>
                    <th>Saldo Awal</th>
                    <th>Debit</th>
                    <th>Kredit</th>
                    <th>Saldo Akhir</th>
                </tr>
            </thead>
            <tbody align="center">
                <?php $no = 1;
                $saldo_awal = 0;
                $total_debit = 0;
                $total_kredit = 0;
                $saldo_akhir = $saldo_awal;
                foreach ($transaksi as $Transaksi) {
                    $saldo_awal = $saldo_akhir;
                    $debit =  $Transaksi->debit;
                    $kredit = $Transaksi->kredit;
                    $total_debit += $debit;
                    $total_kredit += $kredit;
                    $saldo_akhir = $saldo_awal + $debit - $kredit; ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $Transaksi->tanggal; ?></td>
                        <td><?php echo $Transaksi->uraian; ?></td>
                        <td>Rp.<?php echo number_format($saldo_akhir) ?></td>
                        <td>Rp.<?php echo number_format($debit) ?></td>
                        <td>Rp.<?php echo number_format($kredit) ?></td>
                        <td>Rp.<?php echo number_format($saldo_akhir) ?></td>
                    </tr>
                <?php } ?>
                <tr>
                    <th colspan="4" align="right">Total</th>
                    <td>Rp.<?php echo number_format($total_debit) ?></td>
                    <td>Rp.<?php echo number_format($total_kredit) ?></td>
                    <td>Rp.<?php echo number_format($saldo_akhir) ?></td>
                </tr>
            </tbody>
            </table=>
    </div>

    <br>
    <br>
    <b>Keterangan :</b>
    <p><i>Laporan keuangan persemester</i></p>

    <script>
        window.onload = function() {
            window.print();
            window.onafterprint = function() {
                window.history.back();
            };
        };
    </script>
</body>

</html>