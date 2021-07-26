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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <strong>.:: Filter Data ::.</strong>
                        </div>
                        <div class="card-body">
                        <form method="POST" action="Report">
                                <label>Laporan Berdasarkan</label>
                                <select name="filter" id="filter">
                                    <option value="">---Pilih Filter---</option>
                                    <option value="1">Harian</option>
                                    <option value="2">Mingguan</option>
                                    <option value="3">Bulanan</option>
                                </select>
                                <a id="form-tanggal" >
                                    <label><i class="fa fa-calendar fa-fw"></i></label>
                                    <input type="date" name="tanggal">
                                </a>
                                <a id="form-minggu" >
                                    <label><i class="fa fa-calendar fa-fw"></i>Dari :</label>
                                    <input type="date" name="tgl1">
                                    <label>Sampai :</label>
                                    <input type="date" name="tgl2">
                                </a>
                                <a id="form-bulan">
                                    <label><i class="fa fa-calendar fa-fw"></i></label>
                                    <!-- <input type="month" name="bulan"> -->
                                    <select name="bulan" >
                                        <option value="">---Pilih Bulan---</option>
                                        <option value="01">Januari</option>
                                        <option value="02">Februari</option>
                                        <option value="03">Maret</option>
                                        <option value="04">April</option>
                                        <option value="05">Mei</option>
                                        <option value="06">Juni</option>
                                        <option value="07">Juli</option>
                                        <option value="08">Agustus</option>
                                        <option value="09">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                    </select>
                                </a>
                                <button type="submit" id="tampil" class="btn btn-success btn-sm" onclick="tampilkan">Cari <i class="fa fa-search fa-fw"></i></button>
                                <!-- <a href="<?php echo base_url().'Report'; ?>">Hapus tabel</a> -->
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                <br>
                <div class="container-fluid">
                    <?php
                        $this->load->view('Include/error');
                    ?>
                    
                    <!-- <?php
                        if(count($laporan) > 0)
                        {
                            ?> -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-hover table-bordered" id="data1">
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
                                                        <th style="vertical-align: middle; text-align: center; background-color:red;">Long  Term Measure</th>
                                                        <th style="vertical-align: middle; text-align: center;">Improvement Responsibility Person</th>
                                                        <th style="vertical-align: middle; text-align: center;">Required Finish Time</th>
                                                        <th style="vertical-align: middle; text-align: center;">Status</th>
                                                        <th style="vertical-align: middle; text-align: center;">Verified By</th>
                                                        <!-- <th style="vertical-align: middle; text-align: center;">#</th> -->
                                                    </thead>
                                                    <tbody>
                                                            <?php
                                                                $no = 1;
                                                                foreach($laporan as $row)
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
                                                                            <td><?php echo $row->abn_type; ?></td>
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
                                                                            <td><?php echo $row->status; ?></td>
                                                                            <td><?php echo $row->namaKaryawan3; ?></td>
                                                                            <!-- <td>
                                                                                <div class="btn-group">
                                                                                    <a href="" class="btn btn-flat btn-xs btn-warning" data-tooltip="tooltip" data-placement="top" title="Edit Data"><i class="fas fa-edit"></i>Print</a>
                                                                                </div>
                                                                            </td> -->
                                                                        </tr>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- <?php
                        }else{
                            $laporan = array();
                        }
                    ?> -->
                </div>
            </section>
        </div>

        <script>
        $(document).ready(function(){
            $('.datepicker').datepicker({
                format: 'yyyy/dd/mm'
            });
            $('#form-tanggal, #form-bulan, #form-minggu').hide();
            $('#filter').change(function(){
                if($(this).val() == '1'){
                    $('#form-bulan, #form-minggu').hide();
                    $('#form-tanggal').show();
                }else if($(this).val() == '2'){
                    $('#form-tanggal, #form-bulan').hide();
                    $('#form-minggu').show();
                }else{
                    $('#form-tanggal, #form-minggu').hide();
                    $('#form-bulan').show();
                }
                // $('#form-tanggal input, #form-bulan select, #form-minggu select').val('');
                // $('#data1').hide();  
            })
        })
		
		function tampilkan(){
			var filter=document.getElementById("tampil").value;
            Window.document.getElementById("data1").innerHTML=filter;
		}
		
        </script>
