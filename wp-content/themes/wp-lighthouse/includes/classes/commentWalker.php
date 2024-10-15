<?php

if ( ! class_exists( 'AVMAG_Walker_Comment' ) ) {

	class WP_Lighthouse_Walker_comment extends Walker_Comment {
	
		// init classwide variables
		var $tree_type = 'comment';
		var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );
	
		/** CONSTRUCTOR
		 * You'll have to use this if you plan to get to the top of the comments list, as
		 * start_lvl() only goes as high as 1 deep nested comments */
		function __construct() {
			
			//echo '<div class="comments mt-4 mb-3">';
			
		}
		
		/** START_LVL 
		 * Starts the list before the CHILD elements are added. Unlike most of the walkers,
		 * the start_lvl function means the start of a nested comment. It applies to the first
		 * new level under the comments that are not replies. Also, it appear that, by default,
		 * WordPress just echos the walk instead of passing it to &$output properly. Go figure.  */
		function start_lvl( &$output, $depth = 0, $args = array() ) {		
			
			$GLOBALS['comment_depth'] = $depth + 1;
	
			echo '<div class="mb-4 d-flex flex-align-center flex-gap15' . ( $GLOBALS['comment_depth'] < 3 ? ' comment-reply' : '' ) . '">';
		}
	
		/** END_LVL 
		 * Ends the children list of after the elements are added. */
		function end_lvl( &$output, $depth = 0, $args = array() ) {
			
			$GLOBALS['comment_depth'] = $depth + 1;
	
			echo '</div><!-- /.children -->';
			
		}
		
		/** START_EL */
		function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
			
			$depth++;
			
			$GLOBALS['comment_depth'] = $depth;
			
			$GLOBALS['comment'] = $comment; 
			
			$parent_class = ( empty( $args['has_children'] ) ? 'pb-4 d-flex flex-align-center flex-gap15' : 'pb-4 d-flex flex-align-center flex-gap15 comment-reply' ); 
		?>
			
			<div <?php comment_class(); ?> id="comment-<?php comment_ID() ?>">

                <div class="<?php echo $parent_class;?>">
                    <?php
                    $avatar_url = get_avatar_url( 
                        $comment, 
                        array(
                            'size' => ( isset( $args['avatar_size'] ) ? absint( $args['avatar_size'] ) : 55 ),
                            'default' => 'retro',
                            'scheme' => 'https'
                        ) 
                    ); 
                    ?>
                    <div class="m-author" style="background-image: url(<?php echo $avatar_url;?>)" title="<?php comment_author();?>;">
                        <span class="visually-hidden"><?php echo sprintf( __( 'Comment by %s', 'wp-lighthouse' ), get_comment_author() ); ?></span>
                    </div>
                    <div>
                        <strong><a href="#"><?php comment_author();?></a></strong><br>
                        <?php echo strip_tags( get_comment_text() ); ?>
                        <?php $comment_date = get_comment_date('Y-m-d H:i:s'); ?>
                        <div class="text-muted" time="<?php echo $comment_date;?>"> 
                            <?php 
                            echo wp_lighthouse_time_ago( $comment_date );
                            $reply_args = array(
                                    'depth' 		=> $depth,
                                    'max_depth' 	=> $args['max_depth'] 
                                );
                
                            comment_reply_link( array_merge( $args, $reply_args ) );  

                            if ( get_edit_comment_link() ) {
                                echo ' <span aria-hidden="true">&bull;</span> <a class="comment-edit-link" href="' . esc_url( get_edit_comment_link() ) . '">' . __( 'Edit', 'wp-lighthouse' ) . '</a>';
                            } 
                            ?>
                        </div>
                    </div>
                </div>
                <?php if ( '0' === $comment->comment_approved ) { ?>
                <div class="alert alert-success">
				    <?php _e( 'Your comment is awaiting moderation.', 'wp-lighthouse' ); ?>
				</div>
                <?php } ?>
		<?php 
		}
	
		function end_el(&$output, $comment, $depth = 0, $args = array() ) {
			
			echo '</div><!-- /#comment-' . get_comment_ID() . ' -->';
			
		}
		
		/** DESTRUCTOR
		 * I just using this since we needed to use the constructor to reach the top 
		 * of the comments list, just seems to balance out :) */
		function __destruct() {
		
			//echo '</div><!-- /#comment-list -->';
	
		}
	}
}
