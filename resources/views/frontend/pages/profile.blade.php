@extends('layouts.app')
@section('title')
 Просмотр профиля
@endsection
@section('description')
 Main page description
@endsection
@section('content')  
<div class="container">
    <div class="card mt-5 mb-5">
      <div class="wrapper-card">
        <div class="row">
          <div class="col-md-6">
            
              @if(isset($user->avatar))
              <img src="{{asset('storage/'.$user->avatar)}}" alt="">
              @endif
          </div>
          <div class="col-md-6">   
            
              <form action="{{route('users.update', $user)}}" enctype="multipart/form-data" method="POST" role="form">
                  {{ csrf_field() }}
                  {{ method_field('PUT') }}
                <div class="form-group row">
                    <input class="form-control" type="file" name="avatar">
                </div> 
                <div class="form-group row">  
                  <input class="form-control" type="text" name="name"  value="{{ $user->name }}" />            
                </div>
                <div class="form-group row">
                  <input class="form-control" type="email" name="email"  value="{{ $user->email }}" />
                </div>
                <div class="form-group row">
                  <input class="form-control" type="tel" name="phone_number"  value="{{ $user->phone_number }}" />
                </div>                          
                  <button class="btn btn-lg btn-success" type="submit">Сохранить</button>
              </form>
            </div>
          </div>
        </div>
    </div>   
</div>

@endsection    
@section('scripts')
@endsection
 
 
