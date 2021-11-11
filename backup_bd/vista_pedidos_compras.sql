-- DROP VIEW v_pedido_cabcompra;

CREATE OR REPLACE VIEW v_pedido_cabcompra AS 
 SELECT a.ped_com,
    to_char(a.ped_fecha::timestamp with time zone, 'dd/mm/yyyy'::text) AS ped_fecha,
    a.emp_cod,
    (b.emp_nombre::text || ' '::text) || b.emp_apellido::text AS empleado,
    a.prv_cod,
    c.prv_ruc,
    (c.prv_razonsocial::text || ' '::text) AS proveedor,
        CASE a.ped_estado
            WHEN 'P'::text THEN 'PENDIENTE'::text
            WHEN 'C'::text THEN 'CONFIRMADO'::text
            ELSE 'ANULADO'::text
        END AS estado,
    a.id_sucursal,
    d.suc_descri,
    ( SELECT COALESCE(sum(detalle_pedcompra.ped_cant * detalle_pedcompra.ped_precio), 0::bigint) AS "coalesce"
           FROM detalle_pedcompra
          WHERE detalle_pedcompra.ped_com = a.ped_com) AS ped_total,
    convertir_letra((( SELECT COALESCE(sum(detalle_pedcompra.ped_cant * detalle_pedcompra.ped_precio), 0::bigint) AS "coalesce"
           FROM detalle_pedcompra
          WHERE detalle_pedcompra.ped_com = a.ped_com))::numeric) AS totalletra
   FROM pedido_cabcompra a
     JOIN empleado b ON a.emp_cod = b.emp_cod
     JOIN proveedor c ON a.prv_cod = c.prv_cod
     JOIN sucursal d ON a.id_sucursal = d.id_sucursal;

ALTER TABLE v_pedido_cabcompra
  OWNER TO postgres;
