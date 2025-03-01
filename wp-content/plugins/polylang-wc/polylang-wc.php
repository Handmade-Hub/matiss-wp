<?php
/**
 * Polylang for WooCommerce
 *
 * @package              Polylang-WC
 * @author               WP SYNTEX
 * @license              GPL-3.0-or-later
 *
 * @wordpress-plugin
 * Plugin name:          Polylang for WooCommerce
 * Plugin URI:           https://polylang.pro
 * Description:          Adds multilingual capability to WooCommerce
 * Version:              1.5
 * Requires at least:    4.9
 * Requires PHP:         5.6
 * Author:               WP SYNTEX
 * Author URI:           https://polylang.pro
 * Text Domain:          polylang-wc
 * Domain Path:          /languages
 * License:              GPL v3 or later
 * License URI:          https://www.gnu.org/licenses/gpl-3.0.txt
 *
 * WC requires at least: 3.4
 * WC tested up to:      4.5
 *
 * Copyright 2016-2020 Frédéric Demarle
 * Copyright 2020 WP SYNTEX
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Don't access directly.
}

define( 'PLLWC_VERSION', '1.5' );
define( 'PLLWC_MIN_PLL_VERSION', '2.7' );

define( 'PLLWC_FILE', __FILE__ ); // This file.
define( 'PLLWC_BASENAME', plugin_basename( PLLWC_FILE ) ); // Plugin name as known by WP.
define( 'PLLWC_DIR', dirname( __FILE__ ) );

require __DIR__ . '/vendor/autoload.php';
require_once PLLWC_DIR . '/include/functions.php';

/**
 * Plugin controller.
 *
 * @since 0.1
 */
class Polylang_Woocommerce {
	/**
	 * Instance of PLLWC_Post_Types.
	 *
	 * @var object
	 */
	public $post_types;

	/**
	 * Instance of PLLWC_Links.
	 *
	 * @var object
	 */
	public $links;

	/**
	 * Instance of PLLWC_Stock.
	 *
	 * @var object
	 */
	public $stock;

	/**
	 * Instance of PLLWC_Emails.
	 *
	 * @var object
	 */
	public $emails;

	/**
	 * Instance of PLLWC_Strings.
	 *
	 * @var object
	 */
	public $strings;

	/**
	 * Instance of PLLWC_Xdata.
	 *
	 * @var object
	 */
	public $data;

	/**
	 * Instance of PLLWC_Export.
	 *
	 * @var object
	 */
	public $export;

	/**
	 * Instance of PLLWC_Import.
	 *
	 * @var object
	 */
	public $import;

	/**
	 * Instance of PLLWC_REST_API.
	 *
	 * @var object
	 */
	public $rest_api;

	/**
	 * Instance of PLLWC_Sync_Content.
	 *
	 * @var object
	 */
	public $sync_content;

	/**
	 * Instance of PLLWC_Frontend.
	 *
	 * @var object
	 */
	public $frontend;

	/**
	 * Instance of PLLWC_Frontend_Cart.
	 *
	 * @var object
	 */
	public $cart;

	/**
	 * Instance of PLLWC_Frontend_Account.
	 *
	 * @var object
	 */
	public $my_account;

	/**
	 * Instance of PLLWC_Coupons.
	 *
	 * @var object
	 */
	public $coupons;

	/**
	 * Instance of PLLWC_Frontend_WC_Pages.
	 *
	 * @var object
	 */
	public $wc_pages;

	/**
	 * Instance of PLLWC_Admin_WC_Install.
	 *
	 * @var object
	 */
	public $admin_wc_install;

	/**
	 * Instance of PLLWC_Admin_Taxonomies.
	 *
	 * @var object
	 */
	public $admin_taxonomies;

	/**
	 * Instance of PLLWC_Admin_Products.
	 *
	 * @var object
	 */
	public $admin_products;

	/**
	 * Instance of PLLWC_Admin_Product_Duplicate.
	 *
	 * @var object
	 */
	public $admin_product_duplicate;

	/**
	 * Instance of PLLWC_Admin_Orders.
	 *
	 * @var object
	 */
	public $admin_orders;

	/**
	 * Instance of PLLWC_Admin_Reports.
	 *
	 * @var object
	 */
	public $admin_reports;

	/**
	 * Instance of PLLWC_Admin_Status_Reports.
	 *
	 * @var object
	 */
	public $admin_status_reports;

	/**
	 * Instance of PLLWC_Admin_Menus.
	 *
	 * @var object
	 */
	public $admin_menus;

	/**
	 * Instance of PLL_Wizard.
	 *
	 * @var object
	 */
	public $wizard;

	/**
	 * Instance of PLLWC_Admin_Product_Duplicate.
	 *
	 * @var object
	 */
	public $site_health;

	/**
	 * Singleton.
	 *
	 * @var object Instance of Polylang_Woocommerce.
	 */
	protected static $instance;

	/**
	 * Constructor.
	 *
	 * @since 0.1
	 */
	public function __construct() {
		// Registers an action when the plugin is activated.
		add_action( 'activated_plugin', array( $this, 'activated_plugin' ), 10, 2 );

		$install = new PLLWC_Install( plugin_basename( __FILE__ ) );

		// Stopping here if we are going to deactivate the plugin ( avoids breaking rewrite rules ).
		if ( $install->is_deactivation() ) {
			return;
		}

		// WC 3.3: Maybe update default product categories after WooCommerce did it.
		$db_version = get_option( 'woocommerce_db_version' );
		if ( ! empty( $db_version ) && version_compare( $db_version, '3.3.0', '<' ) ) {
			add_action( 'add_option_woocommerce_db_version', array( 'PLLWC_Admin_WC_Install', 'update_330_wc_db_version' ), 10, 2 );
		}

		/*
		 * Fix home url when using pretty permalinks and the shop is on front.
		 * Added here because the filters are fired before the action 'pll_init'.
		 */
		add_filter( 'pll_languages_list', array( 'PLLWC_Links', 'set_home_urls' ), 7 ); // After Polylang.
		add_filter( 'pll_after_languages_cache', array( 'PLLWC_Links', 'pll_after_languages_cache' ), 20 ); // After Polylang.

		// The "ajax" request for feature product is indeed a direct link and thus does not include the pll_ajax_backend query var.
		if ( isset( $_GET['action'] ) && 'woocommerce_feature_product' === $_GET['action'] ) {  // phpcs:ignore WordPress.Security.NonceVerification
			define( 'PLL_ADMIN', true );
		}

		add_action( 'pll_init', array( $this, 'init' ) );
		PLLWC_Plugins_Compat::instance();
	}

	/**
	 * Get the Polylang for WooCommerce instance.
	 *
	 * @since 0.1
	 *
	 * @return object
	 */
	public static function instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Initializes the plugin.
	 *
	 * @since 0.1
	 */
	public function init() {
		// Silently disable the plugin if WooCommerce are not active.
		if ( ! defined( 'WOOCOMMERCE_VERSION' ) ) {
			return;
		}

		// If the version of Polylang is too old.
		if ( version_compare( POLYLANG_VERSION, PLLWC_MIN_PLL_VERSION, '<' ) ) {
			add_action( 'all_admin_notices', array( $this, 'admin_notices' ) );
			return;
		}

		if ( PLL() instanceof PLL_Admin_Base ) {
			new PLL_License( __FILE__, 'Polylang for WooCommerce', PLLWC_VERSION, 'Frédéric Demarle' );
			new PLL_T15S( 'polylang-wc', 'https://packages.translationspress.com/wp-syntex/polylang-wc/packages.json' );
		}

		// Instantiate PLL_Wizard before any language test to display the WooCommerce step in the Wizard.
		if ( PLL() instanceof PLL_admin_Base ) {
			if ( class_exists( 'PLL_Wizard' ) && Polylang::is_wizard() ) {
				$this->wizard = new PLLWC_Wizard( PLL()->model, PLL()->wizard );
			}
			$this->admin_status_reports = new PLLWC_Admin_Status_Reports();
			load_plugin_textdomain( 'polylang-wc' );
		}

		// Bail early if no language has been defined yet.
		if ( ! pll_languages_list() ) {
			return;
		}

		add_action( 'admin_init', array( $this, 'maybe_upgrade' ) );

		add_action( 'woocommerce_delete_product_transients', array( $this, 'delete_product_transients' ) );

		$this->post_types = new PLLWC_Post_Types();
		$this->links      = defined( 'POLYLANG_PRO' ) && POLYLANG_PRO && get_option( 'permalink_structure' ) ? new PLLWC_Links_Pro() : new PLLWC_Links();
		$this->stock      = new PLLWC_Stock();
		$this->emails     = new PLLWC_Emails();
		$this->strings    = new PLLWC_Strings();
		$this->data       = new PLLWC_Xdata();
		$this->export     = new PLLWC_Export();
		$this->import     = new PLLWC_Import();
		$this->products   = new PLLWC_Products();

		if ( defined( 'POLYLANG_PRO' ) && POLYLANG_PRO ) {
			$this->rest_api     = new PLLWC_REST_API();
			$this->sync_content = new PLLWC_Sync_Content();
		}

		/*
		 * We need to load our cart integration on all ajax requests, as WooCommerce does,
		 * but also on REST requests for WooCommerce Blocks 2.5+, so let's always load it.
		 */
		$this->cart = new PLLWC_Frontend_Cart();

		// Frontend only.
		if ( PLL() instanceof PLL_Frontend ) {
			$this->frontend   = new PLLWC_Frontend();
			$this->my_account = new PLLWC_Frontend_Account();
			$this->coupons    = new PLLWC_Coupons();

			// WC pages on front.
			if ( 'page' === get_option( 'show_on_front' ) ) {
				$this->wc_pages = new PLLWC_Frontend_WC_Pages();
			}
		} else {
			$this->admin_wc_install = new PLLWC_Admin_WC_Install();

			// Admin only ( but not useful on Polylang settings pages ).
			if ( PLL() instanceof PLL_admin ) {
				$this->admin_taxonomies        = new PLLWC_Admin_Taxonomies();
				$this->admin_products          = new PLLWC_Admin_Products();
				$this->admin_product_duplicate = new PLLWC_Admin_Product_Duplicate();
				$this->admin_orders            = new PLLWC_Admin_Orders();
				$this->admin_reports           = new PLLWC_Admin_Reports();
				$this->admin_menus             = new PLLWC_Admin_Menus();
				$this->coupons                 = new PLLWC_Admin_Coupons();
				$this->site_health             = new PLLWC_Admin_Site_Health();

				add_action( 'woocommerce_system_status_report', array( $this->admin_status_reports, 'status_report' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			}
		}

		/**
		 * Fires after the Polylang for WooCommerce object is initialized.
		 *
		 * @since 0.3.2
		 *
		 * @param object &$this The Polylang for WooCommerce object.
		 */
		do_action_ref_array( 'pllwc_init', array( &$this ) );
	}

	/**
	 * Displays an admin notice if Polylang is not at the right version.
	 *
	 * @since 0.1
	 */
	public function admin_notices() {
		load_plugin_textdomain( 'polylang-wc' );
		printf(
			'<div class="error"><p>%s</p><p>%s</p></div>',
			esc_html__( 'Polylang for WooCommerce has been deactivated because you are using an old version of Polylang.', 'polylang-wc' ),
			esc_html(
				sprintf(
					/* translators: %1$s and %2$s are Polylang version numbers */
					__( 'You are using Polylang %1$s. Polylang for WooCommerce requires at least Polylang %2$s.', 'polylang-wc' ),
					POLYLANG_VERSION,
					PLLWC_MIN_PLL_VERSION
				)
			)
		);
	}

	/**
	 * Manages updates of the plugin.
	 *
	 * @since 0.9.3
	 */
	public function maybe_upgrade() {
		$options = get_option( 'polylang-wc' );

		// New install.
		if ( empty( $options ) ) {
			$options['version'] = PLLWC_VERSION;
			update_option( 'polylang-wc', $options );
		}

		if ( version_compare( $options['version'], PLLWC_VERSION, '<' ) ) {
			// Version 0.4.3.
			if ( version_compare( $options['version'], '0.4.3', '<' ) ) {
				delete_transient( 'woocommerce_cache_excluded_uris' );
			}

			// Version 0.4.6.
			if ( version_compare( $options['version'], '0.4.6', '<' ) ) {
				// Same as Polylang 2.0.8, for WP 4.7.
				global $wpdb;
				$wpdb->update( $wpdb->usermeta, array( 'meta_key' => 'locale' ), array( 'meta_key' => 'user_lang' ) );
			}

			// Version 0.9.3, if already updated to WC 3.3.
			if ( version_compare( $options['version'], '0.9.3', '<' ) ) {
				if ( version_compare( WC()->version, '3.3.0', '>=' ) ) {
					PLLWC_Admin_WC_Install::create_default_product_cats();
					PLLWC_Admin_WC_Install::replace_default_product_cats();
				}
			}

			$options['previous_version'] = $options['version']; // Remember the previous version.
			$options['version'] = PLLWC_VERSION;
			update_option( 'polylang-wc', $options );
		}

		PLLWC_Admin_WC_Install::create_default_product_cats();
	}

	/**
	 * Clear all transients cache for translations when WC clears a product transient.
	 *
	 * @since 0.4.5
	 *
	 * @param int $product_id Product ID.
	 */
	public function delete_product_transients( $product_id ) {
		static $ids;
		$ids[] = $product_id;

		$data_store = PLLWC_Data_Store::load( 'product_language' );
		foreach ( $data_store->get_translations( $product_id ) as $tr_id ) {
			if ( ! in_array( $tr_id, $ids ) ) {
				wc_delete_product_transients( $tr_id );
			}
		}
	}

	/**
	 * Enqueues the stylesheet.
	 *
	 * @since 0.1
	 */
	public function admin_enqueue_scripts() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		wp_enqueue_style( 'pll_wc_admin', plugins_url( '/css/admin' . $suffix . '.css', PLLWC_FILE ), array(), PLLWC_VERSION );
	}

	/**
	 * Saves a transient when Polylang For WooCommerce is activating to redirect to the Polylang wizard.
	 *
	 * @since 1.4
	 *
	 * @param string $plugin_name  Plugin basename.
	 * @param bool   $network_wide If activated for all sites in the network.
	 */
	public static function activated_plugin( $plugin_name, $network_wide ) {
		if ( wp_doing_ajax() || $network_wide ) {
			return;
		}

		if ( PLLWC_BASENAME === $plugin_name && class_exists( 'PLL_Wizard' ) ) {
			set_transient( 'pll_activation_redirect', 1, 30 );
		}
	}
}

PLLWC();
