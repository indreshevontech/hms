<?php  
/**
 * Widget API: WP_Widget_Recent_Posts class
 *
 * @package WordPress
 * @subpackage Widgets
 */

/**
 * Core class used to implement a Recent Posts widget.
 *
 *
 * @see WP_Widget
 */
class osru_recent_posts extends WP_Widget {

    /**
     * Sets up a new Recent Posts widget instance.
     *
     * @access public
     */
    // side-bar-latest-post
    public function __construct() {
        $widget_ops = array(
            'classname' => '',
            'description' => esc_html__( 'Your site&#8217;s most recent Posts.','hospital'),
            'customize_selective_refresh' => true,
        );
        parent::__construct( 'recent-posts', esc_html__( 'Department Category(Footer)','hospital'), $widget_ops );
        $this->alt_option_name = 'widget_recent_entries';
    }
    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @access public
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget( $args, $instance ) {
        if ( ! isset( $args['widget_id'] ) ) {
            $args['widget_id'] = $this->id;
        }

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Latest Post','hospital');

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        /**
         * Filter the arguments for the Recent Posts widget.
         *
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        ?>
            <?php echo $args['before_widget']; ?>
                <?php if ( $title ) {?>
                <?php  echo $args['before_title'] . esc_html($title) . $args['after_title'];?>
               <?php  } ?>

                   <ul class="footer-link list-unstyled">
                   	 <?php 
                   	  $terms = get_terms('department_cat');
                   	  
                   	$k=0;
                   foreach ( $terms as $term ) {
                    	$k++;
                   	 if($k<=$number){
                      $term_link = get_term_link( $term, 'department_cat' );
                      ?>
				 	<li><a href="<?php echo esc_url($term_link);?>"><?php echo  $term->name;?></a></li>
				 <?php }}?>
				 
				</ul>

                                     

            <?php echo $args['after_widget']; ?>
            <?php
          
    }
    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @access public
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @since 2.8.0
     * @access public
     *
     * @param array $instance Current settings.
     */
    public function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php esc_html_e( 'Title:', 'hospital' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'hospital' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo esc_attr($number); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php esc_html_e( 'Display post date?', '' ); ?></label>
        </p>

    <?php
    }
}




