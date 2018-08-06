@while(have_rows('sections'))
  @php
    the_row();
    $layout = get_row_layout();
    $class = 'App\\Builder\\Block';
    $array = call_user_func( ['App\Builder\Config', $layout] );
    // print_r( $array );
    $block = new $class($array);
    // echo "<pre>";
    // print_r( $block );
    // echo "</pre>";
  @endphp
  
  @includeIf('partials.builder.' . $layout, ['block' => $block])
  
@endwhile
