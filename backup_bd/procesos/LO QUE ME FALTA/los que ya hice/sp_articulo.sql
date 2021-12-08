-- Function: sp_articulo(integer, integer, character varying, integer, character varying, integer, integer, integer)

-- DROP FUNCTION sp_articulo(integer, integer, character varying, integer, character varying, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_articulo(
    ban integer,
    vart_cod integer DEFAULT 0,
    vart_codbarra character varying DEFAULT ''::character varying,
    vmar_cod integer DEFAULT 0,
    vart_descri character varying DEFAULT ''::character varying,
    vart_precioc integer DEFAULT 0,
    vart_preciov integer DEFAULT 0,
    vtipo_cod integer DEFAULT 0)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
begin
	if ban = 1 then
		INSERT INTO articulo(art_cod, art_codbarra, mar_cod, 
		art_descri, art_precioc, art_preciov, tipo_cod)
		VALUES (calcular_ultimo('articulo','art_cod'), vart_codbarra, vmar_cod, trim(upper(vart_descri)), 
		vart_precioc, vart_preciov, vtipo_cod);	
		mensaje = 'Se guardó correctamente el articulo*articulo_index';	
	elsif ban = 2 then
		update articulo 
		set art_codbarra = vart_codbarra, 
		mar_cod = vmar_cod,
		art_descri = vart_descri, 
		art_precioc = vart_precioc, 
		art_preciov = vart_preciov, 
		tipo_cod = vtipo_cod
		where art_cod = vart_cod;
		mensaje = 'Se modificó correctamente el articulo*articulo_index';
	elsif ban = 3 then
		delete from articulo where art_cod = vart_cod;
		mensaje = 'Se eliminó correctamente el articulo*articulo_index';
	elsif ban = 4 then --agregar marca
		/*insert into marca values(calcular_ultimo('marca','mar_cod'),
		trim(upper(vart_descri)));
		mensaje = 'Se guardo correctamente la marca*articulo_add';*/
	elsif ban = 5 then --tipo impuesto
		/*insert into tipo_impuesto values(calcular_ultimo('tipo_impuesto','tipo_cod'),
		trim(upper(vart_descri)));
		mensaje = 'Se guardo correctamente la marca*articulo_add';*/
	end if;
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_articulo(integer, integer, character varying, integer, character varying, integer, integer, integer)
  OWNER TO postgres;
