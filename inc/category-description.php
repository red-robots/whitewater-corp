<?php
// lets remove the html filtering
remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );

// add extra css to display quicktags correctly
add_action( 'admin_print_styles', 'categorytinymce_admin_head' );
function categorytinymce_admin_head() { 
  global $current_screen;
  if ( $current_screen->id == 'edit-category' OR 'edit-tag' ) { ?>
  <style type="text/css">
  .quicktags-toolbar input{float:left !important; width:auto !important;}
  </style>
  <?php   } 
}

    
// lets add our new cat description box 
define('description1', 'Category_Description_option');
add_filter('edit_category_form_fields', 'description1');
function description1($tag) {
  $tag_extra_fields = get_option("description1"); ?>
  <table class="form-table">
    <tr class="form-field">
      <th scope="row" valign="top"><label for="description"><?php _e('Description', 'categorytinymce'); ?></label></th>
      <td>
      <?php  
      $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' ); 
      wp_editor(html_entity_decode($tag->description , ENT_QUOTES, 'UTF-8'), 'description1', $settings); ?>   
      <br />
      <span class="description"><?php _e('The description is not prominent by default, however some themes may show it.', 'categorytinymce'); ?></span>
      </td>   
    </tr>
  </table>
<?php }

//add extra fields to category edit form hook
add_action ( 'edit_category_form_fields', 'extra_category_fields');
//add extra fields to category edit form callback function
function extra_category_fields( $tag ) {    //check for existing featured ID
  $t_id = $tag->term_id;
  $cat_meta = get_option( "category_$t_id"); ?>
  <table class="form-table">
  <tr></tr>
  <?php $catseo = get_option('catMCE_seo');
  if ($catseo == "1") { ?>
  <tr class="form-field">
  <th scope="row" valign="top"><label for="seo_met_title"><?php _e('SEO Meta Title', 'categorytinymce'); ?></label></th>
  <td>
  <input type="text" name="Cat_meta[seo_met_title]" id="Cat_meta[seo_met_title]" size="3" style="width:60%;" value="<?php echo $cat_meta['seo_met_title'] ? $cat_meta['seo_met_title'] : ''; ?>"><br />
  <span class="description"><?php _e('Add title for head section. recommended 60 characters max', 'categorytinymce'); ?></span>
  </td>
  </tr>

  <tr></tr>
  <tr class="form-field">
  <th scope="row" valign="top"><label for="seo_met_keywords"><?php _e('SEO Meta Keywords', 'categorytinymce'); ?></label></th>
  <td>
  <input type="text" name="Cat_meta[seo_met_keywords]" id="Cat_meta[seo_met_keywords]" size="3" style="width:60%;" value="<?php echo $cat_meta['seo_met_keywords'] ? $cat_meta['seo_met_keywords'] : ''; ?>"><br />
  <span class="description"><?php _e('Add keywords for head section. separate with commas', 'categorytinymce'); ?></span>
  </td>
  </tr>

  <tr></tr>
  <tr class="form-field">
  <th scope="row" valign="top"><label for="seo_met_description"><?php _e('SEO Meta Description', 'categorytinymce'); ?></label></th>
  <td>
  <textarea rows="4" name="Cat_meta[seo_met_description]" id="Cat_meta[seo_met_description]" size="3" style="width:60%;" ><?php echo $cat_meta['seo_met_description'] ? $cat_meta['seo_met_description'] : ''; ?></textarea><br />
  <span class="description"><?php _e('Add description for head section. recommended 140 characters max', 'categorytinymce'); ?></span>
  </td>
  </tr>
  <?php } ?>

  </table>
<?php
}



// save extra category extra fields hook
add_action ( 'edited_category', 'save_extra_category_fileds');
   // save extra category extra fields callback function
function save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys ($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] =stripslashes_deep($_POST['Cat_meta'][$key]);
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}






// lets add our new tag description box 
define('description2', 'Tag_Description_option');
add_filter('edit_tag_form_fields', 'description2');
function description2($tag) {
  $tag_extra_fields = get_option("description1"); ?>
  <table class="form-table">
  <tr class="form-field">
  <th scope="row" valign="top"><label for="description"><?php _ex('Description', 'categorytinymce'); ?></label></th>
  <td>
  <?php  
  $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' ); 
  wp_editor(html_entity_decode($tag->description , ENT_QUOTES, 'UTF-8'), 'description2', $settings ); ?>  
  <br />
  <span class="description"><?php _e('The description is not prominent by default, however some themes may show it.', 'categorytinymce'); ?></span>
  </td>   
  </tr>
  </table>
<?php }

//add extra fields to tag edit form hook
add_action ( 'edit_tag_form_fields', 'extra_tag_fields');
//add extra fields to category edit form callback function
function extra_tag_fields( $tag ) {    //check for existing featured ID
  $t_id = $tag->term_id;
  $tag_meta = get_option( "tag_$t_id"); ?>
  <table class="form-table">
    <tr></tr>
    <?php $catseo = get_option('catMCE_seo');
    if ($catseo == "1") { ?>
    <tr></tr>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="seo_met_keywords"><?php _e('SEO Meta Keywords', 'categorytinymce'); ?></label></th>
    <td>
    <input type="text" name="tag_meta[seo_met_keywords]" id="tag_meta[seo_met_keywords]" size="3" style="width:60%;" value="<?php echo $tag_meta['seo_met_keywords'] ? $tag_meta['seo_met_keywords'] : ''; ?>"><br />
    <span class="description"><?php _e('Add keywords for head section. separate with commas', 'categorytinymce'); ?></span>
    </td>
    </tr>

    <tr></tr>
    <tr class="form-field">
    <th scope="row" valign="top"><label for="seo_met_description"><?php _e('SEO Meta Description', 'categorytinymce'); ?></label></th>
    <td>
    <textarea rows="4" name="tag_meta[seo_met_description]" id="tag_meta[seo_met_description]" size="3" style="width:60%;" ><?php echo $tag_meta['seo_met_description'] ? $tag_meta['seo_met_description'] : ''; ?></textarea><br />
    <span class="description"><?php _e('Add description for head section. recommended 140 characters max', 'categorytinymce'); ?></span>
    </td>
    </tr>
  </table>
  <?php } 
}



// save extra tag extra fields hook
add_action ( 'edited_terms', 'save_extra_tag_fileds');
   // save extra tag extra fields callback function
function save_extra_tag_fileds( $term_id ) {
    if ( isset( $_POST['tag_meta'] ) ) {
        $t_id = $term_id;
        $tag_meta = get_option( "tag_$t_id");
        $tag_keys = array_keys ($_POST['tag_meta']);
            foreach ($tag_keys as $key){
            if (isset($_POST['tag_meta'][$key])){
                $tag_meta[$key] =stripslashes_deep($_POST['tag_meta'][$key]);
            }
        }
        //save the option array
        update_option( "tag_$t_id", $tag_meta );
    }
}


// lets add the tag meta to category head

$catseo = get_option('catMCE_seo');
if ($catseo == "1") {
function add_tagseo_meta()
 {  
  if ( is_category() ) {
 
$cat_id = get_query_var('cat');
$queried_object = get_queried_object();
$term_id = $queried_object->term_id;
$cat_data = get_option("category_$term_id");
if (isset($cat_data['seo_met_description'])){           
 
 ?>
          <meta name="description" content="<?php echo $cat_data['seo_met_description']; ?>">
       
<?php
      }  


if (isset($cat_data['seo_met_keywords'])){           
 
 ?>
          <meta name="keywords" content="<?php echo $cat_data['seo_met_keywords']; ?>">
       
<?php
      }  





      }
 elseif ( is_tag() ) {
 
$tag_id = get_query_var('tag');

$queried_object = get_queried_object();
$term_id = $queried_object->term_id;

$tag_data = get_option("tag_$term_id");

    if (isset($tag_data['seo_met_description'])){     
 
 ?>
          <meta name="description" content="<?php echo $tag_data['seo_met_description'] ?>">
       
<?php
 
}
if (isset($tag_data['seo_met_keywords'])){           
 
 ?>
          <meta name="keywords" content="<?php echo $tag_data['seo_met_keywords']; ?>">
       
<?php
      }  





      }   }
    
add_action('wp_head', 'add_tagseo_meta');


function add_tag_title()
 {  
  if (is_category()){
 $cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id");
 
 if (isset($cat_data['seo_met_title'])){  

 $title = $cat_data['seo_met_title']; 
 
return $title;

      }
      else{
      $current_category = single_cat_title("", false); 
    $title = $current_category .' | ' . get_bloginfo( "name", "display" ); 

      return $title;
      }
}
 elseif (is_tag()){
$tag_id = get_query_var('tag');

$queried_object = get_queried_object();
$term_id = $queried_object->term_id;

$tag_data = get_option("tag_$term_id");
 
 if (isset($tag_data['seo_met_title'])){  

 $title = $tag_data['seo_met_title']; 
 
return $title;

      }
      else{
      $current_tag = single_tag_title("", false); 
    $title = $current_tag .' | ' . get_bloginfo( "name", "display" ); 

      return $title;
      }
}
elseif (is_home() || is_front_page() )
{
$title = get_bloginfo( "name", "display" ) .' | ' . get_bloginfo( "description", "display" ); 

      return $title;

}

else {
$title =  get_the_title() . ' | ' . get_bloginfo( "name", "display" );
 return $title;
}
 
 }

 add_filter( 'wp_title', 'add_tag_title', 1000 );
}
 
      



add_filter('term_description', 'do_shortcode');
// when a category is removed delete the new box

add_filter('deleted_term_taxonomy', 'remove_Category_Extras');
function remove_Category_Extras($term_id) {
  if($_POST['taxonomy'] == 'category'):
    $tag_extra_fields = get_option(Category_Extras);
    unset($tag_extra_fields[$term_id]);
    update_option(Category_Extras, $tag_extra_fields);
  endif;
}

// quick jquery to hide the default cat description box

function hide_category_description() {
      $screen = get_current_screen();
if ( $screen->id == 'edit-category' ) { 
?>
<script type="text/javascript">
jQuery(function($) {
 $('#wp-description-wrap').hide();
 }); 
 </script> <?php
 } 
      } 
      
      // quick jquery to hide the default tag description box

function hide_tag_description() {
           $screen = get_current_screen();
if ( $screen->base == 'term' ) {
?>
<script type="text/javascript">
jQuery(function($) {
 $('.term-description-wrap').hide();
 }); 
 </script> <?php
 } 
      } 
      
// lets hide the cat description from the category admin page

add_action('admin_head', 'hide_category_description'); 
add_action('admin_head', 'hide_tag_description'); 


// Shortcodes for cat and tag image menu
if (!is_admin()){
    
    
function catimmg($atts) {
    ob_start();
    
    $catvalue = shortcode_atts( array(
        'number' => -1,
        'categories' => '',
    ), $atts );

 ?>
<div class="catimmgmain">
<?php
$categories = get_categories();


$catopts = $catvalue['categories'];
$catcount = $catvalue['number'];
if($catopts =='' ) {


$cvd= 0;
foreach($categories as $category) {
if($cvd==$catcount) break;  
    

$cat_id = $category->term_id;
$cat_data = get_option("category_$cat_id");

    
    ?>
    <div class="catimmgeach" id="catimmgchild" align="center">
<a href="<?php echo get_category_link($category->term_id); ?>"> <?php 
    
    if (isset($cat_data['img'])){ 
    

echo '<img src="'.$cat_data['img'].'" alt="'.$category->cat_name.'">';
}
    ?>
    
    <?php echo $category->name; ?></a>

    
    </div>

 <?php  
$cvd++;
  }
   
   
?>
</div>
<?php
}
else { 
$args = array(  
   
    'include'                  =>$catvalue['categories'] // desire id
); 

$categories = get_categories($args );

$cvd= 0;

foreach($categories as $category) {
    

    
if($cvd==$catcount) break;  
    

$cat_id = $category->term_id;
$cat_data = get_option("category_$cat_id");

    
    ?>
    <div class="catimmgeach" id="catimmgchild" align="center">
<a href="<?php echo get_category_link($category->term_id); ?>"> <?php 
    
    if (isset($cat_data['img'])){ 
    

echo '<img src="'.$cat_data['img'].'" alt="'.$category->cat_name.'">';
}
    ?>
    
    <?php echo $category->name; ?></a>

    
    </div>

 <?php 


 
$cvd++;
  }
   
   
?>
</div>

<?php

}
    


return ob_get_clean();
}

add_shortcode( 'catimmg', 'catimmg' );
}

/////////////////// og meta
function add_ogmeta_tags() {
        


      if ( is_category()) {
          
                $cat_id = get_query_var('cat');
$cat_data = get_option("category_$cat_id");  

if (isset($cat_data['ogimg'])){ 
 ?>
           <meta property="og:image" content="<?php echo $cat_data['ogimg']; ?>">
       
<?php
      }  
      }
      
     $all_plugins = apply_filters('active_plugins', get_option('active_plugins'));
if (stripos(implode($all_plugins), 'woocommerce.php')) {


      if ( is_product_category()) {
          
        $tag_id = get_queried_object()->term_id;
$tag_data = get_option("tag_$tag_id");   

if (isset($tag_data['tag_ogimg'])){ 
 ?>
           <meta property="og:image" content="<?php echo $tag_data['tag_ogimg']; ?>">
       
<?php
      }  
      }
} 

}

add_action('wp_head', 'add_ogmeta_tags');

/* Remove `Description` from the category list column */
$taxonomies = array('category','post_tag','instruction_type');
foreach($taxonomies as $tax) {
  add_filter('manage_edit-'.$tax.'_columns', function ( $columns ) {
    if( isset( $columns['description'] ) )
        unset( $columns['description'] );   
    return $columns;
  });
}

add_action('admin_head', 'post_types_custom_admin_css');
function post_types_custom_admin_css() { ?>
<style type="text/css">
  .form-field.term-description-wrap{display:none!important;}
</style>
<?php }


/* Add column to category list */
function manage_instruction_type_columns($columns) {
  if( isset( $columns['slug'] ) )
        unset($columns['slug']);
  if( isset( $columns['posts'] ) )
        unset($columns['posts']);
  $columns['category_image'] = 'Image';
  $columns['slug'] = __( 'Slug', 'bellaworks' );
  $columns['posts'] = __( 'Count', 'bellaworks' );
  return $columns;
}
add_filter('manage_edit-instruction_type_columns','manage_instruction_type_columns');

function manage_instruction_type_custom_fields($deprecated,$column_name,$term_id) {
  if ($column_name == 'category_image') { 
    $taxonomy = 'instruction_type';
    $img = get_field("category_image",$taxonomy.'_'.$term_id);
    $no_image = get_bloginfo('template_url') . '/images/not-available.jpg';
    $thumb = '';
    if($img) {
      $thumb = '<span style="display:inline-block;background-image:url('.$img['url'].');background-size:cover;background-position:center;">';
      $thumb .= '<img src="'.$no_image.'" alt="" style="visibility:hidden;width:45px;height:auto">';
      $thumb .= '</span>';
    } else {
      $thumb = '<img src="'.$no_image.'" alt="" style="width:45px;height:auto">';
    }
    echo $thumb;
  }
}
add_filter ('manage_instruction_type_custom_column', 'manage_instruction_type_custom_fields', 10,3);



?>