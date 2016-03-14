<!--sidebar widgets column-->
<div class="col-md-4" float="right">

    <!--search well-->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                <button name="submit" class="btn btn-default" type="submit">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
                <!--exit input group-->
            </div>
            <!--exit search form-->
        </form>
        <!--    exit search well    -->
    </div>



    <!--categories well-->
    <div class="well">
        <h4>Categories</h4>
        <div class="row">
            <div class="col-lg-6">
                <ul class="list-unstyled">
            <?php
                $query = "SELECT * FROM `categories`";
                $select_categories_sidebar = mysqli_query($connection,$query);
                while($row=mysqli_fetch_assoc($select_categories_sidebar)){
				$cat_id=$row['cat_id'];
                $cat_title=$row['cat_title'];
                echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a></li>";
                }
            ?>
                        <!--exit list        -->
                </ul>
                <!--exit col-lg-6-->
            </div>
            <!--exit row-->
        </div>
        <!--exit catgories well    -->
    </div>
    <?php include "includes/widget.php"?>
    <!--exit col-md-4-->
</div>