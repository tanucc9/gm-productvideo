<?php

namespace GMProductVideo;

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
        new \GMProductVideo\Shortcodes\FrontShowProducts();
        new \GMProductVideo\Front\FrontMedia();
        new \GMProductVideo\Controller\CountLikesProductAjaxController();
    }
}
