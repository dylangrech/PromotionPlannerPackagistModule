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
    public function checkIfPromotionIsActive()
    {
        $iActiveFrom = PromotionPlanner::getPromotionPlannerActiveFrom($this->oxarticles__fcpromotionplanneractivefrom);
        $iActiveTill = PromotionPlanner::getPromotionPlannerActiveTill($this->oxarticles__fcpromotionplanneractivetill);
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
        $sPromotionImage = PromotionPlanner::getPromotionPlannerImageName($this->oxarticles__fcpromotionplannerimage);
        if ($sPromotionImage !== '') {
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/product/promotionImages/'.$sPromotionImage;
        }
    }

}