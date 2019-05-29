<?php


namespace CrmHandler;



class Company extends \BitEntity\Entity
{
    public static function changeCompanyStatusInDeals($data)
    {
        \CModule::IncludeModule('crm');
        if (isset($data['UF_CRM_1557326524']))//Status
        {
            $listValues = self::getListValuesOfUF('UF_CRM_1557326524');
            $listValueTitle=self::getListValuesTitleByID($listValues,$data['UF_CRM_1557326524']);
            $stageCode=\CrmHandler\Deal::getStageCodeOfDealByTitle($listValueTitle,0);
            $dealId=\CrmHandler\Deal::getFirstDealIdByCompanyIdAndCategory($data['ID']);
            \CrmHandler\Deal::setStage($dealId,$stageCode);
        }
    }
    public static function getListValuesTitleByID($listValues,$idOfListValue)
    {
        $title='';
        foreach ($listValues as $listValue) {
            if ($listValue['ID']==$idOfListValue)
            {
                $title = $listValue['VALUE'];
            }
        }
        return $title;
    }
    public static function getListValuesOfUF($code)
    {
        $listValues=[];
        $userFields=\CCrmCompany::GetUserFields();
        if (isset($userFields[$code])){
            $listValues=\CUserTypeEnum::GetList(intval($userFields[$code]['ID']))->arResult;

        }
        return $listValues;
    }

    public static function getTasksCount($companyID)
    {
        $count=0;
        return $count;
    }
}