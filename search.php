<!--database connection-->
<?php include "includes/db.php"?>
    <!--header-->
    <?php include "includes/header.php"; ?>

        <!--navigation-->
        <?php include "includes/navigation.php";?>

            <!--page content-->
            <div class="container">

                <div class="row">
                    <!--main entries-->
                    <div class="col-md-8">
                        <?php 
        if(isset($_POST['submit'])){
        $search=$_POST['search'];
        $query="SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
        $search_query=mysqli_query($connection,$query);
        if(!$search_query){
            die("Query failed" . mysqli_error($connection));
        }
        $count = mysqli_num_rows($search_query);
        if($count == 0 ){
            echo"<h1>No Result</h1>";
        }else{
            while($row=mysqli_fetch_assoc($search_query)){
            $post_title=$row['post_title'];
            $post_author=$row['post_author'];
            $post_date=$row['post_date'];
            $post_image=$row['post_image'];
            $post_content=$row['post_content'];
            ?>
			<h2 class="inline"><a href="#"><?php echo $post_title;?></a></h2>

                            <p class="lead inline">
                                by
                                <a href="index.php">
                                    <?php echo $post_author?>
                                </a>
                            </p>

                            <p><span class="glyphicon glyphicon-time"></span> Posted on
                                <?php echo $post_date?>
                            </p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image;?>">
                            <hr>
                            <p>
                                <?php echo $post_content?>
                            </p>
                            <a class="btn btn-primary" href="#">Read More <span class=glyphicon glyphicon-chevron-right></span></a>
                            <hr>
                            <?php    }
        
}
}
?>





                                <!--    exit col-md-8    -->
                    </div>


                    <!--sidebar-->
                    <?php include "includes/sidebar.php"?>
                        <!--footer-->
                        <?php include "includes/header.php"; ?>
                            <!--exit row-->
                </div>
                <!--exit container-->
            </div>