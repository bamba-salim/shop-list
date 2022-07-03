<div ng-controller="dashboardController" ng-init="_onDashboardInit()">
    <div class="row row-cols-1 row-cols-lg-2 g-3 my-3">
        <div class="w-100 col">
            <div class="{{ cssClass.bloc }} text-info  my-3">
                <h1>Mon dashboard</h1>
            </div>
        </div>
        <div class="w-100 col">
            <div class="{{ cssClass.bloc }} ">
                <div class="d-flex justify-content-between">
                    <h2 class="text-info d-block">{{ sessionUser.firstname }} {{ sessionUser.lastname }}</h2>
                    <p class="fw-bold d-block">{{ sessionUser.username }}</p>
                </div>
            </div>
        </div>
        <div class="col order-2 order-lg-1" ng-if="userLists.length > 0">
            <div class="{{ cssClass.bloc }}">
                <div class="d-flex justify-content-between align-items-center py-2 mb-3">
                    <h4 class="d-block m-0">Mes lists</h4>
                </div>
                <div>
                    <table class="table table-striped table-sm">
                        <thead class="bg-info text-white">
                        <tr>
                            <td></td>
                            <th>List</th>
                            <th class="text-end">Action</th>
                        </tr>

                        </thead>
                        <tbody>
                        <tr ng-repeat="list in userLists">
                            <td>
                                <span ng-click="switchSelectedList(list.id)" style="cursor: pointer">
                                    <i class="fa-solid fa-circle text-light" ng-if="!contains(list.id, selectedLists)"></i>
                                    <i class="fa-solid fa-circle-check" ng-if="contains(list.id, selectedLists)"></i>
                                </span>
                            </td>
                            <td>{{ list.name }}</td>
                            <td>
                                <span class="d-flex justify-content-end">
                                    <button type="button" class="{{ cssClass.listBtn }}" view-list id-list="list.id">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <button type="button" class="{{ cssClass.listBtn }}" ng-click="submitDeleteList(list.id)">
                                        <i class="fa-solid fa-minus"></i>
                                    </button>
                                </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <button type="button" class="{{ cssClass.listBtn }}" ng-click="submitMutipleDeleteList()" ng-disabled="selectedLists.length === 0">
                        <i class="fa-solid fa-minus"></i> {{ selectedLists.length }}
                    </button>
                </div>
            </div>
        </div>
        <div class="col order-1 order-lg-2" ng-class="{'w-100': userLists.length === 0 }">
            <div class="{{ cssClass.bloc }}">
                <div class="d-flex align-items-center py-2">
                    <h4 class="d-block m-0">Ajouter une liste</h4>
                </div>
                <hr>

                <form novalidate ng-submit="submitCreateList()">
                    <div class="row row-cols-1 row-cols-2 g-4">
                        <div class="col w-100">
                            <label for="listName" class="form-label">Nom de la liste *</label>
                            <input type="text" name="listName" id="listName" class="form-control" ng-model="inputs.name" placeholder="Nom de la liste" required="required">
                        </div>
                        <div class="col w-100">
                            <label for="description" class="form-label">Description de la liste *</label>
                            <textarea name="description" id="description" class="form-control" ng-model="inputs.description" placeholder="Description" required="required"></textarea>
                        </div>
                        <div class="col w-100 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success"><span class="text-white">Créer une liste</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>


</div>
