<div class="modal fade" id="changePassword" tabindex="-1" role="document">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo base_url().'User/changePassword'; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Change Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" name="pass1" class="form-control" required id="pass1" placeholder="New Password">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="userid" class="form-control" id="userid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-save"></i> Change Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="hapusData" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <form method="POST" action="<?php echo base_url('User/delete'); ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this data? Deleted data cannot be recovered</p>
                    <div class="form-group">
                        <input type="hidden" name="userid" class="form-control" id="userid-delete">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-flat btn-default" data-dismiss="modal"><i class="fas fa-times"></i> No</button>
                    <button type="submit" class="btn btn-danger btn-flat"><i class="fas fa-trash"></i> Yes</button>
                </div>
            </form>
        </div>
    </div>
</div>