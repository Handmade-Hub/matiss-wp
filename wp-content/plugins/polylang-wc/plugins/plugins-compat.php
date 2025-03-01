<?php
/**
 * @package Polylang-WC
 */

/**
 * Manages the compatibility with 3rd party plugins ( and themes ).
 * This class is available as soon as the plugin is loaded.
 *
 * @since 0.3.2
 */
class PLLWC_Plugins_Compat {
	/**
	 * Singleton.
	 *
	 * @var object PLLWC_Plugins_Compat instance.
	 */
	protected static $instance;

	/**
	 * Constructor.
	 *
	 * @since 0.3.2
	 */
	protected function __construct() {
		add_action( 'pllwc_init', array( $this, 'init' ) );
	}

	/**
	 * Init fired only when Polylang for WooCommerce object is initialized.
	 *
	 * @since 0.3.2
	 */
	public function init() {
		if ( is_admin() ) {
			// WooCommerce Stock Manager + WooCommerce Bulk Stock Management.
			if ( isset( $_GET['page'] ) && in_array( sanitize_key( $_GET['page'] ), array( 'stock-manager', 'woocommerce-bulk-stock-management' ) ) ) {  // phpcs:ignore WordPress.Security.NonceVerification
				$this->stock_manager = new PLLWC_Stock_Manager();
			}

			if ( class_exists( 'WC_Dynamic_Pricing' ) ) {
				$this->dynamic_pricing = new PLLWC_Dynamic_Pricing();
			}

			if ( class_exists( 'WC_Swatches_Compatibility' ) ) {
				$this->swatches = new PLLWC_Swatches();
			}
		}

		if ( class_exists( 'WC_Subscriptions_Product' ) ) {
			$this->subscriptions = new PLLWC_Subscriptions();
		}

		if ( class_exists( 'WC_Table_Rate_Shipping' ) ) {
			$this->table_rate_shipping = new PLLWC_Table_Rate_Shipping();
		}

		if ( class_exists( 'WC_Shipment_Tracking' ) ) {
			$this->shipment_tracking = new PLLWC_Shipment_Tracking();
		}

		if ( class_exists( 'WC_Bookings' ) ) {
			$this->bookings = new PLLWC_Bookings();
		}

		if ( class_exists( 'WC_Stripe' ) ) {
			$this->stripe = new PLLWC_Stripe();
		}

		if ( class_exists( 'Follow_Up_Emails' ) ) {
			$this->fue = new PLLWC_Follow_Up_Emails();
		}

		if ( defined( 'YITH_WCAS' ) ) {
			$this->yith_wcas = new PLLWC_Yith_WCAS();
		}

		if ( class_exists( 'WC_Bundles' ) ) {
			$this->bundles = new PLLWC_Product_Bundles();
		}

		if ( class_exists( 'WC_Mix_and_Match' ) ) {
			$this->mix_match = new PLLWC_Mix_Match();
		}

		if ( defined( 'WC_MIN_MAX_QUANTITIES' ) ) {
			$this->min_max = new PLLWC_Min_Max_Quantities();
		}

		if ( class_exists( 'WC_Composite_Products' ) ) {
			$this->composite = new PLLWC_Composite_Products();
		}

		// Special case for Checkout Field Editor which defines constant in a function hooked to 'init'.
		add_action( 'init', array( $this, 'maybe_init_wcfd' ), 20 );

		// WC Free Gift Coupons initializes itself after us.
		add_action( 'init', array( $this, 'maybe_init_fgc' ) );
	}

	/**
	 * Initializes the compatibility with the plugin Checkout Field Editor for WooCommerce.
	 * The first constant was used for versions < 1.3.6.
	 *
	 * @since 1.3
	 */
	public function maybe_init_wcfd() {
		if ( defined( 'TH_WCFD_VERSION' ) || defined( 'THWCFD_VERSION' ) ) {
			$this->wcfd = new PLLWC_WCFD();
		}
	}

	/**
	 * Initializes the compatibility with the plugin WooCommerce Free Gift Coupons.
	 *
	 * @since 1.4
	 */
	public function maybe_init_fgc() {
		if ( class_exists( 'WC_Free_Gift_Coupons' ) ) {
			$this->fgc = new PLLWC_Free_Gift_Coupons();
		}
	}

	/**
	 * Accesses to the single instance of the class.
	 *
	 * @since 0.3.2
	 *
	 * @return object
	 */
	public static function instance() {
		if ( empty( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
