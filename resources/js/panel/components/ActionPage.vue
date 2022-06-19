<template>
  <section data-component="category-list" style="padding-bottom: 0;">
    <div row>
        <article data-component="city-managment">
              <ul class="collapsible">
                <li>
                    <div class="collapsible-header">
                        Управление разделом "Акции": категории.
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
</template>

<script>
export default {

}
</script>

<style>

</style>