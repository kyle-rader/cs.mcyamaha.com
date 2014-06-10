<?php 
// The CSCI 511 App
$title = <<<EOT
<h3>CSCI 474: Data Visualization</h3>
<small>A picture is worth a thousand words.</small>
EOT;
print PageTitle($title);

?>

<style>
td {
	color:#222 !important;
}
</style>
<div class="row">
	<div class="large-6 columns">
		<h4>D3 Visualizations</h4>
		<table width = 100%>
			<tbody>
				<tr><td><a href="http://mbostock.github.io/d3/talk/20111018/tree.html">Collapsible Trees</a></td></tr>
				<tr><td><a href="http://mbostock.github.io/d3/talk/20111116/pack-hierarchy.html">Clustering</a></td></tr>
				<tr><td><a href="http://www.theguardian.com/world/interactive/2013/apr/30/violence-guns-best-selling-video-games">Games with guns</a></td></tr>
				<tr><td><a href="http://hint.fm/wind/">Wind Map</a></td></tr>
				<tr><td><a href="http://bl.ocks.org/mbostock/5944371">Bilevel Partition</a></td></tr>
				<tr><td><a href="http://mbostock.github.io/d3/talk/20111018/azimuthal.html">Azimuthal</a></td></tr>
				<tr><td><a href="http://www.jasondavies.com/wordcloud/#http%3A%2F%2Fwww.wired.com%2F">Word Clouds</a></td></tr>
				<tr><td><a href="http://bost.ocks.org/mike/miserables/">Les Miserables</a></td></tr>
				<tr><td><a href="http://bl.ocks.org/kerryrodden/7090426">Sunburst Page visitors</a></td></tr>
				<tr><td><a href="http://www.brightpointinc.com/interactive/political_influence/index.html?source=d3js">Politcal Funding</a></td></tr>
				<tr><td><a href="http://bl.ocks.org/mbostock/929623">There could be a game here</a></td></tr>
			</tbody>
		</table>
		<p> Check out the whole <a href="https://github.com/mbostock/d3/wiki/Gallery">Gallery</a></p>
	</div>
	<div class="large-6 columns">
		<h4>Other sites and Tools</h4>
		<table width = 100%>
			<tbody>
				<tr><td><a href="http://www.gapminder.org/world/#$majorMode=chart$is;shi=t;ly=2003;lb=f;il=t;fs=11;al=30;stl=t;st=t;nsl=t;se=t$wst;tts=C$ts;sp=5.59290322580644;ti=2012$zpv;v=0$inc_x;mmid=XCOORDS;iid=phAwcNAVuyj1jiMAkmq1iMg;by=ind$inc_y;mmid=YCOORDS;iid=phAwcNAVuyj2tPLxKvvnNPA;by=ind$inc_s;uniValue=8.21;iid=phAwcNAVuyj0XOoBL_n5tAQ;by=ind$inc_c;uniValue=255;gid=CATID0;by=grp$map_x;scale=log;dataMin=283;dataMax=110808$map_y;scale=lin;dataMin=18;dataMax=87$map_s;sma=49;smi=2.65$cd;bd=0$inds=;modified=75">Gapminder</a></td></tr>
				<tr><td><a href="http://www.bioinformatics.org/pgetoolbox/">Matlab Pop Genetics</a></td></tr>
				<tr><td><a href="http://www.bioblender.eu/">Bio Blender</a></td></tr>
				<tr><td><a href="https://developers.google.com/chart/interactive/docs/gallery/motionchart">Google Motion Chart</a></td></tr>
				<tr><td><a href="http://sorting.at/">Sorting algorithms visualized</a></td></tr>
			</tbody>
		</table>
		<div id="chart_div" style="width: 600px; height: 300px;"></div>
	</div>
</div>
