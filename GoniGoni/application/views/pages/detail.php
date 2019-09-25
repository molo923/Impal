<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/assettmp/js/chartjs/Chart.js"></script>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Detail Sampah</h1>

     <?php if($this->session->flashdata('inkatfail')){ ?>
                <div class="widget-box">
           <div class="alert alert-error">
              <button class="close" data-dismiss="alert"  >×</button>
              <strong>Gagal Menambahkan!</strong> Id Kategori Sampah Sudah Ada</div>
        </div>      <?php } ?> 

         <?php if($this->session->flashdata('inkatsuc')){ ?>
                <div class="widget-box">
           <div class="alert alert-success">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Berhasil !</strong>Data Berhasil Ditambahkan </div>
        </div>      <?php } ?> 

        <?php if($this->session->flashdata('hapuskatsuc')){ ?>
                <div class="widget-box">
           <div class="alert alert-success">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Berhasil !</strong>Data Berhasil Dihapus </div>
        </div>      <?php } ?> 
  </div>
  <div class="container-fluid">
    <hr>
      <form method="POST" action="<?=base_url();?>C_stoking/detailstok/<?=$id_kat;?>">
      <div class="control-group">
              <label class="control-label">Periode :</label>
              <div class="controls">
                <input type="number" name="date" value="<?=$date;?>" max="<?=$maxtang;?>" min='1' class="span1 m-wrap">
                <?php if ($cek == 0) {?>
                  <input type="month"  name='periode' value="<?=$periode;?>" readonly/>
                  <input type="submit" name="submit" value="Ubah" class="btn btn-mini btn-info">
                <?php } ?>

                <?php if ($cek == 1) { ?>
                <input type="month"  name='periode' value="<?=$periode;?>" max="<?=date("Y-m", strtotime("-1 months"));?>" required/>
                <input type="hidden" name="detail" value="a">
                <input type="submit" name="submit" value="Ubah" class="btn btn-mini btn-info">
               <?php }?>
              </div>
            </div>
      </form>
        <div class="widget-box">
          <div class="widget-title"> 
            <h5>Jenis sampah : <?=$kat['jenis']?></h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Kode</th>
                  <th>Kondisi</th>
                  <th>Pertambahan (Kg)</th>
                  <th>Pengurangan (Kg)</th>
                  <th>Reject (Kg)</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($detail as $d ) {?>
                <tr>
                  <td><?=$d['tgl'];?></td>
                  <td><?=$d['kode'];?></td>
                  <td><?=$d['status'];?></td>
                  <?php if (substr($d['kode'],0 ,2) == 'S-' AND $d['kondisi'] != 'reject') {
                    # code..
                    echo "<td>".$d['berat']."</td><td>-</td><td>-</td>";
                    
                  }
                  else if (substr($d['kode'],0 ,2 ) == 'SK' AND $d['kondisi'] != 'reject') {
      
                    
                    if ( $d['rijek'] > 0) {
                      # code...
                        echo "<td>-</td><td>".$d['berat']."</td><td>".$d['rijek']."</td>";
                    }
                    else{
                      echo "<td>-</td><td>".$d['berat']."</td><td>-</td>";
                    }
                    
                  }

                  else if (substr($d['kode'],0 ,2 ) == 'SK' AND $d['rijek'] > 0) {
      
                    echo "<td>-</td><td></td><td>".$d['rijek']."</td>";
                    
                  }

                  else if ($d['kondisi'] == 'mutasian') {
                    # code...
                    echo "<td>".$d['berat']."</td><td>-</td><td>-</td>";
                  }

                  else if ($d['kondisi'] == 'dimutasi' or $d['kondisi'] == 'residu' ) {
                    # code...
                    echo "<td>-</td><td>".$d['berat']."</td><td>-</td>";
                  }

                  else {
                     echo "<td>-</td><td>-</td><td>".$d['berat']."</td>";
                  } 
                  ?>
                 
                </tr>
              <?php } ?>
            </tbody>
            </table>
          </div>
        </div>
        <center> 
        <ul class="stat-boxes2">
          <li>
            <div class="right"> <strong><?=$setoran?></strong>Total Setoran</div>
          </li>
          <li>
            <div class="right"> <strong><?=$setoranr?></strong>Total Setoran Reject</div>
          </li>
          <li>
            <div class="right"> <strong><?=$jual?></strong>Total Sampah Keluar</div>
          </li>
          <li>
            <div class="right"> <strong><?=$jualr?></strong>Total Sampah Keluar Reject</div>
          </li>
          <li>
            <div class="right"> <strong><?=$mutasi?></strong>Total Mutasian</div>
          </li>
          <li>
            <div class="right"> <strong><?=$dimutasi?></strong>Total Dimutasi</div>
          </li>
          <li>
            <div class="right"> <strong><?=$residu?></strong>Total Residu</div>
          </li>
        </ul>
        </center>
        <?php if ($cek == 1) { ?>
        <div class="widget-box">
          <div class="widget-title"> 
            <h5>Statistika Sampah <?=$kat['jenis']?></h5>
          </div>
          <div class="widget-content nopadding">
            <center>
            <div style="width: 1000px;height: 500px">
            <canvas id="myChart"></canvas>
            </div>
            </center>
          </div>
        </div>
      <?php } ?>

        <br>
        <span class="pull-left" ><a class="btn btn-primary" href="<?php echo base_url()?>C_Stoking<?php if($cek == 1){echo '/histori_sampah';}?>">Kembali</a></span>
      </div>
  </div>
</div>

<!--Footer-part-->
<script>

  var kat = <?=$id_kat?>;

  $(document).ready(function(){
    // body...
      $.ajax({
        type:"POST",
        url:"<?php echo base_url();?>C_Stoking/getsumsampah",
        data: {kat:kat},
        dataType:"JSON",
        success: function(result) {
          // body...
          var jumlah = {
            setoran:[],
            setoranr:[],
            jual:[],
            jualr:[],
            mutasian:[],
            dimutasi:[],
            residu:[],
          };
          
          var k = Object.keys(result[0]).length;
          for (var i =0; i < 7; i++) {
              for (var j = 1; j <= k; j++) {
                if (i == 0) {
                  jumlah.setoran.push(result[i][j]);
                }
                else if (i == 1) {
                  jumlah.setoranr.push(result[i][j]);
                }
                else if (i == 2) {
                  jumlah.jual.push(result[i][j]);
                }
                else if (i == 3) {
                  jumlah.jualr.push(result[i][j]);
                }
                else if (i == 4) {
                  jumlah.mutasian.push(result[i][j]);
                }
                else if (i == 5) {
                  jumlah.dimutasi.push(result[i][j]);
                }
                else if (i == 7) {
                  jumlah.residu.push(result[i][j]);
                }
              }
          }
          
        var dataful = {
          labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni","Juli","Agustus","September","Oktober","November","Desember"],
          datasets :
          [{
          label: 'Setoran',
          data: jumlah.setoran,
          backgroundColor: [
          '#1FB915'
          ],
          borderColor: [
          '#1FB915'
          ],
          fill:false,
          borderWidth: 1
        },
        {
          label: 'Setoran direject',
          data: jumlah.setoranr,
          backgroundColor: [
          '#89FF00'
          ],
          borderColor: [
          '#89FF00'
          ],
          fill:false,
          borderWidth: 1
        },
        {
          label: 'Sampah keluar',
          data: jumlah.jual,
          backgroundColor: [
          '#B72717'
          ],
          borderColor: [
          '#B72717'
          ],
          fill:false,
          borderWidth: 1
        },
        {
          label: 'Sampah keluar direject ',
          data: jumlah.jualr,
          backgroundColor: [
          '#B74717'
          ],
          borderColor: [
          '#B74717'
          ],
          fill:false,
          borderWidth: 1
        },
        {
          label: 'Mutasian',
          data: jumlah.mutasian,
          backgroundColor: [
          '#00bfff'
          ],
          borderColor: [
          '#00bfff'
          ],
          fill:false,
          borderWidth: 1
        },
        {
          label: 'Dimutasi',
          data: jumlah.dimutasi,
          backgroundColor: [
          '#bf00ff'
          ],
          borderColor: [
          '#bf00ff'
          ],
          fill:false,
          borderWidth: 1
        },
        {
          label: 'Residu',
          data: jumlah.residu,
          backgroundColor: [
          '#ff8000'
          ],
          borderColor: [
          '#ff8000'
          ],
          fill:false,
          borderWidth: 1
        }]
      };

      var ctx = document.getElementById("myChart").getContext('2d');

      var myChart = new Chart(ctx,{
        type:"line",
        data:dataful,
        options: {
        scales: {
          yAxes: [{
            ticks: {
              beginAtZero:false,

            }
          }]
        }
      }
      });
         
          //alert(JSON.stringify(dataful));
          
        },
        error:function(data) {
          // body...
          var s = JSON.stringify(data);
          alert(s);
        }
      });
  });
  </script>

<script src="<?php echo base_url()?>assets/assettmp/js/jquery.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.gritter.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.peity.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.interface.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.popover.js"></script>
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.tables.js"></script>
