<?php
class Secconfiguration extends AppModel
{
	public $name = 'Secconfiguration';
	
	public $validate = array(
		'id' => array('numeric'),
		'minpasswordlength' => array(
								        'numeric' => array(
								            'rule' => array('numeric')								            
								         ),
								        'minLength' => array(
								            'rule' => array('minLength', 1)
								        ),  
								    ),
		'passwordtimelife' => array(
								        'numeric' => array(
								            'rule' => array('numeric')								            
								         ),
								        'minLength' => array(
								            'rule' => array('minLength', 1)
								        ),  
								    ),
		'previouspasswordlimit' => array(
								        'numeric' => array(
								            'rule' => array('numeric')								            
								         ),
								        'minLength' => array(
								            'rule' => array('minLength', 1)
								        ),  
								    )
		);
}
?>