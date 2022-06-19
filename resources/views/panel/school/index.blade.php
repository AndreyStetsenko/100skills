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
                        <div>Управление разделом "Учет школ": список</div>
                    </article>
                    <article class="module-managment">
                        <div>
                            <a href="" class="waves-effect waves-light btn-small" @click.prevent='createItem($event)'><i class="material-icons left">add</i>Добавить</a>
                        </div>
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='removeSelectedItems($event)'><i class="material-icons left">remove</i>Удалить выбранные</a>
                        </div>
                    </article>
                </div>
                <div row style="padding: 10px 25px;">
                    <section data-component="admin-pagination">
                        <ul class="pagination">
                            <li v-bind:class="[pagination.page == 1 ? 'disabled' : 'waves-effect']" class="">
                                <a href="#!" 
                                   @click.prevent="pagination.page = pagination.page - 1" 
                                   v-bind:disabled="pagination.page == 1" 
                                   v-bind:class="[pagination.page == 1 ? 'disabled-pointer-events' : '']" ><i class="material-icons">chevron_left</i></a>
                            </li>                       
                            <li v-for="number in pagination.maxPage" v-bind:class="[pagination.page == number ? 'active' : '']">
                                <a href="#!" @click.prevent="pagination.page = number">@{{ number }}</a>
                            </li>
                            <li v-bind:class="[pagination.page == pagination.maxPage ? 'disabled' : 'waves-effect']">
                                <a href="#!" 
                                   @click.prevent="pagination.page++"
                                   v-bind:disabled="(pagination.page == pagination.maxPage)"
                                   v-bind:class="[(pagination.page == pagination.maxPage) ? 'disabled-pointer-events' : '']"><i class="material-icons">chevron_right</i></a>
                            </li>
                        </ul>
                    </section>
                </div>
                <div row style="padding: 10px 25px;">
                    <section data-component="admin-search">
                        <nav>
                            <div class="nav-wrapper">
                                <form @submit.prevent>
                                    <div class="input-field">
                                        <input @change.prevent 
                                               id="search" 
                                               type="search"
                                               v-model="search.input">
                                        <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                                        <i class="material-icons">close</i>
                                    </div>
                                </form>
                            </div>
                        </nav>
                    </section>
                </div>
                <div row>
                    <article>
                        <div class="list-container">
                            <div class="list-item item-head">
                                 <div>
                                    Порядок
                                </div>
                                <div>
                                    Наименовение
                                </div>
                                <div>
                                    Статистика
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
                                    <div data-component='sort-managment'>
                                        <a href="!#" @click.prevent="changeSort($event, item, '-1')" class="btn" style="" title='Изменить позицию элемента'>
                                           <i class="material-icons right" style="">arrow_drop_up</i>
                                        </a>                            
                                        <a href="!#" @click.prevent="changeSort($event, item, '1')" class="btn" style="" title='Изменить позицию элемента'>
                                           <i class="material-icons right" style="">arrow_drop_down</i>
                                        </a>
                                    </div>
                                </div>
                                <div>
                                     @{{ item['title'] }}
                                </div>
                                <div style="justify-self: flex-end;">
                                    <a href="#!" @click.prevent='statExport($event, item)'><span class="material-icons" title='Скачать статистику'>download</span></a>
                                </div>
                                <div style="justify-self: flex-end;">
                                    <form v-if="item['is_visible']">
                                        <p>
                                          <label>
                                            <input class="filled-in" type="checkbox" checked v-model="item.is_visible" @change.prevent="updateVisible($event, item)"/>
                                            <span></span>
                                          </label>
                                        </p>
                                    </form>
                                    <form v-else>
                                        <p>
                                          <label>
                                            <input class="filled-in" type="checkbox"  v-model="item.is_visible" @change.prevent="updateVisible($event, item)"/>
                                            <span></span>
                                          </label>
                                        </p>
                                    </form>
                                </div>
                                <div style="justify-self: flex-end;">
                                    <form>
                                        <p>
                                          <label>
                                            <input class="filled-in" type="checkbox" v-model="form.removeItem.ids" v-bind:value="item.id"/>
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
                                <blockquote faq>
                                    если url пустой, он будет сгенерирован из заголовка автоматически при сохранении записи
                                </blockquote>
                                    <input placeholder="URL" 
                                           id="slug" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.slug" >
                                    <label for="slug">URL страницы</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_short" 
                                        name="body_short" 
                                        data-component='tinymce' 
                                        placeholder="Описание" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_short"></textarea>
                                </div>
                            </div>
                            <section data-component="adress-geocode">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Адрес" 
                                               id="adress" 
                                               type="text" 
                                               class="validate"
                                               v-model="geocode.adress.input" 
                                               @input.prevent="geocodeAdressRequest()">
                                        <label for="adress">Укажите адрес чтобы начать поиск</label>
                                    </div>
                                    <div class="input-field col s12 line" 
                                         v-if="form.createTask.inputs.adress.length != 0">
                                        <article>
                                            <p>
                                                <b>Выбранный адрес:</b>
                                            </p>
                                            <p>
                                                @{{ form.createTask.inputs.adress }} 
                                            </p>
                                        </article>
                                    </div>
                                    <div class="input-field col s12 line"
                                         v-if="form.createTask.inputs.adress.length == 0 && geocode.adress.input.length < 2">
                                        <article>
                                            <p>Город не определен. Укажте название в поле "Адрес".</p>
                                        </article>
                                    </div>
                                    <div class="input-field col s12 line"
                                         v-if="geocode.adress.list.length == 0 && geocode.adress.input.length > 2">
                                        <article>
                                            <p>Город не найден. Уточните название в поле "Адрес".</p>
                                        </article>
                                    </div>
                                    <div class="input-field col s12 line"
                                         v-if="geocode.adress.list.length != 0">
                                        <ul>
                                            <li style="padding: 0 0 5px 0;"><b>Выберите город:</b></li>
                                            <li v-for='item in geocode.adress.list' 
                                                :key='item.id'>
                                                <a style="cursor: pointer;"
                                                   @click.prevent="form.createTask.inputs.latitude = item.latitude; form.createTask.inputs.longitude = item.longitude; form.createTask.inputs.adress = item.adress; geocode.adress.list = []; geocode.adress.input = ''; ">
                                                    @{{ item['adress'] }}
                                               </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Телефон" 
                                           id="phone" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.phone" >
                                    <label for="phone">Телефон</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Email" 
                                           id="email" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.email" >
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="row">

                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>
                                <div class="input-field col s12">
                                    <input placeholder="Title" 
                                           id="meta_title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_title" >
                                    <label for="meta_title">Title (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Description" 
                                           id="meta_description" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_description" >
                                    <label for="meta_description">Description (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Keywords" 
                                           id="meta_keywords" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_keywords" >
                                    <label for="meta_keywords">Keywords (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Canonical" 
                                           id="meta_canonical" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_canonical" >
                                    <label for="meta_canonical">Canonical (meta)</label>
                                </div>
                            </div>
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
                                <blockquote faq>
                                    если url пустой, он будет сгенерирован из заголовка автоматически при сохранении записи
                                </blockquote>
                                    <input placeholder="URL" 
                                           id="slug" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.slug" >
                                    <label for="slug">URL страницы</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_short_edit" 
                                        name="body_short_edit" 
                                        data-component='tinymce' 
                                        placeholder="Описание" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_short_edit"></textarea>
                                </div>
                            </div>
                            <section data-component="adress-geocode">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input placeholder="Адрес" 
                                               id="adress" 
                                               type="text" 
                                               class="validate"
                                               v-model="geocode.adress.input" 
                                               @input.prevent="geocodeAdressRequest()">
                                        <label for="adress">Укажите адрес чтобы начать поиск</label>
                                    </div>
                                    <div class="input-field col s12 line" 
                                         v-if="form.createTask.inputs.adress.length != 0">
                                        <article>
                                            <p>
                                                <b>Выбранный адрес:</b>
                                            </p>
                                            <p>
                                                @{{ form.createTask.inputs.adress }} 
                                            </p>
                                        </article>
                                    </div>
                                    <div class="input-field col s12 line"
                                         v-if="form.createTask.inputs.adress.length == 0 && geocode.adress.input.length < 2">
                                        <article>
                                            <p>Город не определен. Укажте название в поле "Адрес".</p>
                                        </article>
                                    </div>
                                    <div class="input-field col s12 line"
                                         v-if="geocode.adress.list.length == 0 && geocode.adress.input.length > 2">
                                        <article>
                                            <p>Город не найден. Уточните название в поле "Адрес".</p>
                                        </article>
                                    </div>
                                    <div class="input-field col s12 line"
                                         v-if="geocode.adress.list.length != 0">
                                        <ul>
                                            <li style="padding: 0 0 5px 0;"><b>Выберите город:</b></li>
                                            <li v-for='item in geocode.adress.list' 
                                                :key='item.id'>
                                                <a style="cursor: pointer;"
                                                   @click.prevent="form.createTask.inputs.latitude = item.latitude; form.createTask.inputs.longitude = item.longitude; form.createTask.inputs.adress = item.adress; geocode.adress.list = []; geocode.adress.input = ''; ">
                                                    @{{ item['adress'] }}
                                               </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </section>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Телефон" 
                                           id="phone" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.phone" >
                                    <label for="phone">Телефон</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Email" 
                                           id="email" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.email" >
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="row">

                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>
                                <div class="input-field col s12">
                                    <input placeholder="Title" 
                                           id="meta_title" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_title" >
                                    <label for="meta_title">Title (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Description" 
                                           id="meta_description" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_description" >
                                    <label for="meta_description">Description (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Keywords" 
                                           id="meta_keywords" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_keywords" >
                                    <label for="meta_keywords">Keywords (meta)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Canonical" 
                                           id="meta_canonical" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.meta_canonical" >
                                    <label for="meta_canonical">Canonical (meta)</label>
                                </div>
                            </div>  
                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="updateRequest($event)">Сохранить изменения</a>
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
            @include('panel.school.modal-export')
        </main>
    </div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdn.tiny.cloud/1/<?=config("app.tiny_mce_key") ?>/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            /* карточки */
            items: {!! $items !!},
            pagination: {
                page: 1,
                perPage: 15, /* кол-во элементов на странице */
                maxPage: null, /* setPages() - считает и устанавливает кол-во страниц для текущих полученных из БД объектов */
            },
            /* строка поиска */
            search: {
                input: "",
            },
            /* информация от yandex geocode http */
            geocode: {
                adress: {
                    input: "",
                    list: [],
                },
            },
            form: {
                tinymce: null,
                csrf: "{!! csrf_token() !!}",
                user: "{!! Auth::user()->id !!}",
                createTask: {
                    inputs: {
                        id: "",
                        title: "",
                        
                        
                        gallery: {
                            is_active: null,
                            id: '',
                            list: [],
                        },
                        
                        body_short: "",
                        adress: "",
                        latitude: "",
                        longitude: "",
                        phone: "",
                        email: "",

                        meta_title: "",
                        meta_description: "",
                        meta_keywords: "",
                        meta_canonical: "",
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
                statsExport: {
                    inputs: {
                        id: '',
                        action: '',
                        date_start: '',
                        date_end: ''
                    }
                },
            },
        },
        created: function(){
            /* инициализация tiny окна */
            
            window.tinyMCE.init({
                selector: "#create-task [data-component='tinymce']#body_short",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#edit-task [data-component='tinymce']#body_short_edit",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });

            this.setPages();

        },
        mounted: function(){
            M.Collapsible.init(document.querySelectorAll(`[data-component="city-managment"] .collapsible`), {});
        },
        updated: function () {
            // console.log("pages updated");
            this.setPages();
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
                let vm = this;
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
                function search(input) {
                    if ( empty(input) ) {
                        return;
                    }
                }
                var result;
                result = this.items.sort(compare);
                // return result;
                
                return result.filter(function (item) {
                    return vm.search.input.toLowerCase().split(' ').every(v => item.title.toLowerCase().includes(v))
                });

            },
            paginateItemList () {
                let page = this.pagination.page;
                let perPage = this.pagination.perPage;
                let from = (page * perPage) - perPage;
                let to = (page * perPage);
                return this.itemList.slice(from, to);
            },
            exDay () {
                const today = new Date();
                var future = new Date();
                future.setDate(future.getDate() - 1);

                function formatDate(date, format) {
                    const map = {
                        mm: date.getMonth() + 1,
                        dd: date.getDate(),
                        yy: date.getFullYear().toString().slice(-2),
                        gggg: date.getFullYear()
                    }

                    return format.replace(/mm|dd|yy|gggg/gi, matched => map[matched])
                }

                let date_start = formatDate(future, 'gggg-mm-dd');
                let date_end = formatDate(today, 'gggg-mm-dd');

                return {
                    date_start,
                    date_end
                }
            },
            exWeek () {
                const today = new Date();
                var future = new Date();
                future.setDate(future.getDate() - 7);

                function formatDate(date, format) {
                    const map = {
                        mm: date.getMonth() + 1,
                        dd: date.getDate(),
                        yy: date.getFullYear().toString().slice(-2),
                        gggg: date.getFullYear()
                    }

                    return format.replace(/mm|dd|yy|gggg/gi, matched => map[matched])
                }

                let date_start = formatDate(future, 'gggg-mm-dd');
                let date_end = formatDate(today, 'gggg-mm-dd');

                return {
                    date_start,
                    date_end
                }
            },
            exMonth () {
                const today = new Date();
                var future = new Date();
                future.setDate(future.getDate() - 30);

                function formatDate(date, format) {
                    const map = {
                        mm: date.getMonth() + 1,
                        dd: date.getDate(),
                        yy: date.getFullYear().toString().slice(-2),
                        gggg: date.getFullYear()
                    }

                    return format.replace(/mm|dd|yy|gggg/gi, matched => map[matched])
                }

                let date_start = formatDate(future, 'gggg-mm-dd');
                let date_end = formatDate(today, 'gggg-mm-dd');

                return {
                    date_start,
                    date_end
                }
            },
            exThreeMonth () {
                const today = new Date();
                var future = new Date();
                future.setDate(future.getDate() - 91);

                function formatDate(date, format) {
                    const map = {
                        mm: date.getMonth() + 1,
                        dd: date.getDate(),
                        yy: date.getFullYear().toString().slice(-2),
                        gggg: date.getFullYear()
                    }

                    return format.replace(/mm|dd|yy|gggg/gi, matched => map[matched])
                }

                let date_start = formatDate(future, 'gggg-mm-dd');
                let date_end = formatDate(today, 'gggg-mm-dd');

                return {
                    date_start,
                    date_end
                }
            }
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

                    body_short: this.form.createTask.inputs.body_short,
                    adress: this.form.createTask.inputs.adress,
                    latitude: this.form.createTask.inputs.latitude,
                    longitude: this.form.createTask.inputs.longitude,
                    phone: this.form.createTask.inputs.phone,
                    email: this.form.createTask.inputs.email,

                    meta_title: this.form.createTask.inputs.meta_title,
                    meta_description: this.form.createTask.inputs.meta_description,
                    meta_keywords: this.form.createTask.inputs.meta_keywords,
                    meta_canonical: this.form.createTask.inputs.meta_canonical,

                    is_active_gallery: this.form.createTask.inputs.gallery.is_active ? true : null,
                    catalog_gallery_id: this.form.createTask.inputs.gallery.id,
                                        
                    gallery: this.form.createTask.inputs.gallery.list,
                    user: this.form.createTask.inputs.user,

                    is_visible: this.form.createTask.inputs.is_visible,

                };
                return item_prepared;
            },

            prepareInputExportObjectToRequest: function(dates){

                var item_prepared = {
                    id: this.form.statsExport.inputs.id,
                    action: this.form.statsExport.inputs.action,
                    date_start: this.form.statsExport.inputs.date_start ? this.form.statsExport.inputs.date_start : dates.date_start,
                    date_end: this.form.statsExport.inputs.date_end ? this.form.statsExport.inputs.date_end : dates.date_end,
                    school_id: this.form.statsExport.inputs.item.id,
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
                    
                    gallery: {
                        is_active: item.is_active_gallery,
                        id: '',
                        list: item.gallery != null ? item.gallery : [],
                    },
                    user: item.user,

                    body_short: item.body_short != null ? item.body_short : "",
                    adress: item.adress != null ? item.adress : "",
                    adress: item.adress != null ? item.adress : "",
                    latitude: item.latitude != null ? item.latitude : "",
                    longitude: item.longitude != null ? item.longitude : "",
                    phone: item.phone != null ? item.phone : "",
                    email: item.email != null ? item.email : "",

                    meta_title: item.meta_title != null ? item.meta_title : "",
                    meta_description: item.meta_description != null ? item.meta_description : "",
                    meta_keywords: item.meta_keywords != null ? item.meta_keywords : "",
                    meta_canonical: item.meta_canonical != null ? item.meta_canonical : "",

                    is_visible: item.is_visible != null ? item.is_visible : "",
                };

                return item_prepared;
            },
            /*
             *
             * @param item - текущая задача
             *
             * открывает форму для редактирования объекта
             *
             */
            createItem: function(event)
            {
                
                this.form.createTask.inputs = {
                    id: "",

                    title: "",
                    slug: "",
                    
                    gallery: {
                        is_active: null,
                        id: '',
                        list: [],
                    },
                    user: [],

                    body_short: "",
                    adress: "",
                    latitude: "",
                    longitude: "",
                    phone: "",
                    email: "",

                    meta_title: "",
                    meta_description: "",
                    meta_keywords: "",
                    meta_canonical: "",

                    is_visible: "", 
                };

                
                /* при открытии модального окна - обновляем значение tiny */
                tinyMCE.get('body_short').setContent("");
                
                this.initModal("create-task");
            },

            statExport: function(event, item)
            {
                
                this.form.statsExport.inputs = {
                    id: "",
                    action: "",
                    date_start: "",
                    date_end: "",
                    item: JSON.parse(JSON.stringify(item))
                };

                console.log(this.form.statsExport.inputs);
                
                this.initModal("stat-export");
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

                /* при открытии модального окна - обновляем значение tiny */
                tinyMCE.get('body_short_edit').setContent(item_prepared.body_short);

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
                
                request_data.body_short = tinyMCE.get("body_short").getContent();

                fetch(`/component/school`, {
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
            updateRequest: function(event)
            {
                var vm = this;
                var request_data = this.prepareInputObjectToRequest();
                
                request_data.body_short = tinyMCE.get("body_short_edit").getContent();

                var item_id = request_data.id;
                fetch(`/component/school/${item_id}`, {
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
                    if( response.status != 200 && response.status != 422 ){
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
             * @param item - объект
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
                // tinyMCE.get('body-edit').setContent(item_prepared.body);

                /* извлечение информации из формы */
                var request_data = this.prepareInputObjectToRequest();
                
                request_data.body_short = tinyMCE.get("body_short_edit").getContent();

                request_data.is_visible = item.is_visible;

                fetch(`/component/school/${item.id}`, {
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

            exportStat: function(event, item)
            {
                var request_data = this.prepareInputObjectToRequest();
                
                fetch(`/component/school/stat/${item.id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'PUT',
                    body: JSON.stringify(request_data)
                })
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
                fetch(`/component/school/${this.form.removeItem.inputs.id}`, {
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
                        // vm.removeItem(vm.form.removeItem.inputs.id);
                        
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
                fetch(`/component/school/0`, {
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
            /* GALLERY */
            /*
             *
             * добавляем в список выбранного объекта фотографию планировки: запрос
             *
             */
            addGalleryItems: function (event) 
            {
                var vm = this;
                var files = event.target.files;
                var formData = new FormData();
                for( file of files ){
                    formData.append("file[]", file);
                }
                vm.showToast(`Начало загрузки файлов...`);
                fetch(`/component/gallery`, {
                    headers: {
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'POST',
                    body: formData
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
                        vm.showToast(`Ошибка загрузки файла.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }

                    }else{
                        // vm.closeModal("create-task");
                        vm.addGalleryItemsView(data.result.files);
                        var toasts = [`Файлы галлереи загружены.`, `После сохранения объекта, изображения будут сохранены.`];
                        let step = 0;
                        for( let toast in toasts ){
                            setTimeout(function() {
                                vm.showToast(toasts[toast]);
                            }, 250*step);
                            step = step + 1;
                        }
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
            addGalleryItemsView: function (files) 
            {
                var vm = this;
                /* обновляем файл в объекте Vue - будет сохранен при сохранении */
                for( file in files ){
                    let tmp_gallery_obj = {
                        catalog_item_id: vm.form.createTask.inputs.id,
                        src: "/public" + files[file]['path'],
                        url: files[file]['url'],
                        title: files[file]['filename'],
                    }; /* объект, который будет сохранен при обновлении объекта */

                    vm.form.createTask.inputs.gallery.list.push(tmp_gallery_obj);
                }
                return;
            },
            /*
             *
             * @param event - событие
             * @param item - текущий файл
             * @param route - функция универсальная и ожидает маршрут
             *
             * удаляет элемент
             * показывает уведомление о результате
             *
             */
            removeGalleryRequest: function(event, item)
            {
                var vm = this;
                
                 if( vm.form.createTask.inputs.id.length == 0 ){
                    /* у объекта не id - удаляется планировка у не созданного объекта */
                    /* удаляем из view */
                    vm.showToast(`Файл ${item.title} удален.`);
                    vm.removeImgItemView(item);
                    return;
                }
                vm.showToast(`Начало удаление файла...`);

                fetch(`/component/school/gallery`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'POST',
                    body: JSON.stringify({item_id: vm.form.createTask.inputs.id, gallery_id: item.id})
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
                        vm.showToasts([`Ошибка удаления файла.`, `Попробуйте позже и обратитесь к администратору сайта.`]);

                        if ( item.id == null ) {
                            /* если произошла ошибка во время удаления файла - его нужно удалить из объекта в любом случае */
                            vm.removeImgItemView(item);
                        }
                        return;
                                
                    }else{
                        if ( item.id == null ) {
                            /* если произошла ошибка во время удаления файла - его нужно удалить из объекта в любом случае */
                            vm.removeImgItemView(item);
                            return;
                        }
                        /* унести в функцию и использовать */
                        fetch(`/component/gallery/${item.id}`, {
                            headers: {
                                "Content-Type": "application/json",
                                "Accept": "application/json",
                                "X-Requested-With": "XMLHttpRequest",
                                "X-CSRF-Token": vm.form.csrf
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
                                vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                            }else{
                                vm.showToast(`Файл ${item.title} удален.`);
                                vm.removeImgItemView(item);
                                vm.closeModal("remove-item");
                            }
                        });
                    }
                });
                return;
            },
            /**
             *
             * @param event - событие
             * @param item - файл
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
                /* ищем элемент - к которой принадлежит gallery */
                let a = vm.form.createTask.inputs.gallery.list.findIndex(function(value, key){
                    /* если проверка будет по id, то новые фото нельзя будет сортировать */
                    return item.src == value.src;
                });
                if( action == '-1' ){
                    /* перемещаем назад */
                    if( (a-1) != -1 ){
                        vm.form.createTask.inputs.gallery.list.splice((a-1), 0, vm.form.createTask.inputs.gallery.list.splice(a, 1)[0]);
                    }
                }else{
                    /* перемещаем вперед */
                    vm.form.createTask.inputs.gallery.list.splice((a+1), 0, vm.form.createTask.inputs.gallery.list.splice(a, 1)[0]);
                }
                if( item.id != null ){
                    vm.showToasts([`Положение фотографии '${item.id}' изменено.`, `Изменения вступят в силу после сохранения карточки.`]);
                }else{
                    vm.showToasts([`Положение фотографии изменено.`, `Изменения вступят в силу после сохранения карточки.`]);
                }
                return;
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
                var vm = this;
                let item_id = vm.form.createTask.inputs.id;

                if ( vm.form.createTask.inputs.id.length == 0 ) {
                    /* если объект не создан - ищем в текущем выбранном объекте совпадения, передаем на удаление и выходим */
                    let c = vm.form.createTask.inputs.gallery.list.findIndex(function(value, key){
                        return item.src == value.src;
                    });
                    vm.form.createTask.inputs.gallery.list.splice(c, 1);
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

                  
            /**
             *
             * @param event - событие
             * @param item - текущий файл
             * @param action - направление (выше, ниже)
             *
             * изменяет позицию элемента (сортировку) в списке
             *
             */
            changeSort: function(event, item, action = null)
            {
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

                if( a > -1 ){
                    /* изменения в родительских категориях */
                    if( action == '-1' ){
                        /* выполним сортировку, перемещаем назад */
                        if( (a-1) != -1 ){
                            vm.itemList[a]['sort'] = vm.itemList[a]['sort'] - 1;
                            vm.itemList[a-1]['sort'] = vm.itemList[a]['sort'] + 1;
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
                fetch(`/component/school/sort`, {
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
                        vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
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
                        // vm.closeModal("edit-menu");
                        vm.updateItems(data.result.itemList);
                        vm.showToast(`Сортировка обновлена.`);
                    }
                    return;
                });
                return;
            },
            geocodeAdressRequest: function(event, item, action = null)
            {
                var vm = this;
                if ( vm.geocode.adress.input.length < 2 ) {
                    vm.geocode.adress.list = [];
                    return;
                }
                var request_data = {
                    "input" : vm.geocode.adress.input,
                };

                fetch(`/api/geocode`, {
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
                        vm.showToasts([`Ошибка во время подключения к API Yandex HTTP Geocode.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                        
                    }else if( data.result != null ){
                        if ( data.result.items.length != 0 ) {
                            vm.geocode.adress.list = data.result.items;
                        }
                    }

                    return;
                });
            },

            csvExport(dates) {
                var vm = this;
                var request_data = this.prepareInputExportObjectToRequest(dates);

                axios.post('/statistic/get', {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    body: request_data
                })
                .then(function(response) {
                    console.log(response.data);

                    arrData = response.data.data.map(item => ({
                        ...item
                    }));

                    let csvContent = "data:text/csv;charset=utf-8,";
                    csvContent += [
                        Object.keys(arrData[0]).join(";"),
                        ...arrData.map(item => Object.values(item).join(";"))
                    ]
                        .join("\n")
                        .replace(/(^\[)|(\]$)/gm, "");

                    const data = encodeURI(csvContent);
                    const link = document.createElement("a");
                    link.setAttribute("href", data);
                    link.setAttribute("download", "export.csv");
                    link.click();
                })
                .catch(function(error) {
                    console.log(error);

                    vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                });
            }
        },
    })
</script>
<style>
    /* высота модалок: здесь стили и при init задаем опции: startingTop и endingTop   */
    [data-component="modal"] .modal.modal-fixed-footer {
      height: 85%;
      max-height: 85%;
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
        grid-template-columns: repeat(3, 1fr);
        grid-gap: 5px 20px;
    }
    .list li {
        width: 100%;
    }
    .list video{
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    /* если запись отмечена как ожидающая удаления */
    .about-to-delete{
        background: #fee;
    }
    /* стили для блока транспорта */
    [data-component="avaliable-transport"] b{
        padding: 5px 0 10px 0;
        display: block;
    }
    [data-component="avaliable-transport"] li.collection-item:not(li.collection-item[default]) > div{
        display: grid;
        grid-template-columns: 60px auto 50px;
        align-items: center;
        grid-gap: 10px;

        grid-template-columns: 60px auto 120px 50px;
        grid-gap: 20px;
    }
    [data-component="avaliable-transport"] li span[img]{
        height: 60px;
    }
    [data-component="avaliable-transport"] li span[img] a:hover{
        cursor: pointer;
    }
    [data-component="avaliable-transport"] li a[data-fancybox]{
        height: 100%;
        display: block;
        line-height: 100%;
    }
    [data-component="avaliable-transport"] li img{
        max-width: 100%;
        height: 100%;
        display: block;
        object-fit: cover;
    }
    /* управление категориями */
    [data-component="city-managment"] h6{
        padding: 0px 0 15px;
        margin: 0;
        font-size: 14px;
        font-size: 16px;
        border-bottom: 0px solid #555555c9; 
        font-weight: bold; 
    }
    [data-component="city-managment"] ul{
        margin: 0;

        border: none;
        box-shadow: none;
    }
    [data-component="city-managment"] li i{
        transition: .4s ease-in;
    }
    [data-component="city-managment"] .collapsible-header li.active i{
        transform: rotateX(180deg);
    }
    [data-component="city-managment"] .collapsible-header{
        border: none;
        display: grid;
        grid-template-columns: auto max-content;

        border: none;
        box-shadow: none;
        padding: 0 0 0px 0;
    }
    [data-component="city-managment"] .collapsible-header:focus{
        background: transparent;
    }
    [data-component="city-managment"] .collapsible-body{
        border: none;
        padding: 0;
    }
    [data-component="city-managment"] .collapsible-body > article{
        margin: 15px 0px 0px;
        border-top: 1px solid #ddd;
        padding: 30px 0px 0px 0px;
    }
    [data-component="city-managment-form"] .input-field {
        margin: 0;
        display: grid;
        grid-template-columns: auto 50px;
        align-items: center;
        grid-gap: 15px;
    }
    [data-component="city-managment-form"] input{
        margin: 0;
    }
    [data-component="city-managment-list"] ul.collection .collection-item{
        border: 1px solid #dedede;
        border-radius: 5px;
        margin: 0 0 10px 0;
    } 
    [data-component="city-managment-list"] ul.collection .collection-item[sub-item]{
        margin-left: 25px;
    }
    [data-component="city-managment-list"] .collection-item{
        display: grid;
        grid-template-columns: 65px 200px auto 70px;
        grid-template-columns: 65px auto 250px 130px;
        grid-gap: 10px;
        align-items: center; 
    }
    [data-component="city-managment-list"] .collection-item[sub-item]{

    }
    [data-component="city-managment-list"] .collection-item .managment-buttonset{
        display: grid;
        grid-auto-flow: column;
        grid-gap: 10px;
    }
    [data-component="city-managment-list"] .collection-item a{
        cursor: pointer;
        width: max-content;
        justify-self: flex-end;
        display: grid;
        align-items: center;
    }
    [data-component="city-managment-list"] .collection-item [data-component='sort-managment'] a{
        width: 100%;
    }
    /* [data-module="catalog"] [data-component="item-list"] */
    [data-module="catalog"] [data-component="item-list"] .list-item {
        grid-template-columns: 70px auto 125px 90px 80px 100px;
    }
    [data-module="catalog"] [data-component="item-list"] .list-item.item-body > div{
        justify-content: flex-end;
    }
    /* [data-component="adress-geocode"] */
    [data-component="adress-geocode"] .col.line{
        margin: 0;
    }
    [data-component="adress-geocode"] .col.line article{
        background: #fff;
        border: 1px solid #dedede;
        border-radius: 3px;
    }
    [data-component="adress-geocode"] .col.line p{
        padding: 10px;
    }
    [data-component="adress-geocode"] .col ul{
        padding: 10px;
        max-height: 135px;
        overflow-x: hidden;
        white-space: nowrap;
        background: #fff;
        border: 1px solid #dedede;
        border-radius: 3px;
        margin: 0;
    }
    [data-component="adress-geocode"] .col.line a{
        transition: .2s ease;
    }
    [data-component="adress-geocode"] .col.line a:hover{
        transition: .2s ease;
        color: #0c4b6a;
    }
</style>
</body>
</html>
