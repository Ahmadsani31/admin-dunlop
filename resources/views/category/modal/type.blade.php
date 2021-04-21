<div class="modal fade" id="ajaxModelType" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="dataFormType" name="dataFormType" class="form-horizontal">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeadingType"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<input type="hidden" id="idType" name="idType">
                        <div class="col-5">
                            <label>Kendaraan</label>
                            <select id="id_kendaraan1" name="id_kendaraan1" class="form-control" required>
                                <option value="" selected disabled>--Choose Kendaraan--</option>
                                @foreach ($kendaraan as $item => $nama_kendaraan)
                                <option value="{{ $item }}">{{ $nama_kendaraan }}</option>
                                @endforeach
                            </select>
                        </div>
						<div class="col-6">
						<label>Type Ban</label>
							<input type="text" class="form-control" name="nama_type[]" placeholder="..." required onkeyup="this.value = this.value.toUpperCase()">
						</div>
						<div class="col-1 mt-4">
							<button type="button" class="btn btn-success btn-sm mt-2 add_field_type"><i class="fa fa-plus"></i>
							</button>
						</div>
					</div>
					<div class="field_wrapper_type" id="form_add_type"></div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="saveBtnType" class="btn btn-primary" value="create">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min-1.19.2.js') }}" ></script>
<script>

    $('#createType').click(function () {
        $('#saveBtnType').val("create-type");
        $('#idType').val('');
        $('#form_add_type').html("");
        $('#dataFormType').trigger("reset");
        $('#modelHeadingType').html("Create Type Ban");
        $('#ajaxModelType').modal('show');
    });
        $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_field_type'); //Add button selector
        var wrapper = $('.field_wrapper_type'); //Input field wrapper
        var x = 1; //Initial field counter is 1
       //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(  '<div class="form-group row" id="row'+x+'">'+
                                    '<div class="col-3">'+
                                        '</div>'+
                                    '<label class="col-2 col-form-label">Type Ban</label>'+
                                    '<div class="col-6">'+
                                        '<input type="text" class="form-control" name="nama_type[]" placeholder="..." required onkeyup="this.value = this.value.toUpperCase()">'+
                                    '</div>'+
                                    '<div class="col-1">'+
                                        '<button type="button" class="btn btn-danger btn-sm mt-1 remove_field_type" id="'+x+'"><i class="fa fa-minus"></i>'+
                                        '</button>'+
                                    '</div>'+
                                    '</div>'); //Add field html
            }
        });
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_field_type', function(e){
            var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
            // e.preventDefault();
            // $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    if ($("#dataFormType").length > 0) {
        $("#dataFormType").validate({
            submitHandler: function (form) {
                var actionType = $('#saveBtnType').val();
                $('#saveBtnType').html('Sending..');
                $.ajax({
                    data: $('#dataFormType').serialize(),
                    url: "{{ route('category.storeType') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#dataFormType').trigger("reset");
                        $('#ajaxModelType').modal('hide');
                        $('#saveBtnType').html('Save Changes Type');
                        var oTable = $('#table_type').dataTable();
                        window.location.reload();
                        oTable.fnDraw(false);
                        iziToast.success({
                            title:'Successfully',
                            message: 'Data Berhasil Ditambah',
                            position: 'topRight'
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtnType').html('Save Changes');
                    }
                });
            }
        });
    }


        $('body').on('click', '#deleteType', function () {
            var type_id = $(this).data("id");
            console.log(type_id)
        Swal.fire({
            title: 'Apa Kamu yakin?',
            text: "Ingin Menghapus Data Ini??",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, do it!',
        }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
            type: "delete",
            url: "category" +'/'+ type_id +'/'+"destroyType",
            success: function (data) {
            var oTable = $('#table_type').dataTable();
            $('table.reload').DataTable().ajax.reload();
            oTable.fnDraw(false);
            iziToast.warning({
                            title:'Deleted',
                            message: 'Data Berhasil Didelete',
                            position: 'bottomRight'
                        });
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
        }
        })
      });
</script>
