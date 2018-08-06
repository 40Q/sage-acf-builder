@wrapper(['block' => $block])
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-baseline">
            @if ($block->title)
                <h2 class="title-divider divider-yellow">{{ $block->title }}</h2>
            @endif
            @if ($block->view_all_button)
                <a href="{{ $block->view_all_button_url }}" class="btn {{ $block->view_all_button_class }}">{{ $block->view_all_button_label }}</a>
            @endif
        </div>
        @if ($block->cards)
        <div class="row">
            @foreach ($block->cards as $card)
                @php( $card = $block->set_card($card) )
                <div class="col-md-{{ 12/$block->column_number }} {{ $block->card_types }}">
                    @component('components.' . $block->card_types, $card)@endcomponent
                </div>
            @endforeach
        </div>
        @endif
    </div>
@endwrapper
