update tbl_tiendas set id_local = concat('L-',if(id<10,concat('00',id),if(id>9 and <100,concat('0',id),id))) where id_local = ''