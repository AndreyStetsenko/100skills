<div class="col-md-3 num-list" data-component="catalog-limit">
    <div>Показывать курсов:</div>
    <?php if ( request()->input('limit') == null ): ?>
       
        <ul class="course-num">
           <li>
               <a style="cursor: pointer;"
                  onclick="event.preventDefault();"
                  data-value="9"
                  data-media="desktop">9</a>
           </li>
           <li>
               <a style="cursor: pointer;"
                  onclick="event.preventDefault();" 
                  class='active'
                  data-value="15"
                  data-media="desktop">15</a>
           </li>
           <li>
               <a style="cursor: pointer;"
                  onclick="event.preventDefault();"
                  data-value="21"
                  data-media="desktop">21</a>
           </li>
       </ul>

    <?php else: ?>
   
       <ul class="course-num">
            <li>
                <a style="cursor: pointer;"
                  onclick="event.preventDefault();"
                  <?=(request()->input('limit') == '9' ? "class='active'" : "") ?>
                  data-value="9" data-media="desktop">9</a>
            </li>
            <li>
                <a style="cursor: pointer;"
                  onclick="event.preventDefault();" 
                  <?=(request()->input('limit') == '15' ? "class='active'" : "") ?>
                  data-value="15" data-media="desktop">15</a>
            </li>
            <li>
                <a style="cursor: pointer;"
                  onclick="event.preventDefault();"
                  <?=(request()->input('limit') == '21' ? "class='active'" : "") ?>
                  data-value="21" data-media="desktop">21</a>
            </li>
        </ul>

    <?php endif ?>
</div>