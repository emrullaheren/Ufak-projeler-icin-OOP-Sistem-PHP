<?php
class System
{
    public $db;

    public function __construct()
    {
        date_default_timezone_set(CONFIG["date_default_timezone_set"]);
        $this->db = new Database(CONFIG["dbHostName"], CONFIG["dbName"], CONFIG["dbUserName"], CONFIG["dbPassword"], CONFIG["charset"]);
    }
    public function view($path, $data = array(), $status = false)
    {
        extract($data);

        if ($status) {
            ob_start();
            if (file_exists(ROOT_DIR . "/app/Templates/" . CONFIG["template"] . "/" . $path . ".php")) {
                require_once ROOT_DIR . "/app/Templates/" . CONFIG["template"] . "/" . $path . ".php";
            }
            return ob_get_clean();
        } else {
            if (file_exists(ROOT_DIR . "/app/Templates/" . CONFIG["template"] . "/" . $path . ".php")) {
                require_once ROOT_DIR . "/app/Templates/" . CONFIG["template"] . "/" . $path . ".php";
            }
        }
    }
}
