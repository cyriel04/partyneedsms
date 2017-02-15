<!DOCTYPE html>
<html>
<head>

	<title>@yield('title') - PNMS</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/semantic.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/dataTables.semanticui.css' )}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/admin.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('asset/semantic.css') }}">
	<link rel="stylesheet" href="{{ ('assets/semantic.css') }}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.11.8/semantic.min.js"></script>
</head>
<body>
	<div class="ui top attached menu">
	  <a id="toggle" class="item">
	    <i class="sidebar icon"></i>
	    Menu
	  </a>
	</div>
	<div class="ui bottom attached segment">
	  <div class="ui wide visible inverted left inline vertical sidebar menu">
	  	<div class="item">
	  		<strong>PARTY NEEDS MANAGEMENT SYSTEM</strong>
	  	</div>
		<a href="#" class="item"><strong>DASHBOARD</strong></a>
		<div class="item">
			<strong>MAINTENANCE</strong><br><br>
			<div class="row">
				<div class="ui inverted accordion">

				  <div class="title">
				    <i class="dropdown icon"></i>
				    Item
				  </div>
				  <div class="content">
				    <a href="{{ url('/uom') }}" class="item">Unit of Measurement</a>
				    <a href="{{ url('/equipmentType') }}" class="item">Equipment Type</a>
				    <a href="{{ url('/dinnerwareType') }}" class="item">Dinnerware Type</a>
				    <a href="{{ url('/item') }}" class="item">Item</a>
				  </div>

				  <div class="title">
				    <i class="dropdown icon"></i>
				    Menu
				  </div>
				  <div class="content">
				    <a href="#" class="item">Dish Type</a>
				    <a href="#" class="item">Dish</a>
				    <a href="#" class="item">Menu</a>
				  </div>

				  <div class="title">
				    <i class="dropdown icon"></i>
				    Rates
				  </div>
				  <div class="content">
				    <a href="#" class="item">Item Rate</a>
				    <a href="#" class="item">Menu Rate</a>
				    <a href="#" class="item">Quantity Ratio</a>
				  </div>

				<div class="title">
				    <i class="dropdown icon"></i>
				    Event
				</div>
				  <div class="content">
				    <a href="#" class="item">Event Type</a>
				    <a href="#" class="item">Decor</a>
				    <a href="#" class="item">Waiter Ratio</a>
				  </div>

				<div class="title">
				    <i class="dropdown icon"></i>
				    Fees
				  </div>
				  <div class="content">
				    <a href="#" class="item">Delivery</a>
				    <a href="#" class="item">Penalty</a>
				  </div>
			</div>
		   </div>
		</div>
		<div class="item">
			<strong>TRANSACTION</strong><br><br>
			<a href="#" class="item">Inventory</a>
			<a href="#" class="item">Event Management</a>
			<a href="#" class="item">Rental Management</a>
			<a href="#" class="item">Billing and Collection</a>
		</div>
		<div class="item">
			<strong>QUERIES</strong>
		</div>
		<div class="item">
			<strong>REPORTS</strong><br><br>
			<a href="#" class="item">Sales Report</a>
			<a href="#" class="item">Rental Report</a>
			<a href="#" class="item">Event Booking Report</a>
		</div>
		<div class="item">
			<strong>UTILITIES</strong>
		</div>
	  </div>
	  <div class="pusher">
	    <div class="ui basic segment">
	      <h3 class="ui header">Application Content</h3>
	      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	    </div>
	  </div>





	<script type="text/javascript" src="assets/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="assets/semantic.js"></script>

	<script type="text/javascript">
		$('.ui.sidebar').sidebar({
		    context: $('.bottom.segment')
		  })
		  .sidebar('attach events', '#toggle');
		$('.ui.accordion').accordion();
	</script>
</body>
</html>
