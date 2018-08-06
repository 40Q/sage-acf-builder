<div 
    class="card {{ $card_classes ?? '' }}" 
    style="{{ $type == 'background' ? 'background-image: url("' . $image['url'] . '");' : '' }}">
    @if ( !empty($overlay) )
        <div class="overlay card-background bg-{{ $color_select }}-8"></div>
    @endif

    <div class="card-foreground">

    @if ($tagline)
        <span class="tagline">{{ $tagline }}</span>
    @endif

    <h3>{{ $heading }}</h3>
    <p>{!! $intro !!}</p>
    
    @if (is_array($button))
        @button($button)@endbutton
    @endif
    </div>
    
</div>

