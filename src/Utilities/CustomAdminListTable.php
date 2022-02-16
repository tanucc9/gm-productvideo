<?php

namespace GMProductVideo\Utilities;

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

abstract class CustomAdminListTable extends \WP_List_Table
{
    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
        //usort($this->example_data, array(&$this, 'usort_reorder'));
        //$this->items = $this->example_data;
    }

    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    public function column_id($item)
    {
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['id']),
        );

        return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions));
    }

    public function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="book[]" value="%s" />',
            $item['id']
        );
    }

    public function get_bulk_actions()
    {
        $actions = array(
            'delete'    => 'Delete'
        );

        return $actions;
    }

    //@todo order by with sql
    public function usort_reorder($a, $b)
    {
        // If no sort, default to title
        $orderby = (!empty($_GET['orderby'])) ? $_GET['orderby'] : 'ID';
        // If no order, default to asc
        $order = (! empty($_GET['order'])) ? $_GET['order'] : 'asc';
        // Determine sort order
        $result = strcmp($a[$orderby], $b[$orderby]);
        // Send final sort direction to usort
        return ($order === 'asc') ? $result : -$result;
    }
}
