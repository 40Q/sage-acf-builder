<div class="card">

    <div class="row">

        <div class="col-md-4 card-image" style="{{ $image['url'] ? 'background-image: url("' . $image['url'] . '");' : '' }}">
        </div><!-- .card-image -->

        <div class="col-md-8 card-text border-{{ $color_select }}">
            @if ($tagline)
                <span class="tagline">{{ $tagline }}</span>
            @endif

            <h3 class="display-5"><a href="#">{{ $heading }}</a></h3>
            <p>{!! $intro !!}</p>
            
            @if (is_array($button))
                @button($button)@endbutton
            @endif
        </div><!-- .card-text -->

    </div><!-- .row -->

</div><!-- .card -->

