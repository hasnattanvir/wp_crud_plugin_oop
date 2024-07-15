<?php 

namespace Dusra\Academy\Frontend;

class Shortcode{
    function __construct(){
        add_shortcode('dusra-academy',[$this, 'render_shortcode']);
    }

    public function render_shortcode($atts, $content=''){
        return "Hello from shortcode";
    }
}


?>