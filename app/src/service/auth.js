export default class Auth {
    static sessionUser = localStorage.getItem('user');

    static IsLoggedIn = this.sessionUser != null;

    static IsUnLoggedIn = !this.IsLoggedIn;

    static User = this.IsLoggedIn ? JSON.parse(this.sessionUser) : {}

    static IsAdmin = this.IsLoggedIn ? this.User.isAdmin : false

    static IsUserOrAdmin = (idUser) => idUser === this.User.id || this.IsAdmin

    static ShowIf = (condition) => !condition ? "d-none" : "";

    static setUserSession = (user) => {
        localStorage.setItem("user", JSON.stringify(user));
        document.location.reload();
    }

    static removeUserSession = () => {
        localStorage.removeItem("user")
        document.location.reload();
    }
}