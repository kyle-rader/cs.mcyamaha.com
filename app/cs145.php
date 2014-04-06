<?php 
// The CSCI 145 App
$title = <<<EOT
<h2>CSCI 145</h2>
<small>When things start getting interesting</small>
EOT;
print PageTitle($title);

?>
<div class="row">
	<div class="small-6 columns">

	</div>
	<div class="small-6 columns">
		<div class="attendance right">
			<form id="attendance">
				<div class="row">
					<div class="small-12 columns">
						<h4>Attendance</h4>
					</div>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<input type="text" name="first" placeholder="First Name"/>
					</div>
					<div class="small-6 columns">
						<input type="text" name="last" placeholder="Last Name"/>
					</div>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<input type="text" name="w_number" placeholder="W########"/>
					</div>
					<div class="small-6 columns">
						<input type="text" name="crn" placeholder="CRN"/>
					</div>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<input type="text" name="code" placeholder="Code"/>
					</div>
					<div class="small-6 columns">
						<input class="button postfix" type="submit" name="here" value="Here!"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
$(document).on('submit', '#attendance', function(event) {
	event.preventDefault();
	var url = '/ajax/attendance.php';
	var form = $(this)[0];

	$.post(url, $(this).serialize(), function(response) {
		console.log(response);
	});
});
</script>
<div class="row">
</div>