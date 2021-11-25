﻿-- Function: sp_pedcompra(integer, integer, integer, integer, integer)

-- DROP FUNCTION sp_pedcompra(integer, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_pedcompra(
    ban integer,
    vped_com integer DEFAULT 0,
    vemp_cod integer DEFAULT 0,
    vprv_cod integer DEFAULT 0,
    vid_sucursal integer DEFAULT 0)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
begin
	if ban = 1 then --insertar
		INSERT INTO pedido_cabcompra(ped_com, ped_fecha, emp_cod, prv_cod, estado, id_sucursal)
		VALUES (calcular_ultimo('pedido_cabcompra','ped_com'),current_date, vemp_cod,
		vprv_cod, 'P',vid_sucursal);
		mensaje = 'Se agregó correctamente el pedido de compra';	
	elsif ban = 2 then 
		update pedido_cabcompra set prv_cod = vprv_cod
		where ped_com = vped_com;
		mensaje = 'Se actualizó correctamente el pedido de compra';	
	elsif ban = 3 then 
		update pedido_cabcompra set estado ='A'
		where ped_com = vped_com;
		mensaje = 'Se anuló correctamente el pedido de compra';	
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_pedcompra(integer, integer, integer, integer, integer)
  OWNER TO postgres;
