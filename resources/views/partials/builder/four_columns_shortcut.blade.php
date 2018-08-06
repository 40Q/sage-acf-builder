@wrapper(['block' => $block])
    <div class="container-fluid">
        @if ($block->shortcuts)
            <div class="row">
                @foreach ($block->shortcuts as $shortcut)
                <div class="col-md-3 p-0">
                    <div class="card text-center bg-{{ $shortcut['color_select'] }}">
                        @if ($shortcut['icon'])
                            <span class="icon-container">
                                <img src="{{ $shortcut['icon']['url'] }}" alt="" class="img-fluid">
                            </span>
                        @endif
                        <h3>{{ $shortcut['heading'] }}</h3>
                        @if (is_array($shortcut['button']))
                            @button($shortcut['button'])@endbutton
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div><!-- .container-fluid -->
@endwrapper
