<?php
class UsuariosIntData extends Extra{
	public static $tablename = "usuarios_int";
	public $extra_fields;
	public $extra_fields_strings;
	public $id;
	public $name;
	public $prefijo;
	public $tipo;
	public $adscripcion;
	public $division;
	public $User;
	public $email;
	public $fechaRegistro;
	public $Password;

	public $rol;
	public $funcion;
	public $compania;
	public $creado;
	public $editado;
	public $fechaUpdate;
	public $firma;
	public $fima2;

	public $perfil;
	public $activo;
	public $firma2;

	public function __construct(){
		$this->extra_fields = array();
		$this->extra_fields_strings = array();
	}


	public function add(){

		$sql = "insert into usuarios_int (".$this->getExtraFieldNames().",fechaRegistro) ";
		$sql .= "value (".$this->getExtraFieldValues().",NOW())";
		return Executor::doit($sql);
	}




	public function del(){
		$sql = "delete from ".self::$tablename." where id=$this->id";
		Executor::doit($sql);
	}

	public static function delBy($k,$v){
		$sql = "delete from ".self::$tablename." where $k=\"$v\"";
		Executor::doit($sql);
	}

	public function update(){
		$sql = "update ".self::$tablename." set ".$this->getExtraFieldforUpdate()." where id=$this->id";
		Executor::doit($sql);
	}

		public function update_password(){
		$sql = "update ".self::$tablename." set password=\"$this->Password\" where id=$this->id";
		Executor::doit($sql);
	}

	public function update_passwd(){
		$sql = "update ".self::$tablename." set password=\"$this->password\" where id=$this->id";
		Executor::doit($sql);
	}

	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}

	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UsuariosIntData());
	}

	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new UsuariosIntData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosIntData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosIntData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new UsuariosIntData());
	}


}

?>