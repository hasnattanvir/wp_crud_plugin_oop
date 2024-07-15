<?php 
namespace Dusra\Academy\Admin;

/**
 * The Menu handler class
 */

class Menu{

    public $addressbook;

    function __construct($addressbook)
    {
        $this->addressbook = $addressbook;
        add_action('admin_menu',[$this,'admin_menu']);
    }

    public function admin_menu(){
        $parent_slug = 'dusra-academy';
        $capability = 'manage_options';
        add_menu_page(
            __('Dusra Academy','dusra-academy'), 
            __('Academy','dusra-academy'),
            $capability,
            $parent_slug, 
            [$this->addressbook, 'plugin_page'], 
            'dashicons-welcome-view-site'
        );
        add_submenu_page(
            $parent_slug, 
            __('Address Book','dusra-academy'), 
            __('Address Book','dusra-academy'), 
            $capability, 
            $parent_slug,
            [$this->addressbook, 'plugin_page'],
        );
        add_submenu_page(
            $parent_slug, 
            __('Settings','dusra-academy'), 
            __('Settings','dusra-academy'), 
            $capability, 
            'dusra-acedemy-settings',
            [$this, 'settings_page'],
        );
    }

    // public function addressbook_page(){
    //    $addressbook =  new Addressbook();
    //    $addressbook->plugin_page();
    // }

    public function settings_page(){
        echo 'i am setting page';
    }
}



?>