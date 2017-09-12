<header class="banner">
    <a class="brand" href="{{ home_url('/') }}">
      <img src="@asset('images/pchc-logo.svg')" class="d-inline-block">
      <span>{{ App::siteName() }}</span>
    </a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
</header>
