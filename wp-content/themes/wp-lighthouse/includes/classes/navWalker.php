<?php
// bootstrap 5 wp_nav_menu walker
class wp_lighthouse_nav_menu_walker extends Walker_Nav_menu {
  
	private $current_item;

  	function start_lvl(&$output, $depth = 0, $args = array()) {
		
		$output .= "<ul role=\"menu\" class=\"dropdown\">";
  	}

  	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    
		$this->current_item = $item;

    	$li_attributes = '';
    	$class_names = '';

    	$classes = empty($item->classes) ? array() : (array) $item->classes;

    	$classes[] = ($args->walker->has_children) ? 'caret-menu' : '';

    	$class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    	$class_names = ' class="' . esc_attr($class_names) . '"';

    	$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    	$id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

		if( $depth > 0 && $item->title == "---" ) {

			$output .= '<li class="divider">';
		}
		else {
    	
			$output .= '<li role="menuitem"' . $id . $class_names . $li_attributes . '>';
		}

    	$attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    	$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    	$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    	$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    	$active_class = ($item->current || $item->current_item_ancestor) ? ' active' : '';
    	$attributes .= ($args->walker->has_children) ? ' class="submenu' . $active_class . '"' : (!empty($active_class) ? ' class="' . $active_class . '"' : '');

		$item_output = '';

		if( $item->title != "---" ) {

			$item_output = $args->before;

			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$item_output .= '</a>';
    	
    		$item_output .= $args->after;
		}

    	$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  	}
}