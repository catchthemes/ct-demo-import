<?php
/**
 * The template for displaying meta box in page/post
 *
 * This adds Select Sidebar, Header Featured Image Options, Single Page/Post Image Layout
 * This is only for the design purpose and not used to save any content
 *
 * @package Catch_Sketch
 */



/**
 * Class to Renders and save metabox options
 *
 * * @since 1.0
 */
class Catch_Sketch_Metabox {
	private $meta_box;

	private $fields;

	/**
	* Constructor
	*
	* * @since 1.0
	*
	* @access public
	*
	*/
	public function __construct( $meta_box_id, $meta_box_title, $post_type ) {

		$this->meta_box = array (
			'id' 		=> $meta_box_id,
			'title' 	=> $meta_box_title,
			'post_type' => $post_type,
		);

		$this->fields = array(
			'catch-sketch-header-image',
			'catch-sketch-sidebar-option',
			'catch-sketch-featured-image',
		);


		// Add metaboxes
		add_action( 'add_meta_boxes', array( $this, 'add' ) );

		add_action( 'save_post', array( $this, 'save' ) );
	}

	/**
	* Add Meta Box for multiple post types.
	*
	* * @since 1.0
	*
	* @access public
	*/
	public function add( $post_type ) {
		add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $post_type, 'side', 'high' );
	}

	/**
	* Renders metabox
	*
	* * @since 1.0
	*
	* @access public
	*/
	public function show() {
		global $post;

		$sidebar_options = array(
			'default-sidebar'        => esc_html__( 'Default Sidebar', 'catch-sketch-pro' ),
			'optional-sidebar-one'   => esc_html__( 'Optional Sidebar One', 'catch-sketch-pro' ),
			'optional-sidebar-two'   => esc_html__( 'Optional Sidebar Two', 'catch-sketch-pro' ),
			'optional-sidebar-three' => esc_html__( 'Optional Sidebar three', 'catch-sketch-pro' ),
		);

		$header_image_options 	= array(
			'default' => esc_html__( 'Default', 'catch-sketch-pro' ),
			'enable'  => esc_html__( 'Enable', 'catch-sketch-pro' ),
			'disable' => esc_html__( 'Disable', 'catch-sketch-pro' ),
		);

		$featured_image_options	= array(
			'disabled'                 => esc_html__( 'Disabled', 'catch-sketch-pro' ),
			'default'                  => esc_html__( 'Default', 'catch-sketch-pro' ),
			'post-thumbnail'           => esc_html__( 'Post Thumbnail (1060x596)', 'catch-sketch-pro' ),
			'catch-sketch-featured' => esc_html__( 'Featured (664x373)', 'catch-sketch-pro' ),
			'full'                     => esc_html__( 'Original Image Size', 'catch-sketch-pro' ),
		);


		// Use nonce for verification
		wp_nonce_field( basename( __FILE__ ), 'catch_sketch_custom_meta_box_nonce' );

		// Begin the field table and loop  ?>
		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="catch-sketch-sidebar-option"><?php esc_html_e( 'Select Sidebar', 'catch-sketch-pro' ); ?></label></p>
		<select class="widefat" name="catch-sketch-sidebar-option" id="catch-sketch-sidebar-option">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'catch-sketch-sidebar-option', true );
				
				if ( empty( $meta_value ) ){
					$meta_value='default';
				}
				
				foreach ( $sidebar_options as $field =>$label ) {	
				?>
					<option value="<?php echo esc_attr( $field ); ?>" <?php selected( $meta_value, $field ); ?>><?php echo esc_html( $label ); ?></option>
				<?php
				} // end foreach
			?>
		</select>
		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="catch-sketch-header-image"><?php esc_html_e( 'Header Featured Image Options', 'catch-sketch-pro' ); ?></label></p>
		<select class="widefat" name="catch-sketch-header-image" id="catch-sketch-header-image">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'catch-sketch-header-image', true );
				
				if ( empty( $meta_value ) ){
					$meta_value='default';
				}
				
				foreach ( $header_image_options as $field =>$label ) {	
				?>
					<option value="<?php echo esc_attr( $field ); ?>" <?php selected( $meta_value, $field ); ?>><?php echo esc_html( $label ); ?></option>
				<?php
				} // end foreach
			?>
		</select>

		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="catch-sketch-featured-image"><?php esc_html_e( 'Single Page/Post Image', 'catch-sketch-pro' ); ?></label></p>
		<select class="widefat" name="catch-sketch-featured-image" id="catch-sketch-featured-image">
			 <?php
				$meta_value = get_post_meta( $post->ID, 'catch-sketch-featured-image', true );
				
				if ( empty( $meta_value ) ){
					$meta_value='default';
				}
				
				foreach ( $featured_image_options as $field =>$label ) {	
				?>
					<option value="<?php echo esc_attr( $field ); ?>" <?php selected( $meta_value, $field ); ?>><?php echo esc_html( $label ); ?></option>
				<?php
				} // end foreach
			?>
		</select>

		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="catch-sketch-event-date-day"><?php esc_html_e( 'Events Date Day', 'catch-sketch-pro' ); ?></label></p>
		<?php
			$value = get_post_meta( $post->ID, 'catch-sketch-event-date-day', true );

			if ( ! $value ) {
				$value = 1;
			}
		?>
		<input class="widefat ct-event-date" type="number" min="1" max="31" name="catch-sketch-event-date-day" value="<?php echo esc_attr( $value ); ?>"/>

		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="catch-sketch-event-date-month"><?php esc_html_e( 'Events Date Month', 'catch-sketch-pro' ); ?></label></p>
		<?php
			$month_value = get_post_meta( $post->ID, 'catch-sketch-event-date-month', true );

			if ( ! $month_value ) {
				$month_value = 1;
			} 
		?>
		<input class="widefat ct-event-time" type="number" min="1" max="12" name="catch-sketch-event-date-month" value="<?php echo esc_attr( $month_value ); ?>"/>

		<p class="post-attributes-label-wrapper"><label class="post-attributes-label" for="catch-sketch-event-date-year"><?php esc_html_e( 'Events Date Year', 'catch-sketch-pro' ); ?></label></p>
		<?php
			$year_value = get_post_meta( $post->ID, 'catch-sketch-event-date-year', true );
		?>
		<input class="widefat ct-event-time" type="number" min="1000" placeholder="<?php echo wp_date( 'Y' ); ?>" max="9999" name="catch-sketch-event-date-year" value="<?php echo esc_attr( $year_value ); ?>"/>
		<?php
	}

	/**
	 * Save custom metabox data
	 *
	 * @action save_post
	 *
	 * * @since 1.0
	 *
	 * @access public
	 */
	public function save( $post_id ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
		|| ( ! in_array( $post_type, $this->meta_box['post_type'] ) )                  // Check if current post type is supported.
		|| ( ! check_admin_referer( basename( __FILE__ ), 'catch_sketch_custom_meta_box_nonce') )    // Check nonce - Security
		|| ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
		{
		  return $post_id;
		}

		foreach ( $this->fields as $field ) {
			$new = $_POST[ $field ];

			delete_post_meta( $post_id, $field );

			if ( '' == $new || array() == $new ) {
				return;
			} else {
				if ( ! update_post_meta ( $post_id, $field, sanitize_key( $new ) ) ) {
					add_post_meta( $post_id, $field, sanitize_key( $new ), true );
				}
			}
		} // end foreach

		//Validation for event extra options
		$date_day = $_POST['catch-sketch-event-date-day'];
		if ( '' != $date_day ) {
			if ( ! update_post_meta( $post_id, 'catch-sketch-event-date-day', absint( $date_day ) ) ) {
				add_post_meta( $post_id, 'catch-sketch-event-date-day', absint( $date_day ), true );
			}
		}

		$date_month = $_POST['catch-sketch-event-date-month'];
		if ( '' != $date_month ) {
			if ( ! update_post_meta( $post_id, 'catch-sketch-event-date-month', absint( $date_month ) ) ) {
				add_post_meta( $post_id, 'catch-sketch-event-date-month', absint( $date_month ), true );
			}
		}

		$date_year = $_POST['catch-sketch-event-date-year'];
		if ( ! update_post_meta( $post_id, 'catch-sketch-event-date-year', absint( $date_year ) ) ) {
			add_post_meta( $post_id, 'catch-sketch-event-date-year', absint( $date_year ), true );
		}
	}
}

$catch_sketch_metabox = new Catch_Sketch_Metabox(
	'catch-sketch-options', 					//metabox id
	esc_html__( 'Catch Sketch Pro Options', 'catch-sketch-pro' ), //metabox title
	array( 'page', 'post' )				//metabox post types
);
