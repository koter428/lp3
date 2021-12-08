-- Function: sp_deposito(integer, integer, character varying, integer)

-- DROP FUNCTION sp_deposito(integer, integer, character varying, integer);

CREATE OR REPLACE FUNCTION sp_deposito(
    ban integer,
    vdep_cod integer DEFAULT 0,
    vdep_descri character varying DEFAULT ''::character varying,
    vid_sucursal integer DEFAULT 0)
  RETURNS character varying AS
$BODY$ declare mensaje varchar default null;
begin
         if ban = 1 then --insertar
                   insert into deposito(dep_cod,dep_descri,id_sucursal)
                   values(calcular_ultimo('deposito','dep_cod'),trim(upper(vdep_descri)),vid_sucursal);
                   mensaje = 'Se guardó correctamente el deposito*deposito_index';
         elsif ban = 2 then
                   update deposito 
                   set dep_descri = trim(upper(vdep_descri)),
                   id_sucursal = vid_sucursal
                   where dep_cod =vdep_cod;
                   mensaje = 'Se modificó correctamente el deposito*deposito_index';
          elsif ban = 3 then
                   delete from deposito
                   where  dep_cod = vdep_cod;
                   mensaje = 'Se eliminó correctamente el deposito*deposito_index';
           end if;        
         return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_deposito(integer, integer, character varying, integer)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_deposito(1,0,'deposito',1);

	2- modificar
		select sp_deposito(2,4,'idiotas',1);

	3- eliminar
		select sp_deposito(3,4);

	select * from deposito order by 1

 */