<?php
class Users extends System
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sql = "SELECT * FROM users";
        $data["users"] = $this->db->select($sql);
        $this->view('users', $data);
    }
    public function delete()
    {
        $id = uri_segment(3);
        $sql = "DELETE FROM users WHERE uid=?";
        $data["users"] = $this->db->delete($sql, array($id));
        redirect("uyeler");
    }
}
