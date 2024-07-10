<?php foreach ($guru as $Guru) { ?>
	<!-- add modal -->
	<div class="modal fade editguru<?php echo $Guru->guru_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0">Edit Guru</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url('guru/update'); ?>" method="post">
						<!-- Input hidden untuk menyimpan ID Guru -->
						<input type="hidden" name="guru_id" value="<?php echo $Guru->guru_id; ?>">
						<!-- Input Nama Guru -->
						<div class="form-group">
							<label for="nama" class="control-label">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama_guru" placeholder="Nama Guru" value="<?php echo $Guru->nama_guru; ?>">
						</div>
						<!-- Input NIY Guru -->
						<div class="form-group">
							<label for="niy" class="control-label">NIY</label>
							<input type="text" class="form-control" id="niy" name="niy_guru" placeholder="NIY Guru" value="<?php echo $Guru->niy_guru; ?>">
						</div>
						<!-- Input Jenis Kelamin -->
						<div class="form-group">
							<label for="jenisKelamin" class="control-label">Jenis Kelamin</label>
							<select class="form-control" id="jenisKelamin" name="jenis_kelamin">
								<option value="Perempuan" <?php echo ($Guru->jenis_kelamin == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
								<option value="Laki-laki" <?php echo ($Guru->jenis_kelamin == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
							</select>
						</div>
						<!-- Input Tanggal Lahir -->
						<div class="form-group">
							<label for="tanggalLahir" class="control-label">Tanggal Lahir</label>
							<input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir" value="<?php echo $Guru->tanggal_lahir; ?>">
						</div>
						<!-- Input Alamat -->
						<div class="form-group">
							<label for="alamat" class="control-label">Alamat</label>
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Guru" value="<?php echo $Guru->alamat; ?>">
						</div>
						<!-- Input Jenjang Pendidikan -->
						<div class="form-group">
							<label for="jenjangPendidikan" class="control-label">Jenjang Pendidikan</label>
							<select class="form-control" id="jenjangPendidikan" name="jenjang_pendidikan_id">
								<option value="">Pilih</option>
								<?php foreach ($jenjang_pendidikan as $jenjang) : ?>
									<option value="<?php echo $jenjang->jenjang_pendidikan_id; ?>" <?php echo ($jenjang->jenjang_pendidikan_id == $Guru->jenjang_pendidikan_id) ? 'selected' : ''; ?>><?php echo $jenjang->nama_jenjang_pendidikan; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<!-- Input Jabatan -->
						<div class="form-group">
							<label for="jabatan" class="control-label">Jabatan</label>
							<input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan Guru" value="<?php echo $Guru->jabatan; ?>">
						</div>
						<div class="form-group">
							<label class="control-label">Status</label>
							<select class="form-control" name="status">
								<option value="aktif" <?php echo ($Guru->status == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
								<option value="non-aktif" <?php echo ($Guru->status == 'non-aktif') ? 'selected' : ''; ?>>Non Aktif</option>
							</select>
						</div>
						<!-- Tombol untuk menyimpan data -->
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-sm w-md">Save Changes</button>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>