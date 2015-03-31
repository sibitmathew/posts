<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<script type="text/javascript">
	var urljs="<?php echo base_url()?>";
	var url="<?php echo site_url()?>";
	</script>
	<title>Posts</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link media="all" href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
	<link media="all" href="<?php echo base_url();?>css/all.css" rel="stylesheet">
	<script src="<?php echo base_url();?>js/jquery.js"></script>
	<script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>js/jquery.main.js"></script>
	<script src="<?php echo base_url(); ?>js/jquery.timeago.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>js/jsTimezoneDetect.js"></script>
	<script src="<?php echo base_url();?>js/vaidation.jquery.js"></script>
	<script src="<?php echo base_url();?>js/posts.js"></script>
	<style type="text/css">
	.err{
		color:red;
	}
	.valid{
		color:green;}
	</style>
</head>
<body>
	<div id="wrapper">
		<div class="w1">
			<header id="header" class="container">
				<div class="row">
					<div class="holder">
						
					</div>
				</div>
			</header>
			<div id="main" class="container">
				<div class="row">
					<aside class="col-md-3 aside">
					
						
					
						
					</aside>
					<div id="content" class="col-xs-12 col-sm-11 col-md-6">
						<div class="post-form">
							<form id="addpostsform">
								<fieldset>
									<div class="form-block">
										
										<div class="holder">
											<textarea  type="text" id="new_post" name="text" style="width:100%;" placeholder="Enter post"></textarea><br>
											<input  type="text" id="new_post_name" name="name" style="width:100%;" placeholder="Enter name"/><br>
											<input  type="text" id="new_post_email" name="email" style="width:100%;" placeholder="Enter email"/><br>
										</div>
										<center>
										<input class="btn btn-more" style="background:#ADD8E6;" type="submit" value="Post"/>
										</center>
									</div>
									
								</fieldset>
							</form>
						</div>
						
							
					<!--  Section div  -->
						<section class="postarea">	
							<div id="post_area">
							
							</div>
						</section>	
						
						
					</div>
					<aside id="sidebar" class=" col-sm-1 col-md-3">
						
						
					</aside>
				</div>
			</div>
			<div id="footer" class="container">
				<div class="row">
					
					
				</div>
			</div>
		</div>
	</div>
	
</body>
</html>
