<?php



class proper_lite_action extends WP_Widget {



// constructor

    function proper_lite_action() {

		$widget_ops = array('classname' => 'proper_lite_action_widget', 'description' => esc_html__( 'Create a call-to-action for a home page widget area.', 'proper-lite') );

        parent::__construct(false, $name = esc_html__('MT - Call-to-Action', 'proper-lite'), $widget_ops);  

		$this->alt_option_name = 'proper_lite_action_widget';

		

		add_action( 'save_post', array($this, 'flush_widget_cache') );

		add_action( 'deleted_post', array($this, 'flush_widget_cache') );

		add_action( 'switch_theme', array($this, 'flush_widget_cache') );		

    }

	

	// widget form creation

	function form($instance) {



	// Check values

		$title     			= isset( $instance['title'] ) ? wp_kses_post( $instance['title'] ) : '';

		$action_text 		= isset( $instance['action_text'] ) ? wp_kses_post( $instance['action_text'] ) : '';

		$action_btn_link 	= isset( $instance['action_btn_link'] ) ? esc_url( $instance['action_btn_link'] ) : '';

		$action_btn_text 	= isset( $instance['action_btn_text'] ) ? esc_html( $instance['action_btn_text'] ) : '';
		

	?>



	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'proper-lite'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('title')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('title')); ?>" type="text" value="<?php echo wp_kses_post( $title ); ?>" />

	</p>



	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('action_text')); ?>"><?php esc_html_e('Enter your call to action.', 'proper-lite'); ?></label>

	<textarea class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('action_text')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('action_text')); ?>"><?php echo wp_kses_post( $action_text ); ?></textarea>

	</p>



	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('action_btn_link')); ?>"><?php esc_html_e('Link for the button', 'proper-lite'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('action_btn_link')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('action_btn_link')); ?>" type="text" value="<?php echo esc_url( $action_btn_link ); ?>" />

	</p>



	<p>

	<label for="<?php echo sanitize_text_field( $this->get_field_id('action_btn_text')); ?>"><?php esc_html_e('Title for the button', 'proper-lite'); ?></label>

	<input class="widefat" id="<?php echo sanitize_text_field( $this->get_field_id('action_btn_text')); ?>" name="<?php echo sanitize_text_field( $this->get_field_name('action_btn_text')); ?>" type="text" value="<?php echo esc_html( $action_btn_text ); ?>" />

	</p>
    
    

	<?php

	}



	// update widget

	function update($new_instance, $old_instance) {

		$instance = $old_instance;

		$instance['title'] 			 = wp_kses_post($new_instance['title']);

		$instance['action_text'] 	 = wp_kses_post($new_instance['action_text']);

		$instance['action_btn_link'] = esc_url_raw($new_instance['action_btn_link']);

		$instance['action_btn_text'] = esc_html($new_instance['action_btn_text']);		

		$this->flush_widget_cache();



		$alloptions = wp_cache_get( 'alloptions', 'options' );

		if ( isset($alloptions['proper_lite_action']) )

			delete_option('proper_lite_action');		  

		  

		return $instance;

	}

	

	function flush_widget_cache() {

		wp_cache_delete('proper_lite_action', 'widget');

	}

	

	// display widget

	function widget($args, $instance) {

		$cache = array();

		if ( ! $this->is_preview() ) {

			$cache = wp_cache_get( 'proper_lite_action', 'widget' );

		}



		if ( ! is_array( $cache ) ) {

			$cache = array();

		}



		if ( ! isset( $args['widget_id'] ) ) {

			$args['widget_id'] = $this->id;

		}



		if ( isset( $cache[ $args['widget_id'] ] ) ) {

			echo wp_kses_post( $cache[ $args['widget_id'] ] ); 

			return;

		}



		ob_start();

		extract($args);



		$title 			 = ( ! empty( $instance['title'] ) ) ? wp_kses_post( $instance['title'] ) : '';

		$title 			 = apply_filters( 'widget_title', wp_kses_post( $title ), $instance, $this->id_base );

		$action_text 	 = isset( $instance['action_text'] ) ? wp_kses_post($instance['action_text']) : ''; 

		$action_btn_link = isset( $instance['action_btn_link'] ) ? esc_url($instance['action_btn_link']) : '';

		$action_btn_text = isset( $instance['action_btn_text'] ) ? esc_html($instance['action_btn_text']) : '';


?>

		<section id="home-cta" class="action-area">

			<div class="grid grid-pad">
            
            	<div class="col-1-1">

				<?php if ( $title ) echo wp_kses_post( $before_title ) . wp_kses_post( $title ) . $after_title; ?> 

				<?php if ($action_text !='') : ?>				

				<p><?php echo wp_kses_post( $action_text ); ?></p>

				<?php endif; ?>

				
                
                </div> 

			</div>	
            
            <?php if ($action_btn_link !='') : ?>

					<a href="<?php echo esc_url( $action_btn_link ); ?>" class="call-to-action">
                    
						<button><?php echo esc_html( $action_btn_text ); ?></button>
                    
                    </a>

			<?php endif; ?>										

		</section>		

	<?php



		if ( ! $this->is_preview() ) {

			$cache[ $args['widget_id'] ] = ob_get_flush(); 

			wp_cache_set( 'proper_lite_action', $cache, 'widget' ); 

		} else {

			ob_end_flush(); 

		}

	}

	

}