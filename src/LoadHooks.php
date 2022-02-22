<?php

namespace GMProductVideo;

use GMProductVideo\Controller\DeleteProductAjaxController;
use GMProductVideo\Controller\EditProductAjaxController;

class LoadHooks
{
    public function __construct()
    {
        new \GMProductVideo\Admin\AdminSettings();
        new \GMProductVideo\Admin\AdminAddProduct();
        new \GMProductVideo\Admin\AdminMedia();
        new \GMProductVideo\Admin\AdminShowProducts();
        new \GMProductVideo\Admin\AdminShowCategories();
        new \GMProductVideo\Admin\AdminAddCategory();
        new \GMProductVideo\Shortcodes\FrontShowCatogories();
        new EditProductAjaxController();
        new DeleteProductAjaxController();
    }
}