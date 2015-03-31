<?php
class posts extends CI_Controller {

    function __construct() {
        parent::__construct();
         $this->load->model('postmodel', '', true);
         $this->load->helper(array('url'));
         $this->load->library(array('post'));
    }
/*
 * Index function to load the view
 * 
 */    
    function index(){
    	$this->load->view('postview');
    }
/*
 * Function to save new posts
 * 
 */    
    function submit(){
    	date_default_timezone_set($this->input->post("t"));
    	$data=$this->input->post();
    	$data['createdDate']=date("Y-m-d H:i:s");
    	$data['post_id']=md5(rand(100,10000000000000000).microtime());
    	unset($data['t']);
    	$data['text']=$this->post->filter($data['text']);
    	$result=$this->postmodel->submit_post($data);
    	echo json_encode(array('result'=>$result));
    }
/*
 * Function to get new posts based on parameters
 * 
 */    
    function get(){
    	$comment_arr=array();
    	$comments="";
    	$arr['post_id']="";
    	$arr['ajax']="false";
    	$posts="";
    	$view="";
    	$res="";
    	$last_id="";
    	$i=0;
    	$data['post_id']=$this->input->post('post_id');
    	$data['ajax']=$this->input->post('ajax');
    	$data['result']=$this->postmodel->get_post($data);
    	$last_id=$this->postmodel->get_last_post_id();
    	if ($data['result']->num_rows > 0) {
    		$view=$this->load->view('posttempview',$data,true);
    		$res="1";
    	}
    	else{
    		$res="0";
    	}
    	if($data['ajax']=="true"){
    		$posts=$this->postmodel->get_post($arr);
    		if ($posts->num_rows>0){
    			foreach ($posts->result() as $p){
    				$comments = $this->postmodel->get_post_comments($p->post_id);
	                if ($comments->num_rows > 0) {
	                    $comment_arr[$i]["comment_data"] =  $comments->num_rows . "_" . $p->post_id;
	                } else {
	                    $comment_arr[$i]["comment_data"] = "0_0";
	                }
	
	                $i++;
    			}
    		}
    	}
    	
    	
    	echo json_encode(array('result'=>$res,'view'=>$view,'last_id'=>$last_id,'comment_data'=>$comment_arr));
    }
/*
 * Function to get comments based on parameters
 * 
 */    
    function get_comments(){
    	$view="";
    	$res="";
    	$post_id=$this->input->post('post_id');
    	$data['result']=$this->postmodel->get_post_comments($post_id);
    	if ($data['result']->num_rows > 0) {
    		$view=$this->load->view('commentstempview',$data,true);
    		$res="1";
    	}
    	else{
    		$res="0";
    	}
    	echo json_encode(array('result'=>$res,'view'=>$view));
    }
/*
 * Function to submit comments
 * 
 */    
    function submit_comment(){
    	date_default_timezone_set($this->input->post("t"));
    	$count=0;
    	$data=$this->input->post();
    	$data['createdDate']=date("Y-m-d H:i:s");
    	unset($data['t']);
    	$data['comment']=$this->post->filter($data['comment']);
    	$data['comment_id']=md5(rand(100,100000000000000000000).microtime());
    	$result=$this->postmodel->add_post_comments($data);
    	$cmt=$this->postmodel->get_post_comments($data['post_id']);
    	if ($cmt->num_rows>0){
    		$count=$cmt->num_rows;
    	}
    	
    	echo json_encode(array('result'=>$result,'post_id'=>$data['post_id'],'count'=>$count));
    }
/*
 * Function to report spam
 * 
 */    
    function report_spam(){
    	$res="";
    	$post_id=$this->input->post('post_id');
    	$result=$this->postmodel->set_spam($post_id);
    	if ($result > 0) {
    		
    		$res="1";
    	}
    	else{
    		$res="0";
    	}
    	echo json_encode(array('result'=>$res));
    }
    
} 