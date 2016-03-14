<?php $query = "SELECT * FROM authors WHERE author_id={$author_id}";
						$select_author_id = mysqli_query($connection,$query);
                        while($row = mysqli_fetch_assoc($select_author_id)) {
                        $author_id = $row['author_id'];
                        $author_name = $row['author_name'];
						?>
						<input value="<?php if(isset($author_name)){echo $author_name;}?>"type="text" name="author_name" class="form-control">
                       <?php 	} ?>
                       <?php //UPDATE QUERY
							 if(isset($_POST['author_name'])){
                            $the_author_name=$_POST['author_name'];
							$the_author_name=ucwords($the_author_name);
                            $query = "UPDATE authors SET `author_name` = '{$the_author_name}' WHERE author_id = {$author_id}";
                            $update_query=mysqli_query($connection,$query);
								if(!$update_query){
									die('Query Failed'.mysqli_error($connection));
								}
                           header("Location: author.php");
							 }

						?>