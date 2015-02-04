<?php
/**
 * Using this to extend Page and replace all tiny_mce hardcoded URLs with S3 URLS - this is a fallback for eisitng sites, new sites with this module shouldnt ever need this.
 *
 */
class Page_Extension extends DataExtension  {

		public function Content() {
			$body = $this->owner->getField('Content');
			
			 if (!$body) {
                return;
            }

            if (defined('S3_CDN')) {
				$cdn = S3_CDN . "assets"; // or a working cname record
			} else {
				$cdn = "//" . S3_BUCKET . ".s3.amazonaws.com/assets"; // or a working cname record
			}
		
            $myDomain = Director::absoluteBaseURL();
        
            $body = str_replace('src="assets/', 'src="'.$cdn, $body);
            $body = str_replace('href="assets/', 'href="'.$cdn, $body);
            $body = str_replace($myDomain . 'assets/', $cdn, $body); //absolute links
            if(defined('S3_CDN')){
            	$body = str_replace($cdn, $cdn.'/', $body); //S3 links
			}

            return $body;
		}
		
}