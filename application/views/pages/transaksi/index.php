<?php if ($this->session->flashdata('alert')) : ?>
    <!-- Menampilkan pemberitahuan -->
    <div id="alert">
        <?php echo $this->session->flashdata('alert'); ?>
    </div>
    <!-- Script untuk menghapus pemberitahuan setelah beberapa detik -->
    <script>
        setTimeout(function() {
            document.getElementById("alert").remove();
        }, <?php echo $this->session->flashdata('alert_timeout'); ?>);
    </script>
<?php endif; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h1><?php echo number_format($saldo->saldo) ?></h1>
                <!-- Tombol tambah data -->
                <div align="right">
                    <button type="button" class="btn btn-sm btn-rounded btn-purple waves-effect waves-light" data-toggle="modal" data-target="#addtransaksi"><i class="fas fa-plus"></i> Data Transaksi</button>
                </div>
                <hr>
                <!-- Tabel data -->
                <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive w-100 nowrap">
                    <thead align="center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Uraian</th>
                            <th>User</th>
                            <th>Tahun Ajaran</th>
                            <th>saldoawal</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>saldo akhir</th>
                            <th>Aksi</th>
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
                                    Rp .<?php echo number_format($saldo_awal); ?>
                                </td>
                                <td align="center">
                                    Rp .<?php echo number_format($debit); ?>
                                </td>
                                <td align="center">
                                    Rp .<?php echo number_format($kredit); ?>
                                </td>
                                <td>Rp.<?php echo number_format($saldo_akhir); ?></td>
                                <td align="center">
                                    <!-- Tombol edit -->
                                    <!-- <button type="button" class="btn btn-warning btn-sm btn-rounded waves-effect waves-light" data-toggle="modal" data-target=".transaksi<?php echo $Transaksi->transaksi_id; ?>">
                                        <i class="fas fa-edit"></i>
                                    </button> -->
                                    <!-- Tombol hapus -->
                                    <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light btn-sm" data-toggle="modal" data-target=".deletetransaksi<?php echo $Transaksi->transaksi_id; ?>">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>

</div> <!-- container -->
<!-- Memuat view tambah -->
<?php $this->load->view('pages/transaksi/add'); ?>
<!-- Memuat view edit -->
<?php $this->load->view('pages/transaksi/t'); ?>
<!-- Memuat view delete -->
<?php $this->load->view('pages/transaksi/delete'); ?>