@extends('admin.adminMaster')
@section('admin')
<!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('success')}}
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Joined</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php $i = 1;
    @endphp

    @foreach($data as $info)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$info->name}}</td>
      <td>{{$info->email}}</td>
      <td>{{$info->created_at->diffForHumans()}}</td>
      <td><a href="{{route('user.delete', $info->id)}}"><button class="btn btn-danger"><i class="fa-solid fa-trash">Delete</i></button></a></td>
    </tr>
    @endforeach
  </tbody>
</table>


@endsection