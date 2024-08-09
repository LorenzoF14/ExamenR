<h2>{{modeDsc}}</h2>
<form action="index.php?page=Orders_OrdersForm&mode={{mode}}&order_id={{order_id}}" method="post">
    <div>
        <input type="hidden" name="mode" value="{{mode}}">
        <input type="hidden" name="cxfToken" value="{{cxfToken}}">
    </div>
    <div>
        <label for="order_id">Orden ID</label>
        <input type="text" name="order_id" id="order_id" value="{{order_id}}" readonly>
    </div>
    <div>
        <label for="order_date">Fecha de Orden</label>
        <input type="date" name="order_date" id="order_date" value="{{order_date}}" {{isReadOnly}}>
    </div>
    <div>
        <label for="customer_id">ID de Cliente</label>
        <input type="text" name="customer_id" id="customer_id" value="{{customer_id}}" {{isReadOnly}}>
    </div>
    <div>
        <label for="total_amount">Monto Total</label>
        <input type="number" name="total_amount" id="total_amount" value="{{total_amount}}" {{isReadOnly}}>
    </div>
    <div>
        <label for="status">Estado</label>
        <select name="status" id="status" {{isReadOnly}}>
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