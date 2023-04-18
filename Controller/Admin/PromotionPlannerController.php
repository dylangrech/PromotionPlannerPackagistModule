<?php

namespace Fatchip\PromotionPlanner\Controller\Admin;

use OxidEsales\Eshop\Application\Controller\Admin\AdminDetailsController;

class PromotionPlannerController extends AdminDetailsController
{
    /**
     * Loads the details of the object that has been selected from the list
     *
     * @param $className
     * @return void
     */
    public function loadObjectDetails($className)
    {
        $oModel = oxNew($className);
        $soxId = $this->getEditObjectId();
        if (isset($soxId) && $soxId != "-1") {
            $oModel->load($soxId);
        }
        $this->_aViewData["edit"] = $oModel;
    }

    /**
     * Saves the details of the object that has been selected from the list
     *
     * @param $className
     * @return void
     */
    public function savePromotionDetails($className)
    {
        $soxId = $this->getEditObjectId();
        $aParams = \OxidEsales\Eshop\Core\Registry::getConfig()->getRequestParameter("editval");

        $oModel = oxNew($className);
        $oModel->load($soxId);
        $oModel->assign($aParams);
        $oModel = \OxidEsales\Eshop\Core\Registry::getUtilsFile()->processFiles($oModel);
        $oModel->save();
    }
}