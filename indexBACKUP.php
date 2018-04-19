<?php include 'helper/header.php'?>
	
	<br>
	
	<div class='container bg-faded'>
		<h1 class='index-header'>
			Welcome to Quinsigamond College!
		</h1>
	</div>
	
	<!-- Carousel uses Java-Script-->
	<script src="helper/vendor/jquery/jquery.min.js"></script>
	<script src="helper/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Start Container -->	
	<div class="container bg-faded p-2 my-4">
	  
		<!-- Image Carousel -->
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
		  <ol class="carousel-indicators">
			<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
			<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
		  </ol>
		  <div class="carousel-inner" role="listbox">
			<div class="carousel-item active">
			  <img class="d-block img-fluid w-100" src="helper/images/website/athletics.jpg" alt="">
			  <div class="carousel-caption d-none d-md-block bg-dark round">
				<h2 class="text-shadow"><strong>High Achieving Athletics</strong></h2>
				<p class="text-shadow">Quinsigamond is returning 6 national champion sports teams.</p>
			  </div>
			</div>
			<div class="carousel-item">
			  <img class="d-block img-fluid w-100" src="helper/images/website/academics.jpg" alt="">
			  <div class="carousel-caption d-none d-md-block bg-dark">
				<h2 class="text-shadow"><strong>Broad Array of Academics</strong></h2>
				<p class="text-shadow">Over 50 degree options for students to choose from.</p>
			  </div>
			</div>
			<div class="carousel-item">
			  <img class="d-block img-fluid w-100" src="helper/images/website/applications.jpg" alt="">
			  <div class="carousel-caption d-none d-md-block bg-dark">
				<h2 class="text-shadow"><strong>Real World Applications</strong></h2>
				<p class="text-shadow">Learn through solving real problems facing the community today.</p>
			  </div>
			</div>
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
			<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
			<span class="carousel-control-next-icon" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		  </a>
		</div>
		
	</div>
	<!-- END Container -->
	
<?php include 'helper/footer.php'?>