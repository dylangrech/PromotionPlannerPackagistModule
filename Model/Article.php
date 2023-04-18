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
    public function fcGetImageUrl()
    {
        $sPromotionImage = PromotionPlanner::fcGetPromotionPlannerImageName($this->oxarticles__fcpromotionplannerimage);
        if ($sPromotionImage !== '') {
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/product/promotionImages/'.$sPromotionImage;
        }
    }

}