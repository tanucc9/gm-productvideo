<?php

namespace GMProductVideo\Admin;

use GMProductVideo\Model\Category;
use GMProductVideo\Model\CategoryProduct;
use GMProductVideo\Model\Product;

defined('ABSPATH') or exit('access denied.');

include ABSPATH.'wp-content/plugins/gm-productvideo/config/defines.php';

class AdminEditProduct
{
    protected $idProduct;

    public function __construct(int $id = null)
    {
        if (isset($id)) {
            $this->idProduct = $id;
        } elseif (isset($_GET['id'])) {
            $this->idProduct = (int)$_GET['id'];
        }
    }

    public function display()
    {
        if (isset($this->idProduct)) {
            $prod = Product::doRetrieveById($this->idProduct);
        } else {
            $alertType = 'danger';
            $alertMessage = 'There was an error with edit page.';
        }

        // vars admin header
        $titleHeader = isset($prod->id) ? 'Edit Product ' . $prod->id : 'Edit Product';
        $urlNewElem = admin_url('admin.php?page=' . AdminShowProducts::$menuSlag);
        $textBtnNewElem = 'Back to Show Products';

        $action = 'submit_edit';
        $textSubmitBtn = 'Update';
        $selectedCategories = CategoryProduct::getCategoriesProduct($this->idProduct);
        $categories = Category::doRetrieveAll(null, null, 'title_category');

        include GM_PV__PLUGIN_DIR.'views/admin/admin-product-view.php';
    }
}
