@extends('layouts.admin')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Edit Company</h1>
  <div class="btn-toolbar mb-2 mb-md-0">
    <div class="btn-group mr-2">
      <a class="btn btn-sm btn-outline-danger" href="{{ url()->previous() }}">Back</a>
    </div>
  </div>
</div>
<x-alert/>
<form action="{{ route('admin.employee.update',$employee->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PATCH')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>First Name:</strong>
            <input class="form-control" type="text" name="first_name" value="{{$employee->first_name}}" placeholder="First Name" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Last Name:</strong>
            <input class="form-control" type="text" name="last_name" value="{{$employee->last_name}}" placeholder="Last Name" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Email:</strong>
            <input class="form-control" type="email" name="email" value="{{$employee->email}}" placeholder="Email" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Phone:</strong>
            <input class="form-control" type="number" length="12" name="phone" value="{{$employee->phone}}" placeholder="Phone Number" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==13) return false;" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Status:</strong>
            <select class="form-control" name="company_id">
              @foreach($companies as $c)
              <option value="{{$c->id}}"
              @if($c->id == $employee->company_id)
              selected
              @endif
              >{{$c->name}}</option>
              @endforeach  
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Status:</strong>
            <select class="form-control" name="status">
              <option value="1">
              @if($employee->status == 1)
              selected
              @endif
              Active</option>
              <option value="0"
              @if($employee->status == 0)
              selected
              @endif
              >Deactive</option>
            </select>
        </div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
@endsection