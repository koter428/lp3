-- Function: sp_usuarios(integer, integer, character varying, character varying, integer, integer, integer)

-- DROP FUNCTION sp_usuarios(integer, integer, character varying, character varying, integer, integer, integer);

CREATE OR REPLACE FUNCTION sp_usuarios(
    ban integer,
    vusu_cod integer,
    vusu_nick character varying DEFAULT NULL::character varying,
    vusu_clave character varying DEFAULT NULL::character varying,
    vemp_cod integer DEFAULT NULL::integer,
    vgru_cod integer DEFAULT NULL::integer,
    vid_sucursal integer DEFAULT NULL::integer)
  RETURNS character varying AS
$BODY$
-- declaracion de variables
declare mensaje varchar;
declare affectedRows integer;

begin 
-- inicio de logica
  if ban = 1 then
	PERFORM * FROM usuarios WHERE usu_nick = trim(lower(vusu_nick));
	if NOT FOUND then
		INSERT INTO usuarios
		VALUES (
		  calcular_ultimo('usuarios','usu_cod'),
		  trim(lower(vusu_nick)), md5(vusu_clave), 
		  vemp_cod, vgru_cod, 
		  vid_sucursal
		 );  
		 mensaje = 'Se insertó correctamente el usuario '||vusu_nick;
	else 
		mensaje = 'Ya existe el usuario con el nick <strong>'||vusu_nick||'</strong>';
	end if;    
  
   elsif ban = 2 then --actualizar
	if length(vusu_clave) <= 20 then
		vusu_clave = md5(vusu_clave);
	end if;
	
	UPDATE usuarios
	SET 
          usu_nick = COALESCE(trim(lower(vusu_nick)), usu_nick),
          usu_clave = vusu_clave, 
          emp_cod = COALESCE(vemp_cod, emp_cod), 
          gru_cod = COALESCE(vgru_cod, gru_cod), 
          id_sucursal = COALESCE(vid_sucursal, id_sucursal)
        WHERE usu_cod = vusu_cod
	    AND (
	      vusu_nick IS NOT NULL AND vusu_nick IS DISTINCT FROM usu_nick OR
	      vusu_clave IS NOT NULL AND vusu_clave IS DISTINCT FROM usu_clave OR
	      vemp_cod IS NOT NULL AND vemp_cod IS DISTINCT FROM emp_cod OR
	      vgru_cod IS NOT NULL AND vgru_cod IS DISTINCT FROM gru_cod OR
	      vid_sucursal IS NOT NULL AND vid_sucursal IS DISTINCT FROM id_sucursal
	    );  

    GET DIAGNOSTICS affectedRows = ROW_COUNT;
        if affectedRows = 1 THEN
      mensaje = 'Se actualizo el usuario correctamente';
        else 
      mensaje = 'No se encontro el usuario con codigo '||vusu_cod;
        end if;

  elsif ban = 3 then --borrar
    DELETE FROM usuarios 
    WHERE usu_cod = vusu_cod;
  
  GET DIAGNOSTICS affectedRows = ROW_COUNT;
  if affectedRows = 1 THEN
    mensaje = 'Se borro el usuario correctamente';
  else mensaje = 'No se ha encontrado a el usuario';
  end if;

  end if;
  return mensaje;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_usuarios(integer, integer, character varying, character varying, integer, integer, integer)
  OWNER TO postgres;


  /*
	select * from  sp_usuarios(2,5,'1miro','123',3,3,1)
        select * from usuarios;
  */
