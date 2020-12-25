<?php

use function PHPUnit\Framework\isEmpty;

class Customer
{
    private $id;

    /**
     * Static instance of self
     *
     * @var Customer
     */
    protected static $_instance;

    function __construct($db = null)
    {
        // $this->db          = $db;
        require_once('MysqliDb.php');
        $this->db          = new MysqliDb("db4free.net", "pocketmoney", "m&nsuperdry", "pocketmoney", "3306"); //temporary
        //$this->validation  = $validation;
    }


    /** 
     * Set customer id
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
     * Return the total invested amount if the id is set before
     * @return int|NULL
     * 
     */
    function getTotalInvestedAmount()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $id = $this->id;
            $db->where('cusID', $id);
            $result = $db->getOne('Investment', "SUM(amountInvested) AS SUM");
            return intval($result['SUM']);
        }
        return NULL;
    }

    /** 
     * Return the top holding name if the id is set before
     * @return String|NULL
     * 
     */
    function getTopHolding()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $id = $this->id;
            $db->where('cusID', $id);
            $db->orderBy("total", "Desc");
            $db->groupBy("investmentName");
            $result = $db->getOne('Investment', "SUM(amountInvested) AS total, investmentName");
            return strval($result['investmentName']);
        }
        return NULL;
    }

    /** 
     * Return the total count of holding if the id is set before
     * @return int|NULL
     * 
     */
    function getHoldingCount()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $id = $this->id;
            $db->where('cusID', $id);
            $result = $db->getOne('Investment', "COUNT(DISTINCT investmentName) AS count");
            return intval($result['count']);
        }
        return NULL;
    }

    /** 
     * Return the array of distinct investment types => amount invested if the id is set before
     * @return array|NULL
     * 'investmentType' -> array: array of investmentTypes
     * 'amount' -> array: an array
     */
    function getInvestTypesAndAmount()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $id = $this->id;
            $db->where('cusID', $id);
            $db->groupBy('investmentType');
            $investmentTypesToValue = array('investmentType' => array(), 'amount' => array());
            $result = $db->get('Investment', null, "SUM(amountInvested) AS amount, investmentType");
            foreach ($result as $row => $data) {
                array_push($investmentTypesToValue['amount'], $data['amount']);
                array_push($investmentTypesToValue['investmentType'], $data['investmentType']);
            }
            //print_r($investmentTypesToValue['investmentType']);
            return $investmentTypesToValue;
        }

        return NULL;
    }


    /** 
     * Return string of JSON format of investment Type only
     * @return String|NULL
     * 
     * 
     */
    function getInvestTypesJSON()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $data = $this->getInvestTypesAndAmount();
            $investTypesStr = '[';
            foreach ($data['investmentType'] as $type) {
                $investTypesStr .= '\'' . strval($type) . '\',';
            }
            $investTypesStr = substr($investTypesStr, 0, -1);
            $investTypesStr .= ']';
            return $investTypesStr;
        }
        return NULL;
    }

    /** 
     * Return string of JSON format of amount only
     * @return String|NULL
     * 
     * 
     */
    function getInvestAmountsJSON()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $data = $this->getInvestTypesAndAmount();
            $investAmountStr = '[';
            foreach ($data['amount'] as $amount) {
                $investAmountStr .= strval($amount) . ',';
            }
            $investAmountStr = substr($investAmountStr, 0, -1);
            $investAmountStr .= ']';
            return $investAmountStr;
        }
        return NULL;
    }


    /**
     * Login via email/username and password. Session and cookie are not set.
     *
     * @param array $params
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
