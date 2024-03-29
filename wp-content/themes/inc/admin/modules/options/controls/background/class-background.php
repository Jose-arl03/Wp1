<?php
/**
 * Set element background options and generate css.
 *
 * @package xts
 */

namespace XTS\Admin\Modules\Options\Controls;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Direct access not allowed.
}

use XTS\Admin\Modules\Options\Field;

/**
 * Background properties control.
 */
class Background extends Field {

	/**
	 * Displays the field control HTML.
	 *
	 * @since 1.0.0
	 *
	 * @return void.
	 */
	public function render_control() {
		$value = $this->get_field_value();
		$style = '';

		if ( ! empty( $value['color'] ) || ! empty( $value['id'] ) ) {
			if ( ! empty( $value['color'] ) ) {
				$style .= ' background-color:' . $value['color'] . ';';
			}
			if ( ! empty( $value['id'] ) ) {
				$style .= ' background-image: url(' . wp_get_attachment_image_url( $value['id'] ) . '); ';
			}
			if ( ! empty( $value['repeat'] ) ) {
				$style .= ' background-repeat:' . $value['repeat'] . ';';
			}
			if ( ! empty( $value['size'] ) ) {
				$style .= ' background-size:' . $value['size'] . ';';
			}
			if ( ! empty( $value['attachment'] ) ) {
				$style .= ' background-attachment:' . $value['attachment'] . ';';
			}
			if ( ! empty( $value['position'] ) ) {
				$style .= ' background-position:' . $value['position'] . ';';
			}

			if ( $style ) {
				$style .= ' height: 100px';
			}
		}

		?>
			<div class="xts-bg-source">
				<div class="xts-bg-color">
					<input type="text" class="color-picker" data-alpha-enabled="<?php echo isset( $this->args['alpha'] ) ? esc_attr( $this->args['alpha'] ) : 'true'; ?>" name="<?php echo esc_attr( $this->get_input_name( 'color' ) ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'color' ) ); ?>" />
				</div>
				<div class="xts-bg-image">
					<div class="xts-upload-preview<?php echo ( isset( $value['url'] ) && ! empty( $value['url'] ) ) ? ' xts-preview-shown' : ''; ?>">
						<?php if ( isset( $value['url'] ) && ! empty( $value['url'] ) ) : ?>
							<img src="<?php echo esc_url( $value['url'] ); ?>">
						<?php endif ?>
					</div>
				</div>
				<div class="xts-upload-btns">
					<button class="xts-btn xts-upload-btn xts-i-import"><?php esc_html_e( 'Upload', 'woodmart' ); ?></button>
					<button class="xts-btn xts-color-warning xts-remove-upload-btn xts-i-trash<?php echo ( isset( $value['url'] ) && ! empty( $value['url'] ) ) ? ' xts-active' : ''; ?>"><?php esc_html_e( 'Remove', 'woodmart' ); ?></button>
					<input type="hidden" class="xts-upload-input-url" name="<?php echo esc_attr( $this->get_input_name( 'url' ) ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'url' ) ); ?>" />
					<input type="hidden" class="xts-upload-input-id" name="<?php echo esc_attr( $this->get_input_name( 'id' ) ); ?>" value="<?php echo esc_attr( $this->get_field_value( 'id' ) ); ?>" />
				</div>
			</div>

			<div class="xts-bg-controls xts-row xts-sp-10">
				<div class="xts-col-xl-6 xts-col-12">
					<div class="xts-bg-image-options xts-row xts-sp-10<?php echo empty( $value['url'] ) ? ' xts-hidden' : ''; ?>">
						<div class="xts-col-lg-6 xts-col-12">
							<select class="xts-bg-repeat" data-placeholder="<?php esc_attr_e( 'Background repeat', 'woodmart' ); ?>" name="<?php echo esc_attr( $this->get_input_name( 'repeat' ) ); ?>">
								<option value=""></option>
								<option value="no-repeat" <?php selected( $this->get_field_value( 'repeat' ), 'no-repeat' ); ?>>No Repeat</option>
								<option value="repeat" <?php selected( $this->get_field_value( 'repeat' ), 'repeat' ); ?>>Repeat</option>
								<option value="repeat-x" <?php selected( $this->get_field_value( 'repeat' ), 'repeat-x' ); ?>>Repeat Horizontally</option>
								<option value="repeat-y" <?php selected( $this->get_field_value( 'repeat' ), 'repeat-y' ); ?>>Repeat Vertically</option>
								<option value="inherit" <?php selected( $this->get_field_value( 'repeat' ), 'inherit' ); ?>>Inherit</option>
							</select>
						</div>
						<div class="xts-col-lg-6 xts-col-12">
							<select class="xts-bg-size" data-placeholder="<?php esc_attr_e( 'Background size', 'woodmart' ); ?>" name="<?php echo esc_attr( $this->get_input_name( 'size' ) ); ?>">
								<option value=""></option>
								<option value="cover" <?php selected( $this->get_field_value( 'size' ), 'cover' ); ?>>Cover</option>
								<option value="contain" <?php selected( $this->get_field_value( 'size' ), 'contain' ); ?>>Contain</option>
								<option value="inherit" <?php selected( $this->get_field_value( 'size' ), 'inherit' ); ?>>Inherit</option>
							</select>
						</div>
						<div class="xts-col-lg-6 xts-col-12">
							<select class="xts-bg-attachment" data-placeholder="<?php esc_attr_e( 'Background attachment', 'woodmart' ); ?>" name="<?php echo esc_attr( $this->get_input_name( 'attachment' ) ); ?>">
								<option value=""></option>
								<option value="fixed" <?php selected( $this->get_field_value( 'attachment' ), 'fixed' ); ?>>Fixed</option>
								<option value="scroll" <?php selected( $this->get_field_value( 'attachment' ), 'scroll' ); ?>>Scroll</option>
								<option value="inherit" <?php selected( $this->get_field_value( 'attachment' ), 'inherit' ); ?>>Inherit</option>
							</select>
						</div>
						<div class="xts-col-lg-6 xts-col-12">
							<select class="xts-bg-position" data-placeholder="<?php esc_attr_e( 'Background position', 'woodmart' ); ?>" name="<?php echo esc_attr( $this->get_input_name( 'position' ) ); ?>">
								<option value=""></option>
								<option value="left top" <?php selected( $this->get_field_value( 'position' ), 'left top' ); ?>>Left Top</option>
								<option value="left center" <?php selected( $this->get_field_value( 'position' ), 'left center' ); ?>>Left Center</option>
								<option value="left bottom" <?php selected( $this->get_field_value( 'position' ), 'left bottom' ); ?>>Left Bottom</option>
								<option value="center top" <?php selected( $this->get_field_value( 'position' ), 'center top' ); ?>>Center Top</option>
								<option value="center center" <?php selected( $this->get_field_value( 'position' ), 'center center' ); ?>>Center Center</option>
								<option value="center bottom" <?php selected( $this->get_field_value( 'position' ), 'center bottom' ); ?>>Center Bottom</option>
								<option value="right top" <?php selected( $this->get_field_value( 'position' ), 'right top' ); ?>>Right Top</option>
								<option value="right center" <?php selected( $this->get_field_value( 'position' ), 'right center' ); ?>>Right Center</option>
								<option value="right bottom" <?php selected( $this->get_field_value( 'position' ), 'right bottom' ); ?>>Right Bottom</option>
							</select>
						</div>
					</div>
				</div>
				<div class="xts-col-xl-6 xts-col-12">
					<div class="xts-bg-preview" style="<?php echo esc_attr( $style ); ?>"></div>
				</div>
			</div>

		<?php
	}

	/**
	 * Enqueue colorpicker lib.
	 *
	 * @since 1.0.0
	 */
	public function enqueue() {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker-alpha', WOODMART_ASSETS . '/js/libs/wp-color-picker-alpha.js', array( 'wp-color-picker' ), woodmart_get_theme_info( 'Version' ), true );
		wp_enqueue_script( 'select2', WOODMART_ASSETS . '/js/libs/select2.full.min.js', array(), woodmart_get_theme_info( 'Version' ), true );
	}

	/**
	 * Output field's css code based on the settings..
	 *
	 * @since 1.0.0
	 *
	 * @return array $output Generated CSS code.
	 */
	public function css_output() {
		if ( ! isset( $this->args['selector'] ) || empty( $this->args['selector'] ) || empty( $this->get_field_value() ) || ( ! $this->get_field_value( 'color' ) && ! $this->get_field_value( 'url' ) && ! $this->get_field_value( 'repeat' ) && ! $this->get_field_value( 'size' ) && ! $this->get_field_value( 'attachment' ) && ! $this->get_field_value( 'position' ) ) ) {
			return array();
		}

		$device = ! empty( $this->args['css_device'] ) ? $this->args['css_device'] : 'desktop';
		$value  = $this->get_field_value();

		$output = array();

		if ( ! empty( $value['color'] ) ) {
			$output[] = 'background-color: ' . $value['color'] . ';' . "\n";
		}
		if ( ! empty( $value['url'] ) ) {
			$output[] = 'background-image: url(' . $value['url'] . ');' . "\n";
		} else {
			$output[] = 'background-image: none;' . "\n";
		}
		if ( ! empty( $value['repeat'] ) ) {
			$output[] = 'background-repeat: ' . $value['repeat'] . ';' . "\n";
		}
		if ( ! empty( $value['size'] ) ) {
			$output[] = 'background-size: ' . $value['size'] . ';' . "\n";
		}
		if ( ! empty( $value['attachment'] ) ) {
			$output[] = 'background-attachment: ' . $value['attachment'] . ';' . "\n";
		}
		if ( ! empty( $value['position'] ) ) {
			$output[] = 'background-position: ' . $value['position'] . ';' . "\n";
		}

		return array(
			$device => array(
				$this->args['selector'] => $output,
			),
		);
	}

	/**
	 * Check value URl and ID fields.
	 *
	 * @since 1.0.0
	 *
	 * @param  string or array $value Field value.
	 */
	public function validate( $value ) {
		if ( isset( $value['id'] ) ) {
			$attachment = wp_get_attachment_url( $value['id'] );

			if ( $attachment ) {
				$value['url'] = $attachment;
			}
		}

		return $value;
	}
}


