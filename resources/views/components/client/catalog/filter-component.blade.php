<form data-component="filter" method="" action="">
    <h4 class="mt-4">Тип курса:</h4>
    <div class="mt-3">
        <label>
            <input class="uk-radio" type="radio" autocomplete="off" 
                   <?=(!isset($inputs['is_online']) ? "checked='checked'" : "") ?>
                   value="-1" name="is_online" checked=""> Любой</label>
    </div>
    <div class="mt-3">
        <label>
            <input class="uk-radio" type="radio" autocomplete="off"
                   <?=(isset($inputs['is_online']) && isset($inputs['is_online']) == 1 ? "checked='checked'" : "") ?> 
                   value="1" name="is_online"> Онлайн</label>
    </div>
    <div class="mt-3">
        <label>
            <input class="uk-radio" type="radio" autocomplete="off" 
                   value="2" 
                   <?=(isset($inputs['is_online']) && isset($inputs['is_online']) == 2 ? "checked='checked'" : "") ?>
                   name="is_online"> Оффлайн</label>
    </div>

    <h4 class="mt-4">Тип обучения:</h4>
    <div class="mt-3">
        <label>
        <input class="uk-radio" 
               type="radio" 
               autocomplete="off" 
               value="null" 
               <?=(!isset($inputs['is_proffession']) ? "checked='checked'" : "") ?>
               name="is_proffession" 
               > 
        Курс
    </label>
    </div>
    <div class="mt-3">
        <label>
        <input class="uk-radio" 
               type="radio" 
               autocomplete="off" 
               value="1" 
               <?=(isset($inputs['is_proffession']) && $inputs['is_proffession'] == 1 ? "checked='checked'" : "") ?>
               name="is_proffession"> 
        Профессия
    </label>
    </div>

    <h4 class="mt-4">Категория:</h4>
    <div class="mt-3">
        <select type="select" 
                value="<?=(isset($inputs['category_id']) ? $inputs['category_id'] : "") ?>"
                class="uk-select" 
                name="category_id">
            <option value="" selected="selected">Любая</option>
            <?php foreach ( (isset($category) && !empty($category) ? $category : array()) as $key => $value): ?>
                <option value="<?=$value['id'] ?>"
                        <?=(isset($inputs['category_id']) && $inputs['category_id'] == $value ? "selected='selected'" : "") ?>>
                        <?=$value['title'] ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>

    <h4 class="mt-4">Город:</h4>
    <div class="mt-3">
        <select type="select" 
                value="<?=(isset($inputs['school_id']) ? $inputs['school_id'] : "") ?>"
                class="uk-select" 
                name="adress">
            <option value="" selected="selected">Любой</option>
            <?php foreach ( (isset($adress) && !empty($adress) ? $adress : array()) as $key => $value): ?>
                <option value="<?=$value ?>"
                        <?=(isset($inputs['school_id']) && $inputs['school_id'] == $value ? "selected='selected'" : "") ?>>
                        <?=$value ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    
    <h4 class="mt-4">Длительность (мес):</h4>
    <div class="mt-3">
        <select type="select" class="uk-select"
                value="<?=(isset($inputs['duration']) ? $inputs['duration'] : "") ?>" 
                name="duration">
            <option value="" selected="selected">Любой</option>
            <?php foreach ( (isset($duration) && !empty($duration) ? $duration : array()) as $key => $value): ?>
                <option value="<?=$value ?>"
                        <?=(isset($inputs['duration']) && $inputs['duration'] == $value ? "selected='selected'" : "") ?>>
                        <?=$value ?>
                </option>
            <?php endforeach ?>
        </select>
    </div>
    
    <h4 class="mt-4">Помощь в трудоустройстве:</h4>
    <div class="mt-3">
        <label>
            <input class="uk-radio" 
                   type="radio" 
                   autocomplete="off" 
                   value="1" 
                   <?=(isset($inputs['is_jobable']) && $inputs['is_jobable'] == 1 ? "checked='checked'" : "") ?>
                   name="is_jobable"> 
            Да
        </label>
    </div>
    <div class="mt-3">
        <label>
            <input class="uk-radio"
                   <?=(!isset($inputs['is_jobable']) ? "checked='checked'" : "") ?> 
                   type="radio" autocomplete="off" value="-1" name="is_jobable"> 
            Нет
        </label>
    </div>

    <h4 class="mt-4">Выдача сертификата по окончанию обучения:</h4>
    <div class="mt-3">
        <label>
            <input class="uk-radio" type="radio" autocomplete="off" 
                   <?=(isset($inputs['is_certificate']) && $inputs['is_certificate'] == 1 ? "checked='checked'" : "") ?>
                   value="1" name="is_certificate"> 
            Да
        </label>
    </div>
    <div class="mt-3">
        <label>
            <input class="uk-radio" type="radio" autocomplete="off" 
                   <?=(!isset($inputs['is_certificate']) ? "checked='checked'" : "") ?>
                   value="null" name="is_certificate"> Нет
        </label>
    </div>
</form>