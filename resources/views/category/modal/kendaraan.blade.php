<div class="modal fade" id="ajaxModelKendaraan" aria-hidden="true">
	<div class="modal-dialog modal-default">
		<div class="modal-content">
			<form id="dataFormKendaraan" name="dataFormKendaraan" class="form-horizontal">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeadingKendaraan"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
						<div class="col-11">
							<label>Nama Kendaraan</label>
							<input type="text" class="form-control" name="nama_kendaraan[]" placeholder="..." required onkeyup="this.value = this.value.toUpperCase()">
						</div>
						<div class="col-1 mt-4">
							<button type='button' class='btn btn-success btn-sm mt-2 add_field_kendaraan'><i class='fa fa-plus'></i>
							</button>
						</div>
					</div>
					<div class="field_wrapper_kendaraan" id="form_add_kendaraan"></div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="saveBtnKendaraan" class="btn btn-primary" value="create">Save changes</button>
				</div>
			</form>
		</div>
	</div>
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

    $('#createKendaraan').click(function () {
        $('#saveBtnKendaraan').val("create-kendaraan");
        $('#idKendaraan').val('');
        $('#form_add_kendaraan').html("");
        $('#dataFormKendaraan').trigger("reset");
        $('#modelHeadingKendaraan').html("Create Data Kendaraan");
        $('#ajaxModelKendaraan').modal('show');
    });

        $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_field_kendaraan'); //Add button selector
        var wrapper = $('.field_wrapper_kendaraan'); //Input field wrapper
        var x = 1; //Initial field counter is 1


        //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(  '<div class="form-group row"  id="row'+x+'">'+
                                    '<input type="hidden" name="idKendaraan">'+
                                    '<div class="col-11">'+
                                        '<input type="text" class="form-control" name="nama_kendaraan[]" placeholder="..." required>'+
                                    '</div>'+
                                    '<div class="col-1">'+
                                        '<button type="button" id="'+x+'"  class="btn btn-danger btn-sm mt-1 remove_field_kendaraan"><i class="fa fa-minus"></i>'+
                                        '</button>'+
                                    '</div>'+
                                    '</div>'); //Add field html
            }
        });
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_field_kendaraan', function(e){
            var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
            // e.preventDefault();
            // $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    if ($("#dataFormKendaraan").length > 0) {
        $("#dataFormKendaraan").validate({
            submitHandler: function (form) {
                var actionType = $('#saveBtnKendaraan').val();
                $('#saveBtnKendaraan').html('Sending..');
                $.ajax({
                    data: $('#dataFormKendaraan').serialize(),
                    url: "{{ route('category.storeKendaraan') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#dataFormKendaraan').trigger("reset");
                        $('#ajaxModelKendaraan').modal('hide');
                        $('#saveBtnKendaraan').html('Save Changes Kendaraan');
                        var oTable = $('#table_kendaraan').dataTable();
                        window.location.reload();
                        oTable.fnDraw(false);
                        iziToast.success({
                            title:'Data Berhasil Tersimpan',
                            message: '{{ Session('success') }}',
                            position: 'topRight'
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        $('#saveBtnKendaraan').html('Save Changes');
                    }
                });
            }
        });
    }


        $('body').on('click', '#deleteKendaraan', function () {
        var kendaraan_id = $(this).data("id");
            console.log(kendaraan_id)
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
            url: "category" +'/'+ kendaraan_id +'/'+ "destroyKendaraan",
                success: function (data) {
                var oTable = $('#table_kendaraan').dataTable();
                $('table.reload').DataTable().ajax.reload();
                oTable.fnDraw(false);
                iziToast.warning({
                                title:'Delete,',
                                message: 'Data Berhasil Di Deleted',
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
