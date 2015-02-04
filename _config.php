<?php


define('S3_ACCESS_KEY', 'xxxxxxxxxxxxxxxxxxxxxx');
define('S3_SECRET_KEY', 'xxxxxxxxxxxxxxxxxxxxxx');
define('S3_BUCKET', 'xxxxxxxxxxxxxx');
define('S3_CDN', '//xxxxxxxxxxx.cloudfront.net/');
define('S3_DIR', 's3');

S3::setAuth(S3_ACCESS_KEY, S3_SECRET_KEY);

//Object::add_extension("Page_Controller", "Page_Extension");
