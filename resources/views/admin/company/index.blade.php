@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Customer Management</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <a class="btn btn-sm btn-outline-success" href="{{ route('admin.company.create') }}"> Create New Customer</a>
    </div>
  </div>
</div>
<x-alert/>
<table class="table table-bordered res data-table">
<thead>
<tr>
<th>No</th>
<th>Logo</th>
<th>Email</th>
<th>Website</th>
<th>Status</th>
<th width="100px">Action</th>
</tr>
</thead>
  <tbody>
  </tbody>

</table>

@endsection
@section('js')

<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.company.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'logo', name: 'logo'},
            {data: 'email', name: 'email'},
            {data: 'website', name: 'website'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        columnDefs: [
        { targets: 1,
          render: function(data) {
            return '<img src="'+data+'" width="100px">'
          }
        }]   
    });
    
  });
</script>
@endsection