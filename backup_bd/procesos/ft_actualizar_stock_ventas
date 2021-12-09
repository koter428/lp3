-- FUNCTION: public.ft_actualizar_stock_venta()

-- DROP FUNCTION IF EXISTS public.ft_actualizar_stock_venta();

CREATE OR REPLACE FUNCTION public.ft_actualizar_stock_venta()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
DECLARE vart_descri character varying(100);
begin
	if TG_OP = 'INSERT' then
		-- verifica que haya suficiente existencia
		if (select stoc_cant from stock where dep_cod = new.dep_cod and art_cod = new.art_cod) - new.ven_cant < 0 then
			select art_descri into vart_descri from articulo where art_cod = new.art_cod;
			RAISE EXCEPTION 'No existe suficiente cantidad para vender, para el articulo %', vart_descri;
		end if;
		--actualizar stock
		update stock set stoc_cant = stoc_cant - new.ven_cant
		where art_cod = new.art_cod and dep_cod = new.dep_cod;
		--actualizar total de la venta
		update ventas set ven_total = coalesce((select sum(ven_cant*ven_precio)
		from detalle_ventas where ven_cod = new.ven_cod),0)
		where ven_cod = new.ven_cod;
		return new;
	end if;
	if TG_OP = 'UPDATE' then
		if ((select stoc_cant from stock where dep_cod = new.dep_cod and art_cod = new.art_cod) + old.ven_cant) 
		- new.ven_cant < 0 then
			select art_descri into vart_descri from articulo where art_cod = new.art_cod;
			RAISE EXCEPTION 'No existe suficiente cantidad para vender, para el articulo %', vart_descri;
		end if;
		--agregar stock
		update stock set stoc_cant = stoc_cant + old.ven_cant
		where art_cod = old.art_cod and dep_cod = old.dep_cod;
		--actualizar stock
		update stock set stoc_cant = stoc_cant - new.ven_cant
		where art_cod = new.art_cod and dep_cod = new.dep_cod;
		--actualizar total de la venta
		update ventas set ven_total = coalesce((select sum(ven_cant*ven_precio)
		from detalle_ventas where ven_cod = new.ven_cod),0)
		where ven_cod = new.ven_cod;
		return new;
	end if;	
	if TG_OP = 'DELETE' then
		--agregar stock
		update stock set stoc_cant = stoc_cant + old.ven_cant
		where art_cod = old.art_cod and dep_cod = old.dep_cod;
		--actualizar total de la venta
		update ventas set ven_total = coalesce((select sum(ven_cant*ven_precio)
		from detalle_ventas where ven_cod = old.ven_cod),0)
		where ven_cod = old.ven_cod;
		return old;
	end if;		
end;
$BODY$;

ALTER FUNCTION public.ft_actualizar_stock_venta()
    OWNER TO postgres;
