<?php 

function dsht_ac_insert_address($args=[]){
    global $wpdb;
    if(empty($args['name'])){
        return new \WP_error('no-name',__('You Must Provide a name','dusra-academy'));
    }
    $defaults=[
        'name'=>'',
        'address'=>'',
        'phone'=>'',
        'email'=>'',
        'created_by' => get_current_user_id(),
        'created_at' => current_time('mysql'),
    ];
    $data = wp_parse_args($args, $defaults);
    
    $inserted = $wpdb->insert(
        "{$wpdb->prefix}acadresses",
        $data,
        [
          '%s',
          '%s',
          '%s',
          '%s',
          '%d',
          '%s',
        ]
    );
    if(!$inserted){
        return new \WP_Error('Failed to insert data',__('Failed to insert data','dusra-academy'));
    }

    return $wpdb->insert_id;
}

// get data
function ds_ac_get_addresses($args = []) {
    global $wpdb;

    $defaults = [
        'number'  => 20,
        'offset'  => 0,
        'orderby' => 'id',
        'order'   => 'ASC'
    ];

    $args = wp_parse_args($args, $defaults);

    // Sanitize orderby and order values to prevent SQL injection
    $valid_orderby = ['id', 'name', 'address', 'phone', 'email', 'created_by', 'created_at'];
    $args['orderby'] = in_array($args['orderby'], $valid_orderby) ? $args['orderby'] : 'id';

    $valid_order = ['ASC', 'DESC'];
    $args['order'] = in_array($args['order'], $valid_order) ? $args['order'] : 'ASC';

    $items = $wpdb->get_results(
        $wpdb->prepare(
            "SELECT * FROM {$wpdb->prefix}acadresses
             ORDER BY {$args['orderby']} {$args['order']}
             LIMIT %d, %d",
            $args['offset'], $args['number']
        )
    );

    return $items;
}

// count total
function ds_ac_addres_count(){
    global $wpdb;
    return (int) $wpdb->get_var("SELECT count(id) FROM {$wpdb->prefix}acadresses");
}
// ht_acadresses

function ds_ac_getsingle_address($id){
    global $wpdb;
    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM {$wpdb->prefix}acadresses WHERE id=%d",$id)
    );
}


// delete funciton
function ds_ac_delete_address($id){
    global $wpdb;
    return $wpdb->delete(
        $wpdb->prefix.'acadresses',
        ['id'=>$id],
        ['%d']
    );
}
?>