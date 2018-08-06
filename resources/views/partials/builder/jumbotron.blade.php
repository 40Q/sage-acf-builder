@wrapper(['block' => $block])
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <h2>{{ $block->title }}</h2>
                @if ($block->button)
                    @button($block->button)@endbutton
                @endif
            </div>
        </div>
    </div><!-- .container-fluid -->
@endwrapper
