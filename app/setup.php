<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('enqueue_block_assets', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), ['wp-blocks'], null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery', 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-api'], null, true);

    if (is_single() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage')
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ];
    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return '<?= ' . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });

    /**
     * Create a component
     */
    sage('blade')->compiler()->component('components.button');
    sage('blade')->compiler()->component('components.wrapper');
    sage('blade')->compiler()->component('components.card');
    sage('blade')->compiler()->component('components.text_group', 'text');
    sage('blade')->compiler()->component('components.hero_card');
});

/**
 * Initialize ACF Builder
 */
add_action('init', function () {
    // Register Classes/Controller
    collect(glob(config('theme.dir') . '/app/classes/*.php'))->map(function ($field) {
        return require_once $field;
    });

    // Test
    // echo '<pre>';
    // print_r(collect(glob(config('theme.dir') . '/app/fields/*.php'))->map(function ($field) {
    //     return require_once $field;
    // }));
    // echo '</pre>';
    // die();

    // Register Fields
    collect(glob(config('theme.dir') . '/app/fields/*.php'))->map(function ($field) {
        return require_once $field;
    })->map(function ($fields) {
        foreach ($fields as $field) {
            $block_content = $field->build();
            Builder\Config::createDynamic(str_replace('group_', '', $block_content['key']), array_column($block_content['fields'], 'name'));
            // echo '<pre>';
            // print_r($block_content);
            // echo '</pre>';
            acf_add_local_field_group($block_content);
        }
    });
}, 12);

/**
 * Add ACF Option pages
 */
if (function_exists('acf_add_options_page')) {
    acf_add_options_page([
        'page_title' => 'Global Settings',
        'menu_title' => 'Global Settings',
        'menu_slug' => 'global-options',
        'capability' => 'edit_posts',
        'redirect' => false
    ]);
}

/**
 * Example Shortcode
 */
add_shortcode('blockquote', function ($atts, $content = null) {
    $a = shortcode_atts([
        'author' => '',
    ], $atts);
    $output = '<blockquote>' . $content . '</blockquote>';
    $output .= $a['author'] != '' ? '<div class="blockquote-author">' . $a['author'] . '</div>' : '';
    return $output;
});

/**
 * ACF INIT
 */
add_action('acf/init', function () {
    // check function exists
    if (function_exists('acf_register_block')) {
        // register a testimonial block
        acf_register_block([
            'name' => 'slider',
            'title' => __('Slider'),
            'description' => __('A custom slider block.'),
            'render_callback' => __NAMESPACE__ . '\\my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => ['slider', 'quote'],
        ]);

        acf_register_block([
            'name' => 'about',
            'title' => __('About'),
            'description' => __('About'),
            'render_callback' => __NAMESPACE__ . '\\my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => ['about'],
        ]);

        acf_register_block([
            'name' => 'steps',
            'title' => __('Steps'),
            'description' => __('steps'),
            'render_callback' => __NAMESPACE__ . '\\my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => ['steps'],
        ]);

        acf_register_block([
            'name' => 'menu',
            'title' => __('Our Menu'),
            'description' => __('Include the Menu'),
            'render_callback' => __NAMESPACE__ . '\\my_acf_block_render_callback',
            'category' => 'formatting',
            'icon' => 'admin-comments',
            'keywords' => ['menu'],
        ]);
    }
});

function my_acf_block_render_callback($block)
{
    // convert name ("acf/testimonial") into path friendly slug ("testimonial")
    $slug = str_replace('acf/', '', $block['name']);

    // include a template part from within the "template-parts/block" folder
    // echo STYLESHEETPATH . "/partials/block/content-{$slug}.blade.php";

    $block = '';
    $array = call_user_func(['App\Builder\Config', $slug]);

    if (is_array($array)) {
        $class = 'App\\Builder\\Block';
        $block = new $class($array);
    }

    if (file_exists(STYLESHEETPATH . "/views/partials/block/content-{$slug}.blade.php")) {
        echo \App\template('partials.block.content-' . $slug, ['block' => $block]);
    }
}
