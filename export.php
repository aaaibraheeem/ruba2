<?php
include 'db.php';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=devices_export.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['الاسم', 'الماركة', 'الموديل', 'الرقم التسلسلي', 'الوضع الفني', 'آخر صيانة', 'المشرف']);

$result = $conn->query("SELECT name, type, model, serial_number, status, last_maintenance, supervisor FROM devices");

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
exit();
