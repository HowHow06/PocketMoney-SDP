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



    function __construct($id = null, $db = null)
    {
        // $this->db          = $db;
        require_once('MysqliDb.php');
        $this->$id = $id;
        //$this->db          = new MysqliDb("db4free.net", "pocketmoney", "m&nsuperdry", "pocketmoney", "3306"); //temporary
        $this->db          = new MysqliDb("localhost", "root", "", "pocketmoney", "3308"); //temporary
        //$this->validation  = $validation;
        self::$_instance = $this;
    }

    /**
     * A method of returning the static instance to allow access to the
     * instantiated object from within another class.
     * Inheriting this class would require reloading connection info.
     *
     * @uses $customer = Customer::getInstance();
     *
     * @return Customer Returns the current instance.
     */
    public static function getInstance()
    {
        return self::$_instance;
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
     * Return the array of distinct investment NAME and amount invested if the id is set before
     * @return array|NULL
     * 'investmentName' -> array: array of investmentName
     * 'amount' -> array: an array
     */
    function getInvestNameAndAmount()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $id = $this->id;
            $db->where('cusID', $id);
            $db->groupBy('investmentName');
            $investmentNameToValue = array('investmentName' => array(), 'amount' => array());
            $result = $db->get('Investment', null, "SUM(amountInvested) AS amount, investmentName");
            foreach ($result as $row => $data) {
                array_push($investmentNameToValue['amount'], $data['amount']);
                array_push($investmentNameToValue['investmentName'], $data['investmentName']);
            }
            return $investmentNameToValue;
        }

        return NULL;
    }


    /** 
     * Return JSON format of investment Name only
     * @return JSON|NULL
     * 
     * 
     */
    function getInvestNameJSON()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $data = $this->getInvestNameAndAmount();
            $investNameArr = $data['investmentName'];
            $investNameJSON = json_encode($investNameArr);
            return $investNameJSON;
        }
        return NULL;
    }

    /** 
     * Return JSON format of amount(investment Name) only
     * @return JSON |NULL
     * 
     * 
     */
    function getNameAmountsJSON()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $data = $this->getInvestNameAndAmount();
            $investAmountArr = array_map('floatval', $data['amount']);
            $investAmountJSON = json_encode($investAmountArr);
            return $investAmountJSON;
        }
        return NULL;
    }



    /** 
     * Return the array of distinct investment types and amount invested if the id is set before
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
     * Return the array of table data if the id is set before
     * @param String $tablename
     * the name of the table
     * 
     * @param String $columnName
     * the name of the specific column
     * 
     * @return array|NULL
     * 
     */
    function getData($tablename, $columnName = "*")
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $id = $this->id;
            $db->where('cusID', $id);
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
     * Return ONE row of inventment table data for the given investment ID
     * @param String $columnName
     * the name of the specific column
     * 
     * @param String $investmentID
     * the investment id
     * 
     * @return array|NULL
     * 
     */
    function getOneInvestmentData($columnName = "*", $investmentID)
    {
        $db = MysqliDb::getInstance();
        $db->where('investmentID', $investmentID);
        $result = $db->getOne('Investment', $columnName);
        return $result;
    }


    /** 
     * Return JSON format of investment Type only
     * @return JSON|NULL
     * 
     * 
     */
    function getInvestTypesJSON()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $data = $this->getInvestTypesAndAmount();
            $investTypesArr = $data['investmentType'];
            $investTypesJSON = json_encode($investTypesArr);
            return $investTypesJSON;
        }
        return NULL;
    }

    /** 
     * Return JSON format of amount(investment TYPE) only
     * @return JSON |NULL
     * 
     * 
     */
    function getTypeAmountsJSON()
    {
        $db = MysqliDb::getInstance();
        if (!empty($this->id)) {
            $data = $this->getInvestTypesAndAmount();
            $investAmountArr = array_map('floatval', $data['amount']);
            $investAmountJSON = json_encode($investAmountArr);
            return $investAmountJSON;
        }
        return NULL;
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
    public function customerUpdate($params)
    {
        $db = MysqliDb::getInstance();
        $tablename = $params['tableName'];
        $idName = $params['idName'];
        $id = $params['id'];
        $data = $params['data'];

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
    public function customerInsert($params)
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
    public function customerDelete($params)
    {
        $db = MysqliDb::getInstance();
        $tablename = $params['tableName'];
        $idName = $params['idName'];
        $id = $params['id'];

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
