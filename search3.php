<?php
// включаем соединение с БД и файлы с объектами
include_once "config/core.php";
include_once "config/database.php";
include_once "objects/product.php";

// создание экземпляра класса базы данных и товара
$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$product->table_name = "Выгруз4";
$product->table_id = "Charact_id";
$product->table_search_1 = "Название_раздела";
$product->table_search_2 = "Материал";

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
            echo "<th>ID элемента</th>";
            echo "<th>Название раздела</th>";
            echo "<th>Артикул</th>";
            echo "<th>Наименование товара</th>";
            echo "<th>Производитель</th>";
            echo "<th>Материал</th>";
            echo "<th>Натуральная кожа</th>";
            echo "<th>Ширина</th>";
            echo "<th>Диапазон регулировки 1</th>";
            echo "<th>Высота</th>";
            echo "<th>Высота спинки 1</th>";
            echo "<th>Глубина</th>";
            echo "<th>Макс нагрузка</th>";
            echo "<th>Цвета</th>";
            echo "<th>Ролики</th>"; 
            echo "<th>Пятилучье</th>";
            echo "<th>Подлокотники</th>"; 
            echo "<th>Высота спинки 2</th>"; 
            echo "<th>Диапазон регулировки 2</th>";
            echo "<th>Вес коробки</th>";
            echo "<th>Объем</th>";
            echo "<th>Габариты изделия</th>";
            echo "<th>Габариты упаковки</th>";
            echo "<th>Детальное описание</th>";
            echo "<th>Скачать инструкцию по эксплуатации</th>";
            echo "<th>Скачать инструкцию по сборке</th>";
            echo "<th>Изображения для Яндекс.Директа</th>";
            echo "<th>Изображение для печати</th>";
            echo "<th>Картинка для анонса (путь)</th>";  
            echo "<th>ID элемента предложения</th>";
            echo "<th>ID элемента родителя</th>";
            echo "<th>Наименование предложения</th>";
            echo "<th>Цвет</th>";
            echo "<th>Картинки предложений</th>";       
        echo "</tr>";
    
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    
            extract($row);
    
            echo "<tr>";
                echo "<td>{$Charact_id}</td>";
                echo "<td>{$ID_элемента}</td>";
                echo "<td>{$Название_раздела}</td>";
                echo "<td>{$Артикул}</td>";
                echo "<th>{$Наименование_товара}</th>";
                echo "<th>{$Производитель}</th>";
                echo "<th>{$Материал}</th>";
                echo "<th>{$Натуральная_кожа}</th>";
                echo "<th>{$Ширина}</th>";
                echo "<th>{$Диапазон_регулировки_1}</th>";
                echo "<th>{$Высота}</th>";
                echo "<th>{$Высота_спинки_1}</th>";
                echo "<th>{$Глубина}</th>";
                echo "<th>{$Макс_нагрузка}</th>";
                echo "<th>{$Цвета}</th>";
                echo "<th>{$Ролики}</th>";
                echo "<th>{$Пятилучье}</th>";
                echo "<th>{$Подлокотники}</th>";
                echo "<th>{$Высота_спинки_2}</th>";
                echo "<th>{$Диапазон_регулировки_2}</th>";
                echo "<th>{$Вес_коробки}</th>";
                echo "<th>{$Объем}</th>";
                echo "<th>{$Габариты_изделия}</th>";
                echo "<th>{$Габариты_упаковки}</th>";
                echo "<th>{$Детальное_описание}</th>";
                echo "<th>{$Скачать_инструкцию_по_эксплуатации}</th>";
                echo "<th>{$Скачать_инструкцию_по_сборке}</th>";
                echo "<th>{$Изображения_для_ЯндексДиректа}</th>";
                echo "<th>{$Изображение_для_печати}</th>";
                echo "<th>{$Картинка_для_анонса_путь}</th>";
                echo "<th>{$ID_элемента_предложения}</th>";
                echo "<th>{$ID_элемента_родителя}</th>";
                echo "<th>{$Наименование_предложения}</th>";
                echo "<th>{$Цвет}</th>";
                echo "<th>{$Картинки_предложений}</th>";
            echo "</tr>";
    
        }
    
    echo "</table>";

    // пагинация
    include_once "paging.php";
    }

// содержит наш JavaScript и закрывающие теги html
require_once "layout_footer.php";