<?php

namespace GMProductVideo\Utilities;

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

abstract class CustomAdminListTable extends \WP_List_Table
{
    protected $orderBy;
    protected $orderWay = 'asc';

    protected function setSortElements()
    {
        if (isset($_GET['orderby'])) {
            $this->orderBy = $_GET['orderby'];
        }

        if (isset($_GET['order'])) {
            $this->orderWay = $_GET['order'];
        }
    }

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array($columns, $hidden, $sortable);
    }

    public function column_default($item, $column_name)
    {
        return $item[$column_name];
    }

    public function column_id($item): string
    {
        $actions = array(
            'view' => sprintf('<a href="?page=%s&action=%s&id=%s">View</a>', $_REQUEST['page'], 'view', $item['id']),
            'edit' => sprintf('<a href="?page=%s&action=%s&id=%s">Edit</a>', $_REQUEST['page'], 'edit', $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=%s&id=%s">Delete</a>', $_REQUEST['page'], 'delete', $item['id']),
        );

        return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions));
    }

    public function column_cb($item): string
    {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    public function get_bulk_actions(): array
    {
        $actions = array(
            'delete'    => 'Delete'
        );

        return $actions;
    }
}
