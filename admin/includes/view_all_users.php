<table class="table table-bordered table-hover">
	<thead>
		<tr>
			<th>User ID</th>
			<th>Picture</th>
			<th>Username</th>
			<th>Password</th>
			<th>Email</th>
			<th>Name</th>
			<th>User Status</th>
			<th>Function</th>
			<th>Function</th>
		</tr>
	</thead>

	<tbody>
<?php 
	global $connection;
	$query=$query = "SELECT * FROM users";
	$select_users = mysqli_query($connection,$query);
	while($row = mysqli_fetch_assoc($select_users)) {
		$user_id=$row['user_id'];
		$user_name=$row['user_name'];
		$user_password=$row['user_password'];
		$first_name=$row['first_name'];
		$last_name=$row['last_name'];
		$user_image = $row['user_image'];
		$user_email=$row['user_email'];
		$user_level=$row['user_level'];
		$user_password=substr($user_password,7,17);
	
		echo "<td>{$user_id}</td>";
		echo "<td><a href='../images/{$user_image}'><img src='../images/{$user_image}' alt='{$user_image}' class='img-responsive' width='100px'></a></td>";
		echo "<td>{$user_name}</td>";
		echo "<td>{$user_password}...</td>";
		echo "<td>{$user_email}</td>";
		echo "<td>{$first_name} {$last_name}</td>";
		echo "<td>{$user_level}</td>";
		echo "<td><a href='users.php?source=edit_user&u_id={$user_id}'>Edit</a></td>";
		echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
		
	echo "</tr>";
	}