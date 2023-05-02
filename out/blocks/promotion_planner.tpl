[{if $oView->getClassName()=='details'}]
    [{if $oDetailsProduct->fcCheckIfPromotionIsActive() === true}]
        <a target="_blank" href="[{$oDetailsProduct->fcGetArticlePromotionUrl()}]"><img style="width: 100%" src="[{$oDetailsProduct->fcGetImageUrl()}]" alt="Article Promotion"></a>
    [{/if}]
    <br>
    [{if $oDetailsProduct->fcCheckIfManufacturerPromotionIsActive() === true}]
        <a target="_blank" href="[{$oDetailsProduct->fcGetManufacturerPromotionUrl()}]"><img style="width: 100%" src="[{$oDetailsProduct->fcGetManufacturerImageUrl()}]"></a>
    [{/if}]
[{/if}]
[{$smarty.block.parent}]
