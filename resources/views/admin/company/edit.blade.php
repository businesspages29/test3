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
<form action="{{ route('admin.company.update',$company->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PATCH')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Name:</strong>
            <input class="form-control" type="text" name="name" value="{{$company->name}}" placeholder="Name" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Email:</strong>
            <input class="form-control" type="email" name="email" value="{{$company->email}}" placeholder="Email" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Website:</strong>
            <input class="form-control" type="text" name="website" value="{{$company->website}}" placeholder="Website" required>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Status:</strong>
            <select class="form-control" name="status">
              <option value="1">
              @if($company->status == 1)
              selected
              @endif
              Active</option>
              <option value="0"
              @if($company->status == 0)
              selected
              @endif
              >Deactive</option>
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6">
        <div class="form-group">
            <strong>Image:</strong>
            <input class="form-control" type="file" name="logo" required>
        </div>
        <div class="form-group">
            <img src="{{$company->logo}}" width="100px" alt="">
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
@endsection