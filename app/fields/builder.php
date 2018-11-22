<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Button
 */
$fields['button'] = new FieldsBuilder('button');
$fields['button']
    ->addGroup('button')
        ->addText('label',[
            'wrapper'=> [
                'width' => '50%'
            ]
        ])
        ->addText('url', [
            'wrapper'=> [
                'width' => '50%'
            ]
        ])
        ->addText('class', [
            'wrapper'=> [
                'width' => '50%'
            ]
        ])
        ->addSelect('button_type', [
            'allow_null' => 1,
            'wrapper'=> [
                'width' => '50%'
            ],
            'default_value' => 'btn-arrow'
        ])
            ->addChoices(['btn-arrow' => 'Arrow'], ['btn-border-arrow' => 'Arrow with Borders']);

/**
 * Images
 */
$fields['side_image'] = new FieldsBuilder('side_image');
$fields['side_image']
    ->addImage('side_image',[
        'preview_size' => 'large'
    ]);

/**
 * Text
 */
$fields['text'] = new FieldsBuilder('text');
$fields['text']
    ->addText('heading')
    ->addText('tagline')
    ->addWysiwyg('text');

/**
 * Number of Columns
 */
$fields['column_number'] = new FieldsBuilder('column_number');
$fields['column_number']
    ->addSelect('column_number')
    ->addChoices(1, 2, 3, 4);

/**
 * Hero
 */
$fields['hero'] = new FieldsBuilder('hero');
$fields['hero']
    ->addImage('image',[
        'preview_size' => 'large'
    ])
    ->addTrueFalse('featured')
    ->addText('heading')
    ->addText('tagline')
    ->addTextarea('intro', [
        'rows' => 2
    ])
    ->addTrueFalse('solid_card');

/**
 * Section Settings
 */
$fields['section_settings'] = new FieldsBuilder('section_settings');
$fields['section_settings']
    ->addText('extra_classes')
    ->addText('extra_styles');

/**
 * Cards
 */
$fields['card'] = new FieldsBuilder('card');
$fields['card']
    ->addImage('image',[
        'preview_size' => 'medium'
    ])
    ->addText('heading')
    ->addText('tagline')
    ->addTextarea('intro', [
        'rows' => 3
    ]);

/**
 * Card Types
 */
$fields['card_types'] = new FieldsBuilder('card_types');
$fields['card_types']
    ->addSelect('card_types')
    ->addChoices(['card-1' => 'Layout 1'], ['card-2' => 'Layout 2'], ['card-3' => 'Layout 3'], ['card-4' => 'Layout 4']);

/**
 * Color Select
 */
$fields['color_select'] = new FieldsBuilder('color_select');
$fields['color_select']
    ->addSelect('color_select', [
        'allow_null' => 1
    ])
    ->addChoices(['yellow' => 'Yellow'], ['yellow_orange' => 'Yellow Orange'], ['orange' => 'Orange'], ['red' => 'Red']);

/**
 * Background Settings
 */
$fields['bg_settings'] = new FieldsBuilder('bg_settings');
$fields['bg_settings']
    ->addImage('background_image')
    ->addFields($fields['color_select']);

/**
 * Columns
 */
$fields['columns'] = new FieldsBuilder('columns');
$fields['columns']
    ->addRepeater('columns', ['min' => 1, 'max' => 2, 'layout' => 'block'])
        ->addTab('Content')
            ->addWysiwyg('content')
        ->addTab('Settings')
            ->addText('class')
            ->addFields($fields['bg_settings']);

/**
 * Color Rectangles
 */
$fields['color_rectangles'] = new FieldsBuilder('color_rectangles');
$fields['color_rectangles']
    ->addRepeater('color_rectangles', ['min' => 4, 'max' => 4, 'layout' => 'block'])
        ->addText('title')
        ->addFields($fields['button'])
        ->addFields($fields['color_select']);

/**
 * Principles
 */
$fields['principles'] = new FieldsBuilder('principles');
$fields['principles']
    ->addRepeater('principles', ['layout' => 'block'])
        ->addWysiwyg('initial_text')
        ->addText('hover_title')
        ->addWysiwyg('hover_text');

/**
 * Slides
 */
$fields['slides'] = new FieldsBuilder('slides');
$fields['slides']
    ->addRepeater('slides', ['layout' => 'block'])
        ->addImage('image',[
            'preview_size' => 'large'
        ])
        ->addFields($fields['text'])
        ->addFields($fields['button']);

/**
 * Accordion
 */
$fields['accordion'] = new FieldsBuilder('accordion');
$fields['accordion']
    ->addRepeater('accordion', ['layout' => 'block'])
        ->addText('title')
        ->addWysiwyg('content');

/**
 * Partners
 */
$fields['partners'] = new FieldsBuilder('partners');
$fields['partners']
    ->addRepeater('partners', ['layout' => 'table'])
        ->addText('type', [ 
            'wrapper'=> [
                'width' => '30%'
            ]
        ])
        ->addTextarea('text', [
            'rows' => 3,
            'wrapper'=> [
                'width' => '70%'
            ]
        ]);

/**
 * Subnavigation
 */
$fields['subnavigation'] = new FieldsBuilder('subnavigation');
$fields['subnavigation']
    ->addText('title')
    ->addRepeater('subnavigation', ['layout' => 'table'])
        ->addText('nav_label')
        ->addText('url');

/**
 * Titles
 */
$fields['titles'] = new FieldsBuilder('titles');
$fields['titles']
    ->addText('title', [ 
        'wrapper'=> [
            'width' => '60%'
        ]
    ])
    ->addTrueFalse('view_all_button', [
        'wrapper' => [
            'width' => '40%'
        ]
    ])
    ->addText('view_all_button_label', [
        'wrapper' => [
            'width' => '30%'
        ]
    ])
        ->conditional('view_all_button', '==', '1')
    ->addText('view_all_button_url', [
        'wrapper' => [
            'width' => '40%'
        ]
    ])
        ->conditional('view_all_button', '==', '1')
    ->addText('view_all_button_class', [
        'wrapper' => [
            'width' => '30%'
        ]
    ])
        ->conditional('view_all_button', '==', '1');
    

/**
 * Features
 */
$fields['features'] = new FieldsBuilder('features');
$fields['features']
    ->addRepeater('features', ['layout' => 'block'])
        ->addImage('image',[
            'preview_size' => 'large'
        ])
        ->addText('heading')
        ->addTextarea('text')
        ->addFields($fields['button']);

/**
 * Shortcut
 */
$fields['shortcuts'] = new FieldsBuilder('shortcut');
$fields['shortcuts']
    ->addRepeater('shortcuts', ['min' => 4, 'max' => 4, 'layout' => 'block'])
        ->addFields($fields['color_select'])
        ->addImage('icon',[
            'preview_size' => 'large'
        ])
        ->addText('heading')
        ->addFields($fields['button']);

/**
 * Flexible Content 
 */
$fields['page_content'] = new FieldsBuilder('page_content');
$fields['page_content']
    ->addFlexibleContent('sections', [
        'mc_acf_ft_true_false'=> 1
    ])
        // Content
        ->addLayout('content')
            ->addTab('Content')
                ->addFields($fields['columns'])
            ->addTab('Settings')
                ->addFields($fields['bg_settings'])
        
        // Hero
        ->addLayout('hero')
            ->addTab('Content')
                ->addFields($fields['hero'])
                ->addSelect('card_position')
                    ->addChoices(['left' => 'Left'], ['right' => 'Right'])
                ->addFields($fields['button'])
            ->addTab('Settings')

        // Cards
        ->addLayout('cards')
            ->addTab('Content')
                ->addFields($fields['titles'])
                ->addFields($fields['column_number'])
                ->addFields($fields['card_types'])
                ->addRepeater('cards', ['layout' => 'block'])
                    ->addFields($fields['card'])
                    ->addFields($fields['color_select'])
                    ->addFields($fields['button'])
                ->endRepeater()
            ->addTab('Settings')
                ->addFields($fields['section_settings'])

        // Text + Image
        ->addLayout('text_image')
            ->addTab('Content')
                ->addFields($fields['text'])
                ->addSelect('text_position')
                    ->addChoices(['left' => 'Left'], ['right' => 'Right'])
                ->addFields($fields['button'])
                ->addFields($fields['side_image'])

            ->addTab('Settings')
                ->addFields($fields['bg_settings'])
                ->addText('text_column_extra_class')

        // Text
        ->addLayout('text')
            ->addTab('Content')
                ->addFields($fields['text'])
            ->addTab('Settings')
                ->addFields($fields['bg_settings'])

        // Slider
        ->addLayout('slides')
            ->addTab('Content')
                ->addText('title')
                ->addFields($fields['slides'])
            ->addTab('Settings')
                ->addFields($fields['section_settings'])
                ->addFields($fields['bg_settings'])

        // Jumbotron
        ->addLayout('jumbotron')
            ->addTab('Content')
                ->addImage('image',[
                    'preview_size' => 'large'
                ])
                ->addText('title')
                ->addFields($fields['button'])
            ->addTab('Settings')

        // Features List
        ->addLayout('features_list')
            ->addFields($fields['features'])

        // 4 Columns Shortcut
        ->addLayout('four_columns_shortcut')
            ->addFields($fields['shortcuts'])
        
        // Accordion
        ->addLayout('accordion')
            ->addTab('Content')
                ->addText('heading')
                ->addFields($fields['accordion'])
            ->addTab('Settings')
                ->addFields($fields['section_settings'])
    
        // Vue Test
        ->addLayout('vue_test')
                
    ->setLocation('post_type', '==', 'page')
    ->setGroupConfig('hide_on_screen', [
        'the_content',
    ]);

/**
 * Global Settings
 */
$fields['global_settings'] = new FieldsBuilder('global_settings');
$fields['global_settings']
    ->addTab('header', ["placement" => "left"])
        ->addImage('logo', [
            'preview_size' => 'medium'
        ])
    ->addTab('footer', ["placement" => "left"])
        ->addImage('footer_logo', [
            'preview_size' => 'medium'
        ])
    ->setLocation('options_page', '==', 'global-options');

return $fields;

return $fields;
