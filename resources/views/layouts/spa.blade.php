<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>E-precription</title>
  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
  <body
    class="hold-transition layout-top-nav"
    style="background-color: #f3f3f3"
  >
    <div class="wrapper" id="app">      
      
      	<router-view></router-view>
      	
      	<!-- Footer -->
      	<section style="background-color: #1e6f5c">
	        <div class="container mt-5">
	          <div class="row">
	            <div class="col-lg-6 pl-5">
	              
	            </div>
	            <div class="col-lg">
	              
	            </div>
	            <div class="col-lg mt-5">
	            </div>
	          </div>
	        </div>
      	</section>
      <!-- /.Footer -->
    </div>

    <!-- REQUIRED SCRIPTS -->
    <script src="{{ asset('js/app.js') }}"></script>
  </body>
</html>
