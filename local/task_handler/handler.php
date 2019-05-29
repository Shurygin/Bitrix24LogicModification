<?php

addEventHandler("tasks","OnTaskAdd",["\\TasksHandler\\Tasks","moveTaskToGroup"]);

addEventHandler("tasks","OnTaskAdd",["\\TasksHandler\\Tasks","checkDeadline"]);

//addEventHandler("tasks","OnBeforeTaskUpdate",["\\TasksHandler\\Tasks","statusControl"]);


