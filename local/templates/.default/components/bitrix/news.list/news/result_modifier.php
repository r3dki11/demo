<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
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

$arResult["MORE"] = [];

if ($arParams["IBLOCK_ID_MORE"] > 0) {

    $arSelect = array("ID", "IBLOCK_ID", "NAME", "ACTIVE_FROM", "PREVIEW_TEXT");
    $arFilter = array("IBLOCK_ID" => $arParams["IBLOCK_ID_MORE"], "ACTIVE_DATE" => "Y", "ACTIVE" => "Y");
    $res = CIBlockElement::GetList(["active_from"=>"desc"], $arFilter, false, ["nPageSize" => 2], $arSelect);
    while ($ob = $res->GetNextElement()) {
        $arFields = $ob->GetFields();

        if ($arFields["ACTIVE_FROM"] <> '')
            $arFields["DISPLAY_ACTIVE_FROM"] = CIBlockFormatProperties::DateFormat($arParams["ACTIVE_DATE_FORMAT"], MakeTimeStamp($arFields["ACTIVE_FROM"], CSite::GetDateFormat()));
        else
            $arFields["DISPLAY_ACTIVE_FROM"] = "";

        //получаем ссылки для редактирования и удаления элемента
        $arButtons = CIBlock::GetPanelButtons(
            $arFields["IBLOCK_ID"],
            $arFields["ID"],
            0,
            array("SECTION_BUTTONS"=>false, "SESSID"=>false)
        );
        $arFields["EDIT_LINK"] = $arButtons["edit"]["edit_element"]["ACTION_URL"];
        $arFields["DELETE_LINK"] = $arButtons["edit"]["delete_element"]["ACTION_URL"];

        $arResult["MORE"][] = $arFields;
    }

}

//var_dump($arResult["MORE"]);


// Новости из него должны выводиться в количестве 2 штук с самой свежей датой Начало
// активности. Важно не выбрать еще не активные новости, Начало активности у которых
// больше текущей даты. Вывести эти новости нужно сразу после вывода новостей из
// основного инфоблока и нижней пагинации.