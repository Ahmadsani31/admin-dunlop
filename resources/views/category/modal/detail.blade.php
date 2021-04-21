
<div class="modal fade" id="ajaxModelDetail" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<form id="dataFormDetail" name="dataFormDetail" class="form-horizontal">
				<div class="modal-header">
					<h4 class="modal-title" id="modelHeadingDetail"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group row">
                        <div class="col-4">
                            <label>Kendaraan</label>
                            <select id="id_kendaraan2" name="id_kendaraan2" class="form-control" required>
                                <option value="" selected>--Choose Kendaraan--</option>
                                @foreach ($kendaraan as $item => $nama_kendaraan)
                                <option value="{{ $item }}">{{ $nama_kendaraan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label>Type Ban</label>
                            <select id="id_type2" name="id_type2" class="form-control" required>
                                <option value="" selected>--Choose Type--</option>

                            </select>
                        </div>
                        <div class="col-4">
                            <label>Nama Ban</label>
                            <select id="id_nama_ban" name="id_nama_ban" class="form-control" required>
                                <option value="" selected>--Choose Nama Ban--</option>

                            </select>
                        </div>
					</div>
                    <div class="dropdown-divider"></div>
					<div class="form-group">
                        <div class="row">
                            <div class="col-4">
                                <input type="text" class="form-control" name="ukuran[]" placeholder="Ukuran" required onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-5">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text">Rp.</span>
                                </div>
                                <input type="text" id="rupiah" class="form-control" name="harga[]" placeholder="Harga">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                  </div>
                              </div>
                        </div>
                        <div class="col-2">
                            <input type="number" class="form-control" name="stock[]" placeholder="Stock" required>

                        </div>
                        </div>
                    </div>
					<div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <input type="text" class="form-control" name="tipe[]" placeholder="Tipe" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-3">
                                <input type="text" class="form-control" name="ply[]" placeholder="Ply" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-3">
                            <input type="text" class="form-control" name="rim[]" placeholder="Rim/Ring" onkeyup="this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-2">
                            <input type="text" id="pelek" class="form-control" name="pelek[]" placeholder="INCH Pelek">
                        </div>
                        <div class="col-1">
							<button type="button" class="btn btn-success btn-sm mt-1 add_field_detail"><i class="fa fa-plus"></i>
							</button>
						</div>
                        </div>
                    </div>
					<div class="field_wrapper_detail" id="form_add_detail"></div>
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" id="saveBtnDetail" class="btn btn-primary" value="create">Save changes</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script src="{{ asset('assets/js/jquery-3.6.0.js') }}"></script>
<script src="{{ asset('assets/js/jquery.validate.min-1.19.2.js') }}" ></script>
<script src="https://cdn.jsdelivr.net/npm/autonumeric@4.1.0"></script>

<script>

    $('#createDetail').click(function () {
        $('#saveBtnDetail').val("create-ukuran");
        $('#idDetail').val('');
        $('#form_add_detail').html("");
        $('#dataFormDetail').trigger("reset");
        $('#modelHeadingDetail').html("Create Ukuran Ban");
        $('#ajaxModelDetail').modal('show');
        $('select[name="id_type2"]').empty();
        $('select[name="id_nama_ban"]').empty();


    });

        $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_field_detail'); //Add button selector
        var wrapper = $('.field_wrapper_detail'); //Input field wrapper
        var x = 1; //Initial field counter is 1
       //Once add button is clicked
        $(addButton).click(function(){
            //Check maximum number of input fields

            if(x < maxField){
                x++; //Increment field counter

                $(wrapper).append(
                    '<div id="row'+x+'">'+
                        '<div class="form-group">'+
                        '<div class="row">'+
                            '<div class="col-4">'+
                                '<input type="text" class="form-control" name="ukuran[]" placeholder="Ukuran" required onkeyup="this.value = this.value.toUpperCase()">'+
                        '</div>'+
                        '<div class="col-5">'+
                            '<div class="input-group">'+
                                '<div class="input-group-prepend">'+
                                  '<span class="input-group-text">Rp.</span>'+
                                '</div>'+
                                '<input type="text" id="rupiah'+x+'" class="form-control" name="harga[]" placeholder="Harga">'+
                                '<div class="input-group-append">'+
                                    '<span class="input-group-text">.00</span>'+
                                  '</div>'+
                              '</div>'+
                        '</div>'+
                        '<div class="col-2">'+
                            '<input type="number" class="form-control" name="stock[]" placeholder="Stock" required>'+
                        '</div>'+
                        '</div>'+
                    '</div>'+
					'<div class="form-group">'+
                        '<div class="row">'+
                            '<div class="col-3">'+
                                '<input type="text" class="form-control" name="tipe[]" placeholder="Tipe" onkeyup="this.value = this.value.toUpperCase()">'+
                        '</div>'+
                        '<div class="col-3">'+
                                '<input type="text" class="form-control" name="ply[]" placeholder="Ply" onkeyup="this.value = this.value.toUpperCase()">'+
                        '</div>'+
                        '<div class="col-3">'+
                            '<input type="text" class="form-control" name="rim[]" placeholder="Rim/Ring" onkeyup="this.value = this.value.toUpperCase()">'+
                        '</div>'+
                        '<div class="col-2">'+
                            '<input type="text" id="pelek'+x+'" class="form-control" name="pelek[]" placeholder="INCH Pelek">'+
                        '</div>'+
                        '<div class="col-1">'+
							'<button type="button" id="'+x+'" class="btn btn-danger btn-sm mt-1 remove_field_detail"><i class="fa fa-minus"></i>'+
							'</button>'+
						'</div>'+
                        '</div>'+
                    '</div>'+
                    '</div>'); //Add field html
                    $(document).ready(function () {
        $('#pelek10').inputmask('9.9');
        $('#pelek2').inputmask('9.9');
        $('#pelek3').inputmask('9.9');
        $('#pelek4').inputmask('9.9');
        $('#pelek5').inputmask('9.9');
        $('#pelek6').inputmask('9.9');
        $('#pelek7').inputmask('9.9');
        $('#pelek8').inputmask('9.9');
        $('#pelek9').inputmask('9.9');

        $("#rupiah2").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah3").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah4").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah5").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah6").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah7").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah8").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah9").keyup(function(e){
            $(this).val(format($(this).val()));
        });
        $("#rupiah10").keyup(function(e){
            $(this).val(format($(this).val()));
        });
    });
            }
        });
        //Once remove button is clicked
        $(wrapper).on('click', '.remove_field_detail', function(e){
            var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
            // e.preventDefault();
            // $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });


    });

    $(document).ready(function () {
        $('#pelek').inputmask('9.9');
    });


    if ($("#dataFormDetail").length > 0) {
        $("#dataFormDetail").validate({
            submitHandler: function (form) {
                var actionNama = $('#saveBtnDetail').val();
                $('#saveBtnDetail').html('Sending..');
                $.ajax({
                    data: $('#dataFormDetail').serialize(),
                    url: "{{ route('category.storeDetail') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                        $('#dataFormDetail').trigger("reset");
                        $('#ajaxModelDetail').modal('hide');
                        $('#saveBtnDetail').html('Save Changes Ukuran');
                        var oTable = $('#table_detail').dataTable();
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
                        $('#saveBtnDetail').html('Save Changes');
                    }
                });
            }
        });
    }

        $('body').on('click', '#deleteDetail', function () {
        var ukuran_id = $(this).data("id");
            console.log(ukuran_id)
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
                url: "category" +'/'+ ukuran_id +'/'+"destroyDetail",
                success: function (data) {
                var oTable = $('#table_detail').dataTable();
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

      $(document).ready(function(){
        $('select[name="id_kendaraan2"]').on('change', function(){
            var kendaraanID = $(this).val();
                $.ajax({
                    url:"category/" +kendaraanID+ '/selectType',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                    $('select[name="id_type2"]').empty();
                    if(data == ''){
                        $('#id_type2').append('<option disabled selected>--Data Tidak Ada--</option>');
                            }else{
                        $('#id_type2').append('<option disabled selected>--Select One--</option>');
                            }
                        $.each(data, function(key, value){
                            $('select[name="id_type2"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
        });
    });

    $(document).ready(function(){
        $('select[name="id_type2"]').on('change', function(){
            var typeID = $(this).val();
                $.ajax({
                    url:"category/" +typeID+ '/selectNama',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                    $('select[name="id_nama_ban"]').empty();
                    if(data == ''){
                        $('#id_nama_ban').append('<option disabled selected>--Data Tidak Ada--</option>');
                            }else{
                        $('#id_nama_ban').append('<option disabled selected>--Select One--</option>');
                            }
                        $.each(data, function(key, value){
                            $('select[name="id_nama_ban"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });

        });
    });

    $(function(){
      $("#rupiah").keyup(function(e){
        $(this).val(format($(this).val()));
      });
    });

    var format = function(num){
      var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
      if(str.indexOf(".") > 0) {
        parts = str.split(".");
        str = parts[0];
      }
      str = str.split("").reverse();
      for(var j = 0, len = str.length; j < len; j++) {
        if(str[j] != ",") {
          output.push(str[j]);
          if(i%3 == 0 && j < (len - 1)) {
            output.push(",");
          }
          i++;
        }
      }
      formatted = output.reverse().join("");
      return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
    };
</script>
