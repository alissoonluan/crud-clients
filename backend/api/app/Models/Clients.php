<?php

namespace App\Models;

use App\Lib\Connection;

class Clients
{
    protected $_connectionBase;

    public function __construct() {
        $this->_connectionBase = new Connection();
    }

    public function all($id = '') {

		if($id != '') {
			$where = "id = " .$id;
		} else {
			$where = "1=1";
		}
		
        return $this->_connectionBase->executeWithReturnAll
        ("SELECT * FROM tb_clients
		WHERE $where
        ORDER BY id"); 
    }

    public function insert($request) {
        $name = $request['name'] ? $request['name'] : '';
        $email      = $request['email']      ? $request['email']      : '';

        $sql = "INSERT INTO tb_clients
                                (name, email)
                                VALUES
                                ('".$name ."',
                                 '".$email ."'
                                ) RETURNING id;";
        try {
            $ret = $this->_connectionBase->executeWithReturnRow($sql);
        } catch (Exception $ex) {
            $this->_connectionBase->rollBackTransaction();
        }

        return true;
    }

    public function update($request, $id) {

        $sql = "UPDATE tb_clients SET
                                name      = '".$request['name'] ."',
                                email     = '".$request['email'] ."'
                                WHERE id = $id;";
        try {
            $ret = $this->_connectionBase->executeWithReturnRow($sql);
        } catch (Exception $ex) {
            $this->_connectionBase->rollBackTransaction();
        }

        return true;
    }

    public function delete($id) {
        return $this->_connectionBase->executeWithReturnAll
        ("DELETE FROM tb_clients WHERE id = $id "); 
    }

}