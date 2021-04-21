@extends('layouts.app')
@section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Staf</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a>
					</li>
					<li class="breadcrumb-item active">Staf</li>
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
						<h3 class="card-title">staf Table</h3>
						<div class="card-tools">
							<div class="input-group input-group-sm">
                                <a href="javascript:void(0)" class="btn btn-primary" id="createNewData">Input Data <i class='fa fa-plus-square'></i></a>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<table class="table table-hover" id="data_table">
							<thead>
								<tr>
									<th>NO</th>
									<th>Image</th>
									<th>ID</th>
									<th>Jabatan</th>
									<th>Nama</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Alamat</th>
									<th>Action</th>
								</tr>
							</thead>
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
            <div class="card-header">
                <div class="alert alert-danger alert-dismissible" role="alert" id="er" style="display: none;">
                    <strong>Something it's wrong!</strong> You should check in on some of those fields below.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul id="validation_errors">
                    </ul>
                  </div>
            </div>
			<div class="modal-body">
            <form id="dataForm" name="dataForm" class="form-horizontal" enctype="multipart/form-data">
				<div class="container">
						<div class="form-group row">
							<div class="col-6">
                                <input type="hidden" name="id">
								<label>ID staf</label>
								<input type="number" class="form-control" name="id_staf" placeholder="...ID staf" required>
							</div>
							<div class="col-6">
                                <label>Nama</label>
							<input type="text" name="nama" class="form-control" placeholder="...Nama staf" required>

							</div>
						</div>
						<div class="form-group row">
                           <div class="col-4">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control" required>
                                <option selected disabled>--Choose Jabatan--</option>
                                <option value="Staff">Staff</option>
                                <option value="Costumer Services">Costumer Services</option>
                                <option value="Delivery">Delivery</option>
                            </select>
                        </div>
                           <div class="col-4">
                            <label>Email</label>
							<input type="text" name="email" class="form-control" name="jabatan" placeholder="...email" required>
                        </div>
                        <div class="col-4">
                            <label>No Telephone</label>
							<input type="text" name="phone" class="form-control" name="" placeholder="...no telepon" required>
                        </div>
						</div>
						<div class="form-group">
							<label>Alamat</label>
							<textarea class="form-control" name="alamat" rows="3" placeholder="...alamat" required></textarea>
						</div>
                        <div class="form-group">
                            <label for="exampleInputFile">File Profile</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" accept="image/*" onchange="readURL(this);">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>

                            </div>
                          </div>
                          <div class="text-center">
                            <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100">
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
                <form id="dataFormEdit" name="dataFormEdit" class="form-horizontal" enctype="multipart/form-data">
                    <div class="container">
                        <div class="text-center">
                            <div id="store_image"></div>
                            <hr>
                        </div>
                            <div class="form-group row">
                                <div class="col-6">
                                    <input type="hidden" name="id" id="id">
                                    <label>ID staf</label>
                                    <input type="hidden" class="form-control"  id="id_stafHidden" name="id_staf">
                                    <input type="text" class="form-control" name="id_staf"  id="id_staf" placeholder="...ID staf" disabled>
                                </div>
                                <div class="col-6">
                                    <label>Nama</label>
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="...Nama staf" required>

                                </div>

                            </div>
                            <div class="form-group row">
                                <div class="col-4">
                                    <label>Jabatan</label>
                                    <select id="jabatan" name="jabatan" class="form-control" required>
                                        <option selected disabled>--Choose Jabatan--</option>
                                        <option value="Staff">Staff</option>
                                        <option value="Costumer Services">Costumer Services</option>
                                        <option value="Delivery">Delivery</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label>Email</label>
                                    <input type="text" id="email" name="email" class="form-control" name="jabatan" placeholder="...email" required>
                                </div>
                                <div class="col-4">
                                    <label>No Telephone</label>
                                    <input type="text" id="phone" name="phone" class="form-control" name="" placeholder="...no telepon" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" id="alamat" name="alamat" rows="3" placeholder="...alamat" required></textarea>
                            </div>
                            <div class="form-group">
                                <label>Update Profile</label>
                                <input type="hidden" name="hidden_image_update" id="hidden_image_update">

                                <div class="input-group">
                                  <div class="custom-file">
                                    <input type="file" id="image" class="custom-file-input" name="image">

                                    <label class="custom-file-label">Choose file</label>
                                  </div>

                                </div>
                              </div>
                            </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="saveBtn" class="btn btn-primary" value="create">Save changes</button>
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
            <div class="modal-header bg-danger ">
                <h4 class="modal-title">PERHATIAN</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5><b>Jika menghapus staf maka</b></h5>
                <h6>*Data staf tersebut hilang selamanya, apakah anda yakin?</h6>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Hapus
                    Data</button>
            </div>
        </div>
    </div>
</div>
    <script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.validate.min-1.19.2.js') }}" ></script>

    {{-- @role('admin')
<script>

$(document).ready(function(){
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('staf.index') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'image', name: 'image',render:function(data, type, full, meta)
                        {
                        return "<img src={{ URL::to('/') }}/images/profile/" + data +" width='100' class='img-thumbnail' />";
                        },orderable: false
                    },
                    {data: 'id_staf', name: 'id_staf'},
                    {data: 'jabatan', name: 'jabatan'},
                    {data: 'nama', name: 'nama'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'alamat', name: 'alamat'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'asc']]
        });
    });

</script>
@else
   <script>

$(document).ready(function(){
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('staf.index') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'image', name: 'image',render:function(data, type, full, meta)
                        {
                        return "<img src={{ URL::to('/') }}/images/profile/" + data +" width='100' class='img-thumbnail' />";
                        },orderable: false
                    },
                    {data: 'id_staf', name: 'id_staf'},
                    {data: 'jabatan', name: 'jabatan'},
                    {data: 'nama', name: 'nama'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'alamat', name: 'alamat'},

                    ],
                order: [[0, 'asc']]
        });
    });

   </script>
@endrole --}}


<script>

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
        $('#modelHeading').html("Create Data staf");
        $('#ajaxModel').modal('show');
        $('#modal-preview').attr('src', 'https://via.placeholder.com/150');


    });


    $(document).ready(function(){
        $('#data_table').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('staf.index') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'image', name: 'image',render:function(data, type, full, meta)
                        {
                        return "<img src={{ URL::to('/') }}/images/profile/" + data +" width='100' class='img-thumbnail' />";
                        },orderable: false
                    },
                    {data: 'id_staf', name: 'id_staf'},
                    {data: 'jabatan', name: 'jabatan'},
                    {data: 'nama', name: 'nama'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'alamat', name: 'alamat'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'asc']]
        });
    });


//save data ADD
    if ($("#dataForm").length > 0) {
        $("#dataForm").validate({
            submitHandler: function (form) {
                var actionType = $('#saveBtn').val();
                var formData = new FormData($('#dataForm')[0]);
                $('#saveBtn').html('Sending..');

                $.ajax({
                    // data: $('#dataForm').serialize(),
                    data:formData,
                    url: "{{ route('staf.store') }}",
                    method: "POST",
                    dataType: 'json',
                    processData:false,
                    contentType:false,
                    success: function (data) {
                        $('#dataForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        $('#saveBtn').html('Save Changes');
                        var oTable = $('#data_table').dataTable();
                        oTable.fnDraw(false);
                        iziToast.success({
                            title:'Successfully',
                            message: 'Data Berhasil Disimpan',
                            position: 'bottomRight'
                        });
                    },
                    error: function (data) {
                        // console.log(data.responseJSON.errors)
                        $("#er").show(0).delay(10000).fadeOut(1000);
                        // $('eror').val(data.er)
                        console.log('Error:', data);
                        $('#validation_errors').html('');
                            $.each(data.responseJSON.errors, function(key,value) {
                                $('#validation_errors').append('<li>'+value+'</li');
                            });

                    }
                });
            }
        })
    }

/* Edit staf */
        $('body').on('click', '.editData', function () {
            var data_id = $(this).data('id');
            //  console.log(data_id);
            $.get("staf" +'/' + data_id +'/edit', function (data) {
                $('#modelHeadingEdit').html("Edit Data staf");
                $('#saveBtnEdit').val("edit-data");
                $('#ajaxModelEdit').modal('show');

                $('#id').val(data.id);
                $('#id_staf').val(data.id_staf);
                $('#id_stafHidden').val(data.id_staf);
                $('#jabatan').val(data.jabatan);
                $('#nama').val(data.nama);
                $('#email').val(data.email);
                $('#phone').val(data.phone);
                $('#alamat').val(data.alamat);
                $('#hidden_image_update').val(data.image);
                $('#store_image').html("<img src={{ URL::to('/') }}/images/profile/" + data.image + " width='300' class='img-thumbnail rounded' />");
                $('.modal-preview').attr('alt', 'No image available');
                if(data.image){
                    // $('#modal-preview').attr('src',  'images/profile/'+data.image);
                    $('#hidden_image_update').attr('src', 'images/profile/'+data.image);
                }
            })
        });

        //save data EDIT
 if($("#dataFormEdit").length > 0){
        $("#dataFormEdit").validate({
            submitHandler: function (form) {
                var actionType = $('#saveBtnEdit').val();
                var id = $('#dataFormEdit').find('#id').val();
                var formData = new FormData($('#dataFormEdit')[0]);
                $('#saveBtnEdit').html('Sending..');

                $.ajax({
                    data:formData,
                    url: "{{ route('staf.update') }}",
                    method: "POST",
                    dataType: 'json',
                    processData:false,
                    contentType:false,
                    success: function (data) {
                        $('#dataFormEdit').trigger("reset");
                        $('#ajaxModelEdit').modal('hide');
                        $('#saveBtnEdit').html('Save Changes');
                        var oTable = $('#data_table').dataTable();
                        oTable.fnDraw(false);
                        iziToast.success({ //tampilkan iziToast dengan notif data berhasil disimpan pada posisi kanan bawah
                                title: 'Successfully',
                                message: 'Data Berhasil Disimpan',
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

//deleta DATA
        $(document).on('click', '.delete', function () {
        var dataId = $(this).data("id");

            $('#konfirmasi-modal').modal('show');
        });
        //jika tombol hapus pada modal konfirmasi di klik maka
        $('#tombol-hapus').click(function () {
            $.ajax({
                url: "staf"+'/' + dataId +'/'+ 'destroy', //eksekusi ajax ke url ini
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
                        title: 'Delete',
                        message: 'Data Berhasil Dihapus',
                        position: 'bottomRight'
                    });
                }
            })
        });

        $(document).on('click', '.deletestaf', function () {
        var dataId = $(this).data("id");
            console.log(dataId)
        Swal.fire({
            title: 'Apa Kamu yakin?',
            text: "Ingin Menghapus staf ini??",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!',
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                    url: "staf"+'/' + dataId, //eksekusi ajax ke url ini
                    type: 'delete',
                    success:function(data){
                        var oTable = $('#data_table').dataTable();
                        oTable.fnDraw(false); //reset datatable
                    }
                });
                iziToast.success({
                    title:'Delete',
                    message: 'Berhasil Di Deleted',
                    position: 'topRight'
                });
        }
        })
      });

    function readURL(input, id) {
        id = id || '#modal-preview';
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(id).attr('src', e.target.result);
            };

      reader.readAsDataURL(input.files[0]);
      $('#modal-preview').removeClass('hidden');
      $('#start').hide();
  }
}

</script>

@endsection
