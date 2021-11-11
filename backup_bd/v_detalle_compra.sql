select sp_detalle_compras( 1, 1, 1,split_part('3_97250','_',1)::integer, 100, 97250) as resul


select * from detalle_compra

select * from v_detalle_compras where com_cod=1 and art_cod =1 and dep_cod =1

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
