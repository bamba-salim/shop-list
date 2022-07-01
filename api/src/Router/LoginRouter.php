<?php

Router::ROUTES([
    new Route("check-valid-username", "GET", [LoginManager::class, "isNewUsernameValid"]),
    new Route("sign-up-new-user", "POST", [LoginManager::class, "signUpUser"]),
    new Route("sign-in-user", "POST", [LoginManager::class, "signInUser"])
]);
