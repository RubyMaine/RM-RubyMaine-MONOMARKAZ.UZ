$(document).ready(function () {
    if (!localStorage.getItem("email")) {
        setTimeout(() => {
            $(".membership_container").addClass("show");
        }, 5000);
    }

    let interval_chat = null;
    let interval_timer = null;
    let no_visible_msg_cnt = null;
    let no_visible_msg_cnt_by_icon = null;

    if (localStorage.getItem("chat_id") > 0) {
        getAllChats();
    }

    function setScrollBottom(scroll, time, smooth) {
        setTimeout(() => {
            let tag = document.getElementById("chat");

            if (scroll) {
                tag.scrollTo({
                    top: tag.scrollHeight,
                    left: 0,
                    behavior: smooth ? "smooth" : "instant",
                });
            }
            // this.no_visible_msg = false
        }, time);
    }

    function setSeenMsg() {
        let obj = {
            chat_id: localStorage.getItem("chat_id"),
            user_id: new DeviceUUID().get(),
        };

        if (!obj.chat_id) {
            return;
        }
        $.ajax({
            method: "POST",
            url: `messages/seen`,
            data: JSON.stringify(obj),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
        }).done(function (data) {
            alert(1);
        });
    }

    function isVisible(bool1, bool2, bool3) {
        $(".chat_icon").css({
            display: bool1,
        });
        $("#online_helper").css({
            display: bool2,
        });
        $("#wait_helper").css({
            display: bool3,
        });
    }

    function makeTimer(end_date) {
        //      var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
        var endTime = new Date(end_date);
        endTime = Date.parse(endTime) / 1000;

        var now = new Date();
        now = Date.parse(now) / 1000;

        console.log(endTime - now);
        // console.log(endTime >= now);

        var timeLeft = endTime - now;

        if (timeLeft > 0) {
            var days = Math.floor(timeLeft / 86400);
            var hours = Math.floor((timeLeft - days * 86400) / 3600);
            var minutes = Math.floor((timeLeft - days * 86400 - hours * 3600) / 60);
            var seconds = Math.floor(timeLeft - days * 86400 - hours * 3600 - minutes * 60);

            if (hours < "10") {
                hours = "0" + hours;
            }
            if (minutes < "10") {
                minutes = "0" + minutes;
            }
            if (seconds < "10") {
                seconds = "0" + seconds;
            }

            $("#hours").html(hours);
            $("#minutes").html(minutes);
            $("#seconds").html(seconds);

            $("#chat_block").css({
                display: "block",
            });
            $("#chat_actions, #chat_start").css({
                display: "none",
            });
        } else {
            $("#chat_block, #chat_start").css({
                display: "none",
            });
            $("#chat_actions").css({
                display: "flex",
            });
        }
    }

    function getAllChats() {
        $.ajax({
            method: "GET",
            url: `chats?chat_id=${localStorage.getItem("chat_id")}`,
        }).done(function (data) {
            let mp3 = new Audio("assets/chat/Notification.mp3");
            let chats = [];
            chats.splice(0, chats.length, ...JSON.parse(data));

            clearInterval(interval_timer);

            if (chats[0].is_blocked === 1) {
                interval_timer = setInterval(function () {
                    makeTimer(chats[0].unblocked_date);
                }, 1000);
            } else {
                $("#chat_block, #chat_start").css({
                    display: "none",
                });
                $("#chat_actions").css({
                    display: "flex",
                });
            }

            if ($("#container")[0].offsetHeight > 50) {
                if (!chats[0]) {
                    isVisible("block", "none", "none");
                } else if (chats[0] && chats[0].helper_id) {
                    isVisible("none", "block", "none");
                } else {
                    isVisible("none", "none", "block");
                }
            } else {
                isVisible("block", "none", "none");
            }

            let tag = document.getElementById("chat");

            if (localStorage.getItem("chat_id")) {
                no_visible_msg_cnt = chats[0].no_visible_msg_cnt;

                if ($("#container")[0].offsetHeight < 50 && no_visible_msg_cnt) {
                    $("#new_msg").css({
                        display: "block",
                    });
                    $("#new_msg_cnt")[0].innerText = no_visible_msg_cnt;
                }
            } else {
                no_visible_msg_cnt = null;
            }

            if (tag && tag.scrollTop + tag.offsetHeight + 30 > tag.scrollHeight && tag.offsetHeight !== 0 && no_visible_msg_cnt) {
                no_visible_msg_cnt_by_icon = null;
                setSeenMsg();
            } else if (localStorage.getItem("chat_id")) {
                no_visible_msg_cnt_by_icon = chats.filter((el) => el.id == localStorage.getItem("chat_id"))[0].no_visible_msg_cnt;
            }

            let bool = false;
            chats.forEach((el) => {
                if (el.no_visible_msg_cnt > 0 && el.helper_music_play > 0) {
                    bool = true;
                }
            });

            if (bool) {
                mp3.play();
            } else {
                mp3.pause();
                mp3.currentTime = 0;
            }

            clearInterval(interval_chat);
            interval_chat = setInterval(function () {
                getAllChats();
            }, 3000);
        });
    }

    function startChat() {
        // if (!parseInt(localStorage.getItem('chat_id'))) {
        //     alert('Chatga kerakli resurslar topilmadi, Xato!');
        //     return
        // } else
        if (!localStorage.getItem("chat_id")) {
            $("#chat_actions").css({
                display: "none",
            });
            $("#chat_start").css({
                display: "flex",
            });
            $("#no_chat").css({
                display: "flex",
                height: "300px",
            });
            $("#chat").css({
                display: "no",
            });
        } else {
            $("#chat_actions").css({
                display: "flex",
            });
            $("#chat_start").css({
                display: "none",
            });
            $("#no_chat").css({
                display: "none",
            });
            $("#chat").css({
                display: "block",
            });
        }
    }

    startChat();

    function showChat() {
        $("#container").css({
            borderRadius: "5px",
            width: "360px",
        });
        $("#container").addClass("opened");
        $(".chat_close").css({
            display: "block",
        });

        $("#new_msg").css({
            display: "none",
        });

        $("#chat_item").css({
            display: "inline-block",
        });

        $("#chat_action").css({
            display: "block",
        });
        $(".scroll-to-top").css({
            display: "none",
        });

        var phoneMask = IMask(document.getElementById("phone_number"), {
            mask: "00-000-00-00",
        });

        let chat = $("#chat")[0];

        chat.scrollTop = chat.scrollHeight;

        setSeenMsg();
    }

    $("#chat_text").on("keypress", function (event) {
        if (event.which === 13) {
            sendMessage();
        }
    });

    $("#start").on("click", function (event) {
        let obj = {
            ip_address: null,
            message: "",
            user_phone_number: "",
            user_fio: "",
            user_id: null,
        };

        let error = false;
        if ($("#user_name").val().trim() === "") {
            error = true;
            $("#user_name").css({
                border: "1px solid #EA0000",
            });
        } else {
            $("#user_name").css({
                border: "1px solid #e0e0e0",
            });
        }

        if ($("#phone_number").val().trim() === "") {
            error = true;
            $("#phone_number").css({
                border: "1px solid #EA0000",
            });
        } else {
            $("#phone_number").css({
                border: "1px solid #e0e0e0",
            });
        }

        if (error) return;

        obj.user_phone_number = $("#phone_number").val().split("-").join("");
        obj.user_fio = $("#user_name").val().trim();
        obj.user_id = new DeviceUUID().get();

        $.getJSON("https://api.ipify.org?format=json")
            .done(function (data) {
                obj.ip_address = data.ip;
                obj.msg = $("#chat_text").val();
                $.ajax({
                    method: "POST",
                    url: `messages`,
                    data: JSON.stringify(obj),
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                }).done(function (data) {
                    if (parseInt(data)) {
                        localStorage.setItem("chat_id", data);
                        localStorage.setItem("ip_address", obj.ip_address);
                    }

                    $("#phone_number").val("");
                    $("#user_name").val("");

                    startChat();

                    getChatTemplateClick();
                    getAllChats();
                });
            })
            .fail(function () {
                alert("error");
            });
    });

    let bool = false;
    let interval_message = null;

    $(".chat_header").on("click", function (event) {
        if (window.innerHeight > 600) {
            $("#container").css({
                height: "410px",
            });
        } else {
            $("#container").css({
                height: "360px",
            });
        }

        getChatTemplateClick();
    });

    function getChatTemplateClick() {
        if (window.innerHeight > 600) {
            $("#container").css({
                height: "410px",
            });
            $("#no_chat").css({
                height: "300px",
            });
        } else {
            $("#container").css({
                height: "360px",
            });
            $("#no_chat").css({
                height: "250px",
            });
        }

        if (!bool) {
            getChatTemplate(true);

            if (parseInt(localStorage.getItem("chat_id")) > 0) {
                clearInterval(interval_message);

                interval_message = setInterval(function () {
                    getChatTemplate();
                }, 3000);
            }
        } else {
            showChat();
        }
    }

    $(".chat_close").on("click", function (event) {
        event.stopPropagation();
        isVisible("block", "none", "none");
        clearInterval(interval_message);
        $("#container").css({
            borderRadius: "10px",
            width: "210px",
            height: "42px",
        });
        $("#container").removeClass("opened");
        $(".chat_icon").css({
            display: "block",
        });

        $(".chat_close").css({
            display: "none",
        });

        $("#new_msg").css({
            display: "none",
        });
        $(".scroll-to-top").css({
            display: "inline",
        });
        $("#chat_item").css({
            display: "none",
        });

        $("#chat_action").css({
            display: "none",
        });
    });

    $("#send").click(function (event) {
        sendMessage();
    });

    function sendMessage() {
        if ($("#chat_text").val().trim() === "") {
            return;
        }

        // if (parseInt(localStorage.getItem('chat_id'))) {
        //     alert('Chatga kerakli resurslar topilmadi, Xato!')
        //     return
        // }

        let obj = {
            ip_address: localStorage.getItem("ip_address"),
            msg: $("#chat_text").val(),
            date: new Date().toLocaleString(),
        };

        if (!obj.ip_address) {
            $.getJSON("https://api.ipify.org?format=json")
                .done(function (data) {
                    obj.ip_address = data.ip;
                    localStorage.setItem("ip_address", data.ip);

                    addChatTemplate(obj);
                })
                .fail(function () {});
        } else {
            addChatTemplate(obj);
        }
    }

    let scroll = false;

    function getChatTemplate(params) {
        // if (!parseInt(localStorage.getItem('chat_id'))) {
        //     alert('Chatga kerakli resurslar topilmadi, Xato!')
        //     return
        // }

        if (localStorage.getItem("chat_id")) {
            let check = '<i class="fa fa-check" aria-hidden="true"></i>';
            let dblcheck = '<i class="fa fa-eye" aria-hidden="true"></i>';

            // let check = `<img src='./../../../../../../webapp/assets/chat/check.png' alt="1">`
            // let dblcheck = `<img src='assets/dbl-check.png' alt="1">`

            $.ajax({
                method: "GET",
                url: `messages?chat_id=${localStorage.getItem("chat_id")}&user_id=${new DeviceUUID().get()}`,
            })
                .done(function (data) {
                    let tag = document.getElementById("chat");
                    scroll = false;
                    if (tag && tag.scrollTop + tag.offsetHeight + 50 > tag.scrollHeight) {
                        scroll = true;
                    }

                    $("#chat")[0].innerHTML = "";

                    let obj = JSON.parse(data);
                    let object_keys = Object.keys(obj).sort();

                    for (let j = 0; j < object_keys.length; j++) {
                        let array = obj[object_keys[j]];

                        $("#chat").append(`
                            <li class="message_time">
                                <div>${object_keys[j]}</div>
                            </li>
                            `);

                        array.forEach((el, index) => {
                            if (!el.helper_id) {
                                $("#chat").append(`<li class="me">
                                <div class="message_parent">
                                <div class="time">
                                   <!--<span>${el.user_msg_time_hourly}</span>-->
                                </div>
                                <div class="message" dataFor="${el.display ? "me" : ""}">
                                  ${el.msg} <span class="time">${el.user_msg_time_hourly}</span>
                                    <span class="icon_msg">${el.has_seen === 1 ? dblcheck : check}</span>
                                 </div>
                                </div>
                                </li>`);
                            } else {
                                $("#chat").append(` <li class="you">
                                    <div class="entete ${el.user_visible ? "" : "no_visible"}">
                                        <span>${el.helper_fio}</span>
                                    </div>
                                    <div class="message_parent">
                                <div class="message" dataFor="${el.user_visible ? "you" : ""}">
                                 ${el.msg} <span class="time">${el.helper_msg_time_hourly}</span>
                                 </div>
                                 <div class="time">
                                   <!--<span>${el.helper_msg_time_hourly}</span>-->
                                   </div>
                                </div>
                                    </li>`);
                            }
                        });
                    }
                })
                .always(function () {
                    if (params) showChat();

                    setScrollBottom(scroll, 100);
                });
        } else {
            showChat();
        }
    }

    function addChatTemplate(obj) {
        let wait = "...";
        let check = '<i class="fa fa-check" aria-hidden="true"></i>';
        let dblcheck = '<i class="fa fa-check-square-o" aria-hidden="true"></i>';

        let tag = $("#chat");

        let date = new Date().getTime();

        if (tag[0] && tag[0].lastChild && tag[0].lastChild.children[0] && tag[0].lastChild.children[0].children[1] && tag[0].lastChild.children[0].children[1].getAttribute("dataFor") === "me") {
            tag[0].lastChild.children[0].children[1].setAttribute("dataFor", "");
        }

        $("#chat").append(`<li class="me">
                     <div class="message_parent">
                     <div class="time">
                        <span></span>
                    </div>
                    <div class="message" dataFor="me">
                     ${obj.msg} <span></span>

                     </div>

                </div>
                </li>`);

        $("#chat_text").val("");

        let chat = $("#chat")[0];

        chat.scrollTo({
            top: chat.scrollHeight,
            left: 0,
            behavior: "smooth",
        });

        obj.chat_id = localStorage.getItem("chat_id");
        obj.user_id = new DeviceUUID().get();

        $.ajax({
            method: "POST",
            url: `messages`,
            data: JSON.stringify(obj),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
        }).done(function (data) {
            // tag[0].lastChild.children[0].children[2].innerHTML = check;
        });
    }
});