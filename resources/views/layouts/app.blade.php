<!doctype html>
<html @php(language_attributes())>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-NBFMSW3');</script>
  <!-- End Google Tag Manager -->
  @include('partials.head')
  <body @php(body_class())>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NBFMSW3"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @php(do_action('get_header'))
    <div class="grid-wrapper grid-wrapper--header">
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
