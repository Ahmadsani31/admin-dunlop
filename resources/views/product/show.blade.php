@extends('layouts.app')
@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">staf</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a>
					</li>
					<li class="breadcrumb-item active">staf</li>
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
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Table Ban Mobil</h3>
						<div class="card-tools">
							<div class="input-group input-group-sm">
                                <a href="javascript:void(0)" class="btn btn-primary" id="createNewData">Add Data</a>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<table class="table table-hover" id="data_table">
							<thead>
								<tr>
									<th>NO</th>
									<th>Type</th>
									<th>Nama</th>
									<th>Ukuran</th>
									<th>Rim</th>
									<th>Stock</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
                            {{-- @foreach ($mobil as $item)
                                <tr>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->rim }}</td>

                                </tr>
                            @endforeach --}}
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
		</div>
		<!-- /.row -->
		<!-- Main row -->
		<!-- /.row -->
	</div>
</section>
	<!--/. Modal-add -->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="modelHeading"></h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
            <form id="dataForm" name="dataForm" class="form-horizontal">
				<div class="container">
                        <div class="form-group row">
                            <div class="col-5">
                                <label>Type</label>
                                <select  name="type" class="form-control" required>
                                    <option value="" selected>--Choose TYPE--</option>
                                    @foreach ($type as $item => $value)
                                    <option value="{{ $item }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-7">
                                <label>Nama Ban</label>
								<input type="text" class="form-control" name="nama" placeholder="..." required>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>

						<div class="form-group row">
                            <div class="col-6">
								<label>Ukuran</label>
								<input type="text" class="form-control" name="ukuran[]" placeholder="..." required>
							</div>
                            <div class="col-3">
								<label>Rim</label>
								<select name="rim[]" class="form-control" required>
                                    <option selected>--Choose RIM--</option>
                                    @foreach ($rim as $item => $value)
                                    <option value="{{ $item }}">{{ $value }}</option>
                                    @endforeach
                                </select>
							</div>
                            <div class="col-2">
								<label>Stock</label>
								<input type="text" class="form-control" name="stock[]" placeholder="..." required>
							</div>
                            <div class="col-1 mt-4">
                                <button type='button' class='btn btn-success btn-sm mt-2 add_field'><i class='fa fa-plus'></i></button>
                            </div>
                        </div>
                        <div class="field_wrapper" id="form_add">
					    </div>

				</div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="saveBtnEdit" class="btn btn-primary" value="create">Save changes</button>
                </div>
            </form>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
</div>

	<!-- /.modal-Edit -->
    <div class="modal fade" id="ajaxModelEdit" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeadingEdit"></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form id="dataFormEdit" name="dataFormEdit" class="form-horizontal">
                    <div class="container">
                            <div class="form-group row">
                                <input type="hidden" name="id" id="id">
                                <div class="col-5">
                                    <label>Type</label>
                                    <select id="type" name="type" class="form-control" required>
                                        <option value="" selected>--Choose TYPE--</option>
                                        @foreach ($type as $item => $value)
                                        <option value="{{ $item }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-7">
                                    <label>Nama Ban</label>
                                    <input type="text" id="nama" class="form-control" name="nama" placeholder="..." required>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>

                            <div class="form-group row">
                                <div class="col-6">
                                    <label>Ukuran</label>
                                    <input type="text" id="ukuran" class="form-control" name="ukuran" placeholder="..." required>
                                </div>
                                <div class="col-3">
                                    <label>Rim</label>
                                    <select id="rim" name="rim" class="form-control" required>
                                        <option selected>--Choose RIM--</option>
                                        @foreach ($rim as $item => $value)
                                        <option value="{{ $item }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label>Stock</label>
                                    <input type="text" id="stock" class="form-control" name="stock" placeholder="..." required>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtnEdit" class="btn btn-primary" value="create">Save changes</button>
                    </div>
                </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
<!-- MULAI MODAL KONFIRMASI DELETE-->

<div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">PERHATIAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>Jika menghapus Pegawai maka</b></p>
                <p>*data pegawai tersebut hilang selamanya, apakah anda yakin?</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                    Data</button>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min-1.19.2.js') }}" ></script>

<script type="text/javascript">

    $(document).ready(function(){
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
        });
    });

    $('#createNewData').click(function () {
        $('#saveBtn').val("create-data");
        $('#id').val('');
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Create Data Mobil");
        $('#ajaxModel').modal('show');
    });

    $(document).ready(function(){
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('dataTable') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'type', name: 'type'},
                    {data: 'nama', name: 'nama'},
                    {data: 'ukuran', name: 'ukuran'},
                    {data: 'rim', name: 'rim'},
                    {data: 'stock', name: 'stock'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'asc']]
        });
    });

    $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_field'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var x = 1; //Initial field counter is 1


        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append('<div class="form-group row" id="row'+x+'">'+
                        '<div class="col-6">'+
                            '<label>Ukuran</label>'+
                            '<input type="text" class="form-control" name="ukuran[]" placeholder="..." required>'+
                        '</div>'+
                        '<div class="col-3">'+
                            '<input type="hidden" name="id">'+
                            '<label>Rim</label>'+
                            '<select id="rim" name="rim[]" class="form-control" required>'+
                                '<option value="" selected>--Choose RIM--</option>'+
                                '@foreach ($rim as $item => $value)'+
                                '<option value="{{ $item }}">{{ $value }}</option>'+
                                '@endforeach'+
                            '</select>'+
                        '</div>'+
                        '<div class="col-2">'+
                            '<label>Stock</label>'+
                            '<input type="text" class="form-control" name="stock[]" placeholder="..." required>'+
                        '</div>'+
                        '<div class="col-1 mt-4">'+
                            '<button type="button" id="'+x+'" class="btn btn-danger btn-sm mt-2 remove_field"><i class="fa fa-minus"></i></button>'+
                        '</div>'+
                        '</div>'); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_field', function(e){
            var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
            // e.preventDefault();
            // $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    if ($("#dataForm").length > 0) {
        $("#dataForm").validate({
            submitHandler: function (form) {
                var actionType = $('#saveBtn').val();
                $('#saveBtn').html('Sending..');
                $.ajax({
                    data: $('#dataForm').serialize(),
                    url: "{{ route('mobil.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#dataForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $('#saveBtn').html('Save Changes');
                        $('#form_add').html('');
                        var oTable = $('#data_table').dataTable();
                        oTable.fnDraw(false);
                        iziToast.success({
                            title:'Data Berhasil Tersimpan',
                            message: '{{ Session('success') }}',
                            position: 'bottomRight'
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('Save Changes');
                    }
                });
            }
        })
    }

    $('body').on('click', '.editData', function () {
            var data_id = $(this).data('id');
            //  console.log(data_id);
            $.get("mobil" +'/' + data_id +'/edit', function (data) {
                $('#modelHeadingEdit').html("Edit Data Mobil");
                $('#saveBtnEdit').val("edit-data");
                $('#ajaxModelEdit').modal('show');

                $('#id').val(data.id);
                $('#type').val(data.id_type);
                $('#nama').val(data.nama);
                $('#ukuran').val(data.ukuran);
                $('#rim').val(data.id_rim);
                $('#stock').val(data.stock);

            })
        });

        if($("#dataFormEdit").length > 0){
        $("#dataFormEdit").validate({
            submitHandler: function (form) {
                var actionType = $('#saveBtnEdit').val();
                var id = $('#dataFormEdit').find('#id').val();
                $('#saveBtnEdit').html('Sending..');

                $.ajax({
                    data: $('#dataFormEdit').serialize(),
                    url: "mobil" +'/'+ id,
                    type: 'PATCH',
                    dataType: 'json',
                    success: function (data) {
                        $('#dataFormEdit').trigger("reset");
                        $('#ajaxModelEdit').modal('hide');
                        $('#saveBtnEdit').html('Save Changes');
                        var oTable = $('#data_table').dataTable();
                        oTable.fnDraw(false);
                        iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Data Berhasil Disimpan',
                                message: '{{ Session('success ')}}',
                                position: 'bottomRight'
                            });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtnEdit').html('Save Changes');
                    }
                });
            }
        })
    }

        $(document).on('click', '.delete', function () {
            dataId = $(this).attr('id');
            $('#konfirmasi-modal').modal('show');
        });
        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({
                url: "mobil/" + dataId, //eksekusi ajax ke url ini
                type: 'delete',
                beforeSend: function () {
                    $('#tombol-hapus').text('Hapus Data'); //set text untuk tombol hapus
                },
                success: function (data) { //jika sukses
                    setTimeout(function () {
                        $('#konfirmasi-modal').modal('hide'); //sembunyikan konfirmasi modal
                        var oTable = $('#data_table').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    });
                    iziToast.warning({ //tampilkan izitoast warning
                        title: 'Data Berhasil Dihapus',
                        message: '{{ Session('
                        delete ')}}',
                        position: 'bottomRight'
                    });
                }
            })
        });

    </script>
@endsection
