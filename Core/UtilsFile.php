<?php

namespace Fatchip\PromotionPlanner\Core;

class UtilsFile extends UtilsFile_parent
{
    /**
     * Class constructor, initailizes pictures count info (_iMaxPicImgCount/_iMaxZoomImgCount)
     *
     * @return null
     */
    public function __construct()
    {
        parent::__construct();
        $this->_aTypeToPath['PROMO_ARTICLE'] = 'master/product/promotionImages';
        $this->_aTypeToPath['PROMO_MANUFACTURER'] = 'master/manufacturer/promotionImages';
        $this->_aTypeToPath['PROMO_CATEGORY'] = 'master/category/promotionImages';
    }
}