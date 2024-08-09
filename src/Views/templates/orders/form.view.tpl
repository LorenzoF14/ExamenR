<h2>{{modeDsc}}</h2>
<form action="index.php?page=Orders_OrdersForm&mode={{mode}}&OrderID={{OrderID}}" method="post">
    <div>
        <input type="hidden" name="mode" value="{{mode}}">
        <input type="hidden" name="cxfToken" value="{{cxfToken}}">
    </div>
    <div>
        <label for="OrderID">Orden ID</label>
        <input type="text" name="OrderID" id="OrderID" value="{{OrderID}}" readonly>
    </div>
    <div>
        <label for="OrderDate">Fecha de Orden</label>
        <input type="date" name="OrderDate" id="OrderDate" value="{{OrderDate}}" {{isReadOnly}}>
    </div>
    <div>
        <label for="CustomerID">ID de Cliente</label>
        <input type="text" name="CustomerID" id="CustomerID" value="{{CustomerID}}" {{isReadOnly}}>
    </div>
    <div>
        <label for="TotalAmount">Monto Total</label>
        <input type="number" name="TotalAmount" id="TotalAmount" value="{{TotalAmount}}" {{isReadOnly}}>
    </div>
    <div>
        <label for="Status">Estado</label>
        <select name="Status" id="Status" {{isReadOnly}}>
            {{foreach statusOptions}}
                <option value="{{key}}" {{selected}}>{{values}}</option>
                {{endfor statusOptions}}
            </select>
        </div>
        <div>
            {{if showActions}}
                <input type="submit" value="Guardar" {{isReadOnly}}>
                {{endif showActions}}
                <input type="button" value="Cancelar" onclick="location.href='index.php?page=Orders_OrdersList'">
            </div>
        </form>