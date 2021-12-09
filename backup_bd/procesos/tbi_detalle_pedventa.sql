-- Trigger: tbi_detalle_pedventa
-- DROP TRIGGER IF EXISTS tbi_detalle_pedventa ON public.detalle_pedventa;

CREATE TRIGGER tbi_detalle_pedventa
    BEFORE INSERT
    ON public.detalle_pedventa
    FOR EACH ROW
    EXECUTE PROCEDURE public.ft_insertar_stock();