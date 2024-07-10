<?php foreach ($tahun_ajaran as $tahun) { ?>
	<!-- add modal -->
	<div class="modal fade tahunajaran<?php echo $tahun->tahun_ajaran_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered  modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0">Edit Tahun Ajaran</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo site_url('ajaran/update'); ?>" method="post">

						<div class="form-group">
							<label for="tahun">Tahun Ajaran</label>
							<input type="hidden" class="form-control" id="tahun" value="<?php echo $tahun->tahun_ajaran_id; ?>" name="tahun_ajaran_id">
							<input type="text" class="form-control" id="tahun" value="<?php echo $tahun->nama_tahun; ?>" name="nama_tahun">
						</div>
						<div class="form-group">
							<label class="control-label">Status</label>
							<select class="form-control" name="status">
								<option value="aktif" <?php echo ($tahun->status == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
								<option value="non-aktif" <?php echo ($tahun->status == 'non-aktif') ? 'selected' : ''; ?>>Non Aktif</option>
							</select>
						</div>

						<!-- Tombol untuk menyimpan data -->
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-sm  w-md">Save Changes</button>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>