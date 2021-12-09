select   deposito.dep_descri,
		 articulo.art_descri,
		 stoc_cant,
		 cant_minima
from     stock, deposito, articulo
where    stock.dep_cod = deposito.dep_cod
and      stock.art_cod = articulo.art_cod
order by 1, 2