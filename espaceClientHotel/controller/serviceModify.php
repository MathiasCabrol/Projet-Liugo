<?php

    $newService = new Service;
    $newService->setServiceId($_SESSION['serviceId']);
    $serviceInfos = $newService->displayService();
    $newSubService = new SubService;
    $subServiceInfos = $newSubService->getAllSubServices($serviceInfos->serviceId);