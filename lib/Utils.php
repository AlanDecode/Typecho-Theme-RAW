<?php
/** 
* Utils.php
* 
* 时间格式化、PJAX 等
* 
* @author      熊猫小A | AlanDecode
* @version     0.1
* 
*/ 
?>

<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

class Utils {
    public static function formatDate($time, $format) {
        if (strtoupper($format) == 'NATURAL') {
            return self::naturalDate($time);
        }
        return date($format, $time);
    }
    public static function naturalDate($from) {
        $now = time();
        $between = time() - $from;
        if ($between > 31536000) {
            return date('Y-m-d', $from);
        } else if ($between > 0 && $between < 172800                                // 如果是昨天
            && (date('z', $from) + 1 == date('z', $now)                             // 在同一年的情况
                || date('z', $from) + 1 == date('L') + 365 + date('z', $now))) {    // 跨年的情况
            return sprintf('昨天 %s', date('H:i', $from));
        } else if ($between == 0) {
            return '刚刚';
        }
        $f = array(
            '31536000' => '%d 年前',
            '2592000' => '%d 个月前',
            '604800' => '%d 星期前',
            '86400' => '%d 天前',
            '3600' => '%d 小时前',
            '60' => '%d 分钟前',
            '1' => '%d 秒前',
        );
        foreach ($f as $k => $v) {
            if (0 != $c = floor($between / (int)$k)) {
                if ($c == 1) {
                    return sprintf($v, $c);
                }
                return sprintf($v, $c);
            }
        }
        return "";
    }

    public static function isPJAX() {
        if (array_key_exists('HTTP_X_PJAX', $_SERVER) && $_SERVER['HTTP_X_PJAX']) {
            return true;
        }
        return false;
    }
	
	/**
     * 移动设备识别
     *
     * @return boolean
     */
    public static function isMobile(){
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_browser = Array(
            "mqqbrowser", // 手机QQ浏览器
            "opera mobi", // 手机opera
            "juc","iuc", 'ucbrowser', // uc浏览器
            "fennec","ios","applewebKit/420","applewebkit/525","applewebkit/532","ipad","iphone","ipaq","ipod",
            "iemobile", "windows ce", // windows phone
            "240x320","480x640","acer","android","anywhereyougo.com","asus","audio","blackberry",
            "blazer","coolpad" ,"dopod", "etouch", "hitachi","htc","huawei", "jbrowser", "lenovo",
            "lg","lg-","lge-","lge", "mobi","moto","nokia","phone","samsung","sony",
            "symbian","tablet","tianyu","wap","xda","xde","zte"
        );
        $is_mobile = false;
        foreach ($mobile_browser as $device) {
            if (stristr($user_agent, $device)) {
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }

    public static function isPhone(){
        $ua=strtolower($_SERVER["HTTP_USER_AGENT"]);
        $devices=array("Android", 'iPhone', 'iPod', 'Phone');
        foreach ($devices as $device) {
            if(strpos($ua, strtolower($device))){
                return true;
            }
        }
        return false;
    }

    // 判断插件是否存在并启用
    public static function isPluginAvailable($name) {
        if (class_exists($name.'_Plugin')){
            $plugins = Typecho_Plugin::export();
            $plugins = $plugins['activated'];
            return is_array($plugins) && array_key_exists($name, $plugins);
        }
    }
}