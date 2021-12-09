-- FUNCTION: public.ft_insertar_stock()

-- DROP FUNCTION IF EXISTS public.ft_insertar_stock();

CREATE OR REPLACE FUNCTION public.ft_insertar_stock()
    RETURNS trigger
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE NOT LEAKPROOF
AS $BODY$
begin 
        perform * from stock where dep_cod = new.dep_cod and art_cod = new.art_cod;
        if not found then 
         INSERT INTO stock(dep_cod, art_cod, cant_minima, stoc_cant)
          VALUES (new.dep_cod, new.art_cod, 1, 0);
        end if;
        return new;
         
end;
$BODY$;

ALTER FUNCTION public.ft_insertar_stock()
    OWNER TO postgres;
