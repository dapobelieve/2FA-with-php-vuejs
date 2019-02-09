<!DOCTYPE html5>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Login page SPA</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/mine.css">
	</head>

	<body>
		<div id="app">

			<div class="container col-md-4 text-center">
				<div class="btn-group" role="group" aria-label="Basic example">
					<router-link to="/login" class="btn btn-outline-secondary">Login</router-link>
					<router-link to="/register" class="btn btn-outline-secondary">Register</router-link>
					<router-link to="/validate" class="btn btn-outline-secondary">Validate</router-link>
				</div>
			</div>

			<router-view></router-view>

			<input type="text" v-model="text">
			{{ text }}
		</div>

		<!-- Jquery, Popper and bootstrap js -->
		<script src="js/jquery.slim.js"></script>
		<script src="js/popper.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

		<!-- Vue js and Axios -->
		<script src="js/vue.js"></script>
		<script src="js/vuerouter.js"></script>
		<script src="js/axios.min.js"></script>
		<script src="js/main.js"></script>
	</body>
</html>