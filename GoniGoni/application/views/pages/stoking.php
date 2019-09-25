<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Stok Sampah</h1>

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
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="pull-right"><a href="<?=base_url()?>C_Stoking/histori_sampah" class="btn btn-primary">Histori Stok</a> </span>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Kode Sampah</th>
                  <th>Jenis</th>
                  <th>Jumlah Beli</th>
                  <th>Jumlah Hibah</th>
                  <th>Jumlah Lainnya</th>
                  <th>Jumlah Residu</th>
                  <th>Jumlah Mutasian</th>
                  <th>Jumlah Dimutasi</th>
                  <th>Jumlah Jual</th>
                  <th>Jumlah Nonjual</th>
                  <th>Jumlah Jual Reject</th>
                  <th>Stok Tersedia</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php  foreach ($stoking as $st) {?>
                <tr>
                  <td><?php echo $st['kode_kat'];?></td>
                  <td><?php echo $st['jenis'];?></td>
                  <td><?php echo $st['qbeli'];?> Kg</td>
                  <td><?php echo $st['qhibah'];?> Kg</td>
                  <td><?php echo $st['qlainnya'];?> Kg</td>
                  <td><?php echo $st['qresidu'];?> Kg</td>
                  <td><?php echo $st['qmutasian'];?> Kg</td>
                  <td><?php echo $st['qdimutasi'];?> Kg</td>
                  <td><?php echo $st['qjual'];?> Kg</td>
                  <td><?php echo $st['qnonjual'];?> Kg</td>
                  <td><?php echo $st['qreject'];?> Kg</td>
                  <td><?php 
                  $stok = ($st['qbeli'] + $st['qhibah'] + $st['qlainnya'] + $st['qmutasian'])-($st['qresidu']+$st['qdimutasi']+$st['qjual']+$st['qnonjual']+$st['qreject']); echo $stok;?> Kg</td>
                  <td>      
                    <center>
                      <a href="#myAlert" data-toggle="modal"><button class="btn btn-primary" id="detail" value='#' onclick="mutasian('<?php echo $st['kode_kat'];?>')">Mutasi</button>
                      </a>
                      <a href="#myAll" data-toggle="modal"><button class="btn btn-warning" id="detail" value='#' onclick="residu('<?php echo $st['kode_kat'];?>')">Kelola Residu</button></a>
                      <a href="<?=base_url()?>C_Stoking/detailstok/<?=$st['id_kategorisampah']?>"><button class="btn btn-info" id="detail" value='#'>Detail</button></a>
                    </center>
                  </td>
                  </tr>
                <?php } ?>
              </tbody>

            </table>

            <div id="myAlert" class="modal hide detailer">
            <div class="modal-header">
                <a data-dismiss="modal" class="close">×</a>
                <h3 id="huhu"></h3>
            </div>
            <div class="modal-body">
            <table class="table table-bordered data-table">
              <thead class="heder"></thead>
              <tbody class="budy"></tbody>
            </table>
            </div>
            <div class="modal-footer futer"></div>
            </div>
            </div>

            <div id="myAll" class="modal hide detailer">
            <div class="modal-header">
                <a data-dismiss="modal" class="close">×</a>
                <h3 id="huhu1"></h3>
            </div>
            <div class="modal-body budy1">
            </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Footer-part-->

<script src="<?php echo base_url()?>assets/assettmp/js/jquery.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.gritter.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.peity.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.interface.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.popover.js"></script>
<!-- <script type="text/javascript">
  function hadiah(val) {
  // body...
  //alert(id);
  $.ajax({
    type: "POST",
    url : "<?php //echo base_url();?>C_Setoran/hadiah",
    data : {val:val},
    async : false,
    dataType: "text",
    success:function(data){
      var obj = $.parseJSON(JSON.stringify(data));
      alert('Selamat '+ obj);
    }

  });
}
</script> -->
<!-- <script type="text/javascript">
    $(document).ready(function(){
        $('button').click(function(){
            var id=$(this).val();
            // var httt = '<tr class="odd gradeX"><td>Trident</td>'
            //  $('.detailer').html(httt);
                $.ajax({
                type: "POST",
                url : "<?php //echo base_url();?>C_Setoran/getdetail",
                data: { id : id },
                async : false,
                dataType: "json",
                success: function (data) {

    });

        });
    });
</script> -->
<script type="text/javascript">
  function mutasian(val){
    $.ajax({
      type: "POST",
      url:"<?php echo base_url();?>C_Stoking/getmutasian",
      data:{val:val},
      async : false,
      dataType :"json",
      success : function(data){
        // alert(data[0].berat_kg);
        var header=`
                <tr>
                  <th>Asal Mutasi</th>
                  <th>Berat Mutasi(Kg)</th>
              </tr>
              `;
        var huy ='Detail Permutasian ('+val+')';
        var body ='';
        var footer =`
              <span class="pull-right"><a href="<?php echo base_url()?>C_Stoking/mutasiform/`+val+`" class="btn btn-primary">Mutasi</a></span>
            <span class="pull-left"><a href="#" class="btn btn-info" disabled=''>Cek Mutasi</a></span>
            <span class="pull-left"><a href="#" class="btn btn-primary" onclick="dimutasi('`+val+`')">Cek Dimutasi</a></span>
            `;
        var i;
        for ( i = 0; i < data.length; i++) {
          body+=` <tr>
                  <td>`+data[i][0].jenis+`</td>
                  <td>`+data[i][0].berat+` Kg</td>
              </tr>`;
        }
          $('#huhu').html(huy);
          $('.heder').html(header);
          $('.budy').html(body);
          $('.futer').html(footer);
      },
      error: function (data) {
                alert('eror');
        }
    });
  }
</script>
<script type="text/javascript">
  function dimutasi(val){
    //alert(val);
    $.ajax({
      type: "POST",
      url:"<?php echo base_url();?>C_Stoking/getdimutasi",
      data:{val:val},
      async : false,
      dataType :"json",
      success : function(data){
        //alert(data[0].berat_kg);
        var header=`
                <tr>
                  <th>Tujuan Mutasi</th>
                  <th>Berat(Kg)</th>
              </tr>
              `;
        var huy ='Detail Permutasian ('+val+')';
        var body ='';
        var footer =`
              <span class="pull-right"><a href="<?php echo base_url()?>C_Stoking/mutasiform/`+val+`" class="btn btn-primary">Mutasi</a></span>
            <span class="pull-left"><a href="#" class="btn btn-primary" onclick="mutasian('`+val+`')">Cek Mutasi</a></span>
            <span class="pull-left"><a href="#" class="btn btn-info" disabled=''>Cek Dimutasi</a></span>
            `;
        var i;
          for ( i = 0; i < data.length; i++) {
          body+=` <tr>
                  <td>`+data[i][0].jenis+`</td>
                  <td>`+data[i][0].berat+` Kg</td>
              </tr>`;
        }
          $('#huhu').html(huy);
          $('.heder').html(header);
          $('.budy').html(body);
          $('.futer').html(footer);
      },
      error: function (data) {
                alert(data);
        }
    });
  }
</script>
<script type="text/javascript">
  function residu(val) {
    // body...
    var header = 'Insert Jumlah Residu ('+val+')';
    var budy = `
      <form action="<?php echo base_url()?>C_Stoking/insertresidu/`+val+`" method="POST" class="form-horizontal">

              <div class="control-group">
              <label class="control-label">Berat Residu :</label>
              <div class="controls">
              <input type="number" class="span3" placeholder="Berat Sampah /Kg" name="qresidu" step='0.001'required />
              </div>
            </div>
            <div class="form-actions">
              <span class="pull-right"><button type="submit" class="btn btn-warning">Kelola</button></span>
            </div>
      </form>
      `;
          $('#huhu1').html(header);
          $('.budy1').html(budy);
  }
</script>
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.tables.js"></script>
