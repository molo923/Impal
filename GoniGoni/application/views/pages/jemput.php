        <div id="content">
          <div id="content-header">
            <div id="breadcrumb">
              <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Home</a>
              <a href="#" class="current">Tables</a>
            </div>

            <h1>Table Jemput</h1>
            <?php //dd($jemput) ?>
            <?php if($this->session->flashdata('inkatfail')){ ?>
              <div class="widget-box">
                <div class="alert alert-error">
                  <button class="close" data-dismiss="alert"  >×</button>
                  <strong>Gagal Menambahkan!</strong> Id Kategori Sampah Sudah Ada
                </div>
              </div>      
            <?php } ?> 

            <?php if($this->session->flashdata('inkatsuc')){ ?>
              <div class="widget-box">
                <div class="alert alert-success">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Berhasil !</strong>Data Berhasil Ditambahkan
                </div>
              </div>      
            <?php } ?> 

            <?php if($this->session->flashdata('hapuskatsuc')){ ?>
              <div class="widget-box">
                <div class="alert alert-success">
                    <button class="close" data-dismiss="alert">×</button>
                    <strong>Berhasil !</strong>Data Berhasil Dihapus 
                </div>
              </div>      
            <?php } ?> 
          </div>

          <div class="container-fluid">
            <hr>
            <div class="widget-box">
              <div class="widget-title"> 
                <span class="pull-right">
                  <a href="<?php echo base_url()?>C_Sampahkeluar/insertsampahkeluarform" class="btn btn-primary">Tambah</a>
                </span>
              </div>

              <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                  <thead>
                    <tr>
                      <th>Id Jemput</th>
                      <th>Nama Nasabah</th>
                      <th>Jenis Jemput</th>
                      <th>Tgl Jemput</th>
                      <th>Tgl Selesai</th>
                      <th>Berat Estimasi</th>
                      <th>Berat Asli</th>
                      <th>Total Harga</th>
                      <th>Status</th>
                      <th>Keterangan</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($jemput as $j): ?>
                      <tr>
                        <!-- <a href="#myAlert" data-toggle="modal"  class="btn btn-primary" id="detail" value='a'>Detail</a> -->
                        <td><?php echo $j['id_jemputl'] ? $j['id_jemputl'] : $j['id_jemputs'] ?></td>
                        <td><?php echo $j['nama_nasabah'] ? $j['nama_nasabah'] : 'Bukan Nasabah' ?></td>
                        <td><?php echo $j['id_jemputl'] ? 'Langganan' : 'Sekali'  ?></td>
                        <td><?php echo $j['tgl_setorin'] ?></td>
                        <td><?php echo $j['tgl_setordone'] == '0000-00-00' ? '-' : $j['tgl_setordone'] ?></td>
                        <td><?php echo $j['perkiraan'] ?></td>
                        <td><?php echo $j['total_berat'] ?></td>
                        <td><?php echo $j['total_harga'] ?></td>
                        <td><?php echo $j['status_setoran'] ?></td>
                        <td><?php echo $j['keterangan_setoran'] ?></td>
                        <td>
                          <a href="#myAlert" data-toggle="modal"><button class="btn btn-primary" id="detail" value="0">Detail</button></a>
                          <a href="<?php echo base_url()?>C_Sampahkeluar/editsampahkeluarform/" class="btn btn-warning">Kelola</a>
                        </td>
                      </tr>
                    <?php endforeach ?>
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
          <div class="container-fluid widget-box" style="margin: 0">
            <div class="span3">
              <div class="widget-title">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#tab1">Langganan</a></li>
                  <li><a data-toggle="tab" href="#tab2">Harian</a></li>
                </ul>
              </div>
              <div class="widget-content tab-content">
                <div id="tab1" class="tab-pane active">
                  <div class="chat-users">
                    <div class="panel-title">
                      <h5>Online Users</h5>
                    </div>
                    <div class="panel-content nopadding">
                      <ul class="contact-list">
                        <li id="user-Alex"><a href=""><span>Alex</span></a></li>
                        <li id="user-Linda"><a href=""><span>Linda</span></a></li>
                        <li id="user-John"><a href=""><span>John</span></a></li>
                        <li id="user-Mark"><a href=""><span>Mark</span></a></li>
                        <li id="user-Maxi"><a href=""><span>Maxi</span></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div id="tab2" class="tab-pane">
                  <div class="chat-users">
                    <div class="panel-title">
                      <h5>Online Users</h5>
                    </div>
                    <div class="panel-content nopadding">
                      <ul class="contact-list">
                        <li id="user-Alex"><a href=""> <span>Alex</span></a></li>
                        <li id="user-Linda"><a href=""> <span>Linda</span></a></li>
                        <li id="user-John"><a href=""> <span>John</span></a></li>
                        <li id="user-Mark"><a href=""> <span>Mark</span></a></li>
                        <li id="user-Maxi"><a href=""> <span>Maxi</span></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
            <div class="span7">
              <div id="calendar"></div>
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
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    plugins: [ 'dayGrid' ],
    themeSystem: 'dayGrid'
  });

  calendar.render();

  $('button').click(function(){
    var id = $(this).val();
    // var httt = '<tr class="odd gradeX"><td>Trident</td>'
    //  $('.detailer').html(httt);
    // $.ajax({
    //   type: "POST",
    //   url : "<?php //echo base_url();?>C_Sampahkeluar/getdetail",
    //   data: { id : id },
    //   async : false,
    //   dataType: "json",
    //   success: function (data) {
    //     var html = '';
    //     var obj = $.parseJSON(JSON.stringify(data));
    //     var ambil = 'Detail Setoran ('+obj[0].id_sampahkeluar+')';
    //     var i;
    //     for(i=0; i<data.length; i++){
    //     html += `
    //       <tr class="odd gradeX">
    //         <td>`+obj[i].kode_kat+`</td>
    //         <td>`+obj[i].jenis+`</td>
    //         <td>`+obj[i].berat+` Kg</td>
    //         <td>`+obj[i].berat_reject+` Kg</td>
    //         <td>Rp`+obj[i].harga_kg+`,-</td>
    //         <td>Rp`+obj[i].sub_harga+`,-</td>
    //         <td>`+obj[i].status_terima+`</td>
    //       </tr>
    //       `;
    //     }
    //     $('#huhu').html(ambil);
    //     $('.detailer').html(html);
    //   },
    //   error: function (response) {
    //     alert('eror');
    //   }
    // });
  });
});
</script>

<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.tables.js"></script>
