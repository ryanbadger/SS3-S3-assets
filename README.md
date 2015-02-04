## Silverstripe S3 module

## Overview

Simple module to override File.php and Image.php, enabling Silversrtripe to use S3 buckets for it's entire assets folder (So you can load balance your server at last!)

## Server Requirements & Compatability

This is my first attempt so most likely have overlooked a LOT. But seems to offer all file functions just fine in SS2.4.7
Am currently working on a fix for TinyMCE CMS sidebar image uploader at the moment. - UPDATE: This now works, but resampling into content doesn't work yet, so original full sized images will be resized and not resampled via tiny_mce

## Installation

If you already have a site running, all you need to do is add this module to your site root (Along with mysite and sapphire folder etc) 
Then add your AWS S3 access key and secret key to the _config.php found in this module. 

I would advise uploading all of your assets to S3 first, as it will most likely time out of you try and do it via this module, but it's currently set to check every item in your File table, and if there is no S3URL set, it will grab the original from your local, assets upload it to S3 and then save the S3URL in your database.

For future usage (resmapling etc) the module will use the original found on S3 so the local version is no longer needed. It also deletes any resampled files that get saved locally once they too have been uploaded to S3 (This should ideally write resampled files straight to S3 to be more efficient) You could also set it to delete the original upload (once uploaded to S3) from local assets if you want to save space, but I don't see much benefit in this, plus you risk losing assets forever in case the S3 fails for any reason. Again, in an ideal world this module would just uplod direct to S3 anyway... It would be pretty nice if somebody did that...


Have added tiny_mce CMS image uplaoder hack now, it's not very nice. Plus tiny_mce hardcodes relative URLs into the DB, so all of your old pages will be stuck with /assets. I've added a URL rewrite onload to change any "assets/" to your S3 bucket on the fly. Not sure how else this can be done.

Remember, when you first create an S3 bucket, it can take a while (1 hour sometimes) for the full URL to propegate, so the http://" . S3_BUCKET . ".s3.amazonaws.com wont work until the URL resolves, and this will throw up errors. Best to create your S3 bucket long before you try to use it.

## File to delete/hide - SORRY!

sapphire/filesystem/folder.php
sapphire/filesystem/file.php
sapphire/core/model/image.php
sapphire/forms/HtmlEditorField.php
sapphire/javascript/tiny_mce_improvements.js
cms/code/ThumbnailStripField.php
S3 from uploadify if present <- may find conflicts here if you are already using S3 with uploadify

