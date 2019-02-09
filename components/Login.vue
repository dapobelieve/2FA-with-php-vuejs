<template>
	<div>
		<div class="jumbotron jumbotron-fluid">
				<div class="container">
				    <h1 class="display-4">Login Page</h1>
				    <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
			  	</div>
		</div>

		<div class="container col-md-4">
			<form>
				<div class="form-group">
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" class="form-control my-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">Password</label>
					<input type="password" class="form-control my-input" id="exampleInputPassword1" placeholder="Password">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary my-button">Submit</button>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	export default {
		//
	}
</script>