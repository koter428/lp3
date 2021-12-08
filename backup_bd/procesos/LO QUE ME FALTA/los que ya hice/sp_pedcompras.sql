-- Function: sp_pedcompra(integer, integer, integer, integer, integer)

-- DROP FUNCTION sp_pedcompra(integer, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_pedcompra(
    ban integer,
    vped_com integer,
    vemp_cod integer,
    vprv_cod integer,
    vid_sucursal integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
begin
	if ban = 1 then --insertar
		INSERT INTO pedido_cabcompra(ped_com, emp_cod, ped_fecha, prv_cod, ped_estado, id_sucursal)
		VALUES (calcular_ultimo('pedido_cabcompra','ped_com'),
		vemp_cod,
		current_date, 
		vprv_cod, 
		'P',
		vid_sucursal);
		mensaje = 'Se agregó correctamente el pedido de compra';	
	elsif ban  = 2 then 
		update pedido_cabcompra set prv_cod = vprv_cod
		where ped_com = vped_com;
		mensaje = 'Se actualizó correctamente el pedido de compra';	
	elsif ban = 3 then 
		update pedido_cabcompra set ped_estado ='A'
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
