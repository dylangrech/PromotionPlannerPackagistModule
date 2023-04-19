<?php

namespace Fatchip\PromotionPlanner\Controller\Admin;

class ArticlePromotionController extends PromotionPlannerController
{
    protected $_sThisTemplate = "fc_article_promotion.tpl";
    protected $oModel = \OxidEsales\Eshop\Application\Model\Article::class;

    /**
     * Loads article promotion related information - Smarty
     * engine, returns name of template file "fc_article_promotion.tpl".
     *
     * @return string
     */
    public function render()
    {
        parent::render();
        $this->fcLoadObjectDetails($this->oModel);
        return $this->_sThisTemplate;
    }

    /**
     * Saves promotion details and uploaded picture to server/database.
     */
    public function save()
    {
        parent::save();
        $this->fcSavePromotionDetails($this->oModel, 'oxarticles__fcpromotionplanneractivepromotion');
    }

}