$(document).ready(function(){
// Determines the time zone of the browser client	
	var tz = jstz.determine(); 
	var t=   tz.name(); 
	
	get();
	add_posts();
//Function to add posts	
	function add_posts(){
		post_data="";
		$('#addpostsform').validate({
			errorClass: 'err',
			validClass: 'valid',
			rules: {
				name: { required: true },
				email:{ required: true, email:true},
				text: { required: true}
			
			},
			messages:{
				name: { required: "Please enter name" },
				text: { required: "Please enter post" },
				email: {required: "Please enter  email",email:"Please enter a valid email!!"}
			},	
			submitHandler: function(){
				
				
					var co=confirm("You are about to submit this post!!");
					if(co){
						var post_data=$("#addpostsform").serializeArray();
						post_data.push({name: 't', value: t});
						$.post(url+"/posts/submit",post_data,function(data){
							if(data.result>0){
								//alert("Successfully Submitted!!");
							}
							else{
								alert("Unable to Submit!!");
							}
							
							ajax();
						},"json");
					}else{
						return false;
					}
				
				
			}
		});
	}
//Function to get the posts based on certain condition	
	function get(){
		$.post(url+"/posts/get",{'post_id':'','ajax':'false'},function(data){
			if(data.result>0){
				 $('body').data('last_id', data.last_id);	
				 $("#post_area").prepend(data.view);
				 initOpenClose();
				 set_comments();
				 spam();
				 time_update();
				 //ajax();
			}
			ajax();
		},"json");
		
		
	}
	
	
//Bootstarp function to open/close the comments	
	//initOpenClose();
	function initOpenClose() {
		jQuery('div.open-close:not(.js-ready)').each(function(){
			var holder = jQuery(this);
			var post_id=holder.attr('data-id');
			var interval = null;
			holder.addClass('js-ready').openClose({
				activeClass: 'active',
				opener: '.opener',
				slider: '>.slide',
				animSpeed: 400,
				effect: 'slide',
				animEnd: function(obj){
					if(obj){
						//alert(holder.attr('data-id'));
						//console.log(holder);
						$.post(url+"/posts/get_comments",{'post_id':post_id},function(data){
							if(data.result>0){
								 $("#comment_"+post_id).html(data.view);
								 time_update();
							}
							interval = setInterval(function(){get_comment(post_id)},10000);
						},"json");
						
						holder.find('.slideshow:not(.js-ready)').each(function(){
							jQuery(this).addClass('js-ready').scrollGallery({
								mask: 'div.mask',
								slider: '.slideset',
								slides: '.slide',
								animSpeed: 500,
								onInit:function(obj){
									obj.slides.find('a').click(function(){
										return false;
										
									});
								}
							});
						});
					}
					else{
						//alert("closed");
						clearInterval(interval); 
					}
				}
			});
		});
	}
//Function to intiate comment adding	
	function set_comments(){
		$(".add_comments").click(function(){
			var post_id=$(this).attr('data-id');
			//alert(post_id);
			add_comments(post_id);
		});
	}
//Function to add comments	
	function add_comments(post_id){
		//alert(post_id);
		$('#add_comment_'+post_id).validate({
			
			errorClass: 'err',
			validClass: 'valid',
			rules: {
				name: { required: true },
				email:{ required: true, email:true},
				comment: { required: true}
			
			},
			messages:{
				name: { required: "Please enter name" },
				comment: { required: "Please enter comment" },
				email: {required: "Please enter  email",email:"Please enter a valid email!!"}
			},	
			submitHandler: function(){	
					//var co=confirm("You are about to submit this comment ?");
					//if(co){
						var comment_data=$('#add_comment_'+post_id).serializeArray();
						comment_data.push({name: 't', value: t});
						$.post(url+"/posts/submit_comment",comment_data,function(data){
							if(data.result>0){
								//alert("Successfully Submitted!!");
								$("#com_count_"+data.post_id).text(data.count);
								get_comment(data.post_id)
								
							}
							else{
								alert("Unable to Submit!!");
							}
							
							ajax();
						},"json");
					/*}else{
						return false;
					}*/
				
				
			}
		});
	}
//Function to get comments based on post id	
	function get_comment(post_id){
		$.post(url+"/posts/get_comments",{'post_id':post_id},function(data){
			if(data.result>0){
				 $("#comment_"+post_id).html(data.view);
				 time_update();
			}
		},"json");
	}
	
// Function to ajax update time	
	function time_update(){
		$("abbr.timeago").timeago();
	}
//Function to report spam	
	function spam(){
		$(".report_spam").click(function(){
			var post_id=$(this).attr('data-id');
			var co=confirm("This post will be reported as spam!!");
			if(co){
				$.post(url+"/posts/report_spam",{'post_id':post_id},function(data){
					if(data.result>0){
						$("#spam_"+post_id).text("Reported as spam");
					}
				},"json");	
				
			}
			else{
				return false;
			}
			
		});
	}
//Function to get ajax data on time interval	
	function ajax(){
		var last_id=$('body').data('last_id');
		//alert(last_id);
		var ajax_data={'post_id':last_id,'ajax':'true'};
		var key;
		var values=[];
		var arr="";
		 $.ajax({
	            type: "POST",
	            url: url+"/posts/get",

	            async: true, /* If set to non-async, browser shows page as "Loading.."*/
	            cache: false,
	            timeout:50000, /* Timeout in ms */
	            data:ajax_data,
	            dataType: 'json',
	            success: function(data){ /* called when request to getajax_post completes */
	            	if(data.result>0){
	            		 $("#post_area").prepend(data.view);
	            		 initOpenClose();
	    				 set_comments();
	    				 spam();
	            		 time_update();
	            		 $('body').data('last_id', data.last_id);		 
	            	}
	            	
	            	$.each(data.comment_data, function(idx, obj) {
	    				//alert(obj.like_data);
	    				arr=obj.comment_data;
	    				values=arr.split('_');
	    				//$(".ajax_like_" + values[0]).text("0");
	    				if(values[0]>0){
	    					 $("#com_count_" + values[1]).text(values[0]);
	    				}
	    				else{
	    					$("#com_count_" + values[1]).text("0");
	    				}
	    				
	    				
	    			});
	            	
	                setTimeout(
	                		
	                	ajax, /* Request next message */
	                    10000 /* ..after 10 seconds */
	                );
	            },
	            error: function(XMLHttpRequest, textStatus, errorThrown){
	                setTimeout(
	                	ajax, /* Try again after.. */
	                    15000); /* milliseconds (15seconds) */
	            }
	        });
	}
	
	
});