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
                <!-- Tombol tambah data -->
                <div align="right">
                    <button type="button" class="btn btn-sm btn-rounded btn-purple waves-effect waves-light" data-toggle="modal" data-target="#addsantri"><i class="fas fa-plus"></i> Data Jenjang Pendidikan</button>
                </div>
                <hr>
                <!-- Tabel data -->
                <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive w-100 nowrap">
                    <thead align="center">
                        <tr>
                            <th>No</th>
                            <th>Tahun Ajaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php if ($tahun_ajaran) : $no = 1;
                            usort($tahun_ajaran, function ($a, $b) {
                                return strcmp($b->tahun_ajaran_id, $a->tahun_ajaran_id);
                            });
                            foreach ($tahun_ajaran as $tahun) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tahun->nama_tahun; ?></td>
                                    <td align="center">
                                        <span class="badge badge-pill badge-<?php echo ($tahun->status == 'aktif') ? 'success' : 'danger'; ?> font-size-8"><?php echo $tahun->status; ?></span>
                                    </td>
                                    <td align="center">
                                        <!-- Tombol edit -->
                                        <button type="button" class="btn btn-warning btn-sm btn-rounded  waves-effect waves-light" data-toggle="modal" data-target=".tahunajaran<?php echo $tahun->tahun_ajaran_id; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Tombol hapus -->
                                        <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light btn-sm" data-toggle="modal" data-target=".deletetahunajaran<?php echo $tahun->tahun_ajaran_id; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <!-- Tampilan jika tidak ada data tahun ajaran -->
                            <tr>
                                <td colspan="4" align="center">Tidak ada data tahun ajaran.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>

<!-- Memuat view tambah -->
<?php $this->load->view('pages/ajaran/add'); ?>
<!-- Memuat view edit -->
<?php $this->load->view('pages/ajaran/edit'); ?>
<!-- Memuat view delete -->
<?php $this->load->view('pages/ajaran/delete'); ?>
</div> <!-- container -->