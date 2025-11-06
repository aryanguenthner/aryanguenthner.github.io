<?php
// Capture request details
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$time = date('Y-m-d H:i:s T');
$token = isset($_GET['token']) ? $_GET['token'] : 'unknown';

// Fetch geolocation (free API, no key needed)
$geo_url = "http://ipinfo.io/{$ip}/json";
$geo_response = @file_get_contents($geo_url);
$geo_data = json_decode($geo_response, true) ?: [];
$city = $geo_data['city'] ?? 'Unknown';
$region = $geo_data['region'] ?? 'Unknown';
$country = $geo_data['country'] ?? 'Unknown';

// Prepare data payload
$data = [
    'time' => $time,
    'ip' => $ip,
    'city' => $city,
    'region' => $region,
    'country' => $country,
    'user_agent' => $user_agent,
    'token' => $token
];
$post_data = json_encode($data);
