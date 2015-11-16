<?php
$nom_sector = "";
$nom_page = "Bienvenue";
include "../inc/header.php";
?>
<body class="leftMenu nav-collapse">
<div id="wrapper">
		<div id="main">
				<!-- //breadcrumb-->

				<div id="content">
					<div class="row">
						<section class="panel corner-flip">
							<div class="panel-body">
								<div class="invoice">
									<div class="row">
										<div class="col-sm-6">
											<a href="#"> <img alt="" src="assets/img/logo_invice.png"> </a>
										</div>
										<div class="col-sm-6 align-lg-right">
											<h3>INVOICE NO. #572307</h3>
											<span>25 january 2014</span>
										</div>
									</div>
									<hr>
									<div class="row">
										<div class="col-sm-3">
											<h4>From :</h4>
											John Doe <br>
											Mr Nilson Otto <br>
											FoodMaster Ltd </div>
										<div class="col-sm-3">
											<h4>To :</h4>
											1982 OOP <br>
											Madrid, Spain <br>
											+1 (151) 225-4183 </div>
										<div class="col-md-6 align-lg-right">
											<h4>Payment Details :</h4>
											<strong>V.A.T Reg #:</strong> 542554(DEMO)78 <br>
											<strong>Account Name:</strong> FoodMaster Ltd <br>
											<strong>SWIFT code:</strong> 45454DEMO545DEMO
										</div>
									</div>
									<br>
									<br>
									<table class="table table-bordered">
										<thead>
										<tr>
											<th>#</th>
											<th width="60%" class="text-left">Product</th>
											<th>Quantity</th>
											<th class="text-right">Price</th>
										</tr>
										</thead>
										<tbody>
										<tr>
											<td class="text-center">1</td>
											<td>Lorem Ipsum</td>
											<td class="text-center">1</td>
											<td class="text-right">$852</td>
										</tr>
										<tr>
											<td class="text-center">2</td>
											<td>Nulla pellentesque</td>
											<td class="text-center">1</td>
											<td class="text-right">$785</td>
										</tr>
										<tr>
											<td class="text-center">4</td>
											<td>Leo ornare lacinia</td>
											<td class="text-center">1</td>
											<td class="text-right">$1524</td>
										</tr>
										<tr>
											<td class="text-center">5</td>
											<td>Est arcu integer consectetuer</td>
											<td class="text-center">1</td>
											<td class="text-right">$74</td>
										</tr>
										</tbody>
									</table>
									<br><br>
									<div class="row">
										<div class="col-sm-6">
											<div class="align-lg-left"> 795 Park Ave, Suite 120 <br>
												San Francisco, CA 94107 <br>
												P: (234) 145-1810 <br>
												Full Name <br>
												first.last@email.com
											</div>
										</div>
										<div class="col-sm-6">
											<div class="align-lg-right">
												<ul>
													<li> Sub - Total amount: <strong>$3,235</strong> </li>
													<li> VAT: <strong>7.7%</strong> </li>
													<li> Discount: ----- </li>
													<li> Grand Total: <strong>$3,485</strong> </li>
												</ul>
												<br>
												<a href="javascript:window.print();" class="btn btn-theme hidden-print"><i class="fa fa-print"></i> </a>
												<a href="#" class="btn btn-theme-inverse hidden-print"> SAVE </a>
											</div>
										</div>
									</div>
								</div>
								<!-- //invoice -->
							</div>
						</section>
					</div>
				</div>
				<!-- //content-->
								
		</div>
		<!-- //main-->
		
		
</div>
<!-- //wrapper-->


<!--
////////////////////////////////////////////////////////////////////////
//////////     JAVASCRIPT  LIBRARY     //////////
/////////////////////////////////////////////////////////////////////
-->
		
	<?php include "inc/script.php"; ?>

</body>
</html>
