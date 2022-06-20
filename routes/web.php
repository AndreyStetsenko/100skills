<?php
use Illuminate\Support\Facades\Route;

# Статистика
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\UsersExportController;

# Клиентская часть: контент-страницы
use App\Http\Controllers\Client\Page\PageController as ClientPageController;
# Клиентская часть: фикс маршруты
use App\Http\Controllers\Client\Catalog\ItemController as ClientCatalogController;
use App\Http\Controllers\Client\Catalog\SearchController as ClientCatalogSearchController;
use App\Http\Controllers\Client\Account\ProfileController as ClientAccountProfileController;
use App\Http\Controllers\Client\Account\CourseController as ClientAccountCourseController;
use App\Http\Controllers\Client\Account\ActionController as ClientAccountActionController;
use App\Http\Controllers\Client\Account\TarifController as ClientAccountTarifController;

# Actions
use App\Http\Controllers\Client\Action\ActionController;

# управления формами
use App\Http\Controllers\Client\Forms\ClientHelpFormController;

# Панель управления

# controllers: base

# раздел "Контент страница"
use App\Http\Controllers\Panel\Page\PageController as PanelPageController;
use App\Http\Controllers\Panel\Page\MenuController as PanelMenuController;

# раздел "Пользователи"
use App\Http\Controllers\Panel\Users\UsersController;

# раздел "Формы и настройки сайта"
use App\Http\Controllers\Panel\Settings\ItemController as SettingsController;

# модуль "Галерея (фото)"
use App\Http\Controllers\Panel\Gallery\GalleryController;

# раздел "Галерея (аудио)"
use App\Http\Controllers\Panel\Gallery\AudioController;

# раздел "Галерея (видео)"
use App\Http\Controllers\Panel\Gallery\VideoController;

# controllers: custom

# раздел "Курсы"
use App\Http\Controllers\Panel\Course\ItemController as PanelCourseController;
use App\Http\Controllers\Panel\Course\CategoryController as PanelCourseCategoryController;
use App\Http\Controllers\Panel\Geocode\ItemController as GeocodeItemController;

# раздел "Акции"
use App\Http\Controllers\Panel\Action\ItemController as PanelActionController;
use App\Http\Controllers\Panel\Action\CategoryController as PanelActionCategoryController;

# раздел "Блог"
use App\Http\Controllers\Panel\Blog\ItemController as PanelBlogController;
use App\Http\Controllers\Panel\Blog\CategoryController as PanelBlogCategoryController;

# раздел "Контакты"
use App\Http\Controllers\Panel\Contact\ItemController as PanelContactController;
use App\Http\Controllers\Panel\Contact\PageController as PanelContactPageController;

# раздел "Тарифы"
use App\Http\Controllers\Panel\Tarif\ItemController as PanelTarifController;
use App\Http\Controllers\Panel\Tarif\PageController as PanelTarifPageController;

# раздел "Учет школ и преподавателей"
use App\Http\Controllers\Panel\School\ItemController as PanelSchoolController;
use App\Http\Controllers\Client\School\SchoolController as ClientSchoolPageController;

# модели для model binding
use App\Models\Course\Item as Course;
use App\Models\Blog\Item as Blog;
use App\Models\Contact\Item as Contact;
use App\Models\Menu;

# Page Actions
Route::get('/action', [ActionController::class, 'index'])->name('page.action');

# маршруты модуля контент страница: в текущий метод попадают страницы, которые соответствуют условиям.
Route::get('/{url}', [ClientPageController::class, 'view'])->where('url', '^(?!(admin|component|logout|login|register|verify-email|forgot-password|reset-password|confirm-password|action/contact|catalog|course|account|school-page|school|article|blog|contact|statistic|)(\/|$))[A-Za-z0-9+-_\/]+');

# основные маршруты для верстки
Route::get("/", function () {
    return view("/client/index/index");
})->name('home');

# маршрут для страницы курсы рядом: веб
Route::get("/catalog/nearme", [ClientCatalogSearchController::class, "nearme"]);
Route::get("/catalog/action", [ClientCatalogSearchController::class, "action"]);

# маршрут для поиска в каталоге
Route::post("/catalog/search", [ClientCatalogSearchController::class, "search"]);

# маршрут для каталога
Route::resource("/catalog", ClientCatalogSearchController::class);

# маршрут для страницы курсы рядом: api
Route::resource("/api/geocode", GeocodeItemController::class);
Route::post("/api/geocode/point", [GeocodeItemController::class, "point"]);


Route::get("/course/{slug?}", [ClientCatalogSearchController::class, "show"]);

// Route::get("/school/{school?}", function () {
//     return view("/client/schoolpage/index");
// });

Route::get("/school/list", [ClientSchoolPageController::class, "list"]);
Route::get("/school/{slug?}", [ClientSchoolPageController::class, "show"]);

Route::get("/article", function () {
    return view("/client/article/index");
});
Route::get("/blog", function () {
	# это находится здесь т.к единственная цель этой страницы - отображать
	$where = array();
	$where[] = array("is_visible", "=", 1);
	if ( !is_null(request()->input("category_id")) ) {
		$where[] = array("category_id", "=", request()->input("category_id"));
	}
	
	$items = Blog::where($where)->orderBy("sort")->with(["gallery", "category"]);
	$first = Blog::where($where)->where("is_index", 1)->latest()->orderBy("sort")->with(["gallery", "category"]);
    $response = array(
    	"items" => $items->get(),
    	"index" => $first->first(),
		"pagination" => $items->paginate(15),
	);
	// dd(__METHOD__, $response);
    return view("/client/blog/index", $response);
});
Route::get("/blog/{slug?}", function ($slug) {
	$items = Blog::where("slug", $slug)->with(["gallery", "category"]);
    $response = array(
    	"item" => $items->first(),
	);
    return view("/client/blog/show", $response);
});

Route::get("/contact", function () {
	$items = Contact::latest()->orderBy("sort");
    $response = array(
    	"items" => $items->get(),
	);
    return view("/client/contact/index", $response);
});


/* маршруты личного кабинета */
Route::get("/account/login", function () {
    return view("/client/account/login");
});
Route::get("/account/register", function () {
    return view("/client/account/register");
});
Route::get("/account/reset-password", function () {
    return view("/client/account/resetpassword");
});
Route::middleware(['auth', 'verified', 'school', 'role:account'])->group(function () {
    # ЛИЧНЫЙ КАБИНЕТ
	Route::get("/account", function () {
		return Redirect::to("/account/profile", 301); 
	});
	Route::get("/account/actions", [ClientAccountActionController::class, "index"])->name('actions.index');
	Route::get("/account/actions/create", [ClientAccountActionController::class, "create"])->name('actions.create');
	Route::post("/account/actions/create", [ClientAccountActionController::class, "store"])->name('actions.store');
	Route::post("/account/actions/update/{id?}", [ClientAccountActionController::class, "update"])->name('actions.update');
	Route::post("/account/actions/visible", [ClientAccountActionController::class, "visible"]);
	Route::get("/account/actions/{id?}", [ClientAccountActionController::class, "show"])->name('actions.view');
	Route::get("/account/actions/get-course/{id?}", [ClientAccountActionController::class, "getCourse"])->name('actions.get-course');

	Route::resource("/account/courses", ClientAccountCourseController::class);
	Route::post("/account/courses/visible", [ClientAccountCourseController::class, "visible"]);
	Route::post("/account/courses/visible/true", [ClientAccountCourseController::class, "visibleTrue"]);
	Route::post("/account/courses/search", [ClientAccountCourseController::class, "search"]);

	Route::resource("/account/tarif", ClientAccountTarifController::class);
	Route::resource("/account/profile", ClientAccountProfileController::class);
});
Route::get("/account/profile/create", [ClientAccountProfileController::class, "create"]);
Route::post("/account/profile", [ClientAccountProfileController::class, "store"]);
Route::post("/account/profile/{?id}", [ClientAccountProfileController::class, "update"]);



Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

	# Модули: base
    Route::get('/admin', function () {
		# панель управления: главная
	    return view('/panel/index/index');
	})->name('panel');

	# модуль "Контент страница"
	Route::resource('/component/page', PanelPageController::class)->names([
	    'index' => 'component.page',
	    'store' => 'component.page.store',
	    'update' => 'component.page.update',
	]);
	Route::resource('/component/menu', PanelMenuController::class)->names([
	    'index' => 'component.menu',
	    'store' => 'component.menu.store',
	    'update' => 'component.menu.update',
	]);
	Route::post('/component/menu/sort', [PanelMenuController::class, 'sort']); # маршрут для сортировки пунктов меню

	# модуль "Пользователи"
	Route::resource('/component/users', UsersController::class)->names([
	    'index' => 'component.users',
	    'update' => 'component.users.update',
	]);
	Route::post('/component/users/role/{id}', [UsersController::class, 'role']); # маршрут сохранения привязки роли

	# модуль "Настройки"
	Route::resource('/component/settings', SettingsController::class);


	# Разделы: custom

	# Категории, каталог
	# Раздел "Курсы"
	Route::resource('/component/course', PanelCourseController::class);
	Route::post('/component/course/gallery', [PanelCourseController::class, 'gallery']);
	Route::post('/component/course/sort', [PanelCourseController::class, 'sort']); # маршрут для сортировки
	Route::resource('/component/course/category', PanelCourseCategoryController::class);
	Route::post('/component/course/category/sort', [PanelCourseCategoryController::class, 'sort']); # маршрут для сортировки

	# Категории, каталог, поиск
	# Раздел "Акции"
	Route::resource('/component/action', PanelActionController::class);
	Route::post('/component/action/gallery', [PanelActionController::class, 'gallery']);
	Route::post('/component/action/video', [PanelActionController::class, 'video']);
	Route::post('/component/action/sort', [PanelActionController::class, 'sort']); # маршрут для сортировки
	Route::resource('/component/action/category', PanelActionCategoryController::class);
	Route::post('/component/action/category/sort', [PanelActionCategoryController::class, 'sort']); # маршрут для сортировки

	# Категории, каталог, поиск 
	# Раздел "Блог"
	Route::resource('/component/blog', PanelBlogController::class);
	Route::post('/component/blog/video', [PanelBlogController::class, 'video']);
	Route::post('/component/blog/gallery', [PanelBlogController::class, 'gallery']);
	Route::post('/component/blog/sort', [PanelBlogController::class, 'sort']); # маршрут для сортировки
	Route::resource('/component/blog/category', PanelBlogCategoryController::class);
	Route::post('/component/blog/category/sort', [PanelBlogCategoryController::class, 'sort']); # маршрут для сортировки

	# Страница, каталог
	# Раздел "Контакты"
	Route::resource('/component/contact', PanelContactController::class);
	Route::resource('/component/contact/page', PanelContactPageController::class);
	Route::post('/component/contact/sort', [PanelContactController::class, 'sort']);

	# Страница, каталог
	# Раздел "Тарифы"
	Route::resource('/component/tarif', PanelTarifController::class);
	Route::resource('/component/tarif/page', PanelTarifPageController::class);
	Route::post('/component/tarif/sort', [PanelTarifController::class, 'sort']);

	# Каталог, галерея
	# Раздел "Учет школ и преподавателей"
	Route::resource('/component/school', PanelSchoolController::class);
	Route::resource('/component/school/stat{?id}', PanelSchoolController::class);
	Route::post('/component/school/gallery', [PanelSchoolController::class, 'gallery']);
	Route::post('/component/school/sort', [PanelSchoolController::class, 'sort']); # маршрут для сортировки

});
Route::middleware(['auth', 'verified', 'role:admin,user'])->group(function () {
	# раздел "Галерея"
	Route::resource('/component/gallery', GalleryController::class);
	Route::resource('/component/video', VideoController::class);
	Route::resource('/component/audio', AudioController::class);
});

Route::post('/statistic/get', [StatisticsController::class, 'export'])->name('statistic.get');
Route::get('/statistic/get-exp', [StatisticsController::class, 'get'])->name('statistic.get-exp');
Route::post('/statistic/store-action', [StatisticsController::class, 'storeAction'])->name('statistic.store-action');
Route::delete('/statistic/allclear', [StatisticsController::class, 'allclear'])->name('statistic.allclear');



require __DIR__.'/auth.php';
