<?php

namespace pp\PromotionPlanner\Model;

use pp\PromotionPlanner\Model\PromotionPlanner;

class Manufacturer extends Manufacturer_parent
{
    /**
     * Checks if the promotion is active
     *
     * @return bool
     */
    public function checkIfPromotionIsActive()
    {
        $iActiveFrom = PromotionPlanner::getPromotionPlannerActiveFrom($this->oxmanufacturers__fcpromotionplanneractivefrom);
        $iActiveTill = PromotionPlanner::getPromotionPlannerActiveTill($this->oxmanufacturers__fcpromotionplanneractivetill);
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
        $sPromotionImage = PromotionPlanner::getPromotionPlannerImageName($this->oxmanufacturers__fcpromotionplannerimage);
        if ($sPromotionImage !== '') {
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/manufacturer/promotionImages/'.$sPromotionImage;
        }
    }
}