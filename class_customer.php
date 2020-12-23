<?php

use function PHPUnit\Framework\isEmpty;

class Customer
{

    function __construct($db = null, $validation = null)
    {
        // $this->db          = $db;
        require_once('MysqliDb.php');
        $this->db          = new MysqliDb("sql12.freemysqlhosting.net", "sql12382802", "Pcfz54XCtn", "sql12382802", "3306"); //temporary
        //$this->validation  = $validation;
    }


    /**
     * Login via email/username and password. Set session and cookie(if checked)
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

        // session_start();
        // $_SESSION["customerdata"] = $userData;
        // session_write_close();

        // if ($rememberMe) {
        //     //if the user choose to "remember me", store the credential into cookie
        //     setcookie("customer_login", $loginInfo, time() + 3600 * 24 * 365);
        //     setcookie("customer_password", $password, time() + 3600 * 24 * 365);
        // }

        return array('status' => 'ok', 'statusMsg' => '', 'data' => $userData);
    }
}
