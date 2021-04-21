
<div class="modal fade" id="ajaxModelNama" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<form id="dataFormNama" name="dataFormNama" class="form-horizontal">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeadingNama"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
                        <div class="col-6">
                            <label>Kendaraan</label>
                            <select id="id_kendaraan" name="id_kendaraan" class="form-control" required>
                                <option value="" selected>--Choose Kendaraan--</option>
                                @foreach ($kendaraan as $item => $nama_kendaraan)
                                <option value="{{ $item }}">{{ $nama_kendaraan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label>Type Ban</label>
                            <select id="id_type" name="id_type" class="form-control" required>
                                <option value="" selected>--Choose Type--</option>
                            </select>
                        </div>
					</div>
                    <div class="dropdown-divider"></div>
					<div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Ban</label>
                    <div class="col-8">
							<input type="text" class="form-control" name="nama_ban[]" placeholder="..." required>
						</div>
						<div class="col-1">
							<button type="button" class="btn btn-success btn-sm mt-1 add_field_nama"><i class="fa fa-plus"></i>
							</button>
						</div>
                    </div>
					<div class="field_wrapper_nama" id="form_add_nama"></div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="saveBtnNama" class="btn btn-primary" value="create">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min-1.19.2.js') }}" ></script>
<script>

    $('#createNama').click(function () {
        $('#saveBtnNama').val("create-nama");
        $('#idNama').val('');
        $('#form_add_nama').html("");
        $('#dataFormNama').trigger("reset");
        $('#modelHeadingNama').html("Create Nama Ban");
        $('#ajaxModelNama').modal('show');
        $('select[name="id_type"]').empty();

    });
        $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_field_nama'); //Add button selector
        var wrapper = $('.field_wrapper_nama'); //Input field wrapper
        var x = 1; //Initial field counter is 1
       //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields
            if(x < maxField){
                x++; //Increment field counter
                $(wrapper).append(  '<div class="form-group row" id="row'+x+'">'+
                                        '<label class="col-sm-3 col-form-label">Nama Ban</label>'+
                                    '<div class="col-8">'+
                                        '<input type="text" class="form-control" name="nama_ban[]" placeholder="..." required>'+
                                    '</div>'+
                                    '<div class="col-1">'+
                                        '<button type="button" class="btn btn-danger btn-sm mt-1 remove_field_nama" id="'+x+'"><i class="fa fa-minus"></i>'+
                                        '</button>'+
                                    '</div>'+
                                    '</div>'); //Add field html
            }
        });
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_field_nama', function(e){
            var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
            // e.preventDefault();
            // $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });
    });

    if ($("#dataFormNama").length > 0) {
        $("#dataFormNama").validate({
            submitHandler: function (form) {
                var actionNama = $('#saveBtnNama').val();
                $('#saveBtnNama').html('Sending..');
                $.ajax({
                    data: $('#dataFormNama').serialize(),
                    url: "{{ route('category.storeNama') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#dataFormNama').trigger("reset");
                        $('#ajaxModelNama').modal('hide');
                        $('#saveBtnNama').html('Save Changes Type');
                        var oTable = $('#table_nama').dataTable();
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
                        $('#saveBtnNama').html('Save Changes');
                    }
                });
            }
        });
    }


        $('body').on('click', '#deleteNama', function () {
        var nama_id = $(this).data("id");
            console.log(nama_id)
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
            url: "category" +'/'+ nama_id +'/'+"destroyNama",
            success: function (data) {
            var oTable = $('#table_nama').dataTable();
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

      $(document).ready(function(){
        $('select[name="id_kendaraan"]').on('change', function(){
            var kendaraanID = $(this).val();
                $.ajax({
                    url:"category"+'/' +kendaraanID+ '/' +'selectType',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                    $('select[name="id_type"]').empty();
                    if(data == ''){
                        $('#id_type').append('<option disabled selected>--Data Tidak Ada--</option>');
                            }else{
                        $('#id_type').append('<option disabled selected>--Select One--</option>');
                            }
                            $.each(data, function(key, value){
                                $('select[name="id_type"]').append('<option value="'+ key +'">'+ value +'</option>');
                            });
                    }
                });
        });

    });


</script>
