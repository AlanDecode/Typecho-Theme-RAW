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
            return _mt('刚刚');
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
}