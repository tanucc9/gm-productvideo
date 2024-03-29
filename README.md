# gm-productvideo
## Introduction
This WordPress plugin has been developed to show a list of products with a video instead of an image. For the moment, it supports only videos from youtube.
Is possible to manage the products and the categories on the back office from the 'GM Products' tab and to show the lists on the front office putting the shortcodes whatever you want.
There is the possibility to like the products too.
## Installation
1. download plugin from Github
2. extract the content on your pc
3. Rename the folder in gm-productvideo
4. From CLI go to gm-productvideo directory and execute the command:
```composer install```.
Now you should have the vendor directory too
6. Create an archive zip
7. Load it from the back office in the plugin section
## Shortcodes
##### gm_pv_showcategory
Show the products of a specific category. The param to pass is id_category.
Example:
```
[gm_pv_showcategory id_category=7]
```
Shortcode gm_pv_showcategory also can take another param called 'preview'. It will show a preview of the category with the number of products passed to 'preview'. Example:
```
[gm_pv_showcategory id_category=7 preview=3]
```
##### gm_pv_show_products
This shortcode shows the product list ordered by most liked or latest added. It takes a param called 'type':
- if the type has value 'most_liked', then it will show products most liked
- if the type has value 'newest', then it will show the latest products

Examples:
```
[gm_pv_show_products type=most_liked]
```
```
[gm_pv_show_products type=newest]
```
Another param that you can pass is num_products where you can specify the number of products that you want to show.
Example:
```
[gm_pv_show_products type=newest num_products=5]
```
```
[gm_pv_show_products type=most_liked num_products=9]
```
## Hooks
#### gm_pv_edit_static_content
```
$extraContent = apply_filters("gm_pv_edit_static_content", $extraContent);
```
This hook is in the class GMProductVideo\Shortcodes\FrontShowProducts. It is possible to edit the static content below the products.

## Compatibility
The plugin was tested on WordPress ```5.6.2``` and ```6.3.2```.
