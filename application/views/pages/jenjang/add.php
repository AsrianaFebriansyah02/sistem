<div id="addjenjang" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div>
                    <form action="<?php echo site_url('jenjang/simpan'); ?>" method="post">
                        <div class="form-group">
                            <label for="nama" class="control-label">Jenjang Pendidikan</label>
                            <input type="text" class="form-control" id="nama" name="nama_jenjang_pendidikan" placeholder="Jenjang Pendidikan">
                        </div>
                        <!-- Tombol untuk menyimpan data -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary btn-sm  w-md">Submit</button>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div><!-- /.modal -->