<?php 
/**
 * Plugin Name: Test Plugin
 * Plugin URI:  Plugin URL Link
 * Author:      Plugin Author Name
 * Author URI:  Plugin Author Link
 * Description: This plugin does wonders
 * Version:     0.1.0
 * License:     GPL-2.0+
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: test
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

require_once __DIR__.'/vendor/autoload.php';

/**
 * The main Plugin Class
 */
final class Dusra_Academy {

    /**
     * Plugin version
     * @var string
     */
    const version = '1.0';

    /**
     * Class constructor
     */
    private function __construct() {
        $this->define_constants();
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes a singleton instance
     */
    public static function init() {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define the required plugin constants
     */
    public function define_constants() {
        define('DSht_ACADEMY_VERSION', self::version);
        define('DSht_ACADEMY_FILE', __FILE__);
        define('DSht_ACADEMY_DIR', __DIR__);
        define('DSht_ACADEMY_URL', plugins_url('', DSht_ACADEMY_FILE));
        define('DSht_ACADEMY_ASSETS', DSht_ACADEMY_URL . '/assets');
    }

    /**
     * Initialize the plugin
     */
    public function init_plugin() {
        if (is_admin()) {
            new Dusra\Academy\Admin();
        } else {
            new Dusra\Academy\Frontend(); 
        }
    }

    /**
     * Do stuff upon plugin activation
     */
    public function activate() {
        $installer = new Dusra\Academy\Installer();
        $installer->run();
    }
}

/**
 * Initializes the main plugin
 */
function dura_academy() {
    return Dusra_Academy::init();
}
dura_academy();

?>
