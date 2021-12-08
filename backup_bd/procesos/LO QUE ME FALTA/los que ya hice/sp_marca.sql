-- Function: sp_marca(integer, integer, character varying)

-- DROP FUNCTION sp_marca(integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_marca(
    ban integer,
    vmar_cod integer DEFAULT 0,
    vmar_descri character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
begin
	--sentencias sql
	if ban = 1 then --insertar
		 insert into marca(mar_cod,mar_descri)
                   values(calcular_ultimo('marca','mar_cod'),trim(upper(vmar_descri)));
		mensaje = 'Se guardó correctamente la marca*marca_index';
	elsif ban = 2 then
		update marca set mar_descri = upper(trim(vmar_descri))
		where mar_cod = vmar_cod;
		mensaje = 'Se actualizó correctamente la marca*marca_index';
	elsif ban = 3 then
		delete from marca
		where mar_cod = vmar_cod;
		mensaje = 'Se eliminó correctamente la marca*marca_index';
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_marca(integer, integer, character varying)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_marca(1,0,'porquee');

	2- modificar
		select sp_marca(2,15,'te amo');

	3- eliminar
		select sp_marca(3,15);

	select * from marca order by 1

 */