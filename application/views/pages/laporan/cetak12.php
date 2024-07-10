<!-- Tabel data -->
<table id="scroll-horizontal-datatable" class="table table-striped dt-responsive w-100 nowrap">
    <thead align="center">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Uraian</th>
            <th>User</th>
            <th>Tahun Ajaran</th>
            <th>Jenis Transaksi</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody align="center">
        <?php $no = 1;
        $saldo_awal = 0;
        $saldo_akhir = $saldo_awal;
        foreach ($transaksi as $Transaksi) {
            $saldo_awal = $saldo_akhir;
            $debit =  $Transaksi->debit;
            $kredit = $Transaksi->kredit;
            $saldo_akhir = $saldo_awal + $debit - $kredit; ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $Transaksi->tanggal; ?></td>
                <td><?php echo $Transaksi->uraian; ?></td>
                <td><?php echo $Transaksi->role; ?></td>
                <td><?php echo $Transaksi->nama_tahun; ?></td>
                <td align="center">
                    <span class="badge badge-pill badge-<?php echo ($Transaksi->jenis_transaksi == 'debit') ? 'success' : 'danger'; ?> font-size-8"><?php echo $Transaksi->jenis_transaksi; ?></span>
                </td>
                <td>Rp.<?php echo number_format($Transaksi->nominal, 00); ?></td>

            </tr>
        <?php } ?>
    </tbody>
</table>