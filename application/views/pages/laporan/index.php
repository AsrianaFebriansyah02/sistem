<!-- isi konten -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-3" align="left">
                    <select class="form-control" id="JenjangPendidikan">
                        <option align="center" value="">Pilih Jenjang Pendidikan</option>
                        <?php foreach ($jenjang_pendidikan as $jenjang) : ?>
                            <option value="<?php echo $jenjang['jenjang_pendidikan_id']; ?>">
                                <?php echo $jenjang['nama_jenjang_pendidikan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <hr>
                <div align="right">
                    <a href="<?php echo base_url('laporan/cetak') ?>" class="btn btn-icon btn-sm btn-rounded waves-effect waves-light btn-purple">
                        <i class="fas fa-print"></i> Data Transaksi
                    </a>
                </div>
                <hr>

                <!-- Tabel data -->
                <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive w-100 nowrap">
                    <thead align="center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Uraian</th>
                            <th>saldoawal</th>
                            <th>Debit</th>
                            <th>Kredit</th>
                            <th>saldo akhir</th>
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

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>
</div> <!-- end card body-->
</div> <!-- end card -->
</div><!-- end col-->
</div>
<!-- end row-->
<!-- and isi konten -->

<?php $this->load->view('pages/transaksi/add'); ?>
<?php $this->load->view('pages/transaksi/edit'); ?>

</div> <!-- container -->