Vue.component('login', {
	template: `
		<div>
			<!-- Titlebar -->
			<div id="titlebar" class="gradient">
				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<h2>Log In</h2>

							<!-- Breadcrumbs -->
							<nav id="breadcrumbs" class="dark">
								<ul>
									<li><a href="index.php">Home</a></li>
									<li>Log In</li>
								</ul>
							</nav>

						</div>
					</div>
				</div>
			</div>


			<!-- Page Content -->
			<div class="container">
				<div class="row">
					<div class="col-xl-5 offset-xl-3">

						<div class="login-register-page">
							<!-- Welcome Text -->
							<div class="welcome-text">
								<h3>We're glad to see you again!</h3>
								<span>Don't have an account? <a><router-link to="/register">Sign Up!</router-link></a></span>
							</div>

							<!-- Form -->
							<form method="post" id="login-form">
								<div class="input-with-icon-left">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Email Address" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-outline-lock"></i>
									<input type="password" class="input-text with-border" name="password" id="password" placeholder="Password" required/>
								</div>
								<a href="#" class="forgot-password">Forgot Password?</a>
							</form>

							<!-- Button -->
							<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Log In<i class="icon-material-outline-arrow-right-alt"></i></button>

						</div>
					</div>
				</div>
			</div>


			<!-- Spacer -->
			<div class="margin-top-70"></div>
			<!-- Spacer / End-->
		</div>
	`
});
Vue.component('register', {
	template: `
		<div>
			<!-- Titlebar -->
			<div id="titlebar" class="gradient">
				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<h2>Register</h2>

							<!-- Breadcrumbs -->
							<nav id="breadcrumbs" class="dark">
								<ul>
									<li><a href="index.php">Home</a></li>
									<li>Register</li>
								</ul>
							</nav>

						</div>
					</div>
				</div>
			</div>


			<!-- Page Content
			================================================== -->
			<div class="container">
				<div class="row">
					<div class="col-xl-5 offset-xl-3">

						<div class="login-register-page">
							<!-- Welcome Text -->
							<div class="welcome-text">
								<h3 style="font-size: 26px;">Let's create your account!</h3>
								<span>Already have an account? <a><router-link to="/login">Log In!</router-link></a></span>
							</div>

							<!-- Form -->
							<form method="post" id="register-account-form">
								<div class="input-with-icon-left">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="text" class="input-text with-border" name="fname" placeholder="Abimbola Believe" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="email" class="input-text with-border" name="email" placeholder="Email Address" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="text" class="input-text with-border" name="phone" placeholder="07068261774" required/>
								</div>

								<div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
									<i class="icon-material-outline-lock"></i>
									<input type="password" class="input-text with-border" name="pass1" id="password-register" placeholder="Password" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-outline-lock"></i>
									<input type="password" class="input-text with-border" name="pass2" id="password-repeat-register" placeholder="Repeat Password" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-outline-lock"></i>
									<input type="text" class="input-text with-border" name="ageup" placeholder="20 - 25" required/>
								</div>

								<!-- Button -->
								<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form" @click.prevent="submit()">Register <i class="icon-material-outline-arrow-right-alt"></i></button>
							</form>

						</div>

					</div>
				</div>
			</div>


			<!-- Spacer -->
			<div class="margin-top-70"></div>
			<!-- Spacer / End-->
		</div>
	`,
	data () {
		return {
			form: {
				fname: "Oluwatosin Jeremiah",
				email: "jerexbambex@gmail.com",
				phone: "07068261774",
				pass1: "bianimex123",
				pass2: "bianimex123",
				ageup: "25 - 30"
			}
		}
	},
	methods: {
		submit() {

			if(this.form.pass1 !== this.form.pass2) {
				// you could design a fine alert for this
				alert('Passwords dont match')
			}


			const register = new FormData();

			register.append('name', this.form.fname);
			register.append('email', this.form.email);
			register.append('phone', this.form.phone);
			register.append('password', this.form.pass1);
			register.append('age', this.form.ageup);

			axios.post(`${baseUrl}register.php`, register)
				.then(response => {
				    if (response.data.status === true) {
				        alert('All Good!!!')
                    }else {
                        alert(response.data.message)
                    }
				})
				.catch(error => {
					console.log(error.response.data);
				})
		}
	}
});
Vue.component('validate', {
	template: `
		<div>
			<!-- Header Container / End -->

			<!-- Titlebar
			================================================== -->
			<div id="titlebar" class="gradient">
				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<h2>Validation</h2>

							<!-- Breadcrumbs -->
							<nav id="breadcrumbs" class="dark">
								<ul>
									<li><a href="index.php">Home</a></li>
									<li>Validate</li>
								</ul>
							</nav>

						</div>
					</div>
				</div>
			</div>


			<!-- Page Content
			================================================== -->
			<div class="container">
				<div class="row">
					<div class="col-xl-5 offset-xl-3">


						<div class="login-register-page">
							<!-- Welcome Text -->
							<div class="welcome-text">
								<h3>Please check your phone for the validation code</h3>
							</div>

							<!-- Form -->
							<form method="post" id="login-form">
								<div class="input-with-icon-left">
									<i class="icon-line-awesome-clipboard"></i>
									<input type="text" class="input-text with-border" name="emailaddress" id="emailaddress" placeholder="Your code" required/>
								</div>
							</form>

							<!-- Button -->
							<button class="button full-width button-sliding-icon ripple-effect margin-top-10" type="submit" form="login-form">Validate <i class="icon-material-outline-arrow-right-alt"></i></button>

						</div>
					</div>
				</div>
			</div>


			<!-- Spacer -->
			<div class="margin-top-70"></div>
			<!-- Spacer / End-->
		</div>
	`
});
Vue.component('testComponent', {
	template: `<p>testing a redirected link</p>`,
	mounted() {
		alert(this.$route.params.token)
	}
});
const routes = [
    { path: '/login', component: 'login' },
    { path: '/register', component: 'register' },
    { path: '/validate', component: 'validate' },
	{
		path: '/verify-email/:token',
		component: 'testComponent',
		name: 'verifyEmail'
	}
];

const router = new VueRouter({
    routes
});
const projectName = `benj19`;

const baseUrl = `http://localhost/${projectName}/app/`;

new Vue({
	el: "#wrapper",
	router,
});

