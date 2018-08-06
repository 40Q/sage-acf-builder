@wrapper(['block' => $block])
    <div class="container-fluid">
        @if ($block->features) @php( $i=0 )
            @foreach ($block->features as $feature)
                <div class="row feature row-{{ $i%2 !== 0 ? 'odd' : 'even' }}">
                    <div 
                        class="col-md-6 feature-text{{ $i%2 !== 0 ? ' order-md-2' : ' offset-md-1 ' }}">
                        <h3 class="title-divider">{{ $feature['heading'] }}</h3>
                        <p>{!! $feature['text'] !!}</p>
                        @if ($feature['button'])
                            @button($feature['button'])@endbutton
                        @endif
                    </div>
                    <div 
                        class="col-md-5 feature-image{{ $i++%2 !== 0 ? ' order-md-1' : '' }}"
                        style="background-image:url({{ $feature['image']['url'] }});">
                    </div>
                </div>
            @endforeach
        @endif
    </div><!-- .container-fluid -->
@endwrapper
