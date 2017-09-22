@if( is_front_page() )
  <div class="widgets-front-page">
    @php(dynamic_sidebar('widgets-front-page'))
  </div>
@endif
