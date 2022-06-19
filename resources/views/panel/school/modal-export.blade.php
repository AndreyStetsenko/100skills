<section data-component='modal'>
    <div id="stat-export" class="modal modal-fixed-footer">
        <div class="modal-content">
            <h4>Экспорт данных</h4>
            
            <form action="">
                
                <div class="row">
                    {{-- <div class="input-field col s12">
                        <input placeholder="Событие" 
                            id="action" 
                            type="text" 
                            class="validate"
                            v-model="form.statsExport.inputs.action" >
                        <label for="action">Событие</label>
                    </div> --}}
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="С даты" 
                            id="date_start" 
                            type="date" 
                            class="validate"
                            v-model="form.statsExport.inputs.date_start" >
                        <label for="date_start">С даты</label>
                    </div>

                    <div class="input-field col s6">
                        <input placeholder="По дату" 
                            id="date_end" 
                            type="date" 
                            class="validate"
                            v-model="form.statsExport.inputs.date_end" >
                        <label for="date_end">По дату</label>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="input-field col s3">
                        <a href="#!" 
                            class="waves-effect waves-light btn-small"
                            @click="csvExport(exDay)">
                            1 день
                        </a>
                    </div>
                    <div class="input-field col s3">
                        <a href="#!" 
                            class="waves-effect waves-light btn-small"
                            @click="csvExport(exWeek)">
                            1 неделя
                        </a>
                    </div>
                    <div class="input-field col s3">
                        <a href="#!" 
                            class="waves-effect waves-light btn-small"
                            @click="csvExport(exMonth)">
                            1 месяц
                        </a>
                    </div>
                    <div class="input-field col s3">
                        <a href="#!" 
                            class="waves-effect waves-light btn-small"
                            @click="csvExport(exThreeMonth)">
                            3 месяца
                        </a>
                    </div>
                </div> --}}
            </form>
           
        </div>
        <div class="modal-footer">
            <a href="#!" class="waves-effect waves-green btn-flat" @click="csvExport(exDay)">Экспорт</a>
            <a href="#!" class="modal-close btn-flat" @click.prevent>Отмена</a>
        </div>
    </div>
</section>