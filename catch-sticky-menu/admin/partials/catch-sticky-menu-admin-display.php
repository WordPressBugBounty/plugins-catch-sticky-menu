<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       www.catchplugins.com
 * @since      1.0.0
 *
 * @package    Catch_Sticky_Menu
 * @subpackage Catch_Sticky_Menu/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h1 class="wp-heading-inline"><?php esc_html_e( 'Catch Sticky Menu', 'catch-sticky-menu' );?></h1>
    <div id="plugin-description">
        <p><?php esc_html_e( 'Lets you display Sticky Menu anywhere on your website elegantly.', 'catch-sticky-menu' ); ?></p>
    </div>
    <div class="catchp-content-wrapper">
        <div class="catchp_widget_settings">
            <form id="sticky-main" method="post" action="options.php">
                <h2 class="nav-tab-wrapper">
                    <a class="nav-tab nav-tab-active" id="dashboard-tab" href="#dashboard"><?php esc_html_e( 'Dashboard', 'catch-sticky-menu' ); ?></a>
                    <a class="nav-tab" id="features-tab" href="#features"><?php esc_html_e( 'Features', 'catch-sticky-menu' ); ?></a>

                </h2>
                <div id="dashboard" class="wpcatchtab nosave active">
                    <?php require_once plugin_dir_path( dirname( __FILE__ ) ) . 'partials/dashboard-display.php';?>
                  <div id="ctp-switch" class="content-wrapper col-3 catch-sticky-menu-main">
                        <div class="header">
                            <h2><?php esc_html_e( 'Catch Themes & Catch Plugins Tabs', 'catch-sticky-menu' ); ?></h2>
                        </div> <!-- .Header -->

                        <div class="content">

                            <p><?php echo esc_html__( 'If you want to turn off Catch Themes & Catch Plugins tabs option in Add Themes and Add Plugins page, please uncheck the following option.', 'catch-sticky-menu' ); ?>
                            </p>
                            <table>
                                <tr>
                                    <td>
                                        <?php echo esc_html__( 'Turn On Catch Themes & Catch Plugin tabs', 'catch-sticky-menu' );  ?>
                                    </td>
                                    <td>
                                        <?php $ctp_options = ctp_get_options(); ?>
                                        <div class="module-header <?php echo $ctp_options['theme_plugin_tabs'] ? 'active' : 'inactive'; ?>">
                                            <div class="switch">
                                                <input type="hidden" name="ctp_tabs_nonce" id="ctp_tabs_nonce" value="<?php echo esc_attr( wp_create_nonce( 'ctp_tabs_nonce' ) ); ?>" />
                                                <input type="checkbox" id="ctp_options[theme_plugin_tabs]" class="ctp-switch" rel="theme_plugin_tabs" <?php checked( true, $ctp_options['theme_plugin_tabs'] ); ?> >
                                                <label for="ctp_options[theme_plugin_tabs]"></label>
                                            </div>
                                            <div class="loader"></div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div><!-- #ctp-switch -->
                </div><!---dashboard---->

                <div id="features" class="wpcatchtab save">
                    <div class="content-wrapper col-3">
                        <div class="header">
                            <h3><?php esc_html_e( 'Features', 'catch-sticky-menu' );?></h3>
                        </div><!-- .header -->
                        <div class="content">
                            <ul class="catchp-lists">
                               <li>
                                    <strong><?php esc_html_e( 'Menu Selector', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'Catch Sticky Menu empowers you with Menu Selector (for desktop and mobile). A basic knowledge of HTMl/CSS is required as you need to pick the right selector for the element you want to make sticky. You can pick which element of your website to make sticky from the Inspect Element option. You can select the sticky element for desktop and mobile menu selector, separately.', 'catch-sticky-menu' ); ?></p>
                                </li>

                                <li>
                                    <strong><?php esc_html_e( 'Sticky Background Color', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'Background colors play an important role when you’re trying to highlight something. Likewise, we’ve added the option to select the background color for your sticky menu. Select the background color from the unlimited color palette that best suits your website and its design to make your sticky menu stand out!', 'catch-sticky-menu' ); ?></p>
                                </li>
                                <li>
                                    <strong><?php esc_html_e( 'Sticky Z Index', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'Catch Sticky Menu supports Z Index option. You can add a sticky Z index easily if there are other elements on the page that hide or peek through your sticky element.', 'catch-sticky-menu' ); ?></p>
                                </li>
                                <li>
                                    <strong><?php esc_html_e( 'Sticky Opacity', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'With the Sticky Opacity option available in Catch Sticky Menu, you can select the opacity level of your sticky menu. The more you decrease the opacity level, the more faded your sticky menu will look. You can select the opacity as per your preference.', 'catch-sticky-menu' ); ?></p>
                                </li>
                                <li>
                                    <strong><?php esc_html_e( 'Enable on Homepage only', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'You can stick the menu either on the Homepage of your website only or on the entire website. Your sticky menu is enabled on the entire website by default. And if you want the sticky menu to be displayed only on the Homepage, checkmark the tiny box right next to the option.', 'catch-sticky-menu' ); ?></p>
                                </li>
                                <li>
                                    <strong><?php esc_html_e( 'Lightweight', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'Catch Sticky Menu, a simple sticky menu plugin for WordPress is extremely lightweight. It means you will not have to worry about your website getting slower because of the plugin.', 'catch-sticky-menu' ); ?></p>
                                </li>
                                <li>
                                    <strong><?php esc_html_e( 'Responsive Design', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'Catch Sticky Menu, our new WordPress plugin for sticky menu comes with a responsive design, which means the sticky menu trails will look elegant on all devices.', 'catch-sticky-menu' ); ?></p>
                                </li>
                                <li>
                                    <strong><?php esc_html_e( 'Compatible with all WordPress Themes', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'Catch Sticky menu has been crafted in a way that supports all the themes on WordPress. The plugin functions smoothly on any WordPress theme.', 'catch-sticky-menu' ); ?></p>
                                </li>
                                <li>
                                    <strong><?php esc_html_e( 'Incredible Support', 'catch-sticky-menu' ); ?></strong>
                                    <p><?php esc_html_e( 'We have a great line of support team and support documentation. You do not need to worry about how to use the plugins we provide, just refer to our Tech Support Forum. Further, if you need to do advanced customization to your website, you can always hire our customizer!', 'catch-sticky-menu' ); ?></p>
                                </li>
                            </ul>

                        </div><!-- .content -->
                    </div><!-- content-wrapper -->
                </div> <!-- Featured -->
            </form><!-- sticky-main -->
        </div><!-- .catchp_widget_settings -->
        <?php require_once plugin_dir_path(dirname(__FILE__) ) .'/partials/sidebar.php';?>
    </div><!---catch-content-wrapper---->
<?php require_once plugin_dir_path( dirname( __FILE__ ) ) . '/partials/footer.php'; ?>
</div><!-- .wrap -->
