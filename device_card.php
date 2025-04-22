<?php
include 'db.php';

$id = $_GET['id'] ?? 0;
$result = $conn->query("SELECT * FROM devices WHERE id = $id");
$device = $result->fetch_assoc();

if (!$device) {
    echo "الجهاز غير موجود.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>بطاقة الجهاز - <?= htmlspecialchars($device['name']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>📄 بطاقة الجهاز</header>
<div class="container card">
    <h2><?= htmlspecialchars($device['name']) ?></h2>
    <p><strong>الماركة:</strong> <?= htmlspecialchars($device['type']) ?></p>
    <p><strong>الموديل:</strong> <?= htmlspecialchars($device['model']) ?></p>
    <p><strong>الرقم التسلسلي:</strong> <?= htmlspecialchars($device['serial_number']) ?></p>
    <p><strong>الوضع الفني:</strong> <?= htmlspecialchars($device['status']) ?></p>
    <p><strong>تاريخ آخر صيانة:</strong> <?= htmlspecialchars($device['last_maintenance']) ?></p>
    <p><strong>المشرف:</strong> <?= htmlspecialchars($device['supervisor']) ?></p>
    <p><strong>مكان تواجد الجهاز:</strong> <?= htmlspecialchars($device['location']) ?></p>
    <p><strong>الطابق:</strong> <?= htmlspecialchars($device['floor']) ?></p>
    <p><strong>شرح آخر صيانة:</strong> <?= nl2br(htmlspecialchars($device['maintenance_description'])) ?></p>
    <p><strong>ملاحظات:</strong> <?= nl2br(htmlspecialchars($device['notes'])) ?></p>
    <a class="button" href="device_form.php?id=<?= $device['id'] ?>">📝  البيانات الإضافية للجهاز</a>
    <a class="button" href="export_pdf.php?id=<?= $device['id'] ?>">🖨️ PDF</a>

    <a class="button" href="index.php">🔙 العودة للقائمة</a>
</div>
</body>
</html>
