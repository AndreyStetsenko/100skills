class Filter {
    constructor(elem) 
    {
        var vm = this;
        // this._elem = elem;
        for( let item of document.querySelectorAll(`form[data-component="filter"] [type="radio"][name]`) ){
            item.onclick = vm.onClick.bind(this);
        }
        for( let item of document.querySelectorAll(`form[data-component="filter"] select[name]`) ){
            item.onchange = vm.onChange.bind(this);
        }
        if ( document.querySelector(`[data-component="catalog-limit"]`) != null ) {
            for( let item of document.querySelectorAll(`[data-component="catalog-limit"] a`) ){
                item.onclick = vm.onLimit.bind(this);
            }
        }
        if ( document.querySelector(`[data-component="search-short-form"].submit-await`) != null ) {
            document.querySelector(`[data-component="search-short-form"].submit-await`).onsubmit = vm.onSubmit.bind(this);
        }
    }
    render (template)
    {
        // document.querySelector(`[data-row="catalog"]`).insertAdjacentHTML("afterbegin", template);
        document.querySelector(`[data-row="catalog"]`).innerHTML = template;
        return;
    }
    href (template)
    {
    }
    inputs() 
    {
        var filter = this.filter;
        if ( filter == null ) {
            console.log("no filter component fount - no request will be");
            return;
        }
        /* создали объект*/
        var request = {};
        /* добавили radio инпуты*/
        for( let item of filter.querySelectorAll(`[type="radio"][name]`) ){
            // if ( item.value == "null" ) {
            //     continue;
            // }
            if ( item.checked ) {
                request[item.name] = item.value;
            }
        }
        /* добавили выпадающие списки*/
        for( let item of filter.querySelectorAll(`select[name]`) ){
            if ( item.value.length == 0 || item.value == "null" ) {
                continue;
            }
            request[item.name] = item.value;
        }
        /* добавили строку поиска */
        if ( document.querySelector(`input[type="search"][name="query"]`) != null ) {
            request["query"] = document.querySelector(`input[type="search"][name="query"]`).value;
        }
        /* добавили limit */
        if ( document.querySelector(`[data-component="catalog-limit"]`) != null ) {
            request["limit"] = document.querySelector(`[data-component="catalog-limit"] a.active`).dataset.value;
        }
        /* добавили page */
        if( (document.location.search).includes("page") ){
            request["page"] = new URL(location.href).searchParams.get('page');
        }
        /* добавили is_popular */
        if( (document.location.search).includes("is_popular") ){
            request["is_popular"] = new URL(location.href).searchParams.get('is_popular');
        }
        /* добавили is_recomended */
        if( (document.location.search).includes("is_recomended") ){
            request["is_recomended"] = new URL(location.href).searchParams.get('is_recomended');
        }
        /* добавили is_recomended */
        if( (document.location.search).includes("is_action") ){
            request["is_action"] = new URL(location.href).searchParams.get('is_action');
        }
        return request;
    }
    inputsOld() 
    {
        var filter = this.filter;
        if ( null == null ) {
            console.log("no filter component fount - no request will be");
            return;
        }
        /* создали объект*/
        var request = {};
        /* добавили radio инпуты*/
        for( let item of document.querySelectorAll(`form[data-component="filter"] [type="radio"][name]`) ){
            // if ( item.value == "null" ) {
            //     continue;
            // }
            if ( item.checked ) {
                request[item.name] = item.value;
            }
        }
        /* добавили выпадающие списки*/
        for( let item of document.querySelectorAll(`form[data-component="filter"] select[name]`) ){
            if ( item.value.length == 0 || item.value == "null" ) {
                continue;
            }
            request[item.name] = item.value;
        }
        /* добавили строку поиска */
        if ( document.querySelector(`input[type="search"][name="query"]`) != null ) {
            request["query"] = document.querySelector(`input[type="search"][name="query"]`).value;
        }
        /* добавили limit */
        if ( document.querySelector(`[data-component="catalog-limit"]`) != null ) {
            request["limit"] = document.querySelector(`[data-component="catalog-limit"] a.active`).dataset.value;
        }
        /* добавили page */
        if( (document.location.search).includes("page") ){
            request["page"] = new URL(location.href).searchParams.get('page');
        }
        /* добавили is_popular */
        if( (document.location.search).includes("is_popular") ){
            request["is_popular"] = new URL(location.href).searchParams.get('is_popular');
        }
        /* добавили is_recomended */
        if( (document.location.search).includes("is_recomended") ){
            request["is_recomended"] = new URL(location.href).searchParams.get('is_recomended');
        }
        /* добавили is_recomended */
        if( (document.location.search).includes("is_action") ){
            request["is_action"] = new URL(location.href).searchParams.get('is_action');
        }
        return request;
    }

    requestTemplate( ) 
    {
        var vm = this;
        
        let request_data = vm.inputs();
        let formData = new FormData();

        for ( let key in request_data ) {
            formData.append(key, request_data[key]);
        }
        fetch(`/catalog/search`, {
            headers: {
                "X-CSRF-TOKEN": document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
            },
            method: 'POST',
            body: formData
        })
        .then(function(response){
            console.log(response);
            return response.text();
        })
        .then(function (result) {
            vm.render(result);
            vm.href(result);
        });
    }
    request() 
    {
        var vm = this;
        
        let request_data = vm.inputs();
        let formData = new FormData();

        for ( let key in request_data ) {
            formData.append(key, request_data[key]);
        }
        fetch(`/catalog`, {
            headers: {
                "X-CSRF-TOKEN": document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
            },
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(function (result) {
            console.log(result);

            // vm.render(result['template']['items'] + result['template']['pagination']);
            vm.render(result["template"]["render"]);
            // vm.render(result['template']['storeTemplate']);

            /* установим url с учетом параметров запроса */
            window.history.pushState("object or string", "filter", result["form"]["url"]);
            if ( result["form"]["url"].length == 0 ) {
                window.history.pushState("object or string", "filter", "/catalog");
            }
        });
    }
    onLimit(event) {
        let vm = this;
        /**
         * т.к на мобильной версии нет кнопок, будем использовать большой фильтр 
         */
        let media = event.currentTarget.dataset.media;
        console.log(media);
        
        this.filter = document.querySelector(`[data-media="${media}"] [data-component="filter"]`);
        document.querySelector(`[data-component='catalog-limit'] a.active`).classList.remove('active'); 
        event.target.classList.add(`active`);
        vm.request();
        return;
    }
    onClick(event) {
        let vm = this;
        this.filter = event.currentTarget.closest(`[data-component="filter"]`);
        vm.request();
        return;
    }
    onChange(event) {
        let vm = this;
        this.filter = event.currentTarget.closest(`[data-component="filter"]`);
        vm.request();
        return;
    }
    onSubmit(event) {
        event.preventDefault();
        let vm = this;
        vm.request();
        return;
    }

    // action(){
    //     let action = event.target.dataset.action;
    //     let type = event.target.getAttribute("type");
    //     if ( type != "radio" ){
    //         event.preventDefault();
    //         return;
    //     }
    //     console.log(2, this.radio());
        
    //     return;
    //     if (action) {
    //         this[action]();
    //     }
    // }
}

var submitActionUpdateForm = function() 
{
    /* валидация */
        let isValid = 1;



        /* формирование объекта отправки */
        let fd = new FormData();
        let form = document.querySelector(`form[data-component="account-course-form"]`);
        let request = {};
        
        request["id"] = form.querySelector(`input[name='id']`).value;
        request["title"] = form.querySelector(`input[name='title']`).value;
        request["body_short"] = form.querySelector(`[name='body_short']`).value;
        request["body_long"] = form.querySelector(`[name='body_long']`).value;     
        request["link"] = form.querySelector(`[name='link']`).value;     
        request["gallery"] = JSON.parse(form.querySelector(`[name="gallery"]`).value);     
        

        /* подготовка разметки для ответа */
        document.querySelector(`[data-component="toast"]`).classList.remove("show");
        /* отправка fetch */
        fetch(`/account/actions/${form.querySelector(`input[name='id']`).value}`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json, text-plain, */*",
                "X-Requested-With": "XMLHttpRequest",
                'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
            },
            method: 'PUT',
            credentials: "same-origin",
            body: JSON.stringify(request)
        })
        .then(response => response.json())
        .then(function (result) {
            
            if ( result["errors"] != null ) {
                if ( document.querySelector(`[data-component="toast"]`) != null ) {}
                for( let err in result["errors"] ){
                    let template = `<li>${result["errors"][err]}</li>`;
                    document.querySelector(`[data-component="toast"]`).innerHTML = "";
                    document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                    document.querySelector(`[data-component="toast"]`).classList.add("show");
                }
                return;
            }
            if ( result["success"] != null ) {
                if ( document.querySelector(`[data-component="toast"]`) != null ) {}
                for( let err in result["success"] ){
                    let template = `<li>${result["success"][err]}</li>`;
                    document.querySelector(`[data-component="toast"]`).innerHTML = "";
                    document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                    document.querySelector(`[data-component="toast"]`).classList.add("show");
                }
                return;
            }
            return;
        });
        return;
}
var submitAccountCreateForm = function() {
    /* валидация */
    let isValid = 1;


    /* формирование объекта отправки */
    let fd = new FormData();
    let form = document.querySelector(`form[data-component="account-course-form"]`);
    let request = {};
   

    request["title"] = form.querySelector(`input[name='title']`).value;
    request["phone"] = form.querySelector(`input[name='phone']`).value;
    request["email"] = form.querySelector(`input[name='email']`).value;
    request["link"] = form.querySelector(`input[name='link']`).value;
    request["adress"] = form.querySelector(`input[name='adress']`).value;
    request["latitude"] = form.querySelector(`input[name='latitude']`).value;
    request["longitude"] = form.querySelector(`input[name='longitude']`).value;
  
    /* не должен быть массив т.к в update ProfileController будет ошибка */
    request["gallery"] = (form.querySelector(`[name="gallery"]`).value.length != 0) ? JSON.parse(form.querySelector(`[name="gallery"]`).value) : null;
    
    /**
     * если на странице установлен tinyMCE редактор - получаем данные из него 
     */
    if ( window.tinyMCE != null ) {
        request["body_short"] = tinyMCE.get(`body_short`).getContent();
    }else{
        request["body_short"] = form.querySelector(`[name='body_short']`).value;    
    }

    /* подготовка разметки для ответа */
    document.querySelector(`[data-component="toast"]`).classList.remove("show");

    /* отправка fetch */
    fetch(`/account/profile`, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'POST',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {
        let template = "";
        if ( result["errors"] != null ) {
            
            for( let err in result["errors"] ){
                template += `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["success"] != null ) {
            
            for( let err in result["success"] ){
                template += `<li>${result["success"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            setTimeout(function() {
                window.location.href = result["href"];
            }, 2000)
            return;
        }
        
        return;
    });
    return;
}
var submitCourseUpdateForm = function() {
    /* валидация */
    let isValid = 1;



    /* формирование объекта отправки */
    let fd = new FormData();
    let form = document.querySelector(`form[data-component="account-course-form"]`);
    let request = {};
   
    request["id"] = form.querySelector(`input[name='id']`).value;
    request["title"] = form.querySelector(`input[name='title']`).value;
    request["category_id"] = form.querySelector(`select[name='category_id']`).value;
    request["is_certificate"] = form.querySelector(`[name='is_certificate']`).checked;
    request["is_jobable"] = form.querySelector(`[name='is_jobable']`).checked;
    request["is_online"] = form.querySelector(`[name='is_online']`).checked;
    request["is_proffession"] = form.querySelector(`[name='is_proffession']`).checked;

    request["duration"] = form.querySelector(`input[name='duration']`).value;
    request["price"] = form.querySelector(`input[name='price']`).value;
    request["link"] = form.querySelector(`input[name='link']`).value;

    /**
     * если на странице установлен tinyMCE редактор - получаем данные из него 
     */
    if ( window.tinyMCE != null ) {
        request["body_short"] = tinyMCE.get(`body_short`).getContent();
        request["body_goals"] = tinyMCE.get(`body_goals`).getContent();
        request["body_long"] = tinyMCE.get(`body_long`).getContent();  
    }else{
        request["body_short"] = form.querySelector(`[name='body_short']`).value;
        request["body_goals"] = form.querySelector(`[name='body_goals']`).value;
        request["body_long"] = form.querySelector(`[name='body_long']`).value;     
    }
    
    // tinyMCE.get('body_short_edit').setContent(item_prepared.body_short);
    // request_data.body_short = tinyMCE.get("body_short").getContent();

    console.log(request)
    /* не должен быть массив т.к в update CourseController будет ошибка */
    request["gallery"] = JSON.parse(form.querySelector(`[name="gallery"]`).value);     
    
    /*собираем курсы*/
    course_list = [];
    for( let course of document.querySelectorAll(`[data-component="custom-search"] [data-ul="selected"] li`) ){
        course_list.push(course.dataset.value);
    }
    request["course"] = course_list;

     // подготовка разметки для ответа 
    document.querySelector(`[data-component="toast"]`).classList.remove("show");
    /* отправка fetch */
    fetch(`/account/courses/${form.querySelector(`input[name='id']`).value}`, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'PUT',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {
        
        if ( result["errors"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["errors"] ){
                let template = `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["success"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["success"] ){
                let template = `<li>${result["success"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        console.log(result);
        return;
    });
    return;
}
var submitActionUpdateForm = function() {
    /* валидация */
    let isValid = 1;



    /* формирование объекта отправки */
    let fd = new FormData();
    let form = document.querySelector(`form[data-component="account-course-form"]`);
    let request = {};
   
    request["id"] = form.querySelector(`input[name='id']`).value;
    request["title"] = form.querySelector(`input[name='title']`).value;
    request["category_id"] = form.querySelector(`select[name='category_id']`).value;
    request["is_certificate"] = form.querySelector(`[name='is_certificate']`).checked;
    request["is_jobable"] = form.querySelector(`[name='is_jobable']`).checked;
    request["is_online"] = form.querySelector(`[name='is_online']`).checked;
    request["is_proffession"] = form.querySelector(`[name='is_proffession']`).checked;

    request["duration"] = form.querySelector(`input[name='duration']`).value;
    request["price"] = form.querySelector(`input[name='price']`).value;
    request["link"] = form.querySelector(`input[name='link']`).value;

    /**
     * если на странице установлен tinyMCE редактор - получаем данные из него 
     */
    if ( window.tinyMCE != null ) {
        request["body_short"] = tinyMCE.get(`body_short`).getContent();
        request["body_goals"] = tinyMCE.get(`body_goals`).getContent();
        request["body_long"] = tinyMCE.get(`body_long`).getContent();  
    }else{
        request["body_short"] = form.querySelector(`[name='body_short']`).value;
        request["body_goals"] = form.querySelector(`[name='body_goals']`).value;
        request["body_long"] = form.querySelector(`[name='body_long']`).value;     
    }
    
    // tinyMCE.get('body_short_edit').setContent(item_prepared.body_short);
    // request_data.body_short = tinyMCE.get("body_short").getContent();

    console.log(request)
    /* не должен быть массив т.к в update CourseController будет ошибка */
    request["gallery"] = JSON.parse(form.querySelector(`[name="gallery"]`).value);     
    
    /*собираем курсы*/
    course_list = [];
    for( let course of document.querySelectorAll(`[data-component="custom-search"] [data-ul="selected"] li`) ){
        course_list.push(course.dataset.value);
    }
    request["course"] = course_list;

     // подготовка разметки для ответа 
    document.querySelector(`[data-component="toast"]`).classList.remove("show");
    /* отправка fetch */
    fetch(`/account/actions/${form.querySelector(`input[name='id']`).value}`, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'PUT',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {
        
        if ( result["errors"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["errors"] ){
                let template = `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["success"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["success"] ){
                let template = `<li>${result["success"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        console.log(result);
        return;
    });
    return;
}
var submitProfileUpdateForm = function() {
    /* валидация */
    let isValid = 1;

    /* формирование объекта отправки */
    let fd = new FormData();
    let form = document.querySelector(`form[data-component="account-course-form"]`);
    let request = {};
    request["id"] = form.querySelector(`input[name='id']`).value;
    request["title"] = form.querySelector(`input[name='title']`).value;
    request["phone"] = form.querySelector(`input[name='phone']`).value;
    request["email"] = form.querySelector(`input[name='email']`).value;
    request["link"] = form.querySelector(`input[name='link']`).value;
    request["adress"] = form.querySelector(`input[name='adress']`).value;
    request["latitude"] = form.querySelector(`input[name='latitude']`).value;
    request["longitude"] = form.querySelector(`input[name='longitude']`).value;

    /* не должен быть массив т.к в update ProfileController будет ошибка */
    request["gallery"] = (form.querySelector(`[name="gallery"]`).value.length != 0) ? JSON.parse(form.querySelector(`[name="gallery"]`).value) : null;
    console.log(form.querySelector(`[name="gallery"]`).value.length);

    /**
     * если на странице установлен tinyMCE редактор - получаем данные из него 
     */
    if ( window.tinyMCE != null ) {
        request["body_short"] = tinyMCE.get(`body_short`).getContent();
    }else{
        request["body_short"] = form.querySelector(`[name='body_short']`).value;    
    }
    
    /* подготовка разметки для ответа */
    document.querySelector(`[data-component="toast"]`).classList.remove("show");
    
    /* отправка fetch */
    fetch(`/account/profile/${form.querySelector(`input[name='id']`).value}`, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'PUT',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {
        
        if ( result["errors"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["errors"] ){
                let template = `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["success"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["success"] ){
                let template = `<li>${result["success"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
        }

        return;
    });
    return;
}
var addGallery = function(event) {
    var formData = new FormData();
    var files = event.target.files;
    for( file of files ){
        formData.append("file[]", file);
    }
    
    fetch(`/component/gallery`, {
        headers: {
            "X-CSRF-Token": document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'POST',
        body: formData
    })
    .then(function(response) {
        if( response.status != 200 && response.status != 422){
            /* если ответ не 200 - что-то случилось, обработаем ошибку */
            /* если ответ не 422 - ответ от валидатора */
            
        }
        return response.json();
    })
    .then(function(data){
        if( data.result.status == null ){

        }else{
            var toasts = [`Файлы галереи загружены.`, `После сохранения записи, изображения будут сохранены.`];
        }
        console.log(data["result"]["files"])
        document.querySelector(`input[data-component="gallery"]`).value = JSON.stringify(data["result"]["files"]);
        
        return;
    });
}
var searchAdress = function() {
    
    /* формирование объекта отправки */
    let fd = new FormData();
    let request = {};
    request["input"] = document.querySelector(`[data-component="adress-search"] input[data-name='adress']`).value;     
    
    /* подготовка разметки для ответа */
    document.querySelector(`[data-component="toast"]`).classList.remove("show");

    /* отправка fetch */
    fetch(`/api/geocode`, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'POST',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {

        if ( result["errors"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["errors"] ){
                let template = `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["result"] == undefined ) {
            let template = `
                <li>
                    Адрес не найден, уточните запрос
                </li>`;
            document.querySelector(`[data-component="adress-search"] ul`).innerHTML = "";
            document.querySelector(`[data-component="adress-search"] ul`).insertAdjacentHTML("afterbegin", template);
            return;
        }
        if ( result["result"]["items"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            let template = "";
            for( let res of result["result"]["items"] ){
                template += `
                    <li>
                        <a style='cursor:pointer;' 
                           onclick="event.preventDefault(); selectAdress('${res['adress']}', '${res['latitude']}', '${res['longitude']}' )">
                            ${res['adress']}
                        </a>
                    </li>`;
                document.querySelector(`[data-component="adress-search"] ul`).innerHTML = "";
                document.querySelector(`[data-component="adress-search"] ul`).insertAdjacentHTML("afterbegin", template);
            }
            return;
        }
        console.log(result);
        return;
    });
    return;
}
var selectAdress = function(adress, latitude, longitude)
{
    document.querySelector(`[data-component="adress-search"] [data-name="adress"]`).value = adress; 
    document.querySelector(`[data-component="adress-search"] input[name="adress"]`).value = adress; 
    document.querySelector(`[data-component="adress-search"] input[name="latitude"]`).value = latitude; 
    document.querySelector(`[data-component="adress-search"] input[name="longitude"]`).value = longitude;
    document.querySelector(`[data-component="adress-search"] ul`).innerHTML = "<li>Адрес установлен.</li>"; 
    return;
}
var searchCourse = function() {
    
    /* формирование объекта отправки */
    let fd = new FormData();
    let request = {};
    request["input"] = document.querySelector(`[data-component="custom-search"] input[data-name='input']`).value;     
    if ( request["input"].length < 3 ) {
        return;
    }
    /* подготовка разметки для ответа */
    document.querySelector(`[data-component="toast"]`).classList.remove("show");

    /* отправка fetch */
    fetch(`/account/courses/search`, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'POST',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {

        if ( result["errors"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["errors"] ){
                let template = `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["result"] == undefined ) {
            let template = `
                <li>
                    Курс не найден, уточните запрос
                </li>`;
            document.querySelector(`[data-component="custom-search"] ul`).innerHTML = "";
            document.querySelector(`[data-component="custom-search"] ul`).insertAdjacentHTML("afterbegin", template);
            return;
        }
        if ( result["result"]["items"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            let template = "";
            for( let res of result["result"]["items"] ){
                template += `
                    <li>
                        <a style='cursor:pointer;' 
                           onclick="event.preventDefault(); selectCourse('${res['id']}', '${res['title']}')">
                            ${res['title']}
                        </a>
                    </li>`;
                document.querySelector(`[data-component="custom-search"] [data-ul="search"]`).innerHTML = "";
                document.querySelector(`[data-component="custom-search"] [data-ul="search"]`).insertAdjacentHTML("afterbegin", template);
            }
            return;
        }
        console.log(result);
        return;
    });
    return;
}
var selectCourse = function(id, title)
{
    // document.querySelector(`[data-component="custom-search"] [data-ul="selected"]`).innerHTML = "";  
    template = `
        <li data-value='${id}'>
            <div>
                ${title}
            </div>
        </li>`;
    document.querySelector(`[data-component="custom-search"] [data-ul="selected"]`).insertAdjacentHTML("afterbegin", template); 
    document.querySelector(`[data-component="custom-search"] [data-ul="search"]`).innerHTML = "";
    document.querySelector(`[data-component="custom-search"] [data-name="input"]`).value = "";
    return;
}
var removeCourse = function (id) 
{
    document.querySelector(`[data-component='custom-search'] li[data-value='${id}']`).remove();
    let messages = [
        "Список похожих курсов изменен <br /><br />Изменения вступят в силу после сохранения записи",
    ];
    document.querySelector(`[data-component="toast"]`).innerHTML = "";
    for( let m in messages ){
        let template = `<li>${messages[m]}</li>`;
        document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
        document.querySelector(`[data-component="toast"]`).classList.add("show");
    }
}
/**
 * change visible in account couse list
 */
var changeVisibleRequest = function(route, request)
{
    /* отправка fetch */
    fetch(route, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'POST',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {
        
        if ( result["errors"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["errors"] ){
                let template = `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["success"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["success"] ){
                let template = `<li>${result["success"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            /**
             * добавление новой разметки 
             */
            if ( document.querySelector(`[data-component="course-tbody"]`) != null ) {
                document.querySelector(`[data-component="course-tbody"]`).innerHTML = result["template"]["paginated"];
            }
            /**
             * обновление чекбоксов после запроса 
             */
            for( let ch of document.querySelectorAll(`[data-component="deleting"]`) ){
                console.log(ch)
                ch.checked = false;
            }
            return;
        }
        return;
    });
    return;
}
var deleteRequest = function(route, request)
{
    /* отправка fetch */
    fetch(route, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            'X-CSRF-TOKEN': document.querySelector(`meta[name='csrf-token']`).getAttribute('content')
        },
        method: 'DELETE',
        credentials: "same-origin",
        body: JSON.stringify(request)
    })
    .then(response => response.json())
    .then(function (result) {
        
        if ( result["errors"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["errors"] ){
                let template = `<li>${result["errors"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            return;
        }
        if ( result["success"] != null ) {
            if ( document.querySelector(`[data-component="toast"]`) != null ) {}
            for( let err in result["success"] ){
                let template = `<li>${result["success"][err]}</li>`;
                document.querySelector(`[data-component="toast"]`).innerHTML = "";
                document.querySelector(`[data-component="toast"]`).insertAdjacentHTML("afterbegin", template);
                document.querySelector(`[data-component="toast"]`).classList.add("show");
            }
            /**
             * добавление новой разметки 
             */
            if ( document.querySelector(`[data-component="course-tbody"]`) != null ) {
                document.querySelector(`[data-component="course-tbody"]`).innerHTML = result["template"]["paginated"];
            }
            return;
        }
        return;
    });
    return;
}
var changeAccountCourseVisible = function(event, course_id)
{
    let route = event.currentTarget.dataset.route;
    /* подготовка fetch */
    let request = {};
    request["id"] = [course_id];
    request["is_visible"] = event.target.checked;
    changeVisibleRequest(route, request);
    return;
}
var changeMassAccountCourseVisible = function(event)
{
    document.querySelector(`[data-component="deleting-all"]`).checked = false;

    let route = event.currentTarget.dataset.route;
    
    if ( document.querySelectorAll(`[data-component="deleting"]`).length == 0 ) {
        return;
    }
    let course_ids = [];
    for( let ch of document.querySelectorAll(`[data-component="deleting"]`) ){
        if ( ch.checked ) {
            course_ids.push(ch.value);
        }
    }
    /* подготовка fetch */
    let request = {};
    request["id"] = course_ids;
    request["is_visible"] = false;

    changeVisibleRequest(route, request);
    return;
}
var changeMassAccountCourseDelete = function(event)
{
    let route = event.currentTarget.dataset.route;
    
    if ( document.querySelectorAll(`[data-component="deleting"]`).length == 0 ) {
        return;
    }
    let course_ids = [];
    for( let ch of document.querySelectorAll(`[data-component="deleting"]`) ){
        if ( ch.checked ) {
            course_ids.push(ch.value);
        }
    }
    /* подготовка fetch */
    let request = {};
    request["id"] = course_ids;

    deleteRequest(route, request);
    return;
}

var changeMassAccountActionDelete = function(event)
{
    let route = event.currentTarget.dataset.route;
    
    if ( document.querySelectorAll(`[data-component="deleting"]`).length == 0 ) {
        return;
    }
    let action_ids = [];
    for( let ch of document.querySelectorAll(`[data-component="deleting"]`) ){
        if ( ch.checked ) {
            action_ids.push(ch.value);
        }
    }
    /* подготовка fetch */
    let request = {};
    request["id"] = action_ids;

    deleteRequest(route, request);
    return;
}

document.addEventListener("DOMContentLoaded", function(){
    new Filter(document.querySelector(`form[data-component="filter"]`));
});