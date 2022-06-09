/*home page*/
var sendPostRequest = function(button) {
	let form = button.closest('form');
	let csrf = form.querySelector("input[name='_token']").value;
	console.log(csrf);
	fetch("/home", {
		method: "POST",
		headers: {
			'X-CSRF-TOKEN': csrf
		}
	});
	return false;
}
/*home page end*/
/*inhouse page*/
if( false ){
  window.onload = function() {
    /*nav menu component*/
    var elems = document.querySelectorAll("section[data-component='nav-menu'] .sidenav");
    var instances = M.Sidenav.init(elems, {
      'inDuration': 500
    });

    /*picture hover component*/
    let img_src;
    let pic;
    let div_collection = document.querySelectorAll("section[data-component='inside-website'] article > div");
    for(div of div_collection){
      // pic = new Image();
      // pic.src = div.dataset['img'];
      // console.log(pic)

      div.addEventListener('mouseenter', function(e) {
      for(item of div.closest("article").children){
        item.classList.remove('active')
      }
      img_src = e.target.dataset['img'];
      e.target.classList.add('active')
        setTimeout(function() {
            e.target.closest("article").style.background = `url(${img_src})`;
        }, 250)
      });
    }
    /*img helper*/
    // [].forEach.call(document.querySelectorAll('img[data-src]'), function(img) { img.setAttribute('src', img.getAttribute('data-src')); img.onload = function() { img.removeAttribute('data-src'); }; });
  };
}
if ( false ) {
  document.querySelectorAll("section[data-component='form'] form, section[data-component='form-lead'] form").forEach(function(v, k) {
    v.addEventListener("submit", function(e) {
      e.preventDefault();
      let form = e.target;
      let inputs = e.target.querySelectorAll("input[name]");
      let textarea = e.target.querySelectorAll("textarea[name]");
      var fd = new FormData();
      var errorLog = [];
      document.querySelector(".helper-text").dataset.status = 'hidden';
      
        inputs.forEach(function(v, k){
          if(v.value !== ""){
            fd.append(v.getAttribute("name"), v.value);
          }else{
            let status = v.parentNode.querySelector(".helper-text").dataset.status;
            if(status == 'hidden'){
              v.parentNode.querySelector(".helper-text").dataset.status = 'visible';
              errorLog.push( exit(v.parentNode.querySelector(".helper-text")) );
            }
          }
        });
      
        textarea.forEach(function(v, k){
          if(v.value !== ""){
            fd.append(v.getAttribute("name"), JSON.stringify(v.value));
          }
        });

      switch(errorLog.length){
        case 0:
          let response = fetch('/form-site-tg.php', {
            method: 'POST',
            body: fd
          }).then(function(response) {
            form.reset();
            alert("Заявку приняли. Отпишемся в ближайшее время.");
          });
        break;
        default:
          console.log(errorLog);
        break;
      }
    });
  })
  function exit(element) {
    return element;
  }
}
/*inhouse page end*/