-- FUNCTION: public.sp_detalle_pedcompra(integer, integer, integer, integer, integer, integer)

-- DROP FUNCTION IF EXISTS public.sp_detalle_pedcompra(integer, integer, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION public.sp_detalle_pedcompra(
	ban integer,
	vped_com integer,
	vdep_cod integer,
	vart_cod integer,
	vped_cant integer,
	vped_precio integer)
RETURNS character varying
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE 
AS $BODY$
declare mensaje varchar;
declare tipoi integer;
begin
	if ban = 1 then --insertar 
		perform * from detalle_pedcompra where ped_com = vped_com and dep_cod = vdep_cod and art_cod = vart_cod;
		if not found then
			INSERT INTO detalle_pedcompra(ped_com, dep_cod, art_cod, ped_cant, ped_precio)
			VALUES (vped_com, vdep_cod, vart_cod, vped_cant, vped_precio);
		else
			update detalle_pedcompra set ped_cant = vped_cant,ped_precio=vped_precio
			where ped_com = vped_com and dep_cod = vdep_cod and art_cod = vart_cod;
		end if;
		mensaje = 'Se agregó correctamente el artículo al pedido compra';	
		end if;
	if ban = 2 then --editar
		update detalle_pedcompra set ped_cant = vped_cant,ped_precio=vped_precio
		where ped_com = vped_com and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se actualizó correctamente el articulo al pedido de la compra';		
	end if;	
	if ban = 3 then --borrar
		delete from detalle_pedcompra
		where ped_com= vped_com and dep_cod = vdep_cod and art_cod = vart_cod;
		mensaje = 'Se eliminó correctamente el artículo del pedido de compra';		
	end if;		
	return mensaje;
end;
$BODY$;

ALTER FUNCTION public.sp_detalle_pedcompra(integer, integer, integer, integer, integer, integer)
    OWNER TO postgres;
