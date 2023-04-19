<?php

namespace Fatchip\PromotionPlanner\Model;

use Fatchip\PromotionPlanner\Model\PromotionPlanner;

class Category extends Category_parent
{
    /**
     * Checks if the promotion is active
     *
     * @return bool
     */
    public function fcCheckIfPromotionIsActive()
    {
        $iActiveFrom = PromotionPlanner::fcGetPromotionPlannerActiveFrom($this->oxcategories__fcpromotionplanneractivefrom);
        $iActiveTill = PromotionPlanner::fcGetPromotionPlannerActiveTill($this->oxcategories__fcpromotionplanneractivetill);
        $isActive = PromotionPlanner::fcGetPromotionPlannerActiveValue($this->oxcategories__fcpromotionplanneractivepromotion);
        $iCurrentTime = strtotime('now');
        if (($iActiveFrom <= $iCurrentTime && $iCurrentTime <= $iActiveTill) && $isActive === true) {
            return true;
        }
        return false;
    }

    /**
     * Returns the image url
     *
     * @return string|void
     */
    public function fcGetImageUrl()
    {
        $sPromotionImage = PromotionPlanner::fcGetPromotionPlannerImageName($this->oxcategories__fcpromotionplannerimage);
        if ($sPromotionImage !== '') {
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/category/promotionImages/'.$sPromotionImage;
        }
    }
}