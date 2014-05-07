<?php 
// The CSCI 145 App
$title = <<<EOT
<h2>CSCI 145</h2>
<small>Now things get interesting</small>
EOT;
print PageTitle($title);

?>
<div class="row">
	<div class="small-6 columns">
		<form id="feedback" data-abide>
			<input type="hidden" name="lab" value="145s14">
			<div class="row">
				<div class="small-12 columns">
					<h4>Feedback</h4>
				</div>
			</div>
			<div class="row">
				<div class="small-6 columns">
					<label>Class</label>
					<select type="text" name="class">
						<option value="freshman">Freshman</option>
						<option value="sophomore">Sophomore</option>
						<option value="junior">Junior</option>
						<option value="senior">Senior</option>
					</select>
				</div>
				<div class="small-6 columns">
					<label>Major or intended major:</label>
					<input type="text" name="major" placeholder="CS?" required>
				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					<label>Feedback:</label>
					<textarea name="message" placeholder="What's good? What's bad?" required></textarea>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="small-8 columns">
					<div id="feedback-alert" class="alert-box success" style="display:none;">
						Thank you for the feedback!
					</div>
				</div>
				<div class="small-4 columns">
					<input class="button postfix" type="submit" name="submit" value="Give Feedback"/>
				</div>
			</div>
		</form>
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
						<label>First</label>
						<input type="text" name="first" placeholder="First Name" required pattern="[a-zA-Z]+"/>
					</div>
					<div class="small-6 columns">
						<label>Last</label>
						<input type="text" name="last" placeholder="Last Name" required pattern="[a-zA-Z]+"/>
					</div>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<label>W Number</label>
						<input type="text" name="w_number" placeholder="W########" required pattern="[wW][0-9]+"/>
					</div>
					<div class="small-6 columns">
						<label>Your lab # ( 1, 2 or 3)</label>
						<input type="text" name="crn" placeholder="Lab Number (1,2, or 3)?" required pattern="[0-9]+"/>
					</div>
				</div>
				<div class="row">
					<div class="small-6 columns">
						<input type="password" name="code" placeholder="For TA use only"/>
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
// SURVEY SCRIPT -----------------------------
$('#feedback').unbind('submit');
$('#feedback').submit(function(event) {
	event.preventDefault();
	var url = '/ajax/survey.php';
	var form = $(this);
	var alertBox = $('#feedback-alert');

	$.post(url, $(this).serialize(), function(response) {
		var info = JSON.parse(response);
		alertBox.addClass(info.success ? 'success' : 'warning');
		alertBox.text(info.success ? 'Thank you!' : 'Something went wrong o.0').fadeIn(100);
		setTimeout(function() { alertBox.fadeOut(750); }, 5000);
		form.find('input[type=text]').prop('value', '');
		form.find('textarea').prop('value', '');
	});
});

//--------------------------------------------------
$('#attendance').unbind('submit');
$('#attendance').submit(function(event) {
	event.preventDefault();
	var url = '/ajax/attendance.php';
	var form = $(this);
	var good = $('#attend-success');
	var bad = $('#attend-fail');
	var data = {'first':form.find('input[name=first]').val(),
				'last' :form.find('input[name=last]').val(),
				'w_number':form.find('input[name=w_number]').val(),
				'crn':form.find('input[name=crn]').val(),
				'code':$.md5(form.find('input[name=code]').val())};

	$.post(url, data, function(response) {
		var info = JSON.parse(response);
		if (info.success) {
			good.text(info.first + ', ' + info.message).fadeIn(100);
			setTimeout(function() { good.fadeOut(750); }, 5000);
		} else {
			bad.text(info.first + ', ' + info.message).fadeIn(100);
			setTimeout(function() { bad.fadeOut(750); }, 5000);
		}
		$('#attendance').find('input[type!=submit]').prop('value', '');
	});
});
</script>
<div class="row">
</div>