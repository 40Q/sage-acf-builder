@wrapper(['block' => $block])
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2>{{ $block->heading }}</h2>
            @if ($block->accordion) @php( $i = 0)
                <div class="accordion" id="main-accordion">
                @foreach ($block->accordion as $item)
                    <div class="card">
                        <div class="card-header" id="heading-{{ $i }}">
                            <h5 class="mb-0">
                                <button 
                                    class="btn btn-link{{ $i != 0 ? ' collapsed' : '' }}" 
                                    type="button" 
                                    data-toggle="collapse" 
                                    data-target="#collapse-{{ $i }}" 
                                    aria-expanded="{{ $i != 0 ? 'false' : 'true' }}" 
                                    aria-controls="collapse-{{ $i }}">
                                    {{ $item['title'] }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse-{{ $i }}" class="collapse{{ $i != 0 ? ' ' : ' show' }}" aria-labelledby="heading-{{ $i }}" data-parent="#main-accordion">
                            <div class="card-body">
                            {!! $item['content'] !!}
                            </div>
                        </div>
                    </div><!-- .card -->
                    @php( $i++ )
                @endforeach
                </div><!-- .accordion -->
            @endif
            </div>
        </div><!-- .row -->
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
