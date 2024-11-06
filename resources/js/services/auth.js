export const AuthService = {
    login(token) {
        localStorage.setItem('admin_token', token);
    },
    logout() {
        localStorage.removeItem('admin_token');
    },
    isAuthenticated() {
        return !!localStorage.getItem('admin_token');
    }
};
