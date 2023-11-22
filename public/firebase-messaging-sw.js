importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyCPJZiIzFlPKdobzbs9d3DU_Xmw5Tb7Cys",
    projectId: "oloscrow",
    messagingSenderId: "610638936110",
    appId: "1:610638936110:web:5ef9b1cae3e4f96492c7bf"
});

const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function({data:{title,body,icon}}) {
    return self.registration.showNotification(title,{body,icon});
});
