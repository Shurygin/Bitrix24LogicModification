<?php

addEventHandler("crm","OnAfterCrmCompanyUpdate",["\\CrmHandler\\Company","changeCompanyStatusInDeals"]);

addEventHandler("crm","OnAfterCrmDealAdd",["\\CrmHandler\\Deal","setShootingDaysCount"]);

addEventHandler("crm","OnBeforeCrmDealAdd",["\\CrmHandler\\Deal","checkContactsCount"]);

addEventHandler("crm","OnBeforeCrmDealUpdate",["\\CrmHandler\\Deal","checkContactsCount"]);