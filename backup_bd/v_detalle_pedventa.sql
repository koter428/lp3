create view v_detalle_pedventa as
SELECT a.ped_cod, a.dep_cod,b.dep_descri, a.art_cod,c.art_descri,c.mar_cod,
d.mar_descri,c.tipo_cod,e.tipo_descri,a.ped_cant, a.ped_precio,
(a.ped_cant * a.ped_precio) as subtotal
  FROM detalle_pedventa a
  join deposito b on a.dep_cod = b.dep_cod
  join articulo c on a.art_cod = c.art_cod
  join marca d on c.mar_cod = d.mar_cod
  join tipo_impuesto e on c.tipo_cod = e.tipo_cod;
