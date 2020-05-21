<div class="container" style="padding-top: 100px;padding-left: 100px">
    <div class="row">
        <div class="col-md-6">
            <h2>Edit Category :</h2>
            <form role="form" method="post">
                <div class="form-group">
                    <label for="" class="loginFormElement" >Name</label>
                    <input class="form-control" name="name" type="text" value="<?php echo $category->getName(); ?>">
                </div>
                <input type="hidden" name="id" value="<?php echo $category->getId(); ?>">
                <div class="form-group">
                    <label for="" class="loginFormElement">Description</label>
                    <input class="form-control" name="description" type="text" value="<?php echo $category->getDescription(); ?>">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success loginFormElement">Edit</button>
                    <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>