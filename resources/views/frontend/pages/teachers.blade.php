@extends('layouts.app')
@section('title')
 {{$teacherPage->title}}
@endsection
@section('description')
 {{$teacherPage->description}}
@endsection
@section('content')
 @foreach ($teachers as $teacher)
    <div class="container">
        <div class="card p-5 mt-5 mb-5">
            <div class="row">
                <div class="col-md-3">
                    <img width="150px;" height="150px;" src="{{asset('storage/'. $teacher->avatar)}}" alt="">
                </div>
                <div class="col-md-9">
                    {{$teacher->name}}
                    {{$teacher->description}}
                </div>
            </div>
        </div>
    </div>     
 @endforeach  
 {!!$teacherPage->body!!}
@endsection    
@section('scripts')

@endsection