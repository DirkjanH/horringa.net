<?php

// Copyright 2001-2003 Interakt Online. All rights reserved.



if (! defined("_ADODB_MYSQL_LAYER2")) {
 define("_ADODB_MYSQL_LAYER2", 1 );

 

	class KT_ADODB_mysqlt extends ADODB_mysqlt {

		// This corrects a bug in multiple concurent permanent connections
		function _query($sql,$inputarr){
			if ($this->SelectDB($this->database)){
				return parent::_query($sql,$inputarr);
			}else{
				return false;
			}
		}	

		//This corrects a bug in reporting types like enum('a','b') , float('a','b') .. set .. etc

		function &MetaColumns($table) 
		{
			if ($this->metaColumnsSQL) {
				global $ADODB_FETCH_MODE;
				$save = $ADODB_FETCH_MODE;
				$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
				$rs = $this->Execute(sprintf($this->metaColumnsSQL,$table));
				$ADODB_FETCH_MODE = $save;
				if ($rs === false) return false;
				$retarr = array();
				while (!$rs->EOF){
					$fld = new ADOFieldObject();
					$fld->name = $rs->fields[0];
					$fld->type = $rs->fields[1];
					$fld->type = preg_replace("/,.*\)/", ")", $fld->type);
					if (preg_match("/^(.+)\((\d+)\)$/", $fld->type, $query_array)) {
						$fld->type = $query_array[1];
						$fld->max_length = $query_array[2];
					} else {
						$fld->type = preg_replace("/\(.*\)/", "", $fld->type);
						$fld->max_length = -1;
					}

					$fld->not_null = ($rs->fields[2] != 'YES');
					$fld->primary_key = ($rs->fields[3] == 'PRI');
					$fld->auto_increment = (strpos($rs->fields[5], 'auto_increment') !== false);
					$fld->binary = (strpos($fld->type,'blob') !== false);
					if (!$fld->binary) {
						$d = $rs->fields[4];
						if ($d != "" && $d != "NULL") {
							$fld->has_default = true;
							$fld->default_value = $d;
						} else {
							$fld->has_default = false;
						}
					}
					$retarr[($fld->name)] = $fld;	//Interakt
					$rs->MoveNext();
				}

				$rs->Close();
				return $retarr;	
			}
			$retarr = false
			return $retarr;
		}

	

		function ErrorMsg(){
			if (!function_exists('mysql_connect')){
					return 'Your PHP doesn\'t contain the MySQL connection module!';
			}
			return parent::ErrorMsg();
		} 	 

	}

	/*

		by InterAKT
		extends base class to implement FieldHasChange method and locale suport

	*/

	class KT_ADORecordSet_mysqlt extends ADORecordSet_mysqlt {

		var $exfields = false;

		function MoveFirst() 
		{
			//reset fields
			$this->exfields = false;
			parent::MoveFirst();
		}

		function MoveNext() 
		{
			//save the old fields before moving further
			if (!$this->EOF) {
				$this->exfields = $this->fields;//INTERAKT
			}
			return parent::MoveNext();
		}

		/*

			return the old value of a field
			@param
			        $colname - the name of the field
			@return
			        field value

		*/

		function ExFields($colname){
			if ($this->exfields && isset($this->exfields[$colname])) {
				return $this->exfields[$colname];
			} else {
				return null;

			}
		}
	
		/*

			check if the specific field has changed his value on MoveNext
			@param
				$field - the name of the field that we want to watch for
			@return
				boolean true if the field has changed from the previos value , false otherwise

		*/
		function FieldHasChanged($field){
			if ($this->exfields) {
				return ($this->Fields($field) != $this->ExFields($field));
			} else {
				return true;
			}
		}
  }
}
?>
