<span class="tagline">{{ $tagline }}</span>
<h2 class="{{ $heading_class ?? '' }}">{{ $heading }}</h2>
<div class="text {{ $text_size ?? '' }}">
    <p>{!! $text !!}</p>
</div>

@if (is_array($button) && $button['label'])
    @button($button)@endbutton
@endif
