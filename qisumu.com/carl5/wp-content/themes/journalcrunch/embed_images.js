// JavaScript Document
function comment_image() {
  var URL = prompt('在这里输入图片url地址:');
  if (URL) {
    document.getElementById('comment').value = document.getElementById('comment').value + '[img]' + URL + '[/img]';
  }
}