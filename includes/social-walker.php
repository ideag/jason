<?php

class Jason_Social_Walker extends Walker_Nav_Menu {
  private static function _detect( $url ) {
    if ( 0 === strpos( $url, 'mailto:' ) ) {
      return 'email';
    }
    if ( 0 === strpos( $url, 'http://twitter.com' ) ) {
      return 'twitter';
    }
    if ( 0 === strpos( $url, 'https://twitter.com' ) ) {
      return 'twitter';
    }
    if ( 0 === strpos( $url, 'http://medium.com' ) ) {
      return 'medium';
    }
    if ( 0 === strpos( $url, 'https://medium.com' ) ) {
      return 'medium';
    }
    if ( 0 === strpos( $url, 'http://instagram.com' ) ) {
      return 'instagram';
    }
    if ( 0 === strpos( $url, 'https://instagram.com' ) ) {
      return 'instagram';
    }
    if ( 0 === strpos( $url, 'http://dribbble.com' ) ) {
      return 'dribbble';
    }
    if ( 0 === strpos( $url, 'https://dribbble.com' ) ) {
      return 'dribbble';
    }
    return 'link';
  }
	public function __construct() {
	}
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		// The CSS class for our menu.
		$class = $this -> css_class;
		$item_class = strtolower( __CLASS__ ) . '-item';
		// The html that this method will append to the menu.
		$item_output = '';
		// Grab the class names for the menu item.
		$classes = $item -> classes;
    $classes[] = 'icon';
    $classes[] = self::_detect( $item->url );
		// Add our class for this method.
		$classes[]= $item_class;
		// Expose the classes to filtering.
		apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth );
		// Convert the classes into a string for output.
		$classes_str  = implode( ' ', $classes );

		// Grab the opening html for the menu item, which we specified in wp_nav_menu() in our shortcode.
		$before = $args -> before;
		// Merge our css classes into the menu item.
		$before = sprintf( $before, $classes_str );
		// Add the opening html tag to the output for this item.
		$item_output .= $before;
		// Atts for the link itself.
		$atts = array();
		$atts['title']  = esc_attr( $item -> attr_title );
		$atts['target'] = esc_attr( $item -> target );
		$atts['rel']    = esc_attr( $item -> xfn );
		$atts['href']   = esc_url(  $item -> url );
		// Expose the atts to filtering.
		$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );
		// Combine the atts into a string for inserting into the link tag.
		$atts_str = '';
		foreach ( $atts as $k => $v ) {
			if ( empty( $v ) ) { continue; }
			$atts_str .= " $k='$v' ";
		}
		// The clickable text for the link.
		$label = apply_filters( 'the_title', $item -> title, $item -> ID );
		// Finally!  Add the link to the menu item.
		$item_output .= "<a {$atts_str} class='{$item_class}-link {$item_class}-text_link {$classes_str}'><span class='label'>{$label}</span></a>";

		/**
		 * Append this menu item to the menu.
		 * Since output is passed by reference, we don't need to return anything.
		 */
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	/**
	 * Append the closing html for a menu item.
	 *
	 * @param string $output Passed by reference. @see start_el().
	 * @param int    $depth  Depth of menu item. @see start_el().
	 * @param array  $args   An array of arguments. @see start_el().
	 */
	public function end_el( &$output, $item, $depth = 0, $args = array() ) {
	}
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
	}
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
	}
}
