<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Slider
 */
$fields['slider'] = new FieldsBuilder('slider');
$fields['slider']
    ->addImage('image', [
        'preview_size' => 'large'
    ])
    ->addTrueFalse('featured')
    ->addText('heading')
    ->addText('tagline')
    ->addTextarea('intro', [
        'rows' => 2
    ])
    ->addTrueFalse('solid_card')
    ->setLocation('block', '==', 'acf/slider');

/**
 * Steps
 */
$fields['steps'] = new FieldsBuilder('steps');
$fields['steps']
    ->addImage('image', [
        'preview_size' => 'large'
    ])
    ->addTrueFalse('featured')
    ->addText('heading')
    ->addText('tagline')
    ->addTextarea('intro', [
        'rows' => 2
    ])
    ->addTrueFalse('solid_card')
    ->setLocation('block', '==', 'acf/steps');

/**
 * Menu
 */
$fields['menu'] = new FieldsBuilder('menu');
$fields['menu']
    ->addTrueFalse('featured')
    ->addText('heading')
    ->addText('tagline')
    ->addTextarea('intro', [
        'rows' => 2
    ])
    ->addTrueFalse('solid_card')
    ->setLocation('block', '==', 'acf/menu');

return $fields;
