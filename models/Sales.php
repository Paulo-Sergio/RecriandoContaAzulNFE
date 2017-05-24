<?php

class Sales extends Model {

    public function getList($offset, $idCompany) {
        $sql = "SELECT s.id, s.date_sale, s.total_price, s.status, c.name "
                . "FROM sales s "
                . "LEFT JOIN clients c ON s.id_client = c.id "
                . "WHERE s.id_company = :id_company "
                . "ORDER BY s.date_sale DESC LIMIT $offset, 10";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }

        return null;
    }

    public function getInfo($id, $idCompany) {
        $array = array();

        $sql = "SELECT s.*, c.name as client_name "
                . "FROM sales s "
                . "INNER JOIN clients c ON s.id_client = c.id "
                . "WHERE s.id = :id AND s.id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // pegando informação da venda
            $array['info'] = $stmt->fetch();
        }

        // pegando produtos da venda[sale]
        $array['products'] = $this->getProductsOfSales($id, $idCompany);


        return $array;
    }

    private function getProductsOfSales($idSale, $idCompany) {
        $sql = "SELECT sp.quant, sp.sale_price, i.name "
                . "FROM sales_products sp "
                . "INNER JOIN inventory i ON sp.id_product = i.id "
                . "WHERE sp.id_sale = :id_sale AND sp.id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_sale', $idSale);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
    }

    public function add($idCompany, $clientId, $userId, $productsQuant, $status) {
        $totalPrice = 0;

        // inserindo a venda de fato no banco de dados
        $sql = "INSERT INTO sales SET id_company = :id_company, id_client = :id_client, "
                . "id_user = :id_user, date_sale = NOW(), total_price = :total_price, "
                . "status = :status";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':id_client', $clientId);
        $stmt->bindParam(':id_user', $userId);
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        // pegando o ID da venda Inserida
        $id_sale = $this->db->lastInsertId();

        // calculando o preço total de acordo com os produtos cadastrado na venda
        $totalPrice = $this->calculeProductsPrice($productsQuant, $idCompany);

        // atualizando a preço na venda com o totalPrice
        $this->updateSaleTotalPrice($totalPrice, $id_sale, $idCompany);

        // adicionando os produtos [table = sales_products]
        $this->addTableSalesProducts($productsQuant, $id_sale, $idCompany, $userId);
    }

    private function addTableSalesProducts($productsQuant, $idSale, $idCompany, $userId) {
        $inventory = new Inventory();
        foreach ($productsQuant as $id_prod => $quant_prod) {
            $stmt = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND id_company = :id_company");
            $stmt->bindParam(':id', $id_prod);
            $stmt->bindParam(':id_company', $idCompany);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $price = floatval($row['price']);

                $stmt2 = $this->db->prepare("INSERT INTO sales_products SET id_company = :id_company, id_sale = :id_sale, id_product = :id_product, quant = :quant, sale_price = :sale_price");
                $stmt2->bindParam(':id_company', $idCompany);
                $stmt2->bindParam(':id_sale', $idSale);
                $stmt2->bindParam(':id_product', $id_prod);
                $stmt2->bindParam(':quant', $quant_prod);
                $stmt2->bindParam(':sale_price', $price);
                $stmt2->execute();

                // cada produto que foi vendido precisa dar baixa no estoque
                $inventory->decrease($id_prod, $idCompany, $quant_prod, $userId);
            }
        }
    }

    private function updateSaleTotalPrice($totalPrice, $id_sale, $idCompany) {
        $stmt = $this->db->prepare("UPDATE sales SET total_price = :total_price WHERE id = :id AND id_company = :id_company");
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':id', $id_sale);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();
    }

    private function calculeProductsPrice($productsQuant, $idCompany) {
        $totalPrice = 0;
        foreach ($productsQuant as $id_prod => $quant_prod) {
            $stmt = $this->db->prepare("SELECT price FROM inventory WHERE id = :id AND id_company = :id_company");
            $stmt->bindParam(':id', $id_prod);
            $stmt->bindParam(':id_company', $idCompany);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch();
                $totalPrice += $row['price'] * $quant_prod;
            }
        }
        return $totalPrice;
    }

    public function changeStatus($id, $status, $idCompany) {
        $sql = "UPDATE sales SET status = :status WHERE id = :id AND id_company = :id_company";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->execute();
    }

    public function getTotalRevenue($period1, $period2, $idCompany) {
        $sql = "SELECT SUM(total_price) AS total "
                . "FROM sales "
                . "WHERE id_company = :id_company "
                . "AND date_sale BETWEEN :period1 AND :period2";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':period1', $period1);
        $stmt->bindParam(':period2', $period2);
        $stmt->execute();

        $row = $stmt->fetch();
        $result = $row['total'];

        return floatval($result);
    }

    public function getSoldProducts($period1, $period2, $idCompany) {
        $sql = "SELECT id "
                . "FROM sales "
                . "WHERE id_company = :id_company "
                . "AND date_sale BETWEEN :period1 AND :period2";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        $stmt->bindParam(':period1', $period1);
        $stmt->bindParam(':period2', $period2);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $id = array();
            foreach ($stmt->fetchAll() as $saleItem) {
                // pegando todos os id's das vendas[sales]
                $id[] = $saleItem['id'];
            }

            // com os id's das vendas eu vejo quantos produtos foram vendidos
            return $this->getProductByIdSales($id);
        }

        return null;
    }

    private function getProductByIdSales($idSale) {
        $sql = "SELECT COUNT(*) AS total FROM sales_products WHERE id_sale IN (" . implode(',', $idSale) . ")";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        return $stmt->fetch()['total'];
    }

    public function getSalesFiltered($clientName, $period1, $period2, $status, $order, $idCompany) {
        $sql = "SELECT clients.name, sales.date_sale, sales.status, sales.total_price "
                . "FROM sales "
                . "INNER JOIN clients "
                . "ON sales.id_client = clients.id "
                . "WHERE ";

        $where = array();
        $where[] = "sales.id_company = :id_company";

        if (!empty($clientName)) {
            $where[] = "clients.name LIKE '%" . $clientName . "%'";
        }

        if (!empty($period1) && !empty($period2)) {
            $where[] = "sales.date_sale BETWEEN :period1 AND :period2";
        }

        if ($status != '') {
            $where[] = "sales.status = :status";
        }

        $sql .= implode(' AND ', $where);

        switch ($order) {
            case 'date_desc':
                $sql .= ' ORDER BY sales.date_sale DESC';
                break;
            case 'date_asc':
                $sql .= ' ORDER BY sales.date_sale ASC';
                break;
            case 'status':
                $sql .= ' ORDER BY sales.status ASC';
                break;
            default:
                $sql .= ' ORDER BY sales.date_sale DESC';
                break;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_company', $idCompany);
        if (!empty($period1) && !empty($period2)) {
            $stmt->bindParam(':period1', $period1);
            $stmt->bindParam(':period2', $period2);
        }
        if ($status != '') {
            $stmt->bindParam(':status', $status);
        }
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll();
        }
        return null;
    }

}
