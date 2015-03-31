<?php if ($result->num_rows >0){?>
	<ol>
<?php foreach ($result->result() as $rs){?>	
			<li>
				<header class="sub-head">
					<img src="<?php echo base_url();?>/images/user.jpg" height="40" width="40" style="border-radius:100%;" alt="image description" class="alignright">
					<div class="author-info">
						<time datetime="<?php echo $rs->createdDate;?>"><abbr class="timeago" title="<?php echo $rs->createdDate;?>"><?php echo $rs->createdDate;?></abbr></time>
						<strong class="author"><a href="javascript:void(0);"><?php echo $rs->name."(".$rs->email.")";?></a></strong>
					</div>
				</header>
				<p><?php echo $rs->comment;?></p>
				<div class="meta">
					
				</div>
			</li>
	<?php }?>	
		</ol>
<?php }?>												