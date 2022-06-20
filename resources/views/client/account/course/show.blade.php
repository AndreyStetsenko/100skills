<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body data-component="account">
    <!-- <x-client.form.form-lead-component /> -->
    <x-client.header.header-lk-component />

   <main class="main"> 
        <div class="container">
            <div class="row m-block">
                <div class="col-9">
                    <h1 class="mt-5">Мои акции</h1>
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
                    <ul data-component="toast"></ul>
                    <form action="/account/courses/<?=$form['id'] ?>" 
                          data-component="account-course-form"
                          onsubmit="event.preventDefault(); submitCourseUpdateForm();"> 
                          @csrf
                        <input type="hidden" name="id" value="<?=$form['id'] ?>" />
                        <div class="row">
                            <div class="col-md-7 row">
                                <div class="col-md-6 mb-4">
                                    <label>Название курса</label>
                                    <input type="text" value="<?=(isset($form["title"]) && !is_null($form["title"]) && !empty($form["title"]) ? $form["title"] : "" ) ?>" name="title" class="uk-input" placeholder="Введите название курса" />
                                </div>        
                                <div class="col-md-4 mb-4">
                                    <label>Длительность</label>
                                    <input type="text" value="<?=(isset($form["duration"]) && !is_null($form["duration"]) && !empty($form["duration"]) ? $form["duration"] : "" ) ?>" name="duration" class="uk-input" placeholder="3 месяца" />
                                </div>
                                <div class="col-md-2 mb-4">
                                    <label>Стоимость</label>
                                    <input type="number" value="<?=(isset($form['price']) && !is_null($form['price']) && !empty($form['price']) ? $form['price'] : '' ) ?>" name="price" class="uk-input" placeholder="180" />
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label>Ссылка на курс</label>
                                    <input type="text" value="<?=(isset($form["link"]) && !is_null($form["link"]) && !empty($form["link"]) ? $form["link"] : "" ) ?>" name="link" class="uk-input" placeholder="Вставьте ссылку на курс" />
                                </div>
                                <div class="col-md-4 mb-2" uk-tooltip="title: Сертификат после обучения; pos: top-left">
                                    <label>
                                        <input class="uk-checkbox" 
                                               type="checkbox"
                                               name="is_certificate"
<?=(isset($form["is_certificate"]) && ($form["is_certificate"] == 1) ? "checked" : "") ?>
                                               value="1">
                                        &nbsp;
                                        Сертификат
                                    </label>
                                </div>
                                <div class="col-md-4 mb-2" 
                                     uk-tooltip="title: Помощь в трудоустройстве; pos: top-left">
                                    <label>
                                        <input class="uk-checkbox" 
                                               type="checkbox"
                                               name="is_jobable"
<?=(isset($form["is_jobable"]) && ($form["is_jobable"] == 1) ? "checked" : "") ?>

                                               value="1">
                                        &nbsp;
                                        Трудоустройство
                                    </label>
                                </div>
                                <div class="col-md-4 mb-4"
                                     uk-tooltip="title: Обучение ведется онлайн; pos: top-left">
                                    <label>
                                        <input class="uk-checkbox" 
                                               type="checkbox"
                                               name="is_online"
<?=(isset($form["is_online"]) && ($form["is_online"] == 1) ? "checked" : "") ?>
                                               value="1">
                                        &nbsp;
                                        Онлайн
                                    </label>
                                </div>
                                <div class="col-md-4 mb-4"
                                     uk-tooltip="title: Обучение с лицензией; pos: top-left">
                                    <label>
                                        <!-- <input type="hidden" name="is_proffession" value="1" /> -->
                                        <input class="uk-radio" 
                                               type="radio"
                                               name="is_proffession"
                                               selected="selected"
<?=(isset($form["is_proffession"]) && ($form["is_proffession"] == 1) ? "checked" : "") ?>
                                               value="1">
                                        &nbsp;
                                        Профессия
                                    </label>
                                </div>
                                <div class="col-md-4 mb-4"
                                     uk-tooltip="title: Серия учебных занятий; pos: top-left">
                                    <label>
                                        <!-- <input type="hidden" name="is_proffession" value="" /> -->
                                        <input class="uk-radio" 
                                               type="radio"
                                               name="is_proffession"
<?=(isset($form["is_proffession"]) && ($form["is_proffession"] == 1) ? "" : "checked") ?>
                                               value="0">
                                        &nbsp;
                                        Курс
                                    </label>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Категория</label>
                                    <select class="uk-select" name="category_id">
                                        <option value="" disabled selected>Выберите категорию</option>
                                        <option value="-">-</option>
                                        <?php foreach ( (isset($items["category"]) ? $items["category"] : array()) as $key => $value): ?>
                                            <?php if ( $value["id"] == $form["category_id"] ): ?>
                                                <option value="<?=$value["id"] ?>" selected><?=$value["title"] ?></option>
                                            <?php else: ?>
                                                <option value="<?=$value["id"] ?>"><?=$value["title"] ?></option>
                                            <?php endif ?>
                                        <?php endforeach ?>
                                    </select>
                                </div>
        
                                <div class="col-md-12 mb-4">
                                    <label>Краткое описание</label>
                                    <textarea data-component='tinymce' class="uk-textarea" 
                                              name="body_short" 
                                              id="body_short" 
                                              rows="8" placeholder="Введите краткое описание курса"><?=(isset($form["body_short"]) && !is_null($form["body_short"]) && !empty($form["body_short"]) ? $form["body_short"] : "" ) ?></textarea>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label>Чему человек научится:</label>
                                    <textarea data-component='tinymce' class="uk-textarea" rows="8" 
                                              name="body_goals" 
                                              id="body_goals" 
                                              placeholder="Пример: Вы научитесь 1,2,3"><?=(isset($form["body_goals"]) && !is_null($form["body_goals"]) && !empty($form["body_goals"]) ? $form["body_goals"] : "" ) ?></textarea>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <label>Полное описание курса</label>
                                    <textarea data-component='tinymce' class="uk-textarea" rows="8" 
                                              name="body_long" 
                                              id="body_long" 
                                              placeholder="Расскажите больше о курсе. Для кого он, кому подходит и так далее"><?=(isset($form["body_long"]) && !is_null($form["body_long"]) && !empty($form["body_long"]) ? $form["body_long"] : "" ) ?></textarea>
                                </div>
                                <div class="col-md-12 mb-4">
                                    <section data-component="custom-search"> 
                                        <label>Похожие курсы</label>
                                        <br />
                                        <input type="text"
                                               data-name="input"
                                               autocomplete="off" 
                                               class="uk-input" 
                                               placeholder="Наименование"
                                               oninput="event.preventDefault(); searchCourse()">
                                        <br />
                                        <ul class="uk-list" data-ul="search">
                                            <?php if ( empty($form['course']) ): ?>
                                                <li>
                                                    Укажите наименование и выберите курс
                                                </li>
                                            <?php endif ?>
                                        </ul>
                                        <ul class="uk-list" data-ul="selected">
                                            <?php if ( !empty($form['course']) ): ?>
                                                <?php foreach ( (isset($form['course']) ? $form['course'] : array() ) as $key => $value): ?>
                                                    <li data-value="<?=$value["id"] ?>">
                                                        <span><?=$value["title"] ?></span>
                                                        <a onclick="event.preventDefault(); removeCourse(<?=$value["id"] ?>)">удалить</a>
                                                    </li>
                                                <?php endforeach ?>
                                            <?php endif ?>
                                        </ul>
                                    </section>
                                </div>    
                                <div class="col-md-4">
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
                                    <input type="hidden" name="gallery" value='' data-component="gallery">
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
                                      src = document.querySelector(`[type="hidden"][name="gallery_src"]`).value;
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
        window.tinyMCE.init({
            selector: "[data-component='tinymce'][name='body_goals']",
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            height : 400,
        });
        window.tinyMCE.init({
            selector: "[data-component='tinymce'][name='body_long']",
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