<?php 
namespace Dusra\Academy\Admin;

// Ensure the base class exists
if (!class_exists('WP_List_Table')) {
    require_once ABSPATH . "wp-admin/includes/class-wp-list-table.php";
}

class Address_List extends \WP_List_Table {
    function __construct() {
        parent::__construct([
            'singular' => 'contact',
            'plural'   => 'contacts',
            'ajax'     => false // No AJAX support for this table
        ]);
    }

    // Define table columns
    public function get_columns() {
        $columns = [
            'cb'        => '<input type="checkbox" />', // Checkbox for bulk actions
            'name'      => __('Name', 'test'),
            'address'   => __('Address', 'test'),
            'phone'     => __('Phone', 'test'),
            'email'     => __('Email', 'test'),
            'created_by'=> __('Created By', 'test'),
            'created_at'=> __('Created At', 'test')
        ];
        return $columns;
    }

    // Default column rendering
    protected function column_default($item, $column_name) {
        switch ($column_name) {
            case 'name':
                return $this->column_name($item); // Use custom method for 'name' column
            case 'address':
            case 'phone':
            case 'email':
            case 'created_by':
            case 'created_at':
                return $item->$column_name; // Return the column value
            default:
                return print_r($item, true); // Show the whole array for troubleshooting
        }
    }

    // Custom rendering for the 'name' column
    public function column_name($item) {
        // Action links for Edit and Delete
        $actions = [
            'edit' => sprintf('<a href="%s">%s</a>', admin_url('admin.php?page=dusra-academy&action=edit&id=' . $item->id), __('Edit', 'dusra-academy')),
            'delete' => sprintf('<a href="%s">%s</a>', admin_url('admin.php?page=dusra-academy&action=delete&id=' . $item->id), __('Delete', 'dusra-academy'))
        ];

        // Link to view the item
        $url = admin_url('admin.php?page=dusra-academy&action=view&id=' . $item->id);
        $name = sprintf('<a href="%1$s"><strong>%2$s</strong></a>', $url, $item->name);

        // Combine the name with the action links
        return sprintf('%1$s %2$s', $name, $this->row_actions($actions));
    }

    // Checkbox column for bulk actions
    protected function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="address_id[]" value="%d" />', $item->id
        );
    }

    // Define sortable columns
    public function get_sortable_columns() {
        $sortable_columns = [
            'name'      => ['name', true],
            'address'   => ['address', false],
            'phone'     => ['phone', false],
            'email'     => ['email', false],
            'created_at'=> ['created_at', false]
        ];
        return $sortable_columns;
    }

    // Prepare the items for display
    public function prepare_items() {
        $per_page = 10; // Number of items per page
        $current_page = $this->get_pagenum(); // Get the current page number
        $total_items = ds_ac_addres_count(); // Get the total number of items

        // Get order and orderby parameters
        $orderby = (!empty($_REQUEST['orderby'])) ? sanitize_text_field($_REQUEST['orderby']) : 'id';
        $order = (!empty($_REQUEST['order'])) ? sanitize_text_field($_REQUEST['order']) : 'ASC';

        // Set pagination arguments
        $this->set_pagination_args([
            'total_items' => $total_items,
            'per_page'    => $per_page,
            'total_pages' => ceil($total_items / $per_page)
        ]);

        // Fetch the items from the database
        $this->items = ds_ac_get_addresses([
            'number'  => $per_page,
            'offset'  => ($current_page - 1) * $per_page,
            'orderby' => $orderby,
            'order'   => $order
        ]);

        // Set the column headers
        $columns = $this->get_columns();
        $hidden = [];
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = [$columns, $hidden, $sortable];
    }
}



?>