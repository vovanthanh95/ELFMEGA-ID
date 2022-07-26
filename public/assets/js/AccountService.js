const FETCH_USER_ENDPOINT = '/account/userInfo';

const FETCH_COUNTRY_ENDPOINT = '/get_city';

const LINK_FB_ENDPOINT = '/account/connect_account_fb';
const LINK_GG_ENDPOINT = '/account/connect_account_gg';
const SEND_ACTIVE_EMAIL_ENDPOINT = '/account/active_email';
const SEND_ACTIVE_PHONE_ENDPOINT = '/account/active_phone';
const UPDATE_USER_PROFILE_END_POINT = '/account/update_profile';
const UPDATE_PASSWORD_ENDPOINT = '/account/api/update_password';

async function getUserInfo(accessToken) {
  return await callApi(
    FETCH_USER_ENDPOINT + '?accessToken=' + accessToken,
    'GET',
    null
  );
}

async function getCity() {
  return await callApi(FETCH_COUNTRY_ENDPOINT, 'GET', null);
}

async function linkProfileFB(body) {
  return await callApi(LINK_FB_ENDPOINT, 'GET', body);
}

async function linkProfileGG(body) {
  return await callApi(LINK_GG_ENDPOINT, 'GET', body);
}

async function sendActiveEmail() {
  return await callApi(SEND_ACTIVE_EMAIL_ENDPOINT, 'GET', null);
}

async function sendActivePhone(code) {
  return await callApi(
    `${SEND_ACTIVE_PHONE_ENDPOINT}?code=${code}`,
    'GET',
    null
  );
}

async function updateUserProfile(body) {
  return await callApi(UPDATE_USER_PROFILE_END_POINT, 'GET', body);
}

async function updatePassword(body) {
  return await callApi(UPDATE_PASSWORD_ENDPOINT, 'GET', body);
}
