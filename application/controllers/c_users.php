<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class c_users extends CI_Controller 
{

	public function index()
	{
		$this->load->model("m_users");
		
		$data = $this->m_users->GetListUser(0, 0, "", "id_user", "ASC");
		
		if ($data["count"] == 0) $this->load->view("v_users_empty");
		else $this->load->view("v_users");
	}
	
	public function GetListUser()
	{
		$this->load->model("m_users");
		
		$offset = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
		$limit = isset($_POST["rows"]) ? intval($_POST["rows"]) : 10;
		$search = isset($_POST["search"]) ? $_POST["search"] : "";
		$sort = isset($_POST['sort']) ? $_POST['sort'] : "id_user";
		$order = isset($_POST['order']) ? $_POST['order'] : "ASC";
		$offset = ($offset-1)*$limit;
		
		$data = $this->m_users->GetListUser($offset, $limit, $search, $sort, $order);
		$rows = array();
		$idx = 0;
		
		foreach ($data["data"] as $row)
		{
			$rows[$idx]["id_user"] = $row->id_user;
			$rows[$idx]["fullname"] = $row->fullname;
			$rows[$idx]["phone"] = $row->phone;
			$rows[$idx]["email"] = $row->email;
			$idx++;
		}
		
		$result = array("total"=>$data["count"], "rows"=>$rows);
        echo json_encode($result);
	}
	
	public function SaveNewUser()
	{
		$this->load->model("m_users");
		
		$fullname = $_REQUEST["fullname"];
		$phone = $_REQUEST["phone"];
		$email = $_REQUEST["email"];
		$address_arr = $_REQUEST["address"];
		$this->m_users->SaveNewUser($fullname, $phone, $email, $address_arr);

		echo json_encode(array('success'=>true));
	}
	
	public function RemoveUser()
	{
		$this->load->model("m_users");
		
		$id_user = intval($_REQUEST['id_user']);
		$this->m_users->RemoveUser($id_user);
		
		echo json_encode(array('success'=>true));
	}
}
