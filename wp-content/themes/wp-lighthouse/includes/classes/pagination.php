<?php
/**
 * WP Tube Pagination
 * 
 * @package WP_Lighthouse
 */


function wp_lighthouse_search_pagination( $nextPage = 2, $paged = 1, $permalink, $css = '', $hide_next_bar = false ) {

    $output = '';

    if( $hide_next_bar == false ) 
    {
        // show mobile friendly nav
        $output .= '<nav aria-label="' . esc_attr( 'Accessible Page Navigation', 'wp-lighthouse' ) .'">';

        $page_text = ( ( $nextPage > $paged ) ? esc_html( 'Next', 'wp-lighthouse' ) . ' &rsaquo;' : '&lsaquo; ' . esc_html( 'Previous', 'wp-lighthouse' ) );
        $page_href = $permalink . '&pg=' . ( ( $nextPage > $paged ) ? ( $paged + 1 ) : ( $paged - 1 ) );

        $output .= '<a href="' . $page_href . '" class="section ez-pagination" aria-label="' . esc_attr( 'Accessible Page Navigation', 'wp-lighthouse' ) .'">' . $page_text . '</a>';

        $output .= '</nav>';

        $output .= '<nav id="pagination" class="section" aria-label="' . esc_attr( 'Page Navigation', 'wp-lighthouse' ) .'">';
            
        $output .= '<ul class="pagination' . ( !empty( $css ) ? ' ' . $css : '' ) . '">';

        for ( $i = 1; $i <= $nextPage; $i++ ) {
        
            if( $paged == $i ) { 
                
                $output .= '<li>
                                <a aria-current="page" href="#">
                                    <span class="visually-hidden">' . esc_html( 'Page', 'wp-lighthouse' ) . ' </span> 
                                    ' . $i .'
                                </a>
                            </li>';
            }
            else { 
                
                $output .= '<li>
                                <a href="' . $permalink . ( $i > 1 ? '&pg=' . ( $i ) : '' ) . '">
                                    <span class="visually-hidden">' . esc_html( 'Page', 'wp-lighthouse' ) . ' </span>
                                    ' . $i . '
                                </a>
                            </li>';
            }
        }

        $output .= '</ul>';
        $output .= '</nav>';
    }

    return $output;
}

/**
 * Bootstrap 5 tag pagination
 */

function wp_lighthouse_taxonomy_pagination( $pages = '', $paged, $range = 4, $css = '', $hide_next_bar = false ) {

    $output = '';

    // if there's more than one page
    if( $pages > 1 ) {
    
        if( ! $hide_next_bar ) {
            
            // show mobile friendly nav
            $output .= '<nav aria-label="' . esc_attr( 'Accessible Page Navigation', 'wp-lighthouse' ) .'">';

            $page_text = ( ( $paged < $pages ) ? esc_html( 'Next', 'wp-lighthouse' ) . ' &rsaquo;' : '&lsaquo; ' . esc_html( 'Previous', 'wp-lighthouse' ) );
            $page_href = ( ( $paged < $pages ) ? get_pagenum_link( $paged + 1 ) : get_pagenum_link( $paged - 1 ) );

            //$output .= '<a href="' . $page_href . '" class="btn btn-outline-secondary w-50 btn-lg">' . $page_text . '</a>';
            $output .= '<a href="' . $page_href . '" class="section ez-pagination" aria-label="' . esc_attr( 'Accessible Page Navigation', 'wp-lighthouse' ) .'">' . $page_text . '</a>';

            $output .= '</nav>';
        }

        $output .= '<nav id="pagination" class="section" aria-label="' . esc_attr( 'Page Navigation', 'wp-lighthouse' ) .'">';
        
        $output .= '<ul class="pagination' . ( !empty( $css ) ? ' ' . $css : '' ) . '">';

        $first_disabled = ( ( $paged > 2 && $paged > $range+1 ) ? false : true );

        $output .= '<li'.( $first_disabled ? ' class="disabled"' : '' ).'>
                        <a href="' . get_pagenum_link(1) . '" aria-label="' . esc_html( 'First page', 'wp-lighthouse' ) . '">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="visually-hidden"> ' . esc_html( 'First page', 'wp-lighthouse' ) . '</span>
                        </a>
                    </li>';

        $prev_disabled = ( ( $paged > 1 ) ? false : true );
        
        $output .= '<li' . ( $prev_disabled ? ' class="disabled"' : '' ) . '>
                        <a href="' . ( $prev_disabled ? '#' : get_pagenum_link($paged - 1) ) . '" aria-label="' . esc_html( 'Previous page', 'wp-lighthouse' ) . '">
                            <span aria-hidden="true">&lsaquo;</span>
                            <span class="visually-hidden"> ' . esc_html( 'Previous page', 'wp-lighthouse' ) . '</span>
                        </a>
                    </li>';

        for ( $pagecount = 1; $pagecount <= $pages; $pagecount++ ) {
        
            if ( 1 != $pages && ( !( $pagecount >= $paged+$range+1 || $pagecount <= $paged-$range-1 ) ) ) {
                
                if( $paged == $pagecount ) { 
                    
                    $output .= '<li>
                                    <a aria-current="page" href="#">
                                        <span class="visually-hidden">' . esc_html( 'Page', 'wp-lighthouse' ) . ' </span> 
                                        ' . $pagecount .'
                                    </a>
                                </li>';
                }
                else { 
                    
                    $output .= '<li>
                                    <a href="' . get_pagenum_link( $pagecount ) . '">
                                        <span class="visually-hidden">' . esc_html( 'Page', 'wp-lighthouse' ) . ' </span>
                                        ' . $pagecount . '
                                    </a>
                                </li>';
                }
            }
        }

        $next_disabled = ( ( $paged < $pages ) ? false : true );

        $output .= '<li' . ( $next_disabled ? ' class="disabled"' : '' ) . '>
                        <a href="' . ( $next_disabled ? '#' : get_pagenum_link( $paged + 1 ) ) . '"  aria-label="' . esc_html( 'Next page', 'wp-lighthouse' ) . '">
                            <span class="visually-hidden">' . esc_html( 'Next', 'wp-lighthouse' ) . ' </span>
                            <span aria-hidden="true">&rsaquo;</span>
                        </a>
                    </li>';

        $last_disabled = ( ( $paged < $pages-1 &&  $paged+$range-1 < $pages ) ? false : true );

        $output .= '<li' . ( $last_disabled ? ' class="disabled"' : '' ) . '>
                        <a href="' . get_pagenum_link( $pages ) . '" aria-label="' . esc_html( 'Last page', 'wp-lighthouse' ) . '">
                            <span class="visually-hidden">' . esc_html( 'Last page', 'wp-lighthouse' ) . ' </span>
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>';

        $output .= '</ul>';
        $output .= '</nav>';
    }

    return $output;
}

/**
 * Bootstrap 5 post pagination
 */
function wp_lighthouse_pagination( $pages = '', $range = 4, $css = '', $hide_next_bar = false ) {

    $output = '';

	$showitems = ($range * 2) + 1;
    
    global $paged;

    if( empty($paged) ) { $paged = 1; }

    if($pages == '') {

        global $wp_query;
        $pages = $wp_query->max_num_pages;
         
        if(!$pages) {
         
            $pages = 1;
        }
    }

    if( 1 != $pages ) {

        if( ! $hide_next_bar ) {
            
            // show mobile friendly nav
            $output .= '<nav aria-label="' . esc_attr( 'Accessible Page Navigation', 'wp-lighthouse' ) .'">';

            $page_text = ( ( $paged < $pages ) ? esc_html( 'Next', 'wp-lighthouse' ) . ' &rsaquo;' : '&lsaquo; ' . esc_html( 'Previous', 'wp-lighthouse' ) );
            $page_href = ( ( $paged < $pages ) ? get_pagenum_link( $paged + 1 ) : get_pagenum_link( $paged - 1 ) );

            //$output .= '<a href="' . $page_href . '" class="btn btn-outline-secondary w-50 btn-lg">' . $page_text . '</a>';
            $output .= '<a href="' . $page_href . '" class="section ez-pagination" aria-label="' . esc_attr( 'Accessible Page Navigation', 'wp-lighthouse' ) .'">' . $page_text . '</a>';

            $output .= '</nav>';
        }

        $output .= '<nav id="pagination" class="section" aria-label="' . esc_attr( 'Page Navigation', 'wp-lighthouse' ) .'">';
        
        $output .= '<ul class="pagination' . ( !empty( $css ) ? ' ' . $css : '' ) . '">';

        $first_disabled = ( ( $paged > 2 && $paged > $range+1 ) ? false : true );

        $output .= '<li'.( $first_disabled ? ' class="disabled"' : '' ).'>
                        <a href="' . get_pagenum_link(1) . '" aria-label="' . esc_html( 'First page', 'wp-lighthouse' ) . '">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="visually-hidden"> ' . esc_html( 'First page', 'wp-lighthouse' ) . '</span>
                        </a>
                    </li>';

        $prev_disabled = ( ( $paged > 1 ) ? false : true );
        
        $output .= '<li' . ( $prev_disabled ? ' class="disabled"' : '' ) . '>
                        <a href="' . ( $prev_disabled ? '#' : get_pagenum_link($paged - 1) ) . '" aria-label="' . esc_html( 'Previous page', 'wp-lighthouse' ) . '">
                            <span aria-hidden="true">&lsaquo;</span>
                            <span class="visually-hidden"> ' . esc_html( 'Previous page', 'wp-lighthouse' ) . '</span>
                        </a>
                    </li>';

        for ( $i=1; $i <= $pages; $i++ ) {
            
            if ( 1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ) ) {
                
                if( $paged == $i ) { 
                    
                    $output .= '<li>
                                    <a aria-current="page" href="#">
                                        <span class="visually-hidden">' . esc_html( 'Page', 'wp-lighthouse' ) . ' </span> 
                                        ' . $i .'
                                    </a>
                                </li>';
                }
                else { 
                    
                    $output .= '<li>
                                    <a href="' . get_pagenum_link( $i ) . '">
                                        <span class="visually-hidden">' . esc_html( 'Page', 'wp-lighthouse' ) . ' </span>
                                        ' . $i . '
                                    </a>
                                </li>';
                }
             }
         }


         $next_disabled = ( ( $paged < $pages ) ? false : true );

         $output .= '<li' . ( $next_disabled ? ' class="disabled"' : '' ) . '>
                         <a href="' . ( $next_disabled ? '#' : get_pagenum_link( $paged + 1 ) ) . '"  aria-label="' . esc_html( 'Next page', 'wp-lighthouse' ) . '">
                             <span class="visually-hidden">' . esc_html( 'Next', 'wp-lighthouse' ) . ' </span>
                             <span aria-hidden="true">&rsaquo;</span>
                         </a>
                     </li>';
 
         $last_disabled = ( ( $paged < $pages-1 &&  $paged+$range-1 < $pages ) ? false : true );
 
         $output .= '<li' . ( $last_disabled ? ' class="disabled"' : '' ) . '>
                         <a href="' . get_pagenum_link( $pages ) . '" aria-label="' . esc_html( 'Last page', 'wp-lighthouse' ) . '">
                             <span class="visually-hidden">' . esc_html( 'Last page', 'wp-lighthouse' ) . ' </span>
                             <span aria-hidden="true">&raquo;</span>
                         </a>
                     </li>';

        $output .= '</ul>';
        $output .= '</nav>';
    }

    return $output;
}