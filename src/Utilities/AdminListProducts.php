<?php

namespace GMProductVideo\Utilities;

use GMProductVideo\Model\Product;

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class AdminListProducts extends CustomAdminListTable
{
    protected $orderBy = 'id_product';
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

    public function prepareProducts(): bool
    {
        $this->setSortElements();

        $products = Product::doRetrieveAll(
            1,
            10,
            $this->orderBy,
            $this->orderWay
        );

        if (isset($products)) {
            foreach ($products as $prod) {
                $this->items[] = [
                    'id' => $prod->id,
                    'title_product' => $prod->title_product,
                    'url_video' => $prod->url_video
                ];
            }

            $this->prepare_items();
            return true;
        }

        return false;
    }

    public function get_columns()
    {
        $columns = array(
            'cb' => '',
            'id' => 'id',
            'title_product' => 'Name',
            'url_video'    => 'URL Video'
        );

        return $columns;
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'title_product':
            case 'url_video':
                return $item[$column_name];
            default:
                return print_r($item, true) ; //Show the whole array for troubleshooting purposes
        }
    }

    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'id' => array('id_product', false),
            'title_product'  => array('title_product', false),
            'url_video' => array('url_video', false),
        );

        return $sortable_columns;
    }
}

