<?php
include 'db.php';
$id = $_GET['id'] ?? null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $type = $_POST['type'];
    $model = $_POST['model'];
    $serial_number = $_POST['serial_number'];
    $status = $_POST['status'];
    $last_maintenance = $_POST['last_maintenance'];
    $supervisor = $_POST['supervisor'];

    if ($id) {
        $sql = "UPDATE devices SET name='$name', type='$type', model='$model', serial_number='$serial_number', status='$status', last_maintenance='$last_maintenance', supervisor='$supervisor' WHERE id='$id'";
    } else {
        $sql = "INSERT INTO devices (name, type, model, serial_number, status, last_maintenance, supervisor) VALUES ('$name', '$type', '$model', '$serial_number', '$status', '$last_maintenance', '$supervisor')";
    }

    if ($conn->query($sql)) {
        header('Location: index.php');
    } else {
        echo "خطأ في إضافة البيانات: " . $conn->error;
    }
}

if ($id) {
    $result = $conn->query("SELECT * FROM devices WHERE id = '$id'");
    $device = $result->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>إضافة/تعديل جهاز</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>نظام إدارة الأجهزة الطبية</header>
<div class="container">
    <form method="POST">
        <label for="name">الاسم:</label>
        <input type="text" name="name" id="name" value="<?= $device['name'] ?? '' ?>" required>

        <label for="type">الماركة:</label>
        <input type="text" name="type" id="type" value="<?= $device['type'] ?? '' ?>" required>

        <label for="model">الموديل:</label>
        <input type="text" name="model" id="model" value="<?= $device['model'] ?? '' ?>" required>

        <label for="serial_number">الرقم التسلسلي:</label>
        <input type="text" name="serial_number" id="serial_number" value="<?= $device['serial_number'] ?? '' ?>" required>

        <label for="status">الوضع الفني:</label>
        <input type="text" name="status" id="status" value="<?= $device['status'] ?? '' ?>" required>

        <label for="last_maintenance">آخر صيانة:</label>
        <input type="date" name="last_maintenance" id="last_maintenance" value="<?= $device['last_maintenance'] ?? '' ?>" required>

        <label for="supervisor">المشرف:</label>
        <input type="text" name="supervisor" id="supervisor" value="<?= $device['supervisor'] ?? '' ?>" required>

        <button type="submit">حفظ</button>
    </form>

    <a href="index.php">🔙 العودة إلى القائمة الكاملة</a>
</div>
<footer>
&copy; <?= date('Y') ?> مستشفى اللاذقية الجامعي - جميع الحقوق محفوظة - المهندس أحمد ابراهيم
</footer>
</body>
</html>
