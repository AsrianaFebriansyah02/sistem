<?php foreach ($user as $User) { ?>
    <!-- add modal -->
    <div class="modal fade edituser<?php echo $User->user_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered  modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Tahun Ajaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo site_url('user/update'); ?>" method="post">
                        <div class="form-group">
                            <label for="role" class="control-label">Role</label>
                            <input type="hidden" name="user_id" value="<?php echo $User->user_id; ?>">

                            <select class="form-control" id="role" name="role">
                                <option value="admin" <?php echo ($User->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                <option value="bendahara" <?php echo ($User->role == 'bendahara') ? 'selected' : ''; ?>>Bendahara</option>
                                <option value="kepsek" <?php echo ($User->role == 'kepsek') ? 'selected' : ''; ?>>Kepsek</option>
                                <option value="yayasan" <?php echo ($User->role == 'yayasan') ? 'selected' : ''; ?>>Yayasan</option>
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