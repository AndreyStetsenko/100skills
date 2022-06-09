/*
 *
 * Функция плавного скрола
 *
 */
var smoothScrollTo = function(event, id){
    event.preventDefault();
    document.getElementById(id).scrollIntoView({
        behavior: 'smooth'
    });
}
window.onbeforeunload = function () {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
}