angular.module('app', ['ui.bootstrap'])
.directive('test', function () {
  return {
    require: {
        ngModelCtrl: 'ngModel'
    },
    link: (a,b,c,ngModelCtrl) => {
      ngModelCtrl.$formatters.push(value => Boolean(value === '1' || value === 1));
      ngModelCtrl.$parsers.push(value => Number(value));
    }
  }
})

  .controller('ctrl', ['$scope', ($scope) => {
    $scope.vm = { 
      date1: null, 
      date2: null, 
      ivo: 1,
      isOpen: true,
      datepickerOptions: {
        ngModelOptions: {
          timezone: "-1200"
        } 
      }
    };
  }]);