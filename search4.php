<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создание экземпляра класса базы данных и товара
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "x";
$product->table_id = "Charact_id";
$product->table_search_1 = "Char1";
$product->table_search_2 = "Char2";

// получение поискового запроса
$search_term = isset($_GET["s"]) ? $_GET["s"] : "";

$page_title = "Вы искали \"{$search_term}\"";
require_once "layout_header.php";

$stmt = $product->search($search_term, $from_record_num, $records_per_page);

// указываем страницу, на которой используется пагинация
$page_url = "search4.php?s={$search_term}&";

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
<a href="tcharunload4.php" class="btn btn-default pull-right">Вернутся к таблице</a>

<?php

// отображаем данные таблицы, если они есть
if ($total_rows > 0) {
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

    // пагинация
    include_once "paging.php";
    }

// содержит наш JavaScript и закрывающие теги html
require_once "layout_footer.php";