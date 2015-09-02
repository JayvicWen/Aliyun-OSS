<?php

require_once dirname(__FILE__) . '/../src/OSS.php';

use Ripples\Aliyun\OSS;

$oss = new OSS('your-access-key-id', 'your-access-key-secret', 'your-oss-endpoint');

$bucket = 'your-bucket';
$key1 = 'test-key1';
$key2 = 'test-key2';
$key3 = 'test-key3';
$tmp = 'example.tmp';

echo $oss->signGetUrl($bucket, $key1);
echo "\n";

echo $oss->signPutUrl($bucket, $key2);
echo "\n";

echo $oss->signUrl($bucket, $key3, 60, 'GET');
echo "\n";

$oss->putObject($bucket, $key1, '<h1>Just for Test</h1>');
$oss->getObjectToFile($bucket, $key1, $tmp);

echo $oss->getObject($bucket, $key1);
echo "\n";

$oss->putObjectFromFile($bucket, $key2, $tmp, ['Content-Type'=>'text/plain']);
$oss->copyObject($bucket, $key1, $bucket, $key3);
$oss->modifyMeta($bucket, $key3, ['Content-Type' => 'text/html']);
unlink($tmp);

echo $oss->getMeta($bucket, $key3)['content-type'];
echo "\n";

$oss->deleteObject($bucket, $key1);
$oss->deleteObjects($bucket, [$key2]);

var_dump($oss->isObjectExists($bucket, $key1));
var_dump($oss->isObjectExists($bucket, $key2));
var_dump($oss->isObjectExists($bucket, $key3));