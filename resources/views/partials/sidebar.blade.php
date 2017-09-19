@php(dynamic_sidebar('sidebar-primary'))
<section class="widget widget_resident-classes">
  @php(
    $_top_classes = get_terms(array(
      'taxonomy' => 'class',
      'parent' => 0
    ))
  )
  @if($_top_classes)
    <ul>
    @foreach($_top_classes as $top_class)
      <li class="resident-class--top">
        <a href="{{get_term_link($top_class)}}">{{$top_class->name}}</a>

        @php(
          $_classes = get_terms(array(
            'taxonomy' => 'class',
            'parent' => $top_class->term_id
          ))
        )
        @if($_classes)
          <ul>
            @foreach($_classes as $class)
              <li class="resident-class--sub">
                <a href="{{get_term_link($class)}}">{{$class->name}}</a>

                @php(
                  $loop_args = array(
                    'post_type' => 'resident',
                    'tax_query' => array(
                      array(
                        'taxonomy' => 'class',
                        'field' => 'slug',
                        'terms' => $class->slug,
                      ),
                    ),
                  )
                )
                @php( $loop = new WP_Query($loop_args) )

                @if($loop->have_posts())
                  <ul>
                    @while( $loop->have_posts() ) @php($loop->the_post())
                      <li class="resident-class--resident">
                        <a href="{{ get_the_permalink() }}">
                          <span>{{get_the_title()}}</span>
                        </a>
                      </li>
                    @endwhile
                  </ul>
                @endif

              </li>
            @endforeach
          </ul>
        @endif
      </li>
    @endforeach
    </ul>
  @endif
</section>
