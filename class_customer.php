<?php

use function PHPUnit\Framework\isEmpty;

class Customer
{

    function __construct($db = null)
    {
        // $this->db          = $db;
        require_once('MysqliDb.php');
        $this->db          = new MysqliDb("sql12.freemysqlhosting.net", "sql12382802", "Pcfz54XCtn", "sql12382802", "3306"); //temporary
        //$this->validation  = $validation;
    }

    /**
     * Login via email/username and password. Session and cookie are not set.
     *
     * @param array $param
     * 'loginInfo'-> String: username or email of the customer;
     * 'password'-> String: password of the customer;
     * 
     * @return array 
     * 'status'-> String: 'ok' or 'error';
     * 'statusMsg'-> String: the status msg;
     * 'data'-> array: array containing the customer data
     *
     */
    public function customerLogin($params)
    {
        $db = MysqliDb::getInstance();

        $loginInfo = $params['loginInfo'];
        $password = $params['password'];

        $db->where('username', $loginInfo);
        $db->orWhere('email', $loginInfo);

        $userData = $db->getOne('Customer');

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

        if (!isset($_SESSION['customerData'])) // if no session
        {

            //check for cookie
            if (empty($_COOKIE['customer_email']) || empty($_COOKIE['customer_password'])) {

                //if cookie is empty return false
                return false;
            } else {
                //if cookie is not empty, check if the cookie is valid,return true
                $params = array('loginInfo' => $_COOKIE['customer_email'], 'password' => $_COOKIE['customer_password']);
                $result = $this->customerLogin($params);
                if ($result['status'] == 'error') { //cannot login
                    return false;
                }
                //successfully login
                $this->setSession('customerData', $result['data']);
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
        window.location.href="login.php?role=customer";//if the cookie or session is empty, go to login
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
