<?php
$ip         = $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
$time       = gmdate('Y-m-d H:i:s') . ' UTC';
$token      = $_GET['token'] ?? 'unknown';

$geo = @json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"), true);
$city    = $geo['city']   ?? 'Unknown';
$region  = $geo['region'] ?? 'Unknown';
$country = $geo['country']?? 'Unknown';
$org     = $geo['org']    ?? 'Unknown';

$data = [
    'time'       => $time,
    'ip'         => $ip,
    'city'       => $city,
    'region'     => $region,
    'country'    => $country,
    'org'        => $org,
    'user_agent' => $user_agent,
    'token'      => $token
];
$post_data = json_encode($data);

$script_url = 'https://script.google.com/macros/s/AKfycbyj5E9SP3lqJ0oC_rThHMfQrzIz3KUrZTznOM_Gr331nPs0UWClgqtTmE7wDLZIJQ3S/exec';

$context = stream_context_create([
    'http' => [
        'method'  => 'POST',
        'header'  => 'Content-Type: application/json',
        'content' => $post_data,
        'timeout' => 10
    ]
]);
@file_get_contents($script_url, false, $context);

header('Content-Type: image/gif');
header('Content-Length: 35');
echo base64_decode('R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=');
?>
