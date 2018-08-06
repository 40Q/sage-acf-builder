@wrapper(['block' => $block])
    <div class="container-fluid">
        <div class="row">
            <div class="{{ $block->text_column_class }}">
                @if ($block->text_group)
                    @text($block->text_group)
                    @endtext
                @endif
            </div>
            <div class="{{ $block->image_column_class }}" style="{{ $block->image_column_style }}">
            </div>
        </div>
    </div>
@endwrapper
