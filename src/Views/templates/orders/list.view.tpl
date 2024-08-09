<h2>Listado de Órdenes</h2>
<section class="WWList">
    <table>
        <thead>
            <tr>
                <th>OrderID</th>
                <th>OrderDate</th>
                <th>CustomerID</th>
                <th>TotalAmount</th>
                <th>Status</th>
                <th><a href="index.php?page=Orders_OrdersForm&mode=INS&order_id=0">Nuevo</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach orders}}
                <tr>
                    <th>{{order_id}}</th>
                    <th><a href="index.php?page=Orders_OrdersForm&mode=DSP&order_id={{order_id}}">{{order_date}}</a></th>
                    <th>{{customer_id}}</th>
                    <th>{{total_amount}}</th>
                    <th>{{status}}</th>
                    <th>
                        <a href="index.php?page=Orders_OrdersForm&mode=UPD&order_id={{order_id}}">Editar</a>
                        &nbsp;
                        <a href="index.php?page=Orders_OrdersForm&mode=DEL&order_id={{order_id}}">Eliminar</a>
                    </th>
                </tr>
                {{endfor orders}}
            </tbody>
        </table>
    </section>