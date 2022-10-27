<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "x";
$product->table_id = "Charact_id";

// запрос данных
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Таблица Характеристик Выгруз4";
require_once "layout_header.php";
?>

<div class="right-button-margin">
<a href="index.php" class="btn btn-default pull-right">К выбору таблиц</a>
</div>

<?php
// форма поиска
echo "<form role='search' action='search4.php'>";
echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
$search_value = isset($search_term) ? "value='{$search_term}'" : "";
echo "<input type='text' class='form-control' placeholder='Введите Характеристику 1 или 2 ...' name='s' required {$search_value} />";
echo "<div class='input-group-btn'>";
echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
echo "</div>";
echo "</div>";
echo "</form>";

// отображаем данные таблицы, если они есть
if ($num > 0) {
echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
        echo "<th>id</th>";
        echo "<th>Характеристика 1</th>";
        echo "<th>Характеристика 2</th>";
        echo "<th>Характеристика 3</th>";
        echo "<th>Характеристика 4</th>";
        echo "<th>Характеристика 5</th>";
        echo "<th>Характеристика 6</th>";
        echo "<th>Характеристика 7</th>";
        echo "<th>Характеристика 8</th>";
        echo "<th>Характеристика 9</th>";
        echo "<th>Характеристика 10</th>";
        echo "<th>Характеристика 11</th>";
        echo "<th>Характеристика 12</th>";
        echo "<th>Характеристика 13</th>";
        echo "<th>Характеристика 14</th>";
        echo "<th>Характеристика 15</th>";
        echo "<th>Характеристика 16</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
            echo "<td>{$Charact_id}</td>";
            echo "<td>{$Char1}</td>";
            echo "<td>{$Char2}</td>";
            echo "<td>{$Char3}</td>";
            echo "<td>{$Char4}</td>";
            echo "<td>{$Char5}</td>";
            echo "<td>{$Char6}</td>";
            echo "<td>{$Char7}</td>";
            echo "<td>{$Char8}</td>";
            echo "<td>{$Char9}</td>";
            echo "<td>{$Char10}</td>";
            echo "<td>{$Char11}</td>";
            echo "<td>{$Char12}</td>";
            echo "<td>{$Char13}</td>";
            echo "<td>{$Char14}</td>";
            echo "<td>{$Char15}</td>";
            echo "<td>{$Char16}</td>";
        echo "</tr>";

    }

echo "</table>";
}
// сообщим пользователю, что таблица пустая
else {
    echo "<div class='alert alert-info'>Таблица пустая.</div>";
}

// страница, на которой используется пагинация
$page_url = "tcharunload4.php?";

// подсчёт всех товаров в базе данных, чтобы подсчитать общее количество страниц
$total_rows = $product->countAll();

// пагинация
include_once "paging.php";
?>

<?php // подвал
require_once "layout_footer.php";