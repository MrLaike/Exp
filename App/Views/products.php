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
            <th>title</th>
            <th>price</th>
            <th>date</th>
        </tr>
        <?php foreach ($data as $product): ?>
            <tr class="items">
                <td><?=$product['id']?></td>
                <td><?=$product['title']?></td>
                <td><?=$product['price']?> руб</td>
                <td><?=$product['date']?></td>
                <td>
                    <button class="delete" data-id="<?= $product['id'] ?>">удалить</button>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

