@extends('layouts.app') @section('content')
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
			<div class="col-12">
				<div class="card">
					<div class="card-header">
                            <div class="margin">
                                <div class="btn-group">

                                    <a href="javascript:void(0)" class="btn btn-block btn-primary" id="createPeminjaman"><i class="fa fa-pen-square"></i> New Peminjaman</a>
                                </div>
                              </div>
					</div>
					<!-- /.card-header -->
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
{{ session('faktur') }}
{{ session('staf') }}
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<!-- /.row -->
		<div class="row">
                <div class="col-md-12">
                    <div class="card card-olive">
                        <div class="card-header">
                            <h3 class="card-title">Data Peminjaman</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive">
                            <table class="table  text-nowrap ukuran" id="tabel_peminjaman">
                              <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Staf</th>
                                    <th>No Issue</th>
									<th>Faktur</th>
									<th>Waktu</th>
                                    <th>Action</th>
                                </tr>
                              </thead>

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

{{-- Modal add Barang --}}
<div class="modal fade" id="modal_peminjam" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="{{ route('loan.data') }}" id="form_pinjaman" name="form_pinjaman" class="form-horizontal">
        <div class="modal-header">
          <h4 class="modal-title" id="modelHeading_pinjaman"></h4>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-4">
                    <input type="text" class="form-control" name="faktur" placeholder="No Faktur" value="{{ session('faktur') }}" required onkeyup="this.value = this.value.toUpperCase()">
                </div>
                <div class="col-8">
                    <select id="id_staf"  name="id_staf" class="form-control" required>
                        <option value="" selected>--Nama staf--</option>
                        @foreach ($staf as $key => $nama)
                        <option  value="{{ $key }}">{{ $nama }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <div class="row px-2">
            <button id="btnsave_peminjam" type="submit" class="btn btn-success mx-1">Next</button>
          </div>

        </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal_detailPinjaman" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-body">
            <div class="card" style="border: 5px;">
                <div class="card-header">
                    <div class="text-center">
                        <img src="{{ asset('assets/img/donlop.png') }}" alt="logo-dunlop" width="300">
                    </div>
          <div class="dropdown-divider"></div>

                    <div class="row">
                        <div class="col-10">
                            <h3><b  id="nama"></b></h3>
                            <h6>jabatan : <u  id="jabatan"></u></h6>


                        </div>
                        <div class="col-2">
                                <h6 class="float-right">No Issue : <b  id="issue"></b></h6>
                                <h6 class="float-right">Tanggal : <u  id="waktu"></u></h6>
                                <h6 class="float-right">Faktur : <b id="faktur"></b></h6>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Ukuran</th>
                        <th style="width: 20px">Qty</th>
                        <th>Nama</th>
                        <th>Type</th>
                        <th>Kendaraan</th>
                      </tr>
                    </thead>

                    <tbody class="data">

                    </tbody>
                  </table>
                </div>
                <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-7">
                        <div class="pl-2">
                            <p class="lead">Payment Methods:</p>
                            <img src="{{ asset('assets/dist/img/credit/visa.png') }}" alt="Visa">
                            <img src="{{ asset('assets/dist/img/credit/mastercard.png') }}" alt="Mastercard">
                            <img src="{{ asset('assets/dist/img/credit/american-express.png') }}" alt="American Express">
                            <img src="{{ asset('assets/dist/img/credit/paypal2.png') }}" alt="Paypal">

                            <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                              Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                              plugg
                              dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                            </p>
                        </div>

                    </div>
                    <!-- /.col -->
                    <div class="col-5">
                      <p class="lead float-right pr-2">Amount Due <b  id="waktu1"></b></p>

                      <div class="table-responsive pl-5">
                        <table class="table ">
                          <tr>
                            <th style="width:44%">Subtotal:</th>
                            <td><h6 id="harga"></h6> </td>
                          </tr>
                          <tr>
                            <th>Tax (9.3%)</th>
                            <td>$10.34</td>
                          </tr>
                          <tr>
                            <th>Total:</th>
                            <td>$265.24</td>
                          </tr>
                        </table>
                      </div>
                    </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary"><i class="fa fa-print"></i> Print</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
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

    $(document).ready(function(){
        $('#tabel_peminjaman').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('loan.datatablePeminjaman') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'staf', name: 'staf'},
                    {data: 'no_issue', name: 'no_issue'},
                    {data: 'faktur', name: 'faktur'},
                    {data: 'waktu', name: 'waktu'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'asc']]
        });
    });


    $('#createPeminjaman').click(function () {
        $('#btnsave_peminjam').val("create-ukuran");
        $('#form_pinjaman').trigger("reset");
        $('#modelHeading_pinjaman').html("Pilih Nama staf");
        $('#modal_peminjam').modal('show');

    });


    $('body').on('click', '#detailPinjaman', function () {
            var id = $(this).data('id');
             console.log(id);
             $.ajax({
                    url: id +'/showDataLoan',
                    type:"GET",
                    dataType:"json",
                    success:function(data){
                        $('#form_detailPinjaman').trigger("reset");
                        $('#modelHeading_detailPinjaman').html("Detail Pinjaman");
                        $('#modal_detailPinjaman').modal('show');
                        $('tbody.data').html(data.table_data);
                        $('#nama').text(data.nama);
                        $('#waktu').text(data.waktu);
                        $('#waktu1').text(data.waktu);
                        $('#total').text(data.total);
                        $('#faktur').text(data.faktur);
                        $('#issue').text(data.issue);
                        $('#jabatan').text(data.jabatan);
                        $('#harga').text(data.harga);


                    }
                });

        });


</script>

@endsection
