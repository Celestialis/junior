<?php

class Product
{
    // подключение к базе данных и имя таблицы
    private $conn;
    public $table_name = "";

    public $table_id = "";
    public $table_search_1 = "";
    public $table_search_2 = "";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // метод для получения данных таблиц
    function readAll($from_record_num, $records_per_page)
    {
        // запрос MySQL
        $query = "SELECT *
                    FROM " . $this->table_name . "
                    ORDER BY
                    " . $this->table_id . "
                    LIMIT {$from_record_num}, {$records_per_page}";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }
    // используется для пагинации данных таблиц
    public function countAll()
    {
        // запрос MySQL
        $query = "SELECT " . $this->table_id . " FROM " . $this->table_name . "";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }
    // выбираем параметры по поисковому запросу
    public function search($search_term, $from_record_num, $records_per_page)
    {
        // запрос к БД
        $query = "SELECT *
            FROM " . $this->table_name . "
            WHERE
            " . $this->table_search_1 . " LIKE ? OR " . $this->table_search_2 . " LIKE ?
            ORDER BY
            " . $this->table_id . " ASC
            LIMIT
            ?, ?";

        // подготавливаем запрос
        $stmt = $this->conn->prepare($query);

        // привязываем значения переменных
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);
        $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);

        // выполняем запрос
        $stmt->execute();

        // возвращаем значения из БД
        return $stmt;
    }

    // метод для подсчёта общего количества строк
    public function countAll_BySearch($search_term)
    {
        // запрос
        $query = "SELECT
                COUNT(*) as total_rows
            FROM
            " . $this->table_name . " 
            WHERE
            " . $this->table_search_1 . " LIKE ? OR " . $this->table_search_2 . " LIKE ?";

        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // привязка значений
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row["total_rows"];
    }
}