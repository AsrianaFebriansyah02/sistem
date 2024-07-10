<?php foreach ($tahun_ajaran as $tahun) {?>
	<!-- add modal -->
    <div class="modal fade tahunajaran<?php echo $tahun->tahun_ajaran_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Add Sanah Dirasah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<form action="<?php echo site_url('admin/tahunajaran/update'); ?>" method="post">
						<div class="form-group">
							<label for="kode">Kode Tahun</label>
							<input type="hidden" class="form-control" value="<?php echo $tahun->tahun_ajaran_id; ?>" name="tahun_ajaran_id" id="tahun_ajaran_id" >
							<input type="text" class="form-control" value="<?php echo $tahun->kode_tahun; ?>" id="kode" readonly>
						</div>
						<div class="form-group">
							<label for="tahun">Sanah Dirasah</label>
							<input type="text" class="form-control" id="tahun" value="<?php echo $tahun->nama_tahun; ?>" name="nama_tahun">
						</div>
						<div class="form-group">
							<label class="control-label">Status</label>
							<select class="form-control" name="status">
								<option value="aktif">Aktif</option>
								<option value="non-aktif">Non Aktif</option>
							</select>
						</div>
						<hr>
						<div align="right">
							<button type="submit" class="btn btn-primary btn-sm  w-md">Submit</button>
						</div>
					</form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php }?>
