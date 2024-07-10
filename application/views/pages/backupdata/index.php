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
<!-- isi konten -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div align="right">
                    <a href="<?php echo base_url('backupdata/backup'); ?>" class="btn btn-icon btn-sm btn-rounded waves-effect waves-light btn-purple"> <i class="fas fa-upload"></i> Backup Data </a>
                </div>
                <hr>
                <div class="table-responsive">
                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead align=center>
                            <tr>
                                <th>No</th>
                                <th>backupdata Database</th>
                                <th>Filepath</th>
                                <th>Created At</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody align=center>
                            <?php $no = 1;
                            foreach ($backup_history as $tahun) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $tahun['filename']; ?></td>
                                    <td>Edinburgh</td>
                                    <td>Edinburgh</td>
                                    <td>
                                        <a href="<?php echo base_url('backup/' . $tahun['filename']); ?>" class="btn btn-icon btn-sm btn-rounded waves-effect waves-light btn-warning"> <i class="fas fa-download"></i> </a>
                                        <!-- Tombol hapus -->
                                        <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light btn-sm" data-toggle="modal" data-target=".deleteData<?php echo $tahun['backup_id']; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                            <?php endforeach; ?>

                        </tbody>


                    </table>
                </div>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->
<!-- and isi konten -->


<?php $this->load->view('pages/backupdata/delete'); ?>

</div> <!-- container -->