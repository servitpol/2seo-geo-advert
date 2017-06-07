$(document).on('click', '#add-block', function(e){
	e.preventDefault();
	var forms_block = '<div class="shorts-block">';
		forms_block += '<div class="default col-lg-8">';
		forms_block += '<textarea name="block_in[]" class="area-in" placeholder="Вставьте сюда код который хотите заменить" required="required"></textarea>';
		forms_block += '<textarea name="block_out[]" class="area-out" placeholder="Вставьте сюда код на который хотите заменить" required="required"></textarea>';
		forms_block += '</div>';
		forms_block += '<div class="info col-lg-4"></div></div>';
		forms_block += '<div class="name-block"><input type="text" name="short_name[]" class="name-input" placeholder="Введите имя шорткода (одно слово до 20 символов)"/>';
		forms_block += '</div></div><hr>';
	$('.append-block').append(forms_block);
});