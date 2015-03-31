<?php
class postmodel extends CI_Model {
    public function __construct()
	{
		$this->load->database();
	}
/*
 * Function to submit posts
 * 
 */	
	function submit_post($data){
		$this->db->insert('posts',$data);
		return $this->db->insert_id();
	}
/*
 * Function to get posts
 * 
 */	
	function get_post($data){
		$query="";
		$query1="";
		$sql="";
		$id="null";
		$post_id=mysql_real_escape_string($data['post_id']);
		$ajax=mysql_real_escape_string($data['ajax']);
		if ($post_id==""){
			$query=$this->db->order_by('id', 'desc')->get('posts');
		}
		else{
			if ($ajax=="true"){
				$query1=$this->db->get_where('posts',array('post_id'=>$post_id,'delete_status'=>'false'));
				if ($query1->num_rows>0){
					$id=$query1->row()->id;
				}
				$sql="SELECT * FROM posts WHERE id > $id AND delete_status='false' ORDER BY id DESC";
				$query=$this->db->query($sql);
			}
			else{
				$query=$this->db->order_by('id', 'desc')->get_where('posts',array('post_id'=>$post_id,'delete_status'=>'false'));
			}
		}
		return $query;
	}
/*
 * Function to get posts comments
 * 
 */	
	function get_post_comments($post_id)
	{
		$post_id=mysql_real_escape_string($post_id);
		$sql="SELECT * FROM comments WHERE post_id ='$post_id' AND delete_status='false' ORDER BY id DESC";
		return $this->db->query($sql);
		
	}
/*
 * Function to add posts comments
 * 
 */	
	function add_post_comments($data){
		$this->db->insert('comments',$data);
		return $this->db->insert_id();
	}
/*
 * Function to save spam reporting
 * 
 */	
	function set_spam($post_id){
		$data['spam']="true";
		$this->db->where('post_id',$post_id);
		$this->db->update('posts',$data);
		return $this->db->affected_rows();
	}
/*
 * Function to get last post id for ajax
 * 
 */	
	function get_last_post_id(){
		$sql="SELECT * FROM posts WHERE delete_status='false' ORDER BY id DESC LIMIT 0,1";
		$query=$this->db->query($sql);
		if ($query->num_rows>0){
			return $query->row()->post_id;
		}
		else{
			return "0";
		}
		
	}
	
}	