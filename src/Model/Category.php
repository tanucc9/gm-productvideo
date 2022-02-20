<?php

namespace GMProductVideo\Model;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

use GMProductVideo\Logs\Log;

class Category
{
    /** @var id id_category */
    public $id;

    /** @var last_edit last cat modification */
    public $last_edit;

    /** @var title_category title */
    public $title_category;


    /** @var table's name without prefix wordpress */
    private static $name_table = 'pv_categories';

    public function __construct($id = null, $title_category = null, $last_edit = null)
    {
        if (null !== $id) {
            $this->id = $id;
        }
        if (null !== $last_edit) {
            $this->last_edit = $last_edit;
        }
        if (null !== $title_category) {
            $this->title_category = $title_category;
        }
    }

    public static function doRetrieveAll(
        $page = null,
        $limit = 10,
        $orderBy = 'id_product',
        $orderWay = 'asc'
    ) {
        global $wpdb;

        $table = $wpdb->prefix.self::$name_table;
        $sql = 'SELECT * FROM '.$table;

        if (isset($orderBy, $orderWay)) {
            $sql .= ' ORDER BY ' . $orderBy . ' ' . $orderWay;
        }

        if (isset($limit, $page)) {
            $page--;
            $elemToSkip = $limit * $page;
            $sql .= ' LIMIT ' . $limit . ' OFFSET ' . $elemToSkip;
        }

        $result = $wpdb->get_results($sql);

        if (count((array) $result) >= 1) {
            $categories = [];
            foreach ($result as $row) {
                $cat = new Category($row->id_category, $row->title_category, $row->last_edit);
                array_push($categories, $cat);
            }

            return $categories;
        }

        return null;
    }

}
