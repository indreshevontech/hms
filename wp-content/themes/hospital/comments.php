<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hospital
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">
<?php 
if( ! function_exists( 'better_commets' ) ):
function better_commets($comment, $args, $depth) {
    ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div class="comment">
        <div class="img-thumbnail d-none d-sm-block">
            <?php echo get_avatar($comment,$size='80',$default='http://0.gravatar.com/avatar/36c2a25e62935705c5565ec465c59a70?s=32&d=mm&r=g' ); ?>
        </div>
        <div class="comment-block">
            <div class="comment-arrow"></div>
                <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php esc_html_e('Your comment is awaiting moderation.','hospital') ?></em>
                    <br />
                <?php endif; ?>
                <span class="comment-by">
                    <strong><?php echo get_comment_author() ?></strong>
                    <span class="float-right">
                        <span> <a href="#"><i class="fa fa-reply"></i> <?php comment_reply_link(array_merge( $args, 
                            array('reply_text'=>'Reply Comment', 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></a></span>
                    </span>
                </span>
            <p> <?php comment_text() ?></p>
            <span class="date float-right"><?php printf(/* translators: 1: date and time(s). */ esc_html__('%1$s at %2$s','hospital'), get_comment_date(),  get_comment_time()) ?></span>
        </div>
        </div>

<?php
        }
endif;

	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments-title">
			<?php
			$hospital_comment_count = get_comments_number();
			if ( '1' === $hospital_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One thought on &ldquo;%1$s&rdquo;','hospital'),
					'<span>' . get_the_title() . '</span>'
				);
			} else {
				printf( // WPCS: XSS OK.
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $hospital_comment_count, 'comments title','hospital') ),
					number_format_i18n( $hospital_comment_count ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => '',
				'short_ping' => true,
                'callback' => 'better_commets', 
                'avatar_size' => 48, 
                'type' => 'comment' 
			) );
			?>
		</ul><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.','hospital'); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

 comment_form( );
	?>

</div><!-- #comments -->
