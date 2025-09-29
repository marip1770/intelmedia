<?php
require_once('./config.php');

$slug = $_GET['slug'] ?? '';

$search = $_GET['search'] ?? '';

if ($search) {
    // Escape keyword untuk keamanan
    $search_escaped = $conn->real_escape_string($search);
    $_GET['search'] = $search_escaped; // agar kompatibel dengan list_magazine.php

    include 'list_magazine.php';
    exit;
}
// if (!$slug) {
//     http_response_code(404);
//     echo "Artikel Tidak Ditemukan.";
//     exit;
// }
// Kalau slug kosong → arahkan ke homepage
if (!$slug) {
    include 'index.php'; // file ini bisa kamu ganti jadi file homepage default
    exit;
}
// Escape slug
$slug_escaped = $conn->real_escape_string($slug);

// Coba cari di category_list
$categoryQuery = $conn->query("SELECT id, name FROM category_list WHERE slug = '$slug_escaped' LIMIT 1");

if ($categoryQuery && $categoryQuery->num_rows > 0) {
    $cat1 = $categoryQuery->fetch_assoc();
    $cat_id = $cat1['id'];
    include 'list_magazine.php';
    exit;
}

// Coba cari di magazine_list
$magazineQuery = $conn->query("SELECT id FROM magazine_list WHERE slug = '$slug_escaped' LIMIT 1");

if ($magazineQuery && $magazineQuery->num_rows > 0) {
    $mag1 = $magazineQuery->fetch_assoc();
    $m_id = $mag1['id'];
    include 'view_magazine.php';
    exit;
}

// Jika tidak ditemukan di mana pun
http_response_code(404);
echo "Artikel tidak ditemukan.";
exit;
