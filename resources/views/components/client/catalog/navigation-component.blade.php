<div class="col-md-9 category-btn">
   <a href="/catalog" 
    class="btn <?=(request()->getRequestUri() == '/catalog') ? "btn-red" : "btn-light" ?>">Все курсы</a>
   <a href="/catalog?is_recomended=1" 
    class="btn <?=(request()->getRequestUri() == '/catalog?is_recomended=1') ? "btn-red" : "btn-light" ?>">Мы рекомендуем</a>
   <a href="/catalog?is_popular=1" 
    class="btn <?=(request()->getRequestUri() == '/catalog?is_popular=1') ? "btn-red" : "btn-light" ?>">Популярные</a>
   <a href="/catalog?is_action=1" 
    class="btn <?=(request()->getRequestUri() == '/catalog?is_action=1') ? "btn-red" : "btn-light" ?>">Акции</a>
   <a href="/catalog/nearme" 
    class="btn <?=(request()->getRequestUri() == '/catalog/nearme') ? "btn-red" : "btn-light" ?>">Курсы рядом</a>
</div>