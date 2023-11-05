-- Task 01
SELECT
c.id, c.name, c.email, c.location, COUNT(o.id) AS total_orders
FROM customers c LEFT JOIN orders o ON c.id = o.customer_id
GROUP BY c.id, c.name, c.email, c.location
ORDER BY total_orders DESC;

-- Task 02
SELECT
oi.id, p.name AS product_name, oi.quantity, oi.quantity * oi.price AS total_amount
FROM order_items oi JOIN Products p ON oi.product_id = p.id
ORDER BY oi.id ASC;

-- Task 03
SELECT
c.name AS category_name, SUM(oi.quantity * oi.price) AS total_revenue
FROM categories c
JOIN products p ON c.id = p.categorie_id
JOIN order_items oi ON p.id = oi.product_id
GROUP BY c.name ORDER BY total_revenue DESC;

-- Task 04
SELECT
c.name AS customer_name, SUM(oi.quantity * oi.price) AS total_purchase_amount
FROM customers c
JOIN Orders o ON c.id = o.customer_id
JOIN Order_Items oi ON o.id = oi.order_id
GROUP BY c.name ORDER BY total_purchase_amount DESC
LIMIT 5;
