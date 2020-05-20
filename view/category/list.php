
<div class="section-title">
    <h2>List Category</h2><br>
    <a href="../admin/admin.php?page=category&action=add">
        <input type="button" value="Add Category" class="btn btn-success"></a><br>
</div>
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>

    </tr>
    </thead>
    <tbody>

    <?php foreach ($categories as $key =>$category): ?>

    <tr>
        <th scope="row"><?php ++$key ?></th>
        <th scope="row"><?php $category->getName() ?></th>
        <th scope="row"><?php $category->getDescription() ?></th>
        <th>
            <a href=""><input type="button" class="btn btn-danger" value="Delete"></a>
            <a href=""><input type="button" class="btn btn-success" value="Edit"></a>
        </th>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>
