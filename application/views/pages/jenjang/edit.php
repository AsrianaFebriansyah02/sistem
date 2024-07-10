<?php foreach ($jenjang_pendidikan as $pendidikan) { ?>
    <div id="modalFadeJenjangPendidikan<?php echo $pendidikan->jenjang_pendidikan_id; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                </div>
                <div class="modal-body p-4">
                    <form action="<?php echo site_url('jenjang/update'); ?>" method="post">
                        <div class="form-group">
                            <label for="nama" class="control-label">Jenjang Pendidikan</label>
                            <input type="hidden" class="form-control" id="nama" value="<?php echo $pendidikan->jenjang_pendidikan_id; ?>" name="jenjang_pendidikan_id">
                            <input type="text" class="form-control" id="nama" name="nama_jenjang_pendidikan" value="<?php echo $pendidikan->nama_jenjang_pendidikan; ?>" placeholder="John">
                        </div>
                        <!-- Tombol untuk menyimpan data -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm  w-md">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
<?php } ?>