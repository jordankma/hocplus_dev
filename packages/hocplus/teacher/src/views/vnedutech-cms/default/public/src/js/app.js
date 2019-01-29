new Vue({
    el: '#app',
    data: {
        register: false,
        logIn: true,
        restorePassword: false,
        otherUser: true
    },
    methods: {
        btnRegister: function () {
            this.logIn = false;
            this.register = true;
            this.restorePassword = false;
            this.otherUser = true;
        },
        btnLogIn: function () {
            this.logIn = true;
            this.register = false;
            this.restorePassword = false;
            this.otherUser = true;
        },
        btnForgotPassword: function () {
            this.restorePassword = true;
            this.otherUser = false;
        }
    }
});