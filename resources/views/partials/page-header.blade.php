<div class="page-header {!! (has_post_thumbnail() && is_page()) ? 'page-header--featured-image' : '' !!}">
  <h1>{!! App\title() !!}</h1>
  {!! (has_post_thumbnail() && is_page()) ? the_post_thumbnail('og-image') : '' !!}
</div>
