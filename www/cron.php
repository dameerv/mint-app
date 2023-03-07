<?php
require_once __DIR__.'/vendor/autoload.php';
use Fluent\Logger\FluentLogger;
$today = getdate();
print_r($today);
$logger = new FluentLogger("fluentd","24224");
$logger->post("fluentd.test.follow", array("project"=>"tm", "server"=>"someserver","status"=>"OK","message"=>"somemessage"));
?>
