<?php

class Customer
{

    function __construct($db, $validation = null)
    {
        // $this->db          = $db;
        $this->db          = new MysqliDb("sql12.freemysqlhosting.net", "sql12382802", "Pcfz54XCtn", "sql12382802", "3306"); //temporary
        //$this->validation  = $validation;
    }
    /**
     * Login via email/username and password. Set session and cookie(if checked)
     *
     * @param array $param
     * 'loginInfo' String: username or email of the customer
     * 'password' String: password of the customer
     * 'rememberMe' Boolean: true when the box is checked
     * @return array 
     * Contains the returned rows from the select query.
     * 
     *
     */
    public function customerLogin($params)
    {
        $db = MysqliDb::getInstance();
        $validation = $this->validation;

        $loginInfo = $params['loginInfo'];
        $password = $params['password'];
        $rememberMe = $params['rememberMe'];


        $db->where('username', $loginInfo);
        $db->orWhere('email', $loginInfo);

        $result = $db->get('Customer');
        return $result;


        // if ($params['loginBy'] == "telNumber") {
        //     $db->where('concat(dial_code, phone)', str_replace('+', '', $username));
        // } elseif ($params['loginBy'] == "username") {

        //     $db->where('username', $username);
        // } else {
        //     return array('status' => 'error', 'code' => 1, 'statusMsg' => "Invalid Login Type", 'data' => "");
        // }

        // //for admin login from admin site to member site
        // if (!empty($id)) {
        //     $db->where("id", $id);
        //     $loginFromAdmin = 1;
        // } else {
        //     if ($passwordEncryption == "bcrypt") {
        //         // Bcrypt encryption
        //         // Hash can only be checked from the raw values
        //     } else if ($passwordEncryption == "mysql") {
        //         // Mysql DB encryption
        //         $db->where('password', $db->encrypt($password));
        //     } else {
        //         // No encryption
        //         $db->where('password', $password);
        //     }
        // }

        // $result = $db->get('client');

        // if (empty($result))
        //     return array('status' => 'error', 'code' => 1, 'statusMsg' => $translations["E00276"][$language] /* Invalid Login */, 'data' => "");

        // //if doesn't have id means it is not login from admin site
        // if (empty($id)) {
        //     if ($passwordEncryption == "bcrypt") {
        //         // We need to verify hash password by using this function
        //         if (!password_verify($password, $result[0]['password']))
        //             return array('status' => 'error', 'code' => 1, 'statusMsg' => $translations["E00276"][$language] /* Invalid Login */, 'data' => "");
        //     }
        // }


        // //IF Member is registered under this country, prevent login
        // $db->where('registered_block_login', '1');
        // $disabledLoginCountries = $db->map('id')->arrayBuilder()->get('country', null, 'id');

        // if (in_array($result[0]['country_id'], $disabledLoginCountries)) {
        //     return array('status' => 'error', 'code' => 1, 'statusMsg' => $translations["E00754"][$language] /* Invalid Login */, 'data' => '');
        // }


        // $id = $result[0]['id'];
        // $turnOffPopUpMemo = $result[0]['turnOffPopUpMemo'];
        // if ($result[0]['disabled'] == 1) {
        //     // Return error if account is disabled
        //     return array('status' => 'error', 'code' => 1, 'statusMsg' => $translations["E00754"][$language] /* Invalid Login */, 'data' => '');
        // }
        // // Checking if client's countryIP is allowed to login
        // $returnData = $this->countryIPBlock($ip, $id);
        // if ($returnData['status'] = 'error') {
        //     return $returnData;
        // }

        // $sessionID = md5($result[0]['username'] . time());

        // $fields = array('session_id', 'last_login', 'updated_at', 'last_login_ip');
        // $values = array($sessionID, date("Y-m-d H:i:s"), date("Y-m-d H:i:s"), $ip);
        // $db->where('id', $id);
        // $db->update('client', array_combine($fields, $values));

        // //get client blocked rights
        // $column = array(
        //     "(SELECT name FROM mlm_client_rights WHERE id = mlm_client_blocked_rights.rights_id) AS blocked_rights"
        // );
        // $db->where('client_id', $id);
        // $result2 = $db->get("mlm_client_blocked_rights", NULL, $column);

        // $blockedRights = array();
        // foreach ($result2 as $row) {
        //     $blockedRights[] = $row['blocked_rights'];
        // }

        // ### block member if got freewithrebate package
        // $db->where('client_id', $id);
        // $db->where('portfolio_type', 'freeWithRebate');
        // $pID = $db->getValue('mlm_client_portfolio', 'id');

        // if (in_array('reentry Block', $blockedRights)) {
        //     $member['blockedReentry']  = 'true';
        // } else {
        //     $member['blockedReentry']  = 'false';
        // }

        // //Temporarily hardcoded
        // if (in_array('Redeem Prize', $blockedRights)) {
        //     $member['prizeRedeemBlock']  = 'true';
        // } else {
        //     $member['prizeRedeemBlock']  = 'false';
        // }

        // if (in_array('Redeem Prize Listing', $blockedRights)) {
        //     $member['prizeRedeemListingBlock']  = 'true';
        // } else {
        //     $member['prizeRedeemListingBlock']  = 'false';
        // }

        // if (in_array('Redeem Prize Transaction History', $blockedRights)) {
        //     $member['redeemTransactionHistoryBlock']  = 'true';
        // } else {
        //     $member['redeemTransactionHistoryBlock']  = 'false';
        // }
        // // $member['prizeRedeemListingBlock']='false';
        // // $member['redeemTransactionHistoryBlock']='false';
        // // $member['prizeRedeemBlock']='false';



        // // $member['blockedReentry'] = ($pID ? 'true': 'false' );
        // $member['blockedEditProfile'] = 'true';

        // if ($loginFromAdmin == '1') {
        //     $member['agreeDisclaimer'] = 'true';
        // } else {
        //     ### check member agree disclaimer or not
        //     $db->where('client_id', $id);
        //     $db->where('name', 'isAgreeDisclaimer');
        //     $disclaimerValue = $db->getValue('client_setting', 'value');

        //     if (!isset($disclaimerValue)) {
        //         $dataInsert = array(
        //             'name' => 'isAgreeDisclaimer',
        //             'value' => '0',
        //             'client_id' => $id
        //         );
        //         $insertID = $db->insert('client_setting', $dataInsert);

        //         $disclaimerValue = 0;
        //     }

        //     if ($disclaimerValue == '0') {
        //         $member['agreeDisclaimer'] = 'false';
        //     } else {
        //         $member['agreeDisclaimer'] = 'true';
        //     }
        // }

        // if ($member['prizeRedeemBlock'] == 'false') {

        //     $db->where('client_id', $id);
        //     $db->where('name', 'pointCredit');
        //     $redeemPoints = $db->getValue('client_setting', 'value');
        //     if ($redeemPoints >= 1) {
        //         $member['redeemPrizeFlag'] = 1;
        //     } else {
        //         $member['redeemPrizeFlag'] = 0;
        //     }
        // } else {
        //     $member['redeemPrizeFlag'] = 0;
        // }

        // $member['memo'] = $memo;
        // $member['timeOutFlag'] = $setting->getMemberTimeout();
        // $member['userID'] = $id;
        // $member['username'] = $result[0]['username'];
        // $member['userEmail'] = $result[0]['email'];
        // $member['userRoleID'] = $result[0]['role_id'];
        // $member['sessionID'] = $sessionID;
        // $member['pagingCount'] = $setting->getMemberPageLimit();
        // $member['decimalPlaces'] = $setting->getSystemDecimalPlaces();
        // $member['blockedRights'] = $blockedRights;

        // //for mobile apps
        // $db->where("id", $result[0]["country_id"]);
        // $countryName = $db->getValue("country", "name");

        // $member['countryName'] = $countryName;
        // $member['createdOn'] = $result[0]['created_at'];
        // $member['countryCode'] = $result[0]['dial_code'];
        // $member['phone'] = $result[0]['phone'];

        // if ($result[0]['transaction_password']) {
        //     $member['isTransactionPassword'] = 1; // already set transaction password?
        // } else {
        //     $member['isTransactionPassword'] = 0;
        // }

        // // Get client_setting for login
        // $db->where('name', 'hasChangedPassword');
        // $db->where('client_id', $id);
        // $clientSettingRes = $db->getOne('client_setting', null, 'name,value');
        // if ($clientSettingRes) {
        //     // $member[$clientSettingRes['name']]=$clientSettingRes['value'];
        //     $db->where('name', 'hasChangedPassword');
        //     $db->where('client_id', $id);
        //     $db->update('client_setting', array('value' => '0'));
        // }

        // $data['userDetails'] = $member;
        // /* get user's inbox message */
        // $inboxSubQuery = $db->subQuery();
        // $inboxSubQuery->where("`creator_id`", $id);
        // $inboxSubQuery->orWhere("`receiver_id`", $id);
        // $inboxSubQuery->get("`mlm_ticket`", null, "`id`");
        // $db->where("`ticket_id`", $inboxSubQuery, "IN");
        // $db->where("`read`", 0);
        // $db->where("`sender_id`", $id, "!=");
        // $inboxUnreadMessage = $db->getValue("`mlm_ticket_details`", "COUNT(*)");
        // $data['inboxUnreadMessage'] = $inboxUnreadMessage;
        // return array('status' => 'ok', 'code' => 0, 'statusMsg' => '', 'data' => $data);
    }
}
