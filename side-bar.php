<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
            <li class="active">
                <a class="" href="index.html">
                    <i class="icon_house_alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sub-menu">
            </li>

            <li class="sub-menu">
                <a <?php if ($_GET["page"] == ["category"]) echo "class='active"?>href="admin.php?page=category" class="">
                    <i class="icon_table"></i>
                    <span>Category</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
            </li>
            <li class="sub-menu">
                <a <?php if ($_GET["page"] == ["product"]) echo "class='active"?>href="admin.php?page=product" class="">
                    <i class="icon_table"></i>
                    <span>Product</span>
                    <span class="menu-arrow arrow_carrot-right"></span>
                </a>
            </li>


        </ul>
    </div>
</aside>
        <!-- sidebar menu end-->
