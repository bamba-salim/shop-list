<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <a class="navbar-brand text-info" ui-sref="{{ isConnected ? 'dashboard' :'home' }}">{{ APP_NAME }}</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse d-lg-flex justify-content-between" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" ng-if="!isConnected" ui-sref="home" ui-sref-active="active">Home</a>
                <a class="nav-link" ng-if="isConnected" ui-sref="dashboard" ui-sref-active="active">Dashboard</a>
            </div>
            <div class="navbar-nav">
                <a class="nav-link" ng-if="isConnected" href="#"  ng-click="submitSignOut()"><i class="fa-solid fa-power-off text-danger"></i> Se déconnecter</a>
            </div>
        </div>
    </div>
</nav>