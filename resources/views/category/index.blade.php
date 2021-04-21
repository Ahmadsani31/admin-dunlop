@extends('layouts.app')
@section('content')

<style>
    .note{
        font-size: 11px;
        font-style:italic;
        line-height: 12px;
    }
</style>
<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0">Category</h1>
			</div>
			<!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="#">Home</a>
					</li>
					<li class="breadcrumb-item active">Category</li>
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
            <div class="col-6">
                <div class="card card-olive">
                    <div class="card-header">
                        <h2 class="card-title"><strong>Table Kendaraan</strong></h2>
                        <div class="card-tools">
                            <a href="javascript:void(0)" class="btn btn-block btn-danger btn-sm" id="createKendaraan"><i class="fa fa-plus"></i> Kendaraan</a>

                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive">
                        <table class="table reload table-hover" id="table_kendaraan">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Kendaraan</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-6">
				<div class="card card-olive">
					<div class="card-header">
                        <h2 class="card-title"><strong>Table Type Ban</strong></h2>
                        <div class="card-tools">
                            <a href="javascript:void(0)" class="btn btn-block btn-danger btn-sm" id="createType"><i class="fa fa-plus"></i> Type Ban</a>

						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<table class="table reload table-hover" id="table_type">
							<thead>
								<tr>
									<th>NO</th>
									<th>Type</th>
									<th>Kendaraan</th>
									<th>Time</th>
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
<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<!-- /.row -->
		<div class="row">
            <div class="col-12">
				<div class="card card-olive">
					<div class="card-header">
                        <h2 class="card-title"><strong>Table Nama Ban</strong></h2>
                        <div class="card-tools">
                            <a href="javascript:void(0)" class="btn btn-block btn-danger btn-sm" id="createNama"><i class="fa fa-plus"></i> Nama Ban</a>

						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<table class="table reload table-hover" id="table_nama">
							<thead>
								<tr>
									<th>NO</th>
									<th>Nama Ban</th>
									<th>Type</th>
									<th>Kendaraan</th>
									<th>Time</th>
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

<section class="content">
	<div class="container-fluid">
		<!-- Info boxes -->
		<!-- /.row -->
		<div class="row">
            <div class="col-12">
				<div class="card card-olive">
					<div class="card-header">
                        <h2 class="card-title"><strong>Table Detail Ban</strong></h2>
                        <div class="card-tools">
                            <a href="javascript:void(0)" class="btn btn-block btn-danger btn-sm" id="createDetail"><i class="fa fa-plus"></i> Detail Ban</a>

						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body table-responsive">
						<table class="table reload table-hover" id="table_detail">
							<thead>
								<tr>
									<th>NO</th>
									<th>Ukuran</th>
									<th>RIM</th>
									<th>PELEK</th>
									<th>TIPE</th>
									<th>PLY</th>
									<th>QTY</th>
									<th>Nama</th>
									<th>Type</th>
									<th>Kendaraan</th>
									<th>Harga</th>
									<th>ACT</th>
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
{{-- Modal kendaraan --}}
@include('category.modal.kendaraan')

{{-- Modal Type --}}
@include('category.modal.type')

{{-- Modal Nama Ban --}}
@include('category.modal.nama')

{{-- Modal Ukuran --}}
@include('category.modal.detail')

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


    $(document).ready(function(){
        $('#table_kendaraan').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('category.tableKendaraan') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'kendaraan_nama', name: 'kendaraan_nama'},
                    {data: 'waktu', name: 'waktu'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'desc']]
        });
    });


    $(document).ready(function(){
        $('#table_type').DataTable({
            "scrollY": "250px",
            "scrollCollapse": true,

            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('category.tableType') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'type_nama', name: 'type_nama'},
                    {data: 'kendaraan', name: 'kendaraan'},
                    {data: 'waktu', name: 'waktu'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'desc']]
        });
    });

    $(document).ready(function(){
        $('#table_nama').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('category.tableNama') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'ban_nama', name: 'ban_nama'},
                    {data: 'type', name: 'type'},
                    {data: 'kendaraan', name: 'kendaraan'},
                    {data: 'waktu', name: 'waktu'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'desc']]
        });
    });

    $(document).ready(function(){
        $('#table_detail').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('category.tableDetail') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'ukuran_ban', name: 'ukuran_ban'},
                    {data: 'rim', name: 'rim'},
                    {data: 'pelek', name: 'pelek'},
                    {data: 'tipe', name: 'tipe'},
                    {data: 'ply', name: 'ply'},
                    {data: 'stock', name: 'stock'},
                    {data: 'nama', name: 'nama'},
                    {data: 'type', name: 'type'},
                    {data: 'kendaraan', name: 'kendaraan'},
                    {data: 'harga', name: 'harga'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'desc']]
        });
    });

    </script>


@endsection
