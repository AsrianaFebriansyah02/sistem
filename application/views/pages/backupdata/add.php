<div id="addbackupdata" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body p-4">
                <div>
                    <div class="form-group">
                        <label for="tanggal" class="control-label">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal">
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="field-1" class="control-label">Uraian</label>
                        <textarea class="form-control" id="field-7" placeholder="Write something about yourself"></textarea>
                    </div>
                </div>
                <div>
                    <div class="form-group">
                        <label for="tanggal" class="control-label">Backup Data</label>
                        <form action="/action_page.php">
                            <input class="form-control" type="file" id="myFile" name="filename">
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info waves-effect waves-light">Save changes</button>
            </div>
        </div>
    </div>
</div><!-- /.modal -->