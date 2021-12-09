-- Trigger: tbi_detalle_pedcompra
-- DROP TRIGGER IF EXISTS tbi_detalle_pedcompra ON public.detalle_pedcompra;

CREATE TRIGGER tbi_detalle_pedcompra
    BEFORE INSERT
    ON public.detalle_pedcompra
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_insertar_stock();