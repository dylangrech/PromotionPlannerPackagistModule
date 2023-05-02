<?php

namespace Fatchip\PromotionPlanner\Model;

use Fatchip\PromotionPlanner\Model\PromotionPlanner;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;

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
     * Checks if the Manufacturer Promotion is active
     *
     * @return bool
     */
    public function fcCheckIfManufacturerPromotionIsActive()
    {
        $iManufacturerActiveFrom = strtotime($this->fcGetColumnValueFromManufacturerTableById('FCPROMOTIONPLANNERACTIVEFROM'));
        $iManufacturerActiveTill = strtotime($this->fcGetColumnValueFromManufacturerTableById('FCPROMOTIONPLANNERACTIVETILL'));
        $iManufacturerPromotionIsActive = $this->fcGetColumnValueFromManufacturerTableById('FCPROMOTIONPLANNERACTIVEPROMOTION');
        $iCurrentTime = strtotime('now');
        if (($iManufacturerActiveFrom <= $iCurrentTime && $iCurrentTime <= $iManufacturerActiveTill) && $iManufacturerPromotionIsActive === '1') {
            return true;
        }
        return false;
    }

    /**
     * Returns the url
     *
     * @return mixed
     */
    public function fcGetArticlePromotionUrl()
    {
        return $this->oxarticles__fcpromotionplannerpromotionurl;
    }

    /**
     * Returns the url from the manufacturer table
     *
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function fcGetManufacturerPromotionUrl()
    {
        return $this->fcGetColumnValueFromManufacturerTableById('FCPROMOTIONPLANNERPROMOTIONURL');
    }

    /**
     * Returns the image url from the manufacturer table
     *
     * @return string|void
     */
    public function fcGetManufacturerImageUrl()
    {
        if ($this->fcCheckIfManufacturerPromotionIsActive()) {
            $sPromotionImage = $this->fcGetColumnValueFromManufacturerTableById('FCPROMOTIONPLANNERIMAGE');
            $sBaseURL = (new \OxidEsales\Eshop\Core\ViewConfig)->getBaseDir();
            return $sBaseURL.'/out/pictures/master/manufacturer/promotionImages/'.$sPromotionImage;
        }
    }

    /**
     * Returns the value of the column paramter
     *
     * @param $sColumn
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    protected function fcGetColumnValueFromManufacturerTableById($sColumn)
    {
        $iManufacturerId = $this->oxarticles__oxmanufacturerid;
        $container = ContainerFactory::getInstance()->getContainer();
        $queryBuilderFactory = $container->get(QueryBuilderFactoryInterface::class);
        $queryBuilder = $queryBuilderFactory->create();
        $result = $queryBuilder->getConnection()->executeQuery("SELECT {$sColumn} FROM oxmanufacturers WHERE OXID = '{$iManufacturerId}'");
        $result = $result->fetchAll();
        return $result[0][$sColumn];
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