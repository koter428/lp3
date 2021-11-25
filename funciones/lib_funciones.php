<?php
	// esta funcion separa el mensaje de la base de datos
	function fn_separar_mensajebd($msn){
		$resultado = explode("*",$msn);
		return $resultado;
	}

    function fn_validar_dato($dato,$tipo,$formato_fecha='Y-m-d H:i')
	{
		if($tipo == "float"){
			if(filter_var($dato, FILTER_VALIDATE_FLOAT) === false)
				return false;
		}
		else if($tipo == "integer"){
			if(filter_var($dato, FILTER_VALIDATE_INT) === false)
				return false;
		}
		else if($tipo == "string"){
			if(!preg_match('/^[a-zA-Z ñÑáéíóúüç]*$/', $dato))
				return false;
		}
		else if($tipo == "date"){
			$d = DateTime::createFromFormat($formato_fecha, $dato);
			return $d && $d->format($formato_fecha) == $dato;
		}
		else if($tipo == "telefono"){
			if(!preg_match("/^([0-9]){9}|([0-9]){10}|([0-9]){11}|([0-9]){12}|([0-9]){13}|([0-9]){14}
			|([0-9]){15}$/", $dato))
				return false;
		}
		else if($tipo == "email")
		{
			if(filter_var($dato, FILTER_VALIDATE_EMAIL) === false)
				return false;
		}
		else if($tipo == "ruc")
		{
			if(!preg_match('/^([0-9]{8})|([0-9]{7})|([0-9]{6})|([0-9]{6})($-[0-9]{1})$/', $dato))
				return false;
		}
		else if($tipo == "timbrado")
		{
			if(!preg_match('/^[0-9]{8}$/', $dato))
				return false;
		}
		
		return true;
	}