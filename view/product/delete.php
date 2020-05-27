<div class="container" style="padding-top: 100px;padding-left: 100px">
    <h3>Are you sure you want to delete?</h3>
    <div class="row" id="product">
        <div class="col-lg-3 col-sm-6 mix all dresses bags">
            <div class="single-product-item">
                <div class="product-text">
                    <p><?php echo "Name :" . $product->getName(); ?></p>
<!--                    <p>--><?php //echo "image: " . $product->getImage(); ?><!--</p>-->
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $product->getId(); ?>">
        <div class="form-group">
            <input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Ban da xoa thanh cong')">
            <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
        </div>
    </form>
</div>