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

		
			<header role="banner row">
				<div class="header col span_12">
				</div><!-- header closed -->
			</header>
			<div class="clr"></div>

			
			<main class="main row clr">
				<?php 
				include 'scripts/functions.php';
				include 'scripts/parse_functions.php';
				include 'scripts/gui_functions.php';
				include 'scripts/insert_functions.php';
				include 'scripts/test_functions.php';
				

				/*upload_file($_FILES);*/

				parseCSV();



				if(isset($_POST['query']))  {
					generateQuery($_POST['query']);	

				} elseif (isset($_POST['submitOne'])) {
					generateQuery('SELECT * FROM course');
				} elseif (isset($_POST['submitTwo'])) {
					generateQuery('SELECT * FROM institution');
				} elseif (isset($_POST['submitThree'])) {
					generateQuery('SELECT course.CourseName, ksa.KSA_ID, ksa.Statement, outcomes.OutcomesID, outcomes.OutcomeStmt FROM outcomes INNER JOIN course ON course.ID=outcomes.CourseID INNER JOIN ksa ON outcomes.KSA_ID=ksa.KSA_ID WHERE course.CourseNumber = "FOR 270"');

				} elseif (isset($_POST['submitFour'])) {
					generateQuery('SELECT ksa.KSA_ID, ksa.Statement, institution.InstitutionName, course.CourseName
										FROM outcomes
										INNER JOIN ksa ON outcomes.KSA_ID=ksa.KSA_ID
										WHERE ksa.ksa_ID=' . $_POST["ksaIn"]);
					
				} 
					
				



				
				?>

				<div class="clr"></div>

			<!-- <div class="row query">

				<h3 class="q_title col span_12">Enter a query:</h3>
				<p></p>

				<form class="col span_12" method="POST" action="#" enctype="mutipart/form-data">
					<textarea rows="5" cols="100" name="query"></textarea>
				</form>
				<div class="col span_12"><input type="submit" name="submit" value="Submit"></div>
			</div> -->

			<div class="clr"></div>

			<!-- BEGIN MAIN CONTENT AREA TEMPLATE-->
			<!-- ******************************* -->


			</main>


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