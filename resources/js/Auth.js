import axios from 'axios';

class Auth {
    constructor () {
        this.isLoggedIn = window.Laravel.isLoggedIn;
        this.userData = window.Laravel.user;
       /* this.token = window.localStorage.getItem('token');
        let userData = window.localStorage.getItem('user');
        this.user = userData ? JSON.parse(userData) : null;

        if (this.token) {
            axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }*/
    }
    /*
    login (token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));
        axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        this.token = token;
        this.user = user;
    }*/
    check () {
        return !! this.isLoggedIn;
    }
    user(){
        return this.userData;
    }
    /*
    logout () {
        // window.localStorage.clear();
        window.localStorage.removeItem('token');
        window.localStorage.removeItem('user');
        this.user = null;
    }

     */
}
export default new Auth();
