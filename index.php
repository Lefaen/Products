<?php

    // todo: Не забудьте изменить параметры подключения к базе данных
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=test_Base', 'root', 'admin');
    } catch (PDOException $e) {
        echo 'error';
        // Ошибка подключения
    }

    // todo: Добавьте логику приложения в это место
    $data = $pdo->query('SELECT * FROM catalog_products ORDER BY existence ASC, price ASC');
    $data = $data->fetchAll(PDO::FETCH_ASSOC);
    
    $pageNum = 1;
    if(isset($_GET['page']))
    {
        $pageNum = $_GET['page'];
    }
    $limitProductsOnPage = 10;
    $index = ($pageNum - 1) * $limitProductsOnPage;
    $dataPage = array_slice($data, $index, $limitProductsOnPage);
    
    $pages = count($data)/$limitProductsOnPage +1;
    if(count($data) % $limitProductsOnPage == 0)
    {
        $pages = count($data)/$limitProductsOnPage;
    }

    // подключаем файл для вывода html
    include __DIR__ . '/templates/index.phtml';
?>