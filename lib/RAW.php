<?php
/** 
* RAW.php
* 
* 主题工具，输出静态文件地址等
* 
* @author      熊猫小A | AlanDecode
* @version     0.1
* 
*/ 
?>

<?php

class RAW{

    /* 常量 */
    const CDN_TYPE_QINIU = 1;
    const CDN_TYPE_UPYUN = 2;

    public static $VERSION = 0.1;

    public static function getRandomBanner($bannerlist){
        $banners=explode(PHP_EOL,$bannerlist);
        return str_replace("\r",'', $banners[array_rand($banners,1)]);
    }

    public static function getCDNType($url){
        // not using
        return -1;
    }

    public static function getCDNAddOn($CDNType){
        if($CDNType==-1) return '';
        else if($CDNType==self::CDN_TYPE_UPYUN) return '';
        else if($CDNType==self::CDN_TYPE_QINIU) return '';
    }

    public static function staticPath($mirrorcdn, $path,$indentifier,$type){
        if($indentifier && $indentifier!=''){
            if($mirrorcdn && $mirrorcdn!=''){
                return $mirrorcdn.'/usr/themes/RAW/assets'.$path.'.'.$indentifier.'.'.$type;
            }
            else{
                return '/usr/themes/RAW/assets'.$path.'.'.$indentifier.'.'.$type;
            }
        }
        else{
            if($mirrorcdn && $mirrorcdn!=''){
                return $mirrorcdn.'/usr/themes/RAW/assets'.$path;
            }
            else{
                return '/usr/themes/RAW/assets'.$path;
            }
        }
    }
}