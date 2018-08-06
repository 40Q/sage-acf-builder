<div 
    class="card col-md-4{{ $card_position == 'right' ? ' offset-md-7' : '' }}" 
    style="{{ $type == 'background' ? 'background-image: url("' . $image['url'] . '");' : '' }}">
    <span class="tagline">{{ $tagline }}</span>
    <h2 class="display-3 title-divider divider-yellow">{{ $heading }}</h2>
    <p>{!! $intro !!}</p>
    
    @if (is_array($button))
        @button($button)@endbutton
    @endif
</div>
