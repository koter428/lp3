create or replace function sp_pedventas(ban integer,
vped_cod integer, vemp_cod integer, vcli_cod integer, vid_sucursal integer)
returns varchar as
$$
declare mensaje varchar;
begin
	if ban = 1 then --insertar
		INSERT INTO pedido_cabventa(ped_cod, ped_fecha, emp_cod, cli_cod, estado, 
		id_sucursal)
		    VALUES (calcular_ultimo('pedido_cabventa','ped_cod'), current_date,
		    vemp_cod, vcli_cod, 'P', vid_sucursal);
		    mensaje = 'Se inserto correctamente el pedido de venta';	
	end if; 
	if ban = 2 then --modificar
		update pedido_cabventa set cli_cod = vcli_cod
		where ped_cod = vped_cod;
		mensaje = 'Se modifico correctamente el pedido de venta';
	end if;
	if ban = 3 then --anular
		update pedido_cabventa set estado = 'A'
		where ped_cod = vped_cod;
		mensaje = 'Se anulo correctamente el pedido de venta';
	end if;	
	if ban = 4 then -- agregar cliente
	end if;
	return mensaje;
	
end;
$$
language plpgsql;
