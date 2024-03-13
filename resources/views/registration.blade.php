@extends('layout')
@section('title', 'Registration')
@section('content')

<div> class="container">

    <form action="{{route('registration.post')}}" method="POST" class="ms-auto me-auto" style="width: 500px">
        @csrf
  
<div class="mb-3">
    <label  class="form-label">Fullname</label>
    <input type="text" class="form-control" name="name">
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Email address</label>
    <input type="email" class="form-control" email="email">
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

@endsection