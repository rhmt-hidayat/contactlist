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
                            <form method="POST" action="Total">
                                <div class="form-group-row">
                                    <label class="control-label">Laporan Tanggal :</label>
                                    <input type="date" name="tanggal" style="background-color:#DCDCDC;" class="form-control datepicker-days col-4" required value="<?php echo date("Y-m-d"); ?>"><br>     
                                </div>
                                <label>Kriteria Berdasarkan :</label>
                                    <select name="form_project">
                                        <option value="">---Pilih Project---</option>
                                        <?php
                                            foreach($project as $pro)
                                            {
                                                ?>
                                                    <option value="<?php echo $pro->id; ?>"><?php echo $pro->nama_project; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                <button type="submit" id="tampil" class="btn btn-success btn-sm">Cari <i class="fa fa-search fa-fw"></i></button>
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
                                                <table class="table table-striped table-hover table-bordered" style="width:100%" id="example">
                                                    <thead>
                                                        <th style="vertical-align: middle; text-align: center;">No.</th>
                                                        <th style="vertical-align: middle; text-align: center;">Part No.</th>
                                                        <th style="vertical-align: middle; text-align: center;">Project</th>
                                                        <th style="vertical-align: middle; text-align: center;">Count Case</th>
                                                        <th style="vertical-align: middle; text-align: center;">New</th>
                                                         <th style="vertical-align: middle; text-align: center;">Re-occure</th>
                                                        <th style="vertical-align: middle; text-align: center;">Close</th>
                                                    </thead>
                                                    <tbody>
                                                            <?php
                                                                $no = 1;
                                                                foreach($laporan as $row)
                                                                {
                                                                    ?>
                                                                        <tr>
                                                                            <td><?php echo $no++; ?></td>
                                                                            <td><?php echo $row->product_drawing; ?></td>
                                                                            <td>
                                                                            <?php 
                                                                                foreach($project as $p)
                                                                                {
                                                                                    $id = $p->id;
                                                                                    $namaProject = $p->nama_project;
                                                                                    if($row->project == $id)
                                                                                    {
                                                                                        echo $namaProject;
                                                                                    }
                                                                                }   
                                                                            ?>
                                                                            </td>
                                                                            <td><?php echo $row->Semua; ?></td>
                                                                            <td><?php echo $row->Open; ?></td>
                                                                            <td><?php echo $row->OnGoing; ?></td>
                                                                            <td><?php echo $row->Close; ?></td>
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
                <div class="container-fluid">
                    <!-- <?php
                        if(count($grafik) > 0)
                        {
                            ?> -->
                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                            <?php
                                                //Inisialisasi nilai variabel awal
                                                $nama_part= "";
                                                $jumlahOpen=null;
                                                $jumlahOnGoing=null;
                                                $jumlahClose=null;
                                                foreach ($grafik as $item)
                                                {
                                                    $part=$item->product_drawing;
                                                    $nama_part .= "'$part'". ", ";
                                                    $countA=$item->Open;
                                                    $countB=$item->OnGoing;
                                                    $countC=$item->Close;
                                                    $jumlahOpen .= "$countA". ", ";
                                                    $jumlahOnGoing .= "$countB". ", ";
                                                    $jumlahClose .= "$countC". ", ";
                                                }
                                            ?>
                                        <p class="highcharts-description" align="center">
                                            Part Material
                                        </p>
                                        <div id="button-bar">
                                            <button id="small">Small</button>
                                            <button id="large">Large</button>
                                            <button id="auto">Auto</button>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                    <!-- <?php
                        }else{
                            $grafik = array();
                        }
                    ?> -->
                </div>
            </section>
        </div>

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

        <!-- Membuat Grafik -->
        <script src="<?= base_url();  ?>assets/highcharts/highcharts.js"></script>
        <script src="<?= base_url();  ?>assets/highcharts/data.js"></script>
        <script src="<?= base_url();  ?>assets/highcharts/exporting.js"></script>
        <script src="<?= base_url();  ?>assets/highcharts/export-data.js"></script>
        <script src="<?= base_url();  ?>assets/highcharts/accessibility.js"></script>
        <script type="text/javascript">
            // Create the chart
            var chart = Highcharts.chart('container', {

            chart: {
                type: 'column'
            },

            title: {
                text: 'GRAFIK REPORT CONTACTLIST'
            },

            subtitle: {
                text: 'PT. SCHLEMMER AUTOMOTIVE INDONESIA'
            },

            legend: {
                align: 'right',
                verticalAlign: 'middle',
                layout: 'vertical'
            },

            xAxis: {
                categories: [<?php echo $nama_part; ?>],
                labels: {
                    x: -10
                }
            },

            yAxis: {
                allowDecimals: false,
                title: {
                    text: 'Jumlah'
                }
            },

            series: [{
                name: 'Status : Open',
                data: [<?php echo $jumlahOpen; ?>]
            }, {
                name: 'Status : On Going',
                data: [<?php echo $jumlahOnGoing; ?>]
            }, {
                name: 'Status : Close',
                data: [<?php echo $jumlahClose; ?>]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
            });

            document.getElementById('small').addEventListener('click', function () {
            chart.setSize(400);
            });

            document.getElementById('large').addEventListener('click', function () {
            chart.setSize(600);
            });

            document.getElementById('auto').addEventListener('click', function () {
            chart.setSize(null);
            });
        </script>
