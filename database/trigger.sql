CREATE TRIGGER `categoria_update_after` AFTER UPDATE ON `categoria`
 FOR EACH ROW insert into categoria_update (categoria_id, data_update) values (OLD.id, now())