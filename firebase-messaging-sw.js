importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js');

var firebaseConfig = {
    apiKey: "AIzaSyD-hClzHRiMyWjWdn-xoHXQYk4BGJYqiCM",
    authDomain: "antree-apps.firebaseapp.com",
    projectId: "antree-apps",
    storageBucket: "antree-apps.appspot.com",
    messagingSenderId: "689952355755",
    appId: "1:689952355755:web:61f40fd484d1a1dbb54eee",
    measurementId: "G-G9QKV6Q8JQ"
};

firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function (payload) {
    console.log(payload);
    const notification = JSON.parse(payload);
    const notificationOption = {
        body: notification.body,
        icon: notification.icon
    };
    return self.registration.showNotification(payload.notification.title, notificationOption);
});