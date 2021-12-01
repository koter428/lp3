-- Function: sp_impuesto(integer, integer, character varying)

-- DROP FUNCTION sp_impuesto(integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_impuesto(
    ban integer,
    vtipo_cod integer DEFAULT 0,
    vtipo_descri character varying DEFAULT ''::character varying,
    vtipo_porcen integer default 0)
  RETURNS character varying AS
$BODY$ declare mensaje varchar default null;
begin
         if ban = 1 then --insertar
                   insert into tipo_impuesto(tipo_cod,tipo_descri,tipo_porcen)
                   values(calcular_ultimo('tipo_impuesto','tipo_cod'),trim(upper(vtipo_descri)),vtipo_porcen);
                   mensaje = 'Se guardó correctamente el impuesto*impuesto_index';
         elsif ban = 2 then
                   update tipo_impuesto 
                   set tipo_descri = trim(upper(vtipo_descri)),
                   tipo_porcen = vtipo_porcen 
                   where tipo_cod =vtipo_cod;
                   mensaje = 'Se modificó correctamente el impuesto*impuesto_index';
          elsif ban = 3 then
                   delete from tipo_impuesto
                   where  tipo_cod = vtipo_cod;
                   mensaje = 'Se eliminó correctamente el impuesto*impuesto_index';
           end if;        
         return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_impuesto(integer, integer, character varying, integer)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_impuesto(1,0,'iva 20',1);

	2- modificar
		select sp_impuesto(2,4,'iva 40',3);

	3- eliminar
		select sp_impuesto(3,4);

	select * from paginas order by 1

 */