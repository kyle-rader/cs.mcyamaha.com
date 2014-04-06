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
			<form id="attendance" data-abide>
				<div class="row">
					<div class="small-12 columns">
						<h4>Attendance</h4>
					</div>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<input type="text" name="first" placeholder="First Name" required pattern="[a-zA-Z]+"/>
					</div>
					<div class="small-6 columns">
						<input type="text" name="last" placeholder="Last Name" required pattern="[a-zA-Z]+"/>
					</div>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<input type="text" name="w_number" placeholder="W########" required pattern="[wW][0-9]+"/>
					</div>
					<div class="small-6 columns">
						<input type="text" name="crn" placeholder="CRN" required pattern="[0-9]+"/>
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
				<div class="row">
					<div class="small-12 columns">
						<div id="attend-success" class="alert-box success" style="display:none;">
						</div>
						<div id="attend-fail" class="alert-box warning" style="display:none;">
						</div>
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
	var good = $('#attend-success');
	var bad = $('#attend-fail');

	$.post(url, $(this).serialize(), function(response) {
		var info = JSON.parse(response);
		if (info.success) {
			good.text(info.first + ', ' + info.message).fadeIn(100);
			setTimeout(function() { good.fadeOut(750); }, 5000);
		} else {
			bad.text(info.first + ', ' + info.message).fadeIn(100);
			setTimeout(function() { bad.fadeOut(750); }, 5000);
		}				
	});
});
</script>
<div class="row">
</div>