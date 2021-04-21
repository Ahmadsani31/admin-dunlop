@extends('layouts.app') @section('content')
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Upload Image</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a>
					</li>
					<li class="breadcrumb-item active">Upload Image</li>
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
                                <a href="javascript:void(0)" class="btn btn-primary" id="create-new-product">Add Data</a>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<table class="table table-hover" id="laravel_datatable">
							<thead>
								<tr>
									<th>NO</th>
									<th>Image</th>
									<th>ID Card</th>
									<th>Nama</th>
									<th>Keterangan</th>
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
    <div class="modal fade" id="ajax-product-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="productCrudModal"></h4>
                </div>
                <div class="modal-body">
                    <form id="productForm" name="productForm" class="form-horizontal" enctype="multipart/form-data">
                        {{-- <input type="hidden" name="upload_id" id="upload_id"> --}}
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">ID Card</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="id_card" placeholder="Enter ID Card" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="nama" placeholder="Enter Nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="description" placeholder="Enter Description" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input type="file" name="image" accept="image/*" onchange="readURL(this);">
                            </div>
                        </div>
                        <div class="text-center">
                            <img id="modal-preview" src="https://via.placeholder.com/150" alt="Preview" class="form-group hidden" width="100">
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ajax_product_modal_update" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="productCrudModalUpdate"></h4>
                </div>
                <div class="modal-body">
                    <form id="productFormUpdate" name="productFormUpdate" class="form-horizontal" enctype="multipart/form-data">
                        <div class="text-center">
                            <div id="store_image"></div>
                            <hr>
                        </div>
                        <input type="hidden" name="upload_id" id="upload_id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">ID Card</label>
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" id="id_card" name="id_card" placeholder="Enter ID Card">
                                <input type="text" class="form-control" id="id_cardHidden" name="id_card" placeholder="Enter ID Card" disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Nama</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Nama" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Image</label>
                            <div class="col-sm-12">
                                <input id="image" type="file" name="image" accept="image/*" onchange="readURL(this);">
                                <input type="" name="hidden_image_update" id="hidden_image_update" value="">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn_save_update" value="create">Save changes</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>

<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min-1.19.2.js') }}" ></script>

<script type="text/javascript">
$(document).ready( function () {
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $('#laravel_datatable').DataTable({
         processing: true,
         serverSide: true,
         ajax: {
          url: "{{ route('uploadImage.index') }}",
          type: 'GET',
         },
         columns: [
                  {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                  {data: 'image', name: 'image',render:function(data, type, full, meta)
                        {
                        return "<img src=/images/profile/" + data +" width='100' class='img-thumbnail' />";
                        },orderable: false
                    },
                  { data: 'id_card', name: 'id_card' },
                  { data: 'nama', name: 'nama' },
                  { data: 'description', name: 'description' },
                  {data: 'action', name: 'action', orderable: false},
               ],
        order: [[0, 'desc']]
      });

    /*  When user click add user button */
    $('#create-new-product').click(function () {
        $('#btn-save').val("create-product");
        $('#upload_id').val('');
        $('#productForm').trigger("reset");
        $('#productCrudModal').html("Add New Product");
        $('#ajax-product-modal').modal('show');
        $('#modal-preview').attr('src', 'https://via.placeholder.com/150');
    });

   /* When click edit user */
    $('body').on('click', '.edit-product', function () {
      var upload_id = $(this).data('id');
      $.get('uploadImage/' + upload_id +'/edit', function (data) {

          $('#productCrudModalUpdate').html("Edit Product update");
          $('#btn_save_update').val("edit-product");
          $('#ajax_product_modal_update').modal('show');
          $('#productFormUpdate').trigger("reset");

          $('#upload_id').val(data.id);
          $('#id_card').val(data.id_card);
          $('#id_cardHidden').val(data.id_card);
          $('#nama').val(data.nama);
          $('#description').val(data.description);
          $('#hidden_image_update').val(data.image);
          $('#store_image').html("<img src={{ URL::to('/') }}/images/profile/" + data.image + " width='300' class='img-thumbnail rounded' />");
          $('.modal-preview').attr('alt', 'No image available');
          if(data.image){
            // $('#modal-preview').attr('src',  'images/profile/'+data.image);
             $('#hidden_image_update').attr('src', 'images/profile/'+data.image);
          }

      })
   });

    $('body').on('click', '#delete-product', function () {

        var product_id = $(this).data("id");

        if(confirm("Are You sure want to delete !")){
          $.ajax({
              type: "delete",
              url: "uploadImage/" + product_id,
              success: function (data) {
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
        }
    });

   });


  $('body').on('submit', '#productForm', function (e) {

      e.preventDefault();

      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');

      var formData = new FormData(this);

      $.ajax({
          type:'POST',
          url:  "{{ route('uploadImage.store') }}",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {

              $('#productForm').trigger("reset");
              $('#ajax-product-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              var oTable = $('#laravel_datatable').dataTable();
              oTable.fnDraw(false);
          },
          error: function(data){
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
  });

    $('body').on('submit', '#productFormUpdate', function (e) {
            e.preventDefault();

      var actionType = $('#btn_save_update').val();
      $('#btn-btn_save_update').html('Sending..');
      var formData = new FormData(this);

        $.ajax({
            type:'POST',
          url:  "{{ route('uploadImage.store') }}",
          data: formData,
          cache:false,
          contentType: false,
          processData: false,
          success: (data) => {

                $('#productFormUpdate').trigger("reset");
                $('#ajax_product_modal_update').modal('hide');
                $('#btn_save_update').html('Save Changes Update');
                var oTable = $('#laravel_datatable').dataTable();
                oTable.fnDraw(false);
            },
            error: function(data){
                console.log('Error:', data);
                $('#btn_save_update').html('Save Changes');
            }
        });
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

// function readURL(input) {
//   if (input.files && input.files[0]) {
//       var reader = new FileReader();

//       reader.onload = function (e) {
//           $('#modal_update').attr('src', e.target.result);
//       };

//       reader.readAsDataURL(input.files[0]);
//   }
// }

// $('#store_image').change(function(){
//     readURL(this);
// });

</script>
@endsection

