<?php
// AGREGAR RECAPTCHA
function lapizzeria_agregar_recaptcha(){ ?>
    <script src='https://www.google.com/recaptcha/api.js'></script>
<?php 
}
add_action('wp_head', 'lapizzeria_agregar_recaptcha');

// TABLAS PERSONALIZADAS Y OTRAS FUNCIONES
require get_template_directory() . '/inc/database.php';
// FUNCIONES PARA LAS RESERVACIONES
require get_template_directory() . '/inc/reservaciones.php';
// CREAR OPCIONES PARA EL TEMPLATE
require get_template_directory() . '/inc/opciones.php';

function lapizzeria_setup()
{
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_image_size('nosotros', 300, 291, true);
    add_image_size('especialidades', 768, 515, true);
    add_image_size('especialidades_portrait', 435, 526, true);

    update_option('thumbnail_size_w', 253);
    update_option('thumbnail_size_h', 164);
}
add_action('after_setup_theme', 'lapizzeria_setup');

function lapizzeria_custom_logo(){

    $logo = array(
        'height' => 220,
        'width' => 280,
    );
    add_theme_support('custom-logo', $logo);
}
add_action('after_setup_theme', 'lapizzeria_custom_logo');


function lapizzeria_styles()
{

    // Registrar los estilos
    wp_register_style('normalize', get_template_directory_uri() . '/css/normalize.css', array(), '8.0');
    wp_register_style('google_fonts', 'https://fonts.googleapis.com/css?family=Open+Sans|Raleway:400,700,900', array(), '1.0.0');
    wp_register_style('fluidboxcss', get_template_directory_uri() . '/css/fluidbox.min.css', array('normalize'), '1.0');
    wp_register_style('datetime-local', get_template_directory_uri() . '/css/datetime-local-polyfill.css', array('normalize'), '1.0');
    wp_register_style('style', get_template_directory_uri() . '/style.css', array('normalize'), '1.0');

    // llamar a los estilos
    wp_enqueue_style('normalize');
    wp_enqueue_style('fluidboxcss');
    wp_enqueue_style('datetime-local');
    wp_enqueue_style('style');

    // REGISTRAR JS
    $apikey = esc_html(get_option('lapizzeria_gmap_apikey'));
    wp_register_script('maps', 'https://maps.googleapis.com/maps/api/js?key='.$apikey.'&callback=initMap', array(), '', true);
    wp_register_script('fluidboxjs', get_template_directory_uri() . '/js/scripts.js', array(), '1.0.0', true);
    wp_register_script('datetime-local-polyfill', get_template_directory_uri() . '/js/datetime-local-polyfill.min.js', array(), '1.0.0', true);
    wp_register_script('modernizr', 'https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js', array(), '2.8.3', true);
    wp_register_script('scripts', get_template_directory_uri() . '/js/jquery.fluidbox.min.js', array(), '1.0.0', true);

    wp_enqueue_script('maps');
    wp_enqueue_script('jquery');
    wp_enqueue_script('jquery-ui-core');
    wp_enqueue_script('jquery-ui-datepicker');
    wp_enqueue_script('datetime-local-polyfill');
    wp_enqueue_script('modernizr');
    wp_enqueue_script('fluidboxjs');
    wp_enqueue_script('scripts');


    // pasar variables de php a javascript
    wp_localize_script(
        'scripts',
        'opciones',
        array(
            'latitud' => esc_html(get_option('lapizzeria_gmap_latitud')),
            'longitud' => esc_html(get_option('lapizzeria_gmap_longitud')),
            'zoom' => esc_html(get_option('lapizzeria_gmap_zoom')),
        )
    );

}

add_action('wp_enqueue_scripts', 'lapizzeria_styles');


// FUNCIONES PARA EL BACKEND DE WORDPRESS
function lapizzeria_admin_script(){
    wp_enqueue_script('adminjs', get_template_directory_uri().'/js/admin-ajax.js', array('jquery'), '1.0', true);
    wp_enqueue_script('sweetalert', get_template_directory_uri() . '/js/sweetalert2.all.js', array('jquery'), '7.12.15', true);

    wp_localize_script(
        'adminjs',
        'url_eliminar',
        array(
            'ajaxurl' => admin_url('admin-ajax.php')
        )
    );
}
add_action('admin_enqueue_scripts', 'lapizzeria_admin_script');

// AGREGAR ASYNC Y DEFERS
function agregar_async_defer($tag, $handle){
    if('maps' !== $handle)
        return $tag;
    return str_replace('src', 'async="async" defer="defer" src', $tag);
}
add_filter('script_loader_tag', 'agregar_async_defer', 10, 2);

// creacion de menus
function lapizzeria_menus()
{
    register_nav_menus(array(
        'header-menu' => __('Header Menu', 'lapizzeria'),
        'social-menu' => __('Social Menu', 'lapizzeria'),
    ));
}

add_action('init', 'lapizzeria_menus');

// CUSTON POST TYPE
add_action('init', 'lapizzeria_especialidades');
function lapizzeria_especialidades()
{
    $labels = array(
        'name'               => _x('Pizzas', 'lapizzeria'),
        'singular_name'      => _x('Pizzas', 'post type singular name', 'lapizzeria'),
        'menu_name'          => _x('Pizzas', 'admin menu', 'lapizzeria'),
        'name_admin_bar'     => _x('Pizzas', 'add new on admin bar', 'lapizzeria'),
        'add_new'            => _x('Add New', 'book', 'lapizzeria'),
        'add_new_item'       => __('Add New Pizza', 'lapizzeria'),
        'new_item'           => __('New Pizzas', 'lapizzeria'),
        'edit_item'          => __('Edit Pizzas', 'lapizzeria'),
        'view_item'          => __('View Pizzas', 'lapizzeria'),
        'all_items'          => __('All Pizzas', 'lapizzeria'),
        'search_items'       => __('Search Pizzas', 'lapizzeria'),
        'parent_item_colon'  => __('Parent Pizzas:', 'lapizzeria'),
        'not_found'          => __('No Pizzases found.', 'lapizzeria'),
        'not_found_in_trash' => __('No Pizzases found in Trash.', 'lapizzeria'),
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __('Description.', 'lapizzeria'),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'especialidades'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'supports'           => array('title', 'editor', 'thumbnail'),
        'taxonomies'         => array('category'),
    );

    register_post_type('especialidades', $args);
}

// WIDGETS
function lapizzeria_widgets()
{
    register_sidebar(array(
        'name'          => 'Blog Sidebar',
        'id'            => 'blog_sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'lapizzeria_widgets');


// ADVACEND CUSTOM FIELDS
define( 'ACF_LITE', true );
include_once('advanced-custom-fields/acf.php');
if(function_exists("register_field_group"))
{
    register_field_group(array (
        'id' => 'acf_especialidades',
        'title' => 'Especialidades',
        'fields' => array (
            array (
                'key' => 'field_5a8247b0c5db3',
                'label' => 'precio',
                'name' => 'precio',
                'type' => 'text',
                'instructions' => 'añada un precio del platillo',
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'formatting' => 'html',
                'maxlength' => '',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'especialidades',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_inicio',
        'title' => 'Inicio',
        'fields' => array (
            array (
                'key' => 'field_5a83a79460dd5',
                'label' => 'contenido',
                'name' => 'contenido',
                'type' => 'wysiwyg',
                'instructions' => 'agregue la descripcion',
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_5a83a7b660dd6',
                'label' => 'imagen',
                'name' => 'imagen',
                'type' => 'image',
                'instructions' => 'agregue la imagen',
                'save_format' => 'url',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '5',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
    register_field_group(array (
        'id' => 'acf_sobre-nosotros',
        'title' => 'Sobre Nosotros',
        'fields' => array (
            array (
                'key' => 'field_5a8233f40df9b',
                'label' => 'imagen 1',
                'name' => 'imagen_1',
                'type' => 'image',
                'instructions' => 'suba una imagen',
                'save_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_5a8234900df9e',
                'label' => 'descripcion 1',
                'name' => 'descripcion_1',
                'type' => 'wysiwyg',
                'instructions' => 'agregue aqui la descripcion',
                'required' => 1,
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_5a8234540df9c',
                'label' => 'imagen 2',
                'name' => 'imagen_2',
                'type' => 'image',
                'instructions' => 'suba una imagen',
                'save_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_5a8234bb0dfa0',
                'label' => 'descripcion 2',
                'name' => 'descripcion_2',
                'type' => 'wysiwyg',
                'instructions' => 'agregue aqui la descripcion',
                'required' => 1,
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
            array (
                'key' => 'field_5a82345d0df9d',
                'label' => 'imagen 3',
                'name' => 'imagen_3',
                'type' => 'image',
                'instructions' => 'suba una imagen',
                'save_format' => 'id',
                'preview_size' => 'thumbnail',
                'library' => 'all',
            ),
            array (
                'key' => 'field_5a8234ba0df9f',
                'label' => 'descripcion 3',
                'name' => 'descripcion_3',
                'type' => 'wysiwyg',
                'instructions' => 'agregue aqui la descripcion',
                'required' => 1,
                'default_value' => '',
                'toolbar' => 'full',
                'media_upload' => 'yes',
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'page',
                    'operator' => '==',
                    'value' => '8',
                    'order_no' => 0,
                    'group_no' => 0,
                ),
            ),
        ),
        'options' => array (
            'position' => 'normal',
            'layout' => 'default',
            'hide_on_screen' => array (
            ),
        ),
        'menu_order' => 0,
    ));
}
