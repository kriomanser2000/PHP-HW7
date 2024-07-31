<?php
$categories = [];
$products = [];
if (isset($_POST['addCategory'])) 
{
    $categoryName = $_POST['categoryName'];
    $newCategory = new Category($categoryName, $products);
    $categories[] = $newCategory;
    $products = [];
}
if (isset($_POST['addProduct'])) 
{
    $productName = $_POST['productName'];
    $products[] = $productName;
}
if (isset($_GET['showCategory'])) 
{
    $selectedCategoryName = $_GET['showCategory'];
    $selectedCategory = Category::findCategory($categories, $selectedCategoryName);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>Категорії продуктів</h1>
<form method="post">
    <label for="categoryName">Назва категорії:</label>
    <input type="text" id="categoryName" name="categoryName" required>
    <button type="submit" name="addCategory">Додати категорію</button>
</form>
<form method="post">
    <label for="productName">Назва продукту:</label>
    <input type="text" id="productName" name="productName" required>
    <button type="submit" name="addProduct">Додати продукт</button>
</form>
<h2>Список категорій</h2>
<ul>
    <?php foreach ($categories as $category): ?>
        <li><a href="?showCategory=<?php echo $category->getCategoryName(); ?>"><?php echo $category->getCategoryName(); ?></a></li>
    <?php endforeach; ?>
</ul>
<?php if (isset($selectedCategory)): ?>
    <h2>Продукти в категорії <?php echo $selectedCategory->getCategoryName(); ?></h2>
    <ul>
        <?php foreach ($selectedCategory->getCategoryProducts() as $product): ?>
            <li><?php echo $product; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</body>
</html>
