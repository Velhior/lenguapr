   @extends('layouts.app')
   @section('title')
    {{$mainPage->title}}
   @endsection
   @section('description')
    {{$mainPage->description}}
   @endsection
   @section('content')  
    {!!$mainPage->body!!}
@endsection    
@section('scripts')
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
      </script>
@endsection
    
    
