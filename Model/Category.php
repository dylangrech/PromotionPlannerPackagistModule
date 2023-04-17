<?php

namespace pp\PromotionPlanner\Model;

use pp\PromotionPlanner\Model\PromotionPlanner;

class Category extends Category_parent
{
    /**
     * Checks if the promotion is active
     *
     * @return bool
     */
    public function checkIfPromotionIsActive()
    {
        $iActiveFrom = PromotionPlanner::getPromotionPlannerActiveFrom($this->oxcategories__fcpromotionplanneractivefrom);
        $iActiveTill = PromotionPlanner::getPromotionPlannerActiveTill($this->oxcategories__fcpromotionplanneractivetill);
        $iCurrentTime = strtotime('now');
        if ($iActiveFrom <= $iCurrentTime && $iCurrentTime <= $iActiveTill) {
            return true;
        }
        return false;
    }

    /**
     * Returns the image url
     *
     * @return string|void
     */
    public function getImageUrl()
    {
        $sPromotionImage = PromotionPlanner::getPromotionPlannerImageName($this->oxcategories__fcpromotionplannerimage);
        if ($sPromotionImage !== '') {
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/category/promotionImages/'.$sPromotionImage;
        }
    }
}