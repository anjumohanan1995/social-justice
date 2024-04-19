@extends('layouts.home-app')

@section('content')
		<!-- ======End Preloader ======  -->

		<!-- ====== Navgition ======  -->
		<nav class="navbar navbar-default">
		  <div class="container">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-icon-collapse" aria-expanded="false">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>

		       <!-- logo -->
		      <a class="logo" href="#"><img src="" width="50px" alt=""></a>

		    </div>

		    <!-- Collect the nav links, and other content for toggling -->
		    <div class="collapse navbar-collapse" id="nav-icon-collapse">
		      
			  <!-- links -->
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="{{ url('user-registration') }}" class="active">login</a></li>
		         
		      </ul>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container -->
		</nav>
		<!-- ====== End Navgition ======  -->

		<!-- ====== Header ======  -->
		
		<!-- ====== End Header ======  -->

             
      


       	<!-- ====== Header ======  -->
		<section id="home" class="header" data-scroll-index="0" style="background-image: url(front/images/bg.jpg);" data-stellar-background-ratio="0.8">

			<div class="v-middle">
				<div class="container">
					<div class="row">

						<!-- caption -->
						<div class="caption">
							
							<h1 class="cd-headline clip">
					            <span class="blc">  </span>
					            <span class="cd-words-wrapper">
					              <b class="is-visible">SOCIAL JUSTICE DEPARTMENT</b>
					              
					            </span>
			          		</h1>
                              <h5>Government of Kerala</h5>
			          		<!-- social icons -->
			          		
						</div>
						<!-- end caption -->
					</div>
				</div><!-- /row -->
			</div><!-- /container -->
		</section>
		<!-- ====== End Header ======  -->
       
@endsection