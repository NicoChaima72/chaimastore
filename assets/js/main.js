var serverUrl = "http://localhost/php/chaimastore/";
var url = window.location.href;
if (url.indexOf(serverUrl) < 0) {
  window.location.href = serverUrl;
}
var nuevaUrl = url.replace(serverUrl, '');
nuevaUrl = nuevaUrl.replace('/', '');
nuevaUrl = nuevaUrl.trim();

if (nuevaUrl.length === 0) {
  window.location.href = `${serverUrl}inicio/`;
}