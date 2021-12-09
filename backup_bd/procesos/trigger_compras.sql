-- Trigger: antes de insertar
DROP TRIGGER IF EXISTS tbi_detalle_compra ON public.detalle_compra;

CREATE TRIGGER tbi_detalle_compra
    BEFORE INSERT
    ON public.detalle_compra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_insertar_stock();

-- Trigger: despues de insertar
DROP TRIGGER IF EXISTS tai_detalle_compra ON public.detalle_compra;

CREATE TRIGGER tai_detalle_compra
    AFTER INSERT
    ON public.detalle_compra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_actualizar_stock_compra();

-- Trigger: antes de actualizar
DROP TRIGGER IF EXISTS tbu_detalle_compra ON public.detalle_compra;

CREATE TRIGGER tbu_detalle_compra
    BEFORE UPDATE
    ON public.detalle_compra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_insertar_stock();

-- Trigger: despues de actualizar
DROP TRIGGER IF EXISTS tau_detalle_compra ON public.detalle_compra;

CREATE TRIGGER tau_detalle_compra
    AFTER UPDATE
    ON public.detalle_compra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_actualizar_stock_compra();

-- Trigger: antes de borrar
DROP TRIGGER IF EXISTS tad_detalle_compra ON public.detalle_compra;

CREATE TRIGGER tad_detalle_compra
    AFTER DELETE
    ON public.detalle_compra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_actualizar_stock_compra();