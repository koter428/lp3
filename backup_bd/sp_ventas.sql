-- Function: sp_ventas(integer, integer, integer, integer, character varying, integer, integer, integer, integer)

-- DROP FUNCTION sp_ventas(integer, integer, integer, integer, character varying, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_ventas(
    ban integer,
    vven_cod integer DEFAULT 0,
    vemp_cod integer DEFAULT 0,
    vcli_cod integer DEFAULT 0,
    vtipo_venta character varying DEFAULT ''::character varying,
    vcan_cuota integer DEFAULT 0,
    vven_plazo integer DEFAULT 0,
    vid_sucursal integer DEFAULT 0,
    vped_cod integer DEFAULT 0)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
declare ultven integer;
begin
	if ban = 1 then --insertar
		INSERT INTO ventas(
			    ven_cod, emp_cod, cli_cod, ven_fecha, tipo_venta, can_cuota, 
			    ven_plazo, ven_total, ven_estado, id_sucursal)
		    VALUES (calcular_ultimo('ventas','ven_cod'), vemp_cod, vcli_cod,current_date,
		     vtipo_venta, vcan_cuota, vven_plazo, 0, 'P', vid_sucursal) returning ven_cod into ultven ;	
		     if vped_cod > 0 then
			insert into pedido_venta(ped_cod,ven_cod,obs_pedido)
			values(vped_cod,ultven,'CONFIRMADO EN FECHA '||now());
		     end if;
		     mensaje = 'Se guardó correctamente la venta*ventas_index?vven_cod='||ultven;
	elsif ban  = 2 then --confirmar
		update ventas set ven_estado = 'C'
		where ven_cod = vven_cod;
		mensaje = 'Se confirmó correctamente la venta*ventas_index';
	elsif ban  = 3 then --anular
		update ventas set ven_estado = 'A'
		where ven_cod = vven_cod;
		mensaje = 'Se anuló correctamente la venta*ventas_index';
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_ventas(integer, integer, integer, integer, character varying, integer, integer, integer, integer)
  OWNER TO postgres;
