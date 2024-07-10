<?php foreach ($tahun_ajaran as $tahun) { ?>
    <!-- add modal -->
    <div class="modal fade deletetahunajaran<?php echo $tahun->tahun_ajaran_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert" align="center">
                        <b>Yakin </b>ingin mengpaus data <span class="badge badge-pill badge-primary font-size-8"><?php echo $tahun->nama_tahun; ?></span> ? <br>
                        <b>Perhatian!</b> Penghapusan data akan secara otomatis menghapus data lain yang memiliki hubungan pada <b>administrasi</b>.
                    </div>
                    <form action="<?php echo site_url('ajaran/delete'); ?>" method="post">
                        <div class="form-group">
                            <input type="hidden" class="form-control" value="<?php echo $tahun->tahun_ajaran_id; ?>" name="tahun_ajaran_id" id="tahun_ajaran_id">
                        </div>
                        <!-- Tombol untuk menyimpan data -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-sm  w-md">Delete</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php } ?>