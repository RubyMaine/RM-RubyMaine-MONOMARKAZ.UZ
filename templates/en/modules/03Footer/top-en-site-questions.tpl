<div id="container">
	<div class="chat_header">
		<div>
			<button class="chat_icon">
				<i class="fa fa-comment" aria-hidden="true"></i>
				<span>Questions and suggestions</span>
			</button>
			<div id="wait_helper">
				The operator is expected to accept
			</div>

			<div id="online_helper">
				The operator is on the network
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
				<span>Use this section to get answers to your questions and suggestions. Fill in your personal phone number and name that our operators contact you to improve the quality of service!</span>
			</div>

			<div class="chat_form">
				<div class="form_item">
					<label for="user_name"> F.I.O:</label>
					<input type="text" id="user_name" />
				</div>
				<div class="form_item">
					<label for="phone_number"> Phone number:</label>
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
					Get started
				</button>
			</div>
			<div id="chat_block">
				<div class="block_item">
					<div class="block_text">
						The conversation was temporarily blocked for excessive action. Please wait!
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