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

# ordenando as vendas pelas datas mais recentes as mais antigas, concatenando com o cliente
SELECT s.id, s.date_sale, s.total_price, s.status, c.name 
FROM sales s INNER JOIN clients c ON s.id_client = c.id
WHERE s.id_company = "1" ORDER BY s.date_sale DESC LIMIT 0, 10;

# trazendo informações da venda [id=13], junto ao nome do cliente
SELECT s.*, c.name as client_name 
FROM sales s INNER JOIN clients c ON s.id_client = c.id
WHERE s.id = 13;

# calculando total de vendas no periodo de 30 dias 
SELECT SUM(total_price) AS total
FROM sales
WHERE id_company = 1
AND date_sale BETWEEN '2017-05-01' AND '2017-05-31';

# pegando os id's das vendas nesse periodo
SELECT id FROM sales WHERE id_company = 1
AND date_sale BETWEEN '2017-05-01' AND '2017-05-31';
# com os id's das vendas consigo pegar todos os produtos vendidos nesse periodo
SELECT COUNT(*) AS total FROM sales_products WHERE id_sale IN (9,10,13,14,15);