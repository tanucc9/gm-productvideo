<div class="container">
<h3 id="title-showproducts">Products</h3>

<?php
    include(GM_PV__PLUGIN_DIR . 'views/parts/alert.php');
?>

<?php
    if ( isset($products) ) { ?>
        <table class="table table-hover">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name Product</th>
                <th scope="col">URL Video</th>
                <th scope="col">Last Edit</th>
                <th scope="col">Actions</th>
            </tr>
        <?php foreach ($products as $product) { ?>
            <tr id="row_<?php echo $product->id ?>">
                <td scope="row"><p><?php echo $product->id ?></p></td>
                <td class="title_field">
                    <p><?php echo $product->title_product ?></p>
                    <input type="text" value="<?php echo $product->title_product ?>">
                </td>
                <td class="url_field">
                    <p><?php echo $product->url_video ?></p>
                    <input type="text" value="<?php echo $product->url_video ?>">
                </td>
                <td><p><?php echo $product->last_edit ?></p></td>
                <td class="icons">
                    <ul>
                        <li id="delete_<?php echo $product->id ?>" class="action_delete">
                            <a href="#"><span class="dashicons dashicons-trash"></span></a>
                        </li>
                        <li id="edit_<?php echo $product->id ?>" class="action_edit">
                            <a href="#"><span class="dashicons dashicons-edit-page"></span></a>
                        </li>

                        <li id="save_<?php echo $product->id ?>" class="save_edit">
                            <button type="button" class="btn btn-primary btn-sm">Save</button>
                        </li>
                    </ul>
                </td>
            </tr>
        <?php } ?>
        </table>
<?php } else { ?>
    <h6>You haven't inserted products yet.</h6>
<?php } ?>

    <!--- Pagination --->
    <?php //TODO ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
</div>