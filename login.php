<!DOCTYPE html5>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no maximum-scale=1">
		<title>Login page SPA</title>
		<?php include 'partials/inc_head.php'; ?>
	</head>

	<body>
		<div id="wrapper">

			<!-- header section -->
			<?php include 'partials/spa_nav.php'; ?>

			<div class="clearfix"></div>
			<!-- Header Container / End -->

			<router-view></router-view>

			<!-- To test if our vue js is working -->
			<!-- <div class="clearfix my-4">
				<input type="text" v-model="text">
				{{ text }}
			</div> -->

			<div class="clearfix my-4"></div>
			<div class="clearfix my-4"></div>

			<div id="footer">
				<?php include 'partials/inc_footer.php'; ?>
			</div>

		</div>

		<?php include 'partials/inc_scripts.php'; ?>

		<!-- Snackbar // documentation: https://www.polonel.com/snackbar/ -->
		<script>
			// Snackbar for user status switcher
			$('#snackbar-user-status label').click(function() {
				Snackbar.show({
					text: 'Your status has been changed!',
					pos: 'bottom-center',
					showAction: false,
					actionText: "Dismiss",
					duration: 3000,
					textColor: '#fff',
					backgroundColor: '#383838'
				});
			});
		</script>

	</body>
</html>