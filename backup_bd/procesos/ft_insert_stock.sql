-- FUNCTION: public.ft_insert_stock()

-- DROP FUNCTION IF EXISTS public.ft_insert_stock();

CREATE OR REPLACE FUNCTION public.ft_insert_stock()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
begin
	perform * from stock where dep_cod = new.dep_cod and art_cod = new.art_cod;
	if not found then
		insert into stock values(new.dep_cod,new.art_cod,0,0);
	end if;
	return new;
end;
$BODY$;

ALTER FUNCTION public.ft_insert_stock()
    OWNER TO postgres;
