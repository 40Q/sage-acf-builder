@wrapper(['block' => $block])
    <div class="container-fluid">
        <div class="row">
            @if ($block->solid_card) 
                @hero_card((array)$block)@endhero_card
            @else
                <div class="col-md-3 offset-md-1">
                    <span class="tagline">{{ $block->tagline }}</span>
                </div>
                <div class="w-100"></div>
                <div class="col-md-6 offset-md-1">
                    <h1>{{ $block->heading }}</h1>
                </div>
                <div class="w-100"></div>
                <div class="col-md-5 offset-md-1">
                    <p>{!! $block->intro !!}</p>

                    @if ( !$block->is_button_empty )
                        @button($block->button)@endbutton
                    @endif
                </div>
            @endif
        </div>
    </div><!-- .container-fluid -->
@endwrapper
