<?php

Router::ROUTES([
    new Route("test", "GET", [Manager::class, "test"]),
    new Route("savon", "POST", [Manager::class, "savon"])
]);