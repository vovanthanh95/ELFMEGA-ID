$(document).ready(function () {
  onResize();
});

window.addEventListener('resize', onResize);
function onResize() {
  let redirectUrl = getUrlParameter('redirectUrl')
    ? getUrlParameter('redirectUrl')
    : '';
  // if (!redirectUrl) {
  //   redirectUrl = $('#game_url').val()
  //     ? $('#game_url').val()
  //     : 'https://game.vn';
  //   window.location.href = redirectUrl;
  //   return;
  // }
  const root_url = $('#root_url').val();
  const gameId = getUrlParameter('gameid') ? getUrlParameter('gameid') : 0;
  var background = 'url("./assets/master-images/1920x1080.jpg")';
  const screenWidth = window.innerWidth;
  if (screenWidth > 575) {
    switch (parseInt(gameId, 10)) {
      case 1:
        background = 'url("./assets/master-images/[YG01]_1920x1080.jpg")';
        break;
      case 4:
        background = 'url("./assets/master-images/[YG02]_1920x1080.png")';
        break;
      case 7:
        background = 'url("./assets/master-images/[YG05]_1920x1080.png")';
        break;
      case 9:
        background = 'url("./assets/master-images/[YG07]_1920x1080.png")';
        break;
      case 11:
        background = 'url("./assets/master-images/[YG08]_1920x1080.png")';
        break;
      case 14:
        background = 'url("./assets/master-images/[YG11]_PHIENBANMOI_AN_DUYEN_PC.png")';
        break;
    }
    $('#blur').css('background-image', background);
  } else {
    switch (parseInt(gameId, 10)) {
      case 1:
        background = 'url("./assets/master-images/[YG01]_1920x1080-MOBILE.png")';
        break;
      case 4:
        background = 'url("./assets/master-images/[YG02]_1920x1080-MOBILE.png")';
        break;
      case 7:
        background = 'url("./assets/master-images/[YG05]_1920x1080-MOBILE.png")';
        break;
      case 9:
        background = 'url("./assets/master-images/[YG07]_1920x1080-MOBILE.png")';
        break;
      case 11:
        background = 'url("./assets/master-images/[YG08]_1920x1080-MOBILE.png")';
        break;
      case 14:
        background = 'url("./assets/master-images/[YG11]_PHIENBANMOI_AN_DUYEN_MOBILE.png")';
        break;
    }
    $('#blur').css('background-image', background);
  }
}
function getUrlParameter(sParam) {
  var sPageURL = window.location.search.substring(1),
    sURLVariables = sPageURL.split('&'),
    sParameterName,
    i;
  for (i = 0; i < sURLVariables.length; i++) {
    sParameterName = sURLVariables[i].split('=');
    if (sParameterName[0] === sParam) {
      return sParameterName[1] === undefined
        ? true
        : decodeURIComponent(sParameterName[1]);
    }
  }
}
