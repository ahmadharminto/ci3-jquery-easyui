<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_users extends CI_Model 
{

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }
	
	public function GetListUser($offset, $limit, $search="", $sort, $order)
	{
		$result = array();
		
		$query = "SELECT id_user, fullname, phone, email 
			FROM tbl_users 
			WHERE 1=1 ";
		if ($search != "") $query .= " AND (LOWER(fullname) LIKE LOWER('%{$search}%') or LOWER(email) LIKE LOWER('%{$search}%'))";
		$result["count"] = $this->db->query($query)->num_rows();
		
		$query .= " ORDER BY {$sort} {$order} LIMIT {$offset},{$limit}";
		$result["data"] = $this->db->query($query)->result();	
		
		return $result;
	}
	
	public function GetDetailUser($id_user)
	{
		$query = "SELECT a.id_user, a.fullname, a.phone, a.email, b.address 
			FROM tbl_users a JOIN tbl_addresses b ON (a.id_user = b.id_user) 
			WHERE 1 =1 
			AND a.id_user = {$id_user}"; 
		$result = $this->db->query($query)->result();
		
		return result;
	}
	
	public function SaveNewUser($fullname, $phone, $email, $address_arr)
	{
		$query = "SELECT IFNULL(MAX(id_user), 0) + 1 max_id FROM tbl_users";
		$data = $this->db->query($query)->result();
		$id_user = 0;
		foreach ($data as $row) $id_user = $row->max_id;
		
		$query = "INSERT INTO tbl_users(id_user, fullname, phone, email) VALUES ({$id_user}, '{$fullname}', '{$phone}', '{$email}')";
		$this->db->query($query);
		
		$query = "INSERT INTO tbl_addresses(id_user, address) VALUES ";
		$idx = 1;
		foreach ($address_arr as $addr)
		{
			if ($idx == 1) $query .= "({$id_user}, '{$addr}')";
			else $query .= ",({$id_user}, '{$addr}')";
			$idx++;
		}
		$this->db->query($query);
		//return $result;
	}
	
	public function RemoveUser($id_user)
	{
		$query = "DELETE from tbl_users WHERE id_user = {$id_user}";
		$this->db->query($query);
		
		$query = "DELETE from tbl_addresses WHERE id_user = {$id_user}";
		$this->db->query($query);
		//return $result;
	}

}
