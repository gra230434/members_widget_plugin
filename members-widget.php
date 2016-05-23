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

    $MWK_plugin_path = plugin_dir_path( __FILE__ );
		/* Our variables from the widget settings. */
		$MWK_name         = $instance['member_name'];
		$MWK_introduction = $instance['member_introduction'];
		$MWK_email        = $instance['member_email'];
		$MWK_number       = $instance['member_phone_number'];
		$MWK_address      = $instance['member_address'];
		$MWK_facebook     = $instance['member_facebook'];
		$MWK_twitter      = $instance['member_twitter'];
		$MWK_google       = $instance['member_google'];
		$MWK_instagram    = $instance['member_instagram'];
		$MWK_linkedin     = $instance['member_linkedin'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display name from widget settings if one was input. */
		echo $before_title . $MWK_name . $after_title;
    $MWK_dividclass = '<div id="Members" class="MWK_Members_box">';
		echo esc_attr($MWK_dividclass);
		/* If show announcement was selected, display the announcement. */
		if ( $introduction ) { echo '<p>' . $MWK_introduction . '</p>'; }
		if ( $email ) { echo '<p>Email: <a href="mailto:' . $MWK_email . '">' . $MWK_email . '</a></p>'; }
		if ( $number ) { echo '<p>Tel: ' . $MWK_number . '</p>'; }

		if ( $MWK_facebook || $MWK_twitter || $MWK_google || $MWK_instagram || $MWK_linkedin ) {
			echo "<ul class='MWK_member_social_ul'>";
			if ( $facebook ) {echo "<li class='MWK_MS_FB MWK_MS_li'><a href=' . $MWK_facebook . '>Facebook</a></li>";}
			if ( $twitter ) {echo "<li class='MWK_MS_TW MWK_MS_li'><a href=' . $MWK_twitter . '>Twitter</a></li>";}
			if ( $google ) {echo "<li class='MWK_MS_G+ MWK_MS_li'><a href=' . $MWK_google . '>Twitter</a></li>";}
			if ( $instagram ) {echo "<li class='MWK_MS_ins MWK_MS_li'><a href=' . $MWK_instagram . '>Twitter</a></li>";}
			if ( $linkedin ) {echo "<li class='MWK_MS_IN MWK_MS_li'><a href=' . $MWK_linkedin . '>Twitter</a></li>";}
			echo '</ul>';
		}

		if ( $MWK_address ) { echo '<p>Address: ' . $MWK_address . '</p>'; }

		echo "</div>";

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
		$instance['member_facebook']     = esc_url( $new_instance['member_facebook'] );
		$instance['member_twitter']      = esc_url( $new_instance['member_twitter'] );
		$instance['member_google']       = esc_url( $new_instance['member_google'] );
		$instance['member_instagram']    = esc_url( $new_instance['member_instagram'] );
		$instance['member_linkedin']     = esc_url( $new_instance['member_linkedin'] );
		$instance['member_address']      = strip_tags( $new_instance['member_address'] );

		return $instance;
	}

// back-end
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'member_name'         => 'name',
			'member_introduction' => '',
			'member_email'        => '',
			'member_phone_number' => '',
      'member_address'      => '',
			'member_facebook'     => '',
			'member_twitter'      => '',
			'member_google'       => '',
			'member_instagram'    => '',
			'member_linkedin'     => '',
		   );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$mem_email     = ($instance['member_email']=='')        ? 'placeholder="enter email"'               : 'value="' . $instance['member_email'] . '"';
		$mem_phone     = ($instance['member_phone_number']=='') ? 'placeholder="enter phone number"'        : 'value="' . $instance['member_phone_number'] . '"';
		$mem_address   = ($instance['member_address']=='')      ? 'placeholder="enter address"'             : 'value="' . $instance['member_address'] . '"';
		$mem_facebook  = ($instance['member_facebook']=='')     ? 'placeholder="enter facebook"'            : 'value="' . $instance['member_facebook'] . '"';
		$mem_twitter   = ($instance['member_twitter']=='')      ? 'placeholder="enter twitter"'             : 'value="' . $instance['member_twitter'] . '"';
		$mem_google    = ($instance['member_google']=='')       ? 'placeholder="enter google+"'             : 'value="' . $instance['member_google'] . '"';
		$mem_instagram = ($instance['member_instagram']=='')    ? 'placeholder="enter instagram"'           : 'value="' . $instance['member_instagram'] . '"';
		$mem_linkedin  = ($instance['member_linkedin']=='')     ? 'placeholder="enter linkedin"'            : 'value="' . $instance['member_linkedin'] . '"';
		?>

<?php // input name ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_name' ); ?>">Member name:<span>*</span></label>
			<input id="<?php echo $this->get_field_id( 'member_name' ); ?>" name="<?php echo $this->get_field_name( 'member_name' ); ?>" value="<?php echo $instance['member_name']; ?>" style="width:100%;" required="required">
		</p>
<?php // input eamil ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_email' ); ?>">Email:</label>
      <input id="<?php echo $this->get_field_id( 'member_email' ) ?>" name="<?php echo $this->get_field_name( 'member_email' ); ?>" <?php echo $mem_email; ?> style='width:100%;' type='email'>
		</p>
<?php // input phone ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_phone_number' ); ?>">TEL:</label>
			<input id="<?php echo $this->get_field_id( 'member_phone_number' ) ?>" name= "<?php echo $this->get_field_name( 'member_phone_number' ); ?>" <?php echo $mem_phone; ?> style='width:100%;' type='tel'>
		</p>
<?php // input address ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_address' ); ?>">Address:</label>
			<input id="<?php echo $this->get_field_id( 'member_address' ) ?>" name= "<?php echo $this->get_field_name( 'member_address' ); ?>" <?php echo $mem_address; ?> style='width:100%;' type='text'>
		</p>
<?php // input facebook ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_facebook' ); ?>">Facebook:</label>
			<input id="<?php echo $this->get_field_id( 'member_facebook' ) ?>" name= "<?php echo $this->get_field_name( 'member_facebook' ); ?>" <?php echo $mem_facebook; ?> style='width:100%;' type='url'>
		</p>
<?php // input twitter ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_twitter' ); ?>">Twitter:</label>
			<input id="<?php echo $this->get_field_id( 'member_twitter' ); ?>" name="<?php echo $this->get_field_name( 'member_twitter' ); ?>" <?php echo $mem_twitter; ?> style='width:100%;' type='url'>
		</p>
<?php // input twitter ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_google' ); ?>">Twitter:</label>
			<input id="<?php echo $this->get_field_id( 'member_google' ); ?>" name="<?php echo $this->get_field_name( 'member_google' ); ?>" <?php echo $mem_google; ?> style='width:100%;' type='url'>
		</p>
<?php // input twitter ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_instagram' ); ?>">Twitter:</label>
			<input id="<?php echo $this->get_field_id( 'member_instagram' ); ?>" name="<?php echo $this->get_field_name( 'member_instagram' ); ?>" <?php echo $mem_instagram; ?> style='width:100%;' type='url'>
		</p>
<?php // input twitter ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_linkedin' ); ?>">Twitter:</label>
			<input id="<?php echo $this->get_field_id( 'member_linkedin' ); ?>" name="<?php echo $this->get_field_name( 'member_linkedin' ); ?>" <?php echo $mem_linkedin; ?> style='width:100%;' type='url'>
		</p>
<?php // input summary ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_introduction' ); ?>">Summary:</label>
			<?php if ($instance['member_introduction'] != '') : ?>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'member_introduction' ); ?>" name="<?php echo $this->get_field_name( 'member_introduction' ); ?>" ><?php echo $instance['member_introduction'] ?></textarea>
			<?php else : ?>
				<textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id( 'member_introduction' ); ?>" name="<?php echo $this->get_field_name( 'member_introduction' ); ?>" placeholder="Describe yourself here..." ></textarea>
			<?php endif; ?>
		</p>

	<?php
	}
}

?>
