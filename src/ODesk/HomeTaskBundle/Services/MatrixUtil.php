<?php

namespace ODesk\HomeTaskBundle\Services;

class MatrixUtil {

    public static function genSpiralMatrix($word, $cels) {
        $word = (string)$word;
        if (!strlen($word)) {
            throw new \InvalidArgumentException('Word can\'t be empty');
        }

        $cels = abs(intval($cels));
        if (!$cels) {
            throw new \InvalidArgumentException('Side of matrix can\'t be less then 1');
        }

        $str = str_repeat($word, ceil($cels * $cels / strlen($word)) + 1);
        $matrix = array_fill_keys(range(0, $cels - 1), array_fill(0, $cels, null));
        $top = $left = 0;
        $down = $right= $cels - 1;
        $pos = 0;

        while(true) {
            for($j = $left; $j <= $right; ++$j) {
                $matrix[$top][$j] = $str[$pos++];
            }
            $top++;
            if($top > $down || $left > $right) {
                break;
            }

            for($i = $top; $i <= $down; ++$i) {
                $matrix[$i][$right] = $str[$pos++];
            }
            $right--;
            if($top > $down || $left > $right) {
                break;
            }

            for($j = $right; $j >= $left; --$j) {
                $matrix[$down][$j] = $str[$pos++];
            }
            $down--;
            if($top > $down || $left > $right) {
                break;
            }

            for($i = $down; $i >= $top; --$i) {
                $matrix[$i][$left] = $str[$pos++];
            }
            $left++;
            if($top > $down || $left > $right) {
                break;
            }
        }
        return $matrix;
    }
}