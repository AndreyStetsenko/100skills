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
        <main id="app" v-cloak data-module='users'>
            <section data-component="item-list">
                <div row>
                    <article>
                        <div>
                            Управление разделом "Пользователи": спискок
                        </div>
                    </article>
                    <article>
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='addElement($event)'><i class="material-icons left">add</i>Добавить пользователя</a>
                        </div>
                    </article>
                </div>
                @if(1)
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
                @endif
                <div row>
                    <article>
                        <div class="list-container">
                            <div class="list-item item-head">
                                <div>
                                    Email
                                </div>
                                <div>
                                    Аккаунт подтвержден
                                </div>
                                <div>
                                    Доступ
                                </div>
                                <div>
                                    Управление
                                </div>
                            </div>
                            <div v-for='item in itemList' :key='item.id'>
                                <div class="list-item item-body">
                                    <div>
                                        @{{ item['email'] }}
                                    </div>
                                    <div>
                                        <span v-if="item['email_verified_at']"> 
                                            Да.
                                        </span>
                                        <span v-else> 
                                            Нет.
                                        </span>
                                    </div>
                                    <div>
                                        <select class="browser-default" @change.prevent="changeRole($event, item)">
                                            <option v-for="(role, key) in roles" v-bind:value="role.id" v-bind:selected="( item.roles != null && item.roles[0] != null && role.id == item.roles[0].id) ? true : false">@{{ role['name'] }}</option>
                                        </select>
                                        <!-- <label>Роль пользователя</label> -->
                                    </div>
                                    <div name='manage'> 
                                        <?php if ( !1 ): ?>
                                            <a href="" @click.prevent='editItem($event, item)'><span class="material-icons" title='Редактировать пользователя'>border_color</span></a>
                                            <a href="#remove-confirm" @click.prevent='removeConfirm($event, item)'><span class="material-icons" title='Удалить пользователя'>delete_outline</span></a>
                                        <?php endif ?>
                                        <div class="managment-buttonset" data-component="manage">
                                            
                                            <a href="" @click.prevent='editItem($event, item)'><span class="material-icons" title='Редактировать пользователя'>border_color</span></a>
                                            <a href="#remove-confirm" @click.prevent='removeConfirm($event, item)'><span class="material-icons" title='Удалить пользователя'>delete_outline</span></a>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
            <section data-component='modal'>
                <div id="create-item" class="modal modal-fixed-footer">
                    <div class="modal-content">
                      <h4>Создание пользователя</h4>
                      <form action="">
                            <br />
                            <div class="row">
                                <div class="input-field s12">
                                    <input placeholder="Почта" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.email" >
                                    <label for="title">Почта</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field s12">
                                    <input placeholder="Пароль" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.password" >
                                    <label for="title">Пароль</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" style="padding: 0 0 10px;">
                                    <label>Роль пользователя</label>
                                </div>
                                <div class="input-field s12">
                                    <select class="browser-default" v-model="form.createTask.inputs.roles">
                                        <option value="-1" disabled selected>Выберите роль пользователя</option>
                                        <option v-for="(role, key) in roles" v-bind:value="role.id">@{{ role['name'] }}</option>
                                    </select>
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
                      <h4>Редактирование пользователя</h4>
                      <form action="">
                            <div class="row">
                                <div class="input-field col s12">
                                    <h5>Пользователь: @{{ this.form.createTask.inputs.email }}</h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="email" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.email" >
                                    <label for="title">email</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="password" 
                                           id="title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.password" >
                                    <label for="title">password</label>
                                </div>
                            </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="updateItemRequest($event)">Сохранить</a>
                        <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
                    </div>
                </div>
            </section>
            <section data-component='modal' class="remove-item">
                <!-- Модальное окно подтверждение удаления объекта -->
                <div id="remove-item" class="modal modal-fixed-footer">
                    <div class="modal-content">
                        <h4>Подтвердить удаление пользователя</h4>
                        <article v-if='form.removeItem.inputs.id'>
                            <p>email: @{{ form.removeItem.inputs.email }}</p>
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
<!-- <script src="https://cdn.tiny.cloud/1/qespi14zyov8h6lvcaqartp18vkl12sdk4x0nk80kl23s9oi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> -->
<script>

</script>
<script>
    var app = new Vue({
        el: '#app',
        data: {
            items: {!! $items !!},
            roles: {!! $roles !!},
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
            if( window.tinyMCE != null ){
                window.tinyMCE.init({
                    selector: "#create-task [data-component='tinymce']#body-create",
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                });
                window.tinyMCE.init({
                    selector: "#edit-task [data-component='tinymce']#body-edit",
                    plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                });
            }
            this.setPages();
        },
        mounted: function () {
            /* инит select */
            this.initSelect();
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
                    if (a.id < b.id){
                        return -1;
                    }
                    if (a.id > b.id){
                        return 1;
                    }
                    return 0;
                }
                /* вернем в обратном порядке, от большего к меньшему */
                return this.items.sort(compare).reverse();
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
             * инициализируем materialize css select
             */
            initSelect () {
                /* инит select */
                if( document.querySelector('select') != null ){
                    var elems = document.querySelectorAll('select');
                    var instances = M.FormSelect.init(elems, {});
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
            addElement: function(event, item = null){
                this.form.createTask.inputs = {
                    id: "",
                    email: "",
                    password: "",
                    roles: [],
                };
                /* при открытии модального окна - обновляем значение tiny */
                this.initModal("create-item");
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
                var item_prepared = this.prepareInputObjectToView(item);
                this.form.createTask.inputs = item_prepared;
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
            removeConfirm: function(event, item){
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
            updateItems: function(items){
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
                    email: this.form.createTask.inputs.email,
                    password: this.form.createTask.inputs.password,
                    role: this.form.createTask.inputs.roles,
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
                    email: item.email,
                    password: "",
                    roles: item.roles[0],
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
                fetch(`/component/users`, {
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
                        vm.closeModal("create-item");
                        vm.updateItems(data.result.items);
                        vm.showToast(`Пользователь создан.`);
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
                var item_id = request_data.id;
                fetch(`/component/users/${item_id}`, {
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
                        vm.showToast(`Изменения для пользователя '${vm.form.createTask.inputs.email}' сохранены.`);
                        vm.closeModal("edit-task");
                        vm.updateItem(item_id, data.result.item);
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
                fetch(`/component/users/${this.form.removeItem.inputs.id}`, {
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
                        vm.showToast(`Пользователь ${vm.form.removeItem.inputs.email} удален.`);
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
             * @param item - текущий объект
             *
             * изменяет привязку роли к пользователю
             *
             */
            changeRole: function(event, item){
                var vm = this;
                fetch(`/component/users/role/${item.id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'POST',
                    body: JSON.stringify({role: event.target.value})
                })
                .then(function(response) {
                    if( response.status != 200 ){
                        /* если ответ не 200 - что-то случилось, обработаем ошибку */
                        vm.showToast(`Ошибка обновления на сервере.`);
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
                    if( data.result.status ){
                        vm.showToast(`Информация о пользователе обновлена.`);
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
/* grid сетка записи таблицы */
[data-module="users"] .list-item {
    grid-template-columns: auto 110px 150px 100px;
}
</style>
</body>
</html>
