<?php foreach($data as $row): $id=$row->id; ?>
<div class="modal fade" id="hapusData<?php echo $row->id; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="dialog">
        <div class="modal-content">
            <form method="POST" action="<?php echo base_url('Machine/delete'); ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this data? Deleted data cannot be recovered</p>
                    <div class="form-group">
                        <input type="hidden" name="id" class="form-control" value="<?php echo $id;?>">
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
<?php endforeach;?>