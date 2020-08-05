<?php

class AdvertisementWidget extends WP_Widget {
	public function __construct() {
		parent::__construct(
			'advertisement_widget',
			__( 'Advertisement Widget', 'widgets-init' ),
			__( 'Our Advertisement Widget Description', 'widgets-init' )
		);
	}

	public function form( $instance ) {
		$title = isset( $instance['title'] ) ? $instance['title'] : __( 'Demo Widgets', 'widgets-demo' );
		if ( ! isset( $instance['url'] ) ) {
			$instance['url'] = '';
		}
		if ( ! isset( $instance['image'] ) ) {
			$instance['image'] = '';
		}
		?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php _e( 'Title', 'widgets-demo' ); ?>
            </label>
            <input type="text" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                   value="<?php echo esc_attr( $title ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>">
				<?php _e( 'Image', 'widgets-demo' ); ?>
            </label>
            <br>
        <p class="imagepreview"></p>
        <input type="hidden" class="imgph"
               id="<?php echo esc_attr( $this->get_field_id( 'image' ) ); ?>"
               name="<?php echo esc_attr( $this->get_field_name( 'image' ) ); ?>"
               value="<?php echo esc_attr( $instance['image'] ); ?>">

        <input type="button" class="button btn-primary widgetuploader"
               value="<?php _e( 'Add Image', 'widgets-demo' ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>">
				<?php _e( 'URL', 'widgets-demo' ); ?>
            </label>
            <input type="url" class="widefat"
                   id="<?php echo esc_attr( $this->get_field_id( 'url' ) ); ?>"
                   name="<?php echo esc_attr( $this->get_field_name( 'url' ) ); ?>"
                   value="<?php echo esc_attr( $instance['url'] ); ?>">
        </p>
		<?php
	}


	public function widget($args, $instance)
	{

		$display_image = false;
		if($instance['image']){
			$display_image=1;
			$image_src = wp_get_attachment_image_src($instance['image'],"thumbnail");
		}

		echo $args['before_widget'];
		?>
        <div class="about-widget widget">
			<?php
			if(isset($instance['title']) && $instance['title']!='') {
				echo wp_kses_post($args['before_title']);
				echo apply_filters('widget_title', $instance['title']);
				echo wp_kses_post($args['after_title']);
			}
			?>
            <div class="about-info">
				<?php if($display_image){?>
					<?php if($instance['url']){?>
                        <a target="_blank" href='<?php echo esc_url($instance['url']);?>'><img alt="<?php _e('Advertisements','demowidget');?>" src="<?php echo esc_url($image_src[0]);?>"></a>
					<?php } else {?>
                        <img alt="<?php _e('Advertisements','demowidget');?>" src="<?php echo esc_url($image_src[0]);?>">
					<?php } ?>
				<?php } ?>
            </div>
        </div>
		<?php
		echo $args['after_widget'];
	}


	public function update($new_instance, $old_instance)
	{
		$instance = array();
		$instance['title'] = sanitize_text_field($new_instance['title']);
		$instance['image'] = sanitize_text_field($new_instance['image']);
		$instance['url'] = sanitize_text_field($new_instance['url']);

		return $instance;
	}


}