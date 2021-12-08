-- Function: sp_compras(integer, integer, integer, integer, character varying, integer, integer, integer, integer)

-- DROP FUNCTION sp_compras(integer, integer, integer, integer, character varying, integer, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_compras(
    ban integer,
    vcom_cod integer DEFAULT 0,
    vemp_cod integer DEFAULT 0,
    vprv_cod integer DEFAULT 0,
    vtipo_compra character varying DEFAULT ''::character varying,
    vcan_cuota integer DEFAULT 0,
    vcom_plazo integer DEFAULT 0,
    vid_sucursal integer DEFAULT 0,
    vped_cod integer)
  RETURNS character varying AS
$BODY$
declare mensaje varchar;
declare ultcom integer;
begin
	if ban = 1 then --insertar
		INSERT INTO compras(com_cod,
		 emp_cod,
		  prv_cod,
		   com_fecha,
		    tipo_compra,
		     can_cuota, 
	              com_plazo,
	               com_total,
	                com_estado,
	                 id_sucursal)
		    VALUES (calcular_ultimo('compras','com_cod'), 
		    vemp_cod,
		     vprv_cod,current_date,
		     vtipo_compra,
		      vcan_cuota,
		       vcom_plazo, 0, 'P', vid_sucursal) returning com_cod into ultcom ;	
		     if vped_cod > 0 then
			insert into ped_compra
			(ped_com,com_cod,obs_pedido)
			values(vcom_cod,ultcom,'CONFIRMADO EN FECHA '||now());
		     end if;
		     mensaje = 'Se guardó correctamente la compra*compras_index.php?vcom_cod='||ultcom;
	end if;
	elsif ban = 2 then --confirmar
		update compras set com_estado = 'C'
		where com_cod = vcom_cod;
		mensaje = 'Se confirmó correctamente la compra*compras_index.php';
	end if;
	elsif ban = 3 then --anular
		update compras set com_estado = 'A'
		where com_cod = vcom_cod;
		mensaje = 'Se anuló correctamente la compra*compras_index.php';
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_compras(integer, integer, integer, integer, character varying, integer, integer, integer, integer)
  OWNER TO postgres;
