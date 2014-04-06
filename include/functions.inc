<?php 
function GetIcons()
{
	return <<<EOT
<ul class="icon-group">
	<li><a href="mailto:kyle.rader@ieee.org?subject=Mail From:cs.mcyamaha.com"><i class="fi-mail"></i></a></li>
	<li><a href="https://www.linkedin.com/pub/kyle-rader/7b/361/882"><i class="fi-social-linkedin"></i></a></li>
	<li><a href="https://github.com/kyle-rader/cs.mcyamaha.com"><i class="fi-social-github"></i></a></li>
</ul>
EOT;
}

function PageTitle($title)
{
	$icons = GetIcons();
	return <<<EOT
<div class="row">
	<div class="large-12 columns">
		<div class="left">
			$title
		</div>
		<div class="right">
			$icons
		</div>
		<hr>
	</div>
</div>
EOT;
}
?>
