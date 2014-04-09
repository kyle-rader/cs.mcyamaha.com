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
		<form id="survey-form" data-abide>
			<div class="row">
				<div class="small-12 columns">
					<h4>Icebreaker Survey</h4>
				</div>
			</div>
			<div class="row">
				<div class="large-6 columns">
					<label>Class (in years not credits)
						<select name="class">
							<option value="freshman" SELECTED>Freshman</option>
							<option value="sophomore">Sophomore</option>
							<option value="junior">Junior</option>
							<option value="senior">Senior</option>
							<option value="super_senior">Super Senior</option>
						</select>
					</label>
				</div>
				<div class="large-6 columns">
					<label>Do you want to major in CS?
						<select name="major_in_cs">
							<option value="yes" SELECTED>Yes! &#128522;</option>
							<option value="minor">Minor in CS</option>
							<option value="maybe">Maybe</option>
							<option value="no">No &#9785;</option>
						</select>
					</label>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="small-12 columns">
					<h5>Favorites</h5>
				</div>
			</div>
			<div class="row">
				<div class="large-2 columns">
					<label>Color</label>
						<input type="color" name="favcolor" required>
					
				</div>
				<div class="large-3 columns">
					<label>Animal
						<input type="text" name="favanimal" required>
					</label>
				</div>
				<div class="large-3 columns">
					<label>Beverage
						<input type="text" name="favbeverage" required>
					</label>
				</div>
				<div class="large-4 columns">
					<label>Place
						<input type="text" name="favplace" required>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="small-12 columns">
					<label>Rate your programming experience</label>
					<select name="progexp">
						<option value="none">None (how are you here?)</option>
						<option value="noob">I took 140 or 141</option>
						<option value="some">I wrote some code in high school</option>
						<option value="lots">I've been programming a while</option>
						<option value="pro">Let's dance monkeys</option>
					</select>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="small-12 columns">
					<label>Your favorite title (e.g. High Inquisitor Rader or Kyle, god of the Moon)
					<input type="text" name="favtitle" required>
				</div>
			</div>			
			<div class="row">
				<div class="small-12 columns">
					<label>Describe your ideal TA
					<input type="text" name="idealTA" required>
				</div>
			</div>
			<div class="row">
				<div class="small-4 columns small-offset-8">
					<input class="button postfix" type="submit" name="submit" value="Submit">
				</div>
			</div>
		</form>
		<div class="row">
			<div class="small-12 columns">
				<div class="alert-box survey-alert" style="display:none;">
					Thanks!
				</div>
			</div>
		</div>
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
						<input type="password" name="code" placeholder="Code"/>
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
$('#survey-form').unbind('submit');
$('#survey-form').submit(function(event) {
	event.preventDefault();
	var url = '/ajax/survey.php';
	var form = $(this);
	var alertBox = $('.survey-alert');

	$.post(url, $(this).serialize(), function(response) {
		var info = JSON.parse(response);
		alertBox.addClass(info.sucess ? 'success' : 'warning');
		alertBox.text(info.message).fadeIn(100);
		setTimeout(function() { alertBox.fadeOut(750); }, 5000);
		$('#survey-form').find('input[type!=submit]').prop('value', '');
		if(info.success) {
			form.fadeOut();
		}
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