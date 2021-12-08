-- Function: calcular_ultimo(character varying, character varying)

-- DROP FUNCTION calcular_ultimo(character varying, character varying);

CREATE OR REPLACE FUNCTION calcular_ultimo(
    tabla character varying,
    codigo character varying)
  RETURNS integer AS
$BODY$
declare ultimo integer;
begin
execute 'select coalesce(max('||codigo||'),0)+1 from '||tabla||'' into ultimo;
return ultimo;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION calcular_ultimo(character varying, character varying)
  OWNER TO postgres;
