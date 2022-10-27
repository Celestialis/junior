<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создание экземпляра класса базы данных и товара
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "Выгруз2";
$product->table_id = "Выгруз2_id";
$product->table_search_1 = "Продукт";
$product->table_search_2 = "Цвет";

// получение поискового запроса
$search_term = isset($_GET["s"]) ? $_GET["s"] : "";

$page_title = "Вы искали \"{$search_term}\"";
require_once "layout_header.php";

$stmt = $product->search($search_term, $from_record_num, $records_per_page);

// указываем страницу, на которой используется пагинация
$page_url = "search3.php?s={$search_term}&";

// подсчитываем общее количество строк - используется для разбивки на страницы
$total_rows = $product->countAll_BySearch($search_term);

// форма поиска
echo "<form role='search' action='search3.php'>";
echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
$search_value = isset($search_term) ? "value='{$search_term}'" : "";
echo "<input type='text' class='form-control' placeholder='' name='s' required {$search_value} />";
echo "<div class='input-group-btn'>";
echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
echo "</div>";
echo "</div>";
echo "</form>";

?>
<a href="tunload4.php" class="btn btn-default pull-right">Вернутся к таблице</a>

<?php

// отображаем данные таблицы, если они есть
if ($total_rows > 0) {
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

    // пагинация
    include_once "paging.php";
    }

// содержит наш JavaScript и закрывающие теги html
require_once "layout_footer.php";