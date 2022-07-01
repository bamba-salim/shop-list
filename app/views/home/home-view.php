<div ng-controller="loginAppController" ng-init="_loginInit()">
    <div class="row row-cols-1 g-3 my-3">
        <div class="col w-10O">
            <div class="{{ cssClass.bloc }}  my-3 text-info">
                <h1>Se connecter / s'inscrire</h1>
            </div>
        </div>
        <div class="col w-10O">
            <div class="{{ cssClass.bloc }}" ng-if="isSignIn">
                <h3>Connectez Vous</h3>
                <hr>
                <form novalidate name="form" ng-submit="signinSubmit()">
                    <div class="row row-cols-1 row-cols-2 g-4">
                        <div class="col">
                            <label for="username" class="form-label">Nom d'utilisateur *</label>
                            <input type="text" name="username" id="username" class="form-control" ng-model="inputs.username" placeholder="Nom d'utilisateur" required="required">
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Mots de passe *</label>
                            <input type="password" name="password" id="password" class="form-control" ng-model="inputs.password" placeholder="Mot de passe" required="required">
                        </div>
                        <div class="col w-100 d-flex justify-content-end">
                            <button type="submit" class="btn btn-info"><span class="text-white">Se connecter</span></button>
                        </div>
                        <div class="col w-100 d-flex justify-content-end">
                            <p class="small fst-italic">(Vous n'avez pas de compte ? <span class="text-decoration-underline text-info fst-italic" style="cursor: pointer" ng-click="switchLogin()">Inscrivez-vous</span>.)</p>
                        </div>
                    </div>
                </form>
            </div>

            <div class="{{ cssClass.bloc }}" ng-if="!isSignIn">
                <h3>S'inscire</h3>
                <hr>
                <form novalidate name="form" ng-submit="signupSubmit()">
                    <div class="row row-cols-1 row-cols-2 g-4">
                        <div class="col">
                            <label for="firstname" class="form-label">Prénom *</label>
                            <input type="text" name="firstname" id="prénom" class="form-control" ng-model="inputs.firstname" placeholder="Prénom" required="required">
                        </div>
                        <div class="col">
                            <label for="lastName" class="form-label">Nom *</label>
                            <input type="text" name="lastName" id="lastName" class="form-control" ng-model="inputs.lastname" placeholder="Nom" required="required" >
                        </div>
                        <div class="col">
                            <label for="username" class="form-label">Nom d'utilisateur *</label>
                            <input type="text" name="username" id="username" class="form-control" minlength="4" ng-model="inputs.username" placeholder="Nom d'utilisateur" required="required" ng-change="checkValidUsername(inputs.username)" >
                            <smal ng-if="inputs.username.length > 4" class="fst-italic small"  ng-class="{'isValid': validUsername, 'isError': !validUsername }">
                                <i class="fa-solid me-2" ng-class="{'fa-user-check': validUsername, 'fa-user-xmark ': !validUsername }"></i> {{ validUsernameMessage }} <span ng-if="!validUsername" class="text-decoration-underline" style="{cursor: pointer}" ng-click="switchLogin()">Connectez-vous</span>
                            </smal>
                        </div>
                        <div class="col">
                            <label for="password" class="form-label">Mot de passe *</label>
                            <input type="password" name="password" id="password" class="form-control" ng-model="inputs.password" placeholder="Mot de passe" required="required" >
                        </div>
                        <div class="col w-100 d-flex justify-content-end">
                            <button type="submit" class="btn btn-info"><span class="text-white">S'inscire</span></button>
                        </div>
                        <div class="col w-100 d-flex justify-content-end">
                            <p class="small fst-italic">
                                (Vous avez un compte ? <span class="text-decoration-underline text-info fst-italic" style="cursor: pointer" ng-click="switchLogin()">Connectez-vous</span>.)
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


</div>
