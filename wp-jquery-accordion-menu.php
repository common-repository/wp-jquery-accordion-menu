<?php
/*
Plugin Name: WP JQuery Accordion Menu
Plugin URI: http://tuncay.demirtepe.com/wordpress-plugin-wp-jquery-accordion-menu/
Description: Creates vertical accordion menu with wp_list_pages function using jQuery. Add menu using shortcodes.
Version: 1.2.1
Author: Tuncay Demirtepe
Author URI: http://tuncay.demirtepe.com
*/
define(GET_MENU_WIDGET_ID, "widget_get_menu");  

function get_menu($ul_id, $ul_class, $sort_column="", $sort_order="", $exclude="", $exclude_tree="", $include="", $depth="", $child_of="", $show_date="", $date_format="", $title_li="", $meta_key="", $meta_value="", $link_before="", $link_after="", $authors="", $number="", $offset="", $extra_code=""){
	echo '<ul id="'.$ul_id.'"';
	if ($ul_class != ""){
		echo ' class="'.$ul_class.'"';
	}
	echo '>';
	wp_list_pages('sort_column='.$sort_column.'&sort_order='.$sort_order.'&exclude='.$exclude.'&exclude_tree='.$exclude_tree.'&include='.$include.'&depth='.$depth.'&child_of='.$child_of.'&show_date='.$show_date.'&date_format='.$date_format.'&title_li='.$title_li.'&meta_key='.$meta_key.'&meta_value='.$meta_value.'&link_before='.$link_before.'&link_after='.$link_after.'&authors='.$authors.'&number='.$number.'&offset='.$offset);
	echo '</ul>';
	echo '<script>
		jQuery().ready(function() {
			jQuery("#'.$ul_id.' > li.page_item > a").addClass("expand");
			jQuery("#'.$ul_id.' a.expand").mouseover(function(){
				 var chld = jQuery(this).next("ul.children");
				 chld.slideDown(500);
				 jQuery("ul.children").not(chld).slideUp("slow");
			});
			jQuery("ul.children").mouseleave(function(){
				jQuery(this).slideUp("slow");
			});
			'.$extra_code.'
		});
	</script>';
}

function get_menu_head(){
	$options = get_option(GET_MENU_WIDGET_ID);  
	$ul_id = $options['ul_id'];
	
	echo '<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>';
	echo '
	<style type="text/css">
		ul#'.$ul_id.', ul#'.$ul_id.' ul.children {
			list-style-type : none;
		}
		ul#'.$ul_id.' a{
			font-weight : bold;
			display : block;
			text-decoration : none;
			font-size: 15px;
		}
		ul#'.$ul_id.' li {
			margin-bottom : 5px;
			margin-left : 0;
		}
		ul#'.$ul_id.' a:hover, ul#'.$ul_id.' a:focus, ul#'.$ul_id.' a:active {
		
		}
		ul#'.$ul_id.' li.current_page_item a, ul#'.$ul_id.' li.current_page_ancestor a {
		}
		ul#'.$ul_id.' li.current_page_ancestor ul.children, ul#'.$ul_id.' li.current_page_item ul.children{
			display: block !important;
		}
		ul#'.$ul_id.' ul.children{
			display: none;
		}
		ul#'.$ul_id.' ul.children li a{
			font-size: 13px !important;
			font-weight: normal;
			padding-left: 10px;
		}
		ul#'.$ul_id.' li.current_page_ancestor ul.children li.current_page_item a, ul#'.$ul_id.' ul.children li a:hover{
		
		}
	</style>';
}

function widget_get_menu($args) {
	extract($args, EXTR_SKIP);  
	$options = get_option(GET_MENU_WIDGET_ID);  

	$ul_id = $options['ul_id'];
	$ul_class = $options['ul_class'];
	$sort_column = $options['sort_column'];
	$sort_order = $options['sort_order'];
	$exclude = $options['exclude'];
	$exclude_tree = $options['exclude_tree'];
	$include = $options['include'];
	$depth = $options['depth'];
	$child_of = $options['child_of'];
	$show_date = $options['show_date'];
	$date_format = $options['date_format'];
	$title_li = $options['title_li'];
	$meta_key = $options['meta_key'];
	$meta_value = $options['meta_value'];
	$link_before = $options['link_before'];
	$link_after = $options['link_after'];
	$authors = $options['authors'];
	$number = $options['number'];
	$offset = $options['offset'];
	$extra_code = $options['extra_code'];
  
	echo $before_widget;
	get_menu($ul_id, $ul_class, $sort_column, $sort_order, $exclude, $exclude_tree, $include, $depth, $child_of, $show_date, $date_format, $title_li, $meta_key, $meta_value, $link_before, $link_after, $authors, $number, $offset, $extra_code);
	echo $after_widget;
}

function widget_get_menu_init() {
  wp_register_sidebar_widget(GET_MENU_WIDGET_ID,
  	__('WP JQuery Accordion Menu'), 'widget_get_menu');
}

function widget_get_menu_control() {
  $options = get_option(GET_MENU_WIDGET_ID);
  if (!is_array($options)) {
    $options = array();
  }

  $widget_data = $_POST[GET_MENU_WIDGET_ID];
  if (isset($_POST['widget-id'])){
	$options['ul_id'] = $widget_data['ul_id'];
	$options['ul_class'] = $widget_data['ul_class'];
	$options['sort_column'] = $widget_data['sort_column'];
	$options['sort_order'] = $widget_data['sort_order'];
	$options['exclude'] = $widget_data['exclude'];
	$options['exclude_tree'] = $widget_data['exclude_tree'];
	$options['include'] = $widget_data['include'];
	$options['depth'] = $widget_data['depth'];
	$options['child_of'] = $widget_data['child_of'];
	$options['show_date'] = $widget_data['show_date'];
	$options['date_format'] = $widget_data['date_format'];
	$options['title_li'] = $widget_data['title_li'];
	$options['meta_key'] = $widget_data['meta_key'];
	$options['meta_value'] = $widget_data['meta_value'];
	$options['link_before'] = $widget_data['link_before'];
	$options['link_after'] = $widget_data['link_after'];
	$options['authors'] = $widget_data['authors'];
	$options['number'] = $widget_data['number'];
	$options['offset'] = $widget_data['offset'];
	$options['extra_code'] = $widget_data['extra_code'];

	update_option(GET_MENU_WIDGET_ID, $options);
  }
	$ul_id = $options['ul_id']; if ($ul_id == ""){ $ul_id = "nav"; }
	$ul_class = $options['ul_class'];
	$sort_column = $options['sort_column'];
	$sort_order = $options['sort_order'];
	$exclude = $options['exclude'];
	$exclude_tree = $options['exclude_tree'];
	$include = $options['include'];
	$depth = $options['depth'];
	$child_of = $options['child_of'];
	$show_date = $options['show_date'];
	$date_format = $options['date_format'];
	$title_li = $options['title_li'];
	$meta_key = $options['meta_key'];
	$meta_value = $options['meta_value'];
	$link_before = $options['link_before'];
	$link_after = $options['link_after'];
	$authors = $options['authors'];
	$number = $options['number'];
	$offset = $options['offset'];
	$extra_code = $options['extra_code'];
	// Render form
  ?>
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-ul_id">ID for container UL</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[ul_id]" id="<?php echo GET_MENU_WIDGET_ID; ?>-ul_id" value="<?php echo $ul_id; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-ul_class">CSS class for container UL</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[ul_class]" id="<?php echo GET_MENU_WIDGET_ID; ?>-ul_class" value="<?php echo $ul_class; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-sort_column">Sort column:</label>
	<select class="widefat" name="<?php echo GET_MENU_WIDGET_ID; ?>[sort_column]" id="<?php echo GET_MENU_WIDGET_ID; ?>-sort_column">
		<option <?php if ($sort_column == 'post_title'){ echo 'selected'; } ?> value="post_title">post_title: Sort Pages alphabetically (by title)</option>
		<option <?php if ($sort_column == 'menu_order'){ echo 'selected'; } ?> value="menu_order">menu_order: Sort Pages by Page Order</option>
		<option <?php if ($sort_column == 'post_date'){ echo 'selected'; } ?> value="post_date">post_date: Sort by creation time</option>
		<option <?php if ($sort_column == 'post_modified'){ echo 'selected'; } ?> value="post_modified">post_modified: Sort by time last modified</option>
		<option <?php if ($sort_column == 'ID'){ echo 'selected'; } ?> value="ID">ID: Sort by numeric Page ID</option>
		<option <?php if ($sort_column == 'post_author'){ echo 'selected'; } ?> value="post_author">post_author: Sort by the Page author's numeric ID</option>
		<option <?php if ($sort_column == 'post_name'){ echo 'selected'; } ?> value="post_name">post_name: Sort alphabetically by Page slug</option>
	</select><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-sort_order">Sort order:</label>
	<select class="widefat" name="<?php echo GET_MENU_WIDGET_ID; ?>[sort_order]" id="<?php echo GET_MENU_WIDGET_ID; ?>-sort_order">
		<option <?php if ($sort_order == 'ASC'){ echo 'selected'; } ?> value="ASC">ASC: Sort from lowest to highest</option>
		<option <?php if ($sort_order == 'DESC'){ echo 'selected'; } ?> value="DESC">DESC: Sort from highest to lowest</option>
	</select><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-exclude">Exclude</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[exclude]" id="<?php echo GET_MENU_WIDGET_ID; ?>-exclude" value="<?php echo $exclude; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-exclude_tree">Exclude tree</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[exclude_tree]" id="<?php echo GET_MENU_WIDGET_ID; ?>-exclude_tree" value="<?php echo $exclude_tree; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-include">Include</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[include]" id="<?php echo GET_MENU_WIDGET_ID; ?>-include" value="<?php echo $include; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-depth">Depth</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[depth]" id="<?php echo GET_MENU_WIDGET_ID; ?>-depth" value="<?php echo $depth; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-child_of">Child of</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[child_of]" id="<?php echo GET_MENU_WIDGET_ID; ?>-child_of" value="<?php echo $child_of; ?>"/><br /><br />

	<label for="<?php echo GET_MENU_WIDGET_ID;?>-show_date">Show date</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[show_date]" id="<?php echo GET_MENU_WIDGET_ID; ?>-show_date" value="<?php echo $show_date; ?>"/><br /><br />

	<label for="<?php echo GET_MENU_WIDGET_ID;?>-date_format">Date format</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[date_format]" id="<?php echo GET_MENU_WIDGET_ID; ?>-date_format" value="<?php echo $date_format; ?>"/><br /><br />

	<label for="<?php echo GET_MENU_WIDGET_ID;?>-title_li">Title LI</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[title_li]" id="<?php echo GET_MENU_WIDGET_ID; ?>-title_li" value="<?php echo $title_li; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-meta_key">Meta key</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[meta_key]" id="<?php echo GET_MENU_WIDGET_ID; ?>-meta_key" value="<?php echo $meta_key; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-meta_value">Meta value</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[meta_value]" id="<?php echo GET_MENU_WIDGET_ID; ?>-meta_value" value="<?php echo $meta_value; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-link_before">Link before</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[link_before]" id="<?php echo GET_MENU_WIDGET_ID; ?>-link_before" value="<?php echo $link_before; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-link_after">Link after</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[link_after]" id="<?php echo GET_MENU_WIDGET_ID; ?>-link_after" value="<?php echo $link_after; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-authors">Authors</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[authors]" id="<?php echo GET_MENU_WIDGET_ID; ?>-authors" value="<?php echo $authors; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-number">Number</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[number]" id="<?php echo GET_MENU_WIDGET_ID; ?>-number" value="<?php echo $number; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-offset">Offset</label>
	<input class="widefat" type="text" name="<?php echo GET_MENU_WIDGET_ID; ?>[offset]" id="<?php echo GET_MENU_WIDGET_ID; ?>-offset" value="<?php echo $offset; ?>"/><br /><br />
	
	<label for="<?php echo GET_MENU_WIDGET_ID;?>-extra_code">Extra code</label>
	<textarea class="widefat" name="<?php echo GET_MENU_WIDGET_ID; ?>[extra_code]" id="<?php echo GET_MENU_WIDGET_ID; ?>-extra_code"><?php echo $extra_code; ?></textarea><br /><br />
  <?php
}

// Register widget to WordPress
add_action('wp_head', 'get_menu_head');
add_action("plugins_loaded", "widget_get_menu_init");
wp_register_widget_control(GET_MENU_WIDGET_ID, ('Coming Next'), 'widget_get_menu_control');  
?>
