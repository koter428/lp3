-- Function: sp_detalle_compras(integer, integer, integer, integer, integer, integer)

-- DROP FUNCTION sp_detalle_compras(integer, integer, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_detalle_compras(
    ban integer,
    vcom_cod integer,
    vdep_cod integer,
    vart_cod integer,
    vcom_cant integer,
    vcom_precio integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar;
declare tipoi integer;
begin
	if ban = 1 then --insertar 
		select tipo_cod into tipoi from articulo where art_cod = vart_cod; 
		perform * from detalle_compra where com_cod = vcom_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		if not found then
			INSERT INTO detalle_compra(com_cod, dep_cod, art_cod, com_cant, com_precio, exenta, iva_5, 
			iva_10)
			VALUES (vcom_cod, vdep_cod, vart_cod, vcom_cant, vcom_precio, 
			(case tipoi when 1 then (vcom_cant*vcom_precio) else 0 end),
			(case tipoi when 2 then (vcom_cant*vcom_precio) else 0 end), 
			(case tipoi when 3 then (vcom_cant*vcom_precio) else 0 end));
		else
			update detalle_compra set com_cant = vcom_cant,com_precio=vcom_precio,
			exenta = (case tipoi when 1 then (vcom_cant*vcom_precio) else 0 end),
			iva_5 = (case tipoi when 2 then (vcom_cant*vcom_precio) else 0 end),
			iva_10 = (case tipoi when 3 then (vcom_cant*vcom_precio) else 0 end)
			where com_cod = vcom_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		end if;
		mensaje = 'Se agrego correctamente el articulo a la compra';	
		end if;
	if ban = 2 then --editar
		update detalle_compra set com_cant = vcom_cant,com_precio=vcom_precio,
		exenta = (case tipoi when 1 then (vcom_cant*vcom_precio) else 0 end),
		iva_5 = (case tipoi when 2 then (vcom_cant*vcom_precio) else 0 end),
		iva_10 = (case tipoi when 3 then (vcom_cant*vcom_precio) else 0 end)
		where com_cod = vcom_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se actualizo correctamente el articulo a la compra';		
	end if;	
	if ban = 3 then --borrar
		delete from detalle_compra
		where com_cod = vcom_cod and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se elimino correctamente el articulo a la compra';		
	end if;		
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_detalle_compras(integer, integer, integer, integer, integer, integer)
  OWNER TO postgres;
