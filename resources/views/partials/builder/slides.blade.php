@wrapper(['block' => $block])
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>{{ $block->title }}</h2>
            </div>
        </div>

        @if ($block->slides)
        <div class="row">
            <div class="col-12">
            @foreach ($block->slides as $slide)
                <div>
                    <div class="row">
                        <div class="col-md-6" style="background-image: url({{ $slide['image']['url'] }});">
                        </div>
                        <div class="col-md-6">
                            <span>{{ $slide['tagline'] }}</span>
                            <h3><a href="#">{{ $slide['title'] }}</a></h3>
                            {!! $slide['text'] !!}
                            @if ($slide['button'])
                                @button($slide['button'])@endbutton
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        @endif
    </div>
@endwrapper
