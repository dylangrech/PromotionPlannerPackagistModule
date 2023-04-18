<?php

namespace Fatchip\PromotionPlanner\Core\Setup;

use OxidEsales\Eshop\Core\Base;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\DbMetaDataHandler;
use OxidEsales\Eshop\Core\Registry;

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
        $aQueriesArticle = [
            "ALTER TABLE oxarticles ADD FCPROMOTIONPLANNERACTIVEFROM datetime COMMENT 'Promotion Active From Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER OXPRICE",
            "ALTER TABLE oxarticles ADD FCPROMOTIONPLANNERACTIVETILL datetime COMMENT 'Promotion Active Till Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER FCPROMOTIONPLANNERACTIVEFROM",
            "ALTER TABLE oxarticles ADD FCPROMOTIONPLANNERIMAGE text COMMENT 'Promotion Image' NOT NULL AFTER FCPROMOTIONPLANNERACTIVETILL",
        ];
        $aQueriesManufacturer = [
            "ALTER TABLE oxmanufacturers ADD FCPROMOTIONPLANNERACTIVEFROM datetime COMMENT 'Promotion Active From Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER OXSHORTDESC_3",
            "ALTER TABLE oxmanufacturers ADD FCPROMOTIONPLANNERACTIVETILL datetime COMMENT 'Promotion Active Till Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER FCPROMOTIONPLANNERACTIVEFROM",
            "ALTER TABLE oxmanufacturers ADD FCPROMOTIONPLANNERIMAGE text COMMENT 'Promotion Image' NOT NULL AFTER FCPROMOTIONPLANNERACTIVETILL",
        ];
        $aQueriesCategory = [
            "ALTER TABLE oxcategories ADD FCPROMOTIONPLANNERACTIVEFROM datetime COMMENT 'Promotion Active From Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER OXTITLE",
            "ALTER TABLE oxcategories ADD FCPROMOTIONPLANNERACTIVETILL datetime COMMENT 'Promotion Active Till Date' NOT NULL DEFAULT '0000-00-00 00:00:00' AFTER FCPROMOTIONPLANNERACTIVEFROM",
            "ALTER TABLE oxcategories ADD FCPROMOTIONPLANNERIMAGE text COMMENT 'Promotion Image' NOT NULL AFTER FCPROMOTIONPLANNERACTIVETILL",
        ];
        self::fcExecuteQueries("SHOW COLUMNS FROM oxarticles LIKE 'FCPROMOTIONPLANNERACTIVEFROM'", $aQueriesArticle, $oDb);
        self::fcExecuteQueries("SHOW COLUMNS FROM oxmanufacturers LIKE 'FCPROMOTIONPLANNERACTIVEFROM'", $aQueriesManufacturer, $oDb);
        self::fcExecuteQueries("SHOW COLUMNS FROM oxcategories LIKE 'FCPROMOTIONPLANNERACTIVEFROM'", $aQueriesCategory, $oDb);
    }

    /**
     * Executes the given queries. Used to shorten the code.
     *
     * @param $sCheckQuery
     * @param $aQueries
     * @param $oDb
     * @return void
     */
    public static function fcExecuteQueries($sCheckQuery, $aQueries, $oDb)
    {
        if ($oDb->getOne($sCheckQuery) === false) {
            foreach ($aQueries as $sQuery) {
                $oDb->execute($sQuery);
            }
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

}