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
        <main id="app" v-cloak data-module='catalog'>
            <section data-component="item-list">
                <div row>
                    <article>
                        <div>Управление разделом "Формы и настройки сайта": список</div>
                    </article>
                    <article class="module-managment">
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='createItem($event)'><i class="material-icons left">add</i>Добавить</a>
                        </div>
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='removeSelectedItems($event)'><i class="material-icons left">remove</i>Удалить выбранные</a>
                        </div>
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='clearStatistics($event)'><i class="material-icons left">assessment</i>Очистить статистику</a>
                        </div>
                    </article>
                </div>
                <?php if ( !1 ): ?>
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
                <?php endif ?>
                <div row>
                    <article>
                        <div class="list-container">
                            <div class="list-item item-head">
                                <div>
                                    Наименование
                                </div>
                                <div>
                                    Значение
                                </div>
                                <div>
                                    Идентификатор
                                </div>
                                <div>
                                    Видимость
                                </div>
                                <div>
                                    Удаление
                                </div>
                                <div>
                                    Управление
                                </div>
                            </div>
                            <div class="list-item item-body" 
                                 v-for='item in paginateItemList' 
                                 :key='item.id' 
                                 v-bind:class="[ isAboutToDelete(item.id) ? 'about-to-delete' : '']">
                                <div>
                                    @{{ item['title'] }}
                                </div>
                                <div>
                                    @{{ item['value'] }}
                                </div>
                                <div>
                                    @{{ item['slug'] }}
                                </div>
                                <div style="justify-self: flex-end;">
                                    <form v-if="item['is_visible']">
                                        <p>
                                          <label>
                                            <input class="filled-in" 
                                                   type="checkbox" 
                                                   checked 
                                                   v-model="item.is_visible" 
                                                   @change.prevent="updateVisible($event, item)"/>
                                            <span></span>
                                          </label>
                                        </p>
                                    </form>
                                    <form v-else>
                                        <p>
                                          <label>
                                            <input class="filled-in" 
                                                   type="checkbox"  
                                                   v-model="item.is_visible" 
                                                   @change.prevent="updateVisible($event, item)"/>
                                            <span></span>
                                          </label>
                                        </p>
                                    </form>
                                </div>
                                <div style="justify-self: flex-end;">
                                    <form>
                                        <p>
                                          <label>
                                            <input class="filled-in" 
                                                   type="checkbox" 
                                                   v-model="form.removeItem.ids" 
                                                   v-bind:value="item.id"/>
                                            <span></span>
                                          </label>
                                        </p>
                                    </form>
                                </div>
                                <div name='manage' data-component="manage"> 
                                    <a href="" @click.prevent='editItem($event, item)'><span class="material-icons" title='Редактировать'>border_color</span></a>
                                    <a href="#remove-confirm" @click.prevent='removeItemConfirm($event, item)'><span class="material-icons" title='Удалить'>delete_outline</span></a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
            <section data-component='modal'>
                <div id="create-task" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <h4>Создание записи</h4>
                        <form action="">
                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Основная информация:</h6>
                                </div>
                            </div>
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
                                    <input placeholder="Значение" 
                                           id="value" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.value">
                                    <label for="value">Значение</label>
                                </div>
                            </div>
                            
                            <?php if ( !1 ): ?>
                                
                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>

                            <?php endif ?>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="createRequest($event)">Создать</a>
                        <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
                    </div>
                </div>
            </section>
            <section data-component='modal'>
                <div id="edit-task" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>Редактирование записи</h4>
                        <form action="">
                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Основная информация:</h6>
                                </div>
                            </div>
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
                                    <input placeholder="Значение" 
                                           id="value" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.value">
                                    <label for="value">Значение</label>
                                </div>
                            </div>
                            
                            <?php if ( !1 ): ?>
                                
                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>

                            <?php endif ?>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="updateTaskRequest($event)">Сохранить изменения</a>
                        <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
                    </div>
                </div>
            </section>
            <section data-component='modal' class="remove-item">
                <!-- Модальное окно подтверждение удаления объекта -->
                <div id="remove-item" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <h4>Подтвердить удаление объекта</h4>
                        <article v-if='form.removeItem.inputs.id'>
                            <p>id: @{{ form.removeItem.inputs.id }}</p>
                            <p>наименование: @{{ form.removeItem.inputs.title }}</p>
                            <div>
                            </div>
                        </article>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="removeItemRequest($event)">Удалить</a>
                        <a href="#!" class="modal-close waves-effect waves-green btn-flat">Отменить</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdn.tiny.cloud/1/<?=config("app.tiny_mce_key") ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            /* пагинация */
            pagination: {
                page: 1,
                perPage: 15, /* кол-во элементов на странице */
                maxPage: null, /* setPages() - считает и устанавливает кол-во страниц для текущих полученных из БД объектов */
            },
            /* карточки */
            items: {!! $items !!},
            form: {
                tinymce: null,
                csrf: "{!! csrf_token() !!}",
                user: "{!! Auth::user()->id !!}",
                createTask: {
                    inputs: {
                        id: "",

                        title: "",
                        value: "",
                        
                        is_visible: "",
                    },
                    path: {

                    }
                },
                removeItem: {
                    inputs: {
                        id: '',
                        title: '',
                    },
                    ids: [],
                }, /* data удаляемого элемента */
            },
        },
        created: function(){
            if ( !1 ) {
                /* инициализация tiny окна */
                window.tinyMCE.init({
                    selector: "#create-task [data-component='tinymce']#body-create",
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
                });
            }
            this.setPages();
        },
        mounted: function(){
            if ( document.querySelectorAll(`[data-component="city-managment"] .collapsible`).length != 0 ) {
                M.Collapsible.init(document.querySelectorAll(`[data-component="city-managment"] .collapsible`), {});
            }
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
                let result = this.items.sort(compare);
                return result;
            },
            paginateItemList () {
                let page = this.pagination.page;
                let perPage = this.pagination.perPage;
                let from = (page * perPage) - perPage;
                let to = (page * perPage);
                return this.itemList.slice(from, to);
            },
        },
        methods: {
            /*
             * возвращает bool если переданный id отмечен как ожидающий удаления
             * далее добавляется класс
             */
            isAboutToDelete: function(id) {
                let vm = this;
               
                return vm.form.removeItem.ids.includes(id);
            },
            /*
             * возвращает отсортированный массив
             */
            sortedArray: function(array) {
                if( array == null ){
                    return [];
                }
                /* сортирует абстрактный массив по полю sort */
                function compare(a, b) {
                  if (a.sort < b.sort){
                    return -1;
                  }
                  if (a.sort > b.sort){
                    return 1;
                  }
                  return 0;
                }

                return array.sort(compare);
            },
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
             * @param item - элемент
             *
             * из объекта, который использует экземпляр Vue создает объект, который воспринимает controller
             *
             */
            prepareInputObjectToRequest: function(){
                var item_prepared = {
                    id: this.form.createTask.inputs.id,
                    
                    title: this.form.createTask.inputs.title,
                    slug: this.form.createTask.inputs.slug,
                    
                    value: this.form.createTask.inputs.value,
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
                    
                    title: item.title != null ? item.title : "",
                    slug: item.slug != null ? item.slug : "",
                    value: item.value != null ? item.value : "",

                };

                return item_prepared;
            },
            /*
             *
             * @param item - текущая задача
             *
             * открывает форму для редактирования задачи
             *
             */
            createItem: function(event)
            {
                
                this.form.createTask.inputs = {
                    id: "",

                    title: "",
                    value: "",  
                    slug: "",  
                };


                if ( !1 ) {
                    /* при открытии модального окна - обновляем значение tiny */
                    tinyMCE.get('body-create').setContent("");
                }
                
                this.initModal("create-task");
            },
            /*
             *
             * @param item - текущая задача
             *
             * открывает форму для редактирования задачи
             *
             */
            editItem: function(event, item)
            {
                this.form.createTask.inputs = {};
                var item_prepared = this.prepareInputObjectToView(item);
                this.form.createTask.inputs = item_prepared;

                if ( !1 ) {
                    /* при открытии модального окна - обновляем значение tiny */
                    tinyMCE.get('body-edit').setContent(item_prepared.body);
                }

                this.initModal("edit-task");
            },
            /*
             *
             * @param item - текущая задача
             *
             * открывает форму для подтверждения удаления
             *
             */
            removeItemConfirm: function(event, item)
            {
                this.form.removeItem.inputs = {};
                this.form.removeItem.inputs = JSON.parse(JSON.stringify(item));
                this.initModal("remove-item");
            },
             /*
             *
             * @param item - текущая задача
             *
             * удаляет текущую задачу из массива view
             *
             */
            removeItem: function(item)
            {
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
                console.log(item[0]);
                this.items.push(item[0]);
            },
            /*
             *
             * @param item - текущая задача
             *
             * обновляет текущую задачу в массиве
             *
             */
            updateItem: function(id, task){
                for( item in this.items ){
                    if( this.items[item]['id'] == id ){
                        this.items.splice(item, 1);
                        this.items.push(task);
                    }
                }
            },
            /*
             *
             * @param items
             *
             * обновляет весь список
             *
             */
            updateItems: function(items){
                this.items = items;
                return;
            },
            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * запрос на создание
             * показывает уведомление о результате
             *
             */
                
            /* функция 2022 */
            createRequest: function(event)
            {
                var vm = this;
                var request_data = this.prepareInputObjectToRequest();
                
                // request_data.body = tinyMCE.get('body-create').getContent();

                fetch(`/component/settings`, {
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
                        vm.closeModal("create-task");
                        vm.items = data.result.items;
                        vm.showToast(`Запись добавлена.`);
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

            /* функция 2022 */
            updateTaskRequest: function(event)
            {
                var vm = this;
                var request_data = this.prepareInputObjectToRequest();
               
                // request_data.body = tinyMCE.get('body-edit').getContent();

                var item_id = request_data.id;
                fetch(`/component/settings/${item_id}`, {
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
                        /* если ответ не 422 - ответ от валидатора Request */
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
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
                        vm.showToast(`Изменения в '${vm.form.createTask.inputs.title}' сохранены.`);
                        vm.closeModal("edit-task");

                        vm.items = data.result.items;
                    }
                });
            },
            /*
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * обновляет видимость объекта
             * показывает уведомление о результате
             *
             */
            /* функция 2022 */ 
            updateVisible: function(event, item)
            {
                var vm = this;

                /* подготовка информации для update, добавление в форму */
                this.form.createTask.inputs = {};
                var item_prepared = this.prepareInputObjectToView(item);
                this.form.createTask.inputs = item_prepared;

                /* извлечение информации из формы */
                var request_data = this.prepareInputObjectToRequest();

                request_data.is_visible = item.is_visible;

                fetch(`/component/settings/${item.id}`, {
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
                        /* если ответ не 422 - ответ от валидатора Request */
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
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
                        vm.showToast(`Видимость объекта '${vm.form.createTask.inputs.title}' изменена.`);
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
            
            /* функция 2022 */ 
            removeItemRequest: function(event)
            {
                var vm = this;
                fetch(`/component/settings/${this.form.removeItem.inputs.id}`, {
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
                    if( data.result.status ){
                        vm.showToast(`Запись '${vm.form.removeItem.inputs.title}' удалена.`);

                        vm.items = data.result.items;
                        
                        vm.closeModal("remove-item");
                    }
                });
            },
             /*
             *
             * @param item - текущая задача
             *
             * Удаляет отмеченные чекбоксом объекты
             *
             */

             /* функция 2022 */
            removeSelectedItems: function(event)
            {
                var vm = this;
                if( !vm.form.removeItem.ids.length ){
                    vm.showToast(`Выберите запись, которые хотите удалить`);
                    return;
                }
                var request_data = {
                    method: 'remove',
                    ids: JSON.stringify(vm.form.removeItem.ids),
                };
                fetch(`/component/settings/0`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'DELETE',
                    body: JSON.stringify(request_data)
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
                    if( data.result.status ){

                        vm.items = data.result.items;

                        /* сообщение о том, какие лекции были удалены */
                        let removed_ids = vm.form.removeItem.ids.join(", ");
                        if( vm.form.removeItem.ids.length ){
                            vm.showToast(`Записи ${removed_ids} удалены.`);
                        }else{
                            vm.showToast(`Записи удалены.`);
                        }
                        vm.form.removeItem.ids = [];

                        // vm.removeItem(vm.form.removeItem.inputs.id);
                        // vm.closeModal("remove-item");
                    }
                });
            },

            clearStatistics: function(event)
            {
                var vm = this;

                fetch(`/statistic/allclear`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'DELETE'
                })
                .then(function(response) {
                    if( response.status != 200 && response.status != 422){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        /* если ответ не 422 - ответ от валидатора */
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                    }
                    return response.json();
                })
                .then(function(data) {
                    if( data.status ) {

                        vm.showToast(`Статистика сайта очищена.`);
                    }
                });
            },
        },
    })
</script>
<style>
    /* высота модалок: здесь стили и при init задаем опции: startingTop и endingTop   */
    [data-component="modal"] .modal.modal-fixed-footer {
        height: 50%;
        max-height: 50%;
    }
    /* стили для input */
    [input-field] {
        position: relative;
        margin-top: 1rem;

        margin-top: 0;
        margin-bottom: 1rem;
    }
    .list > ul{
        display: grid;
        grid-template-columns: repeat(6, -webkit-max-content);
        grid-template-columns: repeat(6, max-content);
        grid-gap: 5px 20px;
    }
    /* если запись отмечена как ожидающая удаления */
    .about-to-delete{
        background: #fee;
    }
    /* разметка списка для модуля */
    [data-module="catalog"] [data-component="item-list"] .list-item{
        grid-template-columns: auto 200px 160px 90px 90px 90px;
    }
</style>
</body>
</html>
