<?php

namespace App\Builder;

/**
 * Class Block
 * @package App\Builder
 *
 * This class is meant to be extended in order to separate the functionality of
 * a builder block from its presentation.
 *
 * @property-read $position
 * @property-read $title
 * @property-read $text
 */
class Block
{
    /**
     * Internal prefix for a block's data.
     *
     * @var string
     */
    public $prefix = '';

    /**
     * Current position inside a loop of blocks.
     *
     * @var int
     */
    public $position = 0;

    /**
     * Main HTML class for the current block.
     *
     * @var string
     */
    public $class = 'b';

    /**
     * Array of classes for the main HTML element.
     *
     * @var array
     */
    public $classes = [];

    /**
     * Array of inline styles for the main HTML element.
     *
     * @var array
     */
    public $styles = [];

    /**
     * Title of the current block.
     *
     * @var bool|string
     */
    public $title = '';

    /**
     * Text of the current block.
     *
     * @var bool|string
     */
    public $text = '';
    public $text_group = [];

    public $template = '';

    public $is_button_empty = true;

    /**
     * Block constructor.
     *
     * @param array $args
     */
    public function __construct(array $args = [])
    {
        global $count;

        // foreach ( $args as $prop => $value ) {
        // 	if ( ! property_exists( get_called_class(), $prop ) ) {
        // 		continue;
        // 	}

        // 	$this->{$prop} = $value;
        // }

        foreach ($args as $prop) {
            $this->{$prop} = get_field($prop);
        }

        $this->template = $this->from_camel_case(substr(get_called_class(), strrpos(get_called_class(), '\\') + 1));

        $this->prefix = get_row_layout();

        $this->class = 'block b-' . str_replace('_', '-', $this->prefix);

        $this->position = intval($count++);

        $this->set_classes();
        $this->set_styles();

        $this->id = $this->get_sub_field('id') ?: "block-{$this->position}";

        // $this->title = $this->get_sub_field( 'title' );
        // $this->text  = $this->get_sub_field( 'text' );

        if (method_exists($this, $this->prefix)) {
            call_user_func([$this, $this->prefix]);
        }

        if ($this->button && is_array($this->button)) {
            $this->is_button_empty = $this->is_empty($this->button);
            $this->text_group['button'] = $this->button;
        }
    }

    /**
     * Obtain the value of a public or private property.
     *
     * @param  string $property
     *
     * @return null
     */
    public function __get($property)
    {
        if (property_exists(get_called_class(), $property)) {
            if (null === $this->{$property} && method_exists($this, "set_{$property}")) {
                $this->{"set_{$property}"}();
            }

            return $this->{$property};
        }

        return null;
    }

    public function is_empty($array_input)
    {
        $filtered = array_filter($array_input);
        return empty($filtered);
    }

    /**
     * [text_image description]
     * @return [type] [description]
     */
    public function hero()
    {
        $this->classes[] = get_sub_field('featured') ? 'featured' : '';
        $this->classes[] = 'color-inverse';

        if ((is_array($this->image) && isset($this->image['url']))) {
            $this->styles['background-image'] = 'url(\'' . esc_url($this->image['url']) . '\')';
        }
    }

    /**
     * [text_image description]
     * @return [type] [description]
     */
    public function partnership()
    {
        if ($this->partners) {
            $this->intro .= ' ' . '<span class="dropdown">' . $this->partners[0]['type'] . '</span> ' . $this->partners[0]['text'];
        }

        if ((is_array($this->image) && isset($this->image['url']))) {
            $this->styles['background-image'] = 'url(\'' . esc_url($this->image['url']) . '\')';
        }
    }

    /**
     * [text_image description]
     * @return [type] [description]
     */
    public function jumbotron()
    {
        $this->classes[] = 'color-inverse';

        if ((is_array($this->image) && isset($this->image['url']))) {
            $this->styles['background-image'] = 'url(\'' . esc_url($this->image['url']) . '\')';
        }
    }

    /**
     * [text_image description]
     * @return [type] [description]
     */
    public function text_image()
    {
        $this->text_column_class = 'text-column col-md-6';
        $this->image_column_class = 'image-column col-md-6';

        if ($this->text_position == 'right') {
            $this->text_column_class .= ' order-md-2';
            $this->image_column_class .= ' order-md-1';
        }

        if ($this->side_image) {
            $this->image_column_style = 'background-image:url(' . $this->side_image['url'] . ');';
        }

        if ($color_select = $this->color_select) {
            $this->classes[] = 'color-inverse';
            $this->text_column_class .= ' bg-' . $color_select;
        }

        if ($this->text_column_extra_class) {
            $this->text_column_class .= ' ' . $this->text_column_extra_class;
        }

        $this->text_group['heading'] = $this->heading;
        $this->text_group['tagline'] = $this->tagline;
        $this->text_group['text'] = $this->text;
        $this->text_group['heading_class'] = 'display-3';
        $this->text_group['heading_class'] .= $this->color_select ? '' : ' title-divider';
        $this->text_group['text_size'] = 'text-small';
    }

    /**
     * [cards description]
     * @return [type] [description]
     */
    public function cards()
    {
    }

    public function set_card($card)
    {
        if ($this->card_types == 'card-1') {
            $card['card_classes'] = 'has-no-image has-borders border-' . $card['color_select'];
        }
        return $card;
    }

    /**
     * [text_subnavigation description]
     * @return [type] [description]
     */
    public function text_subnavigation()
    {
        $this->text_group['heading'] = $this->heading;
        $this->text_group['tagline'] = $this->tagline;
        $this->text_group['text'] = $this->text;
        $this->text_group['heading_class'] = $this->color_select ? '' : 'title-divider';
    }

    /**
     * Obtain specific field data.
     *
     * @param  string $field
     *
     * @return mixed
     */
    public function get_sub_field($field)
    {
        return get_sub_field($this->prefix . '_' . $field);
    }

    /**
     * Set classes for the main HTML element.
     */
    public function set_classes()
    {
        $this->classes = [
            $this->class
        ];

        if ($intro_class = $this->extra_classes) {
            $this->classes[] = $intro_class;
        }
    }

    /**
     * Add classes to the main HTML element.
     *
     * @param array $classes
     */
    public function add_classes(array $classes)
    {
        foreach ($classes as $class) {
            $this->classes[] = $class;
        }
    }

    /**
     * Obtain a list of parsed classes for the main HTML element.
     *
     * @param array $classes
     *
     * @return string
     */
    public function get_parsed_classes(array $classes = [])
    {
        $this->add_classes($classes);

        return join(' ', $this->classes);
    }

    /**
     * Wrapper for `Block::get_parsed_classes()`
     *
     * @see Block::get_parsed_classes()
     *
     * @param array $classes
     *
     * @return string
     */
    public function classes(array $classes = [])
    {
        return $this->get_parsed_classes($classes);
    }

    /**
     * Set inline styles for the main HTML element.
     *
     * Inline styles can be quite different from one block to another, so this
     * method is just a placeholder for other classes.
     */
    public function set_styles()
    {
        if ((is_array($this->background_image) && isset($this->background_image['url']))) {
            $this->styles['background-image'] = 'url(\'' . esc_url($this->background_image['url']) . '\')';
        }
    }

    /**
     * Parse inline styles to be printed as HTML.
     *
     * @return string
     */
    public function get_parsed_styles()
    {
        $styles = [];

        foreach ($this->styles as $prop => $value) {
            $styles[] = $prop . ': ' . $value . ';';
        }

        return join(' ', $styles);
    }

    /**
     * Wrapper for `Block::get_parsed_styles()`
     *
     * @see Block::get_parsed_styles()
     *
     * @return string
     */
    public function styles()
    {
        return $this->get_parsed_styles();
    }

    public function from_camel_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }
}
