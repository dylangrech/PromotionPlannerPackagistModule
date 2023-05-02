[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="fc_category_promotion">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" enctype="multipart/form-data" action="[{$oViewConf->getSelfLink()}]" method="post" style="padding: 0px;margin: 0px;height:0px;">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="fc_category_promotion">
    <input type="hidden" name="fnc" value="">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="editval[oxcategories__oxid]" value="[{$oxid}]">
    <table cellspacing="0" cellpadding="0" border="0" style="width:98%;">
        <tr>
            <td class="picPreviewCol" valign="top">
                <h3>[{oxmultilang ident="FC_PROMOTION_PLANNER_IMAGE_PREVIEW_TITLE"}]</h3>
                <p>[{oxmultilang ident="FC_PROMOTION_PLANNER_IMAGE_PREVIEW_INSTRUCTIOPNS"}]</p>
                [{assign var="sPromotionImage" value=$edit->fcGetImageUrl()}]
                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-responsive" id="output"/>
            </td>
            <td class="picEditCol">
                <table>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANNER_ACTIVE"}]
                        </td>
                        <td>
                            <input type="hidden" name="editval[oxcategories__fcpromotionplanneractivepromotion]" value="0">
                            <input type="checkbox" class="edittext" name="editval[oxcategories__fcpromotionplanneractivepromotion]" value="1" [{if $edit->oxcategories__fcpromotionplanneractivepromotion->value == 1}]checked[{/if}] [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANNER_ACTIVE"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_FROM"}]
                        </td>
                        <td class="edittext">
                            <input step="1" type="datetime-local" class="editinput" name="editval[oxcategories__fcpromotionplanneractivefrom]" value="[{$edit->oxcategories__fcpromotionplanneractivefrom->value}]" [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_FROM"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_TILL"}]
                        </td>
                        <td class="edittext">
                            <input step="1" type="datetime-local" class="editinput" name="editval[oxcategories__fcpromotionplanneractivetill]" value="[{$edit->oxcategories__fcpromotionplanneractivetill->value}]" [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_TILL"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_URL"}]
                        </td>
                        <td class="edittext">
                            <input step="1" type="text" class="editinput" name="editval[oxcategories__fcpromotionplannerpromotionurl]" value="[{$edit->oxcategories__fcpromotionplannerpromotionurl->value}]" [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_URL"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_IMAGE_NAME"}]
                        </td>
                        <td class="edittext">
                            <input readonly type="text" class="editinput" size="25" value="[{$edit->oxcategories__fcpromotionplannerimage->value}]" >
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_IMAGE_NAME"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_IMAGE"}]
                        </td>
                        <td class="edittext">
                            <input onchange="loadFile(event)" type="file" class="editinput" name="myfile[PROMO_CATEGORY@oxcategories__fcpromotionplannerimage]" [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_IMAGE"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                        </td>
                        <td class="edittext" colspan="2"><br>
                            <input type="submit" class="edittext" name="save" value="[{oxmultilang ident="CATEGORY_MAIN_SAVE"}]" onClick="Javascript:document.myedit.fnc.value='save'" [{$readonly}]><br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<script>
    var loadFile = function(event) {
        let output = document.getElementById('output');
        output.removeAttribute('src');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.width = 800;
        output.height = 200;
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>

[{include file="bottomnaviitem.tpl"}]

[{include file="bottomitem.tpl"}]