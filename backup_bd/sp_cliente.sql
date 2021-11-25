-- Function: sp_cliente(integer, integer, integer, character varying, character varying, character varying, character varying)

-- DROP FUNCTION sp_cliente(integer, integer, integer, character varying, character varying, character varying, character varying);

CREATE OR REPLACE FUNCTION sp_clientes(
    ban integer,
    vcli_cod integer DEFAULT 0,
    vcli_ci integer DEFAULT 0,
    vcli_nombre character varying DEFAULT ''::character varying,
    vcli_apellido character varying DEFAULT ''::character varying,
    vcli_telefono character varying DEFAULT ''::character varying,
    vcli_direcc character varying DEFAULT ''::character varying)
  RETURNS character varying AS
$BODY$
declare mensaje varchar default null;
	begin
		if ban = 1 then --insertar
			insert into clientes(cli_cod,cli_ci,cli_nombre,cli_apellido,cli_telefono,cli_direcc)
                   values(calcular_ultimo('clientes','cli_cod'),vcli_cod,vcli_ci,trim(upper(vcli_ci)),
                   cli_nombre,cli_apellido,cli_telefono,cli_direcc);
                   mensaje = 'Se guardó correctamente el cliente*cliente_index';
	        elsif ban = 2 then
		        update clientes 
		        set cli_ci = vcli_ci,
		        cli_nombre = vcli_nombre, 
		        cli_apellido = vcli_apellido, 
		        cli_telefono = vcli_telefono, 
		        cli_direcc = vtcli_direcc
		        where cli_cod = vcli_cod;
		        mensaje = 'Se modificó correctamente el cliente*cliente_index';
	       elsif ban = 3 then
		        delete from clientes where cli_cod = cli_cod;
		        mensaje = 'Se eliminó correctamente el cliente*cliente_index';
		        end if;
        return mensaje;
	end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION sp_clientes(integer, integer, integer, character varying, character varying, character varying, character varying)
  OWNER TO postgres;
