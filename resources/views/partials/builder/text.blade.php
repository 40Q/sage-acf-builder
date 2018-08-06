@wrapper(['block' => $block])
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <span class="tagline">{{ $block->tagline }}</span>
                <h2 class="title-divider">{{ $block->heading }}</h2>
                {!! $block->text !!}
                
                @if ($block->button)
                    @button($block->button)@endbutton
                @endif
            </div>
        </div>
    </div>
@endwrapper
