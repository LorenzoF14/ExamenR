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
                <th><a href="index.php?page=Orders_OrdersForm&mode=INS&OrderID=0">Nuevo</a></th>
            </tr>
        </thead>
        <tbody>
            {{foreach orders}}
                <tr>
                    <th>{{OrderID}}</th>
                    <th><a href="index.php?page=Orders_OrdersForm&mode=DSP&OrderID={{OrderID}}">{{OrderDate}}</a></th>
                    <th>{{CustomerID}}</th>
                    <th>{{TotalAmount}}</th>
                    <th>{{Status}}</th>
                    <th>
                        <a href="index.php?page=Orders_OrdersForm&mode=UPD&OrderID={{OrderID}}">Editar</a>
                        &nbsp;
                        <a href="index.php?page=Orders_OrdersForm&mode=DEL&OrderID={{OrderID}}">Eliminar</a>
                    </th>
                </tr>
            {{endfor orders}}
        </tbody>
    </table>
</section>
