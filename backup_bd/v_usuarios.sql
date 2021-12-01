-- View: v_usuarios

-- DROP VIEW v_usuarios;

CREATE OR REPLACE VIEW v_usuarios AS 
 SELECT a.usu_cod,
    a.usu_nick,
    a.usu_clave,
    a.emp_cod,
    b.car_cod,
    c.car_descri,
    (b.emp_nombre::text || ' '::text) || b.emp_apellido::text AS empleado,
    a.gru_cod,
    d.gru_nombre,
    a.id_sucursal,
    e.suc_descri
   FROM usuarios a
     JOIN empleado b ON a.emp_cod = b.emp_cod
     JOIN cargo c ON b.car_cod = c.car_cod
     JOIN grupos d ON a.gru_cod = d.gru_cod
     JOIN sucursal e ON a.id_sucursal = e.id_sucursal;

ALTER TABLE v_usuarios
  OWNER TO postgres;
