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
                                <form method="POST" action="<?php echo base_url('Transaksi/insert'); ?>">
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
                                                                    <option value="<?php echo $kry->NIK ?>"><?php echo $kry->NIK." - ".$kry->nama; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Shift</label>
                                                    <select name="shift" class="form-control select2bs4" required>
                                                        <option value="">-- Select Shift --</option>
                                                        <option value="1">Shift 1</option>
                                                        <option value="2">Shift 2</option>
                                                        <option value="3">Shift 3</option>
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
                                                                    <option value="<?php echo $mesin->id; ?>"><?php echo $mesin->no_mesin; ?></option>
                                                                <?php
                                                            }
                                                        ?>
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
                                                                    <option value="<?php echo $pro->id; ?>"><?php echo $pro->kode_project." - ".$pro->nama_project; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Material</label>
                                                    <select name="material" id="material" class="select2bs4 form-control" required>
                                                        <option value="">-- Select Material --</option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="form-group" id="only-number">
                                                    <label class="control-label">Lot No</label>
                                                    <input type="number" name="lot" class="form-control" required placeholder="Lot No." maxlength="8" id="number">
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label class="control-label">Total Qty</label>
                                                            <input type="number" class="form-control" required name="total_qty" id="total_qty">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="control-label">Defect Qty</label>
                                                            <input type="number" class="form-control" required name="defect_qty" id="defect_qty" onchange="hasil()">
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
                                                                    <option value="<?php echo $type->id; ?>"><?php echo $type->nama_type; ?></option>
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
                                                            foreach($defect as $defect)
                                                            {
                                                                ?>
                                                                    <option value="<?php echo $defect->id; ?>"><?php echo $defect->nama_defect; ?></option>
                                                                <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Abnormal Situation Description</label>
                                                    <textarea class="form-control" name="abnormal" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Root Couse</label>
                                                    <textarea class="form-control" name="root_couse" required></textarea>
                                                </div> 
                                                <div class="form-group">
                                                    <label class="control-label">Temporary Measure</label>
                                                    <textarea class="form-control" name="temporary" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label class="control-label">Stop Time</label>
                                                            <input type="time" class="form-control" required name="time">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Qty Sortir</label>
                                                            <input type="number" class="form-control" required name="qty_sortir" id="qty_sortir" onchange="hasilSortir()">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Qty OK</label>
                                                            <input type="number" class="form-control" required name="qty_ok" id="qty_ok" onchange="hasilNG()">
                                                        </div>
                                                    </div>
                                                </div> 
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <label class="control-label">Qty NG</label>
                                                            <input type="text" class="form-control" readonly required name="qty_ng" id="qty_ng">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Working Hour</label>
                                                            <input type="float" class="form-control" required name="working_hour">
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Result</label>
                                                            <input type="text" class="form-control" required name="result">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Long-Term Measure</label>
                                                    <textarea class="form-control" name="longterm" required></textarea>
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
                                                                            <option value="<?php echo $kry->NIK ?>"><?php echo $kry->NIK." - ".$kry->nama; ?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                            <label class="control-label">Finish Time</label>
                                                            <input type="date" name="finish" class="form-control datepicker-days" required>
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
                                                                            <option value="<?php echo $kry->NIK ?>"><?php echo $kry->NIK." - ".$kry->nama; ?></option>
                                                                        <?php
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-4">
                                                        <label class="control-label">Status</label>
                                                        <select name="status" class="form-control select2bs4" required>
                                                            <option value="">-- Select Status --</option>
                                                            <option value="1">Open</option>
                                                            <option value="2">On Progress</option>
                                                            <option value="3">Monitoring</option>
                                                            <option value="0">Close</option>
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