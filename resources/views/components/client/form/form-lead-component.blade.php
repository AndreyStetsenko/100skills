<div id="form-background" onclick="event.preventDefault(); closeModalCallback();"></div>
<section data-compoment="form" class="callback-form">
  <div>
    <a class="close" style="cursor: pointer;" onclick="event.preventDefault(); closeModalCallback();">
      <img src="/public/files/client/images/cross.svg" alt="">
    </a>
    <h3>Оставьте заявку <br> и администратор свяжется <br>c вами в ближайшее время</h3>
    <form action="/">
      <div>
        <input type="text" name="name" placeholder="ФИО" value="" autocomplete="off">
      </div>
      <div>
        <input type="text" name="phone" placeholder="Ваш телефон" value="" autocomplete="off">
      </div>
      <div>
        <input type="submit" value="Перезвоните мне">
      </div>
      <div>
        <p>
          Нажимая кнопку «Перезвоните мне», вы соглашаетесь <br> на <a href="/">политику конфиденциальности</a> и <a href="/">обработку персональных данных</a>
        </p>
      </div>
    </form>
  </div>
</section>
<style>
#form-background {
  visibility: hidden;
  opacity: 0;
  position: fixed;
  height: 100vh;
  width: 100vw;
  background: #333333ab;
  left: 0;
  top: 0;
  z-index: 9;
  margin-top: 0 !important;
  transition: .1s ease-in;
}
[data-compoment="form"] {
  position: absolute;
  z-index: 10;
  padding: 0;
  text-align: center;
  margin: -50px auto 0 auto;
  border-radius: 5px;
  visibility: hidden;
  opacity: 0;
  cursor: pointer;
  box-shadow: 0 0 5px 1px grey;
  transition: all 0.25s ease;
  width: 100%;
  left: 50%;
  transform: translateX(-50%);

  max-width: 1200px;
  max-width: calc(62% - -10px);
}
[data-compoment="form"].visible{
  visibility: visible;
  margin-top: 110px;
  opacity: 1;
}
#form-background.visible{
  visibility: visible;
  margin-top: 110px;
  opacity: 1;
}
[data-compoment="form"] > div {
  background: #fff;
  width: 100%;
  margin: 0 auto;
  padding: 36px 0px 46px 0;
  border-radius: 5px;
}
[data-compoment="form"] a.close{
  cursor: pointer;
  position: absolute;
  right: 19px;
  width: 45px;
  top: 20px;
}
[data-compoment="form"] [src="/public/files/client/images/cross.svg"]{
  width: 100%;
}
[data-compoment="form"] h3{
  padding: 25px 0 0 0;
  font-weight: 600;
  font-size: 30px;
  line-height: 37px;
  text-align: center;
  color: #404540;
  font-family: "Montserrat-SemiBold";
  max-width: 460px;
  margin: 0 auto;
}
[data-compoment="form"] form{
  padding: 50px 0 38px 0;
  max-width: 396px;
  margin: 0 auto;
}
[data-compoment="form"] input[type="text"]{
  padding: 15px 5px 14px 29px;
  margin: 0 0 20px 0;
  width: 100%;
  border: 1px solid #CCCCCC;
  box-sizing: border-box;
  border-radius: 5px;
}
[data-compoment="form"] input[type="submit"]{
  font-size: 14px;
  line-height: 17px;
  display: flex;
  align-items: center;
  text-align: center;
  text-transform: uppercase;
  color: #FAFAFA;
  font-family: "Montserrat-SemiBold";
  background: #404540;
  border: 1px solid #CCCCCC;
  box-sizing: border-box;
  border-radius: 5px;
  width: 100%;
  padding: 16px 0 15px 0;
  margin: 0 0 10px 0;
}
[data-compoment="form"] form p{
  font-size: 12px;
  line-height: 15px;
  color: #797979;
  color: #919191;
  text-align: left;
}
[data-compoment="form"] form a{
  color: #919191;
  text-decoration: underline;
}
@media (max-width: 1279px) {
  [data-compoment="form"]{
    max-width: 724px;
  }
}
@media (max-width: 763px){
  [data-compoment="form"]{
    max-width: 320px;
  }
  [data-compoment="form"] form {
    padding: 36px 0 2px 0;
    max-width: 280px;
  }
  [data-compoment="form"] h3{
    font-size: 18px;
    line-height: 22px;
  }
  [data-compoment="form"].visible,
  #form-background.visible{
    margin-top: 44px;
  }
  [data-compoment="form"] a.close {
    right: 11px;
    width: 41px;
    top: 11px;
  }
  [data-compoment="form"] h3 {
    padding: 14px 0 0 0;
  }
  [data-compoment="form"] form {
    max-width: 280px;
  }
  [data-compoment="form"] form p{
    text-align: center;
  }
  [data-compoment="form"] form p br{
    display: none;
  }
}
</style>
<script>
if( document.querySelector(`[data-compoment="form"]`) !== null ){
  class ClassManager {
    hasClass(ele, cls) {
      return !!ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
    }

    addClass(ele, cls) {
      console.log(ele)
        if (!this.hasClass(ele, cls)) ele.className += " " + cls;
    }

    removeClass(ele, cls) {
        if (this.hasClass(ele, cls)) {
            var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
            ele.className = ele.className.replace(reg, ' ');
        }
    }
    changeClass(ele, cls) {
      console.log(ele)
        if (!this.hasClass(ele, cls)) {
            this.addClass(ele, cls);
        } else {
            this.removeClass(ele, cls);
        }
    }
  }
  var cm = new ClassManager();

  var openModalCallback = function() {
      var background = document.querySelector(`#form-background`);
      var modal = document.querySelector(`[data-compoment="form"]`);

      cm.addClass(background, "visible");
      cm.addClass(modal, "visible");
    };
  var closeModalCallback = function() {
      var background = document.querySelector(`#form-background`);
      var modal = document.querySelector(`[data-compoment="form"]`);

      cm.removeClass(background, "visible");
      cm.removeClass(modal, "visible");
  };
  if ( !1 ) {
    var openModalCallback = function() {
      var background = document.querySelector(`#form-background`);
      var modal = document.querySelector(`[data-compoment="form"]`);
      changeFormVisible(background);
      changeFormVisible(modal);
    };
    var closeModalCallback = function() {
      var background = document.querySelector(`#form-background`);
      var modal = document.querySelector(`[data-compoment="form"]`);
      changeFormVisible(background, 'close');
      changeFormVisible(modal, 'close');
    };
    var changeFormVisible = function (element, action = null) {
      if( action == null ){
        element.style.visibility = 'visible';
        element.style.marginTop = '110px';
        element.style.opacity = '1';
      }else{
        if( action == 'open' ){
          element.style.visibility = 'visible';
          element.style.marginTop = '110px';
          element.style.opacity = '1';
        }else if( action == 'close' ){
          element.style.visibility = 'hidden';
          element.style.marginTop = '-110px';
          element.style.opacity = '0';
        }
      }
    }
  }
}
</script>