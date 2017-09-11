<header class="banner">
    <nav class="navbar navbar-toggleable-md navbar-inverse bg-primary">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="{{ home_url('/') }}">
        <img src="@asset('images/pchc-logo.svg')" class="d-inline-block">
        <span>{{ get_bloginfo('name', 'display') }}</span>
      </a>
      @if (has_nav_menu('primary_navigation'))
        <div class="collapse navbar-collapse" id="navbarNav">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav ml-auto']) !!}
        </div>
      @endif
    </nav>
</header>
