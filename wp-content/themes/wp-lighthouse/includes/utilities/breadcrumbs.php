<?php
// Wordpress Breadcrumb Function

function wp_lighthouse_breadcrumb() {

  // Define
  global $post;
  $custom_taxonomy  = ''; // If you have custom taxonomy place it here

  $defaults = array(
    'seperator'   =>  '/',
    'id'          =>  'wt-bc',
    'classes'     =>  'wt-bc',
    'home_title'  =>  __('Home', 'wp-lighthouse')
  );

  $sep  = '<li role="separator" class="seperator">'. esc_html( $defaults['seperator'] ) .'</li>';

  // Start the breadcrumb with a link to your homepage
  echo '<ul role="menu" id="'. esc_attr( $defaults['id'] ) .'" class="'. esc_attr( $defaults['classes'] ) .'">';

  // Creating home link
  echo '<li role="menuitem" class="item"><a href="'. get_home_url() .'">'. ( $defaults['home_title'] ) .'</a></li>';
  
  // Check if is front/home page, return
  if ( !is_front_page() ) { echo $sep; }

  if ( is_single() ) {

    // Get posts type
    $post_type = get_post_type();

    if( $post_type == 'post' ) {
        
      echo '<li role="menuitem" class="item item-cat item-post-blog"><a href="' . get_post_type_archive_link( 'post' ) . '">' . __( 'Blog', 'wp-lighthouse' ) . '</a></li>' . $sep;
    }

    // If post type is not post
    if( $post_type != 'post' ) {

      $post_type_object   = get_post_type_object( $post_type );
      $post_type_link     = get_post_type_archive_link( $post_type );

      echo '<li role="menuitem" class="item item-cat"><a href="'. $post_type_link .'">'. $post_type_object->labels->name .'</a></li>'. $sep;

    }

    // Get categories
    $category = get_the_category( $post->ID );

    // If category not empty
    if( !empty( $category ) ) {

      // Arrange category parent to child
      $category_values      = array_values( $category );
      $get_last_category    = end( $category_values );
      // $get_last_category    = $category[count($category) - 1];
      $get_parent_category  = rtrim( get_category_parents( $get_last_category->term_id, true, ',' ), ',' );
      $cat_parent           = explode( ',', $get_parent_category );

      // Store category in $display_category
      $display_category = '';
      foreach( $cat_parent as $p ) {
        $display_category .=  '<li role="menuitem" class="item item-cat">'. $p .'</li>' . $sep;
      }

    }

    // If it's a custom post type within a custom taxonomy
    $taxonomy_exists = taxonomy_exists( $custom_taxonomy );

    if( empty( $get_last_category ) && !empty( $custom_taxonomy ) && $taxonomy_exists ) {

      $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
      $cat_id         = $taxonomy_terms[0]->term_id;
      $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
      $cat_name       = $taxonomy_terms[0]->name;

    }

    // Check if the post is in a category
    if( !empty( $get_last_category ) ) {

      echo $display_category;
      echo '<li role="menuitem" class="item item-current">'. get_the_title() .'</li>';

    } else if( !empty( $cat_id ) ) {

      echo '<li role="menuitem" class="item item-cat"><a href="'. $cat_link .'">'. $cat_name .'</a></li>' . $sep;
      echo '<li role="menuitem" class="item-current item">'. get_the_title() .'</li>';

    } else {

      echo '<li role="menuitem" class="item-current item">'. get_the_title() .'</li>';

    }

  } else if( is_archive() ) {

    if( is_tax() ) {
      // Get posts type
      $post_type = get_post_type();

      // If post type is not post
      if( $post_type != 'post' ) {

        $post_type_object   = get_post_type_object( $post_type ); 
        $post_type_link     = get_post_type_archive_link( $post_type );

        if(empty($post_type_object)) {
          $post_type_object = get_post_type_object( 'casino' );
          $post_type_link     = get_post_type_archive_link( 'casino' );
        }

        echo '<li role="menuitem" class="item item-cat item-custom-post-type-' . $post_type . '"><a href="' . $post_type_link . '">' . $post_type_object->labels->name . '</a></li>' . $sep;

      }

      $custom_tax_name = get_queried_object()->name;
      echo '<li role="menuitem" class="item item-current">'. $custom_tax_name .'</li>';

    } else if ( is_category() ) {

      if( get_post_type() == 'post' ) {
        
        echo '<li role="menuitem" class="item item-cat item-post-blog"><a href="' . get_post_type_archive_link( 'post' ) . '">' . __( 'Blog', 'wp-lighthouse' ) . '</a></li>' . $sep;
      }

      $parent = get_queried_object()->category_parent;

      if ( $parent !== 0 ) {

        $parent_category = get_category( $parent );
        $category_link   = get_category_link( $parent );

        echo '<li role="menuitem" class="item"><a href="'. esc_url( $category_link ) .'">'. $parent_category->name .'</a></li>' . $sep;

      }

      echo '<li role="menuitem" class="item item-current">'. single_cat_title( '', false ) .'</li>';

    } else if ( is_tag() ) {

      // Get tag information
      $term_id        = get_query_var('tag_id');
      $taxonomy       = 'post_tag';
      $args           = 'include=' . $term_id;
      $terms          = get_terms( $taxonomy, $args );
      $get_term_name  = $terms[0]->name;

      if( get_post_type() == 'post' ) {
        
        echo '<li role="menuitem" class="item item-cat item-post-blog"><a href="' . get_post_type_archive_link( 'post' ) . '">' . __( 'Blog', 'wp-lighthouse' ) . '</a></li>' . $sep;
      }

      //echo '<li role="menuitem">'. __( 'Tag', 'wp-lighthouse' ) .'</li>' . $sep;

      // Display the tag name
      echo '<li role="menuitem" class="item-current item">'. $get_term_name .'</li>';

    } else if( is_day() ) {

      // Day archive

      // Year link
      echo '<li role="menuitem" class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;

      // Month link
      echo '<li role="menuitem" class="item-month item"><a href="'. get_month_link( get_the_time('Y'), get_the_time('m') ) .'">'. get_the_time('M') .' Archives</a></li>' . $sep;

      // Day display
      echo '<li role="menuitem" class="item-current item">'. get_the_time('jS') .' '. get_the_time('M'). ' Archives</li>';

    } else if( is_month() ) {

      // Month archive

      // Year link
      echo '<li role="menuitem" class="item-year item"><a href="'. get_year_link( get_the_time('Y') ) .'">'. get_the_time('Y') . ' Archives</a></li>' . $sep;

      // Month Display
      echo '<li role="menuitem" class="item-month item-current item">'. get_the_time('M') .' Archives</li>';

    } else if ( is_year() ) {

      // Year Display
      echo '<li role="menuitem" class="item-year item-current item">'. get_the_time('Y') .' Archives</li>';

    } else if ( is_author() ) {

      // Auhor archive

      // Get the author information
      global $author;
      $userdata = get_userdata( $author );

      // Display author name
      echo '<li role="menuitem" class="item-member item"><a href="'. esc_url( '' ) .'">'. __('Member', 'wp-lighthouse') .'</a></li>';
      echo '<li role="menuitem" class="seperator">/</li>';
      echo '<li role="menuitem" class="item-current item">' . $userdata->display_name . '</li>';

    } else {

      echo '<li role="menuitem" class="item item-current ">'. post_type_archive_title('', false) .'</li>';

    }

  } else if ( is_page() ) {

    // Standard page
    if( $post->post_parent ) {

      // If child page, get parents
      $anc = get_post_ancestors( $post->ID );

      // Get parents in the right order
      $anc = array_reverse( $anc );

      // Parent page loop
      if ( !isset( $parents ) ) $parents = null;
      foreach ( $anc as $ancestor ) {

        $parents .= '<li role="menuitem" class="item-parent item"><a href="'. get_permalink( $ancestor ) .'">'. get_the_title( $ancestor ) .'</a></li>' . $sep;

      }

      // Display parent pages
      echo $parents;

      // Current page
      echo '<li role="menuitem" class="item-current item">'. get_the_title() .'</li>';

    } else {

      // Check if is front/home page, return
      if ( !is_front_page() ) {
        // Just display current page if not parents
        echo '<li role="menuitem" class="item-current item">'. get_the_title() .'</li>';
      }

    }

  } else if ( is_search() ) {

    // Search results page
    echo '<li role="menuitem" class="item-current item">Search results for: '. get_search_query() .'</li>';

  } else if ( is_404() ) {

    // 404 page
    echo '<li role="menuitem" class="item-current item">' . __( 'Error 404', 'wp-lighthouse' ) . '</li>';

  } else if ( get_post_type() == "post" ) {

    echo '<li role="menuitem" class="item-current item">' . __( 'Blog', 'wp-lighthouse' ) . '</li>';
  }

  // End breadcrumb
  echo '</ul>';

}
