<div class="fixed z-10 inset-0 overflow-y-auto bg-gray-700 bg-opacity-75 " aria-labelledby="modal-title" role="dialog"
     aria-modal="true">
  <!--    todo: center modal-->
  <div class="z-20 mx-auto lg:w-1/3 md:w-2/3 w-10/12 mt-16">
    <div class="bg-blue-700 text-white py-5 px-4 text-lg leading-6 font-medium">
      {{ modal.title }}
    </div>
    <div class="bg-white px-8 py-5 text-sm">
      {{modal.text}}
    </div>
    <div class="bg-gray-200 px-6 py-3 flex gap-4 justify-end">
      <button class="border shadow-sm font-medium py-1 px-3 my-1" ng-class="btn.class"
              ng-click="onEventButtonClick()">{{btn.title}}
      </button>
      <button class="border shadow-sm font-medium py-1 px-3 my-1 text-black bg-white hover:bg-gray-100"
              ng-click="dismiss()">Annuler
      </button>
    </div>
  </div>
</div>
