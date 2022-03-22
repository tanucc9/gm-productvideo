# gm-productvideo
### Introduction
This wordpress plugin has been developed to show a list of products with a video instead of the image. For the moment, it supports only videos from youtube.
Is possible to manage the products and the categories on the back office from the 'GM Products' tab and to show the lists on front office putting the shortcodes whatever you want.
There is the possibility to like the products too.
Tested on wordpress 5.6.2.
### Installation
1. download plugin from github
2. extract the content on your pc
3. Rename the folder in gm-productvideo
4. From cli go to gm-productvideo directory and execute the command:
```composer install```.
Now you should have the vendor directory too
6. Create an archive zip
7. Load it from Back office in plugin section
### Shortcodes
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
- if type has value 'most_liked', then it will show products most liked
- if type has value 'newest', then it will show the latest products

Examples:
```
[gm_pv_show_products type=most_liked]
```
```
[gm_pv_show_products type=newest]
```
