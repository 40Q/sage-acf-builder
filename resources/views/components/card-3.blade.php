<div class="card border-{{ $color_select }}">
    <div class="card-image" style="{{ $image['url'] ? 'background-image: url("' . $image['url'] . '");' : '' }}">
        <a href="#"></a>
    </div>

    <div class="card-text">
        @if ($tagline)
            <span class="tagline">{{ $tagline }}</span>
        @endif

        <h3 class="display-4"><a href="#">{{ $heading }}</a></h3>
        <p>{!! $intro !!}</p>
        
        @if (is_array($button))
            @button($button)@endbutton
        @endif
    </div>
    
</div>

