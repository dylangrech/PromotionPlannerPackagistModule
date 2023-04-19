<?php

namespace Fatchip\PromotionPlanner\Model;

use Fatchip\PromotionPlanner\Model\PromotionPlanner;

class Article extends Article_parent
{
    /**
     * Checks if the promotion is active
     *
     * @return bool
     */
    public function fcCheckIfPromotionIsActive()
    {
        $iActiveFrom = PromotionPlanner::fcGetPromotionPlannerActiveFrom($this->oxarticles__fcpromotionplanneractivefrom);
        $iActiveTill = PromotionPlanner::fcGetPromotionPlannerActiveTill($this->oxarticles__fcpromotionplanneractivetill);
        $isActive = PromotionPlanner::fcGetPromotionPlannerActiveValue($this->oxarticles__fcpromotionplanneractivepromotion);
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
        $sPromotionImage = PromotionPlanner::fcGetPromotionPlannerImageName($this->oxarticles__fcpromotionplannerimage);
        if ($sPromotionImage !== '') {
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/product/promotionImages/'.$sPromotionImage;
        }
    }

}