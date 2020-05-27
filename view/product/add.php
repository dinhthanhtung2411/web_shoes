
<div class="container" style="padding-top: 100px;padding-left: 100px">
<!--    --><?php //if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
<!--        <div class="alert alert---><?php //if ($isSuccess) echo "success"; else echo "danger"; ?><!--" role="alert">-->
<!--            --><?php //echo $message;?>
<!--        </div>-->
<!--    --><?php //endif; ?>
    <div class="row">
        <div class="col-md-6">
            <h2>Add Product : </h2>
            <form role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="productname" class="loginFormElement">Name Product:</label>
                    <input class="form-control" name="name" type="text">
                </div>
                <div class="form-group">
                    <label class="control-label">Product Image</label>
                    <input name="images[]" type="file" multiple>
                </div>
                <div class="form-group">
                    <label for="productprice" class="loginFormElement">Product Price</label>
                    <input class="form-control" name="price" type="number">
                </div>
                <p>Product Type</p>
                <select class="form-control" id="productSelect" name="category_id"
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->getId(); ?>"><?php echo $category->getName(); ?></option>
                    <?php endforeach;?>
                </select>
                <div class="form-group">
                    <label for="" class="loginFormElement">Description</label>
                    <input class="form-control" name="description" type="text">
                </div>
                <div>
                <input type="hidden" name="createdDate" value="<?php
                date_default_timezone_set("Asia/Ho_Chi_Minh"); echo date("Y-m-d H:i:s"); ?>"
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success loginFormElement" onclick="return confirm('Bạn đẫ tạo thành công ')">Add Product</button>
                    <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>