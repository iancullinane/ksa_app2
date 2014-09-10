<!DOCTYPE HTML>


<!-- Ian Cullinane template file work in progress -->



<html>

<?php 
include 'templates/head_template.html';
?>
<!-- *************end header******************************* -->





<!-- HTML BODY BEGINS HERE -->
<!-- ********************* -->

<body>
	<!-- NAVIGATION BEGINS HERE -->
	<!-- ********************* -->


	<nav class="navigation">
		<h1>KSA Data Display Apparatus</h1>
	</nav>


	<!-- sets width of container -->
	<div class="container row">
		<!-- BEGIN HEADER AREA -->
		<!-- ***************** -->
		<!-- site header, row class is used to define full width section -->

		
		<header role="banner" class="row">
			<div class="header col span_12">
			</div><!-- header closed -->
		</header>
		<div class="clr"></div>


		<!-- defines the white query elements  -->
		

		<div class="row gutters query">

			<div class="col span_8">
				<h1 class="q_title" >Welcome</h1>

				<h4 class="query_info">Enter Custom Query here, watch capitialization and do not include closing ;</h4>
				
				<form method="post" action="uploaded.php" enctype="mutipart/form-data">
				
				<div class="queryBox">
					<textarea rows="5" cols="80" name="query"></textarea>
				</div>
				
				<input type="submit" name="submit" value="Submit" id="joinBtn">
				</form>
				
				<h4 class="warning">This textarea will execute a direct SQL statement. Highly open to SQL injection <span class="red">use for testing purposes only</span></h4>				
				<h4 class="info">To help develop queries, the schema can be viewed <a href="./images/map.png">here</a></h4>
				
			</div>

			<div class="col span_4 buttons">
				<h4 class="query_info">Example queries</h4>
				<form method="POST" action="uploaded.php" enctype="multipart/form-data">
					<input type="submit" name="submitOne" value="See Course Table" id="joinBtn" />
					<input type="submit" name="submitTwo" value="See institution" id="joinBtn" />
					<input type="submit" name="submitThree" value="KSA's satisfied by a Class" id="joinBtn" />
					<p class="query_info">Enter a KSA</p><input type="text" name="ksaIn" width="100%" />
					<input type="submit" name="submitFour" value="Get classes which satisfy" id="joinBtn" />
				</form>
			</div>
				
			
		</div>

		<div class="clr"></div>


		<!-- container fot the form to upload a document -->



		<!-- test for MySQL PDO function -->

		<div class="main row gutters">
			<div class="inputField col span_3">

				<form class="col span_12" method="post" action="uploaded.php" enctype="multipart/form-data">
					<label for="file">Upload new file:</label>
					<p>Must be properly formatted</p>
					<input type="file"name="file" id="file"  /><br>
					<input type="submit" name="submit" value="Submit" id="joinBtn">


				</form>

			</div>


			<div class="tableField col span_9">
				<h2>Example Data</h2>
				<div class="example">SELECT * FROM ksa LIMIT 30 will give the following result:</div>
				<?php
				include 'scripts/functions.php';
				generateQuery('SELECT * FROM ksa LIMIT 30');
				?>


			</div>
		</div>







		<div class="clr"></div>

		<!-- BEGIN MAIN CONTENT AREA TEMPLATE-->
		<!-- ******************************* -->

		<main role="main" class="row gutters main">

			<!-- ***************************************************************** -->	
			<article class="col span_4 block">

				<div class="content">

				</div>

			</article>


			<!-- ***************************************************************** -->	
			<article class="col span_4 block">

				<div class="content">

				</div>

			</article>


			<!-- ***************************************************************** -->	
			<article class="col span_4 block">

				<div class="content">

				</div>

			</article>






		</main>

		<div class="clr"></div>

		


		<!-- ******************************************************************** -->
		<!-- *******************************begin footer template**************** -->

		<footer role="contentinfo" class="row gutters">

		</footer>




	</div><!-- end container -->




	<link rel="stylesheet" media="all" href="css/style.css" />

</body>



<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-54146308-1', 'auto');
	ga('send', 'pageview');

</script>



</html>