<div id="container">
   <div class="chat_header">
       <div>
           <button class="chat_icon">
               <i class="fa fa-comment" aria-hidden="true"></i>
               <span> Questions and Suggestions </span>
           </button>
           <div id="wait_helper">
               Ожидается, что оператор примет
           </div>

           <div id="online_helper">
               Оператор в сети
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
               <span> Use this section to get answers to your questions and suggestions. Fill in your personal phone number and name by which our operators will contact you to improve the quality of service! </span>
           </div>

           <div class="chat_form">
               <div class="form_item">
                   <label for="user_name"> Ф.И.О :</label>
                   <input type="text" id="user_name" />
               </div>
               <div class="form_item">
                   <label for="phone_number"> Номер телефона: </label>
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
                   Начать
               </button>
           </div>
           <div id="chat_block">
               <div class="block_item">
                   <div class="block_text">
                       Беседа была временно заблокирована за чрезмерные действия. Пожалуйста подождите!
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