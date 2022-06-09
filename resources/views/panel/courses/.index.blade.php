<!DOCTYPE html>
<html lang="en">
<head>
    <x-panel.head.head-component />
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-200">
        <x-panel.header.header-component />
        <x-panel.nav.nav-component />

        <!-- Page Content -->
        <main id="app" v-cloak data-module='pages'>
            <section data-component="item-list">
                <div row>
                    <article>
                        <div>
                            Управление разделом "Меню процедур и ритуалов"
                        </div>
                    </article>
                </div>
                <div row>
                    <article>
                        <div class="row">
                            <div class="col s12">
                                <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Основная информация:</h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col s12">
                                Информация появится позже.
                            </div>
                        </div>
                    </article>
                </div>
                <div row>
                    <article>
                        <div class="row" style="margin: 0 0 0 0;">
                            <div class="col s12">
                                <a href="#!" class="waves-effect waves-green btn-flat right" @click.prevent="updateRequest($event)" style="border: 1px solid #e0e0e0;">Сохранить изменения</a>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
            <section data-component='sub-modal' class="text-preset">
                <div id="text-preset" class="modal modal-fixed-footer bottom-sheet">
                    <div class="modal-content">
                        <h4>Блок с текстом и изображением</h4>
                        <blockquote>
                            Добавление, редактирование содержимого
                        </blockquote>
                        <div class="row">
                            <div class="input-field col s12">
                                <input type="text" 
                                       v-model="presets.edit.title"
                                       placeholder="Заголовок" 
                                       autocomplete="off">
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <textarea 
                                    id="preset-page-text-block" 
                                    name="preset-page-text-block" 
                                    data-component='tinymce' 
                                    placeholder="Текстовое описание" 
                                    required='required'
                                    ></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <section data-component="preset-page-image-list" double>
                                    <blockquote>
                                        Добавление, редактирование фотографий
                                    </blockquote>
                                    <div class="list" >
                                        <ul v-if='presets.edit.list && presets.edit.list.length'>
                                            <li v-if="presets.edit.list[0] != null">
                                                <div img default>
                                                    <img v-bind:src="presets.edit.list[0].src">
                                                </div>
                                                <div buttonset>
                                                    <div class="btn file-field" disabled style="position: relative;">
                                                        <span><i class="material-icons">add</i></span>
                                                        <input disabled type="file">
                                                        <input class="file-path validate" type="hidden">
                                                    </div>
                                                    <button class="btn remove-button" @click.prevent='removePresetGalleryItemRequest($event, presets.edit.list[0])'>
                                                        <i class="material-icons right">clear</i>
                                                    </button>
                                                </div>
                                            </li>
                                            <li v-if="presets.edit.list[0] == null">
                                                <div img default>
                                                    <i class="material-icons">add_a_photo</i>
                                                </div>
                                                <div buttonset>
                                                    <div class="btn file-field" style="position: relative;">
                                                        <span><i class="material-icons">add</i></span>
                                                        <input type="file" @change.prevent="addPresetGalleryItem($event)">
                                                        <input class="file-path validate" type="hidden">
                                                    </div>
                                                    <button class="btn remove-button" disabled @click.prevent>
                                                        <i class="material-icons right">clear</i>
                                                    </button>
                                                </div>
                                            </li> 
                                        </ul>
                                        <ul v-else>
                                            <li>
                                                <div img default>
                                                    <i class="material-icons">add_a_photo</i>
                                                </div>
                                                <div buttonset>
                                                    <div class="btn file-field" style="position: relative;">
                                                        <span><i class="material-icons">add</i></span>
                                                        <input type="file" @change.prevent="addPresetGalleryItem($event)">
                                                        <input class="file-path validate" type="hidden">
                                                    </div>
                                                    <button class="btn remove-button" disabled @click.prevent>
                                                        <i class="material-icons right">clear</i>
                                                    </button>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </section>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="modal-footer">
                        <!-- modal-close -->
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="editPreset($event, 'preset-page-text-block')">Сохранить</a>
                        <a href="#!" class="modal-close waves-effect waves-blue btn-flat" @click.prevent>Закрыть</a>
                        <!-- <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent='addFlatLayout()'>Добавить</a> -->
                        <!-- <a href="#!" class="modal-close waves-effect waves-green btn-flat">Сохранить</a> -->
                    </div>
                </div>
            </section>
        </main>
    </div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdn.tiny.cloud/1/qespi14zyov8h6lvcaqartp18vkl12sdk4x0nk80kl23s9oi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

</script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            csrf: "{!! csrf_token() !!}",
            items: [],
            page: {
                id: "",

                meta_title: "",
                meta_description: "",
                meta_keywords: "",

                body: "",

                presets: [],
                
            },
             presets: { 
                /* пресеты - это блоки страниц, которые заполняются пользовательским контентом, встраиваются в страницу и используют единые элементы для редактирования (textarea etc.)  */
                list: [], /* пресеты для блоков страниц - информация о доступных блоках */
                filled: {
                    /* пресеты заполненные информацией */
                    
                }, 
                /* добавляем редактируемый пресет для управления контентом: добавление текста, фото и пр. */
                edit: {
                    id: null,
                    hash: null,
                    list: [], /* список галереи */
                    content: '', /* текстовые контент */
                },
            }, 
        },
        created: function(){
            /* инициализация tiny окна: сео-текст на главной */
            window.tinyMCE.init({
                selector: "[data-component='tinymce']#body",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            });
            window.tinyMCE.init({
                selector: "[data-component='tinymce']#preset-page-text-block",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            });

        },
        mounted: function () {
            /* назначаем основные поля pages */
            this.page.id = this.items.id;

            this.page.meta_title = this.items.meta_title;
            this.page.meta_description = this.items.meta_description;
            this.page.meta_keywords = this.items.meta_keywords;
            
            this.page.body = this.items.body;

            this.page.presets = (this.items.presets == null || this.items.presets.length == 0) ? [] : this.items.presets;



        },
        computed: {
            todayDate: function(){
                let d = ('0' + new Date().getDate()).slice(-2);
                let y = new Date().getFullYear();
                let mo =  ('0' + new Date().getMonth()+1).slice(-2);
                let m = (new Date().getMinutes()<10?'0':'') +  new Date().getMinutes();
                let h = new Date().getHours();
                return `${d}.${mo}.${y}`;
            },
            /* список пресетов выбранного объекта */
            presetSortList: function(){
                if ( this.page == null ) {
                    return;
                }
                function compare(a, b) {
                    if (a.sort < b.sort){
                        return -1;
                    }
                    if (a.sort > b.sort){
                        return 1;
                    }
                    return 0;
                }
                /* вернем */
                return this.page.presets.sort(compare);
            },
        },
        methods: {
            /* работа с атрибутами select */
            /**
             * @param element - выбранный select
             * @param timeout - таймаут после которого атрибут будет возвращен
             */
            addAttirbute: function(element, attibute = 'disabled', timeout = null) {
                if ( timeout ) {
                    setTimeout(function() {
                        element.setAttribute('disabled', 'disabled');
                    }, timeout);

                }else{
                    element.setAttribute('disabled', 'disabled');
                }
            },
            removeAttirbute: function(element, attibute = 'disabled', timeout = null) {
                if ( timeout ) {
                    setTimeout(function() {
                        element.removeAttribute('disabled');
                    }, timeout);

                }else{
                    element.removeAttribute('disabled');

                }
            },
            /*
             *
             * @param date - string, вида 11/11/2001 
             *
             * преобразует строку вида аргумента в new Date JS
             *
             */
            inputDate: function(date){
                let date_array = date.split(".");
                let datetime = new Date(date_array[2], (date_array[1] - 1), date_array[0]);
                let d = ('0' + datetime.getDate()).slice(-2);
                let y = datetime.getFullYear();
                let mo =  ('0' + datetime.getMonth()+1).slice(-2);
                let m = (datetime.getMinutes()<10?'0':'') +  datetime.getMinutes();
                let h = datetime.getHours();
                return `${y}-${mo}-${d}`;
            },
            /*
             *
             * @param message - сообщение, которое будет показано
             *
             * выводит сообщение в виде всплывающей подсказки
             *
             */
            showToast: function(message){
                M.toast({html: message});
            },
            /*
             *
             * @param message - сообщения, которое будет показано
             *
             * выводит сообщения в виде всплывающей подсказки
             *
             */
            showToasts: function(messages){
                let vm = this;
                let step = 1;
                for( let message of messages ){
                    setTimeout(function(argument) {
                        vm.showToast(message);
                    }, 250*step);
                    step = step + 1;
                }
            },     
            /*
             *
             * @param modal - id модального окна
             *
             * инициализирует модальное окно и открывает его
             *
             */
            initModal: function(modal){

                var elems = document.querySelectorAll(".modal");

                var instances = M.Modal.init(elems, {
                    dismissible: false,
                });
                var instance = M.Modal.getInstance(document.getElementById(modal));
                instance.open();
            },
            openModal: function(modal){
                var instance = M.Modal.getInstance(document.querySelector(modal));
                instance.open();
            },
            closeModal: function(modal){
                var instance = M.Modal.getInstance(document.getElementById(modal));
                try{
                    instance.close()
                }catch(e){

                }
            },       
            /*
             *
             * @param item - элемент
             *
             * из объекта, который использует экземпляр Vue создает объект, который воспринимает controller
             *
             */
            prepareInputObjectToRequest: function(){
                var item_prepared = {
                    id: this.page.id,
                    
                    body: this.page.body,
                    

                    meta_title: this.page.meta_title,
                    meta_description: this.page.meta_description,
                    meta_keywords: this.page.meta_keywords,

                    presets: this.page.presets,
                };
                return item_prepared;
            },
            /*
             *
             * @param item - элемент
             *
             * из объекта, который воспринимает controller создает объект, который использует экземпляр Vue
             *
             */
            prepareInputObjectToView: function(item){
                var item_prepared = {
                    id: item.id,

                    meta_title: item.meta_title == null ? "" : item.meta_title,
                    meta_description: item.meta_description == null ? "" : item.meta_description,
                    meta_keywords: item.meta_keywords == null ? "" : item.meta_keywords,

                    body: item.body == null ? "" : item.body,

                    presets: item.presets,

                };

                return item_prepared;
            },
            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * показывает форму для редактирования
             * обновляет задание
             * показывает уведомление о результате
             *
             */
            updateRequest: function(event){
                var vm = this;
                var request_data = this.prepareInputObjectToRequest();
                request_data.body = tinyMCE.get('body').getContent();
                
                
                var item_id = request_data.id;
                fetch(`/component/index-page/${item_id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.csrf
                    },
                    method: 'PUT',
                    body: JSON.stringify(request_data)
                })
                .then(function(response) {
                    if( response.status != 200 && response.status != 422 ){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        /* если ответ не 422 - ответ от валидатора Request */
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                    }
                    return response.json();
                })
                .then(function(data){
                    if( data.errors != null ){
                        vm.showToast(`Ошибка создания.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }
                    }else if( data.result != null ){
                        vm.page = vm.prepareInputObjectToView(data['result']['item']);
                        vm.showToast(`Информация главной страницы обновлена.`);
                    }
                });
            },
            /*
             *
             * добавляем в список выбранного объекта фотографию планировки: запрос
             *
             */
            addGalleryItems: function (event, block_id) 
            {
                var vm = this;
                var files = event.target.files;
                var formData = new FormData();
                for( file of files ){
                    formData.append("file[]", file);
                }
                vm.showToast(`Начало загрузки файлов...`);
                fetch(`/component/index-page-gallery`, {
                    headers: {
                        "X-CSRF-Token": this.csrf
                    },
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    if( response.status != 200 && response.status != 422 ){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        /* если ответ не 422 - ответ от валидатора Request */
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                    }
                    return response.json();
                    return response.json();
                })
                .then(function(data){
                    if( data.result.status == null ){
                        vm.showToast(`Ошибка загрузки файла.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }

                    }else{
                        vm.addGalleryItemsView(data.result.files, block_id);
                        vm.showToasts([`Файлы галлереи загружены.`, `После сохранения страницы, изображения будут сохранены.`]);
                    }
                    return;
                });
            },
            /**
             *
             * @param int block_id - id блока, куда добавить файл
             * @files - объект ответа от сервера, содержит массив включая для каждого файла ссылку на файл и путь к файлу 
             * 
             * добавляем в список выбранного объекта фотографию планировки: добавление в список
             *
             */
            addGalleryItemsView: function (files, block_id) 
            {
                var vm = this;
                /* обновляем файл в объекте Vue - будет сохранен при сохранении */
                for( file in files ){
                    let tmp_gallery_obj = {
                        src: "/public" + files[file]['path'],
                        url: files[file]['url'],
                        title: files[file]['filename'],
                    }; /* объект, который будет сохранен при обновлении объекта */
                    
                    /* добавим загруженное изображение в соответствующий блок */
                    switch(block_id) {
                        case 1:
                            vm.page.block_1.gallery.push(tmp_gallery_obj);
                        break;

                        case 2:
                            vm.page.block_2.gallery.push(tmp_gallery_obj);
                        break;

                        case 3:
                            vm.page.block_3.gallery.push(tmp_gallery_obj);
                        break;

                        case 4:
                            vm.page.block_4.gallery.push(tmp_gallery_obj);
                        break;
                    }
                }
                return;
            },
            /*
             *
             * @param event - событие
             * @param item - текущий файл
             * @param route - функция универсальная и ожидает маршрут
             *
             * удаляет элемент картинки - галерея и планировка
             * показывает уведомление о результате
             *
             */
            removeGalleryItemRequest: function(event, item, route = null)
            {
                var vm = this;
                if( route == null ){
                    console.log("No route has found - no action will take.")
                    return;
                }
                 if( vm.form.createTask.inputs.id.length == 0 ){
                    /* у объекта не id - удаляется планировка у не созданного объекта */
                    /* удаляем из view */
                    vm.showToast(`Файл ${item.title} удален.`);
                    vm.removeImgItemView(item);
                    return;
                }
                vm.showToast(`Начало удаление файла...`);
                fetch(`/index-page-gallery/${item.id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.csrf
                    },
                    method: 'DELETE',
                    body: JSON.stringify({method: 'remove'})
                })
                .then(function(response) {
                    if( response.status != 200 && response.status != 422){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        /* если ответ не 422 - ответ от валидатора */
                        vm.showToast(`Ошибка на стороне сервера.`);
                        let step = 1;
                        for( let messages of [`Повторите попытку позже и обратитесь к администратору сайта.`] ){
                            setTimeout(function(argument) {
                                vm.showToast(messages);
                            }, 250*step);
                            step = step + 1;
                        }
                    }
                    return response.json();
                })
                .then(function(data){
                    if( data.result.status == null ){
                        var toasts = [`Ошибка удаления файла.`, `Файл был удален или перемещен. Текущая привязака к объекту будет удалена.`];
                        let step = 0;
                        for( let toast in toasts ){
                            setTimeout(function() {
                                vm.showToast(toasts[toast]);
                            }, 250*step);
                            step = step + 1;
                        }
                        /* если произошла ошибка во время удаления файла - его нужно удалить из объекта в любом случае */
                        vm.removeImgItemView(item);
                    }else{
                        vm.showToast(`Файл ${item.title} удален.`);
                        vm.removeImgItemView(item);
                        vm.closeModal("remove-item");
                    }
                });
            },
            /*
             *
             * @param item - фотография
             *
             * удаляет фотографию из текущего объекта
             *
             */
            removeImgItemView: function(item)
            {
                console.log('make it');
                return;
                var vm = this;
                let item_id = vm.form.createTask.inputs.id;
                if ( vm.form.createTask.inputs.id.length == 0 ) {
                    /* если объект не создан - ищем в текущем выбранном объекте совпадения, передаем на удаление и выходим */
                    let c = vm.form.createTask.inputs.gallery.catalog_gallery_list.findIndex(function(value, key){
                        return item.src == value.src;
                    });
                    vm.form.createTask.inputs.gallery.catalog_gallery_list.splice(c, 1);
                    return; 
                } 
                /* ищем item.id - к которой принадлежит gallery */
                let a = this.items.findIndex(function(value, key){
                    return item_id == value.id;
                });
                /* ищем gallery.id - которая была удалена */
                let b = this.items[a].gallery.findIndex(function(value, key){
                    return item.id == value.id;
                });
                this.items[a].gallery.splice(b, 1);
                return;
            },
            /* работа с пресет (preset) */
            /**
             *
             * @param event - событие
             *
             * добавляет блок к новой записи: без сохранения
             *
             */
            addPresetBlock: function(event)
            {
                /* определим доступные типы контента: Текстовый блок (1), Цитата (2), Блок 2 изображения (3), Блок 3 изображения (4) */
                var vm = this;
                var preset;

                /* отключим select на 1 сек для получения разных hash пресетов */
                vm.addAttirbute(event.target, 'disabled');
                
           
                /* сделаем запрос на получение доступных типов контента */
                fetch(`/component/index-page-presets/${event.target.value}`, {
                    headers: {
                        "X-CSRF-Token": this.csrf,
                    },
                    method: 'GET',
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data){
                    /* получили пресеты */

                    /* назначили сортировку */
                    data.sort = vm.page.presets.length;

                    /* добавили в объект */
                    vm.page.presets.push(data);

                    vm.removeAttirbute(event.target, 'disabled', 500);
    
                });
                
                /* после завершения обнуляем select */
                event.target.value = -1; 
            },
            /**
             *
             * @param event - событие
             * @param item - удаляемый пресет
             *
             * удаляет пресет
             *
             */
            removePresetView: function(event, item)
            {
             
                var vm = this;

                if ( item.id == null ) {
                    /* если объект не создан - ищем в текущем выбранном объекте совпадения по HASH, удаляем в списке, в базе обновится после сохранения объекта */
                    let c = vm.page.presets.findIndex(function(value, key){
                        return item.hash == value.hash;
                    });
                    vm.showToasts([`Пресет удален.`]);
                    vm.page.presets.splice(c, 1);
                    return; 
                } else {
                    /* если объект создан - ищем в текущем выбранном объекте совпадения по ID, удаляем в списке, в базе обновится после сохранения объекта */
                    let c = vm.page.presets.findIndex(function(value, key){
                        return item.id == value.id;
                    });
                    vm.page.presets.splice(c, 1);
                    vm.showToasts([`Пресет удален.`, `Изменения вступят в силу после сохранения объекта.`]);
                    return; 
                }
            },
            
             /**
             *
             * @param type - ищем по hash или по id
             * @param id - id\hash
             *
             * среди пресетов выбранной статьи находит редактируемыё
             * возвращает его ключ
             *
             */
            findPreset: function(type, id)
            {
                var vm = this;
                let preset_key;
                for( item in vm.page.presets ){
                    /* найдем нужный пресет */
                    if( vm.page.presets[item][type] == id ){
                        preset_key = item;
                    }
                }
                return preset_key;
            },
            /**
             *
             * @param event - событие
             * @param preset_type - тип пресета, нужен для открытия модалки нужного типа
             * @param preset_hash - hash пресета, добавленного к записи
             * @param preset_id - id пресета, сохраненного в БД
             *
             * открывает запрашиваемое окно для редактирования пресета
             *
             */
            openPresetSubModal: function(event, preset_type = null, preset_hash = null, preset_id = null)
            {
                /* откроем модельной окно для редактирования пресета */
                var vm = this;
                    
                /* обнулим доступные поля перед назначением */
                vm.presets.edit.id = "";
                vm.presets.edit.title = "";
                vm.presets.edit.hash = "";
                vm.presets.edit.list = [];
                tinyMCE.get("preset-page-text-block").setContent("");

                /* найдем пресет в общем списке редактируемого объекта */
                var preset_key;
                if ( preset_id != null ) {
                    /* ищем в существующих пресетах */
                    preset_key = vm.findPreset('id', preset_id);
                }else{
                    /* ищем в новых пресетах */
                    preset_key = vm.findPreset('hash', preset_hash);
                }

                /* добавим данные редактируемого пресета */
                vm.presets.edit.id = preset_id;
                vm.presets.edit.hash = preset_hash;
                vm.presets.edit.title = vm.page.presets[preset_key]['title'] == null ? null : vm.page.presets[preset_key]['title'];
                vm.presets.edit.list = vm.page.presets[preset_key]['list'] == null ? null : vm.page.presets[preset_key]['list'];
                vm.presets.edit.content = vm.page.presets[preset_key]['content'] == null ? "" : vm.page.presets[preset_key]['content'];

                /* если редактируется text-preset и есть контент - необходимо назначить контент для TinyMCE */
                tinyMCE.get("preset-page-text-block").setContent(vm.presets.edit.content);

                /* открыть модальное окно */
                vm.initModal(`${preset_type}`);

                return;
            },
            /**
             *
             * @param event - событие
             * @param preset_id - id блока (не обязательный параметр)
             *
             * редактирует блок текущей страницы: без сохранения
             *
             */
            editPreset: function(event = null, preset_id = null)
            {
                var vm = this;


                /* определяем какому пресету сохраняем контент */
                var preset_key;
                if ( vm.presets.edit.id != null ) {
                    /* ищем в существующих пресетах */
                    preset_key = vm.findPreset('id', vm.presets.edit.id);

                }else{
                    /* ищем в новых пресетах */
                    preset_key = vm.findPreset('hash', vm.presets.edit.hash);
                }


                /* определяем тип контента, добавляемого в пресет */
                var content = "";
                if ( preset_id == 'preset-page-text-block' && tinyMCE.get(preset_id) != null ) {
                    
                    /* получаем контент: заголовок */
                    vm.page.presets[preset_key]['title'] = vm.presets.edit.title;

                    /* получаем контент: текст */
                    content = tinyMCE.get(preset_id).getContent();
                    /* сохраняем контент в пресет */
                    vm.page.presets[preset_key]['content'] = content;

                    /* для закрытия модального окна, укажем верный preset_id */
                    preset_id = "text-preset";


                }else if( preset_id == 'quote-preset' && document.querySelector(`#${preset_id} textarea`) != null ) {
                    
                    /* получаем контент */
                    content = document.querySelector(`#${preset_id} textarea`).value;

                    /* сохраняем контент в пресет */
                    vm.page.presets[preset_key]['content'] = content;
                
                }else if( preset_id == 'two-image-preset' ) {
                    /* сохранение двух картинок: назначаются в объект автоматически */
                    console.log("got 2 images");

                }else if( preset_id == 'three-image-preset' ) {
                    /* сохранение трех картинок: назначаются в объект автоматически */
                    console.log("got 3 images");
                
                }
                /* сообщение об успехе */
                vm.showToast(`Изменения сохранены`);

                /* закроем модальное окно */
                vm.closeModal(preset_id);
                return; 
            },

            /**
             *
             * @param event - событие
             * @param item - текущий файл
             * @param action - направление (выше, ниже)
             *
             * изменяет позицию элемента (сортировку) в списке
             *
             */
            changePositionPreset: function(event, item, action = null)
            {
                var vm = this;

                if( action == null ){
                    console.log("No action has found - no action will be take.")
                    return;
                }
                /* ищем элемент */
                let a;
                if ( item.id == null ) {
                    /* если объект не создан - ищем в текущем выбранном объекте совпадения по HASH */
                    a = vm.page.presets.findIndex(function(value, key){
                        return item.hash == value.hash;
                    });
                } else {
                    /* если объект создан - ищем в текущем выбранном объекте совпадения по ID */
                    a = vm.page.presets.findIndex(function(value, key){
                        return item.id == value.id;
                    });
                }

                /* если элемент не первый - можно изменить его позицию */
                if( a > -1 ){
                    /* изменения в родительских категориях */
                    if( action == '-1' ){
                    /* выполним сортировку, перемещаем назад */
                        if( (a-1) != -1 ){
                            vm.page.presets[a]['sort'] = vm.page.presets[a]['sort'] - 1;
                            vm.page.presets[a-1]['sort'] = vm.page.presets[a]['sort'] + 1;
                        }
                    }else{
                        /* перемещаем вперед */
                        if( vm.page.presets[a+1] != null ){
                            vm.page.presets[a]['sort'] = vm.page.presets[a]['sort'] + 1;
                            vm.page.presets[a+1]['sort'] = vm.page.presets[a]['sort'] - 1;
                        }
                    }
                }
                
                return;
            },

            /**
             *
             * @param event - событие
             * @param preset_id - id блока (не обязательный параметр)
             * @param preset_hash - hash пресета, добавленного к записи
             *
             * отправляет фотографии добавленные в пресет блока с картинками на сервер
             *
             */

            addPresetGalleryItem: function (event) 
            {
                var vm = this;

                var files = event.target.files;
                var formData = new FormData();
                for( file of files ){
                    formData.append("file[]", file);
                }
                vm.showToast(`Начало загрузки файлов...`);

                fetch(`/component/index-page-presets/gallery`, {
                    headers: {
                        "X-CSRF-Token": this.csrf
                    },
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    if( response.status != 200 && response.status != 422){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        /* если ответ не 422 - ответ от валидатора */
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                    }
                    return response.json();
                })
                .then(function(data){
                    if( data.result.status == null ){
                        console.log('Ошибка загрузки файла - сделать обработчик', data);
                        return;
                        vm.showToast(`Ошибка загрузки файла.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }

                    }else{
                        vm.addPresetGalleryItemView(data.result.files);
                        vm.showToasts([`Файлы загружены.`, `После сохранения статьи, изображения будут сохранены.`]);
                    }
                    return;
                });
            },
            /*
             *
             * @files - объект ответа от сервера, содержит массив включая для каждого файла ссылку на файл и путь к файлу 
             * 
             * добавляем в список выбранного объекта фотографию планировки: добавление в список
             *
             */
            addPresetGalleryItemView: function (files) 
            {
                var vm = this;
                /* обновляем файл в объекте Vue - будет сохранен при сохранении */
                for( file in files ){
                    /* объект, который будет сохранен при обновлении объекта */
                    let tmp_gallery_obj = {
                        catalog_index_page_id: vm.page.id,
                        preset_hash: null,
                        src: "/public" + files[file]['path'],
                        url: files[file]['url'],
                        title: files[file]['filename'],
                    }; 
                    /* добавляем */
                    vm.presets.edit.list.push(tmp_gallery_obj);
                }
                return;
            },
            /**
             *
             * @param event - событие
             * @param item - выбранный объект
             *
             * удаляет элемент картинки - галерея и планировка
             * показывает уведомление о результате
             *
             */
            /*функция 2022*/
            removePresetGalleryItemRequest: function(event, item)
            {

                console.log(item);
                return;

                var vm = this;
                if( route == null ){
                    console.log("No route has found - no action will take.")
                    return;
                }
                 if( vm.form.createTask.inputs.id.length == 0 ){
                    /* у объекта не id - удаляется планировка у не созданного объекта */
                    /* удаляем из view */
                    vm.showToast(`Файл ${item.title} удален.`);
                    vm.removeImgItemView(item);
                    return;
                }
                vm.showToast(`Начало удаление файла...`);
                fetch(`${route}${item.id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'DELETE',
                    body: JSON.stringify({method: 'remove'})
                })
                .then(function(response) {
                    if( response.status != 200 && response.status != 422){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        /* если ответ не 422 - ответ от валидатора */
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                    }
                    return response.json();
                })
                .then(function(data){
                    if( data.result.status == null ){
                        var toasts = [`Ошибка удаления файла.`, `Файл был удален или перемещен. Текущая привязака к объекту будет удалена.`];
                        let step = 0;
                        for( let toast in toasts ){
                            setTimeout(function() {
                                vm.showToast(toasts[toast]);
                            }, 250*step);
                            step = step + 1;
                        }
                        /* если произошла ошибка во время удаления файла - его нужно удалить из объекта в любом случае */
                        vm.removeImgItemView(item);
                    }else{
                        vm.showToast(`Файл ${item.title} удален.`);
                        vm.removeImgItemView(item);
                        vm.closeModal("remove-item");
                    }
                });
            },
        },
    })
</script>
<style>
/* высота модалок: здесь стили и при init задаем опции: startingTop и endingTop   */
[data-component="modal"] .modal.modal-fixed-footer {
  height: 85%;
  max-height: 85%;
}
/* styles for gallery items  */
[data-component='gallery-list'] .row .col.s12{
    float: unset;
}
[data-component='gallery-list'] ul{
    display: grid;
    padding: 0 10px 0 10px;
    grid-gap: 15px;
    grid-template-columns: repeat(5, 1fr);
}
/* stylers for presets */
[data-component="block-list-for-page"] .collection-header div {
    display: grid;
    align-items: center;
    text-align: center;
    width: 100%;

    grid-template-columns: max-content auto;
    grid-gap: 20px;
}
[data-component="block-list-for-page"] .collection-header div a{
    width: 100%;
    color: rgb(38, 166, 154);
    transition: .2s ease-out;
}
[data-component="block-list-for-page"] .collection-header:hover a{
    background: #dede; 
    transition: .2s ease-in;
}
[data-component='block-list-for-page'] .collection-header i{
    display: block;
}
[data-component='block-list-for-page'] .collection .collection-item{
    padding: 10px 20px;
}
[data-component='block-list-for-page'] .collection .collection-item > div{
    display: grid;
    align-items: center;
    width: 100%;
    grid-template-columns: auto max-content;
    grid-template-columns: auto max-content max-content;
    grid-gap: 20px;
}
[data-component="preset-page-image-list"] li{
    overflow: visible;
}
[data-component="preset-page-image-list"] div[img][default]{
    /*double*/
    display: grid;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
    box-shadow: 0px 0px 5px 1px rgba(0,0,0,0.14), 0 0 0 0 rgba(0,0,0,0.12), 0 0px 0px 0 rgba(0,0,0,0.2);
    transition: 0.2s ease-in;
}
[data-component="preset-page-image-list"] .list .remove-button {
    position: relative;
    cursor: pointer;
    position: static;
}
[data-component="preset-page-image-list"] .list .btn {
    margin: 10px 0 0 0;
}
[data-component="preset-page-image-list"] [buttonset]{
    display: grid;
    grid-template-columns: max-content max-content;
    align-items: center;
    grid-gap: 10px;
}
[data-component="preset-page-image-list"] [buttonset] .file-field{
    position: relative;
    width: 40px;
    display: grid;
    align-items: center;
    justify-content: center;
    box-shadow: none;
}
[data-component="preset-page-image-list"] [buttonset] .file-field[disabled]{
    background-color: #DFDFDF !important;
    color: #9F9F9F !important;
}
[data-component="preset-page-image-list"] [buttonset] .file-field span{
    height: 100%;
    display: block;
}
[data-component="preset-page-image-list"] [buttonset] input[type='file']{
    top: 0px;
    height: 100%;
}
[data-component="sort-managment"]{
    display: grid;
    grid-template-columns: 50px 50px;
}
[data-component="sort-managment"]{
    display: grid;
    grid-template-columns: 25px 25px;
    grid-gap: 10px;
    align-items: center;
}
[data-component="sort-managment"] a{
    background: rgb(222, 222, 222) none repeat scroll 0% 0%;
    color: rgb(17, 17, 17);
    width: 100%;
    padding: 0px;
    display: grid;
    align-items: center;
    height: 25px;
}
[data-component="sort-managment"] i{
    margin: 0px;
    padding: 0px;
    line-height: 100%;
}
/* preset gallery */

[data-component="preset-page-image-list"] .list > ul {
    display: grid;
    grid-template-columns: repeat(2, max-content);
    grid-gap: 5px 20px;
    padding: 0 0 50px 0;
}
</style>
</body>
</html>
