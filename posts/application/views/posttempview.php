	
		<?php $count=0; if ($result->num_rows>0){ ?>
		
		<?php foreach ($result->result() as $rs){
		$comments=$this->postmodel->get_post_comments($rs->post_id);
		if ($comments->num_rows>0){
			$count=$comments->num_rows;
		}
			?>
		<article class="post text">
								<img src="<?php echo base_url();?>/images/user.jpg" height="80" width="80" style="border-radius:100%;" alt="image description" class="alignright">
								<div class="post-content">
									<header class="head">
									<?php if ($rs->spam=="true"){?>
									<a href="javascript:void(0);" style="float:left;">Reported as spam</a>
									<?php }else{?>
									<a href="javascript:void(0);"  style="float:left;" id="spam_<?php echo $rs->post_id;?>"><span  class="report_spam" data-id="<?php echo $rs->post_id;?>">Report spam</span></a>
									<?php }?>
										<div class="author-info">
											<time datetime="<?php echo $rs->createdDate;?>"><abbr class="timeago" title="<?php echo $rs->createdDate;?>"><?php echo $rs->createdDate;?></abbr></time>
											<strong class="author"><a href="javascript:void(0);"><?php echo $rs->name."(".$rs->email.")";?></a></strong>
										</div>
									</header>
									<p><?php echo $rs->text;?></p>
									<div class="open-close" data-id="<?php echo $rs->post_id;?>">
										<div class="meta">
											<ul>
												
												<li class="active" ><a href="#" class="btn-comment opener" ><span id="com_count_<?php echo $rs->post_id;?>"><?php echo $count;?></span> Comment</a></li>
											</ul>
										</div>
										<div class="comments-area slide">
										<!-- Comments -->
										<div id="comment_<?php echo $rs->post_id;?>"></div>
										<form class="form-comment add" id="add_comment_<?php echo $rs->post_id;?>" >
												<fieldset>
													<div class="row2">
														<div class="holder">
														<input type="hidden" name="post_id" value="<?php echo $rs->post_id;?>"/>
															Comment :<textarea  id="new_post" name="comment" style="width:80%;" ></textarea><br>
															Name :<input  type="text"  id="new_post_name" name="name" style="width:80%;  height:30px; padding :0px; color:black; text-align:left;" value="" ><br>
															Email :<input  type="text"  id="new_post_email" name="email" style="width:80%;  height:30px; padding :0px; color:black; text-align:left;" ><br>
														</div>
														<center>
														<input  type="submit" class="add_comments" data-id="<?php echo $rs->post_id;?>" style="float :right; background : #ADD8E6; text-indent :0px;" value="Add"/>
														</center>
													</div>
													
												</fieldset>
											</form>	
											
										</div>
									</div>
								</div>
							</article>
						<?php $count=0;}?>	
							
				<?php }else{?>
					
				<?php echo "No posts found!!"; }?>	
				
				
<script>





</script>					
					