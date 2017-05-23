select * from companies;
select * from users where id_company = 1;
select * from permission_groups where id_company = 1;
select * from permission_params where id_company = 1;

select * from users u inner join permission_groups pg
on pg.id = u.id_group where u.id_company = 1;

select * from clients where id_company = 1;

select * from inventory where id_company = 1;
select * from inventory_history;
DELETE FROM inventory WHERE id = 4 AND id_company = 1;

select * from sales where id_company = 1;
select * from sales_products where id_company = 1;

SELECT s.id, s.date_sale, s.total_price, s.status, c.name 
FROM sales s INNER JOIN clients c ON s.id_client = c.id
WHERE s.id_company = "1" ORDER BY s.date_sale DESC LIMIT 0, 10;

SELECT s.*, c.name as client_name 
FROM sales s INNER JOIN clients c ON s.id_client = c.id
WHERE s.id = 1;