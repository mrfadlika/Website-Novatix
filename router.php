<?php

$uri = trim($_SERVER['REQUEST_URI'], '/');

if (preg_match('/\.(css|js|png|jpg|gif|ico|svg|min.js|min.css|pdf|docx|xlsx)$/i', $_SERVER['REQUEST_URI'])) {
    return false;
}

$uri = strtok($uri, '?');

if ($uri == '') {
    require 'index.php';
}
elseif (file_exists($uri . '.php')) {
    require $uri . '.php';
}
elseif($uri == 'calendar/add_event'){
    require 'add_event.php';
}
elseif($uri == 'pengumuman/add'){
    require 'add_announcement.php';
}
elseif($uri == 'pengumuman/view'){
    require 'view_announcement.php';
}
elseif($uri == 'mail'){
    require 'show_mail.php';
}
elseif($uri == 'mail/add'){
    require 'kirimPesan.php';
}
elseif($uri == 'mail/view'){
    require 'view_mail.php';
}
elseif ($uri == 'mail/reply') {
    require 'reply.php';
}
elseif($uri == 'mail/sended'){
    require 'sended_mail.php';
}
elseif($uri == 'mail/sended/view'){
    require 'view_sended_mail.php';
}
elseif($uri == 'profile/edit'){
    require 'edit_data.php';
}
elseif($uri == 'dosen/add/tugas'){
    require 'forms-dosen.php';
}
elseif($uri == 'dosen/add/materi'){
    require 'materi-dosen.php';
}
elseif($uri == 'materi/view'){
    require 'view_materi.php';
}
elseif($uri == 'assignment/edit'){
    require 'edit-tugas.php';
}
else {
    require '404.php';
}
?>
