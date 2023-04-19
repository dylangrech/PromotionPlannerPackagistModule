<?php

namespace Fatchip\PromotionPlanner\Controller\Admin;

class ManufacturerPromotionController extends PromotionPlannerController
{
    protected $_sThisTemplate = "fc_manufacturer_promotion.tpl";
    protected $oModel = \OxidEsales\Eshop\Application\Model\Manufacturer::class;

    /**
     * Loads manufacturer promotion related information - Smarty
     * engine, returns name of template file "fc_manufacturer_promotion.tpl".
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
        $this->fcSavePromotionDetails($this->oModel, 'oxmanufacturers__fcpromotionplanneractivepromotion');
    }

}