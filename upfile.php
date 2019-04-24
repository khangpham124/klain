<?php
include($_SERVER["DOCUMENT_ROOT"].'/Net/SFTP.php');
$sftpServer    = '112.78.3.242';
$sftpUsername  = 'root';
$sftpPassword  = 'x86FmF49!Ab1';
$sftpPort      = '22';

$uploaded_file = $_FILES["file"]["tmp_name"];

$sftp = new Net_SFTP($sftpServer);
if (!$sftp->login($sftpUsername, $sftpPassword))
{
    die("Connection failed");
}
$sftp->put(
    "/var/www/html/".$_FILES["file"]["name"], file_get_contents($uploaded_file)
);
?>
