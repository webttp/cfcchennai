// Create your app with 'mediaplayer' dependency
var sermonApp = angular.module('myApp', ['mediaPlayer']);

// Inside your controller...
sermonApp.controller('sermonController', function ($scope) {
  // have a video id
  $scope.videoId = 'sMKoNBRZM1M';
});
