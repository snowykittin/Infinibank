<?php

class AccountModel
{
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblAccounts;

    private function __construct() {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblAccounts = $this->db->getAccountsTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //Escapes special characters in a string for use in an SQL statement. This stops SQL Injection in GET vars
        foreach ($_GET as $key => $value) {
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
        }
    }

    //static method to ensure there is just one AccountModel instance
    public static function getAccountModel() {
        if (self::$_instance == NULL) {
            self::$_instance = new AccountModel();
        }
        return self::$_instance;
    }


    //list all of a user's accounts
    public function list_accounts(){
        $sql = "SELECT a.account_id, t.type_name, c.currency_symbol, a.value FROM account AS a LEFT JOIN acct_types AS t ON a.account_type = t.type_id LEFT JOIN currency AS c ON a.currency_type = c.currency_id";
        //execute
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            return false;

        //if the query succeeded, but no accounts found.
        if ($query->num_rows == 0)
            return 0;

        $accounts = array();
        //loop recordsets
        while ($obj = $query->fetch_object()){
            $account = new Account(stripslashes($obj->type_name),stripslashes($obj->currency_name),stripslashes($obj->currency_symbol),stripslashes($obj->value));

            $account->setId($obj->account_id);

            $accounts[] = $account;
        }

        return $accounts;
    }

    //view the details of a specific account page, matching the id
    public function view_account($id){
        //query to obtain account information
        $sql = "SELECT a.account_id, t.type_name, c.currency_name, c.currency_symbol, a.value FROM account AS a LEFT JOIN acct_types AS t ON a.account_type = t.type_id LEFT JOIN currency AS c ON a.currency_type = c.currency_id WHERE a.account_id = '$id' ";

        $query = $this->dbConnection->query($sql);

        if($query && $query->num_rows > 0){
            $obj = $query->fetch_object();

            //create an account object
            $account = new Account(stripslashes($obj->type_name),stripslashes($obj->currency_name),stripslashes($obj->currency_symbol),stripslashes($obj->value));

            //set the id
            $account->setId($obj->account_id);

            return $account;
        }
        return false;

    }

    //search for a particular account
    public function search_accounts($terms){
        $terms = explode(" ", $terms); //explode multiple terms into an array

        //select statement, and then search
        $sql = "SELECT a.account_id, t.type_name, c.currency_symbol, a.value FROM account AS a LEFT JOIN acct_types AS t ON a.account_type = t.type_id LEFT JOIN currency AS c ON a.currency_type = c.currency_id WHERE (1";
        foreach($terms as $term){
            $sql.= " AND t.type_name LIKE '%" . $term . "%' OR a.account_id LIKE '%" . $term . "%'";
        }
        $sql .= ")";

        $query = $this->dbConnection->query($sql);
        // the search failed, return false.
        if (!$query)
            return false;

        //search succeeded, but no account was found.
        if ($query->num_rows == 0)
            return 0;

        //search succeeded and found at least one account
        $accounts = array();

        //loop recordsets
        while ($obj = $query->fetch_object()){
            $account = new Account(stripslashes($obj->type_name),stripslashes($obj->currency_name),stripslashes($obj->currency_symbol),stripslashes($obj->value));

            $account->setId($obj->account_id);

            $accounts[] = $account;
        }

        return $accounts;
    }

    //list all transactions related to a specific account
    public function list_transactions($id){
        //query to obtain transactions
        $sqlTrans = "SELECT * FROM transactions WHERE account_id=" . $id;

        $queryTrans = $this->dbConnection->query($sqlTrans);

        // if the query failed, return false.
        if (!$queryTrans)
            return false;

        //if the query succeeded, but no accounts found.
        if ($queryTrans->num_rows == 0)
            return 0;

        $transactions = array();
        //loop recordsets
        while ($obj = $queryTrans->fetch_object()){
            $transaction = new Transaction(stripslashes($obj->transaction_date),stripslashes($obj->transaction_type),stripslashes($obj->amount),stripslashes($obj->description));

            //set transaction_id
            $transaction->setId($obj->transaction_id);

            $transactions[] = $transaction;
        }

        return $transactions;
    }

    //search through a particular set of transactions for an account
    public function search_transactions($terms, $id){
        $terms = explode(" ", $terms); //explode multiple terms into an array

        //search query
        $sql = "SELECT * FROM transactions WHERE account_id=" . $id . " AND (1";
        foreach($terms as $term){
            $sql .= " AND transaction_type LIKE '%" . $term . "%' OR description LIKE '%" . $term . "%'";
        }
        $sql .= ")";

        $query = $this->dbConnection->query($sql);
        // the search failed, return false.
        if (!$query)
            return false;

        //search succeeded, but no transactions were found.
        if ($query->num_rows == 0)
            return 0;

        //successfully found at least one transaction
        $transactions = array();
        //loop recordsets
        while ($obj = $query->fetch_object()){
            $transaction = new Transaction(stripslashes($obj->transaction_date),stripslashes($obj->transaction_type),stripslashes($obj->amount),stripslashes($obj->description));

            //set transaction_id
            $transaction->setId($obj->transaction_id);

            $transactions[] = $transaction;
        }

        return $transactions;

    }

    //list all account types
    public function list_types(){
        $sql = "SELECT * FROM acct_types";
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            return false;

        //if the query succeeded, but no types found.
        if ($query->num_rows == 0)
            return 0;

        $types = array();
        while($obj = $query->fetch_object()){
            $type = new AccountType(stripslashes($obj->type_name));
            $type->setId($obj->type_id);

            $types[] = $type;
        }

        return $types;
    }
    //list all currency types
    public function list_currencies(){
        $sql = "SELECT * FROM currency";
        $query = $this->dbConnection->query($sql);

        // if the query failed, return false.
        if (!$query)
            return false;

        //if the query succeeded, but no currencies found.
        if ($query->num_rows == 0)
            return 0;

        $currencies = array();
        while($obj = $query->fetch_object()){
            $currency = new Currency(stripslashes($obj->currency_name),stripslashes($obj->currency_symbol),stripslashes($obj->currency_type));

            $currency->setId($obj->currency_id);

            $currencies[] = $currency;
        }

        return $currencies;
    }

    //create a new account
    public function create_account(){
        //check for post data. if not there, terminate immediately
        if(!filter_has_var(INPUT_POST, 'member_no') || !filter_has_var(INPUT_POST, 'account_type') || !filter_has_var(INPUT_POST, 'currency_type') || !filter_has_var(INPUT_POST, 'deposit') )
            return false;

        //retrieve values, sanitize for security
        $member_no = $this->dbConnection->filter_input(INPUT_POST, 'member_no', FILTER_SANITIZE_NUMBER_INT);
        $account_type = $this->dbConnection->filter_input(INPUT_POST, 'member_no', FILTER_SANITIZE_NUMBER_INT);
        $currency_type = $this->dbConnection->filter_input(INPUT_POST, 'member_no', FILTER_SANITIZE_NUMBER_INT);
        $deposit = $this->dbConnection->filter_input(INPUT_POST, 'deposit', FILTER_SANITIZE_NUMBER_FLOAT,
            FILTER_FLAG_ALLOW_FRACTION);

        //query string for account creation
        $sql = "INSERT INTO accounts (member_no, account_type, currency_type, value) VALUES (" . $member_no . ", " . $account_type . ", " . $currency_type . ", " . $deposit . ")";

        //execute the query
        return $this->dbConnection->query($sql);
    }
    //deposit transaction - requires account id
    public function deposit(){
        //create new transaction
        $sql = "INSERT INTO transactions (account_id, transaction_date, transaction_type, amount, description) VALUES ()";

        //calculate and update new bank balance

    }
}