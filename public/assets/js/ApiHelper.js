const callApi = async (endpoint, method, body) => {
  body = body ? body : null;
  if (method === 'GET' && body) {
    let params = new URLSearchParams(body).toString();
    endpoint = endpoint + '?' + params;
    body = null;
  }
  return await fetch(endpoint, {
    method, // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
      'Content-Type': 'application/json',
      YG_TOKEN: `${USER_COOKIE ? USER_COOKIE : ''}`,
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body, // body data type must match "Content-Type" header
  }).then(async (response) => {
    let value = '';
    try {
      value = await response.json();
    } catch (err) {
      value = await response;
    }
    return value;
  });
};

const callTemplate = async (endpoint, method, body) => {
  body = body ? body : null;
  if (method === 'GET' && body) {
    let params = new URLSearchParams(body).toString();
    endpoint = endpoint + '?' + params;
    body = null;
  }
  return await fetch(endpoint, {
    method, // *GET, POST, PUT, DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
      'Content-Type': 'application/json',
      YG_TOKEN: `${USER_COOKIE ? USER_COOKIE : ''}`,
    },
    redirect: 'follow', // manual, *follow, error
    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
    body, // body data type must match "Content-Type" header
  }).then(async (response) => response.text());
};
