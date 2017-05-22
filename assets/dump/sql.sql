update users set password = md5(123);

select * from companies;
select * from users where id_company = 1;
select * from permission_groups where id_company = 1;
select * from permission_params where id_company = 1;

select * from users u inner join permission_groups pg
on pg.id = u.id_group;

select * from clients where id_company = 1;

select * from inventory where id_company = 1;
select * from inventory_history;

select * from sales where id_company = 1;
select * from sales_products where id_company = 1;