-- Function: sp_sucursal(integer, integer, character varying)

-- DROP FUNCTION sp_sucursal(integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_sucursal(
    ban integer,
    vid_sucursal integer DEFAULT 0,
    vsuc_descri character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$ declare mensaje varchar default null;
begin
         if ban = 1 then --insertar
                   insert into sucursal(id_sucursal,suc_descri)
                   values(calcular_ultimo('sucursal','id_sucursal'),trim(upper(vsuc_descri)));
                   mensaje = 'Se guardó correctamente la sucursal*sucursal_index';
         elsif ban = 2 then
                   update sucursal set suc_descri = trim(upper(vsuc_descri))
                   where id_sucursal =vid_sucursal;
                   mensaje = 'Se modificó correctamente la sucursal*sucursal_index';
          elsif ban = 3 then
                   delete from sucursal
                   where id_sucursal = vid_sucursal;
                   mensaje = 'Se eliminó correctamente la sucursal*sucursal_index';
           end if;        
         return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_sucursal(integer, integer, character varying)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_sucursal(1,0,'asuncion');

	2- modificar
		select sp_sucursal(2,3,'idiotas');

	3- eliminar
		select sp_sucursal(3,3);

	select * from sucursal order by 1

 */