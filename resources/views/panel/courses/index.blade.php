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
            <section data-component="category-list" style="padding-bottom: 0;">
                <div row>
                    <article data-component="city-managment">
                          <ul class="collapsible">
                            <li>
                                <div class="collapsible-header">
                                    Управление разделом "Курсы": категории.
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
                                                    Для добавление новой категории нажмите иконку "Добавить"
                                                </blockquote>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col s12">
                                                <a class="waves-effect waves-light btn-small" @click.prevent='openCategorySubModalCreate($event)'><i class="material-icons left">add</i>Добавить</a>
                                            </div>
                                        </div>
                                        <?php if ( !1 ): ?>
                                            <!-- пример простой разметки для сохранения категорий -->
                                            <div class="row">
                                                <div class="col s12">
                                                    <section data-component='city-managment-form'>
                                                        <form>
                                                            <div class="input-field">
                                                              <div>
                                                                <input type="text" v-model="category.create.title">
                                                              </div>
                                                              <a class="btn" @click.prevent="createCategoryRequest($event)" title="Сохранить" >
                                                                <span><i class="material-icons right">save</i></span>
                                                              </a>
                                                            </div>
                                                        </form>
                                                    </section>
                                                </div>
                                            </div>
                                        <?php endif ?>
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
                                                        <li v-for='(value, key) in categoryList' v-if='categoryList != null && categoryList.length'>
                                                            <article >
                                                                <div class="collection-item">
                                                                    <div data-component='sort-managment'>
                                                                        <a href="!#" @click.prevent="changeSortCategory($event, value, '-1')" class="btn" style="" title='Изменить позицию элемента'>
                                                                           <i class="material-icons right" style="">arrow_drop_up</i>
                                                                        </a>                            
                                                                        <a href="!#" @click.prevent="changeSortCategory($event, value, '1')" class="btn" style="" title='Изменить позицию элемента'>
                                                                           <i class="material-icons right" style="">arrow_drop_down</i>
                                                                        </a>
                                                                    </div>
                                                                    <span>
                                                                        @{{ value['title'] }}
                                                                    </span>
                                                                    <div>
                                                                        <section data-component="is_visible_buttonset">                   
                                                                            <form>
                                                                                <p>
                                                                                  <label>
                                                                                    <input 
                                                                                          v-if="value['is_visible']" 
                                                                                          checked 
                                                                                          type="checkbox" 
                                                                                          v-model="value.is_visible" 
                                                                                          @change.prevent="updateVisibleCategory($event, value)" 
                                                                                          class="filled-in"/>
                                                                                    <input 
                                                                                          v-else 
                                                                                          type="checkbox"  
                                                                                          v-model="value.is_visible" 
                                                                                          @change.prevent="updateVisibleCategory($event, value)" 
                                                                                          class="filled-in"/>
                                                                                    <span>Отображать на сайте</span>
                                                                                  </label>
                                                                                </p>
                                                                            </form>
                                                                        </section>
                                                                    </div>
                                                                    <div class="managment-buttonset" data-component="manage">
                                                                        <a style="cursor: pointer;" @click.prevent="openCategorySubModalEdit($event, value)"><i class="material-icons" title='Редактировать'>edit</i></a>
                                                                        <a @click.prevent='openCategorySubModalCreate($event, value)'><span class="material-icons" title='Добавить подкатегорию'>add_to_photos</span></a>
                                                                        <a style="cursor: pointer;" @click.prevent="removeCategoryRequest($event, value)"><span class="material-icons" title='Удалить'>delete_outline</span></a>
                                                                    </div>
                                                                </div>
                                                            </article>
                                                            <article v-if="value.childs != null && value.childs.length > 0">

                                                                <div class="collection-item" 
                                                                     sub-item 
                                                                     v-for='subcategory in value.childs' :key='subcategory.id'>
                                                                    <div data-component='sort-managment'>
                                                                        <a href="!#" @click.prevent="changeSortCategory($event, subcategory, '-1')" class="btn" style="" title='Изменить позицию элемента'>
                                                                           <i class="material-icons right" style="">arrow_drop_up</i>
                                                                        </a>                            
                                                                        <a href="!#" @click.prevent="changeSortCategory($event, subcategory, '1')" class="btn" style="" title='Изменить позицию элемента'>
                                                                           <i class="material-icons right" style="">arrow_drop_down</i>
                                                                        </a>
                                                                    </div>
                                                                    <div>
                                                                        @{{ subcategory['title'] }}
                                                                    </div>
                                                                    <div>
                                                                        <section data-component="is_visible_buttonset">                   
                                                                            <form>
                                                                                <p>
                                                                                  <label>
                                                                                    <input 
                                                                                          v-if="subcategory['is_visible']" 
                                                                                          checked 
                                                                                          type="checkbox" 
                                                                                          v-model="subcategory.is_visible" 
                                                                                          @change.prevent="updateVisibleCategory($event, subcategory)" 
                                                                                          class="filled-in"/>
                                                                                    <input 
                                                                                          v-else 
                                                                                          type="checkbox"  
                                                                                          v-model="subcategory.is_visible" 
                                                                                          @change.prevent="updateVisibleCategory($event, subcategory)" 
                                                                                          class="filled-in"/>
                                                                                    <span>Отображать на сайте</span>
                                                                                  </label>
                                                                                </p>
                                                                            </form>
                                                                        </section>
                                                                    </div>
                                                                    <div class="managment-buttonset" data-component="manage">
                                                                        <a style="cursor: pointer;" @click.prevent="openCategorySubModalEdit($event, subcategory)"><i class="material-icons" title='Редактировать'>edit</i></a>
                                                                        <a style="cursor: pointer;" @click.prevent="removeCategoryRequest($event, subcategory)"><span class="material-icons" title='Удалить'>delete_outline</span></a>
                                                                    </div>
                                                                </div>
                                                                
                                                            </article>
                                                        </li>
                                                        <li class="collection-item" v-if='category.list.length == 0' style="grid-template-columns: 100%;">
                                                            <div style="display: block; ">
                                                                <span style="">
                                                                    <i style="font-size: 12px;">Категории не добавлены: необходимо создать новую.</i>
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
            </section>
            <section data-component="item-list" style="padding-top: 0;">          
                <div row>
                    <article>
                        <div>Управление разделом "Курсы": список</div>
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
                            <a href="#!" @click.prevent="pagination.page = number">@{{ number }}</a>
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
                                <div class="input-field-custom col s12">
                                    <label>Школа</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.school_id">
                                        <option value="" disabled selected>Выберите школу</option>
                                        <option value="-">-</option>
                                        <option v-for='(item, key) in school.list' v-bind:value="item.id">@{{ item['title'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>Категория</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.category_id">
                                        <option value="" disabled selected>Выберите категорию</option>
                                        <option value="-">-</option>
                                        <option v-for='(item, key) in category.list' v-bind:value="item.id">@{{ item['title'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>
                                        <input 
                                              type="checkbox"  
                                              v-model="form.createTask.inputs.is_popular"  
                                              class="filled-in"/>
                                        <span>Чекбокс "Популярный курс"</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>
                                        <input 
                                              type="checkbox"  
                                              v-model="form.createTask.inputs.is_online"  
                                              class="filled-in"/>
                                        <span>Чекбокс "Онлайн курс"</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Автор" 
                                           id="author" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.author">
                                    <label for="author">Автор</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Длительность (мес)" 
                                           id="duration" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.duration">
                                    <label for="duration">Длительность (мес)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Стоимость (USD)" 
                                           id="price" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.price">
                                    <label for="price">Стоимость (USD)</label>
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
                                    <div class="input-field col s12">
                                        <input placeholder="Canonical" 
                                               id="meta_canonical" 
                                               type="text" 
                                               class="validate"
                                               v-model="form.createTask.inputs.meta_canonical" >
                                        <label for="meta_canonical">Canonical (meta)</label>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_short" 
                                        name="body_short" 
                                        data-component='tinymce' 
                                        placeholder="Краткое описание" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_short"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_long" 
                                        name="body_long" 
                                        data-component='tinymce' 
                                        placeholder="Полное описание" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_long"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_goals" 
                                        name="body_goals" 
                                        data-component='tinymce' 
                                        placeholder="Текст “Чему вы научитесь”" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_goals"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_course" 
                                        name="body_course" 
                                        data-component='tinymce' 
                                        placeholder="Текст “Описание курса”" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_course"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>
                            <div class="row file-field grey-label">
                                <div class="list">
                                    <ul>
                                        <li v-for='(item, key) in form.createTask.inputs.gallery.list'>
                                            <button class="btn remove-button" @click.prevent="removeGalleryItemRequest($event, item, '/component/transport-gallery')">
                                                <i class="material-icons right">clear</i>
                                            </button>
                                            <img v-bind:src="item.src" class="circle" v-bind:alt="item.title">
                                            <div class="sort-managment">
                                                <a href="!#" @click.prevent="changePositionGallery($event, item, '-1')" class="btn" style="background: #dedede; color: #111;" title='Изменить позицию элемента'>
                                                   <i class="material-icons right">arrow_drop_up</i>
                                                </a>                            
                                                <a href="!#" @click.prevent="changePositionGallery($event, item, '1')" class="btn" style="background: #dedede; color: #111;" title='Изменить позицию элемента'>
                                                   <i class="material-icons right">arrow_drop_down</i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col s12">
                                    <p style="margin: 0 0 10px;"><small><i>Нажмите на кнопку "Добавить изображение" чтобы загрузить главное изображение.</i></small></p> 
                                    <div class="btn" style="position: relative;">
                                        <span>Добавить изображение</span>
                                        <input type="file" @change.prevent="addGalleryItems($event, '/component/transport-gallery')" style="height: 45px; top: 0;">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" style="border: unset; box-shadow: unset; color: transparent;">
                                    </div>
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
                                <div class="input-field-custom col s12">
                                    <label>Школа</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.school_id">
                                        <option value="" disabled selected>Выберите школу</option>
                                        <option value="-">-</option>
                                        <option v-for='(item, key) in school.list' v-bind:value="item.id">@{{ item['title'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>Категория</label>
                                    <select class="browser-default" v-model="form.createTask.inputs.category_id">
                                        <option value="" disabled selected>Выберите категорию</option>
                                        <option value="-">-</option>
                                        <option v-for='(item, key) in category.list' v-bind:value="item.id">@{{ item['title'] }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>
                                        <input 
                                              type="checkbox"  
                                              v-model="form.createTask.inputs.is_popular"  
                                              class="filled-in"/>
                                        <span>Чекбокс "Популярный курс"</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field-custom col s12">
                                    <label>
                                        <input 
                                              type="checkbox"  
                                              v-model="form.createTask.inputs.is_online"  
                                              class="filled-in"/>
                                        <span>Чекбокс "Онлайн курс"</span>
                                    </label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Автор" 
                                           id="author" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.author">
                                    <label for="author">Автор</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Длительность (мес)" 
                                           id="duration" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.duration">
                                    <label for="duration">Длительность (мес)</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input placeholder="Стоимость (USD)" 
                                           id="price" 
                                           type="text" 
                                           class="validate"
                                           v-model="form.createTask.inputs.price">
                                    <label for="price">Стоимость (USD)</label>
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
                                    <div class="input-field col s12">
                                        <input placeholder="Canonical" 
                                               id="meta_canonical" 
                                               type="text" 
                                               class="validate"
                                               v-model="form.createTask.inputs.meta_canonical" >
                                        <label for="meta_canonical">Canonical (meta)</label>
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_short_edit" 
                                        name="body_short" 
                                        data-component='tinymce' 
                                        placeholder="Краткое описание" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_short"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_long_edit" 
                                        name="body_long" 
                                        data-component='tinymce' 
                                        placeholder="Полное описание" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_long"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_goals_edit" 
                                        name="body_goals" 
                                        data-component='tinymce' 
                                        placeholder="Текст “Чему вы научитесь”" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_goals"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col s12" input-field>
                                    <label default>
                                    <textarea 
                                        id="body_course_edit" 
                                        name="body_course" 
                                        data-component='tinymce' 
                                        placeholder="Текст “Описание курса”" 
                                        required='required' 
                                        v-model="form.createTask.inputs.body_course"></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <h6 style="font-weight: bold; border-bottom: 0px solid #555555c9; padding: 0 0 10px;">Дополнительная информация:</h6>
                                </div>
                            </div>
                            <div class="row file-field grey-label">
                                <div class="list">
                                    <ul>
                                        <li v-for='(item, key) in form.createTask.inputs.gallery.list'>
                                            <button class="btn remove-button" @click.prevent="removeGalleryItemRequest($event, item, '/component/transport-gallery')">
                                                <i class="material-icons right">clear</i>
                                            </button>
                                            <img v-bind:src="item.src" class="circle" v-bind:alt="item.title">
                                            <div class="sort-managment">
                                                <a href="!#" @click.prevent="changePositionGallery($event, item, '-1')" class="btn" style="background: #dedede; color: #111;" title='Изменить позицию элемента'>
                                                   <i class="material-icons right">arrow_drop_up</i>
                                                </a>                            
                                                <a href="!#" @click.prevent="changePositionGallery($event, item, '1')" class="btn" style="background: #dedede; color: #111;" title='Изменить позицию элемента'>
                                                   <i class="material-icons right">arrow_drop_down</i>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col s12">
                                    <p style="margin: 0 0 10px;"><small><i>Нажмите на кнопку "Добавить изображение" чтобы загрузить главное изображение.</i></small></p> 
                                    <div class="btn" style="position: relative;">
                                        <span>Добавить изображение</span>
                                        <input type="file" @change.prevent="addGalleryItems($event, '/component/transport-gallery')" style="height: 45px; top: 0;">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" style="border: unset; box-shadow: unset; color: transparent;">
                                    </div>
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
            <section data-component='sub-modal' class="category-submodal-create">
                <div id="category-submodal-create" class="modal modal-fixed-footer bottom-sheet">
                    <div class="modal-content">
                        <h4>Добавление категории</h4>
                        <blockquote>
                            Для добавления категории заполните поля и нажмите сохранить
                        </blockquote>
                        <input type="text" v-model="category.create.title" placeholder="Title">
                        <input type="text" v-model="category.create.slug" placeholder="Slug">
                        <div style="padding: 15px 0 0 0;">
                            <label>Родительская категория</label>
                            <select class="browser-default" v-model="category.create.parent_id">
                                <option value="" disabled selected>Выберите категорию</option>
                                <option value="0">-</option>
                                <option v-for='category in categoryList' :value="category.id">@{{ category.title }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="createCategoryRequest($event)">Сохранить</a>
                        <a href="#!" class="modal-close waves-effect waves-blue btn-flat" @click.prevent>Закрыть</a>
                    </div>
                </div>
            </section>
            <section data-component='sub-modal' class="category-submodal-edit">
                <div id="category-submodal-edit" class="modal modal-fixed-footer bottom-sheet">
                    <div class="modal-content">
                        <h4>Редактирование категории</h4>
                        <blockquote>
                            Для редактирования наименования измените текстовое поле и нажмите сохранить
                        </blockquote>
                        <input type="text" v-model="category.edit.title" placeholder="Title">
                        <input type="text" v-model="category.edit.slug" placeholder="Slug">
                        <div style="padding: 15px 0 0 0;">
                            <label>Родительская категория</label>
                            <select class="browser-default" v-model="category.edit.parent_id">
                                <option value="" disabled selected>Выберите категорию</option>
                                <option value="0">-</option>
                                <option v-for='category in categoryList' :value="category.id">@{{ category.title }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#!" class="waves-effect waves-green btn-flat" @click.prevent="editCategoryRequest($event)">Сохранить</a>
                        <a href="#!" class="modal-close waves-effect waves-blue btn-flat" @click.prevent>Закрыть</a>
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
            /* карточки */
            items: {!! $items !!},
            /* категории */
            category: {
                list: {!! $category !!},
                create: {
                    title: '',
                    parent_id: 0,
                    slug: '',
                },
                edit: {
                    title: '',
                    parent_id: '',
                    slug: '',
                },
            }, 
            /* школа */
            school: {
                list: {!! $school !!},
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
                        school_id: "",
                        category_id: "",
                        is_popular: "",
                        is_online: "",
                        gallery: {
                            is_active: null,
                            id: '',
                            list: [],
                        },
                        body_short: "",
                        body_long: "",
                        body_goals: "",
                        body_course: "",
                        author: "",
                        duration: null,
                        price: null,
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
            },
        },
        created: function(){
            /* инициализация tiny окна */
            
            window.tinyMCE.init({
                selector: "#create-task [data-component='tinymce']#body_short",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#create-task [data-component='tinymce']#body_long",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#create-task [data-component='tinymce']#body_goals",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#create-task [data-component='tinymce']#body_course",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#edit-task [data-component='tinymce']#body_short_edit",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#edit-task [data-component='tinymce']#body_long_edit",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#edit-task [data-component='tinymce']#body_goals_edit",
                plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak autoresize',
            });
            window.tinyMCE.init({
                selector: "#edit-task [data-component='tinymce']#body_course_edit",
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
            categoryList: function(){
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
                let result = this.category.list.sort(compare);
                return result;
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

                    category_id: (this.form.createTask.inputs.category_id == "-" ? "" : this.form.createTask.inputs.category_id),
                    school_id: (this.form.createTask.inputs.school_id == "-" ? "" : this.form.createTask.inputs.school_id),

                    author: this.form.createTask.inputs.author,
                    duration: this.form.createTask.inputs.duration,
                    price: this.form.createTask.inputs.price,


                    body_short: this.form.createTask.inputs.body_short,
                    body_long: this.form.createTask.inputs.body_long,
                    body_goals: this.form.createTask.inputs.body_goals,
                    body_course: this.form.createTask.inputs.body_course,

                    meta_title: this.form.createTask.inputs.meta_title,
                    meta_description: this.form.createTask.inputs.meta_description,
                    meta_keywords: this.form.createTask.inputs.meta_keywords,
                    meta_canonical: this.form.createTask.inputs.meta_canonical,

                    is_visible: this.form.createTask.inputs.is_visible ? 1 : null ,
                    is_popular: this.form.createTask.inputs.is_popular ? 1 : null ,
                    is_online: this.form.createTask.inputs.is_online ? 1 : null ,

                    is_active_gallery: this.form.createTask.inputs.gallery.is_active ? true : null,
                    catalog_gallery_id: this.form.createTask.inputs.gallery.id,
                    gallery: this.form.createTask.inputs.gallery.list,


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

                    author: item.author != null ? item.author : "",
                    duration: item.duration != null ? item.duration : null,
                    price: item.price != null ? item.price : null,

                    category_id: item.category_id != null ? item.category_id : "",
                    school_id: item.school_id != null ? item.school_id : "",
                    
                    gallery: {
                        is_active: item.is_active_gallery,
                        id: '',
                        list: item.gallery != null ? item.gallery : [],
                    },

                    body_short: item.body_short != null ? item.body_short : "",
                    body_long: item.body_long != null ? item.body_long : "",
                    body_goals: item.body_goals != null ? item.body_goals : "",
                    body_course: item.body_course != null ? item.body_course : "",

                    meta_title: item.meta_title != null ? item.meta_title : "",
                    meta_description: item.meta_description != null ? item.meta_description : "",
                    meta_keywords: item.meta_keywords != null ? item.meta_keywords : "",
                    meta_canonical: item.meta_canonical != null ? item.meta_canonical : "",

                    is_visible: item.is_visible != null ? item.is_visible : "",
                    is_popular: item.is_popular != null ? item.is_popular : "",
                    is_online: item.is_online != null ? item.is_online : "",
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

                    author: "",
                    duration: null,
                    price: null,

                    category_id: "",
                    school_id: "",
                    
                    gallery: {
                        is_active: null,
                        id: '',
                        list: [],
                    },

                    body_short: "",
                    body_long: "",
                    body_goals: "",
                    body_course: "",

                    meta_title: "",
                    meta_description: "",
                    meta_keywords: "",
                    meta_canonical: "",

                    is_visible: "", 
                    is_popular: "", 
                    is_online: "", 
                };

                
                /* при открытии модального окна - обновляем значение tiny */
                tinyMCE.get('body_short').setContent("");
                tinyMCE.get('body_long').setContent("");
                tinyMCE.get('body_goals').setContent("");
                tinyMCE.get('body_course').setContent("");
                
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
                // tinyMCE.get('body-edit').setContent(item_prepared.body);
                tinyMCE.get('body_short_edit').setContent(item_prepared.body_short);
                tinyMCE.get('body_long_edit').setContent(item_prepared.body_long);
                tinyMCE.get('body_goals_edit').setContent(item_prepared.body_goals);
                tinyMCE.get('body_course_edit').setContent(item_prepared.body_course);

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
                request_data.body_long = tinyMCE.get("body_long").getContent();
                request_data.body_goals = tinyMCE.get("body_goals").getContent();
                request_data.body_course = tinyMCE.get("body_course").getContent();

                fetch(`/component/course`, {
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
                request_data.body_long = tinyMCE.get("body_long_edit").getContent();
                request_data.body_goals = tinyMCE.get("body_goals_edit").getContent();
                request_data.body_course = tinyMCE.get("body_course_edit").getContent();

                var item_id = request_data.id;
                fetch(`/component/course/${item_id}`, {
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
                request_data.body_long = tinyMCE.get("body_long_edit").getContent();
                request_data.body_goals = tinyMCE.get("body_goals_edit").getContent();
                request_data.body_course = tinyMCE.get("body_course_edit").getContent();
                // request_data.is_visible = (item.is_visible ? 1 : 0);

                fetch(`/component/course/${item.id}`, {
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
             * @param item - объект
             *
             * обновляет видимость объекта
             * показывает уведомление о результате
             *
             */
            updateVisibleCategory: function(event, item)
            {
                var vm = this;
                /* подготовка информации для update, добавление в форму */
                this.form.createTask.inputs = {};
                var item_prepared = this.prepareInputObjectToView(item);
                this.form.createTask.inputs = item_prepared;
                // tinyMCE.get('body-edit').setContent(item_prepared.body);

                /* извлечение информации из формы */
                var request_data = this.prepareInputObjectToRequest();
                // request_data.body = tinyMCE.get('body-edit').getContent();
                request_data.is_visible = (item.is_visible ? 1 : 0);

                fetch(`/component/course/category/${item.id}`, {
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
                fetch(`/component/course/${this.form.removeItem.inputs.id}`, {
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
                fetch(`/component/course/0`, {
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
                    // vm.category.edit.gallery.push(tmp_gallery_obj);
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

                fetch(`/component/course/gallery`, {
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
            /*функция 2022*/
            
            
            /* работа с категориями */
             
            /**
             *
             * @param event - событие
             * @param category - объект
             *
             * открывает запрашиваемое окно для редактирования
             *
             */
            openCategorySubModalCreate: function(event, parent = null)
            {
                /* откроем модельной окно для редактирования пресета */
                var vm = this;

                /* ссылка на родительскую категорию */
                if ( parent != null ) {
                    vm.category.create.parent_id = parent.id;
                }else{
                    vm.category.create.parent_id = 0;
                }
                /* открыть модальное окно */
                vm.initModal(`category-submodal-create`);

                return;
            },
            /**
             *
             * @param event - событие
             * @param category - объект
             *
             * открывает запрашиваемое окно для редактирования
             *
             */
            openCategorySubModalEdit: function(event, category = null)
            {
                /* откроем модельной окно для редактирования пресета */
                var vm = this;

                /* назначаем редактируемый объект */
                vm.category.edit = category;

                /* при открытии модального окна - обновляем значение tiny  */
                // tinyMCE.get('city-seo-text-edit').setContent((vm.city.edit.seo_text ? vm.city.edit.seo_text : ""));

                /* открыть модальное окно */
                vm.initModal(`category-submodal-edit`);

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
            createCategoryRequest: function(event)
            {
                var vm = this;
                var request_data = vm.category.create;

                fetch(`/component/course/category`, {
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
                        vm.category.list = data.result.items;
                        vm.showToast(`Запись добавлена.`);

                        /* обнолим форму создания */
                        vm.category.create.title = "";

                        /* закроем модальное окно */
                        vm.closeModal(`category-submodal-create`);
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
            editCategoryRequest: function(event = null)
            {
                var vm = this;
                var request_data = vm.category.edit;
                // request_data.seo_text = tinyMCE.get('city-seo-text-edit').getContent();

                fetch(`/component/course/category/${vm.category.edit.id}`, {
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
                        vm.category.list = data.result.items;
                        /* сообщение об успехе */
                        vm.showToast(`Изменения сохранены`);
                        
                        /* закроем модальное окно */
                        vm.closeModal(`category-submodal-edit`);
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
            removeCategoryRequest: function(event, item = null)
            {
                var vm = this;
               
                fetch(`/component/course/category/${item.id}`, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": this.form.csrf
                    },
                    method: 'DELETE',
                    body: JSON.stringify({method: 'remove', type: vm.category.create.type})
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
                        vm.showToast(`Запись '${item.title}' удалена.`);
                        
                        /* обновим список категорий */
                        vm.category.list = data.result.category;

                        /* обновим список объектов (т.к возможно изменились привязки) */
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
                fetch(`/component/course/sort`, {
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
            changeSortCategory: function(event, item, action = null)
            {
                var vm = this;
                if( action == null ){
                    console.log("No action has found - no action will be take.")
                    return;
                }
                /* ищем элемент */
                let a;
                a = vm.categoryList.findIndex(function(value, key){
                    /* если проверка будет по id, то новые фото нельзя будет сортировать */
                    return item.id == value.id;
                });

                if( a > -1 ){
                    /* изменения в родительских категориях */
                    if( action == '-1' ){
                        /* выполним сортировку, перемещаем назад */
                        if( (a-1) != -1 ){
                            vm.categoryList[a]['sort'] = vm.categoryList[a]['sort'] - 1;
                            vm.categoryList[a-1]['sort'] = vm.categoryList[a]['sort'] + 1;
                        }
                    }else{
                        /* перемещаем вперед */
                        if( vm.categoryList[a+1] != null ){
                            vm.categoryList[a]['sort'] = vm.categoryList[a]['sort'] + 1;
                            vm.categoryList[a+1]['sort'] = vm.categoryList[a]['sort'] - 1;
                        }
                    }
                }else{
                    /* изменения в подкатегориях */
                    for( submenu in vm.categoryList ){
                        if( vm.categoryList[submenu]['childs'].length ){
                            a = vm.categoryList[submenu]['childs'].findIndex(function(value, key){
                                /* если индекс найден - выполним сортировку */
                                if( item.id == value.id ){
                                    if( action == '-1' ){
                                        /* перемещаем назад */
                                        if( (key-1) != -1 ){
                                            vm.categoryList[submenu]['childs'][key]['sort'] = vm.categoryList[submenu]['childs'][key]['sort'] - 1;
                                            vm.categoryList[submenu]['childs'][key-1]['sort'] = vm.categoryList[submenu]['childs'][key]['sort'] + 1;
                                        }
                                    }else{
                                        /* перемещаем вперед */
                                        if( vm.categoryList[submenu]['childs'][key+1] != null ){
                                            vm.categoryList[submenu]['childs'][key]['sort'] = vm.categoryList[submenu]['childs'][key]['sort'] + 1;
                                            vm.categoryList[submenu]['childs'][key+1]['sort'] = vm.categoryList[submenu]['childs'][key]['sort'] - 1;
                                        }
                                    }
                                }
                                return item.id == value.id;
                            });
                        }
                    }

                }

                var request_data = vm.categoryList;
                fetch(`/component/course/category/sort`, {
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
                        vm.category.list = data.result.itemList;
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
    /* [data-module="catalog"] [data-component="item-list"] .list-item */
    [data-module="catalog"] [data-component="item-list"] .list-item{
        grid-template-columns: 70px auto 100px 100px 100px;
    }
</style>
</body>
</html>
