-- View: v_detalle_pedcompra

-- DROP VIEW v_detalle_pedcompra;

CREATE OR REPLACE VIEW v_detalle_pedcompra AS 
 SELECT a.ped_com,
    a.dep_cod,
    b.dep_descri,
    a.art_cod,
    c.art_descri,
    c.mar_cod,
    d.mar_descri,
    c.tipo_cod,
    e.tipo_descri,
    a.ped_cant,
    a.ped_precio,
    a.ped_cant * a.ped_precio AS subtotal
   FROM detalle_pedcompra a
     JOIN deposito b ON a.dep_cod = b.dep_cod
     JOIN articulo c ON a.art_cod = c.art_cod
     JOIN marca d ON c.mar_cod = d.mar_cod
     JOIN tipo_impuesto e ON c.tipo_cod = e.tipo_cod;

ALTER TABLE v_detalle_pedcompra
  OWNER TO postgres;