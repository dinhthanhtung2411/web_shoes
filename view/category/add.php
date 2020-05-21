<div class="container" style="padding-top: 100px;padding-left: 100px">
<div class="row">
        <div class="col-md-6">
            <h2>Add Category : </h2>
            <form role="form" method="post">
                <div class="form-group">
                    <label for="" class="loginFormElement">Name</label>
                    <input class="form-control" name="name" type="text">
                </div>
                <div class="form-group">
                    <label for="" class="loginFormElement">Description</label>
                    <input class="form-control" name="description" type="text">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success loginFormElement" onclick="return confirm('Bạn đẫ tạo thành công ')">Add Category</button>
                    <button class="btn btn-secondary" onclick="window.history.go(-1); return false;">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>