<?php

namespace Fatchip\PromotionPlanner\Core\Setup;

use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\DbMetaDataHandler;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Events extends Base
{

    /**
     * Updates the views in the database
     *
     * @return void
     */
    public static function fcRebuildViews()
    {
        if (Registry::getSession()->getVariable('malladmin')) {
            $metaData = oxNew(DbMetaDataHandler::class);
            $metaData->updateViews();
        }
    }

    /**
     * Alters the article, category and manufacturer tables on activation
     *
     * @return void
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public static function fcAlterTablesOnActivate()
    {
        $oDb = DatabaseProvider::getDb();
        self::fcExecuteQueryIfColumnDoesNotExist('oxarticles', 'FCPROMOTIONPLANNERACTIVEFROM', "ALTER TABLE oxarticles ADD FCPROMOTIONPLANNERACTIVEFROM datetime COMMENT 'Promotion Active From Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER OXPRICE", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxarticles', 'FCPROMOTIONPLANNERACTIVETILL', "ALTER TABLE oxarticles ADD FCPROMOTIONPLANNERACTIVETILL datetime COMMENT 'Promotion Active Till Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER FCPROMOTIONPLANNERACTIVEFROM", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxarticles', 'FCPROMOTIONPLANNERIMAGE', "ALTER TABLE oxarticles ADD FCPROMOTIONPLANNERIMAGE text COMMENT 'Promotion Image' NOT NULL AFTER FCPROMOTIONPLANNERACTIVETILL", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxarticles', 'FCPROMOTIONPLANNERACTIVEPROMOTION', "ALTER TABLE oxarticles ADD FCPROMOTIONPLANNERACTIVEPROMOTION tinyint(1) COMMENT 'Promotion Active' NOT NULL DEFAULT '0' AFTER FCPROMOTIONPLANNERIMAGE", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxmanufacturers', 'FCPROMOTIONPLANNERACTIVEFROM', "ALTER TABLE oxmanufacturers ADD FCPROMOTIONPLANNERACTIVEFROM datetime COMMENT 'Promotion Active From Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER OXSHORTDESC_3", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxmanufacturers', 'FCPROMOTIONPLANNERACTIVETILL', "ALTER TABLE oxmanufacturers ADD FCPROMOTIONPLANNERACTIVETILL datetime COMMENT 'Promotion Active Till Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER FCPROMOTIONPLANNERACTIVEFROM", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxmanufacturers', 'FCPROMOTIONPLANNERIMAGE', "ALTER TABLE oxmanufacturers ADD FCPROMOTIONPLANNERIMAGE text COMMENT 'Promotion Image' NOT NULL AFTER FCPROMOTIONPLANNERACTIVETILL", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxmanufacturers', 'FCPROMOTIONPLANNERACTIVEPROMOTION', "ALTER TABLE oxmanufacturers ADD FCPROMOTIONPLANNERACTIVEPROMOTION tinyint(1) COMMENT 'Promotion Active' NOT NULL DEFAULT '0' AFTER FCPROMOTIONPLANNERIMAGE", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxcategories', 'FCPROMOTIONPLANNERACTIVEFROM', "ALTER TABLE oxcategories ADD FCPROMOTIONPLANNERACTIVEFROM datetime COMMENT 'Promotion Active From Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER OXTITLE", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxcategories', 'FCPROMOTIONPLANNERACTIVETILL', "ALTER TABLE oxcategories ADD FCPROMOTIONPLANNERACTIVETILL datetime COMMENT 'Promotion Active Till Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER FCPROMOTIONPLANNERACTIVEFROM", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxcategories', 'FCPROMOTIONPLANNERIMAGE', "ALTER TABLE oxcategories ADD FCPROMOTIONPLANNERIMAGE text COMMENT 'Promotion Image' NOT NULL AFTER FCPROMOTIONPLANNERACTIVETILL", $oDb);
        self::fcExecuteQueryIfColumnDoesNotExist('oxcategories', 'FCPROMOTIONPLANNERACTIVEPROMOTION', "ALTER TABLE oxcategories ADD FCPROMOTIONPLANNERACTIVEPROMOTION tinyint(1) COMMENT 'Promotion Active' NOT NULL DEFAULT '0' AFTER FCPROMOTIONPLANNERIMAGE", $oDb);
    }

    /**
     * @param $sTableName
     * @param $sColumnName
     * @param $sQuery
     * @param $oDb
     * @return void
     */
    public static function fcExecuteQueryIfColumnDoesNotExist($sTableName, $sColumnName, $sQuery, $oDb)
    {
        if (empty($oDb->getOne("SHOW COLUMNS FROM {$sTableName} LIKE ? ", array($sColumnName)))){
            $oDb->execute($sQuery);
        }
    }

    /**
     * @throws DatabaseErrorException
     * @throws DatabaseConnectionException
     */
    public static function fcDeActivatePromotions()
    {
        $aTables = [
            'oxarticles',
            'oxcategories',
            'oxmanufacturers',
        ];
        foreach ($aTables as $sTable) {
            $oDb = DatabaseProvider::getDb();
            $oDb->execute("UPDATE {$sTable} SET FCPROMOTIONPLANNERACTIVEPROMOTION = 0");
        }
    }

    /**
     * Executed on module activation
     *
     * @return void
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    public static function onActivate()
    {
        self::fcAlterTablesOnActivate();
        self::fcRebuildViews();
    }

    /**
     * @throws DatabaseErrorException
     * @throws DatabaseConnectionException
     */
    public static function onDeactivate()
    {
        self::fcDeActivatePromotions();
    }

}
