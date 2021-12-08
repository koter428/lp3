-- Function: sp_grupos(integer, integer, character varying)

-- DROP FUNCTION sp_grupos(integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_grupos(
    ban integer,
    vgru_cod integer DEFAULT 0,
    vgru_nombre character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$ declare mensaje varchar default null;
begin
           if ban = 1 then --insertar
                   insert into grupos(gru_cod,gru_nombre)
                   values(calcular_ultimo('grupos','gru_cod'),trim(upper(vgru_nombre)));
                   mensaje = 'Se guardó correctamente el grupos*grupos_index';
          elsif ban = 2 then
                   update grupos set gru_nombre = trim(upper(vgru_nombre))
                   where gru_cod = vgru_cod;
                   mensaje = 'Se modifico correctamente el grupos*grupos_index';
          elsif ban = 3 then
                   delete from grupos
                   where gru_cod = vgru_cod;
                   mensaje = 'Se eliminó correctamente el grupos*grupos_index';
           end if;        
         return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_grupos(integer, integer, character varying)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_grupos(1,0,'gerente');

	2- modificar
		select sp_grupos(2,4,'idiotas');

	3- eliminar
		select sp_grupos(3,4);

	select * from grupos order by 1

 */