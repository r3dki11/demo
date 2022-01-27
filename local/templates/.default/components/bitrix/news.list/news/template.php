<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$this->addExternalCss("/local/component-templates/news/component-styles.css");
$this->addExternalJS("/local/component-templates/news/scripts.js");
?>
<div class="news-list">
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?
        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        ?>
        <div class="news-item-good" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
            <div class="news-date"><? echo $arItem["DISPLAY_ACTIVE_FROM"]; ?></div>
            <div class="news-title"><? echo $arItem["NAME"]; ?></div>
            <?if(trim($arItem["PREVIEW_TEXT"]) != ''):?>
                <div class="news-detail"><?echo $arItem["PREVIEW_TEXT"];?></div>
            <?endif;?>
        </div>
    <?endforeach;?>
</div>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
    <?=$arResult["NAV_STRING"]?>
<?endif;?>
<?
if($arResult["MORE"]) {
    ?>
    <h3>Дополнительные новости</h3>
    <div class="news-list">
        <?foreach($arResult["MORE"] as $arItem):?>
            <?
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="news-item-good" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="news-date"><? echo $arItem["DISPLAY_ACTIVE_FROM"]; ?></div>
                <div class="news-title"><? echo $arItem["NAME"]; ?></div>
                <?if(trim($arItem["PREVIEW_TEXT"]) != ''):?>
                    <div class="news-detail"><?echo $arItem["PREVIEW_TEXT"];?></div>
                <?endif;?>
            </div>
        <?endforeach;?>
    </div>
    <?
}
?>