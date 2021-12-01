-- Function: sp_modulos(integer, integer, character varying)

-- DROP FUNCTION sp_modulos(integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_modulos(
    ban integer,
    vmod_cod integer DEFAULT 0,
    vmod_nombre character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
begin
	if ban = 1 then --insertar
		insert into modulos(mod_cod,mod_nombre)
		values(calcular_ultimo('modulos','mod_cod'),trim(upper(vmod_nombre)));
		mensaje = 'Se guardó correctamente el modulos*modulos_index';
	elsif ban = 2 then
		update modulos set mod_nombre = trim(upper(vmod_nombre))
		where mod_cod = vmod_cod;
		mensaje = 'Se modificó correctamente el modulos*modulos_index';
	elsif ban = 3 then
		delete from modulos
		where mod_cod = vmod_cod;
		mensaje = 'Se eliminó correctamente el modulos*modulos_index';
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_modulos(integer, integer, character varying)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_modulos(1,0,'secundario');

	2- modificar
		select sp_modulos(2,7,'camila te odio');

	3- eliminar
		select sp_modulos(3,7);
        4-visualizar
	select * from deposito order by 1

*/