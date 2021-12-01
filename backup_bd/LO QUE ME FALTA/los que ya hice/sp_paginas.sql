-- Function: sp_pedcompra(integer, integer, character varying,character varying, integer)
-- DROP FUNCTION sp_paginas(integer, integer, character varying,character varying, integer);

CREATE OR REPLACE FUNCTION sp_paginas(
    ban integer,
    vpag_cod integer DEFAULT 0,
    vpag_direc character varying DEFAULT ''::character varying,
    vpag_nombre character varying DEFAULT ''::character varying,
    vmod_cod integer DEFAULT 0)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
begin
	if ban = 1 then --insertar
		INSERT INTO paginas(pag_cod, pag_direc, pag_nombre, mod_cod)
		VALUES (calcular_ultimo('paginas','pag_cod'),vpag_direc, trim(upper(vpag_nombre)), 
		vmod_cod);	
		mensaje = 'Se agregó correctamente la paginas*paginas_index';	
	elsif ban  = 2 then 
		update paginas set pag_nombre = trim(upper(vpag_nombre)),
		pag_direc = vpag_direc
                where pag_cod = vpag_cod;
		mensaje = 'Se actualizó correctamente la paginas*paginas_index';	
	elsif ban = 3 then 
		 delete from paginas where pag_cod = vpag_cod;
		mensaje = 'Se anuló correctamentela paginas*paginas_index';	
	end if;	
	return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_paginas(integer, integer, character varying,character varying, integer)
  OWNER TO postgres;

/*
	Prueba del procedimiento
	1- grabar
		select sp_paginas(1,0,'odio esto','desprecio',1);

	2- modificar
		select sp_paginas(2,41,'te amo','amor platonico',1);

	3- eliminar
		select sp_paginas(3,41);

	select * from paginas order by 1

 */