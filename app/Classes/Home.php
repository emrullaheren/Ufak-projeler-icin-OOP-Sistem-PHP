<?php
class Home extends System
{
    public function index()
    {
        echo "Home/index";
    }
    public function notfound()
    {
        echo "Home/notfound";
        redirect("deneme");
    }
}
