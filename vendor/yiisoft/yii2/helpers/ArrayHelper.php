<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\helpers;

/**
 * ArrayHelper provides additional array functionality that you can use in your
 * application.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ArrayHelper extends BaseArrayHelper
{
    public static function toTreeStructure($arrays, $parentIndex = 'parent_id', $childIndex = 'children')
    {
        $result = [];
        foreach ($arrays as &$array) {
            if (!isset($array[$childIndex])) {
                $array[$childIndex] = [];
            }
            if (isset($arrays[$array[$parentIndex]])) {
                $arrays[$array[$parentIndex]][$childIndex][] = &$array;
            } else {
                $result[] = &$array;
            }
        }

        return $result;
    }

    public static function toDepthIndexStructure($arrays, $index = 'children', $depth = 0)
    {
        $result = [];
        foreach ($arrays as $array) {
            $temp = ['depth' => $depth];
            foreach ($array as $key => $value) {
                if ($key !== $index) {
                    $temp[$key] = $value;
                }
            }
            $result[] = $temp;

            if (isset($array[$index])) {
                $result = array_merge($result, self::toDepthIndexStructure($array[$index], $index, $depth + 1));
            }
        }
        return $result;
    }

    public static function toCsvString($header, $data, $callBack = [])
    {
        /*输入到CSV文件 解决乱码问题*/
        $html = "\xEF\xBB\xBF";

        /*输出表头*/
        foreach ($header as $value) {
            $html .= $value . "\t ,";
        }
        $html .= "\n";

        foreach ($data as $value) {
            foreach ($header as $index => $item) {
                if (isset($value[$index])) {
                    if (array_key_exists($index, $callBack)) {
                        $value[$index] = array_map($callBack[$index], [
                            $index => $value[$index]
                        ])[$index];
                    }
                    $html .= str_replace(["\r", "\t", "\n", "\r\n"], '', $value[$index]) . "\t ,";
                }
            }
            $html .= "\n";
        }

        return $html;
    }

    public static function remove(&$array, $key, $default = null)
    {
        if (is_array($array) && (isset($array[$key]) || array_key_exists($key, $array))) {
            $value = $array[$key];
            unset($array[$key]);

            return $value;
        }

        return $default;
    }

    public static function sortByIndex(&$array, $index = 'sort')
    {
        self::$sortIndex = $index;
        usort($array, ['self', 'compare']);
    }

    private static function compare($first, $second)
    {
        if (isset($first[self::$sortIndex]) && isset($second[self::$sortIndex]) ) {
            return strcmp($first[self::$sortIndex], $second[self::$sortIndex]);
        }
    }
}
