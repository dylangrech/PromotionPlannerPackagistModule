[{include file="headitem.tpl" title="GENERAL_ADMIN_TITLE"|oxmultilangassign}]

[{if $readonly}]
    [{assign var="readonly" value="readonly disabled"}]
[{else}]
    [{assign var="readonly" value=""}]
[{/if}]

<form name="transfer" id="transfer" action="[{$oViewConf->getSelfLink()}]" method="post">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="cl" value="fc_article_promotion">
    <input type="hidden" name="editlanguage" value="[{$editlanguage}]">
</form>

<form name="myedit" id="myedit" enctype="multipart/form-data" action="[{$oViewConf->getSelfLink()}]" method="post" style="padding: 0px;margin: 0px;height:0px;">
    [{$oViewConf->getHiddenSid()}]
    <input type="hidden" name="cl" value="fc_article_promotion">
    <input type="hidden" name="fnc" value="">
    <input type="hidden" name="oxid" value="[{$oxid}]">
    <input type="hidden" name="voxid" value="[{$oxid}]">
    <input type="hidden" name="oxparentid" value="[{$oxparentid}]">
    <input type="hidden" name="editval[oxarticles__oxid]" value="[{$oxid}]">
    <input type="hidden" name="editval[oxarticles__oxlongdesc]" value="">
    <table cellspacing="0" cellpadding="0" border="0" style="width:98%;">
        <tr>
            <td class="picPreviewCol" valign="top">
                <h3>[{oxmultilang ident="FC_PROMOTION_PLANNER_IMAGE_PREVIEW_TITLE"}]</h3>
                <p>[{oxmultilang ident="FC_PROMOTION_PLANNER_IMAGE_PREVIEW_INSTRUCTIOPNS"}]</p>
                <div id="exampleBox" style="width: 800px; text-align: center; height: 100px; border: 1px solid black; padding: 50px; margin: 20px;">
                    <p>[{oxmultilang ident="FC_PROMOTION_PLANNER_IMAGE_PREVIEW_EXAMPLE_SIZE"}]</p>
                </div>
                <img style="display: block; margin-left: auto; margin-right: auto;"  class="img-responsive" id="output"/>
            </td>
            <td class="picEditCol">
                <table>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_FROM"}]
                        </td>
                        <td class="edittext">
                            <input step="1" type="datetime-local" class="editinput" name="editval[oxarticles__fcpromotionplanneractivefrom]" value="[{$edit->oxarticles__fcpromotionplanneractivefrom->value}]" [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_FROM"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_TILL"}]
                        </td>
                        <td class="edittext">
                            <input step="1" type="datetime-local" class="editinput" name="editval[oxarticles__fcpromotionplanneractivetill]" value="[{$edit->oxarticles__fcpromotionplanneractivetill->value}]" [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_TILL"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_IMAGE_NAME"}]
                        </td>
                        <td class="edittext">
                            <input readonly type="text" class="editinput" size="25" value="[{$edit->oxarticles__fcpromotionplannerimage->value}]" >
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_IMAGE_NAME"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext">
                            [{oxmultilang ident="FC_PROMOTION_PLANER_IMAGE"}]
                        </td>
                        <td class="edittext">
                            <input onchange="loadFile(event)" type="file" class="editinput" name="myfile[PROMO_ARTICLE@oxarticles__fcpromotionplannerimage]" [{$readonly}]>
                            [{oxinputhelp ident="HELP_FC_PROMOTION_PLANER_IMAGE"}]
                        </td>
                    </tr>
                    <tr>
                        <td class="edittext" colspan="2"><br><br>
                            <input type="submit" class="edittext" id="oLockButton" name="saveArticle" value="[{oxmultilang ident="ARTICLE_MAIN_SAVE"}]" onClick="Javascript:document.myedit.fnc.value='save'" [{if !$edit->oxarticles__oxtitle->value && !$oxparentid}]disabled[{/if}] [{$readonly}]>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>

    </table>
</form>
<script>
    var loadFile = function(event) {
        let divExample = document.getElementById('exampleBox');
        divExample.style.display = 'none';
        var output = document.getElementById('output');
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