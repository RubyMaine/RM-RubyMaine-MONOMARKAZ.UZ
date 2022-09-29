<div id="container">
	<div class="chat_header">
		<div>
			<button class="chat_icon">
				<i class="fa fa-comment" aria-hidden="true"></i>
				<span> Савол ва таклифлар учун </span>
			</button>
			<div id="wait_helper">
				Оператор қабул қилиши кутилмоқдa
			</div>

			<div id="online_helper">
				Оператор тармоқда
			</div>

			<div id="new_msg">
				<span id="new_msg_cnt"></span>
			</div>
		</div>
		<button class="chat_close"><i class="fa fa-times" aria-hidden="true"></i></button>
	</div>
	<main id="chat_item">
		<div id="no_chat">
			<div>
				<span> Савол ва таклифларингизга жавоб олиш учун ушбу қисмдан фойдаланинг. Хизмат сифатини яхшилаш учун операторларимиз сизга мурожаат қилувчи шахсий телефон рақамингиз ва исм-шарифингизни тўлдиринг! </span>
			</div>

			<div class="chat_form">
				<div class="form_item">
					<label for="user_name"> Ф.И.О: </label>
					<input type="text" id="user_name" />
				</div>
				<div class="form_item">
					<label for="phone_number"> Телефон рақам: </label>
					<input type="text" id="phone_number" />
				</div>
			</div>
		</div>
		<ul id="chat"></ul>
		<footer id="chat_action">
			<div id="chat_actions">
				<input placeholder="Type your message" id="chat_text" />
				<button id="send" type="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
			</div>
			<div id="chat_start">
				<button id="start">
					Бошлаш
				</button>
			</div>
			<div id="chat_block">
				<div class="block_item">
					<div class="block_text">
						Суҳбат ортиқча ҳаракатлар учун вақтинчалик блокланди. Илтимос кутинг!
					</div>
					<div class="timer">
						<div id="hours">00</div>
						:
						<div id="minutes">00</div>
						:
						<div id="seconds">00</div>
					</div>
				</div>
			</div>
		</footer>
	</main>
</div>