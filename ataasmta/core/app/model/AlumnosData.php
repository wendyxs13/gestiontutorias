<?php
class AlumnosData extends Extra {

public $idindicadores;
public $T            ;
public $UNI         ;
public $Unidad      ;
public $DIV2        ;
public $division     ;
public $NIV         ;
public $PLA         ;
public $plan_est    ;
public $ARE         ;
public $RFC         ;
public $CAU         ;
public $CAD         ;
public $CAP         ;
public $TUR         ;
public $DED         ;
public $EDO         ;
public $CRE_ACUM    ;
public $TRII        ;
public $UT_AA       ;
public $UT_RE       ;
public $NAS         ;
public $CRE_PLA     ;
public $EDO2        ;
public $CRE2        ;
public $TRII2       ;
public $UT_AA2      ;
public $UT_RE2      ;
public $AING        ;
public $UA_AA2      ;
public $UA_RE2      ;
public $NA          ;
public $S           ;
public $B           ;
public $MB          ;
public $PROMUAM     ;
public $OTRA_CAL    ;
public $NTRI        ;
public $NTRC        ;
public $ESC         ;
public $PROM        ;
public $FNA         ;
public $EDAD        ;
public $SEXO        ;
public $PUNTAJE     ;
public $TEL         ;
public $NAL         ;
public $EDCAL       ;
public $FECNAC      ;
public $ADEUDO      ;
public $NNTRE       ;
public $FECHA_TITU  ;
public $ADO_TITULA  ;
public $UT_IUEA     ;
public $UT_IUEA2    ;
public $UEA_INS     ;
public $CRE_INS     ;
public $ORIGEN_MAT  ;
public $ED_AL_TIT   ;
public $PRORROGA    ;
public $FOLIO       ;
public $MOTIVO_BAJ  ;
public $TRI_UBICA    ;
public $CRED_CONTA  ;
public $BECA_PRONA  ;
public $CRE_EXC     ;
public $CRE_MIN     ;
public $CRE_MAX     ;
public $TRI_TITULA  ;
public $TRI_CMINCU ;
public $CURP      ;
public $PATE     ;
public $MATE    ;
public $NOM    ;
public $CALLE  ;
public $COLONIA ;
public $CODIGOP     ;
public $DELEG_MPIO  ;
public $LUG_NACIMT ;
public $CORREO_E    ;
public $PORCENTAJE  ;
public $rango_edad  ;
public $Rango_Calif ;
public $Puntaje_Rang ;
public $Clasific_Ini;
public $Semaforo     ;

public $tot_alumnos     ;


	public static $tablename = "alumnos";
	public $extra_fields;
	public $extra_fields_strings;




	public function __construct(){
		$this->extra_fields = array();
		$this->extra_fields_strings = array();

	}


	public function add(){

		$sql = "insert into ".self::$tablename." (".$this->getExtraFieldNames().") ";
		$sql .= "value (".$this->getExtraFieldValues().")";
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

	public function updateById($k,$v){
		$sql = "update ".self::$tablename." set $k=\"$v\" where id=$this->id";
		Executor::doit($sql);
	}
	public static function getById($id){
		 $sql = "select * from ".self::$tablename." where id=$id";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AlumnosData());
	}
	public static function getLastTrimestre(){
		 $sql = "select TRII  from alumnos order by idindicadores desc limit 1";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AlumnosData());
	}
	public static function countByTrimestre(){
		 $sql = "select count(*) as tot_alumnos from ".self::$tablename." where EDO2=24";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AlumnosData());
	}


	public static function getBy($k,$v){
		$sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::one($query[0],new AlumnosData());
	}

	public static function getAllRoot(){
		 $sql = "select * from ".self::$tablename." where category_id is NULL";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}

	public static function getAllNoRoot(){
		 $sql = "select * from ".self::$tablename." where category_id is not NULL";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}

	public static function getAll(){
		 $sql = "select * from ".self::$tablename;
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}


	public static function getCarreras(){
		 $sql = "select PLA,plan_est from alumnos group by plan_est";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}

	public static function getTrimestres(){
		 $sql = "select AING,TRII from alumnos group by TRII order by AING desc;";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}


	public static function getDivisiones(){
		 $sql = "select DIV2,division from alumnos group by division";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}

	public static function getAllBy($k,$v){
		 $sql = "select * from ".self::$tablename." where $k=\"$v\"";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}


	public static function getLike($q){
		$sql = "select * from ".self::$tablename." where name like '%$q%'";
		$query = Executor::doit($sql);
		return Model::many($query[0],new AlumnosData());
	}


}

?>