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
@if(Route::is('user.Brandview'))
<form method="post" action="{{route('user.Brandadd')}}" class="mb-3" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4 mb-3">
          <label for="exampleInputPassword1" class="form-label">Add Brand</label>
          <input type="text" class="form-control" name="brand_name" id="exampleInputPassword1">
          @error('brand_name')
          <span style="color:red;"> {{ $message }} </span>
          @endif
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleInputPassword1" class="form-label">Add Brand</label>
            <input type="file" class="form-control" name="image" id="exampleInputPassword1">
            @error('image')
            <span style="color:red;"> {{ $message }} </span>
            @endif
        </div>
        
        <div class="col-md-2 mb-3">
            <label for="exampleInputPassword1" class="form-label">  </label>
            <button type="submit" name="submit" class=" mt-4 btn btn-primary">Add Brand</button>
        </div>
    </div>
</form>
@endif

@if(Route::is('brand.edit'))
<form method="post" action="{{route('user.Brandedit', $get->id)}}" class="mb-3" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-4 mb-3">
          <label for="exampleInputPassword1" class="form-label">Add Brand</label>
          <input type="text" class="form-control" value="{{$get->name}}" name="brand_name" id="exampleInputPassword1">
          @error('brand_name')
          <span style="color:red;"> {{ $message }} </span>
          @endif
        </div>
        <div class="col-md-4 mb-3">
            <label for="exampleInputPassword1" class="form-label">Add Brand</label>
            <input type="file" class="form-control" name="image" id="exampleInputPassword1">
            @error('image')
            <span style="color:red;"> {{ $message }} </span>
            @endif
            <img width="20%" src="{{asset($get->image)}}" alt="">
        </div>
        
        <div class="col-md-2 mb-3">
            <label for="exampleInputPassword1" class="form-label">  </label>
            <button type="submit" name="submit" class=" mt-4 btn btn-primary">Add Brand</button>
        </div>
    </div>
</form>
@endif

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Image</th>
      <th scope="col">Added By</th>
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
      <td> <img width="20%" src="{{asset($info->image)}}" alt=""> </td>
      <td>{{$info->user->name}}</td>
      <td>{{$info->created_at->diffForHumans()}}</td>
      <td><a href="{{route('brand.delete', $info->id)}}"><button class="btn btn-danger"><i class="fa-solid fa-trash">Delete</i></button></a></td>
      <td><a href="{{route('brand.edit', $info->id)}}"><button class="btn btn-secondary"><i class="fa-solid fa-trash">Edit</i></button></a></td>
    </tr>
    @endforeach
  </tbody>
</table>


@endsection