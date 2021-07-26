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
                                <form method="POST" action="<?php echo base_url('User/insert') ?>">
                                    <div class="card-header">
                                        .:: Add New User ::.
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="control-label">Full Name</label>
                                            <input type="text" name="nama" class="form-control" required placeholder="Full Name" style="text-transform: capitalize;" maxlength="150" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" required placeholder="Email Address" maxlength="150" autocomplete="off">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Level</label>
                                            <select name="level" class="form-control select2bs4" required>
                                                <option value="">Select Level</option>
                                                <option value="0">Administrator</option>
                                                <option value="1">User</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Password</label>
                                            <input type="password" name="password" class="form-control" required placeholder="Password">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Description</label>
                                            <textarea name="deskripsi" class="form-control" placeholder="Your Description Here..."></textarea>
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
                                    .:: User List ::.
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="data1">
                                            <thead>
                                                <th>No.</th>
                                                <th>Name</th>
                                                <th>Email Address</th>
                                                <th>Last Login</th>
                                                <th>Login From</th>
                                                <th>Level</th>
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
                                                                <td><?php echo $row->nama; ?></td>
                                                                <td><?php echo $row->email; ?></td>
                                                                <td><?php echo $row->last_login; ?></td>
                                                                <td><?php echo $row->login_from; ?></td>
                                                                <td>
                                                                    <?php
                                                                        if($row->level == '0')
                                                                        {
                                                                            echo "Administrator";
                                                                        }
                                                                        elseif($row->level == "1")
                                                                        {
                                                                            echo "User";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <?php
                                                                            if($this->session->userdata('userid') == $row->userid)
                                                                            {
                                                                                ?>
                                                                                    <a href="<?php echo base_url().'User/edit/'.$row->userid; ?>" class="btn btn-flat btn-xs btn-warning disabled" data-tooltip="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                                                    <a href="" data-toggle="modal" data-target="#changePassword" data-id="<?php echo $row->userid; ?>" class="btn btn-xs btn-flat btn-info disabled" data-tooltip="tooltip" data-placement="top" title="Change Password"><i class="fas fa-key"></i></a>
                                                                                    <a href="" data-toggle="modal" data-target="#hapusData" data-id="<?php echo $row->userid; ?>" data-tooltip="tooltip" data-placement="top" title="Delete Data" class="btn btn-flat btn-xs btn-danger disabled"><i class="fas fa-trash"></i></a>
                                                                                <?php
                                                                                
                                                                            }
                                                                            else
                                                                            {
                                                                                ?>
                                                                                    <a href="<?php echo base_url().'User/edit/'.$row->userid; ?>" class="btn btn-flat btn-xs btn-warning" data-tooltip="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                                                    <a href="" data-toggle="modal" data-target="#changePassword" data-id="<?php echo $row->userid; ?>" class="btn btn-xs btn-flat btn-info" data-tooltip="tooltip" data-placement="top" title="Change Password"><i class="fas fa-key"></i></a>
                                                                                    <a href="" data-toggle="modal" data-target="#hapusData" data-id="<?php echo $row->userid; ?>" data-tooltip="tooltip" data-placement="top" title="Delete Data" class="btn btn-xs btn-danger"><i class="fas fa-trash"></i></a>
                                                                                <?php
                                                                            }
                                                                        ?>
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
            $this->load->view('User/modal');
        ?>