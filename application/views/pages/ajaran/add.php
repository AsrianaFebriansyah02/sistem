<div id="addsantri" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah Tahun Ajaran</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body p-4">
				<form action="<?php echo site_url('ajaran/simpan'); ?>" method="post">
					<div class="form-group">
						<label for="tahun">Tahun Ajaran</label>
						<input type="text" class="form-control" id="tahun" name="nama_tahun" placeholder="Tahun Ajaran">
					</div>
					<div class="form-group">
						<label class="control-label">Status</label>
						<select class="form-control" name="status">
							<option value="aktif">Aktif</option>
							<option value="non-aktif">Non Aktif</option>
						</select>
					</div>
					<!-- Tombol untuk menyimpan data -->
					<div class="modal-footer">
						<button type="submit" class="btn btn-primary btn-sm  w-md">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div><!-- /.modal -->