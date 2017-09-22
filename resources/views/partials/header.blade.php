<header class="banner">
    <a class="brand" href="{{ home_url('/') }}">
      <img src="@asset('images/pchc-logo.svg')" class="d-inline-block">
      <span>{{ App::siteName() }}</span>
    </a>
    <form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search for..." aria-label="Search for..."  name="s">
        <span class="input-group-btn">
          <button class="btn btn-primary" type="submit">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </span>
      </div>
    </form>
    <button class="nav-toggle hidden-md-up" data-toggle="collapse" data-target=".nav-primary">
      <i class="fa fa-bars fa-lg" aria-hidden="true"></i>
    </button>
    <nav class="nav-primary collapse">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
</header>
