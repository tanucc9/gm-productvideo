<?php

namespace GMProductVideo\Utilities;

use GMProductVideo\Model\Category;
use GMProductVideo\Model\Product;
use GMProductVideo\Shortcodes\FrontShowCatogories;

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

class AdminListCategories extends CustomAdminListTable
{
    protected function setSortElements()
    {
        parent::setSortElements();

        if (!isset($this->orderBy)) {
            $this->orderBy = 'id_category';
        }
    }

    public function prepare_items()
    {
        parent::prepare_items();
        $this->set_pagination_args([
            'total_items' => Category::getNumCategories(),
            'per_page'    => 10,
        ]);
    }

    public function prepareCategories(int $page = 1): bool
    {
        $this->setSortElements();

        $categories = Category::doRetrieveAll(
            $page,
            10,
            $this->orderBy,
            $this->orderWay
        );

        if (isset($categories)) {
            foreach ($categories as $cat) {
                $this->items[] = [
                    'id' => $cat->id,
                    'title_category' => $cat->title_category,
                    'shortcode' => '[' . FrontShowCatogories::$shortcodeName . ' id_category=' . $cat->id .']',
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
            'title_category' => 'Title Category',
            'shortcode' => 'Shortcode',
        );

        return $columns;
    }

    public function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'id':
            case 'title_category':
            case 'shortcode':
                return $item[$column_name];
            default:
                return print_r($item, true) ; //Show the whole array for troubleshooting purposes
        }
    }

    public function get_sortable_columns()
    {
        $sortable_columns = array(
            'id' => array('id_category', false),
            'title_category'  => array('title_category', false),
        );

        return $sortable_columns;
    }

    public function column_shortcode($item): string
    {
        $actions = array(
            'copy_shortcode' => sprintf('<a style="color: #007bff; cursor: pointer" id="copy_shortcode" data-shortcode="' . $item['shortcode'] .'">Copy shortcode</a>'),
        );

        return sprintf('%1$s %2$s', $item['shortcode'], $this->row_actions($actions));
    }
}

