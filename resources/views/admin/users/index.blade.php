<!DOCTYP html>
<html lang="en" dir="ltr"> 
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title> Courses HUB</title>
	<!-- FontAwesome-->
	<link rel="stylesheet" href="/assets/css/fontawesome.min.css">
	<!-- BootStrap-->
	<link rel="stylesheet" href="/assets/css/uikit.min.css">
	<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
	<!-- Main Style-->
	<link rel="stylesheet" href="/assets/css/index.css">

</head>
<body style="background-color:#EFEFEF">

<!-- Start Nav-Bar -->
<nav class="navbar navbar-expand-lg navbar-light adminheader">
	
  <a class="navbar-brand" href="#"><img class="logo "src="/assets/images/logo.png" alt="Logo"/></a>
 
 	<button class="changmode d-none d-md-block" onclick="theDoor()">
			<span></span>
			<span></span>
			<span></span>
	</button>
	<div class="menu ml-auto">
		<img src="/assets/images/avater.jpg" >
	</div>
</nav>
<!-- End Nav-Bar -->
<!-- Start The Content -->
	
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="right-side col-md-3 active" id="thedoor">
				<div class="tools ">
					<div class="tool">
						<i class="fas fa-users"></i>
						<span>Users</span>
					</div>
					<div class="tool">
						<i class="far fa-sticky-note"></i>
						<span>Categories</span>
					</div>
					<div class="tool">
					<i class="fas fa-quote-left"></i>
						<span>Testimonials</span>
					</div>
					<div class="tool">
						<i class="fas fa-plus"></i>
						<span>Courses</span>
					</div>
					<div class="tool">
						<i class="fas fa-plus"></i>
						<span>Partenrs</span>
					</div>
				</div>
			</div>
			<div class="left-side col-md-9 full-width" id="full-width">
				<div class="add-new">
          <div class="p-2">
            <h3 class="text-muted px-4">Show users</h3>
            <a href="/admin/users/create" class="btn btn-success">
            	<span class="fa fa-plus"></span>
            	<span>Create User</span>
            </a>
				@include('includes.alerts')

        	<form class="row px-3">
        		<div class="col-12 col-md-6 form-group">
        			<select class="form-control" name="limit">
        				<?php
        				foreach ($limits as $value) {
	        				echo "<option " . ($value == $limit ? 'selected' : '') . " value='{$value}'>{$value}</option>";
        				}
        				?>
        			</select>
        		</div>
        		<div class="col-12 col-md-6 form-group">
        			<input class="form-control" type="search" name="q" placeholder="Search ..." value="<?php echo $q; ?>">
        		</div>
        		<div class="col-12 col-md-6">
        			<ul class="pagination">
        				<li class="page-item">
        					<a class="page-link" href="?page=1">1</a>
        				</li>
        			</ul>
        		</div>
        		<div class="col-12 col-md-6 form-group">
        			<button type="submit" class="btn btn-success">Search</button>
        		</div>
        	</form>

            <div class="table-responsive">
            	<?php // view_alerts(); ?>
	            <table class="table table-hover">
	            	<thead>
	            		<tr>
	            			<th>#</th>
	            			<th>Name</th>
	            			<th>Email</th>
	            			<th>Avatar</th>
	            			<th>Created At</th>
	            			<th>Active</th>
	            			<th>Role</th>
	            			<th>Actions</th>
	            		</tr>
	            	</thead>
	            	<tbody>
	            		<?php
	            		foreach ($users as $key => $user) {
	            		?>
	            		<tr>
	            			<td><?php echo $key + 1; ?></td>
	            			<td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
	            			<td><?php echo $user['email']; ?></td>
	            			<td>
	            				<img src="<?php echo $user['avatar']; ?>" width="40px" class="rounded-circle">
	            			</td>
	            			<td><?php echo $user['created_at']; ?></td>
	            			<td>
	            				<span class="fa fa-check-circle <?php echo $user['active'] == 1 ? 'text-success' : 'text-muted';?>"></span>
	            			</td>
	            			<td><?php echo $user['role_name']; ?></td>
	            			<td>
	            				<a class="btn btn-danger btn-sm" href="delete_user_process.php?user_id=<?php echo $user['id'];?>"><span class="fa fa-times text-white"></span></a>
	            				<a class="btn btn-primary btn-sm" href="edit_user.php?user_id=<?php echo $user['id'];?>"><span class="fa fa-edit text-white"></span></a>
	            			</td>
	            		</tr>
		            	<?php } ?>
	            	</tbody>
	            </table>
            </div>
          </div>
				</div>
			</div>
		</div>
		
	</div>
</div>

<!-- End The Content -->

<!-- Jquery-->
<script src="/assets/js/jquery-3.3.1.min.js"></script>

<!-- BootStrap And Other Js -->
<script src="/assets/js/bootstrap.min.js"></script>
<script src="/assets/js/main.js"></script>
</body>
</html>