<?php if ( ! defined('WOODMART_THEME_DIR')) exit('No direct script access allowed');

/**
 * Register twitter widget 
 */

if ( ! class_exists( 'WOODMART_Twitter' ) ) {
	class WOODMART_Twitter extends WPH_Widget {
	
		function __construct() {		
			// Configure widget array
			$args = array( 
				// Widget Backend label
				'label' => esc_html__( 'WOODMART X (Twitter)', 'woodmart' ), 
				// Widget Backend Description								
				'description' => esc_html__( 'Displays the most recent posts from your X (Twitter) Stream.', 'woodmart' ), 	
				'slug' => 'woodmart-twitter',
			 );

			// create widget
			$this->create_widget( $args );
		}

		
		// Output function

		function widget( $args, $instance )	{
			if ( $this->is_widget_preview() ) {
				return;
			}

			extract( $args );

			echo wp_kses_post( $before_widget );

			if( ! empty( $instance['title'] ) ) {
				echo wp_kses_post( $before_title ) . apply_filters( 'widget_title',  $instance['title'], $instance, $this->id_base ) . wp_kses_post( $after_title );
			}

			$widget_args = array(
				'name' 				=> $instance['name'],		
				'num_tweets'		=>	$instance['numTweets'],			
				'consumer_key'		=>	trim( $instance['consumerKey'] ),
				'consumer_secret'	=>	trim( $instance['consumerSecret'] ), 	
				'access_token'		=>	trim( $instance['accessToken'] ), 		
				'accesstoken_secret'=>	trim( $instance['accessTokenSecret'] ),
				'show_avatar'		=>	$instance['showAvatar'],
				'avatar_size'		=>	strip_tags( $instance['avatarSize'] ), 	
				'exclude_replies'	=>	$instance['exclude_replies'],	
			);
			woodmart_enqueue_inline_style( 'twitter' );
			?>
			<div class="wd-twitter-element wd-twitter-widget">
				<?php woodmart_get_twitts( $widget_args ); ?>
			</div>
			<?php

			echo wp_kses_post( $after_widget );
		}

		public function update( $new_instance, $old_instance ) {

			$instance = $old_instance;

			//Strip tags from title and name to remove HTML
			$instance['title'] 				= strip_tags( $new_instance['title'] );
			$instance['name'] 				= strip_tags( $new_instance['name'] );
			$instance['numTweets'] 			= $new_instance['numTweets'];
			$instance['consumerKey'] 		= trim( $new_instance['consumerKey'] );
			$instance['consumerSecret'] 	= trim( $new_instance['consumerSecret'] );
			$instance['accessToken'] 		= trim( $new_instance['accessToken'] );
			$instance['accessTokenSecret']  = trim( $new_instance['accessTokenSecret'] );
			$instance['showAvatar'] 		= $new_instance['showAvatar'];
			$instance['avatarSize'] 		= strip_tags( $new_instance['avatarSize'] );
			$instance['exclude_replies'] 	= $new_instance['exclude_replies'];

			return $instance;

		}

		function form( $instance ) {
			//Set up some default widget settings.
			$defaults = array(
				'title' 			=> esc_html__( 'Recent posts', 'woodmart' ), 
				'name' 				=> 'x',
				'numTweets' 		=> 4,
				'consumerKey' 		=> esc_html__( 'xxxxxxxxxxxx', 'woodmart' ),// Consumer key
				'consumerSecret' 	=> esc_html__( 'xxxxxxxxxxxx', 'woodmart' ), // Consumer secret
				'accessToken' 		=> esc_html__( 'xxxxxxxxxxxx', 'woodmart' ), // Access token
				'accessTokenSecret'	=> esc_html__( 'xxxxxxxxxxxx', 'woodmart' ),  // Access token secret
				'showAvatar'		=> false, // Show the avatar ?
				'roundCorners'		=> false, // Do we want rounded corners
				'avatarSize'		=> "", // what size should it be - defaults to 48px
				'exclude_replies'	=>	false,	
			);
			$instance = wp_parse_args( (array) $instance, $defaults );

			?>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'woodmart' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
			</p>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'X Name (without @ symbol):', 'woodmart' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['name'] ); ?>" />
			</p>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr( $this->get_field_id( 'numTweets' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'woodmart' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'numTweets' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'numTweets' ) ) ?>" type="text" value="<?php echo esc_attr ( $instance['numTweets'] ); ?>" />
			</p>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr(  $this->get_field_id( 'consumerKey' ) ); ?>"><?php esc_html_e( 'Consumer Key:', 'woodmart' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumerKey' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumerKey' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['consumerKey'] ); ?>" />
			</p>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr( $this->get_field_id( 'consumerSecret' ) ); ?>"><?php esc_html_e( 'Consumer Secret:', 'woodmart' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'consumerSecret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'consumerSecret' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['consumerSecret'] ); ?>" />
			</p>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr( $this->get_field_id( 'accessToken' ) ); ?>"><?php esc_html_e('Access Token:', 'woodmart') ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'accessToken' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'accessToken' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['accessToken'] ); ?>" />
			</p>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr( $this->get_field_id( 'accessTokenSecret' ) ); ?>"><?php esc_html_e( 'Access Token Secret:', 'woodmart' ) ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'accessTokenSecret' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'accessTokenSecret' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['accessTokenSecret'] ); ?>" />
			</p>
			<p class="wd-widget-field wd-type-checkbox">
				<label for="<?php echo esc_attr( $this->get_field_id( 'showAvatar' ) ); ?>"><?php esc_html_e('Show your avatar image', 'woodmart'); ?></label>
				<input class="checkbox" type="checkbox" value="true" <?php checked( ( isset( $instance['showAvatar'] ) && ( $instance['showAvatar'] == "true") ), true ); ?> id="<?php echo esc_attr( $this->get_field_id( 'showAvatar' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'showAvatar' ) ); ?>" />
			</p>
			<p class="wd-widget-field wd-type-checkbox">
				<label for="<?php echo esc_attr( $this->get_field_id( 'exclude_replies' ) ); ?>"><?php esc_html_e('Exclude Replies', 'woodmart'); ?></label>
				<input class="checkbox" type="checkbox" value="true" <?php checked( ( isset( $instance['exclude_replies'] ) && ( $instance['exclude_replies'] == "true") ), true ); ?> id="<?php echo esc_attr( $this->get_field_id( 'exclude_replies' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'exclude_replies' ) ); ?>" />
			</p>
			<p class="wd-widget-field">
				<label for="<?php echo esc_attr( $this->get_field_id( 'avatarSize' ) ); ?>"><?php esc_html_e( 'Size of Avatar (default: 48):', 'woodmart' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'avatarSize' ) ) ?>" name="<?php echo esc_attr( $this->get_field_name( 'avatarSize' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['avatarSize'] ); ?>" />
				<small class="description"><?php esc_html_e( 'Input number only', 'woodmart' ); ?></small>
			</p>
			<?php
		}
	}
}
