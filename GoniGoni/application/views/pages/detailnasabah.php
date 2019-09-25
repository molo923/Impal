<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Setoran Sampah</h1>

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
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Id Setoran</th>
                  <th>Nama</th>
                  <th>Jenis Setoran</th>
                  <th>Tgl Setoran Masuk</th>
                  <th>Tgl Proses Selesai</th>
                  <th>Total Berat Sampah</th>
                  <th>Total Bersih Harga Sampah</th>
                  <th>Biaya Setoran</th>
                  <th>Status Setoran</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($setoran as $s) { ?>
                <tr>
                  <td><?php echo $s['id_setoran']; ?></td>
                  <td><?php 
                  if ($s['id_nasabah'] == "") {
                    # code...
                    echo "Bukan Nasabah";
                  }
                  else{
                  echo $s['nama_nasabah']; 
                }
                  ?></td>
                  <td><?php echo $s['jenis_setoran']; ?></td>
                  <td><?php echo $s['tgl_setorin']; ?></td>
                  <td><?php echo $s['tgl_setordone']; ?></td>
                  <td><?php echo $s['total_berat']; ?> Kg</td>
                  <td>Rp<?php echo $s['total_harga']; ?></td>
                  <td>Rp<?php echo $s['biaya_setoran'];?></td>
                  <td><?php echo $s['status_setoran']; ?></td>
                  <td><?php echo $s['keterangan_setoran']; ?></td>
                  <td>      
     <!--                <a href="#myAlert" data-toggle="modal"  class="btn btn-primary" id="detail" value='a'>Detail</a> -->
                    <center>
                      <a href="#myAlert" data-toggle="modal"><button class="btn btn-primary" id="detail" value='<?php echo $s["id_setoran"];?>' onclick="hadiah(<?php echo $s['total_harga']?>)">Detail</button></a>
                    </center>
                  </td>
                  </tr>
              <?php } ?>
              </tbody>

            </table>

            <div id="myAlert" class="modal hide">
              <div class="modal-header">
                <a data-dismiss="modal" class="close">×</a>
                <h3 id="huhu">Detail Setoran</h3>
              </div>
              <div class="modal-body">
              <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id Kategori Sampah</th>
                  <th>Jenis Sampah</th>
                  <th>Berat</th>
                  <th>Sub Total</th>
                  <th>Status Sampah</th>
                </tr>
              </thead>
              <tbody class="detailer">

              </tbody>
            </table>

            </div>
            <div class="modal-footer">
            </div>
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
<script type="text/javascript">
    $(document).ready(function(){
        $('button').click(function(){
            var id=$(this).val();
            // var httt = '<tr class="odd gradeX"><td>Trident</td>'
            //  $('.detailer').html(httt);
                $.ajax({
                type: "POST",
                url : "<?php echo base_url();?>C_Setoran/getdetail",
                data: { id : id },
                async : false,
                dataType: "json",
                success: function (data) {
                var html = '';
                var obj = $.parseJSON(JSON.stringify(data));
                var ambil='Detail Setoran ('+obj[0].id_setoran+')';
                var i;
                    for(i=0; i<data.length; i++){
                        html += `

                <tr class="odd gradeX">
                  <td>`+obj[i].kode_kat+`</td>
                  <td>`+obj[i].jenis+`</td>
                  <td>`+obj[i].berat+` Kg</td>
                  <td>Rp`+obj[i].sub_harga+`</td>
                  <td>`+obj[i].status_sampah+`</td>
                </tr>
               `;
                    }
                    $('#huhu').html(ambil);
                    $('.detailer').html(html);

        },
                error: function (response) {
                alert('eror');
        }
    });

        });
    });
</script>
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.tables.js"></script>
