<div uk-dropdown="mode: click; boundary: .boundary">
  <ul class="uk-nav uk-dropdown-nav">
      <li class="<?=(request()->getRequestUri() == '/catalog') ? 'uk-active' : '' ?>"> 
          <a href="/catalog">Все курсы</a>
      </li>
      <li class="<?=(request()->getRequestUri() == '/catalog?is_recomended=1') ? 'uk-active' : '' ?>">
          <a href="/catalog?is_recomended=1">Мы рекомендуем</a>
          
      </li>
      <li class="<?=(request()->getRequestUri() == '/catalog?is_popular=1') ? 'uk-active' : '' ?>">
          <a href="/catalog?is_popular=1">Популярные</a>
          
      </li>
      <li class="<?=(request()->getRequestUri() == '/catalog?is_action=1') ? 'uk-active' : '' ?>">
          <a href="/catalog?is_action=1">Акции</a>
          
      </li>
      <li class="<?=(request()->getRequestUri() == '/catalog/nearme') ? 'uk-active' : '' ?>">
          <a href="/catalog/nearme">Курсы рядом</a>
      </li>                                       
  </ul>
</div>