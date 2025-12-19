<?php
require_once __DIR__ . '/../../config/config.example.php';
class Sale {
    public static function getAll($start_date = '', $end_date = '', $therapist_id = '', $service_id = '') {
        global $pdo;
        $sql = 'SELECT s.sales_id, a.appointment_id, a.customer_name, sv.service_name, t.therapist_name, a.date, s.amount
                FROM sales s
                JOIN appointments a ON s.appointment_id = a.appointment_id
                JOIN appointment_services aps ON a.appointment_id = aps.appointment_id
                JOIN services sv ON aps.service_id = sv.service_id
                JOIN therapists t ON a.therapist_id = t.therapist_id
                WHERE 1';
        $params = [];
        if ($start_date) {
            $sql .= ' AND a.date >= ?';
            $params[] = $start_date;
        }
        if ($end_date) {
            $sql .= ' AND a.date <= ?';
            $params[] = $end_date;
        }
        if ($therapist_id && $therapist_id !== 'none') {
            $sql .= ' AND t.therapist_id = ?';
            $params[] = $therapist_id;
        } elseif ($therapist_id === 'none') {
            $sql .= ' AND t.therapist_id IS NULL';
        }
        if ($service_id && $service_id !== 'none') {
            $sql .= ' AND sv.service_id = ?';
            $params[] = $service_id;
        } elseif ($service_id === 'none') {
            $sql .= ' AND sv.service_id IS NULL';
        }
        $sql .= ' ORDER BY a.date DESC, a.time DESC';
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }
} 