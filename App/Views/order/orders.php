<?
/**
 * @var array $results Общий массив
 * @var array $data Данные переданные из контроллера
 * @var string $url текущая страница
 */
?>

<h3>ORDERS</h3>

<div>
    <table class="text-center">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>surname</th>
            <th>status</th>
            <th>totalPrice</th>
            <th>date</th>
        </tr>
        <?php foreach ($data as $order): ?>
            <tr class="items">
                <td><?=$order['id']?></td>
                <td><?=$order['name']?></td>
                <td><?=$order['surname']?></td>
                <td><?=$order['status']?></td>
                <td><?=$order['totalPrice']?> руб</td>
                <td><?=$order['date']?></td>
                <td>
                    <button class="delete" data-id="<?= $order['id'] ?>">удалить</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

