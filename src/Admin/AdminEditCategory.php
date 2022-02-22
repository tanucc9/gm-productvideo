<?php

namespace GMProductVideo\Admin;

use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

class AdminEditCategory
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
            $alertMessage = 'There was an error with edit page.';
        }

        // vars admin header
        $titleHeader = isset($prod->id) ? 'Edit Category ' . $cat->id : 'Edit Category';
        $urlNewElem = admin_url('admin.php?page=' . AdminShowCategories::$menuSlag);
        $textBtnNewElem = 'Back to Show Categories';

        $action = 'submit_edit';
        $textSubmitBtn = 'Update';
        $selectedProducts = CategoryProduct::getIdsProductsCategory($this->idCategory);
        $products = Product::doRetrieveAll(null, null, 'title_product');

        include GM_PV__PLUGIN_DIR.'views/admin/admin-category-view.php';
    }
}
