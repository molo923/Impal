<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Sampah Keluar</h1>

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
            <span class="pull-right"><a href="<?php echo base_url()?>C_Sampahkeluar/insertsampahkeluarform" class="btn btn-primary">Tambah</a> </span>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Id Sampah Keluar</th>
                  <th>Tgl Sampah Keluar</th>
                  <th>Tgl Sampah Keluar Selesai</th>
                  <th>Tujuan Sampah Keluar</th>
                  <th>Jenis Sampah Keluar</th>
                  <th>Berat Sampah Keluar</th>
                  <th>Berat Sampah Reject</th>
                  <th>Biaya Sampah Keluar</th>
                  <th>Total Harga</th>
                  <th>Status Sampah Keluar</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($sampahkeluar as $sk) { ?>
                <tr>
                  <td><?php echo $sk['id_sampahkeluar']; ?></td>
                  <td><?php echo $sk['tgl_sampahkeluar']; ?></td>
                  <td><?php echo $sk['tgl_done']; ?></td>
                  <td><?php echo $sk['tujuan_sampahkeluar']; ?></td>
                  <td><?php echo $sk['jenis_sampahkeluar']; ?></td>
                  <td><?php echo $sk['berat_sampahkeluar']; ?> Kg</td>
                  <td><?php echo $sk['tberat_reject']; ?> Kg</td>
                  <td><?php echo $sk['biaya_sampahkeluar']; ?></td>
                  <td><?php echo $sk['total_harga_sampahkeluar']; ?></td>
                  <td><?php echo $sk['status_sampahkeluar']; ?></td>
                  <td><?php echo $sk['keterangan_sampahkeluar']; ?></td>
                  <td>      
     <!--                <a href="#myAlert" data-toggle="modal"  class="btn btn-primary" id="detail" value='a'>Detail</a> -->
                    <center>
                      <a href="#myAlert" data-toggle="modal"><button class="btn btn-primary" id="detail" value='<?php echo $sk["id_sampahkeluar"];?>'>Detail</button></a>
                      <a href="<?php echo base_url()?>C_Sampahkeluar/editsampahkeluarform/<?php echo $sk['id_sampahkeluar']?>" class="btn btn-warning">Kelola</a>
                    </center>
                  </td>
                  </tr>
              <?php } ?>

              </tbody>

            </table>

            <div id="myAlert" class="modal hide">
              <div class="modal-header">
                <a data-dismiss="modal" class="close">×</a>
                <h3 id="huhu">Detail Sampah Keluar</h3>
              </div>
              <div class="modal-body">
              <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Kode Sampah Keluar</th>
                  <th>Jenis Sampah</th>
                  <th>Berat (Kg)</th>
                  <th>Berat Reject (Kg)</th>
                  <th>Harga Sampah</th>
                  <th>Sub Total</th>
                  <th>Status Terima</th>
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
<script type="text/javascript">
$(document).ready(function(){
        $('button').click(function(){
            var id=$(this).val();
            // var httt = '<tr class="odd gradeX"><td>Trident</td>'
            //  $('.detailer').html(httt);
                $.ajax({
                type: "POST",
                url : "<?php echo base_url();?>C_Sampahkeluar/getdetail",
                data: { id : id },
                async : false,
                dataType: "json",
                success: function (data) {
                var html = '';
                var obj = $.parseJSON(JSON.stringify(data));
                var ambil='Detail Setoran ('+obj[0].id_sampahkeluar+')';
                var i;
                    for(i=0; i<data.length; i++){
                        html += `

                <tr class="odd gradeX">
                  <td>`+obj[i].kode_kat+`</td>
                  <td>`+obj[i].jenis+`</td>
                  <td>`+obj[i].berat+` Kg</td>
                  <td>`+obj[i].berat_reject+` Kg</td>
                  <td>Rp`+obj[i].harga_kg+`,-</td>
                  <td>Rp`+obj[i].sub_harga+`,-</td>
                  <td>`+obj[i].status_terima+`</td>
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
