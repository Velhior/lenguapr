   @extends('layouts.app')
   @section('title')
    {{$mainPage->title}}
   @endsection
   @section('description')
    {{$mainPage->description}}
   @endsection
   @section('content')  
   <div class="jumbotron jumbotron-fluid">
    <div class="container">
    <h1 class="display-4 text-center mb-5">Экспресс курсы английского языка</h1>
    <div class="row">
    <div class="col-md-6">
    <p class="lead">Наши преимущества</p>
    <div class="row">
    <div class="advantages-item col-md-12 mt-5">
        <i class="fas fa-users-cog mr-5"></i>
    <div class="advantages-undersigned">Различные направления и тематики</div>
    </div>
    <div class="advantages-item col-md-12 mt-5">
        <i class="fas fa-user-check mr-5"></i>
    <div class="advantages-undersigned">Только индивидуальное обучение</div>
    </div>
    <div class="advantages-item col-md-12 mt-5">
        <i class="fas fa-users mr-5"></i>
    <div class="advantages-undersigned">Возможность выбора среди наших опытных преподавателей</div>
    </div>
    </div>
    </div>
    <div class="col-md-6">
    <div class="you-video"><iframe src="https://www.youtube.com/embed/0bElgWvTL0k" width="100%" height="100%" frameborder="0" allowfullscreen=""></iframe></div>
    </div>
    </div>
    </div>
    </div>
    <div class="container">
    <div class="row numbers">
    <div class="col-md-3">
    <div class="number-item">
    <div class="number-item-img"><img src="img/icons8-people-100.png" alt="" /></div>
    <div class="number-item-undersigne value">22</div>
    <div class="number-item-undersigne-text">Преподавателя готовых к занятиям</div>
    </div>
    </div>
    <div class="col-md-3">
    <div class="number-item">
    <div class="number-item-img"><img src="img/icons8-people-group-bill-100.png" alt="" /></div>
    <div class="number-item-undersigne value">2450</div>
    <div class="number-item-undersigne-text">Часов живого общения в месяц</div>
    </div>
    </div>
    <div class="col-md-3">
    <div class="number-item">
    <div class="number-item-img"><img src="img/icons8-purposeful-man-100.png" alt="" /></div>
    <div class="number-item-undersigne value">24</div>
    <div class="number-item-undersigne-text">Подготовленых человека в месяц</div>
    </div>
    </div>
    <div class="col-md-3">
    <div class="number-item">
    <div class="number-item-img"><img src="img/icons8-administrator-male-100.png" alt="" /></div>
    <div class="number-item-undersigne value">68</div>
    <div class="number-item-undersigne-text">Новых студентов в месяц</div>
    </div>
    </div>
    </div>
    </div>
    <div class="jumbotron jumbotron-fluid bg-gradient-light">
    <div class="container">
    <h1 class="display-4 text-center mb-5">Тарифы</h1>
    <div class="row">
    <div class="col-md-12">
    <div class="row text-center">@foreach ($tariffs as $tarif)
    <div class="@if ($loop->iteration=='2') primary bg-primary @endif  tarif-item col mt-5">
    <div class="tarif-title @if($loop->iteration=='2') text-primary @else text-success @endif">{{$tarif->name}}</div>
    <div class="tarif-price">{{$tarif->price}} ₽</div>
    {!!$tarif->description!!} <button class="btn btn-lg btn-block @if($loop->iteration=='2') btn-light @else btn-success @endif" data-toggle="modal" data-target="#simpleModal" data-id="{{$tarif->id}}" data-whatever="{{$tarif->name}}" >Купить</button></div>
    @endforeach</div>
    </div>
    </div>
    </div>
    </div>
    <div class="container">
    <div class="reviews-title text-center display-4 text-center mb-5">Отзывы о Нас</div>
    <div class="owl-carousel mb-5">
        @foreach ($reviews as $review)
        <div class="review-item card">
            <div class="review-title text-center">{{$review->title}}</div>
            <div class="review-text">{{$review->text}}</div>
            <hr />
            <div class="review-name">{{$review->name}}</div>
        </div>
        @endforeach
    </div>
    </div>
    <!--Modals-->
    @guest
    <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h3 class='col-12 modal-title-guest text-center'>                    
                    Для оформления подписки необходимо авторизоваться
                </h3>
            </div>
          </div>
        </div>
    </div>
    @else
    <div class="modal fade" id="simpleModal" tabindex="-1" role="dialog" aria-labelledby="simpleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                <h3 class='col-12 modal-title text-center'>                    
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </h3>
            </div>
            
            <div class="modal-body">
                <form method="POST" action="{{route('order.post')}}" class="order-form">
                    @csrf
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id">
                    <input type="hidden" id="tariff_id" name="tariff_id" value="">
                    <input type="hidden" name="start_date" value="@php echo $_SERVER['REQUEST_TIME'] @endphp">
                    <input style="margin: 0 auto;" type="submit" class="btn btn-primary" value="Подписаться">
                  </form>
            </div>   
        @endguest
        
                
          </div>
        </div>
      </div>
@endsection    
@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>
      <script>
      var section = document.querySelector('.number-item');
      var hasEntered = false;
      
      window.addEventListener('scroll', (e) => {
          var shouldAnimate = (window.scrollY + window.innerHeight) >= section.offsetTop;
      
          if (shouldAnimate && !hasEntered) {
            hasEntered = true;
          
          $('.value').each(function () {
              $(this).prop('Counter',0).animate({
              Counter: $(this).text()
              }, {
              duration: 4000,
              easing: 'swing',
              step: function (now) {
                  $(this).text(Math.ceil(now));
              }
                 });
          });
      
        }
      });
      $('.owl-carousel').owlCarousel({
          loop:true,
          margin:10,
          nav:true,
          dots:true,
          navText : ['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:3
              },
              1000:{
                  items:3
              }
          }
      });
      $( document ).ready(function() {
        $('#simpleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var recipient = button.data('whatever'); // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

            var tariff=button.data('id');
            var modal = $(this);
            modal.find('.modal-title').text(recipient);
            modal.find('.modal-body #tariff_id').val(tariff);
        });
      });


      
      </script>
@endsection
    
    
