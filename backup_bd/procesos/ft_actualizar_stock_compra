-- FUNCTION: public.ft_actualizar_stock_compra()

-- DROP FUNCTION IF EXISTS public.ft_actualizar_stock_compra();

CREATE OR REPLACE FUNCTION public.ft_actualizar_stock_compra()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
begin 
     if TG_OP = 'INSERT' then
	 	--actualizar stock
		update stock set stoc_cant = stoc_cant + new.com_cant
		where art_cod = new.art_cod and dep_cod = new.dep_cod;
		--actualizar total de la compra 
		update compras set com_total = coalesce((select sum(com_cant*com_precio)
		from detalle_compra where com_cod = new.com_cod),0)
		where com_cod = new.com_cod;
		return new;
    end if;
	if TG_OP = 'UPDATE' then
		--agregar stock
		update stock set stoc_cant = stoc_cant - old.com_cant
		where art_cod = old.art_cod and dep_cod = old.dep_cod;
		--actualizar stock
		update stock set stoc_cant = stoc_cant + new.com_cant
		where art_cod = new.art_cod and dep_cod = new.dep_cod;
		--actualizar total de la compra 
		update compras set com_total = coalesce((select sum(com_cant*com_precio)
		from detalle_compra where com_cod = new.com_cod),0)
		where com_cod = new.com_cod;
		return new;
	end if;	
	if TG_OP = 'DELETE' then
		--agregar stock
		update stock set stoc_cant = stoc_cant - old.com_cant
		where art_cod = old.art_cod and dep_cod = old.dep_cod;
		--actualizar total de la compra
		update compras set com_total = coalesce((select sum(com_cant*com_precio)
		from detalle_compra where com_cod = old.com_cod),0)
		where com_cod = old.com_cod;
		return old;
	end if;		
end;
$BODY$;

ALTER FUNCTION public.ft_actualizar_stock_compra()
    OWNER TO postgres;
