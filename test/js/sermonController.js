// Create your app with 'youtube-embed' dependency
var myApp = angular.module('myApp', ['mediaPlayer']);

// Inside your controller...
myApp.controller('sermonController', function ($scope) {
  // have a video id
  $scope.videoId = 'sMKoNBRZM1M';
});
