@extends('layouts.app')
@section('content')


@if (Session::has('error'))
<h1>hellooooo</h1>
    <script>
        Swal.fire("Wellcome {{ Auth::user()->name }}","{!! Session::get("success") !!}","success",{
          timer: 1500,
        });
    </script>
@endif
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Peminjaman</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a>
					</li>
					<li class="breadcrumb-item active">Peminjaman</li>
				</ol>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</div>
	<!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->

<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<!-- /.row -->
		<div class="row">
                <div class="col-md-3">
                    <div class="card ">
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="form-group">
                                    <label>Nama Kendaraan</label>
                                    <select id="kendaraan"  name="kendaraan" class="form-control" required>
                                        <option value="" selected>--Kendaraan--</option>
                                        @foreach ($kendaraan as $key => $nama)
                                        <option value="{{ $key }}">{{ $nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="form-group">
                                    <label>Type</label>
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="" >--Select Type--</option>
                                    </select>
                                </div>
                            <div class="form-group">
                                    <label>Nama</label>
                                    <select id="namaBan" name="namaBan" class="form-control" required>
                                        <option value="" >--Select Nama--</option>
                                    </select>
                             </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-olive">
                        <div class="card-header">
                            <h3 class="card-title">TABLE DETAIL</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0" style="height: 300px;">
                            <table class="table table-head-fixed text-nowrap ukuran" id="tabel_ukuran">
                              <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Ukuran</th>
                                    <th>RIM</th>
									<th>PELEK</th>
									<th>TIPE</th>
									<th>PLY</th>
									<th>Stock</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                              </thead>
                              <tbody class="data">

                            </tbody>
                            </table>
                          </div>
                        <!-- /.card-body -->
                    </div>
                </div>

					<!-- /.card-body -->
			</div>
				<!-- /.card -->
	</div>
</section>

<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<!-- /.row -->
		<div class="row">
			<div class="col-12">
                <form action="" id="formTransaksi" name="formTransaksi" class="form-horizontal">
				<div class="card card-olive">
					<div class="card-header">
                        <div class="row">
                        <div class="col-md 2">
                            <input type="text" id="faktur" name="faktur" class="form-control" placeholder="No faktur" value="{{ Session::get('faktur') }}" readonly>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-4">
                            <input type="hidden" name="id_staf" class="form-control" value="{{ $staf->id }}">
                            <input type="text" class="form-control"  value="{{ $staf->nama }}" readonly>
                        </div>
                      </div>
                    </div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<table class="table table-hover text-center detail" id="table_detail">
							<thead>
								<tr>
									<th>NO</th>
									<th>Ukuran</th>
									<th>Nama</th>
									<th>Type</th>
									<th>Kendaraan</th>
									<th width="50" >Jumlah</th>
									<th>Action</th>
								</tr>
							</thead>
                            <tbody >

                            </tbody>

						</table>
					</div>
                    <hr>
					<!-- /.card-body -->
                    <div class="card-footer justify-content-between">
                        <div class="float-right">
                            <button type="button" class="btn btn-danger swalDefaultWarning">
                                Back
                              </button>
                            {{-- <a href="{{ route('session.flush') }}" class="btn btn-danger">Back</a> --}}
                            <button type="submit" id="saveTransaksi" class="btn btn-primary ">Submit</button>
                        </div>
                    </div>
				</div>
            </form>
				<!-- /.card -->
			</div>
		</div>
		<!-- /.row -->
		<!-- Main row -->
		<!-- /.row -->
	</div>
</section>
{{-- Modal add Barang --}}
<div class="modal fade" id="modal_addData" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="formAdd" name="formAdd" class="form-horizontal">
        <div class="modal-header">
          <h4 class="modal-title" id="modelHeadingAdd"></h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
          <div class="row">
                  <input type="hidden" id="idNama" name="idNama">
                  <input type="hidden" id="idDetail" name="idDetail">
                  <div class="col-sm-7">
                <input type="text" class="form-control" id="detail" name="detail" disabled>
              </div>
                <div class="col-sm-5">
                  <input type="number" id="jumlah" name="jumlah" class="form-control" placeholder="Jumlah">
                </div>

              </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button id="btnSaveAdd" type="submit" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min-1.19.2.js') }}" ></script>

<script>
    $(document).ready(function(){
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
    });


    $(document).ready(function(){
        $('#table_detail').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('loan.prosesDatatable') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'detail', name: 'detail'},
                    {data: 'nama', name: 'nama'},
                    {data: 'type', name: 'type'},
                    {data: 'kendaraan', name: 'kendaraan'},
                    {data: 'jumlah', name: 'jumlah'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'asc']]
        });
    });



    //add jumlah data
    $('body').on('click', '#addData', function () {
            $(".editJumlah").hide();
            $(".addJumlah").show();
            var add = $(this).data('id');
            //  console.log(data_id);
            $.get('proses/'+ add +'/addData', function (data) {
                if (data.stock == 0) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Stock Produk Kosong',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }else{
                $('#modelHeadingAdd').html("Masukan Jumlah Dipakai");
                $('#addData').val("add");
                $('#modal_addData').modal('show');

                $('#idNama').val(data.nama_id);
                $('#idDetail').val(data.id);
                $('#detail').val(data.ukuran_ban);
                }
            })
        });

    //save jumlah data
    if ($("#formAdd").length > 0) {
        $("#formAdd").validate({
            submitHandler: function (form) {
                var actionType = $('#btnSaveAdd').val();
                $('#btnSaveAdd').html('Sending..');
                var id_nama = $('#formAdd').find('#idNama').val();
                console.log(id_nama);
                $.ajax({
                    data: $('#formAdd').serialize(),
                    url: "{{ route('loanProses.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {

                            iziToast.success({
                            timeout: 2000,
                            title:'Successfully',
                            message: 'Data Berhasil Disimpan',
                            position: 'topRight'
                        });

                        $.ajax({
                        url:'proses/'+ id_nama+'/detailBan',
                        type:"GET",
                        dataType:"json",
                        success:function(data){
                            $('tbody.data').html(data.table_data);
                            $('#total_records').text(data.total_data);
                                }
                            });
                        $('#formAdd').trigger("reset");
                        $('#modal_addData').modal('hide');
                        $('#btnSaveAdd').html('Save Changes');
                        $('table.detail').DataTable().ajax.reload();
                        var oTable = $('#table_detail').dataTable();
                        oTable.fnDraw(false);
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#btnSaveAdd').html('Save Changes');
                        Swal.fire({
                                icon: 'error',
                                title: 'Stock Avaiable '+ data.responseJSON.stock,
                                text: 'Stock tidak mencukupi!',
                            })
                    }
                });
            }
        });
    }


    $('body').on('click', '#deleteDetail', function () {
        var detail_id = $(this).data("id");

        $.ajax({
            type: "delete",
            url: "proses/" + detail_id +"/destroy",
            success: function (data) {
            var oTable = $('#table_detail').dataTable();
            $('table.reload').DataTable().ajax.reload();
            oTable.fnDraw(false);
            iziToast.warning({
                            title:'Delete',
                            message: 'Data Berhasil Didelete',
                            position: 'bottomRight'
                        });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    if ($("#formTransaksi").length > 0) {
        $("#formTransaksi").validate({
            submitHandler: function (form) {
                var actionType = $('#saveTransaksi').val();
                $('#saveTransaksi').html('Sending..');
                $.ajax({
                    data: $('#formTransaksi').serialize(),
                    url: "{{ route('loanTransaksi.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        window.location.href = "{{ route('loan.index') }}";

                        $('#formTransaksi').trigger("reset");
                        $('#saveTransaksi').html('Save Changes Kendaraan');
                        oTable.fnDraw(false);
                        iziToast.success({
                            title:'Successfully',
                            message: 'Data Berhasil Tersimpan',
                            position: 'topRight'
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveTransaksi').html('Save Changes');
                    }
                });
            }
        });
    }

    $(document).ready(function(){
        $('select[name="kendaraan"]').on('change', function(){
            var typeID = $(this).val();
            if(typeID){
                $.ajax({
                    url: 'proses/'+ typeID + '/selectType',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="type"]').empty();
                        if(data == ''){
                        $('#type').append('<option disabled selected>--Data Tidak Ada--</option>');
                            }else{
                        $('#type').append('<option selected>--Select One--</option>');
                            }
                        $.each(data, function(key, value){
                            $('select[name="type"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="type"]').empty();
            }
        });

    });

    $(document).ready(function(){
        $('select[name="type"]').on('change', function(){
            var namaID = $(this).val();
            if(namaID){
                $.ajax({
                    url: 'proses/'+ namaID+'/selectNama',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('select[name="namaBan"]').empty();
                        if(data == ''){
                        $('#namaBan').append('<option disabled selected>--Data Tidak Ada--</option>');
                            }else{
                        $('#namaBan').append('<option selected>--Select One--</option>');
                            }
                        $.each(data, function(key, value){
                            $('select[name="namaBan"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }else{
                $('select[name="namaBan"]').empty();
            }
        });

    });

    $(document).ready(function(){
        $('select[name="namaBan"]').on('change', function(){
            var ukuranID = $(this).val();
                $.ajax({
                    url:'proses/'+ ukuranID+'/detailBan',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('tbody.data').html(data.table_data);
                        $('#total_records').text(data.total_data);

                    }
                });

        });

    });


    $('.swalDefaultWarning').click(function() {
        Swal.fire({
            title: 'Apa Kamu yakin?',
            text: "Semua Data Di Table Peminjaman Akan Ter Deleted!!!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!',
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                    url: "{{ route('loan.flush') }}",
                    type:"GET",
                    success:function(data){
                        window.location.href = "{{ route('loan.index') }}";
                    }
                });
            Swal.fire({
            title: 'Deleted',
            icon: 'success',
            timer: 1000,
            showConfirmButton: false,
            })
        }
        })
      });







</script>
@endsection
