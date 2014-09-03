<?php
/*
 *  Author: Guilherme Harrison | @GuiHarrison
 *  URL: boca.com | @boca
 *  Funções e funcionalidades do Boca do Forno
 */

/*------------------------------------*\
    Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 180, 112, true); // Small Thumbnail
    add_image_size('paraNoticias', 220, 158, false); // Tamanho de thumbnail para as notícias
    add_image_size('paraSlider', '', 400, false); // Tamanho de thumbnail para o slider

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('boca', get_template_directory() . '/languages');
}

/*------------------------------------*\
    Functions
\*------------------------------------*/

// HTML5 Blank navigation
function boca_nav()
{
    wp_nav_menu(
    array(
        'theme_location'  => 'header-menu',
        'menu'            => '',
        'container'       => 'div',
        'container_class' => 'menu-{menu slug}-container',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,
        'fallback_cb'     => 'wp_page_menu',
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul>%3$s</ul>',
        'depth'           => 0,
        'walker'          => ''
        )
    );
}

//Construindo o slider

function sliderNaHome() {
    $query = new WP_Query( array(
        'post_type' => 'slider',
    ));

    if ( $query->have_posts() ) { ?>
    <div id="slider">
        <ul class="bjqs">

            <?php while ( $query->have_posts() ) : $query->the_post(); ?>

                <li id="slide-<?php the_ID(); ?>" <?php post_class( 'slide' ); ?>>

                    <a href="<?php echo get_post_meta(get_the_ID(), 'my_meta_box_text', true); ?>" target="_blank">
                        <?php the_post_thumbnail('paraSlider'); ?>
                        <h2><?php the_title(); ?></h2>
                        <p><?php the_excerpt(); ?></p>
                    </a>

                </li>

            <?php endwhile; ?>

        </ul>
    </div>
    <?php }
    wp_reset_postdata();
}

function extra() {
    $chamaNoticias = new WP_Query( array (
        'post_type' => 'noticias',
    ));

    if ($chamaNoticias->have_posts() ) { ?>
    <div id="noticias">
        <ul class="bjqs">
            <?php while ($chamaNoticias->have_posts() ) : $chamaNoticias->the_post(); ?>

                <li id="noticia-<?php the_ID(); ?>" <?php post_class('noticia'); ?>>
                    <?php the_post_thumbnail('paraNoticias'); ?>
                    <h6 class="data"><?php echo get_the_date(); ?></h6>
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_content(); ?></p>
                </li>

            <?php endwhile; ?>
        </ul>
    </div>
    <?php
    }
}

// Load HTML5 Blank scripts (header.php)
function boca_header_scripts()
{
    if (!is_admin()) {

        wp_deregister_script('jquery'); // Deregister WordPress jQuery
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), '1.9.1'); // Google CDN jQuery
        wp_enqueue_script('jquery'); // Enqueue it!

        // wp_register_script('conditionizr', 'http://cdnjs.cloudflare.com/ajax/libs/conditionizr.js/4.0.0/conditionizr.js', array(), '4.0.0'); // Conditionizr
        // wp_enqueue_script('conditionizr'); // Enqueue it!

        // wp_register_script('modernizr', 'http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js', array(), '2.6.2'); // Modernizr
        // wp_enqueue_script('modernizr'); // Enqueue it!

        // wp_register_script('bocascripts', get_template_directory_uri() . '/assets/scripts.js', array(), '1.0.0'); // Custom scripts
        // wp_enqueue_script('bocascripts'); // Enqueue it!

        wp_register_script('bbq', get_template_directory_uri() . '/assets/jquery.ba-bbq.min.js', array('jquery'), '', true); // BBQ
        wp_enqueue_script('bbq'); //Enqueue it!

		wp_enqueue_script( 'ajax-implementation.js', get_bloginfo('template_directory') . "/assets/ajax.js", array( 'jquery' ) ); // Carregar ajax para o produto
		add_action( 'init', 'add_myjavascript' );

    }
}

// Load HTML5 Blank conditional scripts
function boca_conditional_scripts()
{

    if (is_home()) {
        wp_register_script('gmaps', 'http://maps.googleapis.com/maps/api/js?sensor=false'); // Google Maps
        wp_enqueue_script('gmaps'); //Enqueue it!

        wp_register_script('projetor', get_template_directory_uri() . '/assets/bjqs-1.3.min.js'); // Slider
        wp_enqueue_script('projetor'); // Enqueue it!

        wp_register_style('projetorEstilo', get_template_directory_uri() . '/assets/bjqs.css'); // Estilo do slider
        wp_enqueue_style('projetorEstilo'); //Enqueue it!

        wp_register_script('abas', get_template_directory_uri() . '/assets/simpletabs_1.3.packed.js', array(), '1.3.0'); // Abas
        wp_enqueue_script('abas'); //Enqueue it!

        // wp_register_style('abasEstilo', get_template_directory_uri() . '/assets/simpletabs.css'); // Estilo das abas
        // wp_enqueue_style('abasEstilo'); //Enqueue it!

        wp_register_script('infoBox', get_template_directory_uri() . '/assets/infobox_packed.js'); // infoBox
        wp_enqueue_script('infoBox'); //Enqueue it!
    }

	else {
		wp_register_style('produtos', get_template_directory_uri() . '/produtos.css', array(), '1.0.0'); // Conditional style
        wp_enqueue_style('produtos'); // Enqueue it!
	}
}

// Load HTML5 Blank styles
function boca_styles()
{
    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('boca', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('boca'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_html5_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'boca'), // Main Navigation
        'sidebar-menu' => __('Sidebar Menu', 'boca'), // Sidebar Navigation
        'extra-menu' => __('Extra Menu', 'boca') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'boca'),
        'description' => __('Description for this widget-area...', 'boca'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'boca'),
        'description' => __('Description for this widget-area...', 'boca'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'boca') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function bocagravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function bocacomments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }

?>

    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
    <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <div class="comment-author vcard">
    <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
    <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
    </div>
<?php if ($comment->comment_approved == '0') : ?>
    <em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
    <br />
<?php endif; ?>

    <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
        <?php
            printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
        ?>
    </div>

    <?php comment_text() ?>

    <div class="reply">
    <?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif; ?>
<?php }

/*------------------------------------*\
    Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'boca_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'boca_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'boca_styles'); // Add Theme Stylesheet
add_action('init', 'register_html5_menu'); // Add HTML5 Blank Menu
add_action('init', 'slider'); // Add our slider Custom Post Type
add_action('init', 'produtos'); // Add our sweets Custom Post Type
add_action('init', 'noticias'); // Add our news Custom Post Type
add_action('init', 'locais'); // Add our places Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'bocagravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('html5_shortcode_demo', 'html5_shortcode_demo'); // You can place [html5_shortcode_demo] in Pages, Posts now.
add_shortcode('html5_shortcode_demo_2', 'html5_shortcode_demo_2'); // Place [html5_shortcode_demo_2] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [html5_shortcode_demo] [html5_shortcode_demo_2] Here's the page title! [/html5_shortcode_demo_2] [/html5_shortcode_demo]

/*------------------------------------*\
    Custom Post Types
\*------------------------------------*/

// Create 1 Custom Post type for a Demo, called HTML5-Blank
function slider()
{
    register_taxonomy_for_object_type('category', 'slider'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'slider');
    // register_taxonomy( 'Link', 'slider', array('hierarchical' => false, 'label' => 'Link', 'rewrite' => true) );
    register_post_type('slider', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Slider', 'slider'), // Rename these to suit
            'singular_name' => __('Slide', 'slider'),
            'add_new' => __('Adicionar novo', 'slider'),
            'add_new_item' => __('Adicionar novo slide', 'slider'),
            'edit' => __('Editar', 'slider'),
            'edit_item' => __('Editar slide', 'slider'),
            'new_item' => __('Novo slide', 'slider'),
            'view' => __('Ver slide', 'slider'),
            'view_item' => __('Ver slide', 'slider'),
            'search_items' => __('Procurar slide', 'slider'),
            'not_found' => __('Nenhum slide encontrado', 'slider'),
            'not_found_in_trash' => __('Nenhum slide encontrado no lixo', 'slider')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'menu_position' => 4,
        'register_meta_box_cb' => 'add_slide_metaboxes'
    ));
}

//Adicionar o link para o slider
function add_slide_metaboxes () {
    add_meta_box( 'link', 'Link para o produto', 'link', 'slider', 'default', 'normal' );
}


function linkParaProduto() {
    global $post;
    echo '<input type="hidden" name="linkmeta_noncename" id="linkmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    $link = get_post_meta($post->ID, '_link', true);
    echo '<input type="text" name="_link" value="' . $link  . '" class="widefat" />';
}

function produtos()
{
    register_taxonomy_for_object_type('category', 'produtos'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'produtos');
    register_post_type('produtos', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Produtos', 'produtos'), // Rename these to suit
            'singular_name' => __('Produto', 'produtos'),
            'add_new' => __('Adicionar novo', 'produtos'),
            'add_new_item' => __('Adicionar novo produto', 'produtos'),
            'edit' => __('Editar', 'produtos'),
            'edit_item' => __('Editar produto', 'produtos'),
            'new_item' => __('Novo produto', 'produtos'),
            'view' => __('Ver produto', 'produtos'),
            'view_item' => __('Ver produto', 'produtos'),
            'search_items' => __('Procurar produto', 'produtos'),
            'not_found' => __('Nenhum produto encontrado', 'produtos'),
            'not_found_in_trash' => __('Nenhum produto encontrado no lixo. Evitamos desperdício.', 'produtos')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'category'
        ) // Add Category and Post Tags support
    ));
}

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
  if(is_category() || is_tag()) {
    $post_type = get_query_var('post_type');
    if($post_type)
        $post_type = $post_type;
    else
        $post_type = array('post','produtos'); // replace cpt to your custom post type
    $query->set('post_type',$post_type);
    return $query;
    }
}

function noticias()
{
    register_taxonomy_for_object_type('category', 'noticias'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'noticias');
    register_post_type('noticias', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Notícias', 'noticias'), // Rename these to suit
            'singular_name' => __('Notícia', 'noticias'),
            'add_new' => __('Adicionar nova', 'noticias'),
            'add_new_item' => __('Adicionar nova notícia', 'noticias'),
            'edit' => __('Editar', 'noticias'),
            'edit_item' => __('Editar notícia', 'noticias'),
            'new_item' => __('Nova notícia', 'noticias'),
            'view' => __('Ver notícia', 'noticias'),
            'view_item' => __('Ver notícia', 'noticias'),
            'search_items' => __('Procurar notícia', 'noticias'),
            'not_found' => __('Nenhuma notícia encontrada', 'noticias'),
            'not_found_in_trash' => __('Nenhuma notícia encontrada no lixo.', 'noticias')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'menu_position' => 6,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true // Allows export in Tools > Export
    ));
}

function locais()
{
    register_taxonomy_for_object_type('category', 'locais'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'locais');
    register_post_type('locais', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('Locais', 'locais'), // Rename these to suit
            'singular_name' => __('Endereço', 'locais'),
            'add_new' => __('Adicionar novo', 'locais'),
            'add_new_item' => __('Adicionar novo endereço', 'locais'),
            'edit' => __('Editar', 'locais'),
            'edit_item' => __('Editar endereço', 'locais'),
            'new_item' => __('Novo endereço', 'locais'),
            'view' => __('Ver endereço', 'locais'),
            'view_item' => __('Ver endereço', 'locais'),
            'search_items' => __('Procurar endereço', 'locais'),
            'not_found' => __('Nenhum endereço encontrado', 'locais'),
            'not_found_in_trash' => __('Nenhum endereço encontrado no lixo.', 'locais')
        ),
        'public' => true,
        'hierarchical' => false, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'thumbnail',
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}

add_action('admin_menu','remove_default_post_type');

function remove_default_post_type() {
    remove_menu_page('edit.php');
}


//AJAX

function pegarSabor(){
  //pegar os dados com o ajax()
   $pegou = $_POST['pegou '];
   $results = "<h2>".$pegou."</h2>";
  // Retornar a String
   die($results);
  }
  // Criando chamada ajax para WordPress
   add_action( 'wp_ajax_nopriv_ pegarSabor', 'pegarSabor' );
   add_action( 'wp_ajax_ pegarSabor', 'pegarSabor' );

/*------------------------------------*\
    ShortCode Functions
\*------------------------------------*/

?>
