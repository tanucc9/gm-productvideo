<?php

namespace GMProductVideo\Admin;

use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

class AdminViewCategory
{
    protected $idCategory;

    public function __construct(int $id = null)
    {
        if (isset($id)) {
            $this->idCategory = $id;
        } elseif (isset($_GET['id'])) {
            $this->idCategory = (int)$_GET['id'];
        }
    }

    public function display()
    {
        if (isset($this->idCategory)) {
            $cat = Category::doRetrieveById($this->idCategory);
        } else {
            $alertType = 'danger';
            $alertMessage = 'There was an error with view page.';
        }

        // vars admin header
        $titleHeader = isset($prod->id) ? 'Category ' . $prod->id : 'Category';
        $urlNewElem = admin_url('admin.php?page=' . AdminShowCategories::$menuSlag);
        $textBtnNewElem = 'Back to Show Categories';

        $action = 'view_category';
        $selectedProducts = CategoryProduct::getIdsProductsCategory($this->idCategory);
        $products = Product::doRetrieveAll(null, null, 'title_product');

        include GM_PV__PLUGIN_DIR.'views/admin/admin-category-view.php';
    }
}
