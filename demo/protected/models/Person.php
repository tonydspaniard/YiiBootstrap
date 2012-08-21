<?php
class Person extends CModel
{
	public $id;
	public $firstName;
	public $lastName;
	public $language;

	public function attributeNames()
	{
		return array(
			'id',
			'firstName',
			'lastName',
			'language',
		);
	}

	public function search()
	{
		return new Person();
	}
}
