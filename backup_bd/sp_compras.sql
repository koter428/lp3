-- DROP FUNCTION sp_compras(integer, integer, integer, integer, character varying, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_compras(
    ban integer,
    vcom_cod integer,
    vemp_cod integer,
    vprv_cod integer,
    vtipo_compra character varying,
    vcan_cuota integer,
    vcom_plazo integer,
    vid_sucursal integer,
    vped_cod integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar;
declare ultcom integer;
begin
	if ban = 1 then --insertar
		INSERT INTO compras(com_cod, emp_cod, prv_cod, com_fecha, tipo_compra, can_cuota, 
			    com_plazo, com_total, com_estado, id_sucursal)
		    VALUES (calcular_ultimo('compras','com_cod'), vemp_cod, vprv_cod,current_date,
		     vtipo_compra, vcan_cuota, vcom_plazo, 0, 'P', vid_sucursal) returning com_cod into ultcom ;	
		     if vped_cod > 0 then
			insert into ped_compra(ped_com,com_cod,obs_pedido)
			values(vcom_cod,ultcom,'CONFIRMADO EN FECHA '||now());
		     end if;
		     mensaje = 'Se guardo correctamente la compra*compras_det.php?vcom_cod='||ultcom;
	end if;
	if ban = 2 then --confirmar
		update compras set com_estado = 'C'
		where com_cod = vcom_cod;
		mensaje = 'Se confirmo correctamente la compra*compras_index.php';
	end if;
	if ban = 3 then --anular
		update compras set com_estado = 'A'
		where com_cod = vcom_cod;
		mensaje = 'Se anulo correctamente la compra*compras_index.php';
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_compras(integer, integer, integer, integer, character varying, integer, integer, integer, integer)
  OWNER TO postgres;