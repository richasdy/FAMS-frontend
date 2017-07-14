<html>
	<head>
		<meta charset="utf-8">
		<title>first vue</title>
		<link rel="stylesheet" href="css/app.css">
		<script>
			window.Laravel = <?php echo json_encode([
					'csrfToken' => csrf_token(),
			]); ?>
		</script>
	</head>
	<body>
		<div id="app">
			<router-link to="/">Home</router-link>
			<router-link to="/asset">Asset</router-link>
			<router-link to="/location">Location</router-link>
			<router-link to="/type">Type</router-link>

			<router-view></router-view>
		</div>
		<script>
			window.Laravel = <?php echo json_encode([
				'csrfToken' => csrf_token(),
			]);?>
		</script>
		<script src="js/app.js" charset="utf-8"></script>
	</body>
</html>

