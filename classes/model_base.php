<?php

abstract class Model_Base {

	protected $db;
	protected $table;
	private $dataResult;
	
	public function __construct($select = false) {

		$this->db = Application::getDB();
		
		$modelName = get_class($this);
		$arrExp = explode('_', $modelName);
		$tableName = strtolower($arrExp[1]);
		$this->table = $tableName;

		$sql = $this->_getSelect($select);
		if($sql) $this->_getResult("SELECT * FROM $this->table" . $sql);
	}	
	

	// получить все записи
	function getAllRows(){
		if(!isset($this->dataResult) OR empty($this->dataResult)) return false;
		return $this->dataResult;
	}
	
	// запись в базу данных
	public function save() {
		$arrayAllFields = array_keys($this->fieldsTable());
		$arraySetFields = array();
		$arrayData = array();
		foreach($arrayAllFields as $field){
			if(!empty($this->$field)){
				$arraySetFields[] = $field;
				$arrayData[] = $this->$field;
			}
		}
		$forQueryFields =  implode(', ', $arraySetFields);
		$rangePlace = array_fill(0, count($arraySetFields), '?');
		$forQueryPlace = implode(', ', $rangePlace);
		
		try {
			$db = $this->db;
			$stmt = $db->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");  
			$result = $stmt->execute($arrayData);
		}catch(PDOException $e){
			echo 'Error : '.$e->getMessage();
			echo '<br/>Error sql : ' . "'INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)'"; 
			exit();
		}
		
		return $result;
	}
	
	// составление запроса к базе данных
	private function _getSelect($select) {
		if(is_array($select)){
			$allQuery = array_keys($select);
			foreach($allQuery as $key => $val){
				$allQuery[$key] = strtoupper($val);
			}

			$querySql = "";
			if(in_array("WHERE", $allQuery)){
				foreach($select as $key => $val){
					if(strtoupper($key) == "WHERE"){
						$querySql .= " WHERE " . $val;					
					}
				}
			}
			
			if(in_array("GROUP", $allQuery)){
				foreach($select as $key => $val){
					if(strtoupper($key) == "GROUP"){
						$querySql .= " GROUP BY " . $val;					
					}
				}
			}
			
			if(in_array("ORDER", $allQuery)){
				foreach($select as $key => $val){
					if(strtoupper($key) == "ORDER"){
						$querySql .= " ORDER BY " . $val;					
					}
				}
			}
			
			if(in_array("LIMIT", $allQuery)){
				foreach($select as $key => $val){
					if(strtoupper($key) == "LIMIT"){
						$querySql .= " LIMIT " . $val;					
					}
				}
			}
			
			return $querySql;
		}		
		return false;
	}
	
	// выполнение запроса к базе данных
	private function _getResult($sql){
		try{
			$db = $this->db;
			$stmt = $db->query($sql);
			$rows = $stmt->fetchAll();
			$this->dataResult = $rows;
		}catch(PDOException $e) {
			echo $e->getMessage();
			exit;
		}
		
		return $rows;
	}
	
	// изменение STATUS
	public function updateStatus($status, $whereID){
		$arrayStatus = array("approved", "queue", "rejected");
		if (in_array($status, $arrayStatus)) {
			$db = $this->db;
			$stmt = $db->prepare("UPDATE `$this->table` SET status = '$status' WHERE id = ?");
			$result = $stmt->execute(array($whereID));

			return $result;
		}
		return false;

	}
	// изменения комментария
	public function updateComment($comment, $whereID){

			$db = $this->db;
			$stmt = $db->prepare("UPDATE `$this->table` SET comment = ?, moderate=1 WHERE id = ?");
			$result = $stmt->execute(array($comment, $whereID));

			return $result;


	}
}

