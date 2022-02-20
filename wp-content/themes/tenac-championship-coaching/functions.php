<?php


function add_favicon()
{ ?>
  <link rel="shortcut icon" href="/wp-content/themes/tenac-championship-coaching/images/512xStar-1-100x100.png">
<?php }

add_action('wp_head', 'add_favicon');

function pageBanner($args = NULL)
{

  if (!$args['title']) {
    $args['title'] = get_the_title();
  }

  if (!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_subtitle');
  }

  if (!$args['photo']) {
    if (get_field('page_banner_background_image') and !is_archive() and !is_home()) {
      $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
    } else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  }

?>
  <div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title <?php if (is_page('be-a-champion')) echo "beachampion"; ?>">
        <?php echo $args['title'] ?></h1>
      <div class="page-banner__intro">
        <p><?php echo $args['subtitle']; ?></p>
      </div>
    </div>
  </div>
<?php }

function tenac_files()
{
  wp_enqueue_script('main-tenac-js', get_theme_file_uri('/build/index.js'), array('jquery'), '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('tenac_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('tenac_extra_styles', get_theme_file_uri('/build/index.css'));



  wp_localize_script('main-tenac-js', 'tenacData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));
}

add_action('wp_enqueue_scripts', 'tenac_files');

function tenac_features()
{
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'tenac_features');

function tenac_adjust_queries($query)
{
  if (!is_admin() and is_post_type_archive('event') and $query->is_main_query()) {
    $today = date('Ymd');
    $query->set('meta_key', 'event_date');
    $query->set('orderby', 'meta_value_num');
    $query->set('order', 'ASC');
    $query->set('meta_query', array(
      array(
        'key' => 'event_date',
        'compare' => '>=',
        'value' => $today,
        'type' => 'numeric'
      )
    ));
  }
}

add_action('pre_get_posts', 'tenac_adjust_queries');

// Function to delete capabilities excellent for keeping Members clean
// https://wordpress.org/support/topic/how-to-delete-custom-capability/
// Based on http://chrisburbridge.com/delete-unwanted-wordpress-custom-capabilities/
// function trim_caps()
// {
//   global $wp_roles;
//   $delete_caps = array(
//     'delete_campuss',
//     'delete_notes',
//     'delete_others_campuss',
//     'delete_others_notes',
//     'delete_private_campuss',
//     'delete_private_notes',
//     'delete_published_campuss',
//     'delete_published_notes',
//     'edit_campuss',
//     'edit_notes',
//     'edit_others_campuss',
//     'edit_others_notes',
//     'edit_private_campuss',
//     'edit_private_notes',
//     'edit_published_campuss',
//     'edit_published_notes',
//     'loco_admin',
//     'publish_campuss',
//     'publish_notes',
//     'read_private_campuss',
//     'read_private_notes'
//   );
//   foreach ($delete_caps as $cap) {
//     foreach (array_keys($wp_roles->roles) as $role) {
//       $wp_roles->remove_cap($role, $cap);
//     }
//   }
// }
// add_action('admin_init', 'trim_caps');


// Redirect subscriber accounts out of admin and onto homepage
add_action('admin_init', 'redirectSubsToFrontend');

function redirectSubsToFrontend()
{
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
    wp_redirect(site_url('/'));
    exit;
  }
}

add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
  $ourCurrentUser = wp_get_current_user();

  if (count($ourCurrentUser->roles) == 1 and $ourCurrentUser->roles[0] == 'subscriber') {
    show_admin_bar(false);
  }
}

// Customize Login Screen
add_filter('login_headerurl', 'ourHeaderUrl');

function ourHeaderUrl()
{
  return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCSS');

function ourLoginCSS()
{
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('tenac_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('tenac_extra_styles', get_theme_file_uri('/build/index.css'));
}

add_filter('login_headertext', 'ourLoginTitle');

function ourLoginTitle()
{
  return get_bloginfo('name');
}


add_filter('ai1wm_exclude_content_from_export', function ($exclude_filters) {
  $exclude_filters[] = 'wp-content/themes/tenac-championship-coaching/node_modules';
  return $exclude_filters;
});

/*****************************************
 * Woocommerce edits
 */ ///////////////////////////////////////

//Remove WooCommerce Tabs - this code removes all 3 tabs - to be more specific just remove actual unset lines 
add_filter('woocommerce_product_tabs', 'woo_remove_product_tabs', 98);

function woo_remove_product_tabs($tabs)
{

  unset($tabs['description']);        // Remove the description tab
  unset($tabs['reviews']);       // Remove the reviews tab
  unset($tabs['additional_information']);    // Remove the additional information tab

  return $tabs;
}

//* Remove related products output
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);

// Remove the product category
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

// https://stackoverflow.com/questions/23943791/add-custom-css-class-to-woocommerce-checkout-fields
//add_filter('woocommerce_checkout_fields', 'addBootstrapToCheckoutFields');
//function addBootstrapToCheckoutFields($fields)
//{
//  foreach ($fields as &$fieldset) {
//    foreach ($fieldset as &$field) {
//      // if you want to add the form-group class around the label and the input
//      $field['class'][] = 'form-group';
//
//      // add form-control to the actual input
//      $field['input_class'][] = 'form-control';
//    }
//  }
//  return $fields;
//}

// https://cinchws.com/change-choose-an-option-variation-dropdown-label-in-woocommerce/
add_filter('woocommerce_dropdown_variation_attribute_options_args', 'herbold_filter_dropdown_args', 10);

function herbold_filter_dropdown_args($args)
{
  $args['show_option_none'] = 'Select your coach';
  return $args;
}

function mytheme_add_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );