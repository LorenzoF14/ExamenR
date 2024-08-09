<?php

namespace Controllers\Orders;

use Controllers\PublicController;
use Dao\Orders\Orders;
use Views\Renderer;

class OrdersList extends PublicController
{
    public function run(): void
    {
        $viewData["orders"] = Orders::getAll();
        Renderer::render("orders/list", $viewData);
    }
}
