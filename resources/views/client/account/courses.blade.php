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
                   data-route="/account/courses/0"
                   style="cursor: pointer;" class="btn btn-red btn-light">Удалить <span class="m-none">выбранные</span></a>
                <a onclick="event.preventDefault(); changeMassAccountCourseVisible(event);"
                   data-route="/account/courses/visible" 
                   style="cursor: pointer;" class="btn btn-light" style="padding: 11px 35px;">Отключить <span class="m-none">выбранные</span></a>
                <a onclick="event.preventDefault(); changeMassAccountCourseVisible(event);"
                   data-route="/account/courses/visible/true"
                   style="cursor: pointer;" class="btn btn-light" style="padding: 11px 35px;">Включить <span class="m-none">выбранные</span></a>
                   {{-- <span data-href="{{ route('statistic.get') }}" id="export" class="btn btn-success btn-sm" onclick="exportTasks(event.target);">Export</span> --}}
                <table class="uk-table uk-table-hover uk-table-middle uk-table-striped uk-table-responsive">
                    <thead>
                        <tr>
                            <th class="col-md-1">
                                <input data-component="deleting-all" value="all" class="uk-checkbox" type="checkbox"></td>
                            </th>
                            <th class="col-md-2"><span>Изображение</span></th>
                            <th class="col-md-3"><span>Название курса</span></th>
                            <th class="col-md-2"><span>Стоиомсть</span></th>
                            <th class="col-md-2"><span>Дата</span></th>
                            <th class="col-md-2"><span>Вкл/Выкл</span></th>
                            <th class="col-md-2"><span>Действие</span></th>
                        </tr>
                    </thead>
                    <tbody data-component="course-tbody">                            
                        
                        @if ( !isset($courses) )
                            <tr>
                                <td colspan="6">Курсы не добавлены. <a href="/account/courses/create" style="cursor: pointer;">Добавить курс.</a></td>
                            </tr> 
                        @endif
                        
                        @foreach ( $courses as $key => $item)
                            <tr>
                                <td><input value="{{ $item->id }}" data-component="deleting" class="uk-checkbox" type="checkbox"></td>
                                <td>
                                    <img class="uk-preserve-width" src="{{ $item->gallery->last()->src ?? '/public/files/no-image.png' }}" width="85" alt="">
                                </td>
                                <td>
                                    <h5><a href="/account/courses/{{ $item->slug }}">{{ $item->title }}</a></h5>
                                </td>
                                <td class="table-price">
                                    <div class="right-line mt-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.50002 6.00002C7.20334 6.00002 6.91333 6.08799 6.66666 6.25281C6.41999 6.41763 6.22773 6.6519 6.1142 6.92599C6.00067 7.20008 5.97096 7.50168 6.02884 7.79265C6.08672 8.08362 6.22958 8.3509 6.43936 8.56068C6.64914 8.77046 6.91641 8.91332 7.20738 8.97119C7.49835 9.02907 7.79995 8.99937 8.07404 8.88584C8.34813 8.7723 8.5824 8.58005 8.74722 8.33337C8.91204 8.0867 9.00002 7.79669 9.00002 7.50002C9.00002 7.10219 8.84198 6.72066 8.56068 6.43936C8.27937 6.15805 7.89784 6.00002 7.50002 6.00002V6.00002ZM21.12 10.71L12.71 2.29002C12.6166 2.19734 12.5058 2.12401 12.3839 2.07425C12.2621 2.02448 12.1316 1.99926 12 2.00002H3.00002C2.7348 2.00002 2.48045 2.10537 2.29291 2.29291C2.10537 2.48045 2.00002 2.7348 2.00002 3.00002V12C1.99926 12.1316 2.02448 12.2621 2.07425 12.3839C2.12401 12.5058 2.19734 12.6166 2.29002 12.71L10.71 21.12C11.2725 21.6818 12.035 21.9974 12.83 21.9974C13.625 21.9974 14.3875 21.6818 14.95 21.12L21.12 15C21.6818 14.4375 21.9974 13.675 21.9974 12.88C21.9974 12.085 21.6818 11.3225 21.12 10.76V10.71ZM19.71 13.53L13.53 19.7C13.3427 19.8863 13.0892 19.9908 12.825 19.9908C12.5608 19.9908 12.3074 19.8863 12.12 19.7L4.00002 11.59V4.00002H11.59L19.71 12.12C19.8027 12.2135 19.876 12.3243 19.9258 12.4461C19.9756 12.5679 20.0008 12.6984 20 12.83C19.9989 13.0924 19.8948 13.3438 19.71 13.53V13.53Z" fill="#E61D2B"/>
                                        </svg>                                                    
                                        @if ( $item->action->new_price )
                                        <span><small><s>{{ $item->price }}$</s></small></span>
                                        @else
                                        <span>{{ $item->price }}$</span>
                                        @endif
                                    </div>
                                    @if ( $item->action->new_price )
                                    <div class="px-2 mt-2">
                                        <span>{{ $item->action->new_price }}$</span>
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <span>
                                            <small>{{ date('d.m.y', strtotime($item->action->date_start)) }}</small>
                                        </span>
                                        <span>
                                            <small>{{ date('d.m.y', strtotime($item->action->date_end)) }}</small>
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <label class="--switch">
                                        @if ( $item->is_visible )
                                            <input type="checkbox"
                                                   checked="checked" 
                                                   name="is_visible"
                                                   onchange="event.preventDefault(); changeAccountCourseVisible(event, `{{ $item->id }}`)">                                                
                                        @else
                                            <input type="checkbox" 
                                                   name="is_visible"
                                                   onchange="event.preventDefault(); changeAccountCourseVisible(event, `{{ $item->id }}`)">    
                                        @endif
                                        <span class="--slider">
                                        <i class="fas fa-check"></i>
                                        <i class="fas fa-times"></i>
                                        </span>
                                    </label>
                                </td>
                                <td>
                                    <a href="/account/courses/{{ $item->slug }}" class="btn border-btn-dark btn-block btn-edit">
                                       <div>
                                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21 11.9999C20.7348 11.9999 20.4804 12.1053 20.2929 12.2928C20.1054 12.4804 20 12.7347 20 12.9999V18.9999C20 19.2652 19.8946 19.5195 19.7071 19.707C19.5196 19.8946 19.2652 19.9999 19 19.9999H5C4.73478 19.9999 4.48043 19.8946 4.29289 19.707C4.10536 19.5195 4 19.2652 4 18.9999V4.99994C4 4.73472 4.10536 4.48037 4.29289 4.29283C4.48043 4.1053 4.73478 3.99994 5 3.99994H11C11.2652 3.99994 11.5196 3.89458 11.7071 3.70705C11.8946 3.51951 12 3.26516 12 2.99994C12 2.73472 11.8946 2.48037 11.7071 2.29283C11.5196 2.1053 11.2652 1.99994 11 1.99994H5C4.20435 1.99994 3.44129 2.31601 2.87868 2.87862C2.31607 3.44123 2 4.20429 2 4.99994V18.9999C2 19.7956 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 21.9999 5 21.9999H19C19.7956 21.9999 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7956 22 18.9999V12.9999C22 12.7347 21.8946 12.4804 21.7071 12.2928C21.5196 12.1053 21.2652 11.9999 21 11.9999ZM6 12.7599V16.9999C6 17.2652 6.10536 17.5195 6.29289 17.707C6.48043 17.8946 6.73478 17.9999 7 17.9999H11.24C11.3716 18.0007 11.5021 17.9755 11.6239 17.9257C11.7457 17.8759 11.8566 17.8026 11.95 17.7099L18.87 10.7799L21.71 7.99994C21.8037 7.90698 21.8781 7.79637 21.9289 7.67452C21.9797 7.55266 22.0058 7.42195 22.0058 7.28994C22.0058 7.15793 21.9797 7.02722 21.9289 6.90536C21.8781 6.7835 21.8037 6.6729 21.71 6.57994L17.47 2.28994C17.377 2.19621 17.2664 2.12182 17.1446 2.07105C17.0227 2.02028 16.892 1.99414 16.76 1.99414C16.628 1.99414 16.4973 2.02028 16.3754 2.07105C16.2536 2.12182 16.143 2.19621 16.05 2.28994L13.23 5.11994L6.29 12.0499C6.19732 12.1434 6.12399 12.2542 6.07423 12.376C6.02446 12.4979 5.99924 12.6283 6 12.7599ZM16.76 4.40994L19.59 7.23994L18.17 8.65994L15.34 5.82994L16.76 4.40994ZM8 13.1699L13.93 7.23994L16.76 10.0699L10.83 15.9999H8V13.1699Z" fill="black"/>
                                            </svg>
                                       </div>
                                       <div>Редактировать</div>
                                    </a>
                                </td>
                            </tr>  
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>