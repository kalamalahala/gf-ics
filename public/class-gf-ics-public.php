<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/kalamalahala
 * @since      1.0.0
 *
 * @package    Gf_Ics
 * @subpackage Gf_Ics/public
 */

use Eluceo\iCal\Domain\Entity\Event;
use Eluceo\iCal\Domain\Entity\TimeZone;
use Eluceo\iCal\Domain\Entity\Attendee;
use Eluceo\iCal\Domain\Enum\RoleType;
use Eluceo\iCal\Domain\Enum\ParticipationStatus;
use Eluceo\iCal\Domain\ValueObject\Uri;
use Eluceo\iCal\Domain\ValueObject\DateTime;
use Eluceo\iCal\Domain\ValueObject\TimeSpan;
use Eluceo\iCal\Domain\ValueObject\Location;
use Eluceo\iCal\Domain\ValueObject\Organizer;
use Eluceo\iCal\Domain\ValueObject\EmailAddress;
use Eluceo\iCal\Domain\ValueObject\UniqueIdentifier;




/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Gf_Ics
 * @subpackage Gf_Ics/public
 * @author     Tyler Karle <tyler.karle@icloud.com>
 */
class Gf_Ics_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gf_Ics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gf_Ics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/gf-ics-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Gf_Ics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Gf_Ics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/gf-ics-public.js', array( 'jquery' ), $this->version, false );

	}

	public function ics_notification($notification, $form, $entry) {

		if ($notification['name'] == 'Send Appointment Details to Client') {
			// error_log('notification: ' . print_r($notification, true));
			// error_log('form: ' . print_r($form, true));
			// error_log('entry: ' . print_r($entry, true));

			$set_appointment_field = 5;
			$set_appointment = $entry[$set_appointment_field];

			$agent_number_field = 12;
			$agent_number = $entry[$agent_number_field];
			if ($agent_number != '42215' || $agent_number != 42215 ) {
				return $notification;
			} else {
				error_log($set_appointment);
				error_log('Appointment details');
				$details = self::retrieve_ssa_details($set_appointment);
				error_log('Details: ' . print_r($details, true));
			}
		} else {
			return $notification;
		}
	}

	public static function generate_ics($data) {

		error_log('function called');

	}

	public static function retrieve_ssa_details($ssa_id) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'ssa_appointments';

		$query = "SELECT * FROM $table_name WHERE id = $ssa_id";
		$ssa_details = $wpdb->get_row($query, ARRAY_A);

		return $ssa_details;
	}

}


/* Gravity Forms Entry Object

(
    [id] => 38942
    [status] => active
    [form_id] => 14
    [ip] => 73.53.174.43
    [source_url] => https://thejohnson.group/agent-portal/agent/?agentid=42%2C215&rco=ap&eid=e3itn0uogjYxWOFJpZVmy7Kl52hJmoSED5bZFMHzj4HzHrLcEOes0OQxxNGJgFDw0HlEicB8DVFJN13CNWsmZsk6rsQnKEbE1G55kvvDiObwy229kw%3D%3D
    [currency] => USD
    [post_id] => 
    [date_created] => 2022-11-08 20:03:29
    [date_updated] => 2022-11-08 20:03:29
    [is_starred] => 0
    [is_read] => 0
    [user_agent] => Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.0.0 Safari/537.36
    [payment_status] => 
    [payment_date] => 
    [payment_amount] => 
    [payment_method] => 
    [transaction_id] => 
    [is_fulfilled] => 
    [created_by] => 2
    [transaction_type] => 
    [5] => 18701
    [45] => 
    [46] => 
    [47] => 5721
    [12] => 42215
    [10.2] => 
    [10.3] => Tyler
    [10.4] => 
    [10.6] => Karle
    [10.8] => 
    [1] => solo.driver.bob@gmail.com
    [4.2] => 
    [4.3] => tyler
    [4.4] => 
    [4.6] => karle
    [4.8] => 
    [11] => n
    [6] => (904) 532-1080
    [3] => admin@thejohnson.group
    [33] => adb
    [36] => n
    [38] => n
    [41] => n
    [42] => 
    [7.1] => 
    [7.2] => 
    [7.3] => 
    [7.4] => 
    [7.5] => 
    [7.6] => 
    [25] => 
    [43] => 2
    [34.1] => 
    [23] => cal171ef
    [26] => 2022-11-08
    [32] => Tuesday
    [31] => ap
    [28] => (904) 532-1080
    [21] => 12773
    [15.2] => 
    [15.3] => Carleus
    [15.4] => 
    [15.6] => Johnson
    [15.8] => 
    [16] => cjbenefits@gmail.com
    [17] => (386) 868-9059
    [22] => 
    [18.2] => 
    [18.3] => 
    [18.4] => 
    [18.6] => 
    [18.8] => 
    [19] => 
    [20] => 
    [44] => 
    [24.2] => 
    [24.3] => 
    [24.4] => 
    [24.6] => 
    [24.8] => 
    [37] => 
    [40] => 
    [8] => 
    [49] => 
)

*/