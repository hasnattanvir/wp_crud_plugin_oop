<?php 
namespace Dusra\Academy;
/**
 * The admin class
 */

class Admin{
    function __construct()
    {
        $addressbook = new Admin\Addressbook();
        $this->dispatch_action($addressbook); 
        new Admin\Menu($addressbook);
    }

    public function dispatch_action($addressbook){
        // $addressbook = new Admin\Addressbook();
        add_action('admin_init',[$addressbook,'form_handler']);
    }
 }


 ?>

