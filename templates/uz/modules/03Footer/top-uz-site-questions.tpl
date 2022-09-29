<div id="container">
	<div class="chat_header">
		<div>
			<button class="chat_icon">
				<i class="fa fa-comment" aria-hidden="true"></i>
				<span>Savol va takliflar uchun</span>
			</button>
			<div id="wait_helper">
				Operator qabul qilishi kutilmoqda
			</div>

			<div id="online_helper">
				Operator tarmoqda
			</div>

			<!--<span><wicket:message key="Staff_Contact"/></span>-->
			<div id="new_msg">
				<span id="new_msg_cnt"></span>
			</div>
		</div>
		<button class="chat_close"><i class="fa fa-times" aria-hidden="true"></i></button>
	</div>
	<main id="chat_item">
		<div id="no_chat">
			<div>
				<!--<img src="assets/images/no_chat.png" alt="">-->
				<span>Savol va takliflaringizga javob olish uchun ushbu qismdan foydalaning. Xizmat sifatini yaxshilash uchun operatorlarimiz sizga murojaat qiluvchi shaxsiy telefon raqamingiz va ism-sharifingizni to'ldiring!</span>
			</div>

			<div class="chat_form">
				<div class="form_item">
					<label for="user_name"> FIO :</label>
					<input type="text" id="user_name" />
				</div>
				<div class="form_item">
					<label for="phone_number"> Telefon raqam :</label>
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
					Boshlash
				</button>
			</div>
			<div id="chat_block">
				<div class="block_item">
					<div class="block_text">
						Suhbat ortiqcha harakatlar uchun vaqtinchalik bloklandi. Iltimos kuting!
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