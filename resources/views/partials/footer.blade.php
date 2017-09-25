<footer class="footer-main">
  <div class="footer-inner">
    @php(dynamic_sidebar('sidebar-footer'))
    @if (has_nav_menu('primary_navigation'))
      <nav class="nav-footer">
        {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      </nav>
    @endif
    <div class="copyright">&copy; PCHC {{ App::siteName() }}</div>
  </div>
</footer>
