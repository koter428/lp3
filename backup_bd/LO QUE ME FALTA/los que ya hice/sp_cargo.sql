-- Function: sp_cargo(integer, integer, character varying)

-- DROP FUNCTION sp_cargo(integer, integer, character varying);

CREATE OR REPLACE FUNCTION sp_cargo(
    ban integer,
    vcar_cod integer DEFAULT 0,
    vcar_descri character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$ declare mensaje varchar default null;
begin
         if ban = 1 then --insertar
                   insert into cargo(car_cod,car_descri)
                   values(calcular_ultimo('cargo','car_cod'),trim(upper(vcar_descri)));
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
ALTER FUNCTION sp_cargo(integer, integer, character varying)
  OWNER TO postgres;
