-- Function: sp_detalle_pedventa(integer, integer, integer, integer, integer, integer)

-- DROP FUNCTION sp_detalle_pedventa(integer, integer, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_detalle_pedventa(
    ban integer,
    vped_cod integer,
    vdep_cod integer,
    vart_cod integer,
    vped_cant integer,
    vped_precio integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar;
begin
	if ban = 1 then --agregar detalle
		perform * from detalle_pedventa where ped_cod = vped_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		if not found then
			INSERT INTO detalle_pedventa(ped_cod, dep_cod, art_cod, ped_cant, ped_precio)
			VALUES (vped_cod, vdep_cod, vart_cod, vped_cant, vped_precio);
			mensaje = 'Se agrego correctamente el articulo al pedido';	
		else
			update detalle_pedventa set ped_cant =vped_cant,
			ped_precio = vped_precio
			where ped_cod = vped_cod and dep_cod = vdep_cod and art_cod = vart_cod;
			mensaje = 'Se modifico corrrectamente el articulo del pedido';		
		end if;
	end if;
	if ban = 2 then --modificar detalle
		update detalle_pedventa set ped_cant =vped_cant,
		ped_precio = vped_precio
		where ped_cod = vped_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se modifico corrrectamente el articulo del pedido';
	end if;
	if ban = 3 then --borrar detalle
		delete from detalle_pedventa
		where ped_cod = vped_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se elimino corrrectamente el articulo del pedido';		
	end if;
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_detalle_pedventa(integer, integer, integer, integer, integer, integer)
  OWNER TO postgres;
