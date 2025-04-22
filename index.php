<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>الأجهزة الطبية</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>نظام إدارة الأجهزة الطبية</header>
<div class="container">
    <form method="GET">
        <input type="text" name="search" placeholder="بحث بالاسم أو النوع أو المشرف" value="<?= $_GET['search'] ?? '' ?>">
        <button type="submit" name="action" value="search">🔍 بحث</button>
    </form>

    <form method="GET">
        <label for="order">ترتيب حسب:</label>
        <select name="order" id="order">
            <option value="name" <?= ($_GET['order'] ?? '') == 'name' ? 'selected' : '' ?>>الاسم</option>
            <option value="type" <?= ($_GET['order'] ?? '') == 'type' ? 'selected' : '' ?>>النوع</option>
            <option value="status" <?= ($_GET['order'] ?? '') == 'status' ? 'selected' : '' ?>>الوضع الفني</option>
            <option value="last_maintenance" <?= ($_GET['order'] ?? '') == 'last_maintenance' ? 'selected' : '' ?>>تاريخ آخر صيانة</option>
            <option value="supervisor" <?= ($_GET['order'] ?? '') == 'supervisor' ? 'selected' : '' ?>>المشرف</option>
        </select>
        <button type="submit" name="action" value="sort">↕️ فرز</button>
    </form>

    <a href="index.php">🔙 العودة إلى القائمة الكاملة</a>
    <a href="edit.php">➕ إضافة جهاز جديد</a>

    <table>
        <tr>
            <th>الاسم</th>
            <th>الماركة</th>
            <th>الموديل</th>
            <th>الرقم التسلسلي</th>
            <th>الوضع الفني</th>
            <th>آخر صيانة</th>
            <th>المشرف</th>
            <th>الخيارات</th>
        </tr>
        <?php
        $search = $_GET['search'] ?? '';
        $order = $_GET['order'] ?? 'name';
        $action = $_GET['action'] ?? '';

        $sql = "SELECT * FROM devices";

        if ($action == 'search' && !empty($search)) {
            $sql .= " WHERE name LIKE '%$search%' OR type LIKE '%$search%' OR supervisor LIKE '%$search%'";
        }

        $allowed_columns = ['name', 'type', 'status', 'last_maintenance', 'supervisor'];
        if (in_array($order, $allowed_columns)) {
            $sql .= " ORDER BY $order";
        }

        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['name'] ?></td>
            <td><?= $row['type'] ?></td>
            <td><?= $row['model'] ?></td>
            <td><?= $row['serial_number'] ?></td>
            <td><?= $row['status'] ?></td>
            <td><?= $row['last_maintenance'] ?></td>
            <td><?= $row['supervisor'] ?></td>
            <td>
                <a href="edit.php?id=<?= $row['id'] ?>">✏️ تعديل</a>
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('هل أنت متأكد من الحذف؟')">🗑️ حذف</a>
                <a href="device_card.php?id=<?= $row['id'] ?>">📄 بطاقة الجهاز</a>
            </td>

        </tr>
        <?php endwhile; ?>
    </table>
</div>
<footer>
    &copy; <?= date('Y') ?> مستشفى اللاذقية الجامعي - جميع الحقوق محفوظة - المهندس أحمد ابراهيم
</footer>
</body>
</html>
