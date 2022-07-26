const YG_COOKIE = 'YG_COOKIE';
const Game = {
  WEB_GAMEID_ATAO: 1,
  WEB_GAMEID_PHITIEN: 2,
  WEB_GAMEID_HERO: 3,
  WEB_GAMEID_TAYDU: 4,
  WEB_GAMEID_NGUTUYET: 5,
  WEB_GAMEID_NGUTUYET_EN: 7,
  WEB_GAMEID_TOANDAN3Q: 8,
  WEB_GAMEID_GHTUTIEN: 9,
};
const Article = {
  ALL: 0,
  NEWS: 4,
  EVENT: 7,
  TUTORIAL: 9,
};

function getById(id) {
  return $(`#${id}`);
}
function getByClass(clazz) {
  return $(`#${clazz}`);
}

let USER_COOKIE;
let isLoggedIn = false;


const initialPopper = () => {
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });
};

const authenticatedUrl = (url = '') => {
  if (url.startsWith('/')) {
    url = url.replace('/', '');
  }
  $.LoadingOverlay('show');
  // switch (url) {
  //   case 'history':
  //   case 'notification':
  //   case 'account':
  //   case 'activity':
  if (isLoggedIn) {
    window.open(window.location.origin + '/' + url, '_self');
  } else {
    window.location.href = prepareLoginUrl(window.location.host + '/' + url);
  }
  //   break;
  // default:
  //   window.location.href = window.location.host + '/' + url;
  //   break;
  // }
};

const prepareArticleNavigation = (articleCategoryId, gameId, websiteUrl) => {
  const article = {
    articleCategoryId,
    gameId,
    websiteUrl,
  };
  if (article.gameId && article.gameId > 0) {
    let websiteUrl = article.websiteUrl;
    let gameId = article.id;
    let detailUrl = '';
    if (gameId === Game.WEB_GAMEID_TOANDAN3Q || gameId === Game.WEB_GAMEID_GHTUTIEN) {
      let sl = 'tin-tuc';
      if (article.articleCategoryId == Article.EVENT) {
        sl = 'su-kien';
      }
      detailUrl = websiteUrl + '/' + sl + '/' + article.id;
    } else if (gameId === Game.WEB_GAMEID_PHITIEN) {
      detailUrl = websiteUrl + '/' + article.slug + '.html';
    } else if (gameId === Game.WEB_GAMEID_NGUTUYET) {
      detailUrl = websiteUrl + '/detailnews?id=' + article.id + '&type=4';
    } else {
      detailUrl = websiteUrl + '/detail?id=' + article.id + '&type=0';
    }
    window.open(detailUrl, '_blank');
  }
};

const prepareNavigationWithToken = (url = '') => {
  let accessToken = $('#accessToken').val();
  if (isLoggedIn) {
    window.open(url + '?accessToken=' + accessToken, '_blank');
  } else {
    window.open(url, '_blank');
  }
};

const prepareLoginUrl = (url = '') => {
  const link = `${LOGIN_URL}/?redirectUrl=` + encodeURI(url ? url : window.location.href.replace('https://', '').replace('http://', ''));
  return link;
};

function showCom() {
  showAlert({ htmlContent: 'Coming soon' });
}

const handlePlagameFunc = (webPlayUrl, appStoreUrl, googlePlayUrl, pcDownloadUrl, gameId, websiteUrl) => {
  const game = {
    webPlayUrl,
    appStoreUrl,
    googlePlayUrl,
    pcDownloadUrl,
    gameId,
    websiteUrl,
  };
  console.log('gameInfo', game);
  const comingSoonMsg = 'Coming soon';
  var md = new MobileDetect(window.navigator.userAgent);
  const isMobile = md.os() ? true : false;
  const isIOS = ['iOS', 'iPadOS'].includes(md.os()) ? true : false;
  const isAndroid = !isIOS;
  const isBrowser = !isMobile;
  console.log('isMobile', isMobile);
  console.log('isIOS', isIOS);
  console.log('isAndroid', isAndroid);
  console.log('isBrowser', isBrowser);
  let accessToken = $('#accessToken').val() ? $('#accessToken').val() : '';
  if (isMobile && !game.webPlayUrl) {
    if (isIOS) {
      console.log('IOS click');
      if (game.appStoreUrl) {
        openUrlTargetBlank(game.appStoreUrl);
      } else {
        showAlert({ htmlContent: comingSoonMsg });
      }
    }
    if (isAndroid) {
      console.log('Android click');
      if (game.googlePlayUrl) {
        openUrlTargetBlank(game.googlePlayUrl);
      } else {
        showAlert({ htmlContent: comingSoonMsg });
      }
    }
  } else if (isMobile && game.webPlayUrl) {
    if (game.webPlayUrl) {
      const defaultWebPlay = game.webPlayUrl;
      game.webPlayUrl = game.webPlayUrl + '?accessToken=' + accessToken;
      showConfirm({
        htmlContent: 'Bạn có thể trải nghiệm Game bằng cách cài đặt về thiết bị hoặc chơi trực tiếp trên web',
        confirmButtonText: 'Cài Đặt',
        cancelButtonText: 'Web',
      }).then((result) => {
        if (result === null) {
          return;
        }
        if (result) {
          if (isBrowser) {
            if (game.pcDownloadUrl && game.pcDownloadUrl !== defaultWebPlay) {
              openUrlTargetSelf(game.pcDownloadUrl);
            } else if (game.webPlayUrl) {
              openUrlTargetBlank(game.webPlayUrl);
            } else {
              showAlert({ htmlContent: comingSoonMsg });
            }
          }
          if (isIOS) {
            if (game.appStoreUrl && game.appStoreUrl !== defaultWebPlay) {
              openUrlTargetBlank(game.appStoreUrl);
            } else if (game.webPlayUrl) {
              openUrlTargetBlank(game.webPlayUrl);
            } else {
              showAlert({ htmlContent: comingSoonMsg });
            }
          }
          if (isAndroid) {
            if (game.googlePlayUrl && game.googlePlayUrl !== defaultWebPlay) {
              openUrlTargetBlank(game.googlePlayUrl);
            } else if (game.webPlayUrl) {
              openUrlTargetBlank(game.webPlayUrl);
            } else {
              showAlert({ htmlContent: comingSoonMsg });
            }
          }
        } else {
          if (game.webPlayUrl) {
            openUrlTargetBlank(game.webPlayUrl);
          } else {
            showAlert({ htmlContent: comingSoonMsg });
          }
        }
      });
    } else if (game.pcDownloadUrl) {
      openUrlTargetSelf(game.pcDownloadUrl);
    } else {
      showAlert({ htmlContent: comingSoonMsg });
    }
  } else if (isBrowser && game.googlePlayUrl == '' && game.websiteUrl != '') {
    window.open(game.websiteUrl, '_blank');
  } else if (game.googlePlayUrl != '') {
    openQRModal(gameId);
  } else {
    showAlert({ htmlContent: comingSoonMsg });
  }
};

const openQRModal = async (gameId) => {
  const response = await callTemplate(`/game/qr?gameId=${gameId}`, 'GET', null);
  console.log(response);
  const modal = getById('qrModal');
  if (!modal) {
    $('body').append(response);
    $('#qrModal').modal('show');
  } else {
    $(modal).remove();
    $('body').append(response);
    $('#qrModal').modal('show');
  }
};

const openUrlTargetBlank = (link) => {
  window.open(link, '_blank');
};

const openUrlTargetSelf = (link) => {
  window.open(link, '_self');
};
const logout = () => {
  deleteCookie(YG_COOKIE);
  const cookie = getCookie(YG_COOKIE);
  window.location.href = '/account/logout';
};

const getCookie = (name) => {
  var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
  if (match) return match[2];
};
const setCookie = (name, value, duration = 0) => {
  var expireTime = 0;
  if (duration > 0) {
    var now = new Date();
    var time = now.getTime();
    expireTime = time + duration;
    now.setTime(expireTime);
    document.cookie = name + '=' + value + '; Path=/;Expires=' + now.toUTCString();
  } else {
    document.cookie = name + '=' + value + '; Path=/';
  }
};
const deleteCookie = (name) => {
  document.cookie = name + '=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
};

// const handleUserData = () => {
//   deleteCookie(YG_COOKIE);
//   isLoggedIn = document.getElementById('isLoggedIn').value === 'true' ? true : false;
//   SingleSignOn();
  // const ygCookie = getCookie(YG_COOKIE);
  // USER_COOKIE = ygCookie;
  // isLoggedIn =
  //   document.getElementById('isLoggedIn').value === 'true' ? true : false;
  // console.log('User is logged in: ' + isLoggedIn);
  // if (isLoggedIn === false) {
  //   deleteCookie(YG_COOKIE);
  // } else {
  //   const accessToken = document.getElementById('accessToken').value;
  //   if (ygCookie !== accessToken) {
  //     setCookie(YG_COOKIE, accessToken);
  //   }
  // }
// };


function showComingSoon() {
  showAlert({ htmlContent: 'Coming soon' });
}

function showLoading() {
  $.LoadingOverlay('show');
}

function startLoading() {
  $.LoadingOverlay('show');
}

function hideLoading() {
  $.LoadingOverlay('hide');
}

function stopLoading() {
  $.LoadingOverlay('hide');
}

async function SingleSignOn() {}
