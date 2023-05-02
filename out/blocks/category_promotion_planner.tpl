[{assign var="actCategory" value=$oView->getActiveCategory()}]
[{if $actCategory->fcCheckIfPromotionIsActive() !== false }]
    <div class="row">
        <div class="col-lg-12 d-flex justify-content-center">
            <div class="card text-center">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <a target="_blank" href="[{$actCategory->fcGetCategoryPromotionUrl()}]"><img style="width: 1000px; height: 200px; display: block; margin-left: auto; margin-right: auto;" class="img-responsive" src="[{$actCategory->fcGetImageUrl()}]"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
[{/if}]

[{$smarty.block.parent}]
