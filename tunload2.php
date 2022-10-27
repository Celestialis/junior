<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создаём экземпляры классов БД и объектов
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "Выгруз2";
$product->table_id = "Выгруз2_id";

// запрос данных
$stmt = $product->readAll($from_record_num, $records_per_page);
$num = $stmt->rowCount();

$page_title = "Таблица Выгруз2";
require_once "layout_header.php";
?>

<div class="right-button-margin">
<a href="index.php" class="btn btn-default pull-right">К выбору таблиц</a>
</div>

<?php
// форма поиска
echo "<form role='search' action='search2.php'>";
echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
$search_value = isset($search_term) ? "value='{$search_term}'" : "";
echo "<input type='text' class='form-control' placeholder='Введите продукт или цвет продукта ...' name='s' required {$search_value} />";
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
        echo "<th>Серия</th>";
        echo "<th>Цвета</th>";
        echo "<th>Продукт</th>";
        echo "<th>Код</th>";
        echo "<th>Артикул</th>";
        echo "<th>Ед.Изм.</th>";
        echo "<th>Вес</th>";
        echo "<th>Объем</th>";
        echo "<th>Размер</th>";
        echo "<th>Цвет</th>";
        echo "<th>Код с сайта</th>";
        echo "<th>Ссылка url</th>";
        echo "<th>Количество мест</th>";
        echo "<th>Цена 1</th>";
        echo "<th>Цена 2</th>"; 
        echo "<th>Материал</th>";
        echo "<th>Пятилучье</th>"; 
        echo "<th>Подлокотники</th>"; 
        echo "<th>Механизм качания</th>";
        echo "<th>Регулировка высоты</th>";
        echo "<th>Ширина сидения</th>";
        echo "<th>Глубина сиденья</th>";
        echo "<th>Высота спинки</th>";
        echo "<th>Диапазон регулировки</th>";
        echo "<th>Газ. патрон</th>";
        echo "<th>Допустимая нагрузка</th>";
        echo "<th>Рама</th>";
        echo "<th>Крестовина</th>";
        echo "<th>Ширина упаковки</th>";  
        echo "<th>Высота упаковки</th>";
        echo "<th>Глубина упаковки</th>";
        echo "<th>Изделий в упаковке</th>";      
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
            echo "<td>{$Выгруз2_id}</td>";
            echo "<td>{$Серия}</td>";
            echo "<td>{$Цвета}</td>";
            echo "<td>{$Продукт}</td>";
            echo "<th>{$Код}</th>";
            echo "<th>{$Артикул}</th>";
            echo "<th>{$ЕдиницаИзмерения}</th>";
            echo "<th>{$Вес}</th>";
            echo "<th>{$Объем}</th>";
            echo "<th>{$Размер}</th>";
            echo "<th>{$Цвет}</th>";
            echo "<th>{$КодССайта}</th>";
            echo "<th>{$Ссылкаurl}</th>";
            echo "<th>{$КоличествоМест}</th>";
            echo "<th>{$Цена1}</th>";
            echo "<th>{$Цена2}</th>";
            echo "<th>{$Материал}</th>";
            echo "<th>{$Пятилучье}</th>";
            echo "<th>{$Подлокотники}</th>";
            echo "<th>{$МеханизмКачания}</th>";
            echo "<th>{$РегулировкаВысоты}</th>";
            echo "<th>{$ШиринаСидения}</th>";
            echo "<th>{$ГлубинаСиденья}</th>";
            echo "<th>{$ВысотаСпинки}</th>";
            echo "<th>{$ДиапазонРегулировки}</th>";
            echo "<th>{$ГазПатрон}</th>";
            echo "<th>{$ДопустимаяНагрузка}</th>";
            echo "<th>{$Рама}</th>";
            echo "<th>{$Крестовина}</th>";
            echo "<th>{$ШиринаУпаковки}</th>";
            echo "<th>{$ВысотаУпаковки}</th>";
            echo "<th>{$ГлубинаУпаковки}</th>";
            echo "<th>{$ИзделийВУпаковке}</th>";
        echo "</tr>";

    }

echo "</table>";
}
// сообщим пользователю, что таблица пустая
else {
    echo "<div class='alert alert-info'>Таблица пустая.</div>";
}

// страница, на которой используется пагинация
$page_url = "tunload2.php?";

// подсчёт всех товаров в базе данных, чтобы подсчитать общее количество страниц
$total_rows = $product->countAll();

// пагинация
include_once "paging.php";
?>

<?php // подвал
require_once "layout_footer.php";