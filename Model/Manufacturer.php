<?php

namespace Fatchip\PromotionPlanner\Model;

use Fatchip\PromotionPlanner\Model\PromotionPlanner;

class Manufacturer extends Manufacturer_parent
{
    /**
     * Checks if the promotion is active
     *
     * @return bool
     */
    public function fcCheckIfPromotionIsActive()
    {
        $iActiveFrom = PromotionPlanner::fcGetPromotionPlannerActiveFrom($this->oxmanufacturers__fcpromotionplanneractivefrom);
        $iActiveTill = PromotionPlanner::fcGetPromotionPlannerActiveTill($this->oxmanufacturers__fcpromotionplanneractivetill);
        $isActive = PromotionPlanner::fcGetPromotionPlannerActiveValue($this->oxmanufacturers__fcpromotionplanneractivepromotion);
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
        $sPromotionImage = PromotionPlanner::fcGetPromotionPlannerImageName($this->oxmanufacturers__fcpromotionplannerimage);
        if ($sPromotionImage !== '') {
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/manufacturer/promotionImages/'.$sPromotionImage;
        }
    }
}