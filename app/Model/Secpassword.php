<?php
class Secpassword extends AppModel {

	public $name = 'Secpassword';
	public $validate = array(
		'id'=>array('numeric'),
		'secperson_id' => array('numeric'),
		'password' => array('notempty'),
		'status' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
		'Secperson' => array(
			'className' => 'Secperson',
			'foreignKey' => 'secperson_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>