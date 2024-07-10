<?php foreach ($jenjang_pendidikan as $pendidikan) { ?>
    <div class="modal fade deleteJenjangPendidikan<?php echo $pendidikan->jenjang_pendidikan_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert" align="center">
                        <b>Yakin </b>ingin menghapus data <span class="badge badge-pill badge-primary font-size-8"><?php echo $pendidikan->nama_jenjang_pendidikan; ?></span> ? <br>
                        <b>Perhatian!</b> Penghapusan data akan secara otomatis menghapus data lain yang memiliki hubungan pada <b>administrasi</b>.
                    </div>
                    <form action="<?php echo site_url('jenjang/delete'); ?>" method="post">
                        <input type="hidden" class="form-control" value="<?php echo $pendidikan->jenjang_pendidikan_id; ?>" name="jenjang_pendidikan_id" id="jenjang_pendidikan_id">
                        <!-- Tombol untuk menyimpan data -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-sm  w-md">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
    </div>
<?php } ?>