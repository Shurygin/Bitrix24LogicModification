<?php


namespace CrmHandler;



class Deal extends \BitEntity\Entity
{
    public static function setShootingDaysCount($dealData)
    {

        if ($dealData['UF_CRM_1558083647']<1){
            $arFields=['UF_CRM_1558083647'=>count($dealData['UF_CRM_1558083582'])];
            $dealInstance = new \CCrmDeal;
            $dealInstance -> Update($dealData['ID'], $arFields, true, true, []);
        }
    }
    public static function checkContactsCount(&$dealData)
    {

        if(count(json_decode($_REQUEST['CLIENT_DATA'],1)['CONTACT_DATA'])>1)
        {
            global $APPLICATION;
            $dealData['RESULT_MESSAGE']='В сделке должен быть 1 контакт';
            $APPLICATION->ThrowException($dealData['RESULT_MESSAGE']);
            return false;
        }

    }
    public static function getFirstDealIdByCompanyIdAndCategory($companyId,$categoryId=0)
    {
        $arOrder = ['ID' => 'ASC'];
        $arFilter = [
            'COMPANY_ID' => $companyId,
            'CATEGORY_ID' => $categoryId
        ];
        $dealData=\CCrmDeal::GetListEx($arOrder, $arFilter, false, false, ['ID'], [])->Fetch();
        return $dealData['ID'];
    }

    public static function setStage($dealId,$stageCode)
    {
        $arFields=['STAGE_ID'=>$stageCode];
        $dealInstance = new \CCrmDeal;
        $dealInstance -> Update($dealId, $arFields, true, true, []);
    }
    public static function getStageCodeOfDealByTitle($title,$categoryId)
    {
        $code='';
        $stages=\CCrmDeal::GetStageNames($categoryId);
        foreach ($stages as $key=>$name) {
            if ($name==$title)
            {
                $code=$key;
            }
        }
        return $code;
    }
}