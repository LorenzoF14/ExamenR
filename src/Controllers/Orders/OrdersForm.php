<?php

namespace Controllers\Orders;

use Controllers\PublicController;
use Dao\Orders\Orders as DaoOrder;
use Utilities\Validators;
use Utilities\Site;
use Utilities\ArrUtils;
use Views\Renderer;

class OrdersForm extends PublicController
{
    private $viewData = [];
    private $order_date = "";
    private $customer_id = "";
    private $total_amount = 0.0;
    private $status = "ACT";
    private $order_id = 0;
    private $mode = "DSP";

    private $modeDscArr = [
        "DSP" => "Mostrar %s",
        "INS" => "Crear Nuevo",
        "UPD" => "Actualizar %s",
        "DEL" => "Eliminar %s"
    ];
    private $error = [];
    private $has_errors = false;
    private $isReadOnly = "readonly";
    private $showActions = true;
    private $cxfToken = "";

    private $statusOptions = [
        "ACT" => "Activo",
        "INA" => "Inactivo",
        "CMP" => "Completado",
        "CAN" => "Cancelado"
    ];

    private function addError($errorMsg, $origin = "global")
    {
        if (!isset($this->error[$origin])) {
            $this->error[$origin] = [];
        }
        $this->error[$origin][] = $errorMsg;
        $this->has_errors = true;
    }

    private function getGetData()
    {
        if (isset($_GET['mode'])) {
            $this->mode = $_GET['mode'];
            if (!isset($this->modeDscArr[$this->mode])) {
                $this->addError('Modo Invalido');
            }
        }
        if (isset($_GET["OrderID"])) {
            $this->order_id = intval($_GET["OrderID"]);
            $tmpOrderFromDb = DaoOrder::getById($this->order_id);
            if ($tmpOrderFromDb) {
                $this->order_date = $tmpOrderFromDb['OrderDate'];
                $this->customer_id = $tmpOrderFromDb['CustomerID'];
                $this->total_amount = $tmpOrderFromDb['TotalAmount'];
                $this->status = $tmpOrderFromDb['Status'];
            } else {
                $this->addError("Orden No Encontrada");
            }
        }
    }

    private function getPostData()
    {
        if (isset($_POST["cxfToken"])) {
            $this->cxfToken = $_POST['cxfToken'];
            if (Validators::IsEmpty($this->cxfToken)) {
                $this->addError('Token Invalido');
            }
        }
        if (isset($_POST['mode'])) {
            $tmpMode = $_POST['mode'];
            if (!isset($this->modeDscArr[$tmpMode])) {
                $this->addError("Modo invalido");
            }
            if ($this->mode != $tmpMode) {
                $this->addError("Modo Invalido");
            }
        }
        if (isset($_POST["OrderDate"])) {
            $this->order_date = $_POST['OrderDate'];
            if (Validators::IsEmpty($this->order_date)) {
                $this->addError('Fecha Invalida', "order_date_error");
            }
        }
        if (isset($_POST["CustomerID"])) {
            $this->customer_id = $_POST['CustomerID'];
            if (Validators::IsEmpty($this->customer_id)) {
                $this->addError('Cliente Invalido', "customer_id_error");
            }
        }
        if (isset($_POST["TotalAmount"])) {
            $this->total_amount = $_POST['TotalAmount'];
            if (!is_numeric($this->total_amount) || $this->total_amount <= 0) {
                $this->addError('Monto Total Invalido', "total_amount_error");
            }
        }
        if (isset($_POST["status"])) {
            $this->status = $_POST['status'];
            if (!isset($this->statusOptions[$this->status])) {
                $this->addError('Estado Invalido', "status_error");
            }
        }
    }

    private function executePostAction()
    {
        switch ($this->mode) {
            case "INS":
                $result = DaoOrder::add(
                    $this->order_date,
                    $this->customer_id,
                    $this->total_amount,
                    $this->status
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Orders_OrdersList",
                        "Orden Creada"
                    );
                } else {
                    $this->addError("Error al Crear la Orden");
                }
                break;
            case "UPD":
                $result = DaoOrder::update(
                    $this->order_date,
                    $this->customer_id,
                    $this->total_amount,
                    $this->status,
                    $this->order_id
                );
                if ($result > 0) {
                    Site::redirectToWithMsg(
                        "index.php?page=Orders_OrdersList",
                        "Orden Actualizada"
                    );
                } else {
                    $this->addError("Error al Actualizar la Orden");
                }
                break;
                //
            default:
                $this->addError("Modo Invalido");
                break;
        }
    }

    private function prepareView()
    {
        $this->viewData["modeDsc"] = sprintf($this->modeDscArr[$this->mode], $this->order_date);
        $this->viewData["mode"] = $this->mode;
        $this->viewData["OrderDate"] = $this->order_date;
        $this->viewData["CustomerID"] = $this->customer_id;
        $this->viewData["TotalAmount"] = $this->total_amount;
        $this->viewData["status"] = $this->status;
        $this->viewData["OrderID"] = $this->order_id;
        $this->viewData["error"] = $this->error;
        $this->viewData["has_errors"] = $this->has_errors;

        if ($this->mode == "DSP" || $this->mode == "DEL") {
            $this->isReadOnly = true;
            if ($this->mode == "DSP") {
                $this->showActions = false;
            }
        } else {
            $this->isReadOnly = "";
            $this->showActions = true;
        }
        $this->viewData["isReadOnly"] = $this->isReadOnly;
        $this->viewData["showActions"] = $this->showActions;
        $this->viewData["cxfToken"] = $this->cxfToken;
        $this->viewData["statusOptions"] = ArrUtils::toOptionsArray(
            $this->statusOptions,
            "key",
            "values",
            "selected",
            $this->status
        );
    }

    public function run(): void
    {
        $this->getGetData();
        if ($this->isPostBack()) {
            $this->getPostData();
            $this->executePostAction();
        }
        $this->prepareView();

        Renderer::render("orders/form", $this->viewData);
    }
}
