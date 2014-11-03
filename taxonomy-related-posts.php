<?php
     /*
     Plugin Name: Taxonomy Related Posts
     Plugin URI: 
     Description: A widget that lists posts related by taxonomy.
     Version: 1.0
     Author: Stefano Dotta
     Author URI: 
     */
     class Taxonomy_Related_Posts extends WP_Widget {

        function __construct() {
          
		$this->defaults = array(
			'title' => __( 'Related Posts' , 'taxonomy-related-posts'),
			'display_taxonomy_name' => false,
			'taxonomy'	=> 'post_tag',
			'post_type'	=> 'post',
			'related_count'	=> -1,
			'order' 	=> 'ASC',
			'list_type'	=> 'ul'
		);
       

               $widget_ops = array(
                    'classname' => 'taxonomy-related-posts', // SD - 2014-10-28
                    'description' => __( 'List posts related posts by taxonomy.' , 'taxonomy-related-posts')
               );
               
               $this->WP_Widget( 'taxonomy-related-posts', __( 'Taxonomy Related Posts' , 'taxonomy-related-posts'), $widget_ops );             
          }

	/* */
	function form( $instance ) {
               
		$instance = wp_parse_args( (array) $instance, $this->defaults ); 
               
		$title = $instance['title'];
		$post_type = $instance['post_type'];
		$taxonomy = $instance['taxonomy'];
		$related_count = $instance['related_count'];
		$display_taxonomy_name = $instance['display_taxonomy_name'];
                              
               /* Order options. */
		$order = array(
			'ASC'  => __( 'Ascending', 'taxonomy-related-posts' ),
			'DESC' => __( 'Descending', 'taxonomy-related-posts' )
		);
		
		$list_type = array(
			'ol' => __( 'Ordered list', 'taxonomy-related-posts' ),
			'ul' => __( 'Unordered list', 'taxonomy-related-posts' )
		);
		
		
               ?>
               
		<p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>">
                <?php _e( 'Title:' , 'taxonomy-related-posts'); ?><input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo attribute_escape( $title ); ?>" />
		</label>
		</p>
               
		<p>
		<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('display_taxonomy_name'); ?>" name="<?php echo $this->get_field_name('display_taxonomy_name'); ?>" value="1" <?php checked( $instance['display_taxonomy_name'] ); ?> />
		<label for="<?php echo $this->get_field_id('display_taxonomy_name'); ?>"><?php _e( 'Display taxonomy name as subtitle.', 'taxonomy-related-posts' ); ?></label>
		</p>	
                              
		<p>
		<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>">
                <?php _e( 'Taxonomy to use:' , 'taxonomy-related-posts'); ?><select class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>"><?php
                        $taxonomies = get_taxonomies( array( 'show_ui' => true ), 'objects' );
                        foreach ( $taxonomies as $slug => $tax ): ?>
                        	<option value="<?php echo $slug; ?>" <?php echo ( $slug == $taxonomy ) ? 'selected="selected"' : ''; ?>><?php echo $tax->labels->name; ?></option><?php
                        endforeach; ?>
                         </select>
		</label>
		</p>
               
		<p>
		<label for="<?php echo $this->get_field_id( 'post_type' ); ?>">
		<?php _e( 'Post type to use:' , 'taxonomy-related-posts'); ?><select class="widefat" id="<?php echo $this->get_field_id( 'post_type' ); ?>" name="<?php echo $this->get_field_name( 'post_type' ); ?>"><?php
			$post_types = get_post_types( array( 'show_ui' => true, 'public' => true ), 'objects', 'and' );
			foreach ( $post_types as $slug => $pt ): ?>
				<option value="<?php echo $slug; ?>" <?php echo ( $slug == $post_type ) ? 'selected="selected"' : ''; ?>><?php echo $pt->labels->name; ?></option><?php
			endforeach; ?>
			</select>
		</label>
		</p>
               
		<p>
		<label for="<?php echo $this->get_field_id( 'order' ); ?>"><?php _e( 'List sorting order:', 'taxonomy-related-posts' ); ?></label> 
		<select class="widefat" id="<?php echo $this->get_field_id( 'order' ); ?>" name="<?php echo $this->get_field_name( 'order' ); ?>">
			<?php foreach ( $order as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['order'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
		</p>
               
		<p>
		<label for="<?php echo $this->get_field_id( 'list_type' ); ?>"><?php _e( 'List format for display:', 'taxonomy-related-posts' ); ?></label> 
		<select class="widefat" id="<?php echo $this->get_field_id( 'list_type' ); ?>" name="<?php echo $this->get_field_name( 'list_type' ); ?>">
			<?php foreach ( $list_type as $option_value => $option_label ) { ?>
				<option value="<?php echo esc_attr( $option_value ); ?>" <?php selected( $instance['list_type'], $option_value ); ?>><?php echo esc_html( $option_label ); ?></option>
			<?php } ?>
		</select>
		</p>

		<p>
                <label for="<?php echo $this->get_field_id( 'related_count' ); ?>"></label> 
		<?php _e( 'Number of posts to show (use -1 to show all posts):' , 'taxonomy-related-posts'); ?><input class="widefat" id="<?php echo $this->get_field_id( 'related_count' ); ?>" name="		<?php echo $this->get_field_name( 'related_count' ); ?>" type="text" value="<?php echo attribute_escape( $related_count ); ?>" />
		</p>

                              
               <?php

	}


	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['post_type'] = $new_instance['post_type'];
		$instance['order'] = strip_tags( $new_instance['order'] );
		$instance['related_count'] = $new_instance['related_count'];
		$instance['taxonomy'] = $new_instance['taxonomy'];
		$instance['display_taxonomy_name'] = (bool)$new_instance['display_taxonomy_name'];
		$instance['list_type'] = $new_instance['list_type'];
		return $instance;
		
	}


	function widget( $args, $instance ) {
	
		if ( !is_singular() ) {
			return;
		}
		
		extract( $args, EXTR_SKIP );
               
		$instance = wp_parse_args( (array) $instance, $this->defaults ); 
             
		$post_type = $instance['post_type'];
		$display_taxonomy_name = $instance['display_taxonomy_name'];
		$related_count = $instance['related_count'];
		$order = $instance['order'];
		$taxonomy = ( $instance['taxonomy'] == "" ) ? 'post_tag' : $instance['taxonomy'];
		$list_type = $instance['list_type'];
		
		$opening_list_tag = '<ul>';
		$closing_list_tag = '</ul>';
		$output = '';
		$post_id = 0;
		            	
		$terms = get_the_terms( get_the_ID(), $taxonomy );
		$terms = reset( $terms );			
		
		if ( empty( $terms ) ) {
			return;
		}
			
		$post_id = get_the_ID();
		if ( empty( $post_id ) ) {
			return;
		}
		
		// standard
		echo $before_widget;
		
		$title = empty( $instance['title'] ) ? ' ' : apply_filters( 'widget_title', $instance['title'] );
		if ( !empty( $title ) ) {
			echo $before_title . $title . $after_title;
		}
		
		if ( $display_taxonomy_name ) {
			$subtitle = '<h4 class="widget-subtitle widgetsubtitle">' .  $terms->name . '</h4>';
			echo $subtitle;
		}
		
		if ( $list_type == 'ol' ) {
			$opening_list_tag = '<ol>';
			$closing_list_tag = '</ol>';
		}	
		
		$query = array(
			'posts_per_page' => $related_count,
			'order'          => $order,
			'post_type' 	 => $post_type,
			'tax_query' => array(
				array(
					'taxonomy' => $taxonomy,
					'terms'	   => $terms->slug,
					'field'    => 'slug',
					'operator' => 'IN'
				     )
				)
		);

		$loop = new WP_Query( $query );

		if ( $loop->have_posts() ) {

			$output .= $opening_list_tag;

			while ( $loop->have_posts() ) {

				$loop->the_post();
				
				$output .= $post_id === get_the_ID() ? the_title( '<li>', '</li>', false ) : the_title( '<li><a href="' . get_permalink() . '">', '</a></li>', false );
			}
			
			$output .= $closing_list_tag;	
		}
		
		wp_reset_postdata();
            	
		echo $output;
		
		// standard 	 	
		echo $after_widget;               
		
	}

     }

// register Taxonomy Related Posts widget
function register_taxonomy_related_posts_widget() {
    register_widget( 'Taxonomy_Related_Posts' );
}

add_action( 'widgets_init', 'register_taxonomy_related_posts_widget' );