var serverUrl = "http://chaimastore.atwebpages.com/inicio/";
var url = window.location.href;
console.log(serverUrl);
console.log(url);
if (url.indexOf(serverUrl) < 0) {
  window.location.href = serverUrl;
}
var nuevaUrl = url.replace(serverUrl, '');
nuevaUrl = nuevaUrl.replace('/', '');
nuevaUrl = nuevaUrl.trim();

if (nuevaUrl.length === 0) {
  window.location.href = `${serverUrl}inicio/`;
}