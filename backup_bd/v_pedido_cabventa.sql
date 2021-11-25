-- View: v_pedido_cabventa

-- DROP VIEW v_pedido_cabventa;

CREATE OR REPLACE VIEW v_pedido_cabventa AS 
 SELECT a.ped_cod,
    to_char(a.ped_fecha::timestamp with time zone, 'dd/mm/yyyy'::text) AS ped_fecha,
    a.emp_cod,
    (b.emp_nombre::text || ' '::text) || b.emp_apellido::text AS empleado,
    a.cli_cod,
    (c.cli_nombre::text || ' '::text) || c.cli_apellido::text AS clientes,
        CASE a.estado
            WHEN 'P'::text THEN 'PENDIENTE'::text
            WHEN 'C'::text THEN 'CONFIRMADO'::text
            ELSE 'ANULADO'::text
        END AS estado,
    a.id_sucursal,
    d.suc_descri,
    ( SELECT sum(detalle_pedventa.ped_cant * detalle_pedventa.ped_precio) AS sum
           FROM detalle_pedventa
          WHERE detalle_pedventa.ped_cod = a.ped_cod) AS ped_total,
    convertir_letra((( SELECT sum(detalle_pedventa.ped_cant * detalle_pedventa.ped_precio) AS sum
           FROM detalle_pedventa
          WHERE detalle_pedventa.ped_cod = a.ped_cod))::numeric) AS totalletra
   FROM pedido_cabventa a
     JOIN empleado b ON a.emp_cod = b.emp_cod
     JOIN clientes c ON a.cli_cod = c.cli_cod
     JOIN sucursal d ON a.id_sucursal = d.id_sucursal;

ALTER TABLE v_pedido_cabventa
  OWNER TO postgres;
