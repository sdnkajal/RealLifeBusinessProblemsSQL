<?php

const DB_HOST = '127.0.0.1';
const DBNAME = 'real_sql';
const DB_USER = 'root';
const DB_PASSWORD = "";
const DNS = "mysql:host=".DB_HOST.";dbname=".DBNAME.";charset=UTF8";
try {
    $pdo = new PDO(DNS,DB_USER,DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Connection error: ' . $e->getMessage();
}

$task_01 = "SELECT c.id, c.name, c.email, c.location, COUNT(o.id) AS total_orders ";
$task_01 .= "FROM customers c LEFT JOIN orders o ON c.id = o.customer_id ";
$task_01 .= "GROUP BY c.id, c.name, c.email, c.location ORDER BY total_orders DESC";
$pdo_statement = $pdo->query($task_01);
$task_01 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);


$task_02 = "SELECT oi.id, p.name AS product_name, oi.quantity, oi.quantity * oi.price AS total_amount ";
$task_02 .= "FROM order_items oi JOIN Products p ON oi.product_id = p.id ";
$task_02 .= "ORDER BY oi.id ASC";
$pdo_statement = $pdo->query($task_02);
$task_02 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

$task_03 = "SELECT c.name AS category_name, SUM(oi.quantity * oi.price) AS total_revenue ";
$task_03 .= "FROM categories c ";
$task_03 .= "JOIN products p ON c.id = p.categorie_id ";
$task_03 .= "JOIN order_items oi ON p.id = oi.product_id ";
$task_03 .= "GROUP BY c.name ORDER BY total_revenue DESC";
$pdo_statement = $pdo->query($task_03);
$task_03 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);

$task_04 = "SELECT c.name AS customer_name, SUM(oi.quantity * oi.price) AS total_purchase_amount ";
$task_04 .= "FROM customers c ";
$task_04 .= "JOIN Orders o ON c.id = o.customer_id ";
$task_04 .= "JOIN Order_Items oi ON o.id = oi.order_id ";
$task_04 .= "GROUP BY c.name ORDER BY total_purchase_amount DESC ";
$task_04 .= "LIMIT 5";
$pdo_statement = $pdo->query($task_04);
$task_04 = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
      <style>
          body {
              min-height: 75rem;
              padding-top: 5.5rem;
          }
      </style>
  </head>
  <body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">মডিউল ৬ এর এসাইনমেন্ট</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#task_01">Task 01</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#task_02">Task 02</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#task_03">Task 03</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#task_04">Task 04</a>
                        </li>

                </div>
            </div>
        </nav>
        <div class="row justify-content-md-center">
            <div class="col-10">
                <section id="task_01">
                    <div class="card mt-2" >
                        <div class="card-header">
                            Task 01
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Total Orders</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($task_01 as $row) { ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['name'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['location'] ?></td>
                                        <td><?= $row['total_orders'] ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>


                <div class="card mt-2" id="task_02">
                    <div class="card-header">
                        Task 02
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($task_02 as $row) { ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['product_name'] ?></td>
                                    <td><?= $row['quantity'] ?></td>
                                    <td><?= $row['total_amount'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-2" id="task_03">
                    <div class="card-header">
                        Task 03
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Category Name</th>
                                <th scope="col">Total Revenue</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($task_03 as $row) { ?>
                                <tr>
                                    <td><?= $row['category_name'] ?></td>
                                    <td><?= $row['total_revenue'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card mt-2" id="task_04">
                    <div class="card-header">
                        Task 04
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Total Purchase Amount</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($task_04 as $row) { ?>
                                <tr>
                                    <td><?= $row['customer_name'] ?></td>
                                    <td><?= $row['total_purchase_amount'] ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
