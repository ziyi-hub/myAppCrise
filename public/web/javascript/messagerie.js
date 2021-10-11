
var uname = "user" + uuid(8, 11);
layer.open({
    title: '您的用户名如下',
    content: uname,
    closeBtn: 0,
    yes: function (index, layero) {
        layer.close(index);
    }
});
// 随机选出一个头像
var avatar = ['a1.jpg', 'a2.jpg', 'a3.jpg', 'a4.jpg', 'a5.jpg', 'a6.jpg', 'a7.jpg', 'a8.jpg', 'a9.jpg', 'a10.jpg'];
if (avatar[Math.round(Math.random() * 10)]) {
    var headerimg = "img/" + avatar[Math.round(Math.random() * 10)];
} else {
    var headerimg = "img/" + avatar[0];
}

var ws = null;
// 创建websocket连接
connect();
function connect() {
    // 创建一个 websocket 连接  ws://ip:端口号
    ws = new WebSocket("ws://127.0.0.1:1234");

    // 连接状态 1已建立连接
    console.log(ws.readyState)

    //  连接建立时触发
    ws.onopen = onopen;

    // 客户端接收服务端数据时触发
    ws.onmessage = onmessage;

    // 连接关闭时触发
    ws.onclose = onclose;

    //  通信发生错误时触发
    ws.onerror = onerror;
}

// 通信建立成功
function onopen()
{
    var data = "系统消息：建立连接成功";
    console.log(data);
}

// 接收客户端的数据,发送数据
function onmessage(e)
{
    var data = JSON.parse(e.data);
    console.log(data)

    switch (data.type) {
        case 'handShake':
            //首次登录，发送登陆数据
            var user_info = {'type': 'login', 'msg': uname, 'headerimg': headerimg};
            sendMsg(user_info);
            break;
        case 'login':
            userList(data.user_list);
            systemMessage('系统消息: ' + data.msg + ' 已上线');
            break;
        case 'logout':
            userList(data.user_list);
            if (data.msg.length > 0) {
                systemMessage('系统消息: ' + data.msg + ' 已下线');
            }
            break;
        case 'user':
            messageList(data);
            break;
        case 'system':
            systemMessage();
            break;
    }
}
function onclose()
{
    console.log("连接关闭，定时重连");
    connect();
}

// websocket 错误事件
function onerror()
{
    var data = "系统消息 : 出错了,请退出重试.";
    console.log(data);
}

function confirm(event) {
    var key_num = event.keyCode;
    if (13 == key_num) {
        send();
    } else {
        return false;
    }
}

// 发送数据
function send() {
    var msg = document.querySelector("input#input-value").value;
    var reg = new RegExp("\r\n", "g");
    msg = msg.replace(reg, "");
    sendMsg({type: "user", msg: msg});
    document.querySelector("input#input-value").value = "";
}

// 发送数据
function sendMsg(msg) {
    var data = JSON.stringify(msg);
    ws.send(data);
}


// 追加数据 上下线的系统消息
function systemMessage(msg) {
    var html = `<div class="conversation-start">
            <span>` + msg + `</span>
        </div>`;
    var active_chat = document.querySelector('div.active-chat');
    var oldHtml = active_chat.innerHTML;
    active_chat.innerHTML = oldHtml + html;
    active_chat.scrollTop = active_chat.scrollHeight;
}

// 追加从服务端返回的数据 左侧在线人数列表
function userList(user) {
    var html = '';
    for (var i = 0; i < user.length; i++) {
        html += `<li class="person" data-chat="person1">
                    <img src="` + user[i].headerimg + `" alt=""/>
                    <span class="name">` + user[i].username + `</span>
                    <span class="time">` + user[i].login_time + `</span>
                    <span class="preview" style="color: green;font-size: 7px;">在线</span>
                </li>`;
    }
    document.querySelector('ul.people').innerHTML = html;
    document.querySelector('span#numbers').innerHTML = user.length;
}

// 右侧聊天记录列表
function messageList(data) {

    // 判读是不是自己发送的消息，对应的样式不同
    if (data.from == uname) {
        // 如果当前用户名和feom的用户名相同，就说明时自己发送的消息
        var html = `<div class="message">
                    <img class="me-header" src="` + data.headerimg + `" alt=""/>
                    <div class="bubble me">` + data.msg + `</div>
                </div>`;
    } else {
        // 别人发送的信息列表
        var html = `<div class="message">
                    <img src="` + data.headerimg + `" alt=""/>
                    <div class="bubble you">` + data.msg + `</div>
                </div>`;
    }
    var active_chat = document.querySelector('div.active-chat');
    var oldHtml = active_chat.innerHTML;
    active_chat.innerHTML = oldHtml + html;
    active_chat.scrollTop = active_chat.scrollHeight;
}

/**
 * 生产一个全局唯一ID作为用户名的默认值;
 *
 * @param len
 * @param radix
 * @returns {string}
 */
function uuid(len, radix) {
    var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'.split('');
    var uuid = [], i;
    radix = radix || chars.length;

    if (len) {
        for (i = 0; i < len; i++) uuid[i] = chars[0 | Math.random() * radix];
    } else {
        var r;

        uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
        uuid[14] = '4';

        for (i = 0; i < 36; i++) {
            if (!uuid[i]) {
                r = 0 | Math.random() * 16;
                uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r];
            }
        }
    }
    return uuid.join('');
}