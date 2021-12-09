-- Trigger: antes de insertar
DROP TRIGGER IF EXISTS tbi_detalle_ventas ON public.detalle_ventas;

CREATE TRIGGER tbi_detalle_ventas
    BEFORE INSERT
    ON public.detalle_ventas
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_insertar_stock();

-- Trigger: despues de insertar
DROP TRIGGER IF EXISTS tai_detalle_ventas ON public.detalle_ventas;

CREATE TRIGGER tai_detalle_ventas
    AFTER INSERT
    ON public.detalle_ventas
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_actualizar_stock_venta();

-- Trigger: antes de actualizar
DROP TRIGGER IF EXISTS tbu_detalle_ventas ON public.detalle_ventas;

CREATE TRIGGER tbu_detalle_ventas
    BEFORE UPDATE
    ON public.detalle_ventas
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_insertar_stock();

-- Trigger: despues de actualizar
DROP TRIGGER IF EXISTS tau_detalle_ventas ON public.detalle_ventas;

CREATE TRIGGER tau_detalle_ventas
    AFTER UPDATE
    ON public.detalle_ventas
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_actualizar_stock_venta();

-- Trigger: despues de borrar
DROP TRIGGER IF EXISTS tad_detalle_ventas ON public.detalle_ventas;

CREATE TRIGGER tad_detalle_ventas
    AFTER DELETE
    ON public.detalle_ventas
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_actualizar_stock_venta();