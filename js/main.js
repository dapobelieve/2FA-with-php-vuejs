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
									<input type="text" class="input-text with-border" v-model='email' placeholder="Email Address" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-outline-lock"></i>
									<input type="password" class="input-text with-border" v-model='password'  placeholder="Password" required/>
								</div>
								<!--<a href="#" class="forgot-password">Forgot Password?</a>-->
							</form>

							<!-- Button -->
							<button
								class="button full-width button-sliding-icon ripple-effect margin-top-10"
								type="submit"
								:disabled="btn.state"
								form="login-form"
								@click.prevent="login()">
									{{ btn.text }}
									<i class="icon-material-outline-arrow-right-alt"></i>
								</button>

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
			btn: {
				state: false,
				text: 'Login'
			},
			email: null,
			password: null
		}
	},
	methods: {
		login () {
			if(!this.email || !this.password) {
				alert('All Fields Required')
				return;
			}

			const login = new FormData()
			login.append('email', this.email)
			login.append('password', this.password)

			this.btn.state = true;
			this.btn.text = "Processing...";

			axios.post(`${baseUrl}login.php`, login)
			.then(response => {							
				if(response.data.status == true) {
					localStorage.setItem('CUser', JSON.stringify(response.data.data));
					this.$router.replace({
						path: 'profile'
					})
					
				}else {
					alert(response.data.message)
					this.btn.state = false;
					this.btn.text = 'Login';
					// return;
				}
				
			})
			.catch(error => {
				console.log('Some error occured')
			})
		}
	}
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
							<form id="register-account-form">
								<div class="input-with-icon-left">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="text" class="input-text with-border" v-model="form.fname" placeholder="Abimbola Believe" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="email" class="input-text with-border" v-model="form.email" placeholder="Email Address" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-baseline-mail-outline"></i>
									<input type="text" class="input-text with-border" v-model="form.phone" placeholder="07068261774" required/>
								</div>

								<div class="input-with-icon-left" title="Should be at least 8 characters long" data-tippy-placement="bottom">
									<i class="icon-material-outline-lock"></i>
									<input type="password" class="input-text with-border" v-model="form.pass1" id="password-register" placeholder="Password" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-outline-lock"></i>
									<input type="password" class="input-text with-border" v-model="form.pass2" id="password-repeat-register" placeholder="Repeat Password" required/>
								</div>

								<div class="input-with-icon-left">
									<i class="icon-material-outline-lock"></i>
									<input type="text" class="input-text with-border" v-model="form.ageup" placeholder="20 - 25" required/>
								</div>
								<!-- Button -->
								<button
								class="button full-width button-sliding-icon ripple-effect margin-top-10"
								type="submit"
								:disabled="btn.state"
								form="login-form"
								@click.prevent="submit()">
									{{ btn.text }}
									<i class="icon-material-outline-arrow-right-alt"></i>
								</button>
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
			btn: {
				state: false,
				text: 'Register'
			},
			form: {
				fname: "",
				email: "",
				phone: "",
				pass1: "",
				pass2: "",
				ageup: ""
			}
		}
	},
	methods: {
		submit() {
			if(!this.form.fname || !this.form.email || !this.form.phone || !this.form.pass1 || !this.form.ageup) {
				alert('All fields are required.');
				return;
			}

			if(this.form.phone.length !== 11) {
				alert('Phone Number should be 11 digits');
			}

			if(this.form.pass1 !== this.form.pass2) {
				// you could design a fine alert for this
				alert('Passwords dont match');
				return;
			}

			this.btn.state = true;
			this.btn.text = "Processing...";

			const register = new FormData();

			register.append('name', this.form.fname);
			register.append('email', this.form.email);
			register.append('phone', this.form.phone);
			register.append('password', this.form.pass1);
			register.append('age', this.form.ageup);

			axios.post(`${baseUrl}register.php`, register)
				.then(response => {
					this.btn.state = false;
					this.btn.text = 'Register';

				    if (response.data.status === true) {
				        alert(response.data.message)
                    }else {
                        alert(response.data.message)
                    }
				})
				.catch(error => {
					this.btn.state = false
					this.btn.text = 'Register'
					console.log(error.response.data);
				})
		}
	}
});
Vue.component('validate', {
	template: `
		<div>
			<div id="titlebar" class="gradient">
				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<h2>Mobile Phone Verification</h2>
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

			<div class="container">
				<div class="row">
					<div class="col-xl-5 offset-xl-3">
						<div class="login-register-page">
							<!-- Welcome Text -->
							<div class="welcome-text">
								<h3>Please check your phone for the validation token</h3>
							</div>
							<!-- Form -->
							<form method="post" id="login-form">
								<div class="input-with-icon-left">
									<i class="icon-line-awesome-clipboard"></i>
									<input type="text" class="input-text with-border" v-model="token"  placeholder="Enter Token" required/>
								</div>
							</form>
							<a href="" class="forgot-password">Resend Code</a>
							<!-- Button -->
							<button
							@click.prevent="processToken()"
							class="button full-width button-sliding-icon ripple-effect margin-top-10"
							type="submit"
							:disabled="btn.state"
							form="login-form">{{ btn.text }}
							<i class="icon-material-outline-arrow-right-alt"></i>
							</button>
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
			token: '',
			btn: {
				state: false,
				text: 'Verify'
			}
		}
	},
	methods: {
		processToken()
		{
			if(!this.token) {
				alert("Please enter token sent to your mobile number");
			}

			this.btn.state = true;
			this.btn.text  = 'Verifying...';


			const sv = new FormData();
			sv.append('token', this.token);
			sv.append('id', this.$route.params.id);
			axios.post(`${baseUrl}smsVerify.php`, sv)
				.then(response => {
					if(response.data.status === true) {
						// console.log(response.data.data);
						localStorage.setItem('CUser', JSON.stringify(response.data.data));
						alert(response.data.message)
						this.$router.replace({
							path: '/profile'
						})
					}else {
						alert(response.data.message)
					}
					// this.$router.replace({
					// 	path: 'path-dashboard'
					// })
				})
				.catch(error => {
					console.log(error.response);
				})
			console.log(this.$route.params.id)
		}
	}
});
Vue.component('verifyComponent', {
	template: `
		<div>
			<div id="titlebar" class="gradient">
				<div class="container">
					<div class="row">
						<div class="col-md-12">

							<h2>Email Validation</h2>

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

			<div class="container" v-if="!loader">
				<div class="row" v-if="emailValid">
					<div class="col-xl-5 offset-xl-3">
						<div class="welcome-text">
							<h3>{{ validMsg }}</h3>
							<small>A token has been sent to your mobile number.</small>
						</div>
					</div>
				</div>
				<div v-else>
					<div class="col-xl-5 offset-xl-3">
						<div class="welcome-text">
							<h3>Invalid Verification Link.</h3>
						</div>
					</div>
				</div>
			</div>

			<span v-if='loader'>
				<div class="welcome-text">
					<h3>Verifying your email address</h3>
				</div>
				<div class="loader"></div>
			</span>

			<!-- Spacer -->
			<div class="margin-top-70"></div>
			<!-- Spacer / End-->
		</div>`,
	data () {
		return {
			loader: true,
			emailValid: false,
			// showPhone: false,
			validMsg: '',
		}
	},
	methods: {
		sendCode() {
			console.log('Sending Code...');
		}
	},
	mounted() {
		//grab token and verify email
		let token = this.$route.params.token;
		const ve = new FormData();
		ve.append('val', token);

		axios.post(`${baseUrl}verify.php`,ve)
		.then(response => {
				setTimeout(() => {
					if(response.data.status) {
						this.emailValid = true;
						this.validMsg = response.data.message
						setTimeout(() => {
							this.$router.replace({
								path: '/validate/'+response.data.data
							})
						}, 5000)
					}else {
						this.validMsg = response.data.message
					}

					this.loader = false;
				}, 2000)

		})
		.catch(error => {
			console.log(error.response.data)
		})
	}
});
Vue.component('profile', {
	template: `
		<div>
			<!-- Titlebar
			================================================== -->
			<div class="single-page-header freelancer-header" data-background-image="images/single-freelancer.jpg">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="single-page-header-inner">
								<div class="left-side">
									<div class="header-image freelancer-avatar"><img src="images/james.jpg" alt=""></div>
									<div class="header-details">
										<h3>Ogungbangbe Oluwatobi Benjamin <span>iOS Expert + Node Dev</span></h3>
										<ul>
											<li><div class="star-rating" data-rating="5.0"></div></li>
											<li><img class="flag" src="images/flags/ng.svg" alt=""> Nigeria</li>
											<li><div class="verified-badge-with-title">Verified</div></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


			<!-- Page Content
			================================================== -->
			<div class="container">
				<div class="row">

					<!-- Content -->
					<div class="col-xl-8 col-lg-8 content-right-offset">

						<!-- Page Content -->
						<div class="single-page-section">
							<h3 class="margin-bottom-25">About Me</h3>
							<p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition. Organically grow the holistic world view of disruptive innovation via workplace diversity and empowerment.</p>

							<p>Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
						</div>

						<!-- Boxed List -->
						<div class="boxed-list margin-bottom-60">
							<div class="boxed-list-headline">
								<h3><i class="icon-material-outline-thumb-up"></i> Work History and Feedback</h3>
							</div>
							<ul class="boxed-list-ul">
								<li>
									<div class="boxed-list-item">
										<!-- Content -->
										<div class="item-content">
											<h4>Web, Database and API Developer <span>Rated as Freelancer</span></h4>
											<div class="item-details margin-top-10">
												<div class="star-rating" data-rating="5.0"></div>
												<div class="detail-item"><i class="icon-material-outline-date-range"></i> August 2018</div>
											</div>
											<div class="item-description">
												<p>Excellent programmer - fully carried out my project in a very professional manner. </p>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="boxed-list-item">
										<!-- Content -->
										<div class="item-content">
											<h4>WordPress Theme Installation <span>Rated as Freelancer</span></h4>
											<div class="item-details margin-top-10">
												<div class="star-rating" data-rating="5.0"></div>
												<div class="detail-item"><i class="icon-material-outline-date-range"></i> June 2018</div>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="boxed-list-item">
										<!-- Content -->
										<div class="item-content">
											<h4>Fix Python Selenium Code <span>Rated as Employer</span></h4>
											<div class="item-details margin-top-10">
												<div class="star-rating" data-rating="5.0"></div>
												<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018</div>
											</div>
											<div class="item-description">
												<p>I was extremely impressed with the quality of work AND how quickly he got it done. He then offered to help with another side part of the project that we didn't even think about originally.</p>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="boxed-list-item">
										<!-- Content -->
										<div class="item-content">
											<h4>PHP Core Website Fixes <span>Rated as Freelancer</span></h4>
											<div class="item-details margin-top-10">
												<div class="star-rating" data-rating="5.0"></div>
												<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018</div>
											</div>
											<div class="item-description">
												<p>Awesome work, definitely will rehire. Poject was completed not only with the requirements, but on time, within our small budget.</p>
											</div>
										</div>
									</div>
								</li>
							</ul>

							<!-- Pagination -->
							<div class="clearfix"></div>
							<div class="pagination-container margin-top-40 margin-bottom-10">
								<!--<nav class="pagination">
									<ul>
										<li><a href="#" class="ripple-effect current-page">1</a></li>
										<li><a href="#" class="ripple-effect">2</a></li>
										<li class="pagination-arrow"><a href="#" class="ripple-effect"><i class="icon-material-outline-keyboard-arrow-right"></i></a></li>
									</ul>
								</nav>-->
							</div>
							<div class="clearfix"></div>
							<!-- Pagination / End -->

						</div>
						<!-- Boxed List / End -->

						<!-- Boxed List -->
						<div class="boxed-list margin-bottom-60">
							<div class="boxed-list-headline">
								<h3><i class="icon-material-outline-business"></i> Employment History</h3>
							</div>
							<ul class="boxed-list-ul">
								<li>
									<div class="boxed-list-item">
										<!-- Avatar -->
										<div class="item-image">
											<img src="images/browse-companies-03.png" alt="">
										</div>

										<!-- Content -->
										<div class="item-content">
											<h4>Development Team Leader</h4>
											<div class="item-details margin-top-7">
												<div class="detail-item"><a href="#"><i class="icon-material-outline-business"></i> Acodia</a></div>
												<div class="detail-item"><i class="icon-material-outline-date-range"></i> May 2018 - Present</div>
											</div>
											<div class="item-description">
												<p>Focus the team on the tasks at hand or the internal and external customer requirements.</p>
											</div>
										</div>
									</div>
								</li>
								<li>
									<div class="boxed-list-item">
										<!-- Avatar -->
										<div class="item-image">
											<img src="images/browse-companies-04.png" alt="">
										</div>

										<!-- Content -->
										<div class="item-content">
											<h4><a href="#">Lead UX/UI Designer</a></h4>
											<div class="item-details margin-top-7">
												<div class="detail-item"><a href="#"><i class="icon-material-outline-business"></i> Acorta</a></div>
												<div class="detail-item"><i class="icon-material-outline-date-range"></i> April 2014 - May 2018</div>
											</div>
											<div class="item-description">
												<p>I designed and implemented 10+ custom web-based CRMs, workflow systems, payment solutions and mobile apps.</p>
											</div>
										</div>
									</div>
								</li>
							</ul>
						</div>
						<!-- Boxed List / End -->

					</div>


					<!-- Sidebar -->
					<div class="col-xl-4 col-lg-4">
						<div class="sidebar-container">

							<!-- Profile Overview -->
							<div class="profile-overview">
								<div class="overview-item"><strong>$35</strong><span>Hourly Rate</span></div>
								<div class="overview-item"><strong>53</strong><span>Jobs Done</span></div>
								<div class="overview-item"><strong>22</strong><span>Rehired</span></div>
							</div>

							<!-- Button -->
							<a href="" class="apply-now-button popup-with-zoom-anim margin-bottom-50">Make an Offer <i class="icon-material-outline-arrow-right-alt"></i></a>

							<!-- Freelancer Indicators -->
							<div class="sidebar-widget">
								<div class="freelancer-indicators">

									<!-- Indicator -->
									<div class="indicator">
										<strong>88%</strong>
										<div class="indicator-bar" data-indicator-percentage="88"><span></span></div>
										<span>Job Success</span>
									</div>

									<!-- Indicator -->
									<div class="indicator">
										<strong>100%</strong>
										<div class="indicator-bar" data-indicator-percentage="100"><span></span></div>
										<span>Recommendation</span>
									</div>

									<!-- Indicator -->
									<div class="indicator">
										<strong>90%</strong>
										<div class="indicator-bar" data-indicator-percentage="90"><span></span></div>
										<span>On Time</span>
									</div>

									<!-- Indicator -->
									<div class="indicator">
										<strong>80%</strong>
										<div class="indicator-bar" data-indicator-percentage="80"><span></span></div>
										<span>On Budget</span>
									</div>
								</div>
							</div>

							<!-- Widget -->
							<div class="sidebar-widget">
								<h3>Social Profiles</h3>
								<div class="freelancer-socials margin-top-25">
									<ul>
										<li><a href="#" title="Dribbble" data-tippy-placement="top"><i class="icon-brand-dribbble"></i></a></li>
										<li><a href="#" title="Twitter" data-tippy-placement="top"><i class="icon-brand-twitter"></i></a></li>
										<li><a href="#" title="Behance" data-tippy-placement="top"><i class="icon-brand-behance"></i></a></li>
										<li><a href="#" title="GitHub" data-tippy-placement="top"><i class="icon-brand-github"></i></a></li>

									</ul>
								</div>
							</div>

							<!-- Widget -->
							<div class="sidebar-widget">
								<h3>Skills</h3>
								<div class="task-tags">
									<span>iOS</span>
									<span>Android</span>
									<span>mobile apps</span>
									<span>design</span>
									<span>Python</span>
									<span>Flask</span>
									<span>PHP</span>
									<span>WordPress</span>
								</div>
							</div>

							<!-- Widget -->
							<div class="sidebar-widget">
								<h3>Attachments</h3>
								<div class="attachments-container">
									<a href="#" class="attachment-box ripple-effect"><span>Cover Letter</span><i>PDF</i></a>
									<a href="#" class="attachment-box ripple-effect"><span>Contract</span><i>DOCX</i></a>
								</div>
							</div>

							<!-- Sidebar Widget -->
							<div class="sidebar-widget">
								<h3>Bookmark or Share</h3>

								<!-- Bookmark Button -->
								<button class="bookmark-button margin-bottom-25">
									<span class="bookmark-icon"></span>
									<span class="bookmark-text">Bookmark</span>
									<span class="bookmarked-text">Bookmarked</span>
								</button>

								<!-- Copy URL -->
								<div class="copy-url">
									<input id="copy-url" type="text" value="" class="with-border">
									<button class="copy-url-button ripple-effect" data-clipboard-target="#copy-url" title="Copy to Clipboard" data-tippy-placement="top"><i class="icon-material-outline-file-copy"></i></button>
								</div>


							</div>

						</div>
					</div>

				</div>
			</div>


			<!-- Spacer -->
			<div class="margin-top-15"></div>
			<!-- Spacer / End-->
		</div>
	`,
	data () {
		return {

		}
	},
	created() {
		let user = localStorage.getItem('CUser')
		if(typeof user == 'undefined'){
			alert('You are not logged in')
			this.$router.replace({
				name: 'login'
			})
		}

		
	}
});

// app routes
const routes = [
    { path: '/login', component: 'login', name: 'login' },
    { path: '/register', component: 'register' },
    { path: '/profile', component: 'profile' },
	{
		path: '/validate/:id',
		component: 'validate',
	},
	{
		path: '/verify-email/:token',
		component: 'verifyComponent',
		name: 'verifyEmail'
	}
];

const router = new VueRouter({
    routes
});
const projectName = `benj19`;


const baseUrl = `https://${window.location.hostname}/app/`;

new Vue({
	el: "#wrapper",
	router,
});




