<?php

Class Model_Comments Extends Model_Base {
	
	public $id;
	public $name;
	public $email;
	public $comment;
	public $pic;
	public $date;
	public $status;
	public $moderate;
	
	public function fieldsTable(){
		return array(
			
			'id' => 'Id',
			'name' => 'Name',
			'email' => 'Email',
			'comment' => 'Text',
			'pic' => 'Picture',
			'date' => 'Date Create',
			'status' => 'Status',
			'moderate' => 'Admin Change',

		);
	}
	
}