<?php
/**
 * Plugin Name: Members Post Widget
 * Plugin URI: http://www.technologyofkevin.com
 * Description: members sidebar for members-php only for ams lab
 * Author: Kevin Wei
 * Version: 1.0
 * Author URI: http://www.technologyofkevin.com
 */

add_action( 'widgets_init', 'postmembers_register_widgets' );

function postmembers_register_widgets() {
	register_widget( 'MembersPostWidget' );
}

/**
 * Plugin Name: Members Post Widget
 * @since 1.0
 */

class MembersPostWidget extends WP_Widget {

// init
	function MembersPostWidget() {
		$widget_ops = array( 'classname' => 'MembersPostWidget', 'description' => 'Displays members in your web' );

		parent::__construct( 'Members_Post_Widget', 'Members Post', $widget_ops );
	}

// front-end
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$name         = $instance['member_name'];
		$introduction = $instance['member_introduction'];
		$email        = $instance['member_email'];
		$number       = $instance['member_phone_number'];
		$facebook     = $instance['member_facebook'];
		$twitter      = $instance['member_twitter'];
		$address      = $instance['member_address'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display name from widget settings if one was input. */
		if ( $name ) {
			echo $before_title . $name . $after_title;
		}
		/* If show announcement was selected, display the announcement. */
		if ( $introduction ) {
			echo '<p>' . $introduction . '</p>';
		}

		if ( $email ) {
			echo '<p>Email: <a href="mailto:' . $email . '">' . $email . '</a></p>';
		}

		if ( $number ) {
			echo '<p>Tel: ' . $number . '</p>';
		}

		if ( $facebook || $twitter ) {
			echo '<ul class="member_social">';
			if ( $facebook ) {echo '<li><a href=' . $facebook . '>Facebook</a></li>';}
			if ( $twitter ) {echo '<li><a href=' . $twitter . '>Twitter</a></li>';}
			echo '</ul>';
		}

		if ( $address ) {
			echo '<p>Address: ' . $address . '</p>';
		}

		/* After widget (defined by themes). */
		echo $after_widget;
	}

// update
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['member_name']         = strip_tags( $new_instance['member_name'] );
		$instance['member_introduction'] = strip_tags( $new_instance['member_introduction'] );
		$instance['member_email']        = strip_tags( $new_instance['member_email'] );
		$instance['member_phone_number'] = strip_tags( $new_instance['member_phone_number'] );
		$instance['member_facebook']     = strip_tags( $new_instance['member_facebook'] );
		$instance['member_twitter']      = strip_tags( $new_instance['member_twitter'] );
		$instance['member_address']      = strip_tags( $new_instance['member_address'] );

		return $instance;
	}

// back-end
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'member_name'         => 'name',
			'member_introduction' => 'Describe yourself here...',
			'member_email'        => '',
			'member_phone_number' => '',
      'member_address'      => '',
			'member_facebook'     => '',
			'member_twitter'      => '',
		   );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$mem_email    = ($instance['member_email']=='')        ? " placeholder='enter email'"        : " value=" . $instance['member_email'];
		$mem_phone    = ($instance['member_phone_number']=='') ? " placeholder='enter phone number'" : " value=" . $instance['member_phone_number'];
		$mem_address  = ($instance['member_address']=='')      ? " placeholder='enter address'"      : " value=" . $instance['member_address'];
		$mem_facebook = ($instance['member_facebook']=='')     ? " placeholder='enter facebook'"     : " value=" . $instance['member_facebook'];
		$mem_twitter  = ($instance['member_twitter']=='')      ? " placeholder='enter twitter'"      : " value=" . $instance['member_twitter']; ?>
<?php // input name ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_name' ); ?>">Member name:</label>
			<input id="<?php echo $this->get_field_id( 'member_name' ); ?>" name="<?php echo $this->get_field_name( 'member_name' ); ?>" value="<?php echo $instance['member_name']; ?>" style="width:100%;" >
		</p>
<?php // input eamil ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_email' ); ?>">Email:</label>
      <input id="<?php echo $this->get_field_id( 'member_email' ) ?>" name= "<?php echo $this->get_field_name( 'member_email' ) . $mem_email; ?>"  style='width:100%;' type='email'>
		</p>
<?php // input phone ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_phone_number' ); ?>">TEL:</label>
			<input id="<?php echo $this->get_field_id( 'member_phone_number' ) ?>" name= "<?php $this->get_field_name( 'member_phone_number' ) . $mem_phone; ?>"  style='width:100%;' type='tel'>
		</p>
<?php // input address ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_address' ); ?>">Address:</label>
			<input id="<?php echo $this->get_field_id( 'member_address' ) ?>" name= "<?php $this->get_field_name( 'member_address' ) . $mem_address; ?>"  style='width:100%;' type='text'>
		</p>
<?php // input facebook ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_facebook' ); ?>">Facebook:</label>
			<input id="<?php echo $this->get_field_id( 'member_facebook' ) ?>" name= "<?php $this->get_field_name( 'member_facebook' ) . $mem_facebook; ?>"  style='width:100%;' type='url'>
		</p>
<?php // input twitter ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_twitter' ); ?>">Twitter:</label>
			<input id="<?php echo $this->get_field_id( 'member_twitter' ); ?>" name="<?php echo $this->get_field_name( 'member_twitter' ); ?>" style="width:100%;">
		</p>
<?php // input summary ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_introduction' ); ?>">Summary:</label>
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id( 'member_introduction' ); ?>" name="<?php echo $this->get_field_name( 'member_introduction' ); ?>" placeholder="<?php echo $instance['member_introduction']; ?>"></textarea>
		</p>

	<?php
	}
}

?>
