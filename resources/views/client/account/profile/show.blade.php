<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body>
    <!-- <x-client.form.form-lead-component /> -->
    <x-client.header.header-lk-component />

   <main class="main"> 
        <div class="container">
            <div class="row m-block">
                <div class="col-9">
                    <h1 class="mt-5">Мой профиль</h1>
                </div>
                <div class="col-3">

                </div>
            </div>
            <nav class="site-nav lk-nav mt-5 m-none">
                <ul>
                    <li><a href="/account/profile" <?php if ( Route::current()->uri == "account/profile") print("class='current-page'");?>>Аккаунт</a></li>
                    <li><a href="/account/courses" <?php if ( Route::current()->uri == "account/courses") print("class='current-page'");?>>Мои курсы</a></li>
                    <li><a href="/account/actions" <?php if ( Route::current()->uri == "account/actions") print("class='current-page'");?>>Мои акции</a></li>
                    <li><a href="/account/tarif" <?php if ( Route::current()->uri == "account/tarif") print("class='current-page'");?>>Тарифы и оплата</a></li>
                </ul>
            </nav>


            <section class="section-last">
                <h1 class="mt-5">
                    <?=(isset($form["h1"]) && !is_null($form["h1"]) && !empty($form["h1"]) ? $form["h1"] : "Информация о курсе" ) ?>
                </h1>
                    <?php if ( isset($messages) && !empty($messages) ): ?>
                        <ul data-component="toast" class="toast-forever show">
                            <li><?=$messages ?></li>
                        </ul>
                    <?php endif ?>
                    @if($errors->any())
                    <ul data-component="toast" class="toast-forever show">
                        <li><?=$errors->first() ?></li>
                    </ul>
                    @endif
                    <ul data-component="toast"></ul>
                    <form action="/account/profile/<?=$form['id'] ?>" 
                          data-component="account-course-form"
                          onsubmit="event.preventDefault(); submitProfileUpdateForm();" 
                          > 
                          @csrf
                          <!-- onsubmit="event.preventDefault(); submitAccounUpdateForm();" -->
                        <input type="hidden" name="id" value="<?=$form['id'] ?>" />
                        <div class="row">
                            <div class="col-md-7 row">
                                <div class="col-md-12 mb-4">
                                    <label>Наименование</label>
                                    <input type="text" 
                                        value="<?=(isset($form["title"]) && !is_null($form["title"]) && !empty($form["title"]) ? $form["title"] : "" ) ?>"
                                        name="title" class="uk-input" placeholder="Введите наименование" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Телефон</label>
                                    <input type="text" 
                                        value="<?=(isset($form["phone"]) && !is_null($form["phone"]) && !empty($form["phone"]) ? $form["phone"] : "" ) ?>"
                                        name="phone" class="uk-input" placeholder="Телефон" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Email</label>
                                    <input type="text" 
                                        value="<?=(isset($form["email"]) && !is_null($form["email"]) && !empty($form["email"]) ? $form["email"] : "" ) ?>"
                                        name="email" class="uk-input" placeholder="Email" />
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label>Краткое описание</label>
                                    <textarea data-component='tinymce' class="uk-textarea" 
                                              name="body_short" 
                                              id="body_short" 
                                              rows="8" placeholder="Введите краткое описание курса"><?=(isset($form["body_short"]) && !is_null($form["body_short"]) && !empty($form["body_short"]) ? $form["body_short"] : "" ) ?></textarea>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <section data-component="adress-search"> 
                                        <label>Адрес</label>
                                        <br />
                                        <input type="hidden" name="adress" value="<?=$form['adress'] ?>">
                                        <input type="hidden" name="latitude" value="<?=$form['latitude'] ?>">
                                        <input type="hidden" name="longitude" value="<?=$form['longitude'] ?>">
                                        <input type="text"
                                               data-name="adress"
                                               autocomplete="off" 
                                               class="uk-input"
                                               value="<?=$form['adress'] ?>" 
                                               placeholder="Город"
                                               oninput="event.preventDefault(); searchAdress()">
                                        <br />
                                        <ul class="uk-list">
                                            <?php if ( is_null($form['adress']) ): ?>
                                                <li>
                                                    Адрес не найден, уточните запрос
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                    </section>
                                </div>
                                <div class="col-md-12">
                                </div>
                                <div class="col-md-4 ">
                                    <button type="submit" class="btn btn-red btn-icon">
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                                        </svg>
                                        <?=(isset($template["button"]) && !is_null($template["button"]) && !empty($template["button"]) ? $template["button"] : "Сохранить информацию" ) ?>
                                        
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-4 offset-md-1">
                                <div id="image-preview" style="height: 350px; width: 350px;"></div>

                                <div class="mt-4" uk-form-custom>
                                    <?php # dd(__METHOD__, $form['gallery']); ?>
                                    <input type="hidden" name="gallery" value='<?=$form['gallery'] ?>' data-component="gallery">
                                    <input type="hidden" name="gallery_src" value='<?=$form['gallery_src'] ?>'>
                                    <input id="image-upload" onchange="event.preventDefault(); addGallery(event);" type="file">
                                    
                                    <button class="btn btn-red btn-icon" type="button" tabindex="-1">
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                                        </svg>
                                        Загрузить изображение
                                    </button>
                                </div>


                                  <script type="text/javascript">
                                    $(document).ready(function() {
                                      $.uploadPreview({
                                        input_field: "#image-upload",   // Default: .image-upload
                                        preview_box: "#image-preview",  // Default: .image-preview
                                        label_field: "#image-label",    // Default: .image-label
                                        label_default: "Choose File",   // Default: Choose File
                                        label_selected: "Change File",  // Default: Change File
                                        no_label: false                 // Default: false
                                      });
                                      let src;
                                      // src = document.querySelector(`[type="hidden"][name="gallery_src"]`).value;
                                      src = `<?=$form['gallery_src'] ?>`;
                                      src = (src.length != 0) ? src : "/resources/img/no-photo.png";
                                      document.querySelector(`#image-preview`).style.backgroundImage = `url('${src}')`;
                                      document.querySelector(`#image-preview`).style.backgroundSize = `cover`;
                                      document.querySelector(`#image-preview`).style.backgroundPosition = `center`;
                                    });
                                    </script>
                            </div>
                        </div>
                    </form>
            </section>
        </div>
    </main>

    <x-client.footer.footer-component />
    <script src="https://cdn.tiny.cloud/1/<?=config("app.tiny_mce_key") ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        window.tinyMCE.init({
            selector: "[data-component='tinymce'][name='body_short']",
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            height : 400,
        });
        /*

        tinyMCE.get('body_short_edit').setContent(item_prepared.body_short);
        request_data.body_short = tinyMCE.get("body_short").getContent();

        */

    </script>
</body>
</html>