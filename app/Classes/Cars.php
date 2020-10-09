<?php
class Cars extends System
{
    public function index()
    {
        echo "Cars";
    }
    public function list()
    {
        echo "Cars/list";
    }
    public function detail()
    {
        $data = $this->view("index", array("array" => array(1, 2, 3, 4, 5)));
    }
}
