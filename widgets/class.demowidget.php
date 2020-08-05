<?php

class DemoWidget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'demowidget',
			__( 'Demo Widget', 'widgets-demo' ),
			__( 'Our Demo Widget Description', 'widgets-demo' )
		);
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? $instance['title'] : __( 'Demo Widgets', 'widgets-demo' );
		$latitude  = isset( $instance['latitude'] ) ? $instance['latitude'] : 23.9;
		$longitude = isset( $instance['longitude'] ) ? $instance['longitude'] : 21.4;
		$email     = isset( $instance['email'] ) ? $instance['email'] : 'admin@saberhr.com';
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php _e( 'Title', 'widgets-demo' ); ?>
            </label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $title ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>">
				<?php _e( 'Latitude', 'widgets-demo' ); ?>
            </label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>"
                   value="<?php echo esc_attr( $latitude ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'latitude' ) ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>">
				<?php _e( 'Longitude', 'widgets-demo' ); ?>
            </label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>"
                   value="<?php echo esc_attr( $longitude ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'longitude' ) ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>">
				<?php _e( 'Email', 'widgets-demo' ); ?>
            </label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'email' ) ); ?>"
                   value="<?php echo esc_attr( $email ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'email' ) ); ?>">
        </p>

		<?php
	}


	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		if ( isset( $instance['title'] ) && $instance['title'] != '' ) {
			echo $args['before_title'];
			echo apply_filters( 'widget_title', $instance['title'] );
			echo $args['after_title'];

			?>
            <div class="demowidget">
                <p>
					<?php
					_e( 'Latitude', 'widgets-demo' );
					echo ": ";
					echo isset( $instance['latitude'] ) ? $instance['latitude'] : 'N/A';
					?>
                </p>

                <p>
					<?php
					_e( 'Longitude', 'widgets-demo' );
					echo ": ";
					echo isset( $instance['longitude'] ) ? $instance['longitude'] : 'N/A';
					?>
                </p>
            </div>
			<?php
		}

		echo $args['after_widget'];
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $new_instance;
		if ( ! is_email( $new_instance['email'] ) ) {
			$instance['email'] = $old_instance['email'];
		}

		if ( ! is_numeric( $new_instance['longitude'] ) ) {
			$instance['longitude'] = $old_instance['longitude'];
		}

		if ( ! is_numeric( $new_instance['latitude'] ) ) {
			$instance['latitude'] = $old_instance['latitude'];
		}

		$instance['title'] = sanitize_text_field( $instance['title'] );

		return $instance;

	}


}


