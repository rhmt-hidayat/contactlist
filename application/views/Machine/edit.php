<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-12">
                            <h1 class="m-0"><?php echo $judul; ?></h1>
                        </div>
                    </div>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <?php
                        $this->load->view('Include/error');
                    ?>
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <form method="POST" action="<?php echo base_url('Machine/update') ?>">
                                    <div class="card-header">
                                        .:: Edit New Machine ::.
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label">No. Mesin</label>
                                            <input type="text" name="no_mesin" class="form-control" required placeholder="No Mesin" style="text-transform: capitalize;" maxlength="150" autocomplete="off" value="<?php echo $edit['no_mesin'] ?>">
                                            <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Tonage</label>
                                            <input type="text" name="tonnage" class="form-control" required placeholder="Tonnage" maxlength="150" autocomplete="off" value="<?php echo $edit['tonnage'] ?>">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="reset" data-tooltip="tooltip" data-placement="top" title="Cancel" class="btn btn-flat btn-default"><i class="fas fa-times"></i> Cancel</button>
                                        <button type="submit" data-tooltip="tooltip" data-placement="top" title="Save Data" class="btn btn-flat btn-success float-right"><i class="fas fa-save"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    .:: Machine List ::.
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="data1">
                                            <thead>
                                                <th>No.</th>
                                                <th>No. Mesin</th>
                                                <th>Tonnage</th>
                                                <!-- <th>Status</th> -->
                                                <th>#</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    foreach($data as $row)
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $row->no_mesin; ?></td>
                                                                <td><?php echo $row->tonnage; ?></td>
                                                                <!-- <td><?php echo $row->status; ?></td> -->
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo base_url().'Machine/edit/'.$row->id; ?>" class="btn btn-flat btn-xs btn-warning" data-tooltip="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                                        <a href="" data-toggle="modal" data-target="#hapusData" data-id="<?php echo $row->id; ?>" data-tooltip="tooltip" data-placement="top" title="Delete Data" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php
            // $this->load->view('Machine/modal');
        ?>