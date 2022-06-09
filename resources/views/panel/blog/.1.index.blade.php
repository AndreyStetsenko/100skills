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
                    <article data-component="city-managment">
                          <ul class="collapsible">
                            <li>
                                <div class="collapsible-header">
                                    Управление разделом "Блог": категории.
                                    <i class="material-icons right">arrow_drop_down</i>
                                </div>
                                <div class="collapsible-body">
                                    <article>
                                        <div class="row">
                                            <div class="col s12">
                                                <h6 style="">Добавление категории:</h6>
                                            </div>
                                            <div class="col s12">
                                                <blockquote style="border-left: 5px solid rgb(38, 166, 154); margin: 0; font-size: 12px; padding: 0 15px;">
                                                    Для добавление новой категории укажите название и нажмите иконку "Сохранить"
                                                </blockquote>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <section data-component='city-managment-form'>
                                                    <form>
                                                        <div class="input-field">
                                                          <div>
                                                            <input type="text" v-model="city.create.title">
                                                          </div>
                                                          <a class="btn" @click.prevent="createCityRequest($event)" title="Сохранить" >
                                                            <span><i class="material-icons right">save</i></span>
                                                          </a>
                                                        </div>
                                                    </form>
                                                </section>
                                            </div>
                                        </div>            
                                        <div class="row">
                                            <div class="col s12">
                                                <h6 style="">Список добавленных категорий</h6>
                                            </div>
                                            <div class="col s12">
                                                <blockquote style="border-left: 5px solid rgb(38, 166, 154); margin: 0; font-size: 12px; padding: 0 15px;">
                                                    Доступные функции управления: редактирование, удаление
                                                </blockquote>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <section data-component="city-managment-list">
                                                    <ul class="collection">
                                                        <li class="collection-item" v-for='(cityValue, citykey) in cityList' v-if='cityList != null && cityList.length'>
                                                            <div>
                                                                <div data-component='sort-managment'>
                                                                    <a href="!#" @click.prevent="changeSortCity($event, cityValue, '-1')" class="btn" style="" title='Изменить позицию элемента'>
                                                                       <i class="material-icons right" style="">arrow_drop_up</i>
                                                                    </a>                            
                                                                    <a href="!#" @click.prevent="changeSortCity($event, cityValue, '1')" class="btn" style="" title='Изменить позицию элемента'>
                                                                       <i class="material-icons right" style="">arrow_drop_down</i>
                                                                    </a>
                                                                </div>
                                                                <span>
                                                                    @{{ cityValue['title'] }}
                                                                </span>
                                                                <div class="managment-buttonset" data-component="manage">
                                                                    <a style="cursor: pointer;" @click.prevent="openCitySubModal($event, cityValue)"><i class="material-icons" title='Редактировать'>edit</i></a>
                                                                    <a style="cursor: pointer;" @click.prevent="removeCityRequest($event, cityValue)"><span class="material-icons" title='Удалить'>delete_outline</span></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="collection-item" v-if='city.list.length == 0'>
                                                            <div style="display: block;">
                                                                <span>
                                                                    <i style="font-size: 12px;">Категории не добавлены: необходимо добавить новую.</i>
                                                                </span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </section>
                                            </div>
                                        </div>
                                    </article>                      
                                </div>
                            </li>
                        </ul>
                    </article>
                </div>
                <div row>
                    <article>
                        <div>Управление разделом "Блог": спискок</div>
                    </article>
                    <article class="module-managment">
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='createItem($event)'><i class="material-icons left">add</i>Добавить</a>
                        </div>
                        <div>
                            <a class="waves-effect waves-light btn-small" @click.prevent='removeSelectedItems($event)'><i class="material-icons left">remove</i>Удалить выбранные</a>
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
                                    Наименовение
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
                                <div>
                                    <form v-if="item['is_visible']">
                                        <p>
                                          <label>
                                            <input type="checkbox" checked v-model="item.is_visible" @change.prevent="updateVisible($event, item)"/>
                                            <span></span>
                                          </label>
                                        </p>
                                    </form>
                                    <form v-else>
                                        <p>
                                          <label>
                                            <input type="checkbox"  v-model="item.is_visible" @change.prevent="updateVisible($event, item)"/>
                                            <span></span>
                                          </label>
                                        </p>
                                    </form>
                                </div>
                                <div>
                                    <form>
                                        <p>
                                          <label>
                                            <input type="checkbox" v-model="form.removeItem.ids" v-bind:value="item.id"/>
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
                                <div class="input-field col s12">
                                    <input placeholder="Стоимость" 
                                           id="price" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.price">
                                    <label for="price">Стоимость</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body-create" 
                                        name="body-create" 
                                        data-component='tinymce' 
                                        placeholder="Основной текст" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>

                            <div class="row">
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
                                <div class="input-field-custom col s12">
                                    <label>Город отправления</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.departure_city_id">
                                        <option value="" disabled selected>Выберите город отправления</option>
                                        <option value="-">-</option>
                                        <option v-for='(city, cityKey) in city.list' v-bind:value="city.id">@{{ city['title'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>Город прибытия</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.arrival_city_id">
                                        <option value="" disabled selected>Выберите город прибытия</option>
                                        <option value="-">-</option>
                                        <option v-for='(city, cityKey) in city.list' v-bind:value="city.id">@{{ city['title'] }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12"> 
                                    <section articles data-component='avaliable-transport'>
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                    <b>
                                                        Добавить транспорт: 
                                                    </b>
                                                    <select class="browser-default" @change.prevent='addTransportItemRequest($event)'>
                                                        <option disabled selected value="-1">Выберите транспорт для добавления:</option>
                                                        <option value="-">-</option>
                                                        <option v-for='(transport, transportKey) in transport.list' v-bind:value="transport.id">@{{ transport['title'] }}</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li class="collection-item" v-for='(transport, transportkey) in form.createTask.inputs.transport' v-if='form.createTask.inputs.transport.length'>
                                                <div>
                                                    <span img>
                                                        <a v-if="transport['gallery'] && transport['gallery'][0]" data-fancybox v-bind:data-src="transport['gallery'][0]['src']">
                                                          <img v-bind:src="transport['gallery'][0]['src']" v-bind:alt="transport['gallery'][0]['id']"/>
                                                        </a>
                                                        <img v-else src='/public/files/no-image.png'>
                                                    </span>
                                                    <span>
                                                        @{{ transport['title'] }}
                                                    </span>
                                                    <span>
                                                        <input type="text" 
                                                               name="price"
                                                               placeholder="Стоимость"
                                                               v-model="transport['price']">
                                                    </span>
                                                    <a style="justify-self: end; cursor: pointer;" @click.prevent="removeTransportItem($event, transport)"><span class="material-icons" title='Удалить транспорт из направления'>delete_outline</span></a>
                                                </div>
                                            </li>
                                            <li class="collection-item" default v-if='form.createTask.inputs.transport.length == 0'>
                                                <div>
                                                    <span>
                                                        <i style="font-size: 12px;">Доступный транспорт не выбран: выберите из выпадающего списка.</i>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>  
                                    </section>  
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
                                <div class="input-field col s12">
                                    <input placeholder="Стоимость" 
                                           id="price" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.price">
                                    <label for="price">Стоимость</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>Основной текст</label>
                                    <textarea 
                                        id="body-edit" 
                                        name="body-edit" 
                                        data-component='tinymce' 
                                        placeholder="Основной текст" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>
                            <div class="row">
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
                                <div class="input-field-custom col s12">
                                    <label>Город отправления</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.departure_city_id">
                                        <option value="" disabled selected>Выберите город отправления</option>
                                        <option value="-">-</option>
                                        <option v-for='(city, cityKey) in city.list' v-bind:value="city.id">@{{ city['title'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>Город прибытия</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.arrival_city_id">
                                        <option value="" disabled selected>Выберите город прибытия</option>
                                        <option value="-">-</option>
                                        <option v-for='(city, cityKey) in city.list' v-bind:value="city.id">@{{ city['title'] }}</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12"> 
                                    <section articles data-component='avaliable-transport'>
                                        <ul class="collection with-header">
                                            <li class="collection-header">
                                                <div>
                                                    <b>
                                                        Добавить транспорт: 
                                                    </b>
                                                    <select class="browser-default" @change.prevent='addTransportItemRequest($event)'>
                                                        <option disabled selected value="-1">Выберите транспорт для добавления:</option>
                                                        <option value="-">-</option>
                                                        <option v-for='(transport, transportKey) in transport.list' v-bind:value="transport.id">@{{ transport['title'] }}</option>
                                                    </select>
                                                </div>
                                            </li>
                                            <li class="collection-item" v-for='(transport, transportkey) in form.createTask.inputs.transport' v-if='form.createTask.inputs.transport.length'>
                                                <div>
                                                    <span img>
                                                        <a v-if="transport['gallery'] && transport['gallery'][0]" data-fancybox v-bind:data-src="transport['gallery'][0]['src']">
                                                          <img v-bind:src="transport['gallery'][0]['src']" v-bind:alt="transport['gallery'][0]['id']"/>
                                                        </a>
                                                        <img v-else src='/public/files/no-image.png'>
                                                    </span>
                                                    <span>
                                                        @{{ transport['title'] }}
                                                    </span>
                                                    <span>
                                                        <input type="text" 
                                                               name="price"
                                                               placeholder="Стоимость"
                                                               v-model="transport['price']">
                                                    </span>
                                                    <a style="justify-self: end; cursor: pointer;" @click.prevent="removeTransportItem($event, transport)"><span class="material-icons" title='Удалить транспорт из направления'>delete_outline</span></a>
                                                </div>
                                            </li>
                                            <li class="collection-item" default v-if='form.createTask.inputs.transport.length == 0'>
                                                <div>
                                                    <span>
                                                        <i style="font-size: 12px;">Доступный транспорт не выбран: выберите из выпадающего списка.</i>
                                                    </span>
                                                </div>
                                            </li>
                                        </ul>  
                                    </section>  
                                </div>
                            </div>
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
            <section data-component='sub-modal' class="city-submodal">
                <div id="city-submodal" class="modal modal-fixed-footer bottom-sheet">
                    <div class="modal-content">
                        <h4>Редактирование города</h4>
                        <blockquote>
                            Для редактирования наименования города измените текстовое поле и нажмите сохранить
                        </blockquote>
                        <input type="text" v-model="city.edit.title" placeholder="Title">
                        <input type="text" v-model="city.edit.slug" placeholder="URL">
                        
                        <input type="text" v-model="city.edit.meta_title" placeholder="Title (meta)">
                        <input type="text" v-model="city.edit.meta_description" placeholder="Description (meta)">
                        <input type="text" v-model="city.edit.meta_keywords" placeholder="Keywords (meta)">

                        <div class="col s12" input-field style="padding: 20px 0 0 0;">
                            <textarea 
                                id="city-seo-text-edit" 
                                name="city-seo-text-edit" 
                                data-component='tinymce' 
                                placeholder="SEO текст" 
                                required='required' 
                                v-model="city.edit.seo_text"></textarea>
                        </div>
                        <div style="padding: 10px; background: #fff; margin: 15px 0 0 0; border-radius: 3px; border: 1px solid #dedede;">
                            <label>
                                <input class="filled-in" type="checkbox" checked v-model="city.edit.is_menu" />
                                <span style="height: 20px; line-height: 20px;">Отображать в боковом меню</span>
                            </label>
                        </div>
                        <section data-component='transport-gallery'>
                            <div class="row file-field grey-label">
                                <div class="list">
                                    <ul>
                                        <li v-for='(item, key) in city.edit.gallery'>
                                            <button class="btn remove-button" @click.prevent="removeCityGalleryItemRequest($event, item, '/component/city-gallery')">
                                                <i class="material-icons right">clear</i>
                                            </button>
                                            <img v-bind:src="item.src" class="circle" v-bind:alt="item.title">
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <p style="margin: 0 0 10px;"><small><i>Нажмите на кнопку "Добавить изображение" чтобы загрузить изображение для выбранного города.</i></small></p> 
                                    <div class="btn" style="position: relative;">
                                        <span>Добавить изображение</span>
                                        <input type="file" @change.prevent="addCityGalleryItems($event)" style="height: 45px; top: 0;">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" style="border: unset; box-shadow: unset; color: transparent;">
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="editCityRequest($event)">Сохранить</a>
                        <a href="#!" class="modal-close waves-effect waves-blue btn-flat" @click.prevent>Закрыть</a>
                    </div>
                </div>
            </section>
        </main>
    </div>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
<script src="https://cdn.tiny.cloud/1/qespi14zyov8h6lvcaqartp18vkl12sdk4x0nk80kl23s9oi/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" />
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>

<script>
    var app = new Vue({
        el: '#app',
        data: {
            /* карточки */
            items: {!! $items !!},
            /* доступный транспорт */
            transport: {
                list: {!! $transport !!},
            },
            /* доступные города */
            city: {
                list: {!! $city !!},
                create: {
                    title: '',
                },
                edit: {
                    title: '',
                    meta_title: '',
                    meta_description: '',
                    meta_keywords: '',
                    is_menu: '',
                    gallery: [],
                },
            }, 
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
                    inputs: {
                        id: "",
                        title: "",
                        slug: "",
                        price: "",
                        body: "",

                        meta_title: "",
                        meta_description: "",
                        meta_keywords: "",

                        departure_city: {
                            is_active: null,
                            departure_city_id: "",
                            departure_city_list: null,
                        },
                        arrival_city: {
                            is_active: null,
                            arrival_city_id: "",
                            arrival_city_list: null,
                        },
                        transport: [],
                    },
                    path: {

                    }
                },
                removeItem: {
                    inputs: {
                        id: '',
                        title: '',
                        introduction: '',
                        title_photo: '',
                        video_src: '',
                        body_text: '',
                    },
                    ids: [],
                }, /* data удаляемого элемента */
            },
        },
        created: function(){
            /* инициализация tiny окна */
            window.tinyMCE.init({
                selector: "#create-task [data-component='tinymce']#body-create",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });

            window.tinyMCE.init({
                selector: "#edit-task [data-component='tinymce']#body-edit",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });

            window.tinyMCE.init({
                selector: "[data-component='tinymce']#city-seo-text-edit",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });

            this.setPages();

        },
        mounted: function(){
            M.Collapsible.init(document.querySelectorAll(`[data-component="city-managment"] .collapsible`), {});
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
            cityList: function(){
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
                let result = this.city.list.sort(compare);
                return result;
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
                    price: this.form.createTask.inputs.price,

                    body: "",

                    meta_title: this.form.createTask.inputs.meta_title,
                    meta_description: this.form.createTask.inputs.meta_description,
                    meta_keywords: this.form.createTask.inputs.meta_keywords,

                    departure_city_id: this.form.createTask.inputs.departure_city_id,
                    arrival_city_id: this.form.createTask.inputs.arrival_city_id,
                    
                    transport: this.form.createTask.inputs.transport,
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
                    price: item.price != null ? item.price : "",

                    body: item.body != null ? item.body : "",

                    meta_title: item.meta_title != null ? item.meta_title : "",
                    meta_description: item.meta_description != null ? item.meta_description : "",
                    meta_keywords: item.meta_keywords != null ? item.meta_keywords : "",

                    /* departure belongsTo city model */
                    departure: {
                        id: (item.departure != null && item.departure.id != null) ? item.departure.id : "",
                        title: ( item.departure != null && item.departure.title != null) ? item.departure.title : "",
                    },
                    departure_city_id: (item.departure != null && item.departure.id != null) ? item.departure.id : "",

                    /* arrival belongsTo city model */
                    arrival: {
                        id: (item.arrival != null && item.arrival.id != null) ? item.arrival.id : "",
                        title: (item.arrival != null && item.arrival.title != null) ? item.arrival.title : "",
                    },
                    arrival_city_id: (item.arrival != null && item.arrival.id != null) ? item.arrival.id : "",

                    transport: item.transport != null ? item.transport : [],
                };

                /* из БД нам пришел transport.pivot.price, и мы приведем его к transport.price */
                for( let t of item.transport ){
                    t.price = t.pivot.price;
                }

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
                    slug: "",
                    price: "",
                    body: "",

                    meta_title: "",
                    meta_description: "",
                    meta_keywords: "",

                    departure_city_id: "",
                    arrival_city_id: "",

                    transport: [],  
                };

                
                /* при открытии модального окна - обновляем значение tiny */
                tinyMCE.get('body-create').setContent("");
                
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
                
                request_data.body = tinyMCE.get('body-create').getContent();

                fetch(`/component/directions`, {
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
               
                request_data.body = tinyMCE.get('body-edit').getContent();

                var item_id = request_data.id;
                fetch(`/component/directions/${item_id}`, {
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
                tinyMCE.get('body-edit').setContent(item_prepared.body);

                /* извлечение информации из формы */
                var request_data = this.prepareInputObjectToRequest();
                request_data.body = tinyMCE.get('body-edit').getContent();
                request_data.is_visible = item.is_visible;

                fetch(`/component/directions/${item.id}`, {
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
                fetch(`/component/directions/${this.form.removeItem.inputs.id}`, {
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
                fetch(`/component/directions/0`, {
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
                        var toasts = [`Файлы галлереи загружены.`, `После сохранения объекта недвижимости, изображения будут сохранены.`];
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
                    vm.city.edit.gallery.push(tmp_gallery_obj);
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
            /* функции работы с транспортом */
            /**
             * 
             * @param event - событие
             *
             * добавляет блок к новой записи: без сохранения
             *
             */
            addTransportItemRequest: function(event)
            {
                var vm = this;

                /* данные для запроса */
                var request_data = {
                    'transport' : event.target.value,
                    'item' : vm.form.createTask.inputs.id,
                };

                /* определим доступные варианты транспорта */
                let is_able_to_add = 1;

                if ( vm.form.createTask.inputs.transport.length == 0 ) {
                    is_able_to_add = 1;
                }else if ( request_data['transport'] == "-" ){
                    is_able_to_add = 1;
                }else {
                    for( let t of vm.form.createTask.inputs.transport ){
                        if ( t['id'] == request_data['transport'] ) {
                            is_able_to_add = !1;
                        }
                    }
                }

                if ( !is_able_to_add ){
                    /* после завершения обнуляем select */
                    event.target.value = -1; 

                    /* сообщение об ошибке на фронте */
                    vm.showToasts([`Ошибка добавления транспорта.`, `Выбранный вами транспорт уже добавлен.`]);
                    return;
                }
                
                /* сделаем запрос на получение доступных вариантов транспорта */
                fetch(`/component/directions-transport`, {
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
                    return response.json();
                })
                .then(function(data){
                    if ( data.result.status ) {
                        /* получили транспорт */
                        /* т.к цена хранится в таблице с отношениями BelongsToMany, то получаем её в pivot */
                        data.result.transport['price'] = "";
                        vm.form.createTask.inputs.transport.push(data.result.transport);
                    }else{
                        /* ошибка получения транспорта */
                        if ( data.result.messages ) {
                            vm.showToasts(data.result.messages);
                        }else{
                            vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                        }
                    }
                });
                
                /* после завершения обнуляем select */
                event.target.value = -1; 
            },
            /**
             *
             * @param item - транспорт
             *
             * удаляет транспорт из текущего объекта
             *
             */
            removeTransportItem: function(event, item)
            {
                
                var vm = this;

                /* если объект создан - ищем в текущем выбранном объекте совпадения по ID, удаляем в списке, в базе обновится после сохранения объекта */
                let c = vm.form.createTask.inputs.transport.findIndex(function(value, key){
                    return item.id == value.id;
                });
                vm.form.createTask.inputs.transport.splice(c, 1);
                vm.showToasts([`Транспорт удален.`, `Изменения вступят в силу после сохранения объекта.`]);
                return; 
            },
            /*функция 2022*/
            
            
            /* работа с city (городами) */
             
            /**
             *
             * @param event - событие
             * @param city - город
             *
             * открывает запрашиваемое окно для редактирования
             *
             */
            openCitySubModal: function(event, city = null)
            {
                /* откроем модельной окно для редактирования пресета */
                var vm = this;

                /* назначаем редактируемый объект */
                vm.city.edit = city

                /* при открытии модального окна - обновляем значение tiny  */
                tinyMCE.get('city-seo-text-edit').setContent((vm.city.edit.seo_text ? vm.city.edit.seo_text : ""));

                /* открыть модальное окно */
                vm.initModal(`city-submodal`);

                return;
            },
            /**
             *
             * @param event - событие
             *
             * запрос на создание объекта
             * показывает уведомление о результате
             *
             */
            /* функция 2022 */
            createCityRequest: function(event)
            {
                var vm = this;
                var request_data = vm.city.create;

                fetch(`/component/city`, {
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
                        vm.city.list = data.result.items;
                        vm.showToast(`Запись добавлена.`);

                        /* обнолим форму создания */
                        vm.city.create.title = "";
                    }

                    return;
                });
            },
           
            /**
             *
             * @param event - событие
             *
             * редактирует объект
             *
             */
            editCityRequest: function(event = null)
            {
                var vm = this;
                var request_data = vm.city.edit;
                request_data.seo_text = tinyMCE.get('city-seo-text-edit').getContent();

                fetch(`/component/city/${vm.city.edit.id}`, {
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
                    
                    if( data.errors != null ){
                        vm.showToast(`Ошибка обновления.`);
                        let step = 1;
                        for( let error in data.errors ){
                            setTimeout(function(argument) {
                                vm.showToast(data.errors[error][0]);
                            }, 250*step);
                            step = step + 1;
                        }
                    }else if( data.result != null ){
                        vm.city.list = data.result.items;
                        /* сообщение об успехе */
                        vm.showToast(`Изменения сохранены`);
                        
                        /* закроем модальное окно */
                        vm.closeModal(`city-submodal`);
                    }
                    return;
                });
            },
            /**
             *
             * @param event - событие
             * @param item - текущая задача
             *
             * удаляет задание
             * показывает уведомление о результате
             *
             */
            removeCityRequest: function(event, item = null)
            {
                var vm = this;
               
                fetch(`/component/city/${item.id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'DELETE',
                    body: JSON.stringify({method: 'remove', type: vm.city.create.type})
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
                        vm.showToast(`Город '${item.title}' удален.`);
                        
                        /* обновим список объектов */
                        vm.city.list = data.result.city;

                        /* обновим список лекций (т.к возможно изменились привязки) */
                        vm.items = data.result.items;
                    }
                });
            },
            /*
             *
             * добавляем в список выбранного объекта фотографию планировки: запрос
             *
             */
            addCityGalleryItems: function (event) 
            {
                var vm = this;
                var files = event.target.files;
                var formData = new FormData();
                for( file of files ){
                    formData.append("file[]", file);
                }
                vm.showToast(`Начало загрузки файлов...`);
                fetch(`/component/city-gallery`, {
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
                        var toasts = [`Файлы галлереи загружены.`, `После сохранения объекта недвижимости, изображения будут сохранены.`];
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
            addCityGalleryItemsView: function (files) 
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
                    vm.form.createTask.inputs.gallery.catalog_gallery_list.push(tmp_gallery_obj);
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
            removeCityGalleryItemRequest: function(event, item, route = null)
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
            removeCityImgItemView: function(item)
            {
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
                fetch(`/component/directions/sort`, {
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
            /**
             *
             * @param event - событие
             * @param item - текущий файл
             * @param action - направление (выше, ниже)
             *
             * изменяет позицию элемента (сортировку) в списке
             *
             */
            changeSortCity: function(event, item, action = null)
            {
                var vm = this;
                if( action == null ){
                    console.log("No action has found - no action will be take.")
                    return;
                }
                /* ищем элемент */
                let a;
                a = vm.cityList.findIndex(function(value, key){
                    /* если проверка будет по id, то новые фото нельзя будет сортировать */
                    return item.id == value.id;
                });

                if( a > -1 ){
                    /* изменения в родительских категориях */
                    if( action == '-1' ){
                        /* выполним сортировку, перемещаем назад */
                        if( (a-1) != -1 ){
                            vm.cityList[a]['sort'] = vm.cityList[a]['sort'] - 1;
                            vm.cityList[a-1]['sort'] = vm.cityList[a]['sort'] + 1;
                        }
                    }else{
                        /* перемещаем вперед */
                        if( vm.cityList[a+1] != null ){
                            vm.cityList[a]['sort'] = vm.cityList[a]['sort'] + 1;
                            vm.cityList[a+1]['sort'] = vm.cityList[a]['sort'] - 1;
                        }
                    }
                }else{
                    /* изменения в подкатегориях */
                    for( submenu in vm.cityList ){
                        if( vm.cityList[submenu]['childs'].length ){
                            a = vm.cityList[submenu]['childs'].findIndex(function(value, key){
                                /* если индекс найден - выполним сортировку */
                                if( item.id == value.id ){
                                    if( action == '-1' ){
                                        /* перемещаем назад */
                                        if( (key-1) != -1 ){
                                            vm.cityList[submenu]['childs'][key]['sort'] = vm.cityList[submenu]['childs'][key]['sort'] - 1;
                                            vm.cityList[submenu]['childs'][key-1]['sort'] = vm.cityList[submenu]['childs'][key]['sort'] + 1;
                                        }
                                    }else{
                                        /* перемещаем вперед */
                                        if( vm.cityList[submenu]['childs'][key+1] != null ){
                                            vm.cityList[submenu]['childs'][key]['sort'] = vm.cityList[submenu]['childs'][key]['sort'] + 1;
                                            vm.cityList[submenu]['childs'][key+1]['sort'] = vm.cityList[submenu]['childs'][key]['sort'] - 1;
                                        }
                                    }
                                }
                                return item.id == value.id;
                            });
                        }
                    }

                }

                var request_data = vm.cityList;
                fetch(`/component/city/sort`, {
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
                        vm.city.list = data.result.itemList;
                        // vm.updateItems(data.result.itemList);
                        vm.showToast(`Сортировка обновлена.`);
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
    /* управление городами */
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
    [data-component="city-managment-list"] ul.collection li.collection-item{
        border: 1px solid #dedede;
        border-radius: 5px;
        margin: 0 0 10px 0;
    } 
    [data-component="city-managment-list"] li.collection-item > div{
        display: grid;
        grid-template-columns: 65px auto 70px;
        grid-gap: 10px;
        align-items: center; 
    }
    [data-component="city-managment-list"] li.collection-item .managment-buttonset{
        display: grid;
        grid-auto-flow: column;
        grid-gap: 10px;
    }
    [data-component="city-managment-list"] li.collection-item a{
        cursor: pointer;
        width: max-content;
        justify-self: flex-end;
        display: grid;
        align-items: center;
    }
    [data-component="city-managment-list"] li.collection-item [data-component='sort-managment'] a{
        width: 100%;
    }
</style>
</body>
</html>
