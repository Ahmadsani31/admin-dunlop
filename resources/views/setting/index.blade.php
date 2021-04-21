@extends('layouts.app')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Simple Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Simple Tables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card card-olive">
                    <div class="card-header">
                      <h3 class="card-title">Role</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('role.store') }}" method="POST">
                        @csrf
                      <div class="card-body">
                        <div class="form-group">
                          <label>Name Role</label>
                          <input type="text" class="form-control" name="name" placeholder="Enter role">
                        </div>
                      </div>
                      <!-- /.card-body -->
                      <div class="card-header float-right pt-0">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form>
                  </div>
              </div>
          <!-- /.col -->
          <div class="col-md-7">
            <div class="card card-olive">
              <div class="card-header ">
                <h3 class="card-title">Role Table</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsif">
                <table class="table" id="table_role">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Name</th>
                      <th>Guard Name</th>
                      <th style="width: 40px">Action</th>
                    </tr>
                  </thead>

                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
        <div class="container-fluid">
          <div class="row">
              <div class="col-md-5">
                  <div class="card card-olive">
                      <div class="card-header">
                        <h3 class="card-title">Permisiion</h3>
                      </div>
                      <!-- /.card-header -->
                      <!-- form start -->
                      <form action="{{ route('permission.store') }}" method="POST">
                          @csrf
                        <div class="card-body">
                          <div class="form-group">
                            <label>Permisiion</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter role">
                          </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-header float-right pt-0">
                          <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                      </form>
                    </div>
                </div>
            <!-- /.col -->
            <div class="col-md-7">
              <div class="card card-olive">
                <div class="card-header ">
                  <h3 class="card-title">Permisiion Table</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsif">
                  <table class="table" id="table_permisiion">
                    <thead>
                      <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th style="width: 40px">Action</th>
                      </tr>
                    </thead>

                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    <!-- /.content -->
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
        $('#table_role').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('role.datatable') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'guard_name', name: 'guard_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'asc']]
        });
    });

    $(document).ready(function(){
        $('#table_permisiion').DataTable({
            processing: true,
            serverSide: true,
                ajax: {
                url:"{{ route('permission.datatable') }}",
                type: 'GET',
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'guard_name', name: 'guard_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                    ],
                order: [[0, 'asc']]
        });
    });
    $(document).ready(function(){
        $('.select2bs4').select2({
      theme: 'bootstrap4',
      placeholder: "Choose tags...",
    // minimumInputLength: 2,
            ajax:{
                ulr:"{{ route('permission.get') }}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
            return {
              search: params.term // search term
            };
          },
          processResults: function (response) {
            return {
              results: response
            };
          },
          cache: true
        }
    })

    });

</script>

@endsection
