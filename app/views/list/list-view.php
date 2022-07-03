<div ng-controller="listController" ng-init="_onListInit()">
    <div class="row row-cols-1 row-cols-lg-2 g-3 my-3">
        <div class="w-100 col">
            <div class="{{ cssClass.bloc }}">
                <a ui-sref="dashboard" class="nav-link"><i class="fa-solid fa-chevron-left"></i> Revenir au dashboard</a>
            </div>
        </div>
        <div class="w-100 col">
            <div class="{{ cssClass.bloc }}">
                <h1 class="text-info" >List {{ list.name }}</h1>
                <p class="ps-3">{{ list.description || ' - '  }}</p>
            </div>
        </div>
        <div class="w-100 col"  ng-if="itemsList.length > 0">
            <div class="{{ cssClass.bloc }}">
                <row class="row row-cols-2 g-3 text-center">
                    <div class="col ">
                        <div class="border">{{ listInfos.total_price | number: 2 }} € / totale</div>
                    </div>
                    <div class="col ">
                        <div class="border">{{ listInfos.unique_item }} Item différents</div>
                    </div>
                    <div class="col">
                        <div class="border">{{ listInfos.total_item }} items</div>
                    </div>
                    <div class="col">
                        <div class="border">{{ listInfos.price_per_item | number: 2 }} € / item</div>
                    </div>
                    <div class="col w-50">
                        <div class="border">
                            <div class="d-flex justify-content-evenly   align-items-center">
                                <p class="m-0">{{ listInfos.max_price.name }}</p>
                                <p class="m-0">{{ listInfos.max_price.price | number: 2 }} €</p>
                            </div>
                        </div>

                    </div>
                    <div class="col w-50">
                        <div class="border">
                            <div class="d-flex justify-content-evenly   align-items-center">
                                <p class="m-0">{{ listInfos.min_price.name }}</p>
                                <p class="m-0">{{ listInfos.min_price.price | number: 2 }} €</p>
                            </div>
                        </div>
                    </div>
                </row>
            </div>
        </div>
        <div class="col  order-2 order-lg-1" ng-if="itemsList.length > 0">
            <div class="{{ cssClass.bloc }}">
                <div class="d-flex justify-content-between align-items-center py-2 mb-3">
                    <h4 class="d-block m-0">List des items</h4>
                    <button class="btn btn-info btn-sm text-white">+</button>
                </div>
                <table class="table table-striped table-sm">
                    <thead class="bg-info text-white">
                    <tr>
                        <th></th>
                        <th>List</th>
                        <th class="text-end">Qauntité</th>
                        <th class="text-end">Prix</th>
                        <th class="text-end">Totale</th>
                        <th class="text-end">Action</th>
                    </tr>

                    </thead>
                    <tbody>
                    <tr ng-repeat="item in itemsList">
                        <td>
                            <span ng-click="switchSelectedItems(item.id)" style="cursor: pointer">
                                <i class="fa-solid fa-circle text-light" ng-if="!contains(item.id, selectedItems)"></i>
                                <i class="fa-solid fa-circle-check" ng-if="contains(item.id, selectedItems)"></i>
                            </span>
                        </td>
                        <td>{{ item.name }}</td>
                        <td class="text-end">{{ item.quantity }}</td>
                        <td class="text-end">{{ item.price | number: 2 }} €</td>
                        <td class="text-end">{{ (item.price * item.quantity) | number: 2 }} €    </td>
                        <td class="d-flex justify-content-evenly">
                            <button type="button" class="{{ cssClass.listBtn }}" title="Modiifer l'item">
                                <i class="fa-solid fa-pen"></i>️
                            </button>
                            <button type="button" class="{{ cssClass.listBtn }}" title="Supprimer l'item" ng-click="sumbitDeleteItem(item.id)">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            </span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div>
                    <button type="button" class="{{ cssClass.listBtn }}" ng-click="submitMutipleDeleteItems()" ng-disabled="selectedItems    .length === 0">
                        <i class="fa-solid fa-minus"></i> {{ selectedItems.length }}
                    </button>
                </div>
            </div>
        </div>
        <div class="col  order-1 order-lg-2" ng-class="{'w-100': itemsList.length === 0 }">
            <div class="{{ cssClass.bloc }}">
                <div class="d-flex   align-items-center py-2">
                    <h4 class="d-block m-0">Ajouter un item</h4>
                </div>
                <hr>
                <form novalidate ng-submit="submitCreateItem()">
                    <div class="row row-cols-1 row-cols-2 g-4">
                        <div class="col w-100">
                            <label for="name" class="form-label">Item *</label>
                            <input type="text" name="name" id="listName" class="form-control" ng-model="inputs.name" placeholder="Item" required="required">
                        </div>
                        <div class="col">
                            <label for="quantity" class="form-label">Quantité *</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" ng-model="inputs.quantity" placeholder="Quantité" required="required">
                        </div>
                        <div class="col">
                            <label for="price" class="form-label">Prix *</label>
                            <input type="number" step="0.01" name="price" id="price" class="form-control" ng-model="inputs.price" placeholder="Prix" required="required">
                        </div>
                        <div class="col w-100">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" ng-model="inputs.description" placeholder="Description"></textarea>
                        </div>
                        <div class="col w-100 d-flex justify-content-end">
                            <button type="submit" class="btn btn-success"><span class="text-white">Créer un item</span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
</div>