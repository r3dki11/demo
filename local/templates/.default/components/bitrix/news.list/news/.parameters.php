<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
    return;

$arTypesEx = CIBlockParameters::GetIBlockTypes(array("-"=>" "));

$arIBlocks=array();
$db_iblock = CIBlock::GetList(array("SORT"=>"ASC"), array("SITE_ID"=>$_REQUEST["site"], "TYPE" => ($arCurrentValues["IBLOCK_TYPE"]!="-"?$arCurrentValues["IBLOCK_TYPE"]:"")));
while($arRes = $db_iblock->Fetch())
    $arIBlocks[$arRes["ID"]] = "[".$arRes["ID"]."] ".$arRes["NAME"];


$arTemplateParameters = array(
    "IBLOCK_TYPE_MORE" => array(
        "PARENT" => "BASE",
        "NAME" => "Тип инфоблока Дополнительные новости",
        "TYPE" => "LIST",
        "VALUES" => $arTypesEx,
        "DEFAULT" => "news",
        "REFRESH" => "Y",
    ),
    "IBLOCK_ID_MORE" => array(
        "PARENT" => "BASE",
        "NAME" => "ID инфоблока Дополнительные новости",
        "TYPE" => "LIST",
        "VALUES" => $arIBlocks,
        "DEFAULT" => '',
        "ADDITIONAL_VALUES" => "Y",
        "REFRESH" => "Y",
    ),
);