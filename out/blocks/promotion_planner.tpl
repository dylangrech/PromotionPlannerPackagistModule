[{if $oView->getClassName()=='details'}]
    [{if $oDetailsProduct->fcCheckIfPromotionIsActive() === true}]
        <img style="width: 100%" src="[{$oDetailsProduct->fcGetImageUrl()}]">
    [{/if}]
    <br>
    [{if $oDetailsProduct->fcCheckIfManufacturerPromotionIsActive() === true}]
        <img style="width: 100%" src="[{$oDetailsProduct->fcGetManufacturerImageUrl()}]">
    [{/if}]
[{/if}]
[{$smarty.block.parent}]
