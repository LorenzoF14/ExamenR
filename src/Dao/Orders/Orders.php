<?php

namespace Dao\Orders;

use Dao\Table;

class Orders extends Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * FROM Orders", []);
    }

    //por id
    public static function getById($id)
    {
        return self::obtenerUnRegistro(
            "SELECT * FROM Orders WHERE OrderID = :id",
            ["id" => $id]
        );
    }

    //agregar
    public static function add(
        $order_date,
        $customer_id,
        $total_amount,
        $status
    ) {
        $insertSql = "INSERT INTO Orders (OrderDate, CustomerID, TotalAmount, Status) VALUES (:order_date, :customer_id, :total_amount, :status)";
        return self::executeNonQuery($insertSql, [
            "order_date" => $order_date,
            "customer_id" => $customer_id,
            "total_amount" => $total_amount,
            "status" => $status
        ]);
    }
    //actualizar
    public static function update(
        $OrderDate,
        $CustomerID,
        $TotalAmount,
        $Status,
        $OrderID
    ) {
        $updateSql = "UPDATE Orders SET OrderDate = :OrderDate, CustomerID = :CustomerID, TotalAmount = :TotalAmount, Status = :Status WHERE OrderID = :OrderID";
        return self::executeNonQuery($updateSql, [
            "OrderDate" => $OrderDate,
            "CustomerID" => $CustomerID,
            "TotalAmount" => $TotalAmount,
            "Status" => $Status,
            "OrderID" => $OrderID
        ]);
    }
}
