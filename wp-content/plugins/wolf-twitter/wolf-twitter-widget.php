<?php
/**
 * Recent comment widget
 *
 * Displays ticket categories widget
 *
 * @author WolfThemes
 * @category Widgets
 * @extends WP_Widget
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/* Register the widget */
function wolf_twitter_init() {

	register_widget( 'Wolf_Twitter_Widget' );

}
add_action( 'widgets_init', 'wolf_twitter_init' );

/*-----------------------------------------------------------------------------------*/
/*  Widget class
/*-----------------------------------------------------------------------------------*/
class Wolf_Twitter_Widget extends WP_Widget {

	var $wolf_widget_cssclass;
	var $wolf_widget_description;
	var $wolf_widget_idbase;
	var $wolf_widget_name;

	/**
	 * Constructor
	 */
	public function __construct() {

		/* Widget variable settings. */
		$this->wolf_widget_name 	= 'Twitter';
		$this->wolf_widget_description 	= __( 'Display your latest tweets', 'wolf' );
		$this->wolf_widget_cssclass 	= 'wolf-twitter-widget';
		$this->wolf_widget_idbase 	= 'wolf-twitter-widget';

		/* Widget settings. */
		$widget_ops = array( 'classname' => $this->wolf_widget_cssclass, 'description' => $this->wolf_widget_description );

		/* Create the widget. */
		parent::__construct( $this->wolf_widget_idbase, $this->wolf_widget_name, $widget_ops );
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget($args, $instance) {

		extract($args);

		$title = apply_filters( 'widget_title', $instance['title'] );
		$username = $instance['username'];
		$count = $instance['count'];

		echo $before_widget;
		if ( ! empty( $title ) ) echo $before_title . $title . $after_title;
		echo wolf_twitter_widget( $username, $count );
		echo $after_widget;

	}

	/**
	 * update function.
	 *
	 * @see WP_Widget->update
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];

		$instance['username'] = $new_instance['username'];

		$instance['count'] = $new_instance['count'];
		if ( $instance['count']==0 || $instance['count']=='' ) $instance['count'] = 3;
		if ( $instance['username']=='' ) $instance['username'] = 'username';
		return $instance;
	}

	/**
	 * form function.
	 *
	 * @see WP_Widget->form
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {

			// Set up some default widget settings
			$defaults = array( 'title' => __( 'Twitter Feed', 'wolf' ), 'username' => '',  'count' =>'3' );
			$instance = wp_parse_args( (array) $instance, $defaults );

		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Your Twitter username', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" value="<?php echo $instance['username']; ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e( 'Number of tweets', 'wolf' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>">
		</p>
		<?php
	}
}
?>