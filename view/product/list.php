<div class="container" style="padding-top: 100px; padding-left: 100px">
    <div class="section-title">
        <h2>List Product</h2><br>
        <a href="?page=product&action=add">
            <input type="button" value="Add Category" class="btn btn-success"></a><br>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Image</th>
            <th scope="col">Price</th>
            <th scope="col">Category_id</th>
            <th scope="col">Image_id</th>
            <th scope="col">Description</th>
            <th scope="col">Created Time</th>

        </tr>
        </thead>
        <tbody>

        <?php foreach ($products as $key =>$product): ?>

            <tr>
                <th scope="row"><?php echo ++$key ?></th>
                <th scope="row"><?php echo $product->getName() ?></th>
                <th scope="row"><?php echo $product->getImage() ?></th>
                <th scope="row"><?php echo $product->getPrice() ?></th>
                <th scope="row"><?php echo $product->getCategoryId() ?></th>
                <th scope="row"><?php echo $product->getImageId() ?></th>
                <th scope="row"><?php echo $product->getDescription() ?></th>
                <th scope="row"><?php echo $product->getCreatedDate() ?></th>
                <th>
<!--                    <a href="?page=category&action=delete&id=--><?php //echo $category->getId(); ?><!--"><input type="button" class="btn btn-danger" value="Delete""></a>-->
<!--                    <a href="?page=category&action=edit&id=--><?php //echo $category->getId(); ?><!--"><input type="button" class="btn btn-success" value="Edit"></a>-->
                </th>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>