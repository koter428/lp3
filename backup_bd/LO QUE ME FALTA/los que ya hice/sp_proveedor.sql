-- Function: sp_proveedor(integer, character varying, character varying, character varying, character varying)

-- DROP FUNCTION sp_proveedor(integer, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION sp_proveedor(
    ban integer,
    vprv_cod integer DEFAULT 0,
    vprv_ruc character varying DEFAULT ''::character varying,
    vprv_razonsocial character varying DEFAULT ''::character varying,
    vprv_direccion character varying DEFAULT ''::character varying,
    vprv_telefono character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
begin
	if ban = 1 then
		INSERT INTO proveedor(prv_cod, prv_ruc, prv_razonsocial, 
		prv_direccion, prv_telefono)
		VALUES (calcular_ultimo('proveedor','prv_cod'), 
		vprv_ruc,
		trim(upper(vprv_razonsocial)), 
		vprv_direccion,
		vprv_telefono);	
		mensaje = 'Se guardó correctamente el proveedor*proveedor_index';	
	elsif ban = 2 then
		update proveedor 
		set prv_ruc = vprv_ruc, 
		prv_razonsocial = trim(upper(vprv_razonsocial)), 
		prv_direccion = vprv_direccion, 
		prv_telefono = vprv_telefono
		where prv_cod = vprv_cod;
		mensaje = 'Se modificó correctamente el proveedor*proveedor_index';
	elsif ban = 3 then
		delete from proveedor where prv_cod = vprv_cod;
		mensaje = 'Se eliminó correctamente el proveedor*proveedor_index';
	end if;
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_proveedor(integer,integer, character varying, character varying, character varying, character varying)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_proveedor(1,0,'666','selena gomez','mershmello','32432423');

	2- modificar
		select sp_proveedor(2,4,'777777','Alan Walker','Ava Max','9324425');

	3- eliminar
		select sp_proveedor(3,4);

	select * from proveedor order by 1

 */