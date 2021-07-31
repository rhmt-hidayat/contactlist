<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
?>
        <script>
            $(function() {
                $('#only-number').on('keypress', '#number', function(e) {
                    -1 !== $
                        .inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) || /65|67|86|88/
                        .test(e.keyCode) && (!0 === e.ctrlKey || !0 === e.metaKey) ||
                        35 <= e.keyCode && 40 >= e.keyCode || (e.shiftKey || 48 > e.keyCode || 57 < e.keyCode) &&
                        (96 > e.keyCode || 105 < e.keyCode) && e.preventDefault()
                });
            })
        </script>
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
                                <form method="POST" action="<?php echo base_url('Transaksi/update'); ?>">
                                    <div class="card-header">
                                        <a href="<?php echo base_url('Transaksi'); ?>" class="btn btn-flat btn-default" data-tooltip="tooltip" data-placement="top" title="Back"><i class="fas fa-arrow-left"></i> Back</a>
                                        <button type="submit" class="btn btn-flat btn-success" data-tooltip="tooltip" data-placement="top" title="Save Data"><i class="fas fa-save"></i>  Save Data</button>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label">Document No.</label>
                                                    <input type="text" name="kode" class="form-control" required readonly value="<?php echo $noTransaksi; ?>">
                                                    <input type="hidden" name="id" value="<?php echo $edit['id'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Date</label>
                                                    <input type="text" name="tanggal" class="form-control datepicker-days" readonly required value="<?php echo date("d-M-Y") ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Reported By</label>
                                                    <select name="pelapor" class="form-control select2bs4" required>
                                                        <option value="">-- Select Data --</option>
                                                        <?php
                                                            foreach($karyawan as $kry)
                                                            {
                                                                ?>
                                                                    <option value="<?php echo $kry->NIK ?>" <?php if($edit['reported'] == $kry->NIK){ ?> selected <?php } ?>><?php echo $kry->NIK." - ".$kry->nama; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Shift</label>
                                                    <select name="shift" class="form-control select2bs4" required>
                                                        <option value="">-- Select Shift --</option>
                                                        <option value="1" <?php if($edit['shift'] == '1'){ ?> selected <?php } ?>>Shift 1</option>
                                                        <option value="2" <?php if($edit['shift'] == '2'){ ?> selected <?php } ?>>Shift 2</option>
                                                        <option value="3" <?php if($edit['shift'] == '3'){ ?> selected <?php } ?>>Shift 3</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label">Project</label>
                                                    <select name="project" id="project" class="form-control select2bs4" required>
                                                        <option value="">-- Select Project --</option>
                                                        <?php
                                                            foreach($project as $pro)
                                                            {
                                                                ?>
                                                                    <option value="<?php echo $pro->id; ?>" <?php if($edit['project'] == $pro->id){ ?> selected <?php } ?>><?php echo $pro->kode_project." - ".$pro->nama_project; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Material</label>
                                                    <select name="material" id="material" class="select2bs4 form-control" required>
                                                        <option value="">-- Select Material --></option>
                                                        <?php
                                                        foreach($material_edit as $mat)
                                                        {
                                                            ?>
                                                                <option value="<?php echo $mat->kode_material; ?>" <?php if($edit['product_drawing'] == $mat->kode_material){ ?> selected <?php } ?>><?php echo $mat->kode_material; ?></option>
                                                            <?php
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Machine No.</label>
                                                    <select name="mesin" class="form-control select2bs4" required>
                                                        <option value="">-- Select Machine --</option>
                                                        <?php
                                                            foreach($mesin as $mesin)
                                                            {
                                                                ?>
                                                                    <option value="<?php echo $mesin->id; ?>" <?php if($edit['machine_no'] == $mesin->id){ ?> selected <?php } ?>><?php echo $mesin->no_mesin; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="only-number">
                                                    <label class="control-label">Lot No</label>
                                                    <input type="number" name="lot" class="form-control" value="<?php echo $edit['lot_no'] ?>" required placeholder="Lot No." maxlength="8" id="number">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label class="control-label">Total Qty</label>
                                                            <input type="number" class="form-control" value="<?php echo $edit['total_product'] ?>" required name="total_qty" id="total_qty">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="control-label">Defect Qty</label>
                                                            <input type="number" class="form-control" value="<?php echo $edit['defect_qty'] ?>" required name="defect_qty" id="defect_qty" onchange="hasil()">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Abnormality Type</label>
                                                    <select name="type" class="form-control select2bs4" required>
                                                        <option value="">-- Select Abnormality Type --</option>
                                                        <?php
                                                            foreach($type as $type)
                                                            {
                                                                ?>
                                                                    <option value="<?php echo $type->id; ?>" <?php if($edit['abn_type'] == $type->id){ ?> selected <?php } ?>><?php echo $type->nama_type; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label class="control-label">Defect</label>
                                                    <select name="defect[]" multiple class="form-control select2bs4" required>
                                                        <option value="">-- Select Defect --</option>
                                                        <?php
                                                            $data = str_replace('"','',$edit['defect']); 
                                                            $data1 = str_replace('\\','',$data); 
                                                            $data2 = explode(',', $data1);
                                                            foreach($defect as $d)
                                                            {
                                                                foreach($data2 as $xx)
                                                                {
                                                                    $idDefect = $xx;
                                                                    ?>
                                                                        <option value="<?php echo $d->id; ?>" <?php if($d->id == $idDefect){ ?> selected <?php } ?>><?php echo $d->nama_defect; ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                        
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Abnormal Situation Description</label>
                                                    <input class="form-control" name="abnormal" value="<?php echo $edit['situation'] ?>" required></input>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Root Couse</label>
                                                    <input class="form-control" name="root_couse" value="<?php echo $edit['root'] ?>" required></input>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="control-label">Temporary Measure</label>
                                                    <input class="form-control" name="temporary" value="<?php echo $edit['temporary'] ?>" required></input>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label class="control-label">Stop Time</label>
                                                            <input type="time" class="form-control" required name="time" value="<?php echo $edit['stop_time'] ?>">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Qty Sortir</label>
                                                            <input type="number" class="form-control" required name="qty_sortir" value="<?php echo $edit['qty_sortir'] ?>" id="qty_sortir" onchange="hasilSortir()">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Qty OK</label>
                                                            <input type="number" class="form-control" required name="qty_ok" value="<?php echo $edit['qty_ok'] ?>" id="qty_ok" onchange="hasilNG()">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label class="control-label">Qty NG</label>
                                                            <input type="number" class="form-control" readonly required name="qty_ng" value="<?php echo $edit['qty_ng'] ?>" id="qty_ng"    >
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Working Hour</label>
                                                            <input type="number" class="form-control" required name="working_hour" value="<?php echo $edit['working_hour'] ?>">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Result</label>
                                                            <input type="text" class="form-control" required name="result" value="<?php echo $edit['result'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Long-Term Measure</label>
                                                    <input class="form-control" name="longterm" value="<?php echo $edit['longterm'] ?>" required></input>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <label class="control-label">Reported By</label>
                                                            <select name="reported" class="form-control select2bs4" required>
                                                                <option value="">-- Select Data --</option>
                                                                <?php
                                                                    foreach($karyawan as $kry)
                                                                    {
                                                                        ?>
                                                                            <option value="<?php echo $kry->NIK ?>" <?php if($edit['improvement'] == $kry->NIK){ ?> selected <?php } ?>><?php echo $kry->NIK." - ".$kry->nama; ?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Finish Time</label>
                                                            <input type="date" class="form-control datepicker-days" value="<?php echo $edit['finish'] ?>" required name="finish">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-8">
                                                            <label class="control-label">Verified By</label>
                                                            <select name="verified" class="form-control select2bs4" required>
                                                                <option value="">-- Select Data --</option>
                                                                <?php
                                                                    foreach($karyawan as $kry)
                                                                    {
                                                                        ?>
                                                                            <option value="<?php echo $kry->NIK ?>" <?php if($edit['verified'] == $kry->NIK){ ?> selected <?php } ?>><?php echo $kry->NIK." - ".$kry->nama; ?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                        <label class="control-label">Status</label>
                                                        <select name="status" class="form-control select2bs4" required>
                                                            <option value="">-- Select Status --</option>
                                                            <option value="1" <?php if($edit['status'] == '1'){ ?> selected <?php } ?>>Open</option>
                                                            <option value="2" <?php if($edit['status'] == '2'){ ?> selected <?php } ?>>On Progress</option>
                                                            <option value="3" <?php if($edit['status'] == '3'){ ?> selected <?php } ?>>Monitoring</option>
                                                            <option value="0" <?php if($edit['status'] == '0'){ ?> selected <?php } ?>>Close</option>
                                                        </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <script>
            $(document).ready(function(){
            $('#project').change(function(){
                var id= $(this).val();
                $.ajax({
                    url : "<?php echo base_url("Transaksi/getMaterial"); ?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].kode_material+'>'+data[i].kode_material+'</option>';
                        }
                        $('#material').html(html);

                    }
                });
                return false;
            }); 
            
        });
        </script>