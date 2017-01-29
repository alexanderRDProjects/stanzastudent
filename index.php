<html>
	<head>
		<title>Stanza - Welcome</title>
		<link rel="stylesheet" type="text/css" href="frontpage.css">
	</head>
	<body>
		<div id="background_blue"></div>
		<div id="header">
			<button id="btn_login">Login</button>
		</div>

		<div id="card0" class="card card_current">
			<div class="card_container">
				<div class="card_superhead">Answer a few questions to find your perfect housemates</div>
				<div class="card_head">Which statement describes you?</div>
				<div class="card_content">
					<button id="btn_find_house" onclick="doHost()">I have a house with spaces</button>
					<button id="btn_find_mates" onclick="doClient()">I want to join a house</button>
				</div>
			</div>
		</div>

		<!--client form-->

		<div id="cl_has_group" class="card card_hidden">
			<div class="card_container">
				<div class="card_superhead">Answer a few questions to find your perfect housemates</div>
				<div class="card_head">Do you have a group?</div>
				<div class="card_content">
					<button id="btn_cl_group">I have a group</button>
					<button id="btn_cl_no_group">I don't have a group</button>
				</div>
			</div>
		</div>

		<div id="cl_group_size" class="card card_hidden">
			<div class="card_container">
				<div class="card_superhead">Answer a few questions to find your perfect housemates</div>
				<div class="card_head">How big is your group?</div>
				<div class="card_content">
					<input id="in_cl_group_size" type="number" value="2" min="2" />
					<button id="btn_cl_group_size" class="btn_next"></button>
				</div>
			</div>
		</div>

		<div id="cl_age" class="card card_hidden">
			<div class="card_container">
				<div class="card_superhead">Answer a few questions to find your perfect housemates</div>
				<div class="card_head">How old are you?</div>
				<div class="card_content">
					<input id="in_cl_age" type="number" value="18" min="18" />
					<button id="btn_cl_age" class="btn_next"></button>
				</div>
			</div>
		</div>

		<div id="cl_gender_prefs" class="card card_hidden">
			<div class="card_container">
					<div class="card_superhead">Answer a few questions to find your perfect housemates</div>
					<div class="card_head">Finally, select your gender preferences.</div>
					<div class="card_content">
						<button id="btn_cl_male">Male</button>
						<button id="btn_cl_female">Female</button>
						<button id="btn_cl_mixed">Mixed</button>
					</div>
				</div>
		</div>
		

		<!--Hidden Form Data-->

		<form id="form_client" action="find_houses.php" >
			<input id="form_client_group_size" type="hidden" name="group_size" />
			<input id="form_client_age" type="hidden" name="age" />
			<input id="form_client_gender_prefs" type="hidden" name="gender_prefs" />
		</form>
		<form id="host_form"></form>
	</body>	
	<script src="jquery-3.1.1.min.js"></script>
	<script src="frontpage.js"></script>
</html>