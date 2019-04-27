<?php
/**
 * Implement theme metabox.
 *
 * @package Insights
 */

if ( ! function_exists( 'insights_add_theme_meta_box' ) ) :

	/**
	 * Add the Meta Box
	 *
	 * @since 1.0.0
	 */
	function insights_add_theme_meta_box() {

		$apply_metabox_post_types = array( 'post', 'page' );

		foreach ( $apply_metabox_post_types as $key => $type ) {
			add_meta_box(
				'insights-theme-settings',
				esc_html__( 'Single Page/Post Settings', 'insights' ),
				'insights_render_theme_settings_metabox',
				$type
			);
		}

	}

endif;

add_action( 'add_meta_boxes', 'insights_add_theme_meta_box' );

if ( ! function_exists( 'insights_render_theme_settings_metabox' ) ) :

	/**
	 * Render theme settings meta box.
	 *
	 * @since 1.0.0
	 */
	function insights_render_theme_settings_metabox( $post, $metabox ) {

		$post_id = $post->ID;
		$insights_post_meta_value = get_post_meta($post_id);

		// Meta box nonce for verification.
		wp_nonce_field( basename( __FILE__ ), 'insights_meta_box_nonce' );
		// Fetch Options list.
		$page_layout = get_post_meta($post_id,'insights-meta-select-layout',true);
	?>
	<div id="insights-settings-metabox-container" class="insights-settings-metabox-container">
		<div id="insights-settings-metabox-tab-layout">
			<h4><?php echo __( 'Layout Settings', 'insights' ); ?></h4>
			<div class="insights-row-content">
				 <!-- Checkbox Field-->
				     <p>
				     <div class="insights-row-content">
				         <label for="insights-meta-checkbox">
				             <input type="checkbox" name="insights-meta-checkbox" id="insights-meta-checkbox" value="yes" <?php if ( isset ( $insights_post_meta_value['insights-meta-checkbox'] ) ) checked( $insights_post_meta_value['insights-meta-checkbox'][0], 'yes' ); ?> />
				             <?php _e( 'Check To Use Featured Image As Banner Image', 'insights' )?>
				         </label>
				     </div>
				     </p>
			     <!-- Select Field-->
			        <p>
			            <label for="insights-meta-select-layout" class="insights-row-title">
			                <?php _e( 'Single Page/Post Layout', 'insights' )?>
			            </label>
			            <select name="insights-meta-select-layout" id="insights-meta-select-layout">
				            <option value="right-sidebar" <?php selected('right-sidebar',$page_layout);?>>
				            	<?php _e( 'Content - Primary Sidebar', 'insights' )?>
				            </option>
				            <option value="left-sidebar" <?php selected('left-sidebar',$page_layout);?>>
				            	<?php _e( 'Primary Sidebar - Content', 'insights' )?>
				            </option>
				            <option value="no-sidebar" <?php selected('no-sidebar',$page_layout);?>>
				            	<?php _e( 'No Sidebar', 'insights' )?>
				            </option>
			            </select>
			        </p>
			</div><!-- .insights-row-content -->
		</div><!-- #insights-settings-metabox-tab-layout -->
	</div><!-- #insights-settings-metabox-container -->

    <?php
	}

endif;



if ( ! function_exists( 'insights_save_theme_settings_meta' ) ) :

	/**
	 * Save theme settings meta box value.
	 *
	 * @since 1.0.0
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post Post object.
	 */
	function insights_save_theme_settings_meta( $post_id, $post ) {

		// Verify nonce.
		if ( ! isset( $_POST['insights_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['insights_meta_box_nonce'], basename( __FILE__ ) ) ) {
			  return; }

		// Bail if auto save or revision.
		if ( defined( 'DOING_AUTOSAVE' ) || is_int( wp_is_post_revision( $post ) ) || is_int( wp_is_post_autosave( $post ) ) ) {
			return;
		}

		// Check the post being saved == the $post_id to prevent triggering this call for other save_post events.
		if ( empty( $_POST['post_ID'] ) || $_POST['post_ID'] != $post_id ) {
			return;
		}

		// Check permission.
		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return; }
		} else if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		$insights_meta_checkbox =  isset( $_POST[ 'insights-meta-checkbox' ] ) ? esc_attr($_POST[ 'insights-meta-checkbox' ]) : '';
		update_post_meta($post_id, 'insights-meta-checkbox', sanitize_text_field($insights_meta_checkbox));

		$insights_meta_select_layout =  isset( $_POST[ 'insights-meta-select-layout' ] ) ? esc_attr($_POST[ 'insights-meta-select-layout' ]) : '';
		if(!empty($insights_meta_select_layout)){
			update_post_meta($post_id, 'insights-meta-select-layout', sanitize_text_field($insights_meta_select_layout));
		}
		$insights_meta_image_layout =  isset( $_POST[ 'insights-meta-image-layout' ] ) ? esc_attr($_POST[ 'insights-meta-image-layout' ]) : '';
		if(!empty($insights_meta_image_layout)){
			update_post_meta($post_id, 'insights-meta-image-layout', sanitize_text_field($insights_meta_image_layout));
		}
	}

endif;

add_action( 'save_post', 'insights_save_theme_settings_meta', 10, 3 );