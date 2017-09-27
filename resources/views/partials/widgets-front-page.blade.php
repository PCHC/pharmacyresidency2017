@if( is_front_page() )
  <div class="grid-wrapper grid-wrapper--widgets-front-page">
    <div class="widgets-front-page">
      @php(dynamic_sidebar('widgets-front-page'))
    </div>
  </div>
@endif
