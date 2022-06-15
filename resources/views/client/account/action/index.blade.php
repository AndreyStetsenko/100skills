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

            <ul data-component="toast"></ul>
            <div class="uk-overflow-auto section-last mt-5">
                <a onclick="event.preventDefault(); changeMassAccountCourseDelete(event);" 
                   data-route="/account/actions/0"
                   style="cursor: pointer;" class="btn btn-red btn-light">
                   Удалить <span class="m-none">выбранные</span>
                </a>
                <a onclick="event.preventDefault(); changeMassAccountCourseVisible(event);"
                   data-route="/account/actions/visible" 
                   style="cursor: pointer;" class="btn btn-light" style="padding: 11px 35px;">
                   Отключить <span class="m-none">выбранные</span>
                </a>
                <a onclick="event.preventDefault(); changeMassAccountCourseVisible(event);"
                   data-route="/account/courses/visible/true"
                   style="cursor: pointer;" class="btn btn-light" style="padding: 11px 35px;">Включить <span class="m-none">выбранные</span>
                </a>
                <a href="/account/actions/create" 
                    style="cursor: pointer;" class="btn btn-light" style="padding: 11px 35px;">
                    <span>Создать акцию</span>
                </a>
                <table class="uk-table uk-table-hover uk-table-middle uk-table-striped uk-table-responsive">
                    <thead>
                        <tr>
                            <th class="col-md-1">
                                <input data-component="deleting-all" value="all" class="uk-checkbox" type="checkbox"></td>
                            </th>
                            <th class="col-md-2"><span>Наименование</span></th>
                            <th class="col-md-3"><span>Дата окончания</span></th>
                            <th class="col-md-2"><span>Цена</span></th>
                            <th class="col-md-2"><span>Вкл/Выкл</span></th>
                            <th class="col-md-2"><span>Действие</span></th>
                        </tr>
                    </thead>
                    <tbody data-component="course-tbody">
                        @include('client.account.action.paginated')
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>