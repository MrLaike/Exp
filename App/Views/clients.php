<?
/**
 * @var array $results Общий массив
 * @var array $data Данные переданные из контроллера
 * @var string $url текущая страница
 */
?>

<div>
    <h2>Страница с клиентами</h2>

    <div>
        <table class="clients text-center">
            <tr>
                <th>id</th>
                <th>name</th>
                <th>surname</th>
                <th>phone</th>
                <th>email</th>
            </tr>
            <?php foreach ($data as $client): ?>
            <tr class="items">
                <td><?=$client['id']?></td>
                <td><?=$client['name']?></td>
                <td><?=$client['surname']?></td>
                <td><?= $client['phone'] ?></td>
                <td><?= $client['email'] ?></td>
                <td>
                    <button class="delete" data-id="<?= $client['id'] ?>">удалить</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <form action="<?=$url?>" method="post">
        <lable>Имя</lable>
        <input type="text" name="name">
        <lable>Фамилия</lable>
        <input type="text" name="surname">
        <lable>Телефон</lable>
        <input type="text" name="phone">
        <lable>Эмейл</lable>
        <input type="text" name="email">
        <input type="submit" name="add" value="Добавить">
    </form>
</div>
