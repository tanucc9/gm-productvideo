<?php

namespace GMProductVideo\Utilities;

use GMProductVideo\Model\Product;

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class AdminListProducts extends CustomAdminListTable
{
    public function prepare_items()
    {
        parent::prepare_items();
        $this->set_pagination_args([
            'total_items' => Product::getNumProducts(),
            'per_page'    => 10,
        ]);
    }

    protected function setSortElements()
    {
        parent::setSortElements();

        if (!isset($this->orderBy)) {
            $this->orderBy = 'id_product';
        }
    }

    public function prepareProducts(int $page = 1): bool
    {
        $this->setSortElements();

        $products = Product::doRetrieveAll(
            $page,
            10,
            $this->orderBy,
            $this->orderWay
        );

        if (isset($products)) {
            foreach ($products as $prod) {
                $this->items[] = [
                    'id' => $prod->id,
                    'title_product' => $prod->title_product,
                    'url_video' => $prod->url_video,
                    'count_likes' => $prod->count_likes
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
            'id' => 'ID',
            'title_product' => 'Name',
            'url_video'    => 'URL Video',
            'count_likes' => 'Likes'
        );

        return $columns;
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'title_product':
            case 'url_video':
            case 'count_likes':
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
            'count_likes' => array('count_likes', false),
        );

        return $sortable_columns;
    }
}

