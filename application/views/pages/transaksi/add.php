<div id="addtransaksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div>
                    <form action="<?php echo site_url('transaksi/simpan'); ?>" method="post">
                        <!-- Input Tanggal -->
                        <div class="form-group">
                            <label for="tanggal" class="control-label">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <!-- Input Uraian -->
                        <div class="form-group">
                            <label for="uraian" class="control-label">Uraian</label>
                            <input type="text" class="form-control" id="uraian" name="uraian" placeholder="Uraian">
                        </div>
                        <!-- Input User -->
                        <div class="form-group">
                            <label for="role" class="control-label">User</label>
                            <select class="form-control" id="role" name="user_id">
                                <option value="">Pilih</option>
                                <?php foreach ($user as $User) : ?>
                                    <option value="<?php echo $User->user_id; ?>"><?php echo $User->role; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- Input Tahun Ajaran -->
                            <div class="form-group">
                                <label for="TahunAjaran" class="control-label">Tahun Ajaran</label>
                                <select class="form-control" id="TahunAjaran" name="tahun_ajaran_id">
                                    <option value="">Pilih</option>
                                    <?php foreach ($tahun_ajaran as $tahun) : ?>
                                        <option value="<?php echo $tahun->tahun_ajaran_id; ?>"><?php echo $tahun->nama_tahun; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <!-- Input Jenis Transaksi -->
                            <div class="form-group">
                                <label class="control-label">Jenis Transaksi</label>
                                <select class="form-control" name="jenis_transaksi">
                                    <option value="">Pilih</option>
                                    <option value="debit">Debit</option>
                                    <option value="kredit">Kredit</option>
                                </select>
                            </div>
                            <!-- Input Nominal -->
                            <div class="form-group">
                                <label for="nominal" class="control-label">Nominal</label>
                                <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Nominal">
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