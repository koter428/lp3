-- View: v_detalle_compras

-- DROP VIEW v_detalle_compras;

CREATE OR REPLACE VIEW v_detalle_compras AS 
 SELECT a.com_cod,
    a.dep_cod,
    b.dep_descri,
    a.art_cod,
    c.art_descri,
    c.mar_cod,
    d.mar_descri,
    c.tipo_cod,
    e.tipo_descri,
    a.com_cant,
    a.com_cant * a.com_precio AS subtotal,
    a.com_precio,
    a.exenta,
    a.iva_5,
    a.iva_10
   FROM detalle_compra a
     JOIN deposito b ON a.dep_cod = b.dep_cod
     JOIN articulo c ON a.art_cod = c.art_cod
     JOIN marca d ON c.mar_cod = d.mar_cod
     JOIN tipo_impuesto e ON c.tipo_cod = e.tipo_cod;

ALTER TABLE v_detalle_compras
  OWNER TO postgres;
