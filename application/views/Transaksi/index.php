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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <a href="<?php echo base_url('Transaksi/add'); ?>" class="btn btn-success btn-flat" data-tooltip="tooltip" data-placement="top" title="Add New Contact List"><i class="fas fa-plus-circle"></i> Create Contact List</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered" id="example">
                                            <thead>
                                                <th style="vertical-align: middle; text-align: center;">No.</th>
                                                <th style="vertical-align: middle; text-align: center;">Doc. No.</th>
                                                <th style="vertical-align: middle; text-align: center;">Date</th>
                                                <th style="vertical-align: middle; text-align: center;">Reported By</th>
                                                <th style="vertical-align: middle; text-align: center;">Shift</th>
                                                <th style="vertical-align: middle; text-align: center;">Project</th>
                                                <th style="vertical-align: middle; text-align: center;">Material</th>
                                                <th style="vertical-align: middle; text-align: center;">Machine No.</th>
                                                <th style="vertical-align: middle; text-align: center;">Lot No.</th>
                                                <th style="vertical-align: middle; text-align: center;">Total Product Qty</th>
                                                <th style="vertical-align: middle; text-align: center;">Defect Qty</th>
                                                <th style="vertical-align: middle; text-align: center;">Abnormality Type</th>
                                                <th style="vertical-align: middle; text-align: center;">Defect</th>
                                                <th style="vertical-align: middle; text-align: center;">Description</th>
                                                <th style="vertical-align: middle; text-align: center; background-color:red;">Root Couse</th>
                                                <th style="vertical-align: middle; text-align: center;">Temporary Measure</th>
                                                <th style="vertical-align: middle; text-align: center;">Stop Time</th>
                                                <th style="vertical-align: middle; text-align: center; background-color:aqua;">Qty Sortir</th>
                                                <th style="vertical-align: middle; text-align: center; background-color:greenyellow;">Qty OK</th>
                                                <th style="vertical-align: middle; text-align: center; background-color:blue;">Qty NG</th>
                                                <th style="vertical-align: middle; text-align: center;">Working Hour</th>
                                                <th style="vertical-align: middle; text-align: center;">Result</th>
                                                <th style="vertical-align: middle; text-align: center; background-color:red;">Long Term Measure</th>
                                                <th style="vertical-align: middle; text-align: center;">Improvement Responsibility Person</th>
                                                <th style="vertical-align: middle; text-align: center;">Required Finish Time</th>
                                                <th style="vertical-align: middle; text-align: center;">Status</th>
                                                <th style="vertical-align: middle; text-align: center;">Verified By</th>
                                                <th style="vertical-align: middle; text-align: center;">#</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $no = 1;
                                                    foreach($data as $row)
                                                    {
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $no++; ?></td>
                                                                <td><?php echo $row->kode; ?></td>
                                                                <td><?php echo $row->tanggal; ?></td>
                                                                <td><?php echo $row->namaKaryawan1; ?></td>
                                                                <td><?php echo $row->shift; ?></td>
                                                                <td><?php echo $row->namaProject; ?></td>
                                                                <td><?php echo $row->product_drawing; ?></td>
                                                                <td><?php echo $row->namaMesin; ?></td>
                                                                <td><?php echo $row->lot_no; ?></td>
                                                                <td><?php echo $row->total_product; ?></td>
                                                                <td><?php echo $row->defect_qty; ?></td>
                                                                <td>
                                                                    <?php 
                                                                        foreach($type as $tp)
                                                                        {
                                                                            $id = $tp->id;
                                                                            $namaType = $tp->nama_type;
                                                                            if($row->abn_type == $id)
                                                                            {
                                                                                echo $namaType;
                                                                            }
                                                                        }   
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                <?php
                                                                    $data = str_replace('"','',$row->defect);
                                                                    $data1 = explode(",", $data);
                                                                    if(count($data1))
                                                                    {
                                                                        foreach($defect as $s)
                                                                        {
                                                                            $idDefect = $s->id;

                                                                            foreach($data1 as $d)
                                                                            {
                                                                                if($d == $idDefect)
                                                                                {
                                                                                    echo $s->nama_defect.",";
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $row->situation; ?></td>
                                                                <td><?php echo $row->root; ?></td>
                                                                <td><?php echo $row->temporary; ?></td>
                                                                <td><?php echo $row->stop_time; ?></td>
                                                                <td><?php echo $row->qty_sortir; ?></td>
                                                                <td><?php echo $row->qty_ok; ?></td>
                                                                <td><?php echo $row->qty_ng; ?></td>
                                                                <td><?php echo $row->working_hour; ?></td>
                                                                <td><?php echo $row->result; ?></td>
                                                                <td><?php echo $row->longterm; ?></td>
                                                                <td><?php echo $row->namaKaryawan2; ?></td>
                                                                <td><?php echo $row->finish; ?></td>
                                                                <td>
                                                                    <?php 
                                                                        if($row->status == '0')
                                                                        {
                                                                            echo "<span class=\"badge badge-success\">Close</span>";
                                                                        }
                                                                        elseif($row->status == '1')
                                                                        {
                                                                            echo "<span class=\"badge badge-dark\">Open</success>";
                                                                        }
                                                                        elseif($row->status == '2')
                                                                        {
                                                                            echo "<span class=\"badge badge-warning\">On Progress</success>";
                                                                        }
                                                                        elseif($row->status == '3')
                                                                        {
                                                                            echo "<span class=\"badge badge-info\">Monitoring</success>";
                                                                        }
                                                                    ?>
                                                                </td>
                                                                <td><?php echo $row->namaKaryawan3; ?></td>
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <a href="<?php echo base_url().'Transaksi/edit/'.$row->id; ?>" class="btn btn-flat btn-xs btn-warning" data-tooltip="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i></a>
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
            $this->load->view('Transaksi/modal');
        ?>

        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'csv', 'excel'
                    ]
                } );
            } );
        </script>