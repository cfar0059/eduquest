<div class="d-flex flex-align-center flex-between">
    <h2 class="comment-icon"><?php $comments_count = get_comments_number(); echo $comments_count > 1 ? sprintf( __( "%s Comments", 'wp-lighthouse' ), wp_lighthouse_post_views_format( $comments_count ) ) : sprintf( __( "%s Comment", 'wp-lighthouse' ), wp_lighthouse_post_views_format( $comments_count ) ); ?></h2>
    <a href="#addcomment" class="btn btn-outline-secondary"><?php _e( '+ Add comment', 'wp-lighthouse' );?></a>
</div>
<?php if ( have_comments() ) { ?>
	<div class="m-comments scroll">
		<?php
		wp_list_comments(
			array(
				'walker'      => new WP_Lighthouse_Walker_Comment(),
				'avatar_size' => 45,
				'style'       => 'div',
			)
		);
		?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { // are there comments to navigate through. ?>

			<nav class="comment-navigation mt-3 mb-3" id="comment-nav-below">

				<h3 class="visually-hidden"><?php esc_html_e( 'Comment navigation', 'wp-lighthouse' ); ?></h3>

				<div class="d-flex flex-between m-3">
					<div class="comment-link">
						<?php if ( get_previous_comments_link() ) { previous_comments_link( __( '&lsaquo; Previous Comments', 'wp-lighthouse' ) ); } ?>
					</div>
					<div class="comment-link">
						<?php if ( get_next_comments_link() ) { next_comments_link( __( 'Next Comments &rsaquo;', 'wp-lighthouse' ) ); } ?>
					</div>
				</div>

			</nav><!-- #comment-nav-below -->

		<?php } // check for comment navigation. ?>
	</div>
<?php } // endif have_comments(). ?>

<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	?>

		<div class="alert alert-secondary mt-2 mb-2"><?php esc_html_e( 'Comments are now closed.', 'wp-lighthouse' ); ?></div>

	<?php 
	}
	else { 

		comment_form( array(
			'fields'                => array(
				//'author'            => '<div class="form-row"><div class="col"><input type="text" name="author" class="form-control comment-input" placeholder="' . __( 'Nickname', 'wp-lighthouse' ) . '" /></div>',
				//'email'             => '<div class="col"><input type="text" name="email" class="form-control comment-input" placeholder="' . __( 'Email address', 'wp-lighthouse' ) . '" /></div></div>',
				//'must_log_in'		=> '<div class="alert alert-secondary mt-3 mb-3 text-center">' . __( sprintf( 'You must be <a href="%s">logged in</a> to post a comment.', esc_url( wp_login_url( get_permalink() ).'#addcomment' ) ), 'wp-lighthouse' ) . '</div>',
			),
			'comment_field'         => '<div id="addcomment" class="form-group"><input type="hidden" name="action" value="wp_lighthouse_add_comment"><input type="hidden" id="comment-key" name="key" value=""><textarea id="comment-message" required class="form-control comment-input" name="comment" rows="1" placeholder="' . __( 'Add your comment...', 'wp-lighthouse' ) . '"></textarea><div id="help-comment" class="form-text"></div></div>',
			'class_submit'      => 'btn btn-add-comment btn-primary btn-sm ps-4 pe-4 auth-user',
			'label_submit'      => __( 'Submit', 'wp-lighthouse' ),
			'title_reply'       => '',
			'comment_notes_before' => '<div id="comment-user-logged-in"><div class="alert alert-secondary mt-3 mb-3 text-center auth-user-logged-in-hide">' . __( 'You must be <a href="#login" class="auth-user">logged in</a> to post a comment.', 'wp-lighthouse' ) . '</div></div>',
			'comment_notes_after' => __( '<div class="auth-user-loggedin-show visually-hidden mt-2">' . __('Logged in as <a data-href="' . home_url('member') . '" data-user="" class="auth-user-nickname auth-user-profile"></a>', 'wp-lighthouse') . '</div><p>
			&#10033;  Your email address will <strong>never</strong> be published.</p>', 'wp-lighthouse' ),
		) );
	}
?>