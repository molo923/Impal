@extends('layouts.matrix')

@section('content')

    @include('partials.breadcrumb', ['title' => $title])

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
{{--                        @include('partials.deprecated.add-kategori-sampah-modal')--}}

                        <div class="table-responsive">
                            <table class="zero_config table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th class="all">Kode</th>
                                    <th>Golongan</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th class="no-sort all">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($kategorisampahs as $kategorisampah)
                                        <tr>
                                            <td></td>
                                            <td>{{ $kategorisampah->code }}</td>
                                            <td>{{ $kategorisampah->name }}</td>
                                            <td>{{ $kategorisampah->jenissampah->type  }}</td>
                                            <td>{{ !$kategorisampah->banksampahKategorisampah->isEmpty() ? $kategorisampah->price_rp . '/' . $kategorisampah->uom : '-' }}</td>
                                            <td>{{ $kategorisampah->description }}</td>
                                            <td>
                                                <span class="badge badge-{{ !$kategorisampah->banksampahKategorisampah->isEmpty()
                                                    && check_status($kategorisampah->banksampahKategorisampah->first()->status_id, 'AKTIF')
                                                    ? 'success'
                                                    : 'danger' }}">
                                                    {{ !$kategorisampah->banksampahKategorisampah->isEmpty()
                                                        ? $kategorisampah->banksampahKategorisampah->first()->status->name
                                                        : 'Tidak Aktif' }}
                                                </span>
                                            </td>
                                            <td>
                                                @if (!$kategorisampah->banksampahKategorisampah->isEmpty()
                                                    && check_status($kategorisampah->banksampahKategorisampah->first()->status_id, 'AKTIF'))
                                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ubah</button>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a href="#" data-toggle="modal" data-target="#ubahHargaModal" data-id="{{ $kategorisampah->id }}" data-price="{{ number_format($kategorisampah->banksampahKategorisampah->first()->price, 0, ',', '') }}" data-price-rec="@rp($kategorisampah->price_rec)" data-uom="{{ $kategorisampah->uom }}" class="dropdown-item">
                                                            <i class="mdi mdi-pencil mr-1 mdi-18px"></i> Ubah Harga
                                                        </a>
                                                        <a href="#" data-toggle="modal" data-target="#deactivateModal" data-id="{{ $kategorisampah->id }}" class="dropdown-item">
                                                            <i class="mdi mdi-block-helper mr-2"></i> Non-aktif
                                                        </a>
                                                    </div>
                                                @else
                                                    <button type="button" data-toggle="modal" data-target="#activateModal" data-price-rec="@rp($kategorisampah->price_rec)" data-id="{{ $kategorisampah->id }}" data-uom="{{ $kategorisampah->uom }}" data-price="{{ $kategorisampah->banksampahKategorisampah->isEmpty() ? 'null' : number_format($kategorisampah->banksampahKategorisampah->first()->price, 0, ',', '') }}" class="btn btn-sm btn-primary">
                                                        Aktifkan
                                                    </button>
                                                @endif
                                                    <a href="#" data-toggle="modal" data-katid="{{ $kategorisampah->id }}" data-target="#detailKategorisampahModal" class="btn btn-sm btn-info">Detail</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th></th>
                                    <th>Kode</th>
                                    <th>Golongan</th>
                                    <th>Jenis</th>
                                    <th>Harga</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->

        <div id="activateModal" class="modal fade">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Aktifkan Kategori Sampah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="activateForm" action="" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price_rec">Rekomendasi Harga</label>
                                        <p class="m-0 font-bold"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Harga Sampah</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="price" placeholder="0.00" class="form-control @error('price') is-invalid @enderror">
                                        </div>

                                        @error('price')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="m-0 text-muted">
                                        (*) Masukkan harga sampah untuk melanjutkan.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" disabled class="btn btn-primary" onclick="event.preventDefault();
                                                                               document.getElementById('activateForm').submit()">Tambahkan</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="ubahHargaModal" class="modal fade">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ubah Harga Kategori Sampah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="ubahHargaForm" action="" method="POST">
                            @method('PUT')
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="price_rec">Rekomendasi Harga</label>
                                        <p class="m-0 font-bold"></p>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Harga Sampah</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="price" placeholder="0.00" class="form-control @error('price') is-invalid @enderror">
                                        </div>

                                        @error('price')
                                        <span class="invalid-feedback d-block" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p class="m-0 text-muted">
                                        (*) Masukkan harga sampah untuk melanjutkan.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" onclick="event.preventDefault();
                                                                               document.getElementById('ubahHargaForm').submit()">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="deactivateModal" class="modal fade">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Non-aktif Kategori Sampah</h5>
                        <button class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="deactivateForm" action="{{ route('kategori-sampah.deactivate') }}" class="d-none" method="POST">
                            @csrf

                            <input type="hidden" name="id">
                        </form>
                        Apakah anda yakin ingin menonaktifkan kategori sampah ini?
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger" onclick="event.preventDefault();
                                                                               document.getElementById('deactivateForm').submit()">Non-aktifkan</button>
                    </div>
                </div>
            </div>
        </div>
        <div id="detailKategorisampahModal" class="modal fade">
            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Kategori Sampah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <img style="width: 100%;height: 400px;object-fit: cover;" src="#" alt="" id="kategorisampahGambar">
                            </div>
                            <div class="col-md-6" id="detailKategorisampahModalDetail">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection
@section('extra-script')
    <script>
        $(function() {
            $("#detailKategorisampahModal").on("show.bs.modal", function(e) {
                var modal = $(this);
                var id = $(e.relatedTarget).data('katid');

                $.ajax({
                    type: "POST",
                    url: "{{ url('api/kategori-sampah') }}" + "/" + id,
                    success: function (data) {
                        data;
                        $("#kategorisampahGambar").attr("src", data.img_url).imagesLoaded({
                            },
                            function() {
                                $(".spinner-border").addClass("d-none");
                            }
                        );
                        modal.find(".modal-title").text("Kategori Sampah - "+data.code);
                        $("#detailKategorisampahModalDetail").html(`
                            <p>Kode: <span class="font-medium">${data.code}</span></p>
                            <p>Golongan: <span class="font-medium">${data.name}</span></p>
                            <p>Jenis: <span class="font-medium">${data.jenissampah.type}</span></p>
                            <p>Deskripsi: <span class="font-medium">${data.description}</span></p>
                        `);
                    }
                });
            });

            $("#detailKategorisampahModal").on("hide.bs.modal", function(e) {
                $("#kategorisampahGambar").attr("src", "#");
            })
        });

        $(function() {
            var modal = $("#activateModal");

            modal.on("show.bs.modal", function(event) {
                var btn = $(event.relatedTarget);
                var id = btn.data("id");
                var price_rec = btn.data("price-rec");
                var uom = btn.data("uom");

                if (btn.data("price") != "undefined") {
                    var price = btn.data("price");
                    modal.find("input[name=price]").val(price);
                }

                if (modal.find("input[name=price]").val() !== "") {
                    modal.find("button[type=button]").attr("disabled", false);
                }

                modal.find("form").attr({
                    action: "{{ route('kategori-sampah.activate', '') }}/"+id
                });
                modal.find(".form-group p").text(price_rec+"/"+uom);
            });

            modal.find("input").on("input", function() {
                 if ($(this).val() !== "") {
                     modal.find("button[type=button]").attr("disabled", false);
                 } else {
                     modal.find("button[type=button]").attr("disabled", "disabled");
                 }
            });
        });

        $(function() {
            var modal = $("#ubahHargaModal");

            modal.on("show.bs.modal", function(event) {
                var btn = $(event.relatedTarget);
                var id = btn.data("id");
                var price_rec = btn.data("price-rec");
                var price = btn.data("price");
                var uom = btn.data("uom");

                modal.find("form").attr({
                    action: "{{ route('kategori-sampah.change-price', '') }}/"+id
                });
                modal.find(".form-group p").text(price_rec+"/"+uom);
                modal.find("input[name=price]").val(price);
            });

            modal.find("input").on("input", function() {
                if ($(this).val() !== "") {
                    modal.find("button[type=button]").attr("disabled", false);
                } else {
                    modal.find("button[type=button]").attr("disabled", "disabled");
                }
            });
        });

        $(function() {
            var modal = $("#deactivateModal");

            modal.on("show.bs.modal", function(event) {
                var id = $(event.relatedTarget).data("id");
                modal.find("input[name=id]").val(id);
            });
        });
    </script>
@endsection
