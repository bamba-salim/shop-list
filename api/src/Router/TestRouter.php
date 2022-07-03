<?php

Router::ROUTES([
    new Route("test", "GET", [TestManager::class, "test"]),
    new Route("savon", "POST", [Manager::class, "savon"])
]);