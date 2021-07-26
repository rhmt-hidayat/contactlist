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
                                <form method="POST" action="<?php echo base_url('Material/insert') ?>">
                                    <div class="card-header">
                                        .:: Add New Material ::.
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label">Kode Material</label>
                                            <input type="text" name="kode" class="form-control" required placeholder="Kode Material" style="text-transform: capitalize;" maxlength="150" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Nama Material</label>
                                            <input type="text" name="nama" class="form-control" required placeholder="Nama Material" maxlength="150" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Spesifikasi</label>
                                            <textarea name="spesifikasi" class="form-control" placeholder="Your Spesifikasi Here..."></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Project</label>
                                            <select name="project" class="form-control select2bs4" style="width: 100%;">
                                                <option value="">Pilih Project</option>
                                                <?php
                                                    foreach($project as $p)
                                                    {
                                                        ?>
                                                            <option value="<?php echo $p->id; ?>"><?php echo $p->nama_project; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Satuan</label>
                                            <select name="satuan" class="form-control select2bs4" style="width: 100%;" required>
                                                <option value="">Pilih Satuan</option>
                                                <?php
                                                    foreach($satuan as $s)
                                                    {
                                                        ?>
                                                            <option value="<?php echo $s->id; ?>"><?php echo $s->nama_satuan; ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
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
                                    .:: Material List ::.
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="data1">
                                            <thead>
                                                <th>No.</th>
                                                <th>Kode Material</th>
                                                <th>Nama Material</th>
                                                <th>Spesifikasi</th>
                                                <th>Project</th>
                                                <th>Satuan</th>
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
                                                                <td><?php echo $row->kode_material; ?></td>
                                                                <td><?php echo $row->nama_material; ?></td>
                                                                <td><?php echo $row->spesifikasi; ?></td>
                                                                <td><?php echo $row->namaProject; ?></td>
                                                                <td><?php echo $row->namaSatuan; ?></td>
                                                                <!-- <td><?php echo $row->status; ?></td> -->
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo base_url().'Material/edit/'.$row->id; ?>" class="btn btn-flat btn-xs btn-warning" data-tooltip="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                                        <a href="" data-toggle="modal" data-target="#hapusData<?php echo $row->id; ?>" data-id="" data-tooltip="tooltip" data-placement="top" title="Delete Data" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
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
            $this->load->view('Material/modal');
        ?>