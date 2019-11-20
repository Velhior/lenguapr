@extends('layouts.app')
@section('title')
 Результаты подбора
@endsection
@section('description')
 Подбор преподавателя согласно заданым критериям
@endsection
@section('content')
<div class="container">
    <form class="form-inline" action="{{route('search.post')}}" method="POST">
        @csrf
        <select class="form-control" name="spec" id="spec">
            @foreach ($teachersSpecialities as $spec)
                <option value="{{$spec}}">
                    {{$spec}}
                </option>
            @endforeach
        </select>
        <select class="form-control" name="reg" id="reg">
            @foreach ($teachersRegions as $reg)
                <option value="{{$reg}}">
                    {{$reg}}
                </option>
            @endforeach
        </select>
        <input class="btn btn-success" type="submit" value="Подобрать">
    </form>
</div>

 @foreach ($filterTeacher as $item)
    <div class="container">
        <div class="card p-5 mt-5 mb-5">
            <div class="row">
                <div class="col-md-3">
                    <img width="150px;" height="150px;" src="{{asset('storage/'. $item->avatar)}}" alt="">
                </div>
                <div class="col-md-6">
                    {{$item->name}}
                    <p class="font-weight-bold">Страна: <i>{{$item->region}}</i></p>
                    <p class="font-weight-bold">Специализация: <i>{{$item->speciality}}</i></p>  
                    {{$item->description}}
                </div>
                @if (auth()->user()->is_approved == 1)
                <div class="col-md-3">
                    <button data-toggle="modal" data-target="#simpleModal" data-id="{{$item->id}}" data-teacher="{{$item->name}}" data-whatever=" Занятие с {{$item->name}}" class="btn btn-success">Назначить занятие</button>
                </div>
                @endif
            </div>
        </div>
    </div>     
 @endforeach 

 {!!$teacherPage->body!!}
 <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content pb-5">
        <div class="modal-header">
            <h3 class='col-12 modal-title text-center'>                    
                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </h3>
        </div>
        
        <div class="modal-body pb-5">
            <form method="POST" action="{{route('lesson.post')}}" class="order-form">
                @csrf
                <div class="form-group  col-md-12 ">
                
                </div>    
                <div class="form-group">
                <label class="control-label" for="name">Выберите время для занятия</label>                
                    <div class='input-group date' id='datetimepicker1'>
                        <input type='datetime-local' class="form-control" id="datetime">                        
                    </div>
                </div>
                </div>
                <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                <input type="hidden" id="teacher_id" name="teacher_id" value="">  
                <input type="hidden" id="teacher_name" name="teacher_name" value="">              
                <input style="margin: 0 auto;" type="submit" class="btn btn-primary" value="Назначить">
            </form>
        </div>   
        
    
            
      </div>
    </div>
  </div>
@endsection    
@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script>
      $( document ).ready(function() {
        $('#simpleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var teacher=button.data('id');
            var name=button.data('teacher');
            var modal = $(this);
            modal.find('.modal-title').text(recipient);
            modal.find('#teacher_id').val(teacher);
            modal.find('#teacher_name').val(name);
        });
        
   

    });
      
</script>
@endsection