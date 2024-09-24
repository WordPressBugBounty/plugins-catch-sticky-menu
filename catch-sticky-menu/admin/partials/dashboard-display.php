<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link      https://catchplugins.com/plugins
 * @since      1.0.0
 *
 * @package    Catch_Sticky_Menu
 * @subpackage Catch_Sticky_MenuS/admin/partials
 */
?>

<div id="catch-sticky-menu">
	<div class="content-wrapper">
		<div class="header">
			<h2><?php esc_html_e( 'Settings', 'catch-sticky-menu' ); ?></h2>
		</div> <!-- .Header -->
		<div class="content">
			<?php if( isset($_GET['settings-updated']) ) { ?>
			<div id="message" class="notice updated fade">
		  		<p><strong><?php esc_html_e( 'Plugin Options Saved.', 'catch-sticky-menu' ) ?></strong></p>
		  	</div>
			<?php } ?>
			<?php // Use nonce for verification.
				wp_nonce_field( basename( __FILE__ ), 'catch_sticky_menu_nounce' );
			?>
			<div id="sticky_main">
				<form method="post" action="options.php">
					<?php settings_fields( 'catch-sticky-menu-group' ); ?>
					<?php
					$defaults =catch_sticky_menu_default_options();
					$settings = catch_sticky_menu_get_options();
					?>
					<div class="option-container">
			  			<table class="form-table" bgcolor="white">
							<tbody>
								<tr>
									<th>
										<label><?php esc_html_e( ' Desktop Menu Selector', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
										<input type="text" name="catch_sticky_menu_options[sticky_desktop_menu_selector]" id="sticky-desktop-menu-selector" class="sticky-desktop-menu-selector"  value="<?php echo esc_attr($settings['sticky_desktop_menu_selector']); ?>"/>
										<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Sticky Menu will be displayed just before this selector.', 'catch-sticky-menu' ); ?>"></span>
									</td>
								</tr>
								
								<tr>
									<th>
										<label><?php esc_html_e( ' Mobile Menu Selector', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
										<input type="text" name="catch_sticky_menu_options[sticky_mobile_menu_selector]" id="sticky-mobile-menu-selector" class="sticky-mobile-menu-selector"  value="<?php echo esc_attr($settings['sticky_mobile_menu_selector']); ?>"/>
										<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Sticky Menu will be displayed just before this selector (in mobile).', 'catch-sticky-menu' ); ?>"></span>
									</td>
								</tr>
								
							
									<th>
					  					<label><?php esc_html_e( 'Sticky Background Color', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
								  		<input type="text" name="catch_sticky_menu_options[sticky_background_color]" id="sticky-background-color" class="color-picker" data-alpha="true" value="<?php echo esc_attr( $settings['sticky_background_color'] ); ?>"/>
									</td>
				  				</tr>
				  				</tr>
								
							
									<th>
					  					<label><?php esc_html_e( 'Sticky Menu Text Color', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
								  		<input type="text" name="catch_sticky_menu_options[sticky_text_color]" id="sticky-text-color" class="color-picker" data-alpha="true" value="<?php echo esc_attr( $settings['sticky_text_color'] ); ?>"/>
									</td>
				  				</tr>
								
								
								<tr>
									<th>
					  					<label><?php esc_html_e( 'Sticky Z index', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
								  		<input type="number"min="-100" max="2147483647" step="1"  name="catch_sticky_menu_options[sticky_z_index]" id="sticky-z-index" class="color-z-index" data-alpha="true" value="<?php echo esc_attr( $settings['sticky_z_index'] ); ?>"/><span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Sticky z-index helps to set the stack order of the element. An element with greater stack order is always in front.', 'catch-sticky-menu' ); ?>"></span>
									</td>
				  				</tr>
				  				<tr>
									<th>
					  					<label><?php esc_html_e( 'Sticky Opacity', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
								  		<input type="number" min="0" max="1" step="0.1"   name="catch_sticky_menu_options[sticky_opacity]" id="sticky-opacity" class="color-opacity" data-alpha="true" value="<?php echo esc_attr( $settings['sticky_opacity'] ); ?>"/><span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Sticky Opacity helps to set the  transparency-level, 1 is not transparent at all where as 0 is completely transparent.', 'catch-sticky-menu' ); ?>"></span>
									</td>
				  				</tr>
				  				<tr>
									<th>
										<label><?php esc_html_e( 'Desktop Font Size', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
										<input type="number" name="catch_sticky_menu_options[sticky_desktop_font_size]" id="sticky-text-font-size" placeholder="12px" class="sticky-desktop-font-size numbers-only" value="<?php echo esc_attr( $settings['sticky_desktop_font_size'] ); ?>"/>
										<span class="add-on"><?php esc_html_e( 'px', 'catch-sticky-menu' ); ?></span>
										<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Sets your desired font size to desktop menu text. Default is set to null, and takes theme\'s font size.', 'catch-sticky-menu' ); ?>"></span>
									</td>
								</tr>
								<tr>
									<th>
										<label><?php esc_html_e( 'Mobile Font Size', 'catch-sticky-menu' ); ?></label>
									</th>
									<td>
										<input type="number" name="catch_sticky_menu_options[sticky_mobile_font_size]" id="sticky-mobile-font-size" placeholder="1em" step="0.1" class="sticky-mobile-font-size numbers-only" value="<?php echo esc_attr( $settings['sticky_mobile_font_size'] ); ?>"/>
										<span class="add-on"><?php esc_html_e( 'em', 'catch-sticky-menu' ); ?></span>
										<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Sets your desired font size to mobile menu text. Default is set to null, and takes theme\'s font size.', 'catch-sticky-menu' ); ?>"></span>
									</td>
								</tr>
				  				<tr> 
									<th scope="row"><?php _e( 'Enable Only On Home Page', 'catch-sticky-menu' ); ?></th>
									<td>
										<?php $text   =   ( ! empty ( $settings['enable_only_on_home'] ) && $settings['enable_only_on_home'] ) ? 'checked' : '';
										echo '<input type="checkbox" ' . $text . ' name="catch_sticky_menu_options[enable_only_on_home]" value="1"/>' . esc_html__( 'Check to enable', 'catch-sticky-menu' );
										?>
										<span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Checking this option will display sticky menu on homepage/frontpage.', 'catch-sticky-menu' ); ?>"></span>
									</td>
								</tr>
								
								
								<tr>
                                    <th scope="row"><?php esc_html_e( 'Reset Options', 'catch-sticky-menu' ); ?></th>
                                    <td>
                                        <?php
                                            echo '<input name="catch_sticky_menu_options[reset]" id="catch_sticky_menu_options[reset]" type="checkbox" value="1" class="catch_sticky_menu_options[reset]" />' . esc_html__( 'Check to reset', 'catch-sticky-menu' );
                                        ?>
                                        <span class="dashicons dashicons-info tooltip" title="<?php esc_html_e( 'Caution: Reset all settings to default.', 'catch-sticky-menu' ); ?>"></span>
                                    </td>
                                </tr>
							</tbody>
						</table>
						<?php submit_button( esc_html__( 'Save Changes', 'catch-sticky-menu' ) ); ?>
					</div><!-- .option-container -->
				</form>
			</div><!-- sticky_main -->
		</div><!-- .content -->
	</div><!-- .content-wrapper -->
</div><!---catch-sticky-menu-->
