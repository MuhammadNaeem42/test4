<?php
require '../libs/tcpdf/vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// AWS S3 configuration
$s3Client = new S3Client([
    'version'     => 'latest',
    'region'      => 'us-east-1',
    'credentials' => [
        'key'    => 'AKIAZ6RUNNND6TSFDNVN',
        'secret' => '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',
    ],
]);

$sourceBucket = 'mywebsite5601';
$backupBucket = 'mywebsite5601'; // Can be the same as $sourceBucket

try {
    $objects = $s3Client->listObjects([
        'Bucket' => $sourceBucket,
    ]);

    if (isset($objects['Contents'])) {
        foreach ($objects['Contents'] as $object) {
            $filename = $object['Key'];
            $backupKey = 'backup/' . date('Y-m-d') . '/' . $filename;

            // Copy the object to the new location
            $s3Client->copyObject([
                'Bucket'     => $backupBucket,
                'Key'        => $backupKey,
                'CopySource' => "{$sourceBucket}/{$filename}",
            ]);
        }
    }
} catch (AwsException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
