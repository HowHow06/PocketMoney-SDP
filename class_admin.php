<?php

class Admin
{
    private $id;
    /**
     * Static instance of self
     *
     * @var Admin
     */
    protected static $_instance;

    function __construct($id = null, $db = null)
    {
        // $this->db          = $db;
        require_once('MysqliDb.php');
        $this->$id = $id;
        // $this->db          = new MysqliDb("db4free.net", "pocketmoney", "m&nsuperdry", "pocketmoney", "3306"); //temporary
        $this->db          = new MysqliDb("localhost", "root", "", "pocketmoney", "3308"); //temporary


        //----------------This section is specially modified for heroku db-------------------
        $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
        $cleardb_server = $cleardb_url["host"];
        $cleardb_username = $cleardb_url["user"];
        $cleardb_password = $cleardb_url["pass"];
        $cleardb_db = substr($cleardb_url["path"], 1);
        $active_group = 'default';
        $query_builder = TRUE;
        // Connect to DB
        $this->db          = new MysqliDb($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);


        //----------------This section is specially modified for heroku db-------------------
        //$this->validation  = $validation;
        self::$_instance = $this;
    }

    /**
     * A method of returning the static instance to allow access to the
     * instantiated object from within another class.
     * Inheriting this class would require reloading connection info.
     *
     * @uses $admin = Admin::getInstance();
     *
     * @return Admin Returns the current instance.
     */
    public static function getInstance()
    {
        return self::$_instance;
    }

    /** 
     * Set admin id
     * 
     */
    function setId($id)
    {
        $this->id = strval($id);
    }

    /** 
     * Return the id if the id is set before
     * @return String|NULL
     * 
     */
    function getId()
    {
        if (!empty($this->id)) {
            return strval($this->id);
        }

        return NULL;
    }

    /** 
     * Return the array of table data if the id is set before, by default the adminID is put in the where clause
     * @param String $tablename
     * the name of the table
     * 
     * @param String $columnName
     * the name of the specific column
     * 
     * @param Array $whereAnd
     * '<whereProp>'=>'<whereValue>';
     * 
     * @param Array|String $orderBy
     * '<orderProp>' => '<order>','asc' or 'desc'; 
     * 
     * @param String $groupBy
     * group by clause
     * 
     * @return array|NULL
     * 
     */
    function getData($tablename, $columnName = "*", $whereAnd = NULL, $orderby = NULL, $groupBy = NULL)
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $id = $this->id;
            $db->where('adminID', $id);
            if (!is_null($whereAnd)) { //if the groupBy clause is not null
                foreach ($whereAnd as $prop => $value) {
                    $db->where($prop, $value);
                }
            }
            if (!is_null($orderby)) {
                foreach ($orderby as $prop => $order) {
                    $db->orderBy($prop, $order);
                }
            }
            if (!is_null($groupBy)) { //if the groupBy clause is not null
                $db->groupBy($groupBy);
            }
            $result = $db->get($tablename, null, $columnName);
            return $result;
        }
        return NULL;
    }


    /** 
     * Return the array of table data if the id is set before
     * * @param String $query
     * select query statement
     * 
     * @return array|NULL
     * 
     */
    function getDataByQuery($query)
    {
        $db = MysqliDb::getInstance();
        $data = $db->rawQuery($query);
        return $data;
    }

    /**
     *
     * @param array $params
     * 'tableName'-> String
     * 'idName'-> String: id name;
     * 'id'-> String:id of the record;
     * 'data'-> array: column name TO actual data;
     * 
     * 
     * @return array 
     * 'status'-> String: 'ok' or 'error';
     * 'statusMsg'-> String: the status msg;
     *
     */
    public function adminUpdate($params)
    {
        $db = MysqliDb::getInstance();
        $tablename = $params['tableName'];
        $idName = $params['idName'];
        $id = $params['id'];
        $data = $params['data'];

        if ($id == "") {
            return array('status' => 'error', 'statusMsg' => 'data id is not defined');
        }

        if ($idName == "") {
            return array('status' => 'error', 'statusMsg' => 'data property is not defined');
        }

        $db->where($idName, $id);

        if ($db->update($tablename, $data)) {
            return array('status' => 'ok', 'statusMsg' => $db->count . ' records were updated');
        } else {
            return array('status' => 'error', 'statusMsg' => 'update failed: ' . $db->getLastError());
        }
    }

    /**
     *
     * @param array $params
     * 'tableName'-> String
     * 'data'-> array: column name TO actual data;
     * 
     * 
     * @return array 
     * 'status'-> String: 'ok' or 'error';
     * 'statusMsg'-> String: the status msg;
     *
     */
    public function adminInsert($params)
    {
        $db = MysqliDb::getInstance();
        $tablename = $params['tableName'];
        $data = $params['data'];

        $id = $db->insert($tablename, $data);
        if ($id)
            return array('status' => 'ok', 'statusMsg' => 'Record is added.');
        else
            return array('status' => 'error', 'statusMsg' => 'Add failed: ' . $db->getLastError());
    }

    /**
     *
     * @param array $params
     * 'tableName'-> String
     * 'idName'-> String: id name;
     * 'id'-> String:id of the record;
     * 
     * 
     * @return array 
     * 'status'-> String: 'ok' or 'error';
     * 'statusMsg'-> String: the status msg;
     *
     */
    public function adminDelete($params)
    {
        $db = MysqliDb::getInstance();
        $tablename = $params['tableName'];
        $idName = $params['idName'];
        $id = $params['id'];

        if ($id == "") {
            return array('status' => 'error', 'statusMsg' => 'data id is not defined');
        }

        if ($idName == "") {
            return array('status' => 'error', 'statusMsg' => 'data property is not defined');
        }

        $db->where($idName, $id);
        if ($db->delete($tablename)) {
            return array('status' => 'ok', 'statusMsg' => 'Deleted successfully.');
        } else {
            return array('status' => 'error', 'statusMsg' => 'Delete failed');
        }
    }

    /**
     *go to the page using js
     * 
     * @param String $url
     * 
     * 
     *
     */
    public function goTo($url)
    {
        echo ('<script>
            window.location.href = "' . $url . '"
            </script>');
    }

    /**
     * show alert box
     *
     * @param String $msg
     * the msg to show in alert box
     * 
     */
    public function showAlert($msg)
    {
        echo ('<script>alert("' . $msg . '");
        </script>');
    }

    /**
     * Login via email/username and password. Session and cookie are not set.
     *
     * @param array $params
     * 'loginInfo'-> String: username or email of the admin;
     * 'password'-> String: password of the admin;
     * 
     * @return array 
     * 'status'-> String: 'ok' or 'error';
     * 'statusMsg'-> String: the status msg;
     * 'data'-> array: array containing the admin data
     *
     */
    public function adminLogin($params)
    {
        $db = MysqliDb::getInstance();

        $loginInfo = $params['loginInfo'];
        $password = $params['password'];

        $db->where('username', $loginInfo);
        $db->orWhere('email', $loginInfo);

        $userData = $db->getOne('Admin');

        if (empty($userData)) { //if the $userData return nothing meaning wrong email or username
            return array('status' => 'error', 'statusMsg' => 'Wrong Username or Email', 'data' => '');
        }

        $correctPassword = password_verify($password, $userData['password']);
        if ($correctPassword == false) {
            return array('status' => 'error', 'statusMsg' => 'Wrong Password', 'data' => '');
        }

        return array('status' => 'ok', 'statusMsg' => '', 'data' => $userData);
    }

    /**
     * Check if the session / cookie is set
     * 
     * @return boolean
     * True if the session/ cookie is set
     *
     */
    public function havesession()
    {
        $db = MysqliDb::getInstance();
        session_start();

        if (!isset($_SESSION['adminData'])) // if no session
        {

            //check for cookie
            if (empty($_COOKIE['admin_email']) || empty($_COOKIE['admin_password'])) {

                //if cookie is empty return false
                return false;
            } else {
                //if cookie is not empty, check if the cookie is valid,return true
                $params = array('loginInfo' => $_COOKIE['admin_email'], 'password' => $_COOKIE['admin_password']);
                $result = $this->adminLogin($params);
                if ($result['status'] == 'error') { //cannot login
                    return false;
                }
                //successfully login
                $this->setSession('adminData', $result['data']);
                return true;
            }
        }
        //if have session, return true
        return true;
    }

    public function checksession()
    {
        if ($this->havesession() == false) {
            echo '<script>
        alert("Please login!");
        window.location.href="login.php?role=admin";//if the cookie or session is empty, go to login
        </script>';
        }
    }

    /**
     * Login via email/username and password. Session and cookie are not set.
     *
     * @param String $sessionName
     * name of the session
     * 
     * @param array $userData
     * data array of the user;
     * 
     * @return void
     */
    public function setSession($sessionName, $userData)
    {
        session_start();
        $_SESSION[$sessionName] = $userData;
        session_write_close();
    }
}
