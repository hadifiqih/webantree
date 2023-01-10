<?php

// Ubah dengan API key dan Sender ID yang Anda catat tadi
$apiKey = "AIzaSyD-hClzHRiMyWjWdn-xoHXQYk4BGJYqiCM";
$senderId = "689952355755";

// Buat objek Firebase
$firebase = (new \Kreait\Firebase\Factory())
    ->withApiKey($apiKey)
    ->create();

// Buat objek Cloud Messaging
$messaging = $firebase->getMessaging();

// Buat pesan push
$message = \Kreait\Firebase\Messaging\MessageToTopic::create('my_topic', [
    'notification' => [
        'title' => 'Pesan push baru!',
        'body' => 'Ini adalah pesan push yang dikirim dari PHP.'
    ]
]);

//Buat pesan push


// Kirim pesan push
$messaging->send($message);

echo "Pesan push telah terkirim!";