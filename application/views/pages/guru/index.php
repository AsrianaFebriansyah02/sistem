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
                    <button type="button" class="btn btn-sm btn-rounded btn-purple waves-effect waves-light" data-toggle="modal" data-target="#addguru"><i class="fas fa-plus"></i> Data Guru</button>
                </div>
                <hr>
                <!-- Tabel data -->
                <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive w-100 nowrap">
                    <thead align="center">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NIY</th>
                            <th>Jenis Kelamin</th>
                            <th>Tanggal Lahir</th>
                            <th>Alamat</th>
                            <th>Jenjang Pendidikan</th>
                            <th>Jabatan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php if ($guru) : $no = 1;
                            usort($guru, function ($a, $b) {
                                return strcmp($b->guru_id, $a->guru_id);
                            });
                            foreach ($guru as $Guru) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $Guru->nama_guru; ?></td>
                                    <td><?php echo $Guru->niy_guru; ?></td>
                                    <td><?php echo $Guru->jenis_kelamin; ?></td>
                                    <td><?php echo $Guru->tanggal_lahir; ?></td>
                                    <td><?php echo $Guru->alamat; ?></td>
                                    <td><?php echo $Guru->nama_jenjang_pendidikan; ?></td>
                                    <td><?php echo $Guru->jabatan; ?></td>
                                    <td align="center">
                                        <span class="badge badge-pill badge-<?php echo ($Guru->status == 'aktif') ? 'success' : 'danger'; ?> font-size-8"><?php echo $Guru->status; ?></span>
                                    </td>
                                    <td align="center">
                                        <!-- Tombol edit -->
                                        <button type="button" class="btn btn-primary btn-sm btn-rounded  waves-effect waves-light" data-toggle="modal" data-target=".adduser<?php echo $Guru->guru_id; ?>">
                                            <i class="fas fa-user"></i>
                                        </button>
                                        <!-- Tombol edit -->
                                        <button type="button" class="btn btn-warning btn-sm btn-rounded  waves-effect waves-light" data-toggle="modal" data-target=".editguru<?php echo $Guru->guru_id; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <!-- Tombol hapus -->
                                        <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light btn-sm" data-toggle="modal" data-target=".deleteguru<?php echo $Guru->guru_id; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <!-- Tampilan jika tidak ada data guru -->
                            <tr>
                                <td colspan="9" align="center">Tidak ada data guru.</td>
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
<?php $this->load->view('pages/guru/add'); ?>
<!-- Memuat view edit -->
<?php $this->load->view('pages/guru/edit'); ?>
<!-- Memuat view delete -->
<?php $this->load->view('pages/guru/delete'); ?>
<?php $this->load->view('pages/guru/adduser'); ?>
</div> <!-- container -->