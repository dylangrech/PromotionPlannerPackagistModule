<?php

namespace Fatchip\PromotionPlanner\Model;

class PromotionPlanner
{
    /**
     * Get the value of the Active From column according to the table selected.
     * Returns false if the column is empty.
     * Returns a strtotime value if the column is not empty.
     *
     * @param $dbActiveFromColumn
     * @return false|int
     */
    public static function fcGetPromotionPlannerActiveFrom($dbActiveFromColumn)
    {
        $iActiveFrom = $dbActiveFromColumn->value;
        if ($iActiveFrom !== '') {
            return strtotime($iActiveFrom);
        }
        return false;
    }

    /**
     * Get the value of the Active Till column according to the table selected.
     * Returns false if the column is empty.
     * Returns a strtotime value if the column is not empty.
     * @param $dbActiveTillColumn
     * @return false|int
     */
    public static function fcGetPromotionPlannerActiveTill($dbActiveTillColumn)
    {
        $iActiveTill = $dbActiveTillColumn->value;
        if ($iActiveTill !== '') {
            return strtotime($iActiveTill);
        }
        return false;
    }

    /**
     * Get the value of the Image Name column according to the table selected.
     * Returns false if the column is empty.
     * Returns a string value if the column is not empty.
     * @param $dbImageNameColumn
     * @return false|string
     */
    public static function fcGetPromotionPlannerImageName($dbImageNameColumn)
    {
        $sPromotionImage = $dbImageNameColumn->value;
        if ($sPromotionImage !== '') {
            return $sPromotionImage;
        }
        return false;
    }

    /**
     * Get the value of the Active Value column according to the table selected.
     * Returns false if the column is 0.
     * Returns true if the column is 1.
     *
     * @param $dbActiveValueColumn
     * @return bool
     */
    public static function fcGetPromotionPlannerActiveValue($dbActiveValueColumn)
    {
        $sIsActive = $dbActiveValueColumn->value;
        if ($sIsActive === '1') {
            return true;
        }
        return false;
    }
}