<?php

class UserIdentity extends CUserIdentity {
    protected $_id;
    protected $_status;
    
    public function authenticate() {
        $password = $this->password;
        $username = $this->username;
        $record = users::model()->findByAttributes(array(
            'username' => $username,
        ));
        $password = md5($password);

        if($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } elseif($record->password !== $password) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $this->_id = $record->id;
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }
    
    public function getId(){
        return $this->_id;
    }    
    
    public function getStatus(){
        return $this->_status;
    }    
        
}

?>
