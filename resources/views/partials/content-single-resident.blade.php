<article @php(post_class())>
  <header>
    @if( is_single() )
      <h1 class="entry-title">{{ get_the_title() }}</h1>
    @else
      <h2 class="entry-title">{{ get_the_title() }}</h2>
    @endif
    <div class="meta resident-class">
      {!! Resident::residentClass() !!}
    <div>
  </header>
  <div class="entry-content">
    <div class="resident-bio">
      {{ the_post_thumbnail('medium', [
        'class' => 'img-fluid resident-img resident-img--no-grid'
        ]) }}
      @php(the_content())
    </div>
    {{ the_post_thumbnail('medium', [
      'class' => 'img-fluid resident-img resident-img--grid'
      ]) }}
    <div class="resident-details">
      {!! Resident::residentHometown() !!}
      {!! Resident::residentAlmaMater() !!}
      {!! Resident::residentWhere() !!}
    </div>
  </div>
  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>
</article>
