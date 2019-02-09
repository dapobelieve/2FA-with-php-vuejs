Vue.component('login', {
	template: `
		<div>
			<div class="jumbotron jumbotron-fluid">
					<div class="container">
					    <h1 class="display-4">Login Page</h1>
					    <p class="lead">Please log in through this page.</p>
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
	`
});
Vue.component('register', {
	template: `
		<div>
			<div class="jumbotron jumbotron-fluid">
					<div class="container">
					    <h1 class="display-4">Register Page</h1>
					    <p class="lead">Welcome new user. Please sign up here</p>
				  	</div>
			</div>
			<div class="container col-md-4">
				<form>
					<div class="form-group">
						<label for="exampleInputEmail1">Full name</label>
						<input type="text" class="form-control my-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Dapo Micheals">
						<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
					</div>
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
						<label for="exampleInputPassword1">Password</label>
						<input type="text" class="form-control my-input" id="exampleInputPassword1" placeholder="07068261774">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary my-button">Submit</button>
					</div>
				</form>
			</div>
		</div>
	`
});
Vue.component('validate', {
	template: `
		<div>
			<div class="jumbotron jumbotron-fluid">
					<div class="container">
					    <h1 class="display-4">Validate Page</h1>
					    <p class="lead">Kindly check your phone for the validation code.</p>
				  	</div>
			</div>
			<div class="container col-md-4">
				<div class="form-group">
					<label for="exampleInputPassword1">Validation Code</label>
					<input type="text" class="form-control my-input" id="exampleInputPassword1" placeholder="your code here">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary my-button">Submit</button>
				</div>
			</div>
		</div>
	`
});

const routes = [
    { path: '/login', component: 'login' },
    { path: '/register', component: 'register' },
    { path: '/validate', component: 'validate' }
];

const router = new VueRouter({
    routes
});


new Vue({
	el: "#app",
	router,
	data: {
		text: ''
	}
})

