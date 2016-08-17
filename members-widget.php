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
	public function __construct() {
		parent::__construct(
			'Members_Post_Widget',
			'Members Post',
			array(
				'description' => 'Displays members in your web',
			)
		);
	}

// front-end
	function widget( $args, $instance ) {
		extract( $args );

    $MWK_plugin_path = plugin_dir_url( __FILE__ );
		/* Our variables from the widget settings. */
		$MWK_name          = $instance['member_name'];
		$MWK_introduction  = $instance['member_introduction'];
		$MWK_email         = $instance['member_email'];
		$MWK_number        = $instance['member_phone_number'];
		$MWK_address       = $instance['member_address'];
		$MWK_facebook      = $instance['member_facebook'];
		$MWK_twitter       = $instance['member_twitter'];
		$MWK_google        = $instance['member_google'];
		$MWK_instagram     = $instance['member_instagram'];
		$MWK_linkedin      = $instance['member_linkedin'];
		$MWK_image         = isset($instance['member_image'])?$instance['member_image']:"";

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display name from widget settings if one was input. */

		if ( is_home() || is_font_page() ) {
			if ( $MWK_image ) {
				echo "<div class='MWK_home_image'><img src='" . $MWK_image . "'></div>";
			} else {
				echo "<div class='MWK_home_image'><img src='" . $MWK_plugin_path . "image/Person-icon-grey.JPG'></div>";
			}
			echo $before_title . $MWK_name . $after_title;

			$social_num = 0;
			$SocialReturn = "";
			if  ( $MWK_email || $MWK_facebook || $MWK_twitter || $MWK_google || $MWK_instagram || $MWK_linkedin ) {
				if ( $MWK_email ) {
					$SocialReturn .= "<li class='MWK_MS_EM MWK_MSh_li'><a href='mailto:" . $MWK_email . "'><img src='" . $MWK_plugin_path . "image/mail-green.png'></a></li>";
					$social_num ++;
				}
		  	if ( $MWK_facebook ) {
					$SocialReturn .= "<li class='MWK_MS_FB MWK_MSh_li'><a href='" . $MWK_facebook . "'><img src='" . $MWK_plugin_path . "image/MWK_facebook.svg'></a></li>";
					$social_num ++;
				}
  			if ( $MWK_twitter ) {
					$SocialReturn .= "<li class='MWK_MS_TW MWK_MSh_li'><a href='" . $MWK_twitter . "'><img src='" . $MWK_plugin_path . "image/MWK_twitter.svg'></a></li>";
					$social_num ++;
				}
	  		if ( $MWK_google ) {
					$SocialReturn .= "<li class='MWK_MS_G+ MWK_MSh_li'><a href='" . $MWK_google . "'><img src='" . $MWK_plugin_path . "image/MWK_google_plus.svg'></a></li>";
					$social_num ++;
				}
		  	if ( $MWK_instagram ) {
					$SocialReturn .= "<li class='MWK_MS_ins MWK_MSh_li'><a href='" . $MWK_instagram . "'><img src='" . $MWK_plugin_path . "image/MWK_instagram.svg'></a></li>";
					$social_num ++;
				}
			  if ( $MWK_linkedin ) {
					$SocialReturn .= "<li class='MWK_MS_IN MWK_MSh_li'><a href='" . $MWK_linkedin . "'><img src='" . $MWK_plugin_path . "image/MWK_linkedin.svg'></a></li>";
					$social_num ++;
				}

			}

			if ( $SocialReturn ) {
				echo "<div id='Members' class='MWK_home_member' style='width:" . $social_num * 30 . "px'><ul class='MWK_home_member_ul'>";
				echo $SocialReturn;
				echo "<div class='MWK_clear'></div></ul></div>";
			}
			// is_home
		} else {
			echo $before_title . $MWK_name . $after_title;
		  echo "<div id='Members' class='MWK_Members_box'>";
		/* If show announcement was selected, display the announcement. */
	  	if ( $MWK_introduction ) { echo '<p>' . $MWK_introduction . '</p>'; }
  		echo "<div class='MWK_link'>";
  		if ( $MWK_email  ) { echo '<div class="MWK_Members_list"><img src="' . $MWK_plugin_path . 'image/mail-green.png"><a href="mailto:' . $MWK_email . '">' . $MWK_email . '</a></div>'; }
	  	if ( $MWK_number ) { echo '<div class="MWK_Members_list"><img src="' . $MWK_plugin_path . 'image/telephone-blue.png">' . $MWK_number . '</div>'; }
	  	echo "<div class='MWK_clear'></div>";
		  echo "</div><!-- .MWK_Members_box -->";
    /* if have social url */
  		if ( $MWK_facebook || $MWK_twitter || $MWK_google || $MWK_instagram || $MWK_linkedin ) {
	   		echo "<ul class='MWK_member_social_ul'>";
		  	if ( $MWK_facebook  ) { echo "<li class='MWK_MS_FB MWK_MS_li'><a href=' . $MWK_facebook . '><img src='" . $MWK_plugin_path . "image/MWK_facebook.svg'></a></li>"; }
  			if ( $MWK_twitter   ) { echo "<li class='MWK_MS_TW MWK_MS_li'><a href=' . $MWK_twitter . '>Twitter</a></li>"; }
	  		if ( $MWK_google    ) { echo "<li class='MWK_MS_G+ MWK_MS_li'><a href=' . $MWK_google . '>Twitter</a></li>"; }
		  	if ( $MWK_instagram ) { echo "<li class='MWK_MS_ins MWK_MS_li'><a href='. $MWK_instagram . '>Twitter</a></li>"; }
			  if ( $MWK_linkedin  ) { echo "<li class='MWK_MS_IN MWK_MS_li'><a href=' . $MWK_linkedin . '>Twitter</a></li>"; }
		  	echo "<div class='MWK_clear'></div>";
			  echo '</ul>';
		  }

		if ( $MWK_address ) { echo '<p>Address: ' . $MWK_address . '</p>'; }
    echo "<div class='MWK_clear'></div>";
		echo "</div>";
	  }
		/* After widget (defined by themes). */
		echo $after_widget;
	}

// update
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['member_name']         = strip_tags( $new_instance['member_name'] );
		$instance['member_introduction'] = esc_textarea( $new_instance['member_introduction'] );
		$instance['member_email']        = strip_tags( $new_instance['member_email'] );
		$instance['member_phone_number'] = strip_tags( $new_instance['member_phone_number'] );
		$instance['member_address']      = strip_tags( $new_instance['member_address'] );
		$instance['member_facebook']     = esc_url( $new_instance['member_facebook'] );
		$instance['member_twitter']      = esc_url( $new_instance['member_twitter'] );
		$instance['member_google']       = esc_url( $new_instance['member_google'] );
		$instance['member_instagram']    = esc_url( $new_instance['member_instagram'] );
		$instance['member_linkedin']     = esc_url( $new_instance['member_linkedin'] );
		$instance['member_image']        = esc_url( $new_instance['member_image'] );

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
			'member_image'        => '',
		   );
		$instance = wp_parse_args( (array) $instance, $defaults );
		$mem_email     = ($instance['member_email']=='')        ? 'placeholder="enter email"'        : 'value="' . $instance['member_email'] . '"';
		$mem_phone     = ($instance['member_phone_number']=='') ? 'placeholder="enter phone number"' : 'value="' . $instance['member_phone_number'] . '"';
		$mem_address   = ($instance['member_address']=='')      ? 'placeholder="enter address"'      : 'value="' . $instance['member_address'] . '"';
		$mem_facebook  = ($instance['member_facebook']=='')     ? 'placeholder="enter facebook"'     : 'value="' . $instance['member_facebook'] . '"';
		$mem_twitter   = ($instance['member_twitter']=='')      ? 'placeholder="enter twitter"'      : 'value="' . $instance['member_twitter'] . '"';
		$mem_google    = ($instance['member_google']=='')       ? 'placeholder="enter google+"'      : 'value="' . $instance['member_google'] . '"';
		$mem_instagram = ($instance['member_instagram']=='')    ? 'placeholder="enter instagram"'    : 'value="' . $instance['member_instagram'] . '"';
		$mem_linkedin  = ($instance['member_linkedin']=='')     ? 'placeholder="enter linkedin"'     : 'value="' . $instance['member_linkedin'] . '"';
		$mem_image     = ($instance['member_image']=='')        ? 'placeholder="enter img url"'      : 'value="' . $instance['member_image'] . '"';
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
<?php // input Google ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_google' ); ?>">Google Plus:</label>
			<input id="<?php echo $this->get_field_id( 'member_google' ); ?>" name="<?php echo $this->get_field_name( 'member_google' ); ?>" <?php echo $mem_google; ?> style='width:100%;' type='url'>
		</p>
<?php // input Instagram ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_instagram' ); ?>">Instagram:</label>
			<input id="<?php echo $this->get_field_id( 'member_instagram' ); ?>" name="<?php echo $this->get_field_name( 'member_instagram' ); ?>" <?php echo $mem_instagram; ?> style='width:100%;' type='url'>
		</p>
<?php // input Linkedin ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_linkedin' ); ?>">Linkedin:</label>
			<input id="<?php echo $this->get_field_id( 'member_linkedin' ); ?>" name="<?php echo $this->get_field_name( 'member_linkedin' ); ?>" <?php echo $mem_linkedin; ?> style='width:100%;' type='url'>
		</p>
<?php // input image url ?>
		<p>
			<label for="<?php echo $this->get_field_id( 'member_image' ); ?>">Image url:</label>
			<input id="<?php echo $this->get_field_id( 'member_image' ); ?>" name="<?php echo $this->get_field_name( 'member_image' ); ?>" <?php echo $mem_image; ?> style='width:100%;' type='url'>
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

function members_widget_style(){
	# code...
	wp_enqueue_style('members_widget', plugin_dir_url( __FILE__ ) . 'css/MWK_widget.css');
}

add_action( 'wp_enqueue_scripts', 'members_widget_style' );

?>
