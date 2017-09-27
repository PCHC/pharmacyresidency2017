<!doctype html>
<html @php(language_attributes())>
  @include('partials.head')
  <body @php(body_class())>
    <div class="grid-wrapper grid-wrapper--header">
      @php(do_action('get_header'))
      @include('partials.header')
    </div>
    @include('partials.widgets-front-page')
    <div class="grid-wrapper grid-wrapper--main">
    <main class="main" role="document">
      @yield('content')
    </main>
    @if (App\display_sidebar())
      <aside class="sidebar">
        @include('partials.sidebar')
      </aside>
    @endif
    </div>
    <div class="grid-wrapper grid-wrapper--footer">
    @php(do_action('get_footer'))
    @include('partials.footer')
    </div>
    @php(wp_footer())
  </body>
</html>
