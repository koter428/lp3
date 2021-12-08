-- Function: sp_clave(integer, integer, character varying)

-- DROP FUNCTION sp_clave(integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_clave(
    vusu_cod integer DEFAULT 0,
    vusu_clave character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$ declare mensaje varchar default null;
declare valusu integer
begin 

         valusu = select (usu_clave,usu_cod) from usuarios 
         if valusu = 1 then --insertar
                   
                   
                   mensaje = 'Se guardo correctamente el cargo*cargo_index';
         elsif ban = 2 then
                   update cargo set car_descri = trim(upper(vcar_descri))
                   where car_cod =vcar_cod;
                   mensaje = 'Se modifico correctamente el cargo*cargo_index';
          elsif ban = 3 then
                   delete from cargo
                   where car_cod = vcar_cod;
                   mensaje = 'Se elimino correctamente el cargo*cargo_index';
           end if;        
         return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_clave(integer, integer, character varying)
  OWNER TO postgres;
