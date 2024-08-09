<?php

namespace Dao\Orders;

use Dao\Table;

class Orders extends Table
{
    public static function getAll()
    {
        return self::obtenerRegistros("SELECT * FROM Orders", []);
    }
}
