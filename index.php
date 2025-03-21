<?php
include 'koneksi.php';
//Ambil produk berdasarkan kategori (jika ada filter)
$category_filter = isset($_GET['kategori']) ? $conn->real_escape_string($_GET['kategori']) : '';

if (!empty($category_filter)) {
    $sql = "SELECT * FROM  products WHERE kategori = '$category_filter'";
    $result = $conn->query($sql);
} else {
    // Query untuk mengambil produk
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
}



// Ambil daftar kategori unik dari tabel produk
$categories_sql = "SELECT DISTINCT kategori FROM products";
$categories_result = $conn->query($categories_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-commerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <form method="GET" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="kategori" class="form-select">
                        <option value="">All Categories</option>
                        <?php if ($categories_result->num_rows > 0): ?>
                            <?php while ($category = $categories_result->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($category['kategori']) ?>"
                                    <?= $category_filter == $category['kategori'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['kategori'])  ?>
                                </option>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
        <h1 class="text-center mb-4">E-commerce store</h1>
        <div class="row">
         <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
             <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="<?= htmlspecialchars($row['gambar']) ?>" class="card-img-topcm" alt="<?= htmlspecialchars($row['name']) ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($row['name']) ?>></h5>
                        <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
                        <p class="card-text"><strong>Price: Rp<?= htmlspecialchars(number_format($row['price'],0,",",".")) ?></strong></p>
                        <a href="#" class="btn btn-primary">Buy Now</a>
                    </div>
                </div>
             </div>
            <?php endwhile; ?>
          <?php else: ?>
              <p class="text-center">No products available.</p>
          <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>