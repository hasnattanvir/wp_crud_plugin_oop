<?php
namespace Dusra\Academy;

class Installer{
    public function run() {
        $this->add_version();
        $this->create_tables();
    }

    public function add_version() {
        $installed = get_option('dsht_academy_installed');
        if (!$installed) {
            update_option('dsht_academy_installed', time());
        }
        update_option('dsht_academy_version', DSht_ACADEMY_VERSION);
    }

    public function create_tables() {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();

        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}acadresses` (
            id int(11) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            address text NOT NULL,
            phone varchar(20) NOT NULL,
            email varchar(100) NOT NULL,
            created_by bigint(20) unsigned NOT NULL,
            created_at datetime NOT NULL,
            PRIMARY KEY (id)
        ) $charset_collate;";
        if(!function_exists('dbDelta')){
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }
        dbDelta($schema);
    }

}



?>