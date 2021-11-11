-- View: v_compras

-- DROP VIEW v_compras;

CREATE OR REPLACE VIEW v_compras AS 
SELECT a.com_cod,
    a.emp_cod,
    (b.emp_nombre::text || ' '::text) || b.emp_apellido::text AS empleado,
    a.prv_cod,
    c.prv_ruc,
    (c.prv_razonsocial::text || ' '::text) As proveedores,
    to_char(a.com_fecha::timestamp with time zone, 'dd/mm/yyyy'::text) AS com_fecha,
    a.tipo_compra,
    a.can_cuota,
    a.com_plazo,
    a.com_total,
        CASE a.com_estado
            WHEN 'P'::text THEN 'PENDIENTE'::text
            WHEN 'C'::text THEN 'CONFIRMADO'::text
            ELSE 'ANULADO'::text
        END AS com_estado,
    a.id_sucursal,
    d.suc_descri,
    convertir_letra(a.com_total::numeric) AS totalletra,
    COALESCE(e.ped_com, 0) AS ped_cod
   FROM compras a
     JOIN empleado b ON a.emp_cod = b.emp_cod
     JOIN proveedor c ON a.prv_cod = c.prv_cod
     JOIN sucursal d ON a.id_sucursal = d.id_sucursal
     LEFT JOIN ped_compra e ON a.com_cod = e.com_cod;

ALTER TABLE v_compras
  OWNER TO postgres;
