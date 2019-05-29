<?php


namespace TasksHandler;

use \Bitrix\Main\Loader as Loader;
use \CrmHandler\Company as Company;

class Tasks extends \BitEntity\Entity
{
    public static function moveTaskToGroup($id,$data=[],$groupId=12)
    {
        if ($data['GROUP_ID']==0)
        {
            Loader::includeModule('tasks');
            $task = \CTaskItem::getInstance($id, 1);
            $task->update(array('GROUP_ID' => $groupId));
        }
    }

    public static function statusControl($id,$data=[],$taskData=[])
    {
        global $USER, $APPLICATION;

        if (isset($USER))
        {

            if (!$USER->isAdmin()&&$data['STATUS']==6)//отложена
            {
                $APPLICATION->ThrowException('Нельзя откладывать задачи');
                return false;
            }
            if ($data['STATUS']==5&&count($taskData['UF_CRM_TASK'])>0)//завершена
            {
                $companyID=self::getCompanyID($taskData['UF_CRM_TASK']);
                if ($companyID==0)
                {
                    return true;
                }
                Loader::includeModule('crm');
                $listValues = Company::getListValuesOfUF('UF_CRM_1557326524');
                $arOrder = ['ID' => 'ASC'];
                $arFilter = [
                    'COMPANY_ID' => $companyID,
                ];
                $companyData=\CCrmCompany::GetListEx($arOrder, $arFilter, false, false, ['UF_CRM_1557326524'], [])->Fetch();
                $listValueTitle = Company::getListValuesTitleByID($listValues,$companyData['UF_CRM_1557326524']);
                if ($listValueTitle==='Переговоры')
                {
                    $tasksCount=Company::getTasksCount($companyID);
                    if ($tasksCount<2)
                    {
                        $APPLICATION->ThrowException('Нельзя закрывать последнюю задачу,
                         пока компания находится в статусе Переговоры');
                        return false;
                    }
                }
            }
        }
    }

    public static function checkDeadline($id,$data=[])
    {
        if ($data['DEADLINE']==null)
        {
            Loader::includeModule('tasks');
            $task = \CTaskItem::getInstance($id, 1);
            $task->update(array('DEADLINE' => FormatDate('d.m.Y', time()).' 21:00:00' ));
        }
    }

    private static function getCompanyID($crmElements=[])
    {
        $id=0;

        if (count($crmElements)>0)
        {
            foreach ($crmElements as $crmElement) {
                $typeOfEntity=explode('_',$crmElement)[0];
                if ($typeOfEntity=='CO')
                {
                    return explode('_',$crmElement)[1];
                }
            }
        }
        return $id;
    }
}