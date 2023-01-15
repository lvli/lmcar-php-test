<?php

namespace App\Service;

use Exception;

class ProductHandler
{
    /**
     * 计算商品总金额
     * @param array $products 商品数组
     * @return float 商品总金额
     * @author lvli
     */
    public static function getTotalPrice(array $products) :float
    {
        $sum = 0;
        foreach($products as $product) {
            $price = $product['price'] ?? 0;
            $sum += $price;
        }
        return $sum;
    }

    /**
     * 筛选商品
     * @param array $products 商品数组
     * @param string $type 商品类型
     * @param string $sortField 排序字段
     * @param int $sortType 排序类型 3=降序 4=升序
     * @return array
     * @throws Exception
     * @author lvli
     */
    public static function search(array $products, string $type = '', string $sortField = 'price', int $sortType = SORT_DESC) :array
    {
        if(empty($products)) {
            return [];
        }

        if(!empty($type)) {
            $result = array_filter($products, function ($v) use ($type) {
                if($v['type'] == $type) {
                    return true;
                }
                return false;
            });
        }else {
            $result = $products;
        }

        if(!empty($sortField) && !empty($sortType)) {
            if(!in_array($sortType, [SORT_ASC, SORT_DESC])) {
                throw new Exception('排序类型错误');
            }

            foreach($result as $k => $v) {
                $sortArray[$k] = $v[$sortField];
            }
            array_multisort($sortArray, $sortType, $result);
        }

        return $result;
    }

    /**
     * 日期转换为时间戳
     * @param string $date 日期
     * @return int 时间戳
     * @throws Exception
     * @author lvli
     */
    public static function dateToTimestamp(string $date) :int
    {
        $timestamp = strtotime($date);
        if(false === $timestamp) {
            throw new Exception('日期格式错误');
        }

        return $timestamp;
    }
}