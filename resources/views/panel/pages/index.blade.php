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
                            Управление разделом "Меню и контент страницы": спискок
                        </div>
                    </article>
                    <article>
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='addMenuElement($event)'><i class="material-icons left">add</i>Добавить элемент меню</a>
                        </div>
                    </article>
                </div>
                <div row style="padding: 10px 25px;">
                    <ul class="pagination">
                        <li v-bind:class="[pagination.page == 1 ? 'disabled' : 'waves-effect']" class="">
                            <a href="#!" 
                               @click.prevent="pagination.page = pagination.page - 1" 
                               v-bind:disabled="pagination.page == 1" 
                               v-bind:class="[pagination.page == 1 ? 'disabled-pointer-events' : '']" ><i class="material-icons">chevron_left</i></a>
                        </li>                       
                        <li v-for="number in pagination.maxPage" v-bind:class="[pagination.page == number ? 'active' : '']">
                            <a href="#!">@{{ number }}</a>
                        </li>
                        <li v-bind:class="[pagination.page == pagination.maxPage ? 'disabled' : 'waves-effect']">
                            <a href="#!" 
                               @click.prevent="pagination.page++"
                               v-bind:disabled="(pagination.page == pagination.maxPage)"
                               v-bind:class="[(pagination.page == pagination.maxPage) ? 'disabled-pointer-events' : '']"><i class="material-icons">chevron_right</i></a>
                        </li>
                    </ul>
                </div>
                <div row>
                    <article>
                        <div class="list-container">
                            <div class="list-item item-head">
                                <div>
                                    Порядок
                                </div>
                                <div>
                                    Название страницы
                                </div>
                                <div>
                                    Управление
                                </div>
                            </div>
                            <div v-for='item in itemList' :key='item.id'>
                                <div class="list-item item-body">
                                    <div>
                                        <div class="sort-managment">
                                            <a href="!#" @click.prevent="changePositionGallery($event, item, '-1')" class="btn" style="" title='Изменить позицию элемента'>
                                               <i class="material-icons right" style="">arrow_drop_up</i>
                                            </a>                            
                                            <a href="!#" @click.prevent="changePositionGallery($event, item, '1')" class="btn" style="" title='Изменить позицию элемента'>
                                               <i class="material-icons right" style="">arrow_drop_down</i>
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                         @{{ item['title'] }}
                                    </div>
                                    <div name='manage' v-if='item.is_managable'>
                                        <div class="managment-buttonset" data-component="manage">
                                            
                                            <a href="" @click.prevent='editMenuElement($event, item)'><span class="material-icons" title='Редактировать меню'>border_color</span></a>
                                            <a href="" @click.prevent='editItem($event, item)'><span class="material-icons" title='Редактировать страницу'>laptop</span></a>
                                            <a href="#remove-confirm" @click.prevent='removeMenuConfirm($event, item)'><span class="material-icons" title='Удалить страницу'>delete_outline</span></a>
                                            <a href="" @click.prevent='addMenuElement($event, item)'><span class="material-icons" title='Добавить подменю'>add_to_photos</span></a>
                                        </div> 
                                    </div>
                                    <div name='manage' v-else>
                                        <span class="material-icons" title='Не управляемая страница' style="cursor: pointer;">info_outline</span>
                                    </div>
                                </div>
                                <div sub-item>
                                    <div class="list-item item-body" v-for='submenu in item.childs' :key='submenu.id'>
                                        <div>
                                            <div class="sort-managment">
                                                <a href="!#" @click.prevent="changePositionGallery($event, submenu, '-1')" class="btn" style="" title='Изменить позицию элемента'>
                                                   <i class="material-icons right" style="">arrow_drop_up</i>
                                                </a>                            
                                                <a href="!#" @click.prevent="changePositionGallery($event, submenu, '1')" class="btn" style="" title='Изменить позицию элемента'>
                                                   <i class="material-icons right" style="">arrow_drop_down</i>
                                                </a>
                                            </div>
                                        </div>
                                        <div>
                                             @{{ submenu['title'] }}
                                        </div>
                                        <div name='manage' v-if='submenu.is_managable'> 
                                            <div class="managment-buttonset" data-component="manage">
                                                <a href="" @click.prevent='editMenuElement($event, submenu)'><span class="material-icons" title='Редактировать меню'>border_color</span></a>
                                                <a href="" @click.prevent='editItem($event, submenu)'><span class="material-icons" title='Редактировать страницу'>laptop</span></a>
                                                <a href="#remove-confirm" @click.prevent='removeMenuConfirm($event, submenu)'><span class="material-icons" title='Удалить страницу'>delete_outline</span></a>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <span class="material-icons" title='Не управляемая страница' style="cursor: pointer;">info_outline</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
            <section data-component='modal'>
                <div id="create-menu" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>Создание элемента меню</h4>
                      <form action="">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Наименование" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.title" >
                                    <label for="title">Наименование</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="URL (не обязательно, создается автоматически)" 
                                           id="slug" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.slug" >
                                    <label for="slug">URL (не обязательно, создается автоматически)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12" style='margin-top: 0;'>
                                    <div class="switch">
                                        <label>
                                                Скрыто
                                            <input type="checkbox" v-model='form.createTask.inputs.is_visible'>
                                            <span class="lever"></span>
                                                Опубликовано
                                            </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>Пункт меню</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.parent_id">
                                        <option value="" disabled selected>Выберите пункт меню</option>
                                        <option value="0">-</option>
                                        <option v-for='submenu in itemList' :value="submenu.id">@{{ submenu.title }}</option>
                                    </select>
                                </div>
                            </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="createMenuItemRequest($event)">Создать</a>
                        <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
                    </div>
                </div>
            </section>
            <section data-component='modal'>
                <div id="edit-menu" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>Редактирование элемента меню</h4>
                      <form action="">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Наименование" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.title" >
                                    <label for="title">Наименование</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="URL (автоматически)" 
                                           id="slug" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.slug" >
                                    <label for="slug">URL (автоматически)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12" style='margin-top: 0;'>
                                    <div class="switch">
                                        <label>
                                                Опубликовано
                                            <input type="checkbox" v-model='form.createTask.inputs.is_visible'>
                                            <span class="lever"></span>
                                                Скрыто
                                            </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>Пункт меню</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.parent_id">
                                        <option value="" disabled selected>Выберите пункт меню</option>
                                        <option value="0">-</option>
                                        <option v-for='submenu in itemList' :value="submenu.id">@{{ submenu.title }}</option>
                                    </select>
                                </div>
                            </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="updateMenuItemRequest($event)">Сохранить</a>
                        <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
                    </div>
                </div>
            </section>
            <section data-component='modal'>
                <div id="create-task" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>Создание записи</h4>
                      <form action="">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Заголовок" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.title" >
                                    <label for="title">Заголовок</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="URL (автоматически)" 
                                           id="slug" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.slug" >
                                    <label for="slug">URL (автоматически)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Title (meta)" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_title" >
                                    <label for="title">Title (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Description (meta)" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_description" >
                                    <label for="title">Description (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Keywords (meta)" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_keywords" >
                                    <label for="title">Keywords (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>Пункт меню</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.menu_id">
                                        <option value="" disabled selected>Выберите пункт меню</option>
                                        <option value="1">-</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="body-create" 
                                              name="body-create" 
                                              data-component='tinymce' 
                                              placeholder="Содержание страницы" 
                                              required='required' 
                                              v-model="form.createTask.inputs.body"></textarea>
                                </div>
                            </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="createItemRequest($event)">Создать</a>
                        <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
                    </div>
                </div>
            </section>
            <section data-component='modal'>
                <div id="edit-task" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>Редактирование страницы</h4>
                      <form action="">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5>Страница: @{{ this.form.createTask.inputs.title }}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Title (meta)" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_title" >
                                    <label for="title">Title (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Description (meta)" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_description" >
                                    <label for="title">Description (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Keywords (meta)" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_keywords" >
                                    <label for="title">Keywords (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <textarea id="body-edit" 
                                              name="body-edit" 
                                              data-component='tinymce' 
                                              placeholder="Содержание страницы" 
                                              required='required' 
                                              v-model="form.createTask.inputs.body"></textarea>
                                </div>
                            </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="updateItemRequest($event)">Сохранить изменения</a>
                        <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
                    </div>
                </div>
            </section>
            <section data-component='modal' class="remove-item">
                <!-- Модальное окно подтверждение удаления объекта -->
                <div id="remove-item" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <h4>Подтвердить удаление страницы</h4>
                        <article v-if='form.removeItem.inputs.id'>
                            <p>id: @{{ form.removeItem.inputs.id }}</p>
                            <p>заголовок страницы: @{{ form.removeItem.inputs.title }}</p>
                        </article>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="removeItemRequest($event)">Удалить</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Отменить</a>
                    </div>
                </div>
            </section>
            <section data-component='modal' class="remove-menu">
                <!-- Модальное окно подтверждение удаления объекта -->
                <div id="remove-menu" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <h4>Подтвердить удаление пункта меню</h4>
                        <article v-if='form.removeItem.inputs.id'>
                            <p>id: @{{ form.removeItem.inputs.id }}</p>
                            <p>заголовок страницы: @{{ form.removeItem.inputs.title }}</p>
                        </article>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="removeMenuRequest($event)">Удалить</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Отменить</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdn.tiny.cloud/1/<?=config("app.tiny_mce_key") ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

</script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            items: {!! $items !!},
            pagination: {
                page: 1,
                perPage: 15, /* кол-во элементов на странице */
                maxPage: null, /* setPages() - считает и устанавливает кол-во страниц для текущих полученных из БД объектов */
            },
            form: {
                tinymce: null,
                csrf: "{!! csrf_token() !!}",
                user: "{!! Auth::user()->id !!}",
                createTask: {
                    inputs: {},
                    path: {}
                },
                removeItem: {
                    inputs: {},
                }, /* data удаляемого элемента */
            },
        },
        created: function(){
            /* инициализация tiny окна */
            window.tinyMCE.init({
                selector: "#create-task [data-component='tinymce']#body-create",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            });
            window.tinyMCE.init({
                selector: "#edit-task [data-component='tinymce']#body-edit",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            });
            this.setPages();
        },
        mounted: function () {
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
            itemList: function(){
                function compare(a, b) {
                    let result = 0;
                    if( a.sort == null ){
                        a.sort = 0;
                    }
                    if (a.sort < b.sort){
                        result = -1;
                    }
                    if (a.sort > b.sort){
                        result = 1;
                    }
                    /* для подкатегорий */
                    return result;
                }
                function compareChilds(a, b) {
                    /* для подкатегорий */
                    let result = 0;
                    if( a.sort == null ){
                        a.sort = 0;
                    }
                    if (a.sort < b.sort){
                        result = -1;
                    }
                    if (a.sort > b.sort){
                        result = 1;
                    }
                    return result;
                }
                let result = this.items.sort(compare);
                for( item in result ){
                    if( result[item]['childs'].length ){
                        /* сравниваем подкатегории */
                        result[item]['childs'].sort(compare);
                    }
                }
                return result;
                // return this.items.sort(compare).reverse();
                // return this.items;
            },
            paginateItemList () {
                /* работающая пагинация */
                let page = this.pagination.page;
                let perPage = this.pagination.perPage;
                let from = (page * perPage) - perPage;
                let to = (page * perPage);
                return this.itemList.slice(from, to);
            },
        },
        methods: {
            /*
             * считает и устанавливает макс. кол-во страниц пагинации
             */
            setPages () {
                this.pagination.maxPage = Math.ceil(this.itemList.length / this.pagination.perPage) == 0 ? 1 : Math.ceil(this.itemList.length / this.pagination.perPage);
                return;
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
             * @param modal - id плавающей кнопки
             *
             * инициализирует плавающую кнопку
             *
             */
            initFloatButton: function(modal){              
                // var elems = document.querySelectorAll('.fixed-action-btn');
                // var instances = M.FloatingActionButton.init(elems, options);
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
                    preventScrolling: false,
                    dismissible: !1,
                    startingTop: "2%",
                    endingTop: "6%"
                });
                var instance = M.Modal.getInstance(document.getElementById(modal));
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
             * @param item - выбранный элемент
             *
             * добавляет подпункт
             *
             */
            addMenuElement: function(event, item = null){
                this.form.createTask.inputs = {
                    id : "",
                    parent_id: 0,
                    title : "",
                    slug : "",
                    is_visible : 1,
                    pages : null,
                };
                if( item != null ){
                    this.form.createTask.inputs.parent_id = item.id;
                }
                /* при открытии модального окна - обновляем значение tiny */
                tinyMCE.get('body-create').setContent('');
                this.initModal("create-menu");
            },
            /*
             *
             * @param item - выбранный элемент
             *
             * редактирует пункт меню
             *
             */
            editMenuElement: function(event, item){
                this.form.createTask.inputs = {};
                this.form.createTask.inputs = this.prepareMenuObjectToView(item);
                this.initModal("edit-menu");
            },
            /*
             *
             * @param item - текущая задача
             *
             * открывает форму для редактирования задачи
             *
             */
            createItem: function(event){
                /* для примера используем данные - в реальности используем приравнивание к пустому объекту {} */
                this.form.createTask.inputs = {
                    id: '',
                    menu_id: '',
                    title: '',
                    slug: '',
                    is_visible: '1',
                    body: '',
                    meta_title: '',
                    meta_description: '',
                    meta_keywords: '',
                };
                /* при открытии модального окна - обновляем значение tiny */
                tinyMCE.get('body-create').setContent('');
                this.initModal("create-task");
            },
            /*
             *
             * @param item - текущая задача
             *
             * открывает форму для редактирования задачи
             *
             */
            editItem: function(event, item){
                this.form.createTask.inputs = {};
                
                var item_prepared = this.prepareInputObjectToView(item.pages);
                this.form.createTask.inputs = item_prepared;
                this.form.createTask.inputs.menu_id = item.id;
                this.form.createTask.inputs.title = item.title;


                /* при открытии модального окна - обновляем значение tiny */
                tinyMCE.get('body-edit').setContent(item_prepared.body);


                this.initModal("edit-task");
            },
            /*
             *
             * @param item - текущая задача
             *
             * открывает форму для подтверждения удаления
             *
             */
            removeItemConfirm: function(event, item){
                this.form.removeItem.inputs = {};
                this.form.removeItem.inputs = JSON.parse(JSON.stringify(item));
                this.initModal("remove-item");
            },
            /*
             *
             * @param item - пункт меню
             *
             * открывает форму для подтверждения удаления
             *
             */
            removeMenuConfirm: function(event, item){
                this.form.removeItem.inputs = {};
                this.form.removeItem.inputs = JSON.parse(JSON.stringify(item));
                this.initModal("remove-menu");
            },
            /*
             *
             * @param item - текущая задача
             *
             * удаляет текущую задачу из массива view
             *
             */
            removeItem: function(item){
                let a = this.items.findIndex(function(value, key){
                    return item == value.id;
                });
                this.items.splice(a, 1)
            },
            /*
             *
             * @param item - текущая задача
             *
             * добавляет новую задачу в массив
             *
             */
            insertItem: function(item){
                this.items.push(item[0]);
            },
            /*
             *
             * @param item - текущий элемент меню
             *
             * ищет родительский элемент и добавляет к нему потомка
             *
             */
            insertMenu: function(item){
                for( menu_item of this.items ){
                    if( menu_item.id == item.parent_id ){
                        menu_item.push(item);
                    }
                }
            },
            /*
             *
             * @param item - текущая задача
             *
             * обновляет текущую задачу в массиве
             *
             */
            updateItem: function(id, page){
                for( item in this.items ){
                    if( this.items[item]['id'] == id ){
                        this.items.splice(item, 1);
                        console.log(item)
                        this.items.push(page);
                    }
                }
            },
            /*
             *
             * @param item - пункт меню
             *
             * удаляет пункт меню
             *
             */
            updateMenu: function(items){
                this.items = items;
                return;
                
                // this.items.splice(a, 1)
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
                    id: this.form.createTask.inputs.id,
                    menu_id: this.form.createTask.inputs.menu_id,
                    title: this.form.createTask.inputs.title,
                    slug: this.form.createTask.inputs.slug,
                    is_visible: this.form.createTask.inputs.is_visible,
                    body: null, /* заполняется из tinyMCE */
                    meta_title: this.form.createTask.inputs.meta_title,
                    meta_description: this.form.createTask.inputs.meta_description,
                    meta_keywords: this.form.createTask.inputs.meta_keywords,
                };
                return item_prepared;
            },
            /*
             *
             * @param item - элемент
             *
             * из объекта, который использует экземпляр Vue создает объект, который воспринимает controller
             *
             */
            prepareMenuObjectToRequest: function(){
                var item_prepared = {
                    id: this.form.createTask.inputs.id,
                    parent_id: this.form.createTask.inputs.parent_id,
                    is_visible: this.form.createTask.inputs.is_visible,
                    pages: this.form.createTask.inputs.pages,
                    slug: this.form.createTask.inputs.slug,
                    sort: this.form.createTask.inputs.sort,
                    title: this.form.createTask.inputs.title,
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
            prepareMenuObjectToView: function(item){
                var item_prepared = {
                    id : item.id,
                    parent_id : item.parent_id,
                    title : item.title, 
                    slug : item.slug,
                    is_visible : item.is_visible,
                    pages : item.pages,
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
                    menu_id: item.menu_id,
                    slug: item.slug,
                    is_visible: item.is_visible, 
                    meta_title: item.meta_title == null ? "" : item.meta_title,
                    meta_description: item.meta_description == null ? "" : item.meta_description,
                    meta_keywords: item.meta_keywords == null ? "" : item.meta_keywords,
                    body: item.body == null ? "" : item.body,
                };
                // item_prepared['body'] = item.body == undefined ? "" : item.body;
                return item_prepared;
            },
            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * создает пункт меню
             *
             */
            updateMenuItemRequest: function(event){
                var vm = this;
                var request_data = this.prepareMenuObjectToRequest();
                 var item_id = request_data.id;
                fetch(`/component/menu/${item_id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'PUT',
                    body: JSON.stringify(request_data)
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
                    if( data.errors != null ){
                        vm.showToast(`Ошибка обновления.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }

                    }else{
                        vm.closeModal("edit-menu");
                        vm.updateMenu(data.result.itemList);
                        vm.showToast(`Пункт меню обновлен.`);
                    }
                    return;
                });
            },
            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * создает пункт меню
             *
             */
            createMenuItemRequest: function(event){
                var vm = this;
                var request_data = this.prepareMenuObjectToRequest();
                fetch(`/component/menu`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'POST',
                    body: JSON.stringify(request_data)
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
                    if( data.errors != null ){
                        vm.showToast(`Ошибка создания.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }
                    }else{
                        vm.closeModal("create-menu");
                        vm.updateMenu(data.result.itemList);
                        let step = 1;
                        for( let message of [`Пункт меню добавлен.`, `Контент-страница создана.`] ){
                            setTimeout(function() {
                                vm.showToast(message);
                            }, 250*step);
                            step = step + 1;
                        }
                    }
                    return;
                });
            },
            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * удаляет старые роли пользователя и назначает новую
             * показывает уведомление о результате
             *
             */
            createItemRequest: function(event){
                var vm = this;
                var request_data = this.prepareInputObjectToRequest();
                request_data.body = tinyMCE.get('body-create').getContent();
                fetch(`/component/page`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'POST',
                    body: JSON.stringify(request_data)
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
                    if( data.errors != null ){
                        vm.showToast(`Ошибка создания.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }

                    }else{
                        vm.closeModal("create-task");
                        vm.insertItem(data.result.item);
                        vm.showToast(`Страница добавлена.`);
                    }
                    return;
                });
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
            updateItemRequest: function(event){
                var vm = this;
                var request_data = this.prepareInputObjectToRequest();
                request_data.body = tinyMCE.get('body-edit').getContent();
                var item_id = request_data.id;
                fetch(`/component/page/${item_id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'PUT',
                    body: JSON.stringify(request_data)
                })
                .then(function(response) {
                    if( response.status != 200 ){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        vm.showToast(`Ошибка обновления на сервере.`);
                        let step = 1;
                        for( let error of [`Повторите попытку позже и обратитесь к администратору сайта.`] ){
                            setTimeout(function(argument) {
                                vm.showToast(error);
                            }, 250*step);
                            step = step + 1;
                        }
                        return;
                    }
                    return response.json();
                })
                .then(function(data){
                    if( data == null ){
                        return;
                    }else if( data.errors != null ){
                        vm.showToast(`Ошибка обновления.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }

                    }else if( data.result.status ){
                        vm.showToast(`Изменения в странице '${vm.form.createTask.inputs.title}' сохранены.`);
                        vm.closeModal("edit-task");
                        // vm.updateItem(item_id, data.result.item);
                        vm.items = data.result.items;
                    }
                });
            },

            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * удаляет задание
             * показывает уведомление о результате
             *
             */
            removeItemRequest: function(event){
                var vm = this;
                fetch(`/component/page/${this.form.removeItem.inputs.id}`, {
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
                    if( data.result.status ){
                        vm.showToast(`Страница ${vm.form.removeItem.inputs.title} удалена.`);
                        vm.removeItem(vm.form.removeItem.inputs.id);
                        vm.closeModal("remove-item");
                    }
                });
            },
            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * удаляет пункт меню
             * показывает уведомление о результате
             *
             */
            removeMenuRequest: function(event){
                var vm = this;
                fetch(`/component/menu/${this.form.removeItem.inputs.id}`, {
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
                    if( response.status != 200 ){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        vm.showToast(`Ошибка удаления на сервере.`);
                        let step = 1;
                        for( let messages of [`Повторите попытку позже и обратитесь к администратору сайта.`] ){
                            setTimeout(function(argument) {
                                vm.showToast(messages);
                            }, 250*step);
                            step = step + 1;
                        }
                        return;
                    }
                    return response.json();
                })
                .then(function(data){
                    console.log(data['result']['log']['menu'].join(', '))
                    if( data.result.status ){
                        vm.showToast(`Пункт меню ${vm.form.removeItem.inputs.title} удален.`);
                        let step = 1;
                        let messages = [];
                        if( data['result']['log']['menu'].length != 0 ){
                            messages.push(`Вы удалили элементы меню: ${data['result']['log']['menu'].join(', ')}.`);
                        }
                        if( data['result']['log']['pages'].length != 0 ){
                            messages.push(`Вы удалили страницы: ${data['result']['log']['pages'].join(', ')}.`);
                        }
                        for( let message of messages ){
                            setTimeout(function(argument) {
                                vm.showToast(message);
                            }, 250*step);
                            step = step + 1;
                        }
                        vm.updateMenu(data.result.itemList);
                        vm.closeModal("remove-menu");
                    }
                });
            },
            /*
             *
             * @param event - событие
             * @param item - текущий файл
             * @param action - направление (выше, ниже)
             *
             * изменяет позицию элемента (сортировку) в списке
             *
             */
            changePositionGallery: function(event, item, action = null){
                var vm = this;
                if( action == null ){
                    console.log("No action has found - no action will be take.")
                    return;
                }
                /* ищем элемент */
                let a;
                a = vm.itemList.findIndex(function(value, key){
                    /* если проверка будет по id, то новые фото нельзя будет сортировать */
                    return item.id == value.id;
                });
                console.log(a > -1)
                if( a > -1 ){
                    /* изменения в родительских категориях */
                    if( action == '-1' ){
                    /* выполним сортировку, перемещаем назад */
                        if( (a-1) != -1 ){
                            console.log(vm.itemList[a]['sort'])
                            console.log(vm.itemList[a-1]['sort'])
                            vm.itemList[a]['sort'] = vm.itemList[a]['sort'] - 1;
                            vm.itemList[a-1]['sort'] = vm.itemList[a]['sort'] + 1;
                            console.log(vm.itemList[a]['sort'])
                            console.log(vm.itemList[a-1]['sort'])
                        }
                    }else{
                        /* перемещаем вперед */
                        if( vm.itemList[a+1] != null ){
                            vm.itemList[a]['sort'] = vm.itemList[a]['sort'] + 1;
                            vm.itemList[a+1]['sort'] = vm.itemList[a]['sort'] - 1;
                        }
                    }
                }else{
                    /* изменения в подкатегориях */
                    for( submenu in vm.itemList ){
                        if( vm.itemList[submenu]['childs'].length ){
                            a = vm.itemList[submenu]['childs'].findIndex(function(value, key){
                                /* если индекс найден - выполним сортировку */
                                if( item.id == value.id ){
                                    if( action == '-1' ){
                                        /* перемещаем назад */
                                        if( (key-1) != -1 ){
                                            vm.itemList[submenu]['childs'][key]['sort'] = vm.itemList[submenu]['childs'][key]['sort'] - 1;
                                            vm.itemList[submenu]['childs'][key-1]['sort'] = vm.itemList[submenu]['childs'][key]['sort'] + 1;
                                        }
                                    }else{
                                        /* перемещаем вперед */
                                        if( vm.itemList[submenu]['childs'][key+1] != null ){
                                            vm.itemList[submenu]['childs'][key]['sort'] = vm.itemList[submenu]['childs'][key]['sort'] + 1;
                                            vm.itemList[submenu]['childs'][key+1]['sort'] = vm.itemList[submenu]['childs'][key]['sort'] - 1;
                                        }
                                    }
                                }
                                return item.id == value.id;
                            });
                        }
                    }

                }
                var request_data = vm.itemList;
                fetch(`/component/menu/sort`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'POST',
                    body: JSON.stringify(request_data)
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
                    if( data.errors != null ){
                        vm.showToast(`Ошибка обновления сортировки.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }

                    }else{
                        vm.closeModal("edit-menu");
                        vm.updateMenu(data.result.itemList);
                        vm.showToast(`Сортировка меню обновлена.`);
                    }
                    return;
                });
                return;
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
[data-module="pages"] [data-component="item-list"] .list-item{
    grid-template-columns: 80px auto 180px;
}
</style>
</body>
</html>
